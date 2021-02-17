@extends('layouts.login')

@section('content')
<style>
#reset_form {
    width: 80%;
    margin: 0 auto;
}
</style>
	
		<div class="ajaxLoading"></div>
	    
		<div class="form-signin">
			
			<p class="message alert alert-danger " style="display:none;"></p>	
	 
		    	@if(Session::has('status'))
		    		@if(session('status') =='success')
		    			<p class="alert alert-success">
							{!! Session::get('message') !!}
						</p>
					@else
						<p class="alert alert-danger">
							{!! Session::get('message') !!}
						</p>
					@endif		
				@endif

			<ul class="parsley-error-list">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>		
	

		
		<div   id="tab-sign-in">

	 		{!! Form::open(array('url'=>'user/signin', 'class'=>'','id'=>'LoginAjax' , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	 		<label for="inputEmail" class="sr-only">Email address</label>
	      	<input type="text" id="inputEmail" class="form-control"  name="email"  placeholder="Mobile Number or Email" required autofocus>
	      	<label for="inputPassword" class="sr-only">Password</label>
	      	<input type="password" id="inputPassword"  name="password" class="form-control" placeholder="{{ __('core.password') }}" required>
	      	<div class="checkbox pt-3 mb-3">
		        <label>
		          <input type="checkbox" name="remember" value="1"  style="display: inline-block;" /> Remember me
		        </label>
		      </div>


			@if(config('concave.cnf_recaptcha') =='true') 
			<div class="form-group has-feedback  animated fadeInLeft delayp1">
				<label class="text-left"> Are u human ? </label>	
				<div class="g-recaptcha" data-sitekey="{{config('concave.cnf_recaptchapublickey')}}"></div>
				
				<div class="clr"></div>
			</div>	
		 	@endif	

		 	<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button> 	

			<div class=" pt-2 pb-2 " >					       
					<p class="text-center ">						
						<a href="javascript:void(0)" class="forgot"> @lang('core.forgotpassword') ? </a> | <a href="{{ url('')}}"> {{ Lang::get('core.backtosite') }} </a>  

					</p>					
			</div>	

		   	</div>	
		   </form>
		   
			<div class="row text-center">
				<p>Don't have an account? To register, please check and buy our packages from <a href="/#products">here</a>. </p>
			</div>
		</div>
		
		

		<div class=" m-t" id="tab-forgot" style="display: none">	

			{!! Form::open(array('url'=>'generate-otp', 'id'=>'reset_form', 'class'=>'form-vertical', 'parsley-validate'=>'','novalidate'=>' ')) !!}
			   <div class="form-group has-feedback">
			   <div class="form_div">
					<label>Enter Your Mobile Number</label>
					<input type="text" id="mobile_number" name="mobile_number" placeholder="Mobile Number" class="form-control" required/>
					<input type="hidden" name="masking" value="0" >
				</div> 	
				</div>
				<div class="form-group has-feedback">    
					<a href="/user/login" id="cancel" class="forgot btn btn-warning"> Cancel </a>     
			      <a href="javascript:void(0)" id="apply_now" class="btn btn-primary ">Submit</a>        
			  </div>
			  
			  <div class="res clr"></div>
			</form>		
		</div>
	</div>
	

<script>
jQuery(document).on('submit','#reset_form',function(e){
	e.preventDefault();
	jQuery('#apply_now').trigger('click');
});
	jQuery(document).on('click','#apply_now',function(e){
    e.preventDefault();
	jQuery('.res').html('');
	if(jQuery('#mobile_number').val() == ''){
		alert('Please fill valid mobile number first!');
	}else{
		if(jQuery('#mobile_number').val().length != 11 ){
			alert('Invalid mobile number! Mobile number should be 11 charecter long and starts with 01XX');
		}else{
			jQuery('.ajaxLoading').show();
			jQuery.ajax({
			  url: "{{ url('/generate-otp')}}",
			  method: 'POST',
			  data: {mobile_number:jQuery('#mobile_number').val(),form_type:1,masking:0,_token:'<?= csrf_token(); ?>'},
			  cache: false,
			  success: function(response){
				jQuery('.ajaxLoading').hide();
				if(response == 99){
					jQuery('.res').html('<p class="text-danger">You are not registered user. Please register first!</p>');
				}else if(response == 2){
					jQuery('.res').html('<p class="text-danger">Maximum OTP generation limit Exceeds for your account.!</p>');
				}else if(response == 1){
					jQuery('.form_div label').html('Enter OTP code sent to your mobile');
					jQuery('#mobile_number').attr('type','hidden');
					jQuery('#mobile_number').after('<input type="text" class="form-control" name="otp_code" id="otp_code" placeholder="Enter OTP Code" required >');
					jQuery('.form_div input').attr('placeholder','Enter OTP Code');
					jQuery('#apply_now').attr('id','apply_otp');
				}

			  }
			}); 
		}
	}
	});
	
	jQuery(document).on('click','#apply_otp',function(e){
		e.preventDefault();
		jQuery('.res').html('');
		
		if(jQuery('#otp_code').val().length != 6 ){
			alert('Invalid OTP! OTP should be 6 charecter long.');
		}else{
			jQuery('.ajaxLoading').show();
			jQuery.ajax({
			  url: "{{ url('/reset-password')}}",
			  method: 'POST',
			  data: {mobile_number:jQuery('#mobile_number').val(),otp_code:jQuery('#otp_code').val(),_token:'<?= csrf_token(); ?>'},
			  cache: false,
			  success: function(response){
				  var data = JSON.parse(response);
				  jQuery('.ajaxLoading').hide();
				   if(data.response_code == 0){
					jQuery('.res').html('<p class="text-danger">Invalid OTP. Please try with correct OTP.</p>')
				  }else if(data.response_code == 2){
					jQuery('.res').html('<p class="text-danger">OTP has Expired. Please try with new OTP.</p>')
				  }else if(data.response_code == 3){
					   jQuery('.form_div label').html('Reset Your Password');
						jQuery('#mobile_number').attr('type','hidden');
						jQuery('#mobile_number').after('<input type="password" class="form-control" name="password" id="password" placeholder="New password" required ><br><input type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Confirm password" required ><br><input type="hidden" name="response_hash" id="response_hash" value="'+data.response_hash+'">');
						jQuery('#otp_code').remove();
						jQuery('#apply_otp').attr('id','confirm_password');
				  }
			  }
			});
			
		}
	});
	
	jQuery(document).on('click','#confirm_password',function(e){
		e.preventDefault();
		jQuery('.res').html('');
		
		var password = jQuery('#password').val();
		var conf_password = jQuery('#confirm-password').val();
		if(password === conf_password){
			jQuery('.ajaxLoading').show();
			jQuery.ajax({
			  url: "{{ url('/reset-password-confirmation')}}",
			  method: 'POST',
			  data: {mobile_number:jQuery('#mobile_number').val(),response_hash:jQuery('#response_hash').val(),password:jQuery('#password').val(),_token:'<?= csrf_token(); ?>'},
			  cache: false,
			  success: function(response){
				  jQuery('.ajaxLoading').hide();
				   if(response == 1){
					  jQuery('#cancel').trigger('click');
					  jQuery('#LoginAjax').after('<p class="text-success">Password has been changed! Now you can login with your new password.</p>');
					  setTimeout(function(){ location.reload(); }, 3000);
				  }else if(response == 2){
					  jQuery('.res').html('<p class="text-danger">You took too much time to reset your password after OTP verification.</p>');
					  setTimeout(function(){ location.reload(); }, 3000);
				  }
			  }
			});
		}else{
			alert('Password does not match!');
		}

	});
	

	

</script>



<script type="text/javascript">
	$(document).ready(function(){

		$('.forgot').on('click',function(){
			$('#tab-forgot').toggle();
			$('#tab-sign-in').toggle();
		})
		var form = $('#LoginAjax'); 
		form.parsley();
		form.submit(function(){
			
			if(form.parsley().isValid()){			
				var options = { 
					dataType:      'json', 
					beforeSubmit :  showRequest,
					success:       showResponse  
				}  
				$(this).ajaxSubmit(options); 
				return false;
							
			} else {
				return false;
			}		
		
		});

	});

function showRequest()
{
	$('.ajaxLoading').show();		
}  
function showResponse(data)  {		
	
	if(data.status == 'success')
	{
		window.location.href = data.url;	
		$('.ajaxLoading').hide();
	} else {
		$('.message').html(data.message)	
		$('.ajaxLoading').hide();
		$('.message').show(data.message)	
		return false;
	}	
}	
</script>

@stop