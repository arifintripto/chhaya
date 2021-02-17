

		 {!! Form::open(array('url'=>'insuranceclaims', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> General Information</legend>
				{!! Form::hidden('id', $row['id']) !!}					
									  <div class="form-group row  " >
										<label for="Insurance Package" class=" control-label col-md-4 text-left"> Insurance Package </label>
										<div class="col-md-6">
										  <select name='package_id' rows='5' id='package_id' class='select2 '   ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Insurance" class=" control-label col-md-4 text-left"> Insurance </label>
										<div class="col-md-6">
										  <select name='insurance_id' rows='5' id='insurance_id' class='select2 '   ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Documents" class=" control-label col-md-4 text-left"> Documents </label>
										<div class="col-md-6">
										  
					<a href="javascript:void(0)" class="btn btn-xs btn-primary pull-right" onclick="addMoreFiles('documents')"><i class="fa fa-plus"></i></a>
					<div class="documentsUpl multipleUpl">	
						<div class="fileUpload btn " > 
						    <span>  <i class="fa fa-camera"></i>  </span>
						    <div class="title"> Browse File </div>
						    <input type="file" name="documents[]" class="upload"   accept="image/x-png,image/gif,image/jpeg"     />
						</div>		
					</div>
					<ul class="uploadedLists " >
					<?php $cr= 0; 
					$row['documents'] = explode(",",$row['documents']);
					?>
					@foreach($row['documents'] as $files)
						@if(file_exists('./uploads/files'.$files) && $files !='')
						<li id="cr-<?php echo $cr;?>" class="">							
							<a href="{{ url('/uploads/files/'.$files) }}" target="_blank" >
							{!! SiteHelpers::showUploadedFile( $files ,"/uploads/images/",100) !!}
							</a> 
							<span class="pull-right removeMultiFiles" rel="cr-<?php echo $cr;?>" url="/uploads/files{{$files}}">
							<i class="fa fa-trash-o  btn btn-xs btn-danger"></i></span>
							<input type="hidden" name="currdocuments[]" value="{{ $files }}"/>
							<?php ++$cr;?>
						</li>
						@endif
					
					@endforeach
					</ul>
					 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Payment Method" class=" control-label col-md-4 text-left"> Payment Method </label>
										<div class="col-md-6">
										  
					<?php $payment_method = explode(',',$row['payment_method']);
					$payment_method_opt = array( 'bkash' => 'Bkash' ,  'rocket' => 'Rocket' ,  'bank' => 'Bank Account' , ); ?>
					<select name='payment_method' rows='5'   class='select2 '  > 
						<?php 
						foreach($payment_method_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['payment_method'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Payment Note" class=" control-label col-md-4 text-left"> Payment Note </label>
										<div class="col-md-6">
										  <textarea name='payment_note' rows='5' id='payment_note' class='form-control form-control-sm '  
				          placeholder='If you want your claim money to your bank account, please provide: Account Name, Account Number, Bank name, Branch Name' >{{ $row['payment_note'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Hospital Name" class=" control-label col-md-4 text-left"> Hospital Name </label>
										<div class="col-md-6">
										  <input  type='text' name='hospital_name' id='hospital_name' value='{{ $row['hospital_name'] }}' 
						     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Admit Date" class=" control-label col-md-4 text-left"> Admit Date </label>
										<div class="col-md-6">
										  
				<div class="input-group input-group-sm m-b" style="width:150px !important;">
					{!! Form::text('admit_date', $row['admit_date'],array('class'=>'form-control form-control-sm date')) !!}
					<div class="input-group-append">
					 	<div class="input-group-text"><i class="fa fa-calendar"></i></span></div>
					 </div>
				</div> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Release Date" class=" control-label col-md-4 text-left"> Release Date </label>
										<div class="col-md-6">
										  
				<div class="input-group input-group-sm m-b" style="width:150px !important;">
					{!! Form::text('release_date', $row['release_date'],array('class'=>'form-control form-control-sm date')) !!}
					<div class="input-group-append">
					 	<div class="input-group-text"><i class="fa fa-calendar"></i></span></div>
					 </div>
				</div> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Premium" class=" control-label col-md-4 text-left"> Premium </label>
										<div class="col-md-6">
										  <input  type='text' name='premium' id='premium' value='{{ $row['premium'] }}' 
						     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Claim Note" class=" control-label col-md-4 text-left"> Claim Note </label>
										<div class="col-md-6">
										  <textarea name='claim_note' rows='5' id='claim_note' class='form-control form-control-sm '  
				           >{{ $row['claim_note'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Status" class=" control-label col-md-4 text-left"> Status </label>
										<div class="col-md-6">
										  <select name='status' rows='5' id='status' class='select2 '   ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> </fieldset></div>

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
		
		
		$("#package_id").jCombo("{!! url('insuranceclaims/comboselect?filter=con_package:id:title') !!}",
		{  selected_value : '{{ $row["package_id"] }}' });
		
		$("#insurance_id").jCombo("{!! url('insuranceclaims/comboselect?filter=con_insurance:id:title') !!}",
		{  selected_value : '{{ $row["insurance_id"] }}' });
		
		$("#status").jCombo("{!! url('insuranceclaims/comboselect?filter=con_status:id:name') !!}",
		{  selected_value : '{{ $row["status"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
