<?php

namespace Modules\User\Http\Controllers;

use App\Events\AdSuccessfullPromotionPayment;
use App\Events\UserInvalidPayment;
use App\Events\UserSuccessfullPayment;
use App\Grids\PaymentsGrid;
use App\Models\Ad;
use App\Models\Payment\Payment as PaymentModel;
use App\Models\Promotion;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LogicException;
use Modules\User\Repositories\Eloquent\PromotionRepository;
use Payment;
use Shetabit\Multipay\Invoice;

class UserPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request, PaymentsGrid $grid)
    {
        $payments = $request->user()->payments()->latest()->select('title', 'amount',  'status', 'created_at')->paginate();

        if ($request->wantsJson()) {
            return $payments;
        }

        $nav_items = get_nav_items();

        $tabs = [];

        return inertia('User/MyPayments', compact('payments', 'tabs', 'nav_items'));
    }

    public function gateway(Ad $ad, Request $request, PromotionRepository $repository)
    {
        $request->validate([
            'promotions' => 'required|array',
        ]);

        $priceArr = $repository->evaluateFinalPrice($request->promotions);
        $finalPrice = $priceArr['price'];
        $currency = $priceArr['currency'];
        $user = $request->user();

        // prepare invoice
        $invoice = new Invoice;
        $invoice
            ->amount($this->getFinalPriceFromCurrency($finalPrice, 'IRT'))
            ->detail([
                'mobile' => $user->phone,
                'description' => $desc = __('user::global.ad_promote_payment_desc'),
            ]);

        // store payment and redirect to gateway api
        return Payment::callbackUrl(route('user.ad.step_phone_payment.verify', $ad))->purchase($invoice, function ($driver, $transactionId) use ($ad, $finalPrice, $user, $currency, $priceArr, $desc) {
            $ad->payments()->create([
                'transaction_id' => $transactionId,
                'amount' => $finalPrice,
                'user_id' => $user->id,
                'currency' => $currency,
                'meta' => [
                    'promotions' => $priceArr['promotions']
                ],
                'description' => $desc,
                'title' => 'ارتقا آگهی'
            ]);
        })->pay()->toJson();
    }

    public function verify(Request $request)
    {
        $transaction_id = $request->input('Authority');

        $user = $request->user();

        $payment = PaymentModel::where('transaction_id', $transaction_id)->first();

        if (!$payment) {
            return abort(404);
        }

        if ($payment->missingPromotions()) {
            return abort(400);
        }

        if ($payment->status == PaymentModel::SUCCESS) {
            return $this->paymentFailureReport($user, $payment, 101);
        }

        try {
            $verified = Payment::amount($this->getFinalPriceFromCurrency($payment->amount, 'IRT'))->transactionId($transaction_id)->verify();

            $payment->status = PaymentModel::SUCCESS;
            $payment->verified_code = $verified->getReferenceId();
            $payment->verified_at = now();
            $payment->save();
            $payment->fresh();

            event(new UserSuccessfullPayment($user, $payment));

            $promotions = $payment->promotions;
            $ad = $payment->resource;
            $ad->promotions()->attach($promotions);

            event(new AdSuccessfullPromotionPayment($ad, $payment));

            $user->push();

            return redirect()->route('user.ad.step_phone_payment.successPurchase', [
                'ad' => $ad,
                'promotions' => $promotions,
                'refID' => $transaction_id,
                'finalPrice' => $payment->amount,
            ]);
        } catch (LogicException $e) {
            report($e);

            if ($payment->status == PaymentModel::SUCCESS) {
                $user->push();

                return redirect()->route('user.ad.step_phone_payment.successPurchase', [
                    'ad' => $ad,
                    'promotions' => $promotions,
                    'refID' => $transaction_id,
                    'finalPrice' => $payment->amount,
                ]);
            }

            return $this->paymentFailureReport($user, $payment, $e);
        } catch (Exception $e) {
            // failed payment
            report($e);

            return $this->paymentFailureReport($user, $payment, $e);
        }
    }

    public function paymentFailureReport($user, $payment, $error)
    {
        $payment->status = PaymentModel::FAILED;
        $payment->save();

        event(new UserInvalidPayment($user, $payment));

        return redirect()->route('user.ad.step_phone_payment.failedPurchase', [
            'ad' => $payment->resource,
            'code' => $error->getCode(),
        ]);
    }

    public function successPurchase(Ad $ad, $refID, Request $request)
    {
        $promotions = Promotion::whereIn('id', $request->promotions)->get()->toArray();
        $refID = intval($refID); // drop zero prefixes
        $finalPrice = $request->finalPrice;

        return inertia('Payment/Success', compact('ad', 'refID', 'promotions', 'finalPrice'));
    }

    public function failedPurchase(Ad $ad, Request $request)
    {
        $message = $this->getFailureMessageBasedOnCode($request->code);

        return inertia('Payment/Failed', compact('ad', 'message'));
    }

    private function getFailureMessageBasedOnCode($code)
    {
        $message = '';

        switch ($code) {
            case 101:
                $message = 'عمليات پرداخت موفق بوده و قبلا تراكنش انجام شده است';
                break;
            default:
                $message = 'تراکنش شما با خطا مواجه شد';
        }

        return $message;
    }

    private function getFinalPriceFromCurrency($price, $currency)
    {
        switch ($currency) {
            case 'IRT':
                $price = $price / 10;
                break;
        }

        return intval($price);
    }
}
