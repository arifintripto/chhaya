@extends('layouts.app')
@section('content')
@php $currentHierarchy_level = \Auth::user()->hierarchy_level; @endphp


<style>
.text-left, .control-label {padding: 0;}
.sales_info{display:none;} 
.hierarchy_level_tree{display:none;}
.radio_active ul {display: inline-table;}
</style>

<div class="page-header"><h2>  {{ $pageTitle }} <small> {{ $pageNote }} </small> </h2></div>

<div class="p-5" style="padding-top: 10px !important;">

<?php
$userData = \DB::table('con_agent_meta')->where('user_id',$row['id'])->first();
$hierarchyData = \DB::table('con_hierarchy_history')->where('user_id',$row['id'])->orderby('id','desc')->first();
if($userData){
	$mataData = (array) $userData;
	unset($mataData['id']);
	$row = array_merge($row,$mataData);
}

if($hierarchyData){
	$hData = (array) $hierarchyData;
	unset($hData['id']);
	$row = array_merge($row,$hData);		
}

 ?>

{!! Form::open(array('url'=>'core/users','id'=>'create_agent', 'class'=>'form-horizontal validated','files' => true )) !!}
<div class="row">
		<div class="col-md-6">
           @if(count($errors) > 0)
			   <ul class="parsley-error-list">
					@foreach($errors->all() as $error)
						<li style="font-size:14px;">{{ $error }}</li>
					@endforeach
				</ul>
			@endif
			
			
    	    @if (Session::has('error'))
               <div style="color:red;margin:15px;font-size: 24px;">{{ Session::get('error') }}</div>
            @endif
    	    @if (Session::has('success'))
               <div style="color:green;margin:15px;font-size: 24px;">{{ Session::get('success') }}</div>
            @endif
		    
			<fieldset>
				<legend> Basic Information </legend>
				  <div class="form-group hidethis " style="display:none;">
					<label for="Id" class=" control-label "> Id </label>
					<div class="">
					  {!! Form::text('id', $row['id'],array('class'=>'form-control input-sm', 'placeholder'=>'',   )) !!} 
					 </div> 
					 <div class="col-md-2">
					 	
					 </div>
				  </div> 					
				 
				@if(session('gid') != 5)
				 <div class="form-group" >
					<label for="Group / Level" class=" control-label "> Group / Level <span class="asterix" style="color:red"> * </span></label>
					<div class="">
					  <select name='group_id' rows='5' id='group_id' code='{$group_id}' class='form-control  input-sm'  required  ></select> 
					 </div> 
					 <div class="col-md-2"></div>
				  </div>
				@endif


				  <div class="form-group  " >
					<label for="Username" class=" control-label "> Mobile Number <span class="asterix" style="color:red"> * </span></label>
					<div class="">
					  {!! Form::text('username', $row['username'],array('class'=>'form-control  input-sm', 'placeholder'=>'', 'required'=>'true'  )) !!} 
					 </div> 
					 <div class="col-md-2">
					 	
					 </div>
				  </div> 					
				  <div class="form-group  " >
					<label for="First Name" class=" control-label "> Fullname <span class="asterix" style="color:red"> * </span></label>
					<div class="">
					  {!! Form::text('first_name', $row['first_name'],array('class'=>'form-control  input-sm', 'placeholder'=>'', 'required'=>'true'  )) !!} 
					 </div> 
					 <div class="col-md-2">
					 	
					 </div>
				  </div> 					

				  <div class="form-group" >
					<label for="Email" class=" control-label "> Email </span></label>
					<div class="">
					  {!! Form::text('email', $row['email'],array('class'=>'form-control  input-sm', 'placeholder'=>'', 'parsley-type'=>'email'   )) !!} 
					 </div> 
					 <div class="col-md-2">
					 	
					 </div>
				  </div> 
				  
				   <div class="form-group" >
					<label class="control-label "> Date of Birth <span class="asterix" style="color:red"> * </span></label>
					<div class="">
					  {!! Form::date('birth_of_day', $row['birth_of_day'],array('class'=>'form-control  input-sm txtDate', 'placeholder'=>'', 'required'=>'true'  )) !!} 
					 </div> 
					 <div class="col-md-2"></div>
				  </div> 
				  
				  
				@if(session('gid') != 5)
					<div class="hide_for_sales">
 						<div class="form-group">
							<label class="control-label" for="name">Division: <span class="asterix" style="color:red">*</span></label>
							<div class="">
								<select class="form-control" name="state" required="">
									<option disabled selected value="-1">-- Select Division --</option>
									<option @if($row['state'] == 7) selected @endif value="7">Dhaka</option>
									<option @if($row['state'] == 8) selected @endif  value="8">Khulna</option>
									<option @if($row['state'] == 2) selected @endif  value="2">Rajshahi</option>
									<option @if($row['state'] == 5) selected @endif  value="5">Chittagong</option>
									<option @if($row['state'] == 6) selected @endif  value="6">Barisal</option>
									<option @if($row['state'] == 1) selected @endif  value="1" >Rangpur</option>
									<option @if($row['state'] == 4) selected @endif  value="4">Sylhet</option>
									<option @if($row['state'] == 3) selected @endif  value="3">Mymensingh</option>
								</select>
						  </div>
						  <div class="col-md-2"></div>
						</div>

						<div class="form-group">
							<label class="control-label" for="name">District <span class="asterix" style="color:red">*</span></label>
							<div class="">
								<select class="form-control select_district" name="city" required>
									<option disabled selected value="-1">-- Select Division First --</option>
									@if($row['city'])
									 <option value="{{ $row['city'] }}" selected >{{ DB::table('con_district')->where('id',$row['city'])->first()->title }}</option>
									@endif
								</select>
						  </div>
						  <div class="col-md-2"></div>
						</div>
						
						<div class="form-group">
							<label class="control-label" for="name">Address<span class="asterix" style="color:red">*</span></label>
							<div class="">
								<textarea name="address_1" class="form-control" required>{{$row['address_1'] ?? ''}}</textarea>
						  </div>
						  <div class="col-md-2"></div>
						</div>
					</div>
				@endif

				@if(session('gid') < 3 && $row['id'] !='' )
				<fieldset>
					<legend> Password </legend>
						<p>{{ Lang::get('core.notepassword') }}</p>

					<div class="form-group">
						<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.newpassword') }} </label>
						<div class="col-md-8">
						<input name="password" type="password" id="password" class="form-control input-sm" value=""
						@if($row['id'] =='')
							required
						@endif
						 /> 
						 </div> 
					</div>  
					  
					  <div class="form-group">
						<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.conewpassword') }} </label>
						<div class="col-md-8">
						<input name="password_confirmation" type="password" id="password_confirmation" class="form-control input-sm" value=""
						@if($row['id'] =='')
							required
						@endif		
						 />  
						 </div> 
					  </div>  				  
					  
				</fieldset> 
				@endif
				  

				  <div class="form-group" >
					<label for="Status" class=" control-label "> Status <span class="asterix" style="color:red"> * </span></label>
					<div class="radio_active">
						<input type='radio' name='active' value ='1' required @if($row['active'] == '1') checked="checked" @endif class="minimal-green" > Active 

						<input type='radio' name='active' value ='0' required @if($row['active'] == '0') checked="checked" @endif class="minimal-green" > Inactive

						<input type='radio' name='active' value ='2' required @if($row['active'] == '2') checked="checked" @endif class="minimal-green" > Banned
					 </div> 
					 <div class="col-md-2">
					 	
					 </div>
				  </div> 
				  <div class="form-group  " >
					<label for="Avatar" class=" control-label ">Profile Picture </label>
					<div class="">
					  <input  type='file' name='avatar' id='avatar' @if($row['avatar'] =='')  @endif style='width:150px !important;'  />
					<div>
						{!! SiteHelpers::showUploadedFile($row['avatar'],'/uploads/users/') !!}
					</div>
					 </div> 
					 <div class="col-md-2"></div>
				  </div> 

			</fieldset>
		</div>

		<div class="col-md-6 sales_info">
				
				<div class="row">
				<div class="col-md-12">
					<fieldset class="box_design present_address">
						<legend>Aditional Information</legend>
					
					  <div class="form-group" >
						<label for="Gender" class="control-label "> Gender <span class="asterix" style="color:red">*</span></label>
						<div >
        					<select name='gender' class="form-control required"> 
								<option disabled selected value="-1">-- Select Gender --</option>
                                <option @if($row['gender'] == 'male') selected @endif value="male">Male</option>
                                <option @if($row['gender'] == 'female') selected @endif value="female">Female</option>
                                <option @if($row['gender'] == 'other') selected @endif value="other">Other</option>
        					</select> 
						 </div> 
						 <div class="col-md-2"></div>
					  </div> 

					  
					<div class="form-group">
						<label class="control-label" for="name">NID/Passport/Birth Certificate Number<span class="asterix" style="color:red">*</span></label>
						<div class="">
							<input type="number" name="nid_number" id="nid_number" value="{{$row['nid_number']}}" class="form-control" required />
					  </div>
					  <div class="col-md-2"></div>
					</div>
					
					<div class="form-group">
						<label class="control-label" for="name">Father's Name<span class="asterix" style="color:red">*</span></label>
						<div class="">
							<input type="text" name="father_name" id="father_name"  value="{{$row['father_name']}}" class="form-control" required />
					  </div>
					  <div class="col-md-2"></div>
					</div>
					
					<div class="form-group">
						<label class="control-label" for="name">Mothers's Name<span class="asterix" style="color:red">*</span></label>
						<div class="">
							<input type="text" name="mother_name" id="mother_name" class="form-control" value="{{$row['mother_name']}}" required />
					  </div>
					  <div class="col-md-2"></div>
					</div>
				</fieldset>
				</div>
				
					<div class="col-md-6">
					<fieldset class="box_design present_address">
						<legend> Present address</legend>
						
						<div class="form-group">
							<label class="control-label" for="name">Division: <span class="asterix" style="color:red">*</span></label>
							<div class="">
								<select class="form-control" id="present_division_id" name="present_division_id" required="">
									<option disabled selected value="-1">-- Select Division --</option>
									<option @if($row['present_division_id'] == 7) selected @endif value="7">Dhaka</option>
									<option @if($row['present_division_id'] == 8) selected @endif  value="8">Khulna</option>
									<option @if($row['present_division_id'] == 2) selected @endif  value="2">Rajshahi</option>
									<option @if($row['present_division_id'] == 5) selected @endif  value="5">Chittagong</option>
									<option @if($row['present_division_id'] == 6) selected @endif  value="6">Barisal</option>
									<option @if($row['present_division_id'] == 1) selected @endif  value="1" >Rangpur</option>
									<option @if($row['present_division_id'] == 4) selected @endif  value="4">Sylhet</option>
									<option @if($row['present_division_id'] == 3) selected @endif  value="3">Mymensingh</option>
								</select>
						  </div>
						  <div class="col-md-2"></div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label" for="name">District <span class="asterix" style="color:red">*</span></label>
							<div class="">
								<select class="form-control select_district" id="present_district_id" name="present_district_id" required>
									<option disabled selected value="-1">-- Select Division First --</option>
									@if($row['present_district_id'])
									 <option value="{{ $row['present_district_id'] }}" selected >{{ \DB::table('con_district')->where('id',$row['present_district_id'])->first()->title }}</option>
									@endif
								</select>
						  </div>
						  <div class="col-md-2"></div>
						</div>
						
						<div class="form-group">
							<label class="control-label" for="name">Address<span class="asterix" style="color:red">*</span></label>
							<div class="">
								<textarea name="present_address"  id="present_address" class="form-control" required>{{$row['present_address']}}</textarea>
						  </div>
						  <div class="col-md-2"></div>
						</div>
					</fieldset>
				
				</div>
				<div class="col-md-6">
					<fieldset class="box_design">
						<legend> Permanent address</legend>
						<p> <input type="checkbox" id="same_as_present" name="same_as_present"> Same as present address </p>
						<div class="form-group">
							<label class="control-label" for="name">Division: <span class="asterix" style="color:red">*</span></label>
							<div class="">
								<select class="form-control" id="permanent_division_id" name="permanent_division_id" required=>
									<option disabled selected value="-1">-- Select Division --</option>
									<option @if($row['permanent_division_id'] == 7) selected @endif value="7">Dhaka</option>
									<option @if($row['permanent_division_id'] == 8) selected @endif  value="8">Khulna</option>
									<option @if($row['permanent_division_id'] == 2) selected @endif  value="2">Rajshahi</option>
									<option @if($row['permanent_division_id'] == 5) selected @endif  value="5">Chittagong</option>
									<option @if($row['permanent_division_id'] == 6) selected @endif  value="6">Barisal</option>
									<option @if($row['permanent_division_id'] == 1) selected @endif  value="1" >Rangpur</option>
									<option @if($row['permanent_division_id'] == 4) selected @endif  value="4">Sylhet</option>
									<option @if($row['permanent_division_id'] == 3) selected @endif  value="3">Mymensingh</option>
								</select>
						  </div>
						  <div class="col-md-2"></div>
						</div>

						<div class="form-group">
							<label class="control-label" for="name">District <span class="asterix" style="color:red">*</span></label>
							<div class="">
								<select class="form-control select_district" id="permanent_district_id" name="permanent_district_id" required>
									<option disabled selected value="-1">-- Select Division First --</option>
									@if($row['permanent_district_id'])
									 <option value="{{ $row['permanent_district_id'] }}" selected >{{ DB::table('con_district')->where('id',$row['permanent_district_id'])->first()->title }}</option>
									@endif
								</select>
						  </div>
						  <div class="col-md-2"></div>
						</div>
						
						<div class="form-group">
							<label class="control-label" for="name">Address<span class="asterix" style="color:red">*</span></label>
							<div class="">
								<textarea name="permanent_address" id="permanent_address" class="form-control" required>{{$row['permanent_address']}}</textarea>
						  </div>
						  <div class="col-md-2"></div>
						</div>

					</fieldset>		
				</div>
				
				</div>
		
		<fieldset>
		
			<legend>Hierarchy Information</legend>
			
				@if(session('gid') == 1)
				 <div class="form-group" >
					<label for="Group / Level" class=" control-label "> Select parent B2C User</label>
					<div class="">
					  <select name='agent_id' rows='5'class='form-control  input-sm'  required  >
						<?php $sales_user = \DB::table('tb_users')->where('active',1)->where('group_id',5)->get();?>
						@foreach($sales_user as $user)
							<option value="{{$user->id}}">{{$user->first_name}}</option>
						@endforeach
					  </select>
					 </div> 
					 <div class="col-md-2"></div>
				  </div>
				@endif

					@php $hDataArry = [ 'Head of Sales','Regional Manager','Sales Manager','Area Manager','Teritory Manager','Agent']; @endphp
					 <div class="form-group" >
						<label  class="control-label">Hierarchy Level<span class="asterix" style="color:red"> * </span></label>
						<div class="">
								<select name="hierarchy_level" id="hierarchy_level" class="form-control">
								<option value="-1" disabled selected>-- Select Hierarchy Level -- </option>
								 @if(session('gid') != 5)
									@foreach($hDataArry as $key=>$val)
										<option @if($row['hierarchy_level'] == ($key+1) ) selected @endif value="{{$key+1}}">{{$val}}</option>
									@endforeach
								@else
									
									@foreach($hDataArry as $key=>$val)
										@php if($key < $currentHierarchy_level) continue; @endphp
										<option @if($row['hierarchy_level'] == ($key+1) ) selected @endif value="{{$key+1}}">{{$val}}</option>
									@endforeach
 
								@endif
								</select>
						 </div> 
						 <div class="col-md-2"></div>
					 </div> 

			<div class="row hierarchy_level_tree">

				 <div class="col-md-12 level_parent" id="1">
					<div class="form-group" >
						<label data-level-name="Head of Sales" class=" control-label ">Head of Sales<span class="asterix" style="color:red"> * </span></label>
						<div class="">
								<select name="head_of_sales" class="form-control">
								    <option value="-1" disabled selected>-- Select Head of Sales -- </option>
									@foreach(App\Models\Core\Users::where('hierarchy_level',1)->get() as $data)
									    <option @if($row['head_of_sales'] == $data->id ) selected @endif value="{{$data->id}}">{{$data->first_name.'( '.\App\Http\Controllers\AgentController::getAgentMeta($data->id,"agent_serial").' )'}}</option>
									@endforeach
								</select>
						 </div>
					</div> 
				 </div>
				 <div class="col-md-12 level_parent" id="2">
				 	<div class="form-group" >
    					<label data-level-name="Regional Manager" class=" control-label ">Regional Manager<span class="asterix" style="color:red"> * </span></label>
    					<div class="">
    							<select name="regional_manager" class="form-control">
    								 <option value="-1" disabled selected>-- Select Head of Sales First -- </option>
    							</select>
    					 </div> 
    				 </div> 
				 </div>
				 <div class="col-md-12 level_parent" id="3">
				 	<div class="form-group" >
					<label data-level-name="Sales Manager" class=" control-label ">Sales Manager<span class="asterix" style="color:red"> * </span></label>
					<div class="">
							<select name="sales_manager" class="form-control">
							 <option value="-1" disabled selected>-- Select Regional Manager First -- </option>
							</select>
					 </div> 
				 </div> 
				 </div>
				 <div class="col-md-12 level_parent" id="4">
				 	<div class="form-group" >
						<label data-level-name="Area Manager" class="control-label ">Area Manager<span class="asterix" style="color:red"> * </span></label>
						<div class="">
								<select name="area_manager" class="form-control">
									 <option value="-1" disabled selected>-- Select Sales Manager First -- </option>
								</select>
						 </div> 
					 </div> 
				 </div>
				 <div class="col-md-12 level_parent" id="5">
					<div class="form-group" >
						<label data-level-name="Teritory Manager" class="control-label">Teritory Manager<span class="asterix" style="color:red"> * </span></label>
						<div class="">
								<select name="teritory_manager" class="form-control">
									 <option value="-1" disabled selected>-- Select Area Manager First -- </option>
								</select>
						 </div> 
					 </div> 
				 </div>

			</div>

			</fieldset>
		</div>

			
		<div style="clear:both"></div>	

		 <input type="hidden" name="action_task" value="save" />
	</div>
	
 <p class="text-left"><button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> Submit</button></p>
 {!! Form::close() !!}

