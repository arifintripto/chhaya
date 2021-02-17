@extends('layouts.default.master')
@section('title',$title)
@section('content')
<style>
.form-horizontal .control-label {
    padding-top: 7px;
    margin-bottom: 0;
    text-align: left;
}
.mt-5{
	margin-top:50px;
}
.otp_failed a{
	cursor:pointer;
}
.text-danger{
	margin:0;
}
.res p{
	background: #ac0a0a;
    color: #fff;
    margin-top: 8px;
    padding: 5px;
    border-radius: 3px;
}
label span{color: #f00;}
.thisbanner{
   background:#129748;
   color:#fff;
}
.thisbanner h2{
    padding-top:70px;
}
.show_msg{
  margin:0;
}

@if(!\Auth::check())
.apply_now{
	display:none;
}
@endif

.myerrors{
    padding-top: 20px;
    color: red;
    font-size: 20px;
}
/* payment */

.payment_method .pay_logo {
    width: 230px;
    margin-left: 30px;
}
.payment_method p{
    box-shadow: 0px 2px 3px 0px #a5a5a5;
    padding: 5px 12px;
    border-radius: 5px;
	font-weight:bold;
}
#bKash_button{display:none;}
.ajs-header {
    background: #f9ae429c !important;
}
.ajs-close {
    transform: scale(1.3);
}
</style>

<div class="section banner-page thisbanner">
    <div class="container">
         <h2> Membership Information Form</h2>
    </div>
</div>	  
	  
	  
    <div class="container">
        
@if($errors->any())
    {!! implode('', $errors->all('<div class="myerrors">:message</div>')) !!}
@endif

        <form id="checkout" style="padding: 30px 0;" class="form-horizontal" method="post" action="{{ url('/pay')}}">
             @csrf
		<div class="row">
			<div class="col-md-6">
				<h4>Provides the following information for self</h4>
				 <hr><br>
				<div class="form-group">
					<label class="control-label col-sm-4" for="mobile">Mobile number:<span>*</span></label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="mobile_number"  placeholder="Enter mobile number" value="{{ $user->username ?? '' }}" @if($user) readonly @endif  name="username" required>
						<p id='show_msg' style='color:red; margin:0'></p>
					</div>
				</div> 
			<div class="variable_content">	
			  <div class="form-group">
                <label class="col-sm-4" for="fullname">Full Name <small>(as per NID/Passport/Birth Certificate)</small> :<span>*</span></label>
                <div class="col-sm-8">
                <input type="text" class="form-control"  value="{{ $user->first_name ?? '' }}" placeholder="Enter Name" name="fullname" @if($user) readonly @endif required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="date_of_birth">Date of birth:<span>*</span></label>
                <div class="col-sm-8">
                    <input type="date" name="date_of_birth" id="date_of_birth" value="{{ $user->birth_of_day ?? '' }}" class="form-control form-control-sm txtDate" @if($user) readonly @endif name="date_of_birth" required >
                </div>
              </div>
			  
			  <div class="form-group">
                <label class="control-label col-sm-4" for="nid">NID:</label>
                <div class="col-sm-8">
                    <input type="text" name="nid" id="nid" value="{{ $user->nid ?? '' }}" class="form-control form-control-sm" @if($user) readonly @endif name="nid">
                </div>
              </div>

            <div class="form-group">
                <label class="control-label col-sm-4" for="name">Division:<span>*</span></label>
                <div class="col-sm-8">
                    <select class="form-control" id="division" name="division" required @if($user) readonly @endif >
                        <option disabled selected value="-1">-- Select Division --</option>
                        <option @if($user->state ?? '' == 7) selected @endif value="7">Dhaka</option>
                        <option @if($user->state ?? '' == 8) selected @endif  value="8">Khulna</option>
                        <option @if($user->state ?? '' == 2) selected @endif  value="2">Rajshahi</option>
                        <option @if($user->state ?? '' == 5) selected @endif  value="5">Chittagong</option>
                        <option @if($user->state ?? '' == 6) selected @endif  value="6">Barisal</option>
                        <option @if($user->state ?? '' == 1) selected @endif  value="1" >Rangpur</option>
                        <option @if($user->state ?? '' == 4) selected @endif  value="4">Sylhet</option>
                        <option @if($user->state ?? '' == 3) selected @endif  value="3">Mymensingh</option>
                    </select>
              </div>
            </div>
    
           <div class="form-group">
                <label class="control-label col-sm-4" for="name">District:<span>*</span></label>
                <div class="col-sm-8">
                    <select class="form-control select_district" id="district" name="district" required @if($user) readonly @endif >
                        <option disabled selected value="-1" >-- Select Division First --</option>
                        @if($user->city ?? '')
                         <option value="{{ $user->city ?? '' }}" selected >{{ DB::table('con_district')->where('id',$user->city ?? '')->first()->title }}</option>
                        @endif
                    </select>
              </div>
            </div>

              <div class="form-group">
                <label class="control-label col-sm-4" for="name">Address:</label>
                <div class="col-sm-8">
                <textarea class="form-control"  placeholder="Enter address" name="address" @if($user) readonly @endif >{{ $user->address_1 ?? '' }}</textarea>
              </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-sm-4" for="name">Gender:<span>*</span></label>
                <div class="col-sm-8">
                  <select name="gender" id="gender" class="form-control" required @if($user) readonly @endif >
					<option selected disabled value="-1">-- Select Gender --</option>
                    <option @if($user->gender =='male') selected @endif value="male">Male</option>
                    <option @if($user->gender =='female') selected @endif  value="female">Female</option>
                    <option @if($user->gender =='other') selected @endif  value="other">Other</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="name">Email:</label>
                <div class="col-sm-8">
                <input type="email" class="form-control"  value="{{ $user->email ?? '' }}"  placeholder="Enter email" name="email" @if($user) readonly @endif >
              </div>
              </div>
  
            @if(! \Auth::check())
                  <div class="form-group">
                      <label class="control-label col-sm-4" for="name">Password:<span>*</span></label>
                      <div class="col-sm-8">
                      <input type="password" id="password" class="form-control"  placeholder="Enter Password" name="password" required>
                    </div>
                  </div>
                  
                <div class="form-group">
                    <label class="control-label col-sm-4" for="name">Confirm password:<span>*</span></label>
                    <div class="col-sm-8">
                    <input type="password" id="confirm_password" class="form-control"  placeholder="Confirm Password" name="password_confirmation" required>
                  </div>
                </div>
                  
              @endif
			 </div> 
			</div>
			<div class="col-md-6">
			              
              <h4 >Provides the following information of nominee</h4>
              <hr><br>
  
              <div class="form-group">
                <label class="control-label col-sm-4" >Name of nominee:<span>*</span></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control"  placeholder="Enter name of nominee" name="nominee[name]" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4">Age of nominee:<span>*</span></label>
                <div class="col-sm-8">
                  <input type="number" min='1' max='150' class="form-control" id="nominee_age"  placeholder="Enter age of nominee" name="nominee[age]" required>
                </div>
              </div>
              
              
              
              <div class="form-group">
                <label class="control-label col-sm-4" for="name">Relationship with nominee:<span>*</span></label>
                <div class="col-sm-8">
                  <select name="nominee[relationship]" class="form-control" id="relationship_with_nominee" required>
                    <option disabled selected value="-1">-- Select Relationship with nominee --</option>
                    <option value="father">Father</option>
                    <option value="mother">Mother</option>
                    <option value="husband">Husband</option>
                    <option value="wife">Wife</option>
                    <option value="son">Son</option>
                    <option value="daughter">Daughter</option>
                  </select>
                </div>
              </div>
              
              
              <div class="form-group">
                <label class="control-label col-sm-4" for="name">Mobile number of nominee:</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" min="11" max="11" id="nominee_mobile"  placeholder="Enter mobile number of nominee" name="nominee[mobile]">
              </div>
              </div>

             <div class="form-group">
                <label class="control-label col-sm-4" for="name">Insured Person(s):<span>*</span></label>
                <div class="col-sm-8">{!! $packagehtml !!}</div>
              </div>
			  
			  <!-- payment method -->		
        	<div class="payment_method mt-5"> 
        		 <a href="javascript:void(0)" id="bKash_button" ></a> 
        		 <label class="modal-title">Select Payment Method<span>*</span></label>
        		 <hr>
        		 <p> <input type="radio" name="payment_method" value="bkash" checked required >bKash <img class="pay_logo" src="/uploads/static/bkash_payment_logo.png" alt=""></p>
        		 <p> <input type="radio" name="payment_method" value="card" required >Card  <img class="pay_logo" src="/uploads/static/card_logo.jpg" alt=""></p>
        	</div> 
        <!-- payment -->


			</div>
		</div>
		
		<div class="additional mt-5"> 
		 <h4 class="modal-title">Provides the following additional information</h4>
		 <br><hr>
		 <div class="family_package"><div class="dynamic_element"></div></div>
        </div> 
            
              <div class="form-group">
                <div class="col-sm-12">
                  <div class="checkbox">
                    <label><input type="checkbox" name="aggree" id="aggree" required> I agree with <a target="_blank" href="/terms-and-conditions">Terms & Conditions</a> <span>*</span></label>
                  </div><br>
				      <p class="text-right"><a href="javascript:void(0)" id="apply_now" class="btn btn-default apply_now">Submit</a></p>
                </div>
              </div>
 	   
            </form>
        </div>
		
		
	  <!-- Modal -->
		  <div class="modal fade" id="otpModal" role="dialog">
          <div style="margin-top: 80px;" class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">OTP Verification Process</h4>
                </div>
                <div class="modal-body">
                  <p>Please submit OTP verification code sent to your mobile number.</p>
                  <form id="otp_form" >
                  <div class="row">
                    <div class="col-xs-8">
                    <input type="text" class="form-control" id="otp_code" name="otp_code" >
                  </div>
                  <div class="col-xs-4">
                    <button class="btn btn-success">Submit</button>
                  </div>
                  </div> 
                  </form>
                  <p class="res"></p>
                  <p class="text-danger otp_failed"></p>
                </div>
            </div>
          </div>
		  </div>
		  
@if(!\Auth::check())	
<script type="text/javascript">
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    jQuery("#mobile_number").blur(function(e){
        e.preventDefault();
		jQuery('#mobile_number').css({'border':'1px solid #ccc'});
		jQuery('#apply_now').hide();
		jQuery('.variable_content').show();
		jQuery('.variable_content .form-control').each(function(key,val){
			jQuery(this).attr('required','true'); 
		});
		if(jQuery('#mobile_number').val().length != 11 ){
			alert('Invalid mobile number! Mobile number should be 11 charecter long and start with 01XX.');
			jQuery('#mobile_number').css({'border':'1px solid #d87474', 'margin':'0'});
		}else{
			if(jQuery('#mobile_number').val().substr(0, 2) != '01'){
			  alert('Invalid mobile number! Mobile number should start with 01XX.');
			  jQuery('#mobile_number').css({'border':'1px solid #d87474', 'margin':'0'});
			}else{
					jQuery('#show_msg').html('');
					jQuery('#mobile_number').css({'border':'1px solid #ccc', 'margin':'0'});
					var phone = jQuery("input[name=username]").val();
					jQuery('.ajax_loader').show();
					jQuery.ajax({
					   type:'POST',
					   url:'{{url("phone-check")}}',
					   data:{phone:phone,_token:'<?= csrf_token(); ?>'},
					   success:function(data){
						  jQuery('.ajax_loader').hide();
						  jQuery('#apply_now').show();
						  if(data==0){
							 jQuery('.variable_content').hide();
							 jQuery('.variable_content .form-control').each(function(key,val){
								jQuery(this).removeAttr('required'); 
							 });
							 jQuery('#show_msg').html('You are already registerd. We have already your basic information. Please fill other required information to proceed!');
						  }
						  jQuery('#nid').removeAttr('required');
					   }
					}); 
			  
			}
			
		}

	});
	
	jQuery("#confirm_password").blur(function(e){
        e.preventDefault();
		jQuery('#confirm_password,#password').css({'border':'1px solid #ccc'});
		var password = jQuery("#password").val();
		if(password.length < 6){
			alert('Password should have at least 6 charecter long!');
			jQuery('#password').css({'border':'1px solid #d87474'});
			return;
		}
		if(jQuery(this).val() != password){
			jQuery('#confirm_password').css({'border':'1px solid #d87474'});
			alert('Password does not match!');
		}

		
	});
	

</script>

@endif

 <script>
	jQuery("#nominee_age").blur(function(e){
		$age = Math.abs(jQuery(this).val());
		if($age < 1){
			jQuery(this).val(1);
		}else{
			jQuery(this).val($age);
		}
		
	});
	

 jQuery(document).on('click','#apply_now',function(e){
    e.preventDefault();
    var x = true;

		jQuery('#checkout input').each(function(key,val){
			if(jQuery(this).attr('required') != undefined){
			  if(jQuery(this).val() == ''){
				if(x){
				  alert('All (*) mark fields are required. Fill the required fields first!');
				   x = false;
				   return;
				}
			  }
			}
		});
		


		if(x){
			if(jQuery('#mobile_number').val().length != 11 ){
				alert('Invalid mobile number! Mobile number should be 11 charecter long and start with 01XX.');
				return;
			}else{
				
			  if(jQuery('#mobile_number').val().substr(0, 2) != '01'){
				  alert('Invalid mobile number! Mobile number should start with 01XX.');
				  return;
			  }else{
				  
					
						
				if(jQuery('.variable_content').is(":visible")){
					if(jQuery('#gender option:selected').val() == '-1'){
						alert('Please select your gender!');
						return;
					}
					
					if(jQuery('#division').attr('required') != undefined){
						if(jQuery('#division option:selected').val() == '-1'){
							alert('Please select your division!');
							return;
						}
						if(jQuery('#district option:selected').val() == '-1'){
							alert('Please select your district!');
							return;
						}
					}
				}
				
				
				if(jQuery('#aggree:checkbox:checked').length == 0){
					alert('Please aggree with our terms and conditions!');
					return;
				}
					

					
					if(jQuery('#relationship_with_nominee option:selected').val() != '-1'){
						if(jQuery('#person_picker option:selected').val() != '-1' ){
							jQuery('.ajax_loader').show();
							jQuery.ajax({
							  url: "{{ url('/generate-otp')}}",
							  method: 'POST',
							  data: {mobile_number:jQuery('#mobile_number').val(),masking:0,_token:'<?= csrf_token(); ?>'},
							  cache: false,
							  success: function(response){
								jQuery('.ajax_loader').hide();
								if(response == 2){
									alert('Maximum OTP generation reached! You can generate OTP maximum 5 times per day!');
								}else if(response == 1){
									setTimeout(function(){ jQuery('.otp_failed').html('Did not recieve OTP? <a id="apply_now">Click here</a> to regenerate.') }, 30000);
								}
							  }
							}); 
								
							jQuery('#otpModal').modal({
							  backdrop: 'static',
							  keyboard: false 
							});					
						}else{
							alert('Please select a number of insured person(s)!');
							return;
						}

					}else{
						alert('Please select a relationship with nominee!');
						return;
					}
			
				}
						
				
						
			}
				  
		}
			  
    });
	
	
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
				if(jQuery('input[name="payment_method"]').val() == 'bkash'){
					  bKash.reconfigure({
						 paymentRequest: {amount: jQuery('#person_picker option:selected').attr('data-price')}
					 });
					 jQuery('#bKash_button').trigger('click');
					 jQuery('#otpModal').modal('hide');
				}else{
					  jQuery('#checkout').submit()
				}
			  }else if(response == 0){
				jQuery('.res').html('<p class="text-danger">Invalid OTP. Please try with correct OTP.</p>')
			  }else if(response == 2){
				jQuery('.res').html('<p class="text-danger">OTP has Expired. Please try with new OTP.</p>')
			  }
		  }
		});

	});
	
 
      jQuery(document).on('change','#division',function(){
		  jQuery('.ajax_loader').show();
          jQuery.ajax({
              url: "{{ url('/getdistrict')}}/"+jQuery(this).find('option:selected').val(),
              cache: false,
              success: function(response){
				jQuery('.ajax_loader').hide();
                jQuery('.select_district').html(response);
              }
            });
      });
      

      jQuery(document).on('change','#person_picker',function(){
          
         var number_of_person = jQuery(this).find('option:selected').val();
         var html = '<div class="form-group">'+
                '<label class="control-label col-sm-4">Full Name:<span>*</span></label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" class="form-control"  placeholder="Enter Name" name="fm_fullname[]" required>'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="control-label col-sm-4" for="name">Date of birth:<span>*</span></label>'+
                '<div class="col-sm-8">'+
                '<input type="text" placeholder="YYYY/MM/DD" onfocus="(this.type=\'date\')" class="form-control txtDate"  name="fm_date_of_birth[]" required>'+
              '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="control-label col-sm-4" >Relationship:<span>*</span></label>'+
                '<div class="col-sm-8">'+
                  '<input type="text" class="form-control"  placeholder="Enter relationship" name="fm_relationship[]" required>'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="control-label col-sm-4" for="name">Gender:<span>*</span></label>'+
               '<div class="col-sm-8">'+
                  '<select name="fm_gender[]" class="form-control" required>'+
				    '<option selected disabled>-- Select Gender --</option>'+
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
</script>



<script src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>
<script>
var accessToken = '';
jQuery(document).ready(function () {
    jQuery.ajaxSetup({ 
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }
    });
	
    jQuery.ajax({
        url: "{{ url('initial-state') }}",
        type: 'POST',
        contentType: 'application/json',
        success: function (data) {
            accessToken = JSON.stringify(data);
        },
        error: function () {
            console.log('error');
        }
    });
	
	var paymentConfig = {
		createCheckoutURL: "{{ url('createpayment') }}", 
		executeCheckoutURL: "{{ url('executepayment') }}",
	};

	var paymentRequest = {amount: 99, intent: 'sale', invoice:"{{uniqid()}}" };


	    bKash.init({
        paymentMode: 'checkout',
		paymentRequest: paymentRequest,
        createRequest: function (request) {
			//console.log(request);
            jQuery.ajax({
                url: paymentConfig.createCheckoutURL + "?"+jQuery("#checkout").serialize(),
                type: 'GET',
                contentType: 'application/json',
                success: function (data) {
					//console.log('got data from create  ..');
					//console.log('data ::=>');
					//console.log(data);
                    var obj = JSON.parse(data);
                    if (data && obj.paymentID != null) {
                        paymentID = obj.paymentID;
						if(data.transactionStatus == 'Completed'){

                            if(!alertify.errorAlert){
                                alertify.dialog('errorAlert',function factory(){
                                  return{
                                          build:function(){
                                              var errorHeader = '<span class="fa fa-check fa-2x" '
                                              +    'style="vertical-align:middle;color:#0d9548;">'
                                              + '</span> Payment Success!';
                                              this.setHeader(errorHeader);
                                          }
                                      };
                                  },true,'alert');
                              }

                            alertify.errorAlert('Congratulations! your transaction is successfully completed.');
                            setTimeout(function(){ window.location.href = "/dashboard"; }, 6000);
                            jQuery('#bKashFrameWrapper').hide(100);
                            
                          }
                        bKash.create().onSuccess(obj);
                    }else {
							if(!alertify.errorAlert){
							  alertify.dialog('errorAlert',function factory(){
								return{
										build:function(){
											var errorHeader = '<span class="fa fa-times-circle fa-2x" '
											+    'style="vertical-align:middle;color:#e10000;">'
											+ '</span> Sorry! Your Transaction is failed.';
											this.setHeader(errorHeader);
										}
									};
								},true,'alert');
							}
						   if(data.errorMessage){
                                alertify.errorAlert(data.errorMessage);
                            }else{
                                alertify.errorAlert('We are sorry! Your transaction can not be proceed at this time. Please try again later.');
                           }
						  bKash.create().onError();
                    } 
                },
                error: function () {
                    console.log('error');
                    bKash.create().onError();
                }
            });
        },
        executeRequestOnAuthorization: function () {
            jQuery.ajax({
                url: paymentConfig.executeCheckoutURL + "?paymentID=" + paymentID,
                type: 'GET',
                contentType: 'application/json',
                success: function (data) {
                    data = JSON.parse(data);
					//console.log(data);
                    if (data && data.paymentID != null) {
						if(data.transactionStatus == 'Completed'){

                            if(!alertify.errorAlert){
                                alertify.dialog('errorAlert',function factory(){
                                  return{
                                          build:function(){
                                              var errorHeader = '<span class="fa fa-check fa-2x" '
                                              +    'style="vertical-align:middle;color:#0d9548;">'
                                              + '</span> Payment Success!';
                                              this.setHeader(errorHeader);
                                          }
                                      };
                                  },true,'alert');
                              }

                            alertify.errorAlert('Congratulations! your transaction is successfully completed.');
                            setTimeout(function(){ window.location.href = "/dashboard"; }, 6000);
                            jQuery('#bKashFrameWrapper').hide(100);
                            
                          }
                    }
                    else {
							if(!alertify.errorAlert){
							  alertify.dialog('errorAlert',function factory(){
								return{
										build:function(){
											var errorHeader = '<span class="fa fa-times-circle fa-2x" '
											+    'style="vertical-align:middle;color:#e10000;">'
											+ '</span> Sorry! Your Transaction is failed.';
											this.setHeader(errorHeader);
										}
									};
								},true,'alert');
							}
						   if(data.errorMessage){
                                alertify.errorAlert(data.errorMessage);
                              }else{
                                alertify.errorAlert('We are sorry! Your transaction can not be proceed at this time. Please try again later.');
                           }
                        bKash.execute().onError();
                    }
                },
                error: function () {
                    bKash.execute().onError();
                }
            });
        }
    });
	
	
	
	
});

</script>
  
  



@endsection