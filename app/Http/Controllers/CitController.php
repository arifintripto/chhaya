<?php
namespace App\Http\Controllers;
use App\Models\sliders;
use Illuminate\Http\Request;
use App\Models\Cit;
use App\Models\Productinformation;
use App\Models\Category;
use App\Models\Reports;
use App\Models\Insurancepackage;
use App\Models\Settings;
use App\Models\Periods;
use App\Models\Insurancetypes;
use App\Models\Insuranceplans;
use App\Models\Insurancesubscriptions;
use smasif\ShurjopayLaravelPackage\ShurjopayService;
use Validator, Input, Redirect ;
use App\User;
use Mail;
use DB;
use PDF;


class CitController extends Controller{
	
	public function generate_card(){
        if(\Auth::check()){
            $user = \Auth::user();
            $user_id = $user->id;
            $subscriptions = Insurancesubscriptions::where('entry_by',$user_id)->get();
            if($subscriptions){
                $package_data = [];
                foreach($subscriptions as $s){
                    $package_id = $s->package_id;
                    $package = Insurancepackage::find($package_id);
                    $duration_id = $package->package_duration;
                    $duration = Periods::find($duration_id);
                    $days =  $duration->number_of_days;
                    $created_at = $s->created_at ;
                    $expire_date = date('Y-m-d',strtotime('+'.$days.' day', strtotime($created_at)));
                    $package_data[$package_id] = [
                        'title' => $package->title,
                        'expire_date' => $expire_date
                        ];
                }
                
                $data['name'] = $user->first_name;
                $data['mobile'] = $user->username;
                $data['package'] = $package_data;
                if(count($package_data) > 0 ){
                    $pdf = PDF::loadView('pdf.membership', $data);
    		        return $pdf->download('membership_card.pdf');
                }

            }

        }else{
            return redirect('/');
        }
    }

	public function product($slug ){
	    $tableData = [];
		$product = Productinformation::where('slug',$slug)->where('status',1)->first();
		
		$slider = sliders::where('product_id', $product->id)->first();
        $settings = Settings::orderBy('id','desc')->first();
		
		if(!$product) return redirect('/');
		$package_ids = explode(',',$product->packages);
		$packages = [];
		foreach($package_ids as $id){
			
			if($id == 1){return view('layouts.default.template.contact2', compact('product', 'settings', 'slider'));} //Redirect to contact 2 page
			
			$packages[] =Insurancepackage::find($id);
			
		}
		return view('layouts.default.product.view',compact('product','packages'));
	}
	
	public function package($id){
		$package = Insurancepackage::find(base64_decode($id));
		return view('layouts.default.product.package_details',compact('package'));
	}
	

	public function product_list(){
		$product = Productinformation::where('status',1)->get();
		if(count($products) > 0){
			return view('layouts.default.product.index',compact('products'));
		}else{
			return back();
		}

	}


	public function getPackageById($id){
		$packages = Insurancepackage::find($id);
	    $prices = unserialize($packages->family_pricing);
		$html = '';
	    $html .= '<input type="hidden" name="package_id" value="'.$id.'">';
	    $html .= '<select id="person_picker" name="number_of_people" class="form-control" required><option value="-1" disabled selected>-- Select Number of Person --</option>';
	    foreach($prices as $price){
	        if($price['price'] != NULL){
	            $html .= '<option  data-price="'.$price['price'].'" value="'.$price['number_of_people'].'">Package for '.$price['number_of_people'].' Person @ Taka '.$price['price'].' Only</option>';
	        }
	    }
	    $html .= '</select>';
		return $html;
	}

	public function getInsuranceById($id){
	    $packages = Insurancepackage::find($id);
		$html = '';
		$html.= '<option selected disabled>-- Select Insurance --</option>';
	    foreach(explode(',',$packages->insurance_type) as $ins_id){
	        $insurance = Insuranceplans::find($ins_id);
			if($insurance->claim_amount){
				//$insuranceTypeTitle = Insurancetypes::find(Insuranceplans::find($ins_id)->insurance_type);
				$html.= '<option value="'.$insurance->id.'">'.$insurance->title.'</option>';
			}
	    }
	    echo $html;
	}

	public function getinsurancehiddenfieldsById($id){
		$insurance = Insuranceplans::find($id);
		echo json_encode(explode(',',$insurance->hidden_fields));
	}

