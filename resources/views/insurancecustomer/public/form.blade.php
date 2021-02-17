

		 {!! Form::open(array('url'=>'insurancecustomer', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div id="wizard-step" class="wizard-circle number-tab-steps"> <h3>Customer Information</h3> <section> {!! Form::hidden('id', $row['id']) !!}{!! Form::hidden('group_id', $row['group_id']) !!}					
									  <div class="form-group row  " >
										<label for="Mobile Number" class=" control-label col-md-4 text-left"> Mobile Number <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='username' id='username' value='{{ $row['username'] }}' 
						required     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Password" class=" control-label col-md-4 text-left"> Password <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='password' id='password' value='{{ $row['password'] }}' 
						required     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Email" class=" control-label col-md-4 text-left"> Email <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='email' id='email' value='{{ $row['email'] }}' 
						required     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Fullname" class=" control-label col-md-4 text-left"> Fullname <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='first_name' id='first_name' value='{{ $row['first_name'] }}' 
						required     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> {!! Form::hidden('last_name', $row['last_name']) !!}					
									  <div class="form-group row  " >
										<label for="Date of Birth" class=" control-label col-md-4 text-left"> Date of Birth </label>
										<div class="col-md-6">
										  
				<div class="input-group input-group-sm m-b" style="width:150px !important;">
					{!! Form::text('birth_of_day', $row['birth_of_day'],array('class'=>'form-control form-control-sm date')) !!}
					<div class="input-group-append">
					 	<div class="input-group-text"><i class="fa fa-calendar"></i></span></div>
					 </div>
				</div> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Address" class=" control-label col-md-4 text-left"> Address </label>
										<div class="col-md-6">
										  <input  type='text' name='address_1' id='address_1' value='{{ $row['address_1'] }}' 
						     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Agent Id" class=" control-label col-md-4 text-left"> Agent Id </label>
										<div class="col-md-6">
										  <input  type='text' name='agent_id' id='agent_id' value='{{ $row['agent_id'] }}' 
						     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="State" class=" control-label col-md-4 text-left"> State </label>
										<div class="col-md-6">
										  <input  type='text' name='state' id='state' value='{{ $row['state'] }}' 
						     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="City" class=" control-label col-md-4 text-left"> City </label>
										<div class="col-md-6">
										  <input  type='text' name='city' id='city' value='{{ $row['city'] }}' 
						     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Phone" class=" control-label col-md-4 text-left"> Phone </label>
										<div class="col-md-6">
										  <input  type='text' name='phone' id='phone' value='{{ $row['phone'] }}' 
						     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Gender" class=" control-label col-md-4 text-left"> Gender </label>
										<div class="col-md-6">
										  
					<?php $gender = explode(',',$row['gender']);
					$gender_opt = array( 'male' => 'Male' ,  'female' => 'Female' ,  'other' => 'Other' , ); ?>
					<select name='gender' rows='5'   class='select2 '  > 
						<?php 
						foreach($gender_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['gender'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Occupation" class=" control-label col-md-4 text-left"> Occupation </label>
										<div class="col-md-6">
										  <input  type='text' name='occupation' id='occupation' value='{{ $row['occupation'] }}' 
						     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> {!! Form::hidden('country', $row['country']) !!}{!! Form::hidden('avatar', $row['avatar']) !!}					
									  <div class="form-group row  " >
										<label for="Status" class=" control-label col-md-4 text-left"> Status </label>
										<div class="col-md-6">
										  <select name='active' rows='5' id='active' class='select2 '   ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> {!! Form::hidden('login_attempt', $row['login_attempt']) !!}{!! Form::hidden('last_login', $row['last_login']) !!}{!! Form::hidden('updated_at', $row['updated_at']) !!}{!! Form::hidden('reminder', $row['reminder']) !!}{!! Form::hidden('activation', $row['activation']) !!}{!! Form::hidden('remember_token', $row['remember_token']) !!}{!! Form::hidden('last_activity', $row['last_activity']) !!}{!! Form::hidden('config', $row['config']) !!}</section> <h3>Package Information</h3> <section> {!! Form::hidden('created_at', $row['created_at']) !!}</section></div>

			<div style="clear:both"></div>	
				
					
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-default btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-default btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
				  </div>	  
			
		</div> 
		 <input type="hidden" name="action_task" value="public" />
		 {!! Form::close() !!}
		 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#active").jCombo("{!! url('insurancecustomer/comboselect?filter=con_status:id:name') !!}",
		{  selected_value : '{{ $row["active"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
