@extends('layouts.app')

@section('content')
<style>.validation {color: red;display:none;}</style>
<div class="page-header"><h2> {{ $pageTitle }} <small> {{ $pageNote }} </small> </h2></div>

	{!! Form::open(array('url'=>'pay-agent', 'class'=>'form-horizontal validated concave-form','files' => true ,'id'=> 'checkout' )) !!}

	<div class="p-5">
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>		
		<div class="">
	<div id="wizard-step" class="wizard-circle number-tab-steps"> <h3>Customer Info</h3> 
	
	<section>	
	<p class="validation"> All star (*) marked fields are required!<p>
	<div class="row">
	    <div class="col-md-6">
							<div class="form-group row" >
								<label for="Mobile Number" class=" control-label col-md-4 text-left"> Mobile Number <span class="asterix" style="color:red">*</span></label>
								<div class="col-md-6">
								  <input  type='text' name='username' id='mobile_number' value='{{ $row['username'] }}' required class='form-control form-control-sm' /> 
								</div> 
								 <div class="col-md-2"></div>
							</div>
				<div class="dyanamic_contents">

						  <div class="form-group row" >
							<label for="Email" class=" control-label col-md-4 text-left"> Email </label>
							<div class="col-md-6">
							  <input  type='text' name='email' id='email' value='{{ $row['email'] }}'  class='form-control-sm' /> 
							 </div> 
							 <div class="col-md-2"></div>
						  </div> 
							  
						  <div class="form-group row" >
							<label for="Fullname" class=" control-label col-md-4 text-left"> Fullname <small>(as per NID/Passport/Birth Certificate)</small><span class="asterix" style="color:red">*</span></label>
							<div class="col-md-6">
							  <input  type='text' name='fullname' id='fullname' value='{{ $row['first_name'] }}' required class='form-control form-control-sm' /> 
							 </div> 
							 <div class="col-md-2"> </div>
						  </div>
						  
						 <div class="form-group row" >
							<label for="NID" class=" control-label col-md-4 text-left">NID</label>
							<div class="col-md-6">
							  <input  type='text' name='nid' id='nid' value='{{ $row['nid'] }}' class='form-control-sm' /> 
							 </div> 
							 <div class="col-md-2"> </div>
						 </div>
		  
						  <div class="form-group row" >
							<label for="Date of Birth" class=" control-label col-md-4 text-left"> Date of Birth </label>
							<div class="col-md-6">
							  <input  type='date' name='date_of_birth' id='date_of_birth' value='{{ $row['birth_of_day'] }}' class='form-control form-control-sm txtDate' /> 
							</div> 
							 <div class="col-md-2"></div>
						  </div> 
	  

						  <div class="form-group row">
							<label class="control-label col-md-4 text-left" for="name">Division: <span class="asterix" style="color:red">*</span></label>
							<div class="col-md-6">
								<select class="form-control" id="division" name="division" required="">
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


						<div class="form-group row">
							<label class="control-label col-md-4" for="name">District <span class="asterix" style="color:red">*</span></label>
							<div class="col-md-6">
								<select class="form-control select_district" id="district" name="district" required>
									<option disabled selected value="-1">-- Select Division First --</option>
									@if($row['city'])
									 <option value="{{ $row['city'] }}" selected >{{ DB::table('con_district')->where('id',$user->city)->first()->title }}</option>
									@endif
								</select>
						  </div>
						  <div class="col-md-2"></div>
						</div>
						
						
						<div class="form-group row" >
							<label for="Address" class=" control-label col-md-4 text-left"> Address </label>
							<div class="col-md-6">
							<textarea  name='address' id='address' class='form-control form-control-sm' >{{ $row['address_1'] }}</textarea>
							 </div> 
							 <div class="col-md-2"> </div>
						</div> 
									  

					  <div class="form-group row" >
						<label for="Gender" class=" control-label col-md-4 text-left"> Gender <span class="asterix" style="color:red">*</span></label>
						<div class="col-md-6">
        					<select name='gender' class="form-control required"> 
								<option disabled selected value="-1">-- Select Gender --</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
        					</select> 
						 </div> 
						 <div class="col-md-2"></div>
					  </div> 		
					  
					  
					 <!-- <div class="form-group row">
						<label for="Occupation" class=" control-label col-md-4 text-left"> Occupation </label>
						<div class="col-md-6">
						  <input  type='text' name='occupation' id='occupation' value='{{ $row['occupation'] }}' class='form-control form-control-sm' /> 
						 </div> 
						 <div class="col-md-2"></div>
					  </div> -->
			</div>
	    </div>
	    <div class="col-md-6">
	      		 
			<h4 class="modal-title">Provides the following information of nominee</h4>
              <hr>
			<div class="nominee_info">				  
			  <div class="form-group row" >
				<label  class=" control-label col-md-4 text-left"> Name of nominee:  <span class="asterix" style="color:red">*</span></label>
				<div class="col-md-6">
				 <input type="text" class="form-control"  placeholder="Enter name of nominee" name="nominee[name]" required>
				 </div> 
				 <div class="col-md-2"></div>
			  </div>
			  
			  <div class="form-group row" >
				<label  class=" control-label col-md-4 text-left"> Age of nominee:  <span class="asterix" style="color:red">*</span></label>
				<div class="col-md-6">
				 <input type="number" class="form-control" id="nominee_age"  placeholder="Enter age of nominee" name="nominee[age]" required>
				 </div> 
				 <div class="col-md-2"></div>
			  </div> 
			  

			  <div class="form-group row">
                <label class="control-label col-sm-4 text-left" for="name">Relationship with nominee:<span class="asterix" style="color:red">*</span></label>
                <div class="col-sm-6">
                  <select name="nominee[relationship]" class="form-control nominee_verify" id="relationship_with_nominee" required>
                    <option disabled selected value="-1">-- Select relationship with nominee --</option>
                    <option value="father">Father</option>
                    <option value="mother">Mother</option>
                    <option value="husband">Husband</option>
                    <option value="wife">Wife</option>
                    <option value="son">Son</option>
                    <option value="daughter">Daughter</option>
                  </select>
                </div>
				<div class="col-md-2"></div>
              </div>
			  
			 <div class="form-group row" >
				<label  class=" control-label col-md-4 text-left"> Mobile number of nominee: </label>
				<div class="col-md-6">
				<input type="text" class="form-control"  placeholder="Enter mobile number of nominee" name="nominee[mobile]">
				 </div> 
				 <div class="col-md-2"></div>
			  </div> 
			  
		</div>
			  
			  		 <input type="hidden" name="active" value="1" >
					{!! Form::hidden('last_name', $row['last_name']) !!}	
					{!! Form::hidden('id', $row['id']) !!}
					{!! Form::hidden('group_id', $row['group_id']) !!}  
					{!! Form::hidden('country', $row['country']) !!}
					{!! Form::hidden('avatar', $row['avatar']) !!}	 
					{!! Form::hidden('login_attempt', $row['login_attempt']) !!}
					{!! Form::hidden('last_login', $row['last_login']) !!}
					{!! Form::hidden('updated_at', $row['updated_at']) !!}
					{!! Form::hidden('reminder', $row['reminder']) !!}
					{!! Form::hidden('activation', $row['activation']) !!}
					{!! Form::hidden('activation', $row['activation']) !!}
					{!! Form::hidden('remember_token', $row['remember_token']) !!}
					{!! Form::hidden('last_activity', $row['last_activity']) !!}
					{!! Form::hidden('config', $row['config']) !!}
					{!! Form::hidden('created_at', $row['created_at']) !!}
	       
	    </div>
	</div>
									 			