	public function getInsuranceTypeById($id){
		$result = '';
		$insurance = Insuranceplans::find($id);
		//$typeId = $insurance->insurance_type;
		//$insuranceType = Insurancetypes::find($typeId);
		//$result = $insuranceType->required_doccuments;
		$result = $insurance->required_doccuments;
		echo $result;
	}



	public function getdistrict($division_id){
		$divisions = DB::table('con_district')->where('division_id',$division_id)->get();
		echo '<option selected disabled value="-1">-- Select District --</option>';
	    foreach($divisions as $division){
	            echo '<option value='.$division->id.'>'.$division->title.'</option>';
	    }
	}



	public function categories_list($slug){
		if(!is_null($category = Category::where('slug',$slug)->first())){
			$title = $category->title;
			$products = $category->products;
			return view('layouts.default.category.index',compact('category','products','title'));
		}else{
			return back();
		}
	}

	public function faqs(){
		$title ='FAQ';
		return view('layouts.default.pages.faqs',compact('title'));
	}

	public function career(){
		$title ='Career';
		return view('layouts.default.pages.career',compact('title'));
	}
	public function partners(){
		$title ='Our Partners';
		return view('layouts.default.pages.partners',compact('title'));
	}
	public function team(){
		$title ='Our Team';
		return view('layouts.default.pages.team',compact('title'));
	}

	public function checkout($id){
		$title ='Checkout';
		$user = [];
		if(\Auth::check()){
		  $user_id =  \Auth::id();
		  $user = User::find($user_id);
		}
		$packagehtml = $this->getPackageById(base64_decode($id));
		return view('layouts.default.product.checkout',compact('title','packagehtml','user'));
	}

	public function isOtpLimitExcceds($mobileNumber){
		//Return true if exceeds
		$res = false;
		$olderData = DB::table('con_otp')->where('mobile_number',$mobileNumber)->whereDate('created_at', date('Y-m-d'))->get();
		if(count($olderData) > 4 ){
			$res = true;
		}
		return $res;
	}


