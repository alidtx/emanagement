<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Employee;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use Illuminate\Support\Facades\DB;
class PaymentController extends Controller
{
      private $PaymentService;

     public function __construct(PaymentService $PaymentService)
     {
        $this->PaymentService=$PaymentService;
     }


    public function index()
    {   
       
       
        $data['payments']=$this->PaymentService->getPaydata();
        return view('payment.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
