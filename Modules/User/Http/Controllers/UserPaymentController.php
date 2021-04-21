<?php

namespace Modules\User\Http\Controllers;

use App\Events\AdSuccessfullPromotionPayment;
use App\Events\UserInvalidPayment;
use App\Events\UserSuccessfullPayment;
use App\Models\Ad;
use App\Models\Payment\Payment as PaymentModel;
use App\Models\Promotion;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Repositories\Eloquent\PromotionRepository;
use Payment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;

class UserPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        $payments = $request->user()->payments()->select('title', 'amount',  'status', 'created_at')->get();

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
                'description' => __('user::globa.ad_promote_payment_desc'),
            ]);

        // store payment and redirect to gateway api
        return Payment::callbackUrl(route('user.ad.step_phone_payment.verify', $ad))->purchase($invoice, function ($driver, $transactionId) use ($ad, $finalPrice, $user, $currency, $priceArr) {
            $ad->payments()->create([
                'transaction_id' => $transactionId,
                'amount' => $finalPrice,
                'user_id' => $user->id,
                'currency' => $currency,
                'meta' => [
                    'promotions' => $priceArr['promotions']
                ]
            ]);
        })->pay()->toJson();
    }

    public function verify(Request $request)
    {
        $transaction_id = $request->input('Authority');

        $user = $request->user();

        $payment = PaymentModel::where('transaction_id', $transaction_id)->first();
        try {
            $verified = Payment::amount($this->getFinalPriceFromCurrency($payment->amount, 'IRT'))->transactionId($transaction_id)->verify();

            if ($payment) {
                if ($payment->missingPromotions()) {
                    return abort(400);
                }

                $payment->status = PaymentModel::SUCCESS;
                $payment->verified_code = $verified->getReferenceId();
            } else {
                return abort(404);
            }

            $payment->verified_at = now();
            $payment->save();

            event(new UserSuccessfullPayment($user, $payment));

            $promotions = $payment->meta['promotions'];

            $ad = $payment->resource;

            $ad->promotions()->attach($promotions);

            event(new AdSuccessfullPromotionPayment($user, $ad));

            $user->push();

            return redirect()->route('user.ad.step_phone_payment.successPurchase', [
                'ad' => $ad,
                'promotions' => $promotions,
                'refID' => $transaction_id,
                'finalPrice' => $payment->amount,
            ]);

            // successful payment
        } catch (Exception $e) {
            // failed payment
            report($e);

            $payment->status = PaymentModel::FAILED;
            $payment->save();

            event(new UserInvalidPayment($user, $payment));

            return redirect()->route('user.ad.step_phone_payment.failedPurchase', [
                'ad' => $payment->resource,
                'code' => $e->getCode(),
            ]);
        }
    }

    public function successPurchase(Ad $ad, $refID, Request $request)
    {
        $promotions = Promotion::whereIn('id', $request->promotions)->get()->toArray();
        $refID = intval($refID);
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

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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
