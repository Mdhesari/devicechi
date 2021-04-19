<?php

namespace Modules\User\Http\Controllers;

use App\Models\Ad;
use App\Models\Payment\Payment as PaymentModel;
use Exception;
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

        $price = $repository->evaluateFinalPrice($request->promotions);
        $finalPrice = $price['price'];
        $currency = $price['currency'];
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
        return Payment::callbackUrl(route('user.ad.step_phone_payment.verify', $ad))->purchase($invoice, function ($driver, $transactionId) use ($ad, $finalPrice, $user, $currency) {
            $ad->payments()->create([
                'transaction_id' => $transactionId,
                'amount' => $finalPrice,
                'user_id' => $user->id,
                'currency' => $currency,
            ]);
        })->pay()->toJson();
    }

    public function verify(Request $request)
    {
        $transaction_id = $request->input('Authority');

        $user = $request->user();

        $payment = $user->payments()->where('transaction_id', $transaction_id)->first();

        try {
            $verified = Payment::amount($this->getFinalPriceFromCurrency($payment->amount, 'IRT'))->transactionId($transaction_id)->verify();

            if ($payment) {
                $payment->status = PaymentModel::SUCCESS;
                $payment->verified_code = $verified->getReferenceId();
            } else {

                throw new InvalidPaymentException;
            }

            $payment->verified_at = now();
            $payment->$payment->save();

            $user->push();
            return 'success';
            // return redirect()->route('payments.success', ['refID' => $payment->refID]);

            // successful payment
        } catch (Exception $e) {

            // failed payment
            report($e);

            dd('failed');
            // return abort(402, __(' Invalid Payment '));
        }
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

        return $price;
    }
}