</div>


<script>

	jQuery(document).on('change','.hierarchy_level_tree select',function(){
		var hierarchy_level = parseInt(jQuery('#hierarchy_level').find('option:selected').val());
		var level_id = parseInt(jQuery(this).closest('.level_parent').attr('id'));
		var selected_id =  parseInt(jQuery(this).find('option:selected').val());
		var child_level_name = jQuery('#'+(level_id+1)).find('label').attr('data-level-name');
		
		if(level_id < hierarchy_level-1 ){
			
			jQuery('.ajaxLoading').show();
			jQuery.ajax({
			  url: "{{ url('/get-hierarchy')}}",
			  method: 'POST',
			  data: {level_id:level_id,selected_id:selected_id,child_level_name:child_level_name,_token:'<?= csrf_token(); ?>'},
			  cache: false,
			  success: function(response){
				jQuery('.ajaxLoading').hide();
				jQuery('#'+(level_id+1)).find('select').html(response);
				console.log(('#'+(level_id+1)));
			  }
			});
		}


	});
	
	
</script>

	@if(session('gid') != 5 )
	<script>
		jQuery(document).on('change','#group_id',function(){
			jQuery('.hide_for_sales').show();
			jQuery('.sales_info').hide();
			if(jQuery(this).find('option:selected').val() == 5){ //Selected Sales Panel
				jQuery('.sales_info').show();
				jQuery('#create_agent').attr('action','{{route('create.agent')}}');
				jQuery('.hide_for_sales').hide();
				jQuery('.hide_for_sales .form-control').each(function(key,val){
				   jQuery(this).removeAttr('required'); 
				});
				
				jQuery('.sales_info .form-control').each(function(key,val){
				   jQuery(this).attr('required','true'); 
				});
			}else{
				jQuery('#create_agent').attr('action','/core/users');
				jQuery('.sales_info .form-control').each(function(key,val){
				   jQuery(this).removeAttr('required'); 
				});
			}
		});
	</script>
	@else
		<script>
			jQuery(document).ready(function(){
				jQuery('.sales_info').show();
				jQuery('#create_agent').attr('action','{{route('create.agent')}}');
				jQuery('.sales_info .form-control').each(function(key,val){
					jQuery(this).attr('required','true'); 
				});
			});
		</script>

	@endif


		 
   <script>
   
	jQuery(document).ready(function() {
		jQuery("#group_id").jCombo("{{ URL::to('core/users/comboselect?filter=tb_groups:group_id:name') }}",
		{  selected_value : '{{ $row["group_id"] }}' });
	});

	jQuery(document).on('change','#hierarchy_level',function(){
		jQuery('.hierarchy_level_tree').show();
		jQuery('.hierarchy_level_tree .level_parent').show();
		jQuery('.hierarchy_level_tree .level_parent').each(function(key,val){
			jQuery(this).find('select').attr('required','true');
		});
	    var data = {
	        head_of_sales : 1,
	        regional_manager: 2,
	        sales_manager: 3,
	        area_manager: 4,
	        teritory_manager: 5
	    };
		
		var selected = jQuery(this).find('option:selected').val();
		for(i=selected;i < 6; i++){
			jQuery('#'+i).hide();
			jQuery('#'+i).find('select').removeAttr('required');
		}

	});
	
	jQuery(document).on('change','#present_division_id',function(){
		jQuery('.ajaxLoading').show();
		jQuery.ajax({
		  url: "{{ url('/getdistrict')}}/"+jQuery(this).find('option:selected').val(),
		  cache: false,
		  success: function(response){
			 jQuery('.ajaxLoading').hide();
			jQuery('#present_district_id').html(response);
		  }
		});
	});
	
	jQuery(document).on('change','#permanent_division_id',function(){
		jQuery('.ajaxLoading').show();
		jQuery.ajax({
		  url: "{{ url('/getdistrict')}}/"+jQuery(this).find('option:selected').val(),
		  cache: false,
		  success: function(response){
			 jQuery('.ajaxLoading').hide();
			jQuery('#permanent_district_id').html(response);
		  }
		});
	});
	
	jQuery(document).on('change','select[name="state"]',function(){
		jQuery('.ajaxLoading').show();
		jQuery.ajax({
		  url: "{{ url('/getdistrict')}}/"+jQuery(this).find('option:selected').val(),
		  cache: false,
		  success: function(response){
			 jQuery('.ajaxLoading').hide();
			jQuery('select[name="city"]').html(response);
		  }
		});
	});

	jQuery(document).on('click','.txtDate',function(){
		var dtToday = new Date();
		var month = dtToday.getMonth() + 1;
		var day = dtToday.getDate();
		var year = dtToday.getFullYear();
		if(month < 10) month = '0' + month.toString();
		if(day < 10) day = '0' + day.toString();
		var maxDate = year + '-' + month + '-' + day;
		jQuery('.txtDate').attr('max', maxDate);
	});

	jQuery(document).on('blur','.txtDate',function(){
		var dtToday = new Date();
		var inputDate = jQuery(this).val();
		inputDate = new Date(inputDate)
		if(inputDate > dtToday ){
		var month = dtToday.getMonth() + 1;
		var day = dtToday.getDate();
		var year = dtToday.getFullYear();
		if(month < 10) month = '0' + month.toString();
		if(day < 10) day = '0' + day.toString();
		var maxDate = year + '-' + month + '-' + day;
		jQuery(this).val(maxDate);
		}

	});
	
	jQuery(document).on('change','#same_as_present',function(){
		var checkboxValue = jQuery(this).prop('checked');
		var parmanent = '#permanent';
		var present = '#present';
		if(checkboxValue){
			jQuery('.ajaxLoading').show();
			jQuery(parmanent+'_division_id option[value='+jQuery(present+'_division_id option:selected').val()+']').prop('selected', true);
				jQuery.ajax({
				  url: "{{ url('/getdistrict')}}/"+jQuery(present+'_division_id option:selected').val(),
				  cache: false,
				  success: function(response){
					jQuery('.ajaxLoading').hide();
					jQuery(parmanent+'_district_id').html(response);
					jQuery(parmanent+'_district_id option[value='+jQuery(present+'_district_id option:selected').val()+']').prop('selected', true);
				  }
				});
			jQuery(parmanent+'_address').val(jQuery(present+'_address').val());
		}else{
			jQuery(parmanent+'_division_id option[value=-1]').prop('selected', true);
			jQuery(parmanent+'_district_id option[value=-1]').prop('selected', true);
			jQuery(parmanent+'_address').val('');
		}
	});
</script>	

@if($row['id'])
<script>
	jQuery(document).ready(function() {
		jQuery('.hierarchy_level_tree').show();
		jQuery('.hierarchy_level_tree .level_parent').show();
		jQuery('.hierarchy_level_tree .level_parent').each(function(key,val){
			jQuery(this).find('select').attr('required','true');
		});
	    var data = {
	        head_of_sales : 1,
	        regional_manager: 2,
	        sales_manager: 3,
	        area_manager: 4,
	        teritory_manager: 5
	    };
		
		var selected = {{$row['hierarchy_level']}};
		for(i=selected;i < 6; i++){
			jQuery('#'+i).hide();
			jQuery('#'+i).find('select').removeAttr('required');
		}
	});

</script>
@endif
	 
@stop