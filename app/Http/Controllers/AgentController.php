<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator, Input, Redirect ;
use App\User;
use Mail;
use DB;
use Session;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent;

class AgentController extends Controller{
    
    public function createAgent(Request $request){
		
		$hLevel = \Auth::user()->hierarchy_level;
		$hierarchy_level_id = $request->hierarchy_level;
		$disabled_levels = \DB::table('con_settings')->where('id',1)->first();
		$disabled_levelsArray = explode(',',$disabled_levels);
		if(in_array($hLevel,$disabled_levelsArray)){
			return redirect('dashboard')->with('message', 'You are not allowed to create sales team!')->with('status','error');
		}
		
		if($hLevel > 5 || $hLevel > $hierarchy_level_id ){
			return redirect('dashboard')->with('message', 'You are not allowed to acces this page!')->with('status','error');	
		}
	
		$user_id = $request->input('id');
		if(is_null($user_id )){
			
			//Create new user here
			    $validatedData = $request->validate([
						'username'   			=>'required|min:11|max:11|unique:tb_users',
						'first_name' 			=> 'required',
						'email'      			=> 'nullable|email',
						'permanent_division_id' => 'numeric|required',
						'permanent_district_id' => 'numeric|required',
						'present_division_id'	=> 'numeric|required',
						'present_district_id'   => 'numeric|required',
						'father_name' 			=> 'required|string ',
						'mother_name' 			=> 'required|string',
						'birth_of_day' 			=> 'required|date|before:today',
						'nid_number'  			=> 'required|numeric',
						'hierarchy_level'		=> 'required|numeric|min:1|max:6',
						'gender'          		=> 'required|in:male,female,other',
						'avatar' 				=> 'nullable|image|mimes:jpg,jpeg,png',
						'head_of_sales'			=> ($hLevel > 1) ? 'required|numeric' : 'nullable',
						'regional_manager'		=> ($hLevel > 2) ? 'required|numeric' : 'nullable',
						'sales_manager'			=> ($hLevel > 3) ? 'required|numeric' : 'nullable',
						'area_manager'			=> ($hLevel > 4) ? 'required|numeric' : 'nullable',
						'teritory_manager'		=> ($hLevel > 5) ? 'required|numeric' : 'nullable',
					],
					
					[
					'username.unique' => 'Mobile number already exsists!',
					'username.max' => 'Mobile number must be at least 11 characters.!',
					'username.min' => 'Mobile number must be at least 11 characters.!',
					'avatar.image' => 'Invalid image format. Only jpg,jpeg and png files are allowed.'
					]
				);
					
					$newfilename = '';
					if(!is_null($request->file('avatar'))){
						$updates = array();
						$file = $request->file('avatar'); 
						$destinationPath = './uploads/users/';
						$filename = $file->getClientOriginalName();
						$extension = $file->getClientOriginalExtension(); //if you need extension of the file
						$newfilename = $id.'.'.$extension;
						$request->file('avatar')->move($destinationPath, $newfilename);				 
					}
					
					$agent_id = \Auth::id();
					if(\Auth::user()->group_id == 1 || \Auth::user()->group_id == 2){
						$agent_id = ($request->input('agent_id')) ? $request->input('agent_id') : $agent_id;
					}else{
						$agent_id = \Auth::id();
					}
					
					
					$basic_info = [];
					$basic_info['group_id']   = 5;
					$basic_info['hierarchy_level']   = $hierarchy_level_id;
					$basic_info['agent_id']   = $agent_id;
					$basic_info['username']   = $request->username;
					$basic_info['first_name'] = $request->first_name;
					$basic_info['email']      = $request->email;
					$basic_info['birth_of_day']   = $request->birth_of_day;
					$basic_info['active']     = $request->active;
					$basic_info['avatar']     = $newfilename;
					$basic_info['gender']     = $request->gender;
					$basic_info['state']     = $request->present_division_id;
					$basic_info['city']     = $request->present_district_id;
					$basic_info['address_1']     = $request->present_address;
					
					$mobile = $request->input('username');
					$password = mt_rand(1000000, 9999999);
					$temporaryPassword = base64_encode($password);
					$basic_info['password'] = Hash::make($password);
					$basic_info['temp_pass'] = $temporaryPassword;

					$hDataArry = [ 'Head of Sales','Regional Manager','Sales Manager','Area Manager','Teritory Manager','Agent'];
					$group_name = $hDataArry[$hierarchy_level_id+1];
				
					if($hierarchy_level_id == 4 || $hierarchy_level_id == 6){
						$articale_word = 'an';
					}else{
						$articale_word = 'a';
					}

					//Send Password to user
					$message = 'Congratulations '.$request->first_name.'! You are become '.$articale_word.' '.$group_name.' of Chhaya.xyz. Use this '.$password.' code as temporary password to login. This code will expire within next 72 hours.';
					\App\Http\Controllers\CitController::sendMessage($mobile,$message,0);
					$user_id = DB::table('tb_users')->insertGetId($basic_info);


					//insert to con_hierarchy_history
					$extended_info = [];
					$extended_info['user_id']         = $user_id;
					$extended_info['hierarchy_level'] = $hierarchy_level_id;
					$extended_info['head_of_sales']   = $request->head_of_sales;
					$extended_info['regional_manager']= $request->regional_manager;
					$extended_info['sales_manager']   = $request->sales_manager;
					$extended_info['area_manager']    = $request->area_manager;
					$extended_info['teritory_manager']= $request->teritory_manager;
				
					$hierarchy_history_ID = DB::table('con_hierarchy_history')->insertGetId($extended_info);

				   
				   	//insert to con_agent_meta
					$other_info = [];
				   	$other_info['present_division_id']     = $request->present_division_id;
					$other_info['present_district_id']     = $request->present_district_id;
					$other_info['present_address']     = $request->present_address;
					
					$other_info['permanent_division_id']     = $request->permanent_division_id;
					$other_info['permanent_district_id']     = $request->permanent_district_id;
					$other_info['permanent_address']     = $request->permanent_address;
					
					$other_info['father_name']  = $request->father_name;
					$other_info['mother_name']  = $request->mother_name;
					$other_info['nid_number']   = $request->nid_number;
					$other_info['user_id']      = $user_id;
					$other_info['hierarchy_history_id']= $hierarchy_history_ID;
					$other_info['agent_serial'] = 'ESL'.mt_rand(10000,99999);
					$other_info['status']       = $request->active;
					DB::table('con_agent_meta')->insert($other_info);
					
					Session::flash('success', "Account created successfully.");
					return Redirect::back();
					
		}else{
			//Edit exsisting user here with $user_id
			
				if($user_id == \Auth::id()){
					return redirect('dashboard')->with('message', 'You are not allowed to edit yourself!')->with('status','error');
				}
				
				if($request->input('password') != $request->input('password_confirmation')){
					return redirect()->back()->with('message', 'Password does not match!')->with('status','error');
				}
				
			
			    $validatedData = $request->validate([
						'username'   			=>'required|min:11|max:11',
						'first_name' 			=> 'required',
						'email'      			=> 'nullable|email',
						'permanent_division_id' => 'min:1|max:8|numeric|required',
						'permanent_district_id' => 'min:1:max:64|numeric|required',
						'present_division_id'	=> 'min:1|max:8|numeric|required',
						'present_district_id'   => 'min:1:max:64|numeric|required',
						'father_name' 			=> 'required|string ',
						'mother_name' 			=> 'required|string',
						'birth_of_day' 			=> 'required|date|before:today',
						'nid_number'  			=> 'required|numeric',
						'hierarchy_level'		=> 'required|numeric|min:1|max:6',
						'gender'          		=> 'required|in:male,female,other',
						'avatar' 				=> 'nullable|image|mimes:jpg,jpeg,png',
						'head_of_sales'			=> ($hLevel > 1) ? 'required|numeric' : 'nullable',
						'regional_manager'		=> ($hLevel > 2) ? 'required|numeric' : 'nullable',
						'sales_manager'			=> ($hLevel > 3) ? 'required|numeric' : 'nullable',
						'area_manager'			=> ($hLevel > 4) ? 'required|numeric' : 'nullable',
						'teritory_manager'		=> ($hLevel > 5) ? 'required|numeric' : 'nullable',
					],
					
					[
					'username.max' => 'Mobile number must be at least 11 characters.!',
					'username.min' => 'Mobile number must be at least 11 characters.!',
					]
				);
					
					//Update basic info
					$newfilename = '';
					if(!is_null($request->file('avatar'))){
						$updates = array();
						$file = $request->file('avatar'); 
						$destinationPath = './uploads/users/';
						$filename = $file->getClientOriginalName();
						$extension = $file->getClientOriginalExtension(); //if you need extension of the file
						$newfilename = $id.'.'.$extension;
						$request->file('avatar')->move($destinationPath, $newfilename);				 
					}
					
					$basic_info = [];
					$basic_info['group_id']   = 5;
					$basic_info['hierarchy_level']   = $hierarchy_level_id;
					$basic_info['agent_id']   = \Auth::id();
					//$basic_info['username']   = $request->username; mobile number can not change
					$basic_info['first_name'] = $request->first_name;
					$basic_info['email']      = $request->email;
					$basic_info['birth_of_day']   = $request->birth_of_day;
					$basic_info['active']     = $request->active;
					
					if(!empty($newfilename)){
						$basic_info['avatar'] = $newfilename;
					}
					
					$basic_info['gender']     = $request->gender;
					$basic_info['state']     = $request->present_division_id;
					$basic_info['city']     = $request->present_district_id;
					$basic_info['address_1']     = $request->present_address;
					DB::table('tb_users')->where('id',$user_id)->update($basic_info);


					//Insert to con_hierarchy_history
					$extended_info = [];
					$extended_info['user_id']         = $user_id;
					$extended_info['hierarchy_level'] = $hierarchy_level_id;
					$extended_info['head_of_sales']   = $request->head_of_sales;
					$extended_info['regional_manager']= $request->regional_manager;
					$extended_info['sales_manager']   = $request->sales_manager;
					$extended_info['area_manager']    = $request->area_manager;
					$extended_info['teritory_manager']= $request->teritory_manager;
				
					$hierarchy_history_ID = DB::table('con_hierarchy_history')->insertGetId($extended_info);

				   
				   	//Update to con_agent_meta
					$other_info = [];
				   	$other_info['present_division_id']     = $request->present_division_id;
					$other_info['present_district_id']     = $request->present_district_id;
					$other_info['present_address']     = $request->present_address;
					
					$other_info['permanent_division_id']     = $request->permanent_division_id;
					$other_info['permanent_district_id']     = $request->permanent_district_id;
					$other_info['permanent_address']     = $request->permanent_address;
					
					$other_info['father_name']  = $request->father_name;
					$other_info['mother_name']  = $request->mother_name;
					$other_info['nid_number']   = $request->nid_number;
					$other_info['user_id']      = $user_id;
					$other_info['hierarchy_history_id']= $hierarchy_history_ID;
					$other_info['status']       = $request->active;
					

					
					if(DB::table('con_agent_meta')->where('user_id',$user_id)->count() > 0){
						DB::table('con_agent_meta')->where('user_id',$user_id)->update($other_info);
					}else{
						$other_info['agent_serial'] = 'ESL'.mt_rand(10000,99999);
						DB::table('con_agent_meta')->insert($other_info);
					}
					
					Session::flash('success', "Account updated successfully.");
					return Redirect::back();
			
		
					
		}
    }
	
	
	public function get_hierarchy(Request $request){
		if(\Auth::check()){
			$level_id = $request->input('level_id');
			$selected_id = $request->input('selected_id');
			$child_level_name = $request->input('child_level_name');
			
			//get selected user
			$user = DB::table('tb_users')->where('id',$selected_id)->first();
			
			
			if($selected_id == 0){ // Zero is for skipping any level entry, That's why, when there is zero selected value we will load all
				$childUsers = DB::table('tb_users')->where('hierarchy_level',$level_id+1)->get();
			}else{
				//get child level under this user
				$childUsers = DB::table('tb_users')->where('hierarchy_level',$level_id+1)->where('agent_id',$selected_id)->get();
			}
			
			if($childUsers){
					echo '<option selected disabled value="-1">-- Select '.$child_level_name.' --</option>';
					echo '<option value="0">-- Skip This Level --</option>';
				foreach($childUsers as $child){
					echo '<option value="'.$child->id.'">'.$child->first_name.'('.$this->getAgentMeta($child->id,"agent_serial").')</option>';
				}
			}
		}
	}
	
	public static function getAgentMeta($user_id,$key){
		$user = DB::table('con_agent_meta')->where('user_id',$user_id)->first();
		return $user->$key;
	}
    

    
}?>