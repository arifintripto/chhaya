<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Reports;
use App\Models\Insurancepackage;
use App\Models\Settings;
use App\Models\Insurancetypes;
use App\Models\Insuranceplans;
use App\Models\Periods;
use App\Models\Insurancesubscriptions;
use Validator, Input, Redirect ;
use App\User;

class BkashPaymentController extends Controller{
    
    public function createpayment(Request $request){
        session_start();
        $array = $this->_get_config_file();
		$package_id = $request->package_id;
        $packages = Insurancepackage::find($package_id);

        if(empty($packages)){
            // return redirect()->back();
        }

        $prices = unserialize($packages->family_pricing);
        $p = 0;

        foreach($prices as $price){
            if($price['number_of_people'] == $request->number_of_people){
            $p = $price['price'];
            }
        }

        $tx_id = uniqid();
        $amount = $p;

        $order = new Insurancesubscriptions();
        $order->package_id = $package_id;
        $order->created_at = date("Y-m-d H:i:s");
        $order->updated_at = date("Y-m-d H:i:s");
        $order->number_of_people = $request->number_of_people;
        $order->nominee = serialize($request->nominee);
        $order->transaction_id = $tx_id;
        $order->price = $p;

    	$rules_for_nominee = array(
            'name'        	=>'required|string',
            'age'        	=>'required|numeric|min:1',
            'relationship'  =>'required|in:father,mother,husband,wife,son,daughter',
            'mobile'        =>'nullable|min:11|max:11'
        );

        //Nominee Information Validate
        $validator_for_nominee = Validator::make($request->nominee, $rules_for_nominee);
        if (!$validator_for_nominee->passes()) {
           // return Redirect::back()->withErrors($validator_for_nominee);
        }

		if (User::where('username', $request->input('username'))->exists()) {
           //User already exists we just save the order
		   $order->entry_by = User::where('username', $request->input('username'))->first()->id;
        }else{
			//Validation Rules for basic info, We will create new user
		   $rules = array(
                'username'        =>'required|min:11|max:11',
                'fullname'        =>'required|string',
                'date_of_birth'   =>'required|date|before:today',
                'division'        =>'numeric|required',
                'district'        =>'numeric|required',
                'gender'          =>'required|in:male,female,other',
				'email'			  =>'nullable|email',
				'address'		  =>'nullable|string',
				'password' 		  => 'min:6|required_with:password_confirmation|same:password_confirmation',
				'password_confirmation' => 'min:6',
                'number_of_people'=>'required|numeric',
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
                $authen->agent_id = null;
                $authen->password = \Hash::make(trim($request->input('password')));
                $authen->active = 1;
                $authen->save(); //Creating new user
                $order->entry_by = $authen->id;

            }else{
				//return Redirect::back()->withErrors($validator);
            }

        }

        $order->status = 3;
        $data = $request->input();


		if(isset($data['fm_fullname'])){
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
		}
        $order->save(); //Saving the order as pending status
		$order_id = $order->id;

		//Save Data for Reports Table
		$report = new Reports();
		$report->package_id = $package_id;
		$report->order_id = $order_id;
		$report->price = $amount;
		$report->user_id = $order->entry_by;
		$report->agent_id = 0;
		$report->agent_division = 0;
		$report->agent_district = 0;
		$report->customer_type = 1; //B2C
		$report->head_of_sales = 0;
		$report->regional_manager = 0;
		$report->sales_manager = 0;
		$report->area_manager = 0;
		$report->teritory_manager = 0;
		$report->agent_hierarchy_level = 0;
		$report->created_at = date('Y-m-d h:i:s');
		$report->updated_at = date('Y-m-d h:i:s');
		$report->status = 3;
		$report->save();


        $createpaybody = array('amount' => $amount, 'currency' => 'BDT', 'merchantInvoiceNumber' => $tx_id, 'intent' => 'sale');
        $url = curl_init($array["createURL"]);

        $createpaybodyx = json_encode($createpaybody);

        $header = array(
            'Content-Type:application/json',
            'authorization:' . $_SESSION['token'],
            'x-app-key:' . env('BKASH_APP_KEY', '')
        );
		
		//$x = 'Body: '.$createpaybodyx .'<br> Header: '.json_encode($header);
        //File::put(public_path('concave/createpayment.json'), $x);

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $createpaybodyx);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($url, CURLOPT_CONNECTTIMEOUT, 30);
        $resultdata = curl_exec($url);
        curl_close($url);
        echo $resultdata;
    }

    public function executepayment(){
        session_start();
        $array = $this->_get_config_file();
        $paymentID = $_GET['paymentID'];
        $url = curl_init($array["executeURL"] . $paymentID);
        $header = array(
            'Content-Type:application/json',
            'authorization:' . $_SESSION['token'],
            'x-app-key:' . env('BKASH_APP_KEY', '')
        );
		
		//$x = 'Header: '.json_encode($header);
       // File::put(public_path('concave/executepayment.json'), $x);
		
		
        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($url, CURLOPT_TIMEOUT, 30);
        $resultdatax = curl_exec($url);
		
		if ($error_number = curl_errno($url)) {
			if (in_array($error_number, array(CURLE_OPERATION_TIMEDOUT, CURLE_OPERATION_TIMEOUTED))) {
				$resultdatax = $this->querypayment($paymentID);
				$this->_updateOrderStatus($resultdatax);
				echo $resultdatax;
			}
		}else{
			$this->_updateOrderStatus($resultdatax);
			echo $resultdatax;
		}
		
        curl_close($url);
		
    }



    //Common Functions

    public function token(){
        session_start();
        $request_token = $this->_bkash_Get_Token();
        $idtoken = $request_token['id_token'];
        $_SESSION['token'] = $idtoken;
		
		if( !isset($_SESSION['timeout']) ){
			$_SESSION['timeout'] = time() + 300; 
		}
		
		//$x = 'id_token: '.$idtoken .'<br> refresh_token: '.$request_token['refresh_token'];
		//File::put(public_path('concave/api_token.json'), $x);
    }
	
	protected function _validate_session(){
		$response = false;
		session_start();
		$session_life = time() - $_SESSION['timeout'];
		if($session_life > 10){
			session_destroy(); 
		}else{
			$response = true;
		}
		return $response;
		
	}

    protected function _bkash_Get_Token(){
        $array = $this->_get_config_file();
        $post_token = array(
            'app_key' => env('BKASH_APP_KEY', ''),
            'app_secret' => env('BKASH_APP_SECRET', '')
        );

        $url = curl_init($array["tokenURL"]);
        $proxy = $array["proxy"];
        $posttoken = json_encode($post_token);
        $header = array(
            'Content-Type:application/json',
            'password:' . env('BKASH_PASSWORD', ''),
            'username:' . env('BKASH_USERNAME', ''),
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $posttoken);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($url, CURLOPT_CONNECTTIMEOUT, 30);
        $resultdata = curl_exec($url);
        curl_close($url);
        return json_decode($resultdata, true);
    }

    protected function _get_config_file(){
        $path = public_path('concave/config.json');
        return json_decode(file_get_contents($path), true);
    }


    protected function _updateOrderStatus($resultdatax){
        $resultdatax = json_decode($resultdatax);
        if(isset($resultdatax->paymentID)){

            if ($resultdatax && $resultdatax->paymentID != null) {
                $data['amount'] =  $resultdatax->amount;
                $data['currency'] =  $resultdatax->currency;
                $data['invoice_number'] =  $resultdatax->merchantInvoiceNumber;
                $data['intent'] =  $resultdatax->intent;
                $data['payment_id'] =  $resultdatax->paymentID;
                $data['trxID'] =  $resultdatax->trxID;
                $data['status'] =  $resultdatax->transactionStatus;
                $timestamp = substr($resultdatax->updateTime,0,19);   
                $dateTime = date_format(date_create($timestamp),'Y-m-d H:i:s');
                $mysqlFormatedDateTime =  date('Y-m-d H:i:s', strtotime($dateTime)+21600); //DateTime response was in GMT+0000 that's why we add 6 hours 
                $data['created_at'] = $mysqlFormatedDateTime;
                $data['updated_at'] = $mysqlFormatedDateTime;
                DB::table('con_bkash_response')->insert($data);

                if($resultdatax->transactionStatus == 'Completed'){
					$tx_id = $resultdatax->merchantInvoiceNumber;
					$amount = $resultdatax->amount;
					
					$update_product = \DB::table('con_orders')
                    ->where('transaction_id', $tx_id)
                    ->update([
                        'status' => 1,
                        'price' => $amount
                        ]);

					$order = \DB::table('con_orders')->where('transaction_id', $tx_id)->first();
					$user_id = $order->entry_by;
					
					//Auto login
					if(!\Auth::check()){
						\Auth::loginUsingId($user_id, true);
					}

					// Update Report Data
					\DB::table('con_reports')
                    ->where('order_id', $order->id)
                    ->update(['status' => 1]);

					$package_id = $order->package_id;
					$packageName = Insurancepackage::find($package_id)->title;
					$mobile = User::find($user_id)->username;

					if(!is_null(User::find($user_id)->temp_pass)){
						$temporaryPassword = base64_decode(User::find($user_id)->temp_pass);
						$message = 'Congratulations! You have successfully purchased '.$packageName.' from chhaya.xyz. Use this '.$temporaryPassword.' code as temporary password to login. This code will expire within next 72 hours.';
					}else{
						$message = 'Congratulations! You have successfully purchased '.$packageName.' from chhaya.xyz. Please login to your dashboard for further details.';
					}
					$this->sendMessage($mobile,$message,0);
                }else{
                   // DB::table('con_payments')->where('id',$paymentTableData->id)->update(['status'=>7]); //Set status to failed
                }
            }
        }

    }
	
	 public function querypayment($paymentID){
        session_start();
        $array = $this->_get_config_file();
        $url = curl_init($array["queryURL"] . $paymentID);

        $header = array(
            'Content-Type:application/json',
            'authorization:' . $_SESSION['token'],
            'x-app-key:' . env('BKASH_APP_KEY', '')
        );


        $x = 'Header: '.json_encode($header);
        File::put(public_path('concave/querypayment.json'), $x);

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($url, CURLOPT_CONNECTTIMEOUT, 30);
        $resultdatax = curl_exec($url);
        curl_close($url);
       
        echo $resultdatax;
        exit;
    }

    public function searchpayment(Request $request){
		
		if(!$this->_validate_session()){
			$this->token();
		}
		
        $array = $this->_get_config_file();
        $trxID = $request->transaction_id;
        $url = curl_init($array["searchURL"] . $trxID);

        $header = array(
            'Content-Type:application/json',
            'authorization:' . $_SESSION['token'],
            'x-app-key:' . env('BKASH_APP_KEY', '')
        );


        $x = 'Header: '.json_encode($header);
        File::put(public_path('concave/searchpayment.json'), $x);

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($url, CURLOPT_CONNECTTIMEOUT, 30);
        $resultdatax = curl_exec($url);
        curl_close($url);
       
        echo $resultdatax;
        exit;
    }
	
	
	public static function sendMessage($mobile,$message,$masking = 0 ){
		$apiKey = 'J8HZyp82oe7DHoIA';
		$secretkey = 'e4650abf';
		if($masking == 0){ $senderId = '8809612448803';}else{$senderId = 'Chhaya.xyz';}
		$query = http_build_query(array('apikey'=>$apiKey, 'secretkey'=>$secretkey,'callerID'=>$senderId, 'toUser'=>'88'.$mobile,'messageContent'=>$message));
		$url = "http://smpp.ajuratech.com:7788/sendtext?" . $query;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_exec($ch);
		curl_close ($ch);
	}
}