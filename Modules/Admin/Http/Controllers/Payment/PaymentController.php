<?php

namespace Modules\Admin\Http\Controllers\Payment;

use App\Grids\PaymentsGrid;
use App\Models\Payment\Payment;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\User;
use Modules\Admin\Http\Requests\AdminCreatePaymentRequest;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(PaymentsGrid $paymentsGrid, Request $request)
    {
        $page_title = __(' Payments List ');

        $query = Payment::query();

        return $paymentsGrid
            ->create(compact('query', 'request'))
            ->renderOn('admin::grid.index', compact('page_title'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {

        $users = User::cursor();

        $admin = $request->user();

        return view('admin::payments.create', compact('users', 'admin'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(AdminCreatePaymentRequest $request)
    {
        $payment = new Payment($request->only('amount', 'user_id', 'title', 'description', 'verified_code'));

        if ($request->boolean('admin_verified')) {

            $payment->setAsVerified();
        }

        $request->user()->payments()->save($payment);

        return back()->with('success', __(' Payment Created Successfully '));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Payment $payment, PaymentsGrid $paymentsGrid, Request $request)
    {

        $query = Payment::query();

        $query->whereId($payment->id);

        $grid = $paymentsGrid->create(compact('request', 'query'));

        $columns = $grid->getProcessedColumns();
        $item = collect($grid->getData()->items())->first();

        return view('admin::payments.show', compact(
            'payment',
            'item',
            'columns',
            'grid'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('admin::edit');
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

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
