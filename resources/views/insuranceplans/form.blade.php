@extends('layouts.app')

@section('content')
<div class="page-header"><h2> {{ $pageTitle }} <small> {{ $pageNote }} </small> </h2></div>

	{!! Form::open(array('url'=>'insuranceplans?return='.$return, 'class'=>'form-horizontal validated concave-form','files' => true ,'id'=> 'FormTable' )) !!}
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
						<fieldset><legend> Insurance Plans</legend>
				{!! Form::hidden('id', $row['id']) !!}					
									  <div class="form-group row " >
										<label for="Insurance Title" class=" control-label col-md-4 text-left"> Insurance Title </label>
										<div class="col-md-6">
										  <input  type='text' name='title' id='title' value='{{ $row['title'] }}' 
						     class='form-control form-control-sm' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Icon" class=" control-label col-md-4 text-left"> Icon </label>
										<div class="col-md-6">
										  
						<div class="fileUpload btn " > 
						    <span>  <i class="fa fa-camera"></i>  </span>
						    <div class="title"> Browse File </div>
						    <input type="file" name="icon" class="upload"   accept="image/x-png,image/gif,image/jpeg"     />
						</div>
						<div class="icon-preview preview-upload">
							{!! SiteHelpers::showUploadedFile( $row["icon"],"/uploads/images") !!}
						</div>
					 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Required Doccuments" class=" control-label col-md-4 text-left"> Required Doccuments </label>
										<div class="col-md-6">
										  <textarea name='required_doccuments' rows='5' id='editor' class='form-control form-control-sm editor '  
						 >{{ $row['required_doccuments'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Coverage Details (front end)" class=" control-label col-md-4 text-left"> Coverage Details (front end) </label>
										<div class="col-md-6">
										  <textarea name='coverage_text' rows='5' id='coverage_text' class='form-control form-control-sm '  
				           >{{ $row['coverage_text'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Insurance Type" class=" control-label col-md-4 text-left"> Insurance Type </label>
										<div class="col-md-6">
										  <select name='insurance_type' rows='5' id='insurance_type' class='select2 '   ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Maximum Coverage Amount" class=" control-label col-md-4 text-left"> Maximum Coverage Amount </label>
										<div class="col-md-6">
										  <input  type='text' name='claim_amount' id='claim_amount' value='{{ $row['claim_amount'] }}' 
						     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Coverage Details (admin)" class=" control-label col-md-4 text-left"> Coverage Details (admin) </label>
										<div class="col-md-6">
										  <textarea name='details_of_coverage' rows='5' id='editor' class='form-control form-control-sm editor '  
						 >{{ $row['details_of_coverage'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Premium Duration" class=" control-label col-md-4 text-left"> Premium Duration </label>
										<div class="col-md-6">
										  <select name='premium_period' rows='5' id='premium_period' class='select2 '   ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Insurance Partner​" class=" control-label col-md-4 text-left"> Insurance Partner​ </label>
										<div class="col-md-6">
										  <select name='insurance_provider' rows='5' id='insurance_provider' class='select2 '   ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									<?php
										$hiddenfields = ['hospital_name' => '','admit_date' => '','release_date' =>''];
										if($row['hidden_fields']){
											$hiddenFieldsArray = explode(',',$row['hidden_fields']);
											foreach($hiddenFieldsArray as $hf){
												$hiddenfields[$hf] = $hf;
											}
										}
									?>
									  <div class="form-group row" >
										<label for="Insurance Type" class=" control-label col-md-4 text-left">Select fields which will hidden during claim</label>
										<div class="col-md-6">
										  <select name='hidden_fields[]' multiple rows='5' id='insurance_type' class='select2'>
											<option @if($hiddenfields['hospital_name']) selected @endif value="hospital_name">Hospital Name</option>
											<option @if($hiddenfields['admit_date']) selected @endif value="admit_date">Admit Date</option>
											<option @if($hiddenfields['release_date']) selected @endif value="release_date">Release Date</option>
										  </select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div>

									  <div class="form-group row " >
										<label for="Display Priority" class=" control-label col-md-4 text-left">Display Priority</label>
										<div class="col-md-6">
										  <input  type='text' name='sort_position' id='sort_position' value='{{ $row['sort_position'] }}' class='form-control form-control-sm' /> 
										 </div> 
										 <div class="col-md-2"></div>
									  </div> 
									  
									  <div class="form-group row  " >
										<label for="Status" class=" control-label col-md-4 text-left"> Status </label>
										<div class="col-md-6">
										  
										<?php $status = explode(',',$row['status']);
										$status_opt = array( '1' => 'Active' ,  '2' => 'Inactive' , ); ?>
										<select name='status' rows='5'   class='select2 '  > 
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
		
		
		
		$("#insurance_type").jCombo("{!! url('insuranceplans/comboselect?filter=con_insurance_type:id:title') !!}",
		{  selected_value : '{{ $row["insurance_type"] }}' });
		
		$("#premium_period").jCombo("{!! url('insuranceplans/comboselect?filter=con_periods:id:title') !!}",
		{  selected_value : '{{ $row["premium_period"] }}' });
		
		$("#insurance_provider").jCombo("{!! url('insuranceplans/comboselect?filter=tb_users:id:first_name') !!}&parent=group_id:3:",
		{  parent: '#group_id:3', selected_value : '{{ $row["insurance_provider"] }}' });
		 	
		 	 

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("insuranceplans/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop