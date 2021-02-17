<?php

namespace App\Http\Controllers;
use smasif\ShurjopayLaravelPackage\ShurjopayService;
use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Insurancepackage;
use App\Models\Insurancesubscriptions;
use Validator, Input, Redirect ;
use App\User;

class SslCommerzPaymentController extends Controller {


    public function index(Request $request){
            $shurjopay_service = new ShurjopayService(); //Initiate the object
            $tx_id = $shurjopay_service->generateTxId(); // Get transaction id. You can use custom id like: $shurjopay_service->generateTxId('123456');
            $amount = 2;
            $success_route = route('success'); // optional.
            $shurjopay_service->sendPayment($amount, $success_route); // You can call simply $shurjopay_service->sendPayment(2) without success rout
    }

/* public function index(Request $request){

		$package_id = $request->package_id;
		$packages = Insurancepackage::find($package_id);
        $prices = unserialize($packages->family_pricing);
        $p = 0;
        
        foreach($prices as $price){
            if($price['number_of_people'] == $request->number_of_people){
               $p = $price['price'];
            }
        }

        $post_data = array();
        $post_data['total_amount'] = $p; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION

		$post_data['cus_name'] = $request->input('fullname');
        $post_data['cus_email'] = trim($request->input('email'));
        $post_data['cus_add1'] = trim($request->input('address'));
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = trim($request->input('district'));
        $post_data['cus_state'] = trim($request->input('division'));
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = trim($request->input('username'));
        $post_data['cus_fax'] = "";
	

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Chhaya.xyz";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = Insurancepackage::find($request->package_id)->title;;
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";
		$post_data['value_b'] = '';

        $order = new Insurancesubscriptions();
        $order->package_id = $package_id;
        $order->created_at = date("Y-m-d H:i:s");
        $order->updated_at = date("Y-m-d H:i:s");
        $order->number_of_people = $request->number_of_people;
        $order->nominee = serialize($request->nominee);
        $order->transaction_id = $post_data['tran_id'];
        $order->price = $p;
        
        if(\Auth::check() && \Auth::user()->group_id == 7){
            $order->entry_by = \Auth::id();
        }else{

            $rules = array(
                'username'=>'required|numeric|unique:tb_users',
            );	

            $validator = Validator::make($request->all(), $rules);
			
            if ($validator->passes()) {		
                $authen = new User;
                $authen->username = $request->input('username');
                $authen->first_name = $request->input('fullname');
                $authen->email = trim($request->input('email'));
                $authen->city = trim($request->input('district'));
                $authen->state = trim($request->input('division'));
                $authen->address_1 = trim($request->input('address'));
                $authen->birth_of_day = trim($request->input('date_of_birth'));
                $authen->group_id = 7;
                $authen->agent_id = trim($request->input('agent_id'));
                $authen->password = \Hash::make($request->input('password'));
                $authen->active = 1;
                $authen->save();
                $order->entry_by = $authen->id;
				$post_data['value_a'] = $authen->id; 
				
				if(\Auth::check() && \Auth::user()->group_id == 5){
					$post_data['value_b'] = 'agent';
				}
				
            }else{
				if(\Auth::check() && \Auth::user()->group_id == 5){
					return redirect()->back()->with('status', 'error')->with('message','The Mobile number you entered is already exists!');
				}else{
					return redirect()->back()->with('failed', 'The Mobile number you entered is already exists!');  
				}
            }

        }
		
        
        $order->status = 3;
        $data = $request->input();
        $number_of_items =  count($data['fm_fullname']);
        $familyData = [];
        for($i=0; $i <= $number_of_items; $i++ ){
            $familyData[] = [
                'fm_fullname' => $data['fm_fullname'][$i],
                'fm_date_of_birth' => $data['fm_date_of_birth'][$i],
                'fm_relationship' => $data['fm_relationship'][$i],
                'fm_gender' => $data['fm_gender'][$i],
                ];
        }
        
        $order->family_information = serialize($familyData);
        $order->save();
        
        

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    } */



    public function success(Request $request){

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $user_id = $request->input('value_a');
        

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('con_orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'price')->first();

        if ($order_detials->status == 3) {
            $validation = $sslc->orderValidate($tran_id, $amount,'BDT', $request->all());

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('con_orders')
                    ->where('transaction_id', $tran_id)
                    ->update([
                        'status' => 1,
                        'price' => $amount
                        ]);
                
				if($user_id && $request->input('value_b') != 'agent' ){
					\Auth::loginUsingId($user_id, true);
				}	
				
                return redirect('/dashboard')->with('success', 'Transaction is successfully Completed.');   
               
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('con_orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 5]);
                return redirect('/')->with('failed', 'Transaction Failed! Please try again later');  
					
            }
        } else if ($order_detials->status == 1) {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to update database.
             */
			if($user_id && $request->input('value_b') != 'agent'){
				\Auth::loginUsingId($user_id, true);
			}	
			return redirect('/dashboard')->with('success', 'Transaction is successfully Completed'); 
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            return redirect('/')->with('failed', 'Invalid Transaction! Please try again later'); 
        }

    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $order_detials = DB::table('con_orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'price')->first();

        if ($order_detials->status == 3) {
            $update_product = DB::table('con_orders')
                ->where('transaction_id', $tran_id)
                ->update([
                        'status' => 5,
                        'price' => $amount
                        ]);
                return redirect('/')->with('failed', 'Transaction Failed! Please try again later'); 
				
        } else if ($order_detials->status == 3 || $order_detials->status == 1) {
            return redirect('/')->with('success', 'Transaction is already Successful.'); 
        } else {
           return redirect('/')->with('failed', 'Invalid Transaction! Please try again later'); 
        }
    }

    public function cancel(Request $request){
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('con_orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'price')->first();

        if ($order_detials->status == 3) {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 6]);
                return redirect('/')->with('failed', 'Transaction is Canceled ! Please try again later'); 
        } else if ($order_detials->status == 3 || $order_detials->status == 1) {
            return redirect('/')->with('success', 'Transaction is already Successful.'); 
        } else {
            return redirect('/')->with('failed', 'Invalid Transaction! Please try again later'); 
        }


    }
	
	
	
	public function ipn(Request $request){
		
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');
			
            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('con_orders')
                ->where('transaction_id', $tran_id)
				->select('transaction_id', 'status', 'price')->first();

            if ($order_details->status == 3) {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($tran_id, $order_details->price, 'BDT', $request->all());
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('con_orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 1]);

                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('con_orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 5]);
                }
            }
			
		   //Insert IPN
			DB::table('con_ipn')->insert([
				'amount' => $request->input('amount'),
				'bank_tran_id' => $request->input('bank_tran_id'),
				'card_brand' => $request->input('card_brand'),
				'card_issuer' => $request->input('card_issuer'),
				'card_issuer_country' => $request->input('card_issuer_country'),
				'card_issuer_country_code' => $request->input('card_issuer_country_code'),
				'card_no' => $request->input('card_no'),
				'card_type' => $request->input('card_type'),
				'status' => $request->input('status'),
				'store_amount' => $request->input('store_amount'),
				'store_id' => $request->input('store_id'),
				'tran_date' => $request->input('tran_date'),
				'tran_id' => $request->input('tran_id'),
				'verify_sign' => $request->input('verify_sign'),
			]);	
			
			
			
			
        }
    }
    
  
    

}