	//OTP Generator
	public function generateOTP(Request $request){

		$mobileNumber = trim($request->input('mobile_number'));
		if(strlen($mobileNumber) != 11){
			echo 99;
			exit;
		}

		if($request->input('form_type') == 1){
			$user = DB::table('tb_users')->where('username',$mobileNumber)->first();
			if(!$user){
				 echo 99;
				 exit;
			}
		}


		if(!$this->isOtpLimitExcceds($mobileNumber)){
				$masking = $request->input('masking');
				$apiKey = 'J8HZyp82oe7DHoIA';
				$secretkey = 'e4650abf';
				$otp = mt_rand(100000, 999999);
				if($masking == 0){ $senderId = '8809612448803';}else{$senderId = 'Chhaya.xyz';}

				$query = http_build_query(array('apikey'=>$apiKey, 'secretkey'=>$secretkey,'callerID'=>$senderId, 'toUser'=>'88'.$mobileNumber,'messageContent'=>'Your Chhaya verification code is '.$otp.'. This code will expire in 5 minutes. Please do not share your OTP with others. '));
				$url = "http://smpp.ajuratech.com:7788/sendtext?" . $query;

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_POST, 0);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				$result = curl_exec($ch);
				curl_close ($ch);

     			//$result = '{"Status":"0","Text":"ACCEPTD","Message_ID":"1303624"}';

				$smsData = json_decode($result);
				$status = $smsData->Status;
				$text = $smsData->Text;
				$message_id = $smsData->Message_ID;
					$dataHistory = [
						'mobile_number' => $mobileNumber,
						'status'	=> $status,
						'text' => $text,
						'message_id' => $message_id,
						'delivery_time'	=> null
					];
					DB::table('con_otp_response_history')->insert($dataHistory);  //Insert OTP  LOG

				if($status == 0){ //OTP Success
					$data = [
						'mobile_number' => $mobileNumber,
						'otp_code'	=> $otp,
						'created_at' => date('Y-m-d H:i:s'),
						'status'	=> 0,
						'message_id' => $message_id,
						'otp_hash'	=> null

					];

					$updated = DB::table('con_otp')->insert($data);  //Insert OTP
					if($updated){echo 1;}
				}else{
					echo 0;
				}
			}else{
				 echo 2;
			}
    }

	public function verifyOTP(Request $request){
		$mobileNumber = $request->input('mobile_number');
		$otp =  $request->input('otp_code');
		$res = 0;
		$otpData = DB::table('con_otp')->where('mobile_number',$mobileNumber)->where('otp_code',$otp)->orderby('id','desc')->first();
		if($otpData){
			$otptime = $otpData->created_at;
			$currentTime = date('Y-m-d H:i:s');
			$to_time = strtotime($currentTime);
			$from_time = strtotime($otptime);
			$muniteDiff =  round(abs($to_time - $from_time) / 60,2);
			if($muniteDiff < 5){ //5 Min Validity
				$res = 1;
			}else{
				$res = 2;
			}
		}
		return $res;
	}


	//Reset Password

	public function reset_password(Request $request){
		$mobileNumber = $request->input('mobile_number');
		$otp =  $request->input('otp_code');
		$res['response_code'] = 0; //Invalid otp
		$otpData = DB::table('con_otp')->where('mobile_number',$mobileNumber)->where('otp_code',$otp)->orderby('id','desc')->first();
		$last_otp_id = $otpData->id;
		if($otpData){
			$otptime = $otpData->created_at;
			$currentTime = date('Y-m-d H:i:s');
			$to_time = strtotime($currentTime);
			$from_time = strtotime($otptime);
			$muniteDiff =  round(abs($to_time - $from_time) / 60,2);
			if($muniteDiff < 5){
				$otp_hash = mt_rand(10000000,99999999);
				$otpSingleData = DB::table('con_otp')->where('id',$last_otp_id)->update(['otp_hash' => $otp_hash]);
				$res['response_code'] = 3;
				$res['response_hash'] = base64_encode($otp_hash);
				// OTP verified.  Reset password option will show here
			}else{
				$res['response_code'] = 2; //Expired OTP
			}
		}
		echo json_encode($res);
	}


	//Finally rest the password
	public function reset_password_confirmation(Request $request){
		$mobileNumber = $request->input('mobile_number');
		$password =  \Hash::make($request->input('password'));
		$res = 0;
		$response_hash =  base64_decode($request->input('response_hash'));
		$otpData = DB::table('con_otp')->where('mobile_number',$mobileNumber)->where('otp_hash',$response_hash)->orderby('id','desc')->first();
		if($otpData){
			$otptime = $otpData->created_at;
			$currentTime = date('Y-m-d H:i:s');
			$to_time = strtotime($currentTime);
			$from_time = strtotime($otptime);
			$muniteDiff =  round(abs($to_time - $from_time) / 60,2);
			if($muniteDiff < 10 ){ //We will accecpt 10 min for rest password
				DB::table('tb_users')->where('username',$mobileNumber)->update(['password' => $password,'temp_pass' => null]);
				$res = 1;
				// Password has reseted
			}else{
				$res = 2; //Time Expired
			}
		}
		echo json_encode($res);
	}



	//Payment from Frontend
	public function payment(Request $request){
        $package_id = $request->package_id;
        $packages = Insurancepackage::find($package_id);

        if(empty($packages)){
             return redirect()->back();
        }

        $prices = unserialize($packages->family_pricing);
        $p = 0;

        foreach($prices as $price){
            if($price['number_of_people'] == $request->number_of_people){
            $p = $price['price'];
            }
        }

        $shurjopay_service = new ShurjopayService();
        $tx_id = $shurjopay_service->generateTxId();
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
            return Redirect::back()->withErrors($validator_for_nominee);
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
				'nid'			  =>'nullable',
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
				$authen->nid = trim($request->input('nid'));
                $authen->group_id = 7;
                $authen->agent_id = null;
                $authen->password = \Hash::make(trim($request->input('password')));
                $authen->active = 1;
                $authen->save(); //Creating new user
                $order->entry_by = $authen->id;

            }else{
				return Redirect::back()->withErrors($validator);
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
        $shurjopay_service->sendPayment($amount); //Redirect to Surjopay
	}


	//Payment From Agent
	public function payment_agent(Request $request){

        $package_id = $request->package_id;
        $packages = Insurancepackage::find($package_id);

		// Validate Package, it can't be empty
        if(empty($packages)){
             return redirect()->back();
        }

        $prices = unserialize($packages->family_pricing);
        $p = 0;

        foreach($prices as $price){
            if($price['number_of_people'] == $request->number_of_people){
				$p = $price['price'];
            }
        }

        $shurjopay_service = new ShurjopayService();
        $tx_id = $shurjopay_service->generateTxId();
        $amount = $p;


        $order = new Insurancesubscriptions();
        $order->package_id = $package_id;
        $order->created_at = date("Y-m-d H:i:s");
        $order->updated_at = date("Y-m-d H:i:s");
        $order->number_of_people = $request->number_of_people;
        $order->nominee = serialize($request->nominee); //Nominee Data
        $order->transaction_id = $tx_id;
		$order->agent_id = \Auth::id();
        $order->price = $p;

		 //Validation Rules for nominee
    	$rules_for_nominee = array(
            'name'       	=>'required',
            'age'        	=>'required',
            'relationship'  =>'required|in:father,mother,husband,wife,son,daughter',
            'mobile'        =>'nullable|min:11|max:11',
        );

        $validator_for_nominee = Validator::make($request->nominee, $rules_for_nominee);
        if (!$validator_for_nominee->passes()) {
            return Redirect::back()->withErrors($validator_for_nominee);
        }

		if (User::where('username', $request->input('username'))->exists()) {

           //User already exists, we just save the order
		   $order->entry_by = User::where('username', $request->input('username'))->first()->id;

        }else{ //We will create new user here

			//Validation Rules for inputs
		   $rules = array(
                'username'        =>'required|min:11|max:11|unique:tb_users',
                'fullname'        =>'required|string',
                'date_of_birth'   =>'required|date|before:today',
                'division'        =>'numeric|required',
                'district'        =>'numeric|required',
                'gender'          =>'required|in:male,female,other',
				'email'			  =>'nullable|email',
				'address'		  =>'nullable|string',
                'number_of_people'=>'required',
				'nid'			  =>'nullable',
            );

			$validator = Validator::make($request->all(), $rules);


            if ($validator->passes()) {
                $authen = new User;
				$password = mt_rand(1000000, 9999999);
                $authen->username = $request->input('username');
                $authen->first_name = $request->input('fullname');
                $authen->email = trim($request->input('email'));
                $authen->city = trim($request->input('district'));
                $authen->state = trim($request->input('division'));
                $authen->address_1 = trim($request->input('address'));
                $authen->birth_of_day = trim($request->input('date_of_birth'));
				$authen->nid = trim($request->input('nid'));
                $authen->group_id = 7;
				$authen->temp_pass = base64_encode($password);
                $authen->password = \Hash::make($password);
                $authen->active = 1;
                $authen->save(); //User Created
				$order->entry_by = $authen->id;
				$order->agent_id = \Auth::id();
            }else{
				return Redirect::back()->withErrors($validator);
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
        $order->save();
		$order_id = $order->id;

		//Save Data for Reports Table
		$agent_id = \Auth::id();
		$agent = User::find($agent_id );

		$hierarchyData = $this->getHierarchyData($agent_id);
		$report = new Reports();
		$report->package_id = $package_id;
		$report->order_id = $order_id;
		$report->price = $amount;
		$report->user_id = $order->entry_by;
		$report->agent_id = \Auth::id();
		$report->agent_division = $agent->state;
		$report->agent_district = $agent->city;
		$report->customer_type = 1; //B2C
		$report->head_of_sales = ($hierarchyData->head_of_sales) ? $hierarchyData->head_of_sales :0;
		$report->regional_manager = ($hierarchyData->regional_manager) ? $hierarchyData->regional_manager : 0;
		$report->sales_manager = ($hierarchyData->sales_manager) ? $hierarchyData->sales_manager : 0;
		$report->area_manager = ($hierarchyData->area_manager) ? $hierarchyData->area_manager : 0;
		$report->teritory_manager = ($hierarchyData->teritory_manager) ? $hierarchyData->teritory_manager : 0;
		$report->agent_hierarchy_level = (is_null($agent->hierarchy_level)) ? 0 : $agent->hierarchy_level;
		$report->created_at = date('Y-m-d h:i:s');
		$report->updated_at = date('Y-m-d h:i:s');
		$report->status = 3;
		$report->save();

        $shurjopay_service->sendPayment($amount);
	}

	public function getHierarchyData($agent_id){
		$agentData = DB::table('con_hierarchy_history')->where('user_id',$agent_id)->orderby('id','desc')->get();
		if($agentData){
			$agentData = $agentData[0];
		}
		return $agentData;
	}


	//Payment Response from Surjo pay
	public function response(Request $request){
        $server_url = config('shurjopay.server_url');
        $response_encrypted = $request->spdata;
        $response_decrypted = file_get_contents($server_url . "/merchant/decrypt.php?data=" . $response_encrypted);
        $data = simplexml_load_string($response_decrypted) or die("Error: Cannot create object");
        $tx_id = $data->txID;
        $bank_tx_id = $data->bankTxID;
        $amount = $data->txnAmount;
        $bank_status = $data->bankTxStatus;
        $sp_code = $data->spCode;
        $sp_code_des = $data->spCodeDes;
        $sp_payment_option = $data->paymentOption;
        \DB::table('con_ipn')->insert([
			'txID' => $data->txID,
			'bankTxID' => $data->bankTxID,
			'bankTxStatus' => $data->bankTxStatus,
			'txnAmount' => $data->txnAmount,
			'spCode' => $data->spCode,
			'spCodeDes' => $data->spCodeDes,
			'paymentOption' => $data->paymentOption
		]);

        switch ($sp_code) {
            case '000':
			//Success code 000
				$update_product = \DB::table('con_orders')
                    ->where('transaction_id', $tx_id)
                    ->update([
                        'status' => 1,
                        'price' => $amount
                        ]);

					$order = \DB::table('con_orders')->where('transaction_id', $tx_id)->first();
					$user_id = $order->entry_by;


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
					return redirect('/dashboard')->with('status', 'success')->with('message','Transaction is successfully Completed.');
            break;
            case '001':
                // Failed code 001
				 $update_product = \DB::table('con_orders')
                    ->where('transaction_id', $tx_id)
                    ->update(['status' => 5]);

				 // Update Report Data
					$order = \DB::table('con_orders')->where('transaction_id', $tx_id)->first();
				 	\DB::table('con_reports')
                    ->where('order_id', ($order->id))
                    ->update(['status' => 5]);

				if(\Auth::check()){
					return redirect('/dashboard')->with('status', 'error')->with('message','Transaction Failed! Please try again later');
				}else{
					return redirect('/failed/'.$tx_id)->with('failed', 'Transaction Failed! Please try again later');
				}
            break;
        }

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


	public function failed($tx_id){
		if(!\DB::table('con_orders')->where('transaction_id', $tx_id)->first()) return redirect('/');
		$title = 'Failed';
		if($tx_id){
			return view('layouts.default.product.failed',compact('title','tx_id'));
		}else{
			return redirect()->back();
		}

	}


	public function phone(Request $request){
	    $user = $request->phone;
        if (User::where('username', $user)->exists()) {
            echo 0;
        }else{
             echo 1;
        }
	}

	public function change_profile_picture(Request $request){
		if(\Auth::check()){

			if(!is_null($request->file('avatar'))){
				$user = User::find(\Auth::id());
				$file = $request->file('avatar');
				$destinationPath = './uploads/users/';
				$filename = $file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension(); //if you need extension of the file
				$newfilename = \Session::get('uid').'.'.$extension;
				$uploadSuccess = $request->file('avatar')->move($destinationPath, $newfilename);
				if( $uploadSuccess ) {
				    $user ->avatar = $newfilename;
					$user->save();
				}
				$orgFile = $destinationPath.'/'.$newfilename;
				\SiteHelpers::cropImage('80' , '80' , $orgFile ,  $extension,	 $orgFile)	;
				return redirect('user/profile')->with('message','Profile Picture has been changed!')->with('status','success');
			}



		}else{
			return redirect()->back();
		}
	}
	
	
		public function get_user(Request $request){
		$requested_level = $request->hierarchy_level;
		$hierarchy_level = \Auth::user()->hierarchy_level;

		$levels = [
			1 => 'head_of_sales',
			2  => 'regional_manager',
			3 => 'sales_manager',
			4 => 'area_manager',
			5 => 'teritory_manager',
			6 => 'agent_id',

		];

		$requested_level = $levels[$requested_level];
		$column_title	 = $levels[$hierarchy_level];
		
		$users = DB::table('con_reports')->where($requested_level,'!=',0)->where($column_title,\Auth::id())->groupby($requested_level)->get();

		$result = '<option disabled selected >-- Select Hierarchy First--</option>';
	    foreach($users as $u){
			$user = \App\Models\Core\Users::find($u->$requested_level);
			if($user){
				$result .=  '<option value='.$user->id.'>'.$user->first_name.'('.\Helper::getAgentMeta($user->id,"agent_serial").')</option>';
			}
			
		}
		echo $result;
	}

}

?>