</section> 
					
	<!-- STEP 2 -->
	<h3>Package Info</h3>
	<section> 
		<p class="validation"> All star (*) Marked fields are required!<p>
			<div class="row">
			     <div class="col-md-6">
			         					
			         <div class="form-group row" >
                        <label  class=" control-label col-md-4 text-left"> Select Package : <span class="asterix" style="color:red">*</span></label>
                        <div class="col-md-6">
            				<select name="package_id" id="package_id" class="form-control" required>
								<option selected disabled value="-1">-- Select Package --</option>
									@foreach(App\Models\Insurancepackage::where('status',1)->where('segment',0)->orWhere('segment',2)->get() as $package)
									<option value="{{$package->id}}">{{$package->title}}</option>
									@endforeach
                            </select>
                            
                        </div> 
                         <div class="col-md-2"></div>
                    </div> 
			
                    <div class="form-group row" >
                        <label  class=" control-label col-md-4 text-left"> Insured Person(s): <span class="asterix" style="color:red">*</span></label>
                        <div class="col-md-6 insured_person"></div> 
                         <div class="col-md-2"></div>
                    </div> 

                    <div class="additional"> 
                         <h4 class="modal-title">Provides the following additional information</h4>
                         <br>
                         <hr>
                         <div class="family_package"><div class="dynamic_element"></div></div>
                    </div>
                    
			     </div>
			     
			     <div class="col-md-6"></div>
			</div>
	</section>
					

				</div>
	
		</div>

		<input type="hidden" name="action_task" value="save" />
		
		</div>
	</div>		
	{!! Form::close() !!}
	  <!-- The Modal -->
	  <div class="modal fade" id="otpModal">
		<div class="modal-dialog">
		  <div class="modal-content">
		  
			<!-- Modal Header -->
			<div class="modal-header">
			  <h4 class="modal-title">OTP Verification Process</h4>
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			
			<!-- Modal body -->
			<div class="modal-body">
			<p>Please submit OTP verification code sent to your mobile number.</p>
			  <form id="otp_form" >
			  <div class="row">
				<div class="col-sm-8">
				<input type="text" class="form-control" id="otp_code" name="otp_code" >
			  </div>
			  <div class="col-sm-4">
				<button class="btn btn-success">Submit</button>
			  </div>
			  </div> 
			  </form>
			  <p class="res"></p>
			  <p class="text-danger otp_failed">Did not recieve OTP? <a href="javascript:void(0)" onclick="generateOtp()">Click here</a> to regenerate.</p>
			</div>
		  </div>
		</div>
	  </div>
	 
   <script>
	$(document).ready(function() { 

			$("#wizard-step").steps({
		          headerTag: "h3",
		          bodyTag: "section",
		          transitionEffect: "fade",
		          titleTemplate: "<span class='step'>#index#</span> #title#",
		          autoFocus: true,
		          labels: {
		            finish: "Submit"
		        },
		        onFinished: function (event, currentIndex) {
					//Submit button triggered
		        }
		     });
	       	$(".steps ul > li > a span").removeClass("number")

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("insurancecustomer/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	jQuery(document).on('change','#nominee_age',function(e){
		if(jQuery(this).val() == 0){
			jQuery(this).val(1);
		}
		jQuery(this).val(Math.abs(jQuery(this).val()));
	});
	
	jQuery(document).on('click','a[href="#next"]',function(e){
		
			jQuery('.validation').hide();
			if(jQuery('#mobile_number').val().length != 11 ){
				alert('Invalid mobile number! Mobile number should be 11 charecter long and start with 01XX.');
				jQuery('.validation').show();
				jQuery('a[href="#previous"]').trigger('click');
			}else{
			  if(jQuery('#mobile_number').val().substr(0, 2) != '01'){
				  alert('Invalid mobile number! Mobile number should start with 01XX.');
				  jQuery('.validation').show();
				 jQuery('a[href="#previous"]').trigger('click');
			  }else{

					if(jQuery('#division').attr('required') != undefined){
							if(jQuery('#division option:selected').val().length != '-1'){
								if(jQuery('#district option:selected').val().length != '-1'){
									jQuery('#checkout .form-control').each(function(key,val){
										if(jQuery(this).attr('required') != null){
										  if(jQuery(this).val() == ''){
											  jQuery('.validation').show();
											  jQuery('a[href="#previous"]').trigger('click');
										  }
										}
										
									});
								}else{
									jQuery('.validation').show();
									jQuery('a[href="#previous"]').trigger('click');
								}
							}else{
								jQuery('.validation').show();
								jQuery('a[href="#previous"]').trigger('click');
							}
						}else{
								if(jQuery('#relationship_with_nominee option:selected').val() != '-1'){
									jQuery('.nominee_info .form-control').each(function(key,val){
										if(jQuery(this).attr('required') != null){
										  if(jQuery(this).val() == ''){
												  jQuery('.validation').show();
												  jQuery('a[href="#previous"]').trigger('click');
										  }
										}
										
									});
								}else{
									jQuery('.validation').show();
									jQuery('a[href="#previous"]').trigger('click');
								}
					

						}
				
				} 
			}
		


	});
	
	jQuery(document).on('click','a[href="#finish"]',function(){
		jQuery('.validation').hide();
		var w = jQuery('#package_id option:selected').val();
		if(w != '-1'){
			var x = jQuery('#person_picker option:selected').val();
			if(x != '-1'){
				var z = true;
				//Validate Family Members
				jQuery('#checkout .family_package').each(function(key,val){
					if(jQuery(this).attr('required') != null){
					  if(jQuery(this).val() == ''){
						  jQuery('.validation').show();
						  z = false;
					  }
					}
					
				});
				
				var nonSelected = true;
				if(jQuery('.fm_gender').length > 0){
					var k = false;
					jQuery('.fm_gender').each(function(key,val){
						if(!nonSelected){
							if(jQuery(this).find('option:selected').val() == '-1'){
								jQuery('.validation').show();
								var nonSelected = true; //At least one field is empty
							}
						}
					});
				}
				console.log(nonSelected);
				if(z && nonSelected){
					//We can Submit now
					generateOtp();
				}
				

			}else{
				jQuery('.validation').show();
			}
		}else{
			jQuery('.validation').show();
		}
		

	});
	

	
</script>

<script>
	function generateOtp(){
		var x = true;
		jQuery('#checkout .form-control').each(function(key,val){
			if(jQuery(this).attr('required') != undefined){
			  if(jQuery(this).val() == ''){
				if(x){
				  alert('All (*) mark fields are required. Fill the required fields first!');
				   x = false;
				}
			  }
			}
		});
		
		if(x){
			if(jQuery('#mobile_number').val().length != 11 ){
				alert('Invalid mobile number! Mobile number should be 11 charecter long and start with 01XX.');
			}else{
			  if(jQuery('#mobile_number').val().substr(0, 2) != '01'){
				  alert('Invalid mobile number! Mobile number should start with 01XX.');
			  }else{
					jQuery.ajax({
					  url: "{{ url('/generate-otp')}}",
					  method: 'POST',
					  data: {mobile_number:jQuery('#mobile_number').val(),masking:0,_token:'<?= csrf_token(); ?>'},
					  cache: false,
					  success: function(response){
						if(response == 2){
							alert('Maximum OTP generation reached! You can generate OTP maximum 5 times per day!');
						}
					  }
					}); 
					
					jQuery('#otpModal').modal({
					  backdrop: 'static',
					  keyboard: false 
					});
				} 
			}
		} 
	};
	
	
	jQuery(document).on('submit','#otp_form',function(e){
		e.preventDefault();
		jQuery('#res').html('');
		jQuery.ajax({
		  url: "{{ url('/verify-otp')}}",
		  method: 'POST',
		  data: {mobile_number:jQuery('#mobile_number').val(),otp_code:jQuery('#otp_code').val(),_token:'<?= csrf_token(); ?>'},
		  cache: false,
		  success: function(response){
			  if(response == 1){
				  jQuery('#checkout').submit();
			  }else if(response == 0){
				jQuery('.res').html('<p class="text-danger">Invalid OTP. Please try with correct OTP.</p>')
			  }else if(response == 2){
				jQuery('.res').html('<p class="text-danger">OTP has Expired. Please try with new OTP.</p>')
			  }
		  }
		});
	});
	

	jQuery(document).on('blur','#mobile_number',function(){

		if(jQuery('#mobile_number').val().length != 11 ){
			alert('Invalid mobile number! Mobile number should be 11 charecter long and start with 01XX.');
			jQuery('#mobile_number').css({'border':'1px solid #d87474', 'margin':'0'});
		}else{
			if(jQuery('#mobile_number').val().substr(0, 2) != '01'){
			  alert('Invalid mobile number! Mobile number should start with 01XX.');
			  jQuery('#mobile_number').css({'border':'1px solid #d87474', 'margin':'0'});
			}else{
					jQuery('#mobile_number').css({'border':'1px solid #ccc', 'margin':'0'});
					var phone = jQuery("input[name=username]").val();
					jQuery('.res_m').remove();
					jQuery('.ajaxLoading').show();
					jQuery.ajax({
					   type:'POST',
					   url:'{{url("phone-check")}}',
					   data:{phone:phone,_token:'<?= csrf_token(); ?>'},
					   success:function(data){
						  jQuery('.ajaxLoading').hide();
						  if(data==0){
							 jQuery('.dyanamic_contents').hide();
							 jQuery('.dyanamic_contents .form-control').each(function(key,val){
								 jQuery(this).removeAttr('required');
							 });
							 
							 jQuery('.dyanamic_contents select').each(function(key,val){
								 jQuery(this).removeAttr('required');
							 });
							 
							 jQuery('#mobile_number').after('<p class="res_m text-info">This user is already registered and we have the basic information of this person. That\'s why we don\'t need further basic information of this person again.</p>');
							 jQuery('#mobile_number').css({'border':'1px solid #d87474', 'margin':'0'});
							 
						  }else{
							jQuery('.dyanamic_contents').show();
							jQuery('.res_m').remove();
							
							 jQuery('.dyanamic_contents .form-control').each(function(key,val){
								 jQuery(this).attr('required','ture');
							 });
							 
							 jQuery('.dyanamic_contents select').each(function(key,val){
								 jQuery(this).attr('required','true');
							 });

							 jQuery('#date_of_birth').removeAttr('required');
							 jQuery('#address').removeAttr('required');
						  }
					   }
					});
			  
			}
			
		}

	});
	


</script>

<script>
		jQuery(document).on('click','.txtDate',function(){
		  var dtToday = new Date();
		  var month = dtToday.getMonth() + 1;
		  var day = dtToday.getDate();
		  var year = dtToday.getFullYear();
		  if(month < 10) month = '0' + month.toString();
		  if(day < 10)   day = '0' + day.toString();
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
				  if(day < 10)   day = '0' + day.toString();
				  var maxDate = year + '-' + month + '-' + day;    
				  jQuery(this).val(maxDate);
			}

		});

		jQuery(document).on('change','#division',function(){
			jQuery('.ajaxLoading').show();
          jQuery.ajax({
              url: "{{ url('/getdistrict')}}/"+jQuery(this).find('option:selected').val(),
              cache: false,
              success: function(response){
				 jQuery('.ajaxLoading').hide();
                jQuery('.select_district').html(response);
              }
            });
      });
	

	 
      jQuery(document).on('change','#person_picker',function(){
          
         var number_of_person = jQuery(this).find('option:selected').val();
         var html = '<div class="form-group">'+
                '<label class="control-label col-sm-3">Full Name: <span class="asterix" style="color:red">*</span></label>'+
                '<div class="col-sm-9">'+
                    '<input type="text" class="form-control"  placeholder="Enter Name" name="fm_fullname[]" required>'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="control-label col-sm-3" for="name">Date of birth: <span class="asterix" style="color:red">*</span></label>'+
                '<div class="col-sm-9">'+
                '<input type="text" placeholder="YYYY/MM/DD" onfocus="(this.type=\'date\')" class="form-control txtDate"  name="fm_date_of_birth[]" required>'+
              '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="control-label col-sm-3" >Relationship: <span class="asterix" style="color:red">*</span></label>'+
                '<div class="col-sm-9">'+
                  '<input type="text" class="form-control"  placeholder="Enter relationship" name="fm_relationship[]" required>'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="control-label col-sm-3" for="name">Gender: <span class="asterix" style="color:red">*</span></label>'+
               '<div class="col-sm-9">'+
                  '<select name="fm_gender[]" class="form-control fm_gender" required>'+
					'<option value="-1" selected disabled>-- Select Gender --</option>'+
                    '<option value="male">Male</option>'+
                    '<option value="female">Female</option>'+
                    '<option value="other">Other</option>'+
                  '</select>'+
                '</div>'+
            '</div>';
        jQuery('.family_package').empty();
        
        if(number_of_person > 1){
            jQuery('.additional').show();
        }
        
        for (var i = 2; i <= number_of_person; i++) {
            jQuery('.family_package').append('<h5>Provides the following information for person '+i+'</h5><hr>');
            jQuery('.family_package').append(html);
        }
      });
    
    jQuery(document).on('change','#package_id',function(){
		jQuery('.ajaxLoading').show();
          jQuery.ajax({
              url: "{{ url('/getpackage')}}/"+jQuery(this).find('option:selected').val(),
              cache: false,
              success: function(response){
				jQuery('.ajaxLoading').hide();
                jQuery('.insured_person').html(response);
              }
            });
     });
	
	
 </script>	
@stop