@extends('layouts.app')

@section('content')
<div class="page-header"><h2> {{ $pageTitle }} <small> {{ $pageNote }} </small> </h2></div>

	{!! Form::open(array('url'=>'visitreports?return='.$return, 'class'=>'form-horizontal validated concave-form','files' => true ,'id'=> 'FormTable' )) !!}
	<div class="toolbar-nav">
		<div class="row">
			
			<div class="col-md-6 " >
				<div class="submitted-button">
					<button name="apply" class="tips btn btn-sm btn-default  "  title="{{ __('core.btn_back') }}" ><i class="fa  fa-check"></i> {{ __('core.sb_apply') }} </button>
					<button name="save" class="tips btn btn-sm btn-default"  id="saved-button" title="{{ __('core.btn_back') }}" ><i class="fa  fa-paste"></i> {{ __('core.sb_save') }} </button> 
				</div>	
			</div>
			<div class="col-md-6 text-right " >
				<a href="{{ url($pageModule.'?return='.$return) }}" class="tips btn btn-default  btn-sm "  title="{{ __('core.btn_back') }}" ><i class="fa  fa-times"></i></a> 
			</div>
		</div>
	</div>	


	<div class="p-5">
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>		
		<div class="row">
	<div class="col-md-12">
						<fieldset><legend> Visit Report</legend>
				{!! Form::hidden('id', $row['id']) !!}					
									  <div class="form-group row  " >
										<label for="Name" class=" control-label col-md-4 text-left"> Name<span class="asterix" style="color:red">*</span></label>
										<div class="col-md-6">
										  <input  type='text' name='name' id='name' value='{{ $row['name'] }}' 
						required     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Mobile Number" class=" control-label col-md-4 text-left"> Mobile Number<span class="asterix" style="color:red">*</span></label>
										<div class="col-md-6">
										  <input  type='text' name='mobile_number' id='mobile_number' value='{{ $row['mobile_number'] }}' 
						required     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									
									  <div class="form-group row">
										<label class="control-label col-md-4 text-left" for="name">Division: <span class="asterix" style="color:red">*</span></label>
										<div class="col-md-6">
											<select class="form-control" id="division" name="division" required="">
												<option disabled selected value="-1">-- Select Division --</option>
												<option @if($row['division'] == 7) selected @endif value="7">Dhaka</option>
												<option @if($row['division'] == 8) selected @endif  value="8">Khulna</option>
												<option @if($row['division'] == 2) selected @endif  value="2">Rajshahi</option>
												<option @if($row['division'] == 5) selected @endif  value="5">Chittagong</option>
												<option @if($row['division'] == 6) selected @endif  value="6">Barisal</option>
												<option @if($row['division'] == 1) selected @endif  value="1" >Rangpur</option>
												<option @if($row['division'] == 4) selected @endif  value="4">Sylhet</option>
												<option @if($row['division'] == 3) selected @endif  value="3">Mymensingh</option>
											</select>
									  </div>
									  <div class="col-md-2"></div>
									</div>


									<div class="form-group row">
										<label class="control-label col-md-4" for="name">District <span class="asterix" style="color:red">*</span></label>
										<div class="col-md-6">
											<select class="form-control select_district" id="district" name="district" required>
												<option disabled selected value="-1">-- Select Division First --</option>
												@if($row['district'])
												 <option value="{{ $row['district'] }}" selected >{{ DB::table('con_district')->where('id',$row['district'])->first()->title }}</option>
												@endif
											</select>
									  </div>
									  <div class="col-md-2"></div>
									</div>

									  
									  <div class="form-group row  " >
										<label for="Address" class=" control-label col-md-4 text-left"> Address<span class="asterix" style="color:red">*</span></label>
										<div class="col-md-6">
										  <input  type='text' name='address' id='address' value='{{ $row['address'] }}' 
						required     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Note" class=" control-label col-md-4 text-left"> Note </label>
										<div class="col-md-6">
										  <textarea name='note' rows='5' id='note' class='form-control form-control-sm '  
				           >{{ $row['note'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Status" class=" control-label col-md-4 text-left"> Status<span class="asterix" style="color:red">*</span></label>
										<div class="col-md-6">
										  
					<?php $status = explode(',',$row['status']);
					$status_opt = array( 'Interested' => 'Interested' ,  'Not Interested' => 'Not Interested' , ); ?>
					<select name='status' rows='5' required  class='select2 '  > 
						<?php 
						foreach($status_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['status'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> </fieldset></div>
	
		</div>

		<input type="hidden" name="action_task" value="save" />
		
		</div>
	</div>		
	{!! Form::close() !!}
		 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		 	
		 	 

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("visitreports/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
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
	</script>	
	
@stop