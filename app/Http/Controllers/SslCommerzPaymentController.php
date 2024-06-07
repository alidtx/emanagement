<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Designation;
use App\Models\DesignationWiseAmount;
use App\Models\Employee;
use App\Models\Event;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout($event_code)
    { 
       
        $data['event']=Event::where('status',1)->where('event_unique_code',$event_code )->first();
        // dd( $data['event']->event_unique_code);
        $data['employee']=Employee::where('status',1)->get();
        $data['designation']=Designation::where('status',1)->get();
        return view('exampleEasycheckout', $data);
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

   public function EventCode(Request $request) {

    $data=event::where('id', $request->event_id)->first(); 
    return response()->json($data);
    
   }




   public function designationWiseAmount(Request $request) {

      $data=DesignationWiseAmount::where('designation_id', $request->designation_id)->get(); 
     return response()->json(['data'=> $data]);
   }


   public function index(Request $request, $event_code)
    {
        
        $request->validate([
            'event_id'=>'required', 
            'employee_id'=>'required',            
            ],

            [
            'event_id.required' => 'The event field is required.',
            // 'event_id.unique' => 'You have already made payment for this event',
            'employee_id.required' => 'The employee field is required.',
            // 'employee_id.unique' => 'You are paid',
            ]
           );

        $transaction_id=uniqid();
        $event_name=Event::where('id',$request->event_id)->first()->name;
        $user=Employee::where('id',$request->employee_id)->first();
        $designation_amount=DesignationWiseAmount::where('event_id',$request->event_id)
                ->where('designation_id',$user->designation_id)->first();
         $event=Event::where('event_unique_code',$event_code)->first();
         $dwa=designationWiseAmount::where('event_id',  $event->id)->first(); 
    
        if($event->designation_id==null)
        {
          $data= New Payment();
          $data->user_id=auth::user()->id;
          $data->amount=$dwa->amount;
          $data->payment_method='sslcommerz';
          $data->event_id=$request->event_id;
          $data->employee_id=$request->employee_id;
          $data->status='Pending';
          $data->transaction_id=$transaction_id;
          $data->save();
        }else{
            $event=Event::where('id', $request->event_id)->first();
            $data= New Payment();
            $data->user_id=auth::user()->id;
            $data->amount=$event->amount;
            $data->payment_method='sslcommerz';
            $data->event_id=$request->event_id;
            $data->employee_id=$request->employee_id;
            $data->status='Pending';
            $data->transaction_id=$transaction_id;
            $data->save();
        }
        $post_data = array();
        $post_data['store_id'] = config('sslcommerz.apiCredentials.store_id');
        $post_data['store_passwd'] = config('sslcommerz.apiCredentials.store_password');
        if($event->designation_id==null)
        {
            $post_data['total_amount'] = $dwa->amount ?? 0;
        }else{
            $post_data['total_amount'] =$event->amount ?? 0;
        }
        
        $post_data['currency'] = 'BDT';
        $post_data['tran_id'] = $transaction_id; // tran_id must be unique

        $post_data['success_url'] = env("APP_URL") . config('sslcommerz.web_success_url');
        $post_data['fail_url'] = env("APP_URL") . config('sslcommerz.failed_url');
        $post_data['cancel_url'] = env("APP_URL") . config('sslcommerz.cancel_url');
        $post_data['ipn_url'] = env("APP_URL") . config('sslcommerz.ipn_url');
        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $user->name;
        $post_data['cus_email'] = $user->email;
        $post_data['cus_add1'] = "address";
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "";
        $post_data['cus_phone'] = "01638912320";
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Shipping";
        $post_data['ship_add1'] = "address 1";
        $post_data['ship_add2'] = "address 2";
        $post_data['ship_city'] = "City";
        $post_data['ship_state'] = "State";
        $post_data['ship_postcode'] = "ZIP";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Country";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = $event_name;
        $post_data['product_category'] = 'Office Event';
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";
        # REQUEST SEND TO SSLCOMMERZ
        $mode = 'local';
        if ($mode == 'live') {
            $direct_api_url = "https://securepay.sslcommerz.com/gwprocess/v4/api.php";
            $host = false;
        } else {
            $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v4/api.php";
            $host = true;
        }
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $direct_api_url);
        curl_setopt($handle, CURLOPT_TIMEOUT, 30);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($handle, CURLOPT_POST, 1);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, $host); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC

        $content = curl_exec($handle);
        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if ($code == 200 && !(curl_errno($handle))) {
            curl_close($handle);
            $sslcommerzResponse = $content;
        } else {
            curl_close($handle);
            echo "Misconfiguration or data is missing!";
        }
        # PARSE THE JSON RESPONSE
        $sslcz = json_decode($sslcommerzResponse, true);
        if (isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL'] != "") {
            # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
            # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
            // echo "<meta http-equiv='refresh' content='0;url=" . $sslcz['GatewayPageURL'] . "'>";
            $data = [
                "gateway_url" => $sslcz['GatewayPageURL'],
            ];
            return redirect($sslcz['GatewayPageURL']);
        } else {
            echo "Misconfiguration or data is missing!";
        }
    }

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique
        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        // dd($request->all());
        echo "Transaction is Successful";
        
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('payments')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Completed']);

                echo "<br >Transaction is successfully Completed";
            }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status',  'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('payments')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status',  'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('payments')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
