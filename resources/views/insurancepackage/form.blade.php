@extends('layouts.app')

@section('content')
<div class="page-header"><h2> {{ $pageTitle }} <small> {{ $pageNote }} </small> </h2></div>

	{!! Form::open(array('url'=>'insurancepackage?return='.$return, 'class'=>'form-horizontal validated concave-form','files' => true ,'id'=> 'FormTable' )) !!}
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
						<fieldset><legend> Insurance Package Creation</legend>
				{!! Form::hidden('id', $row['id']) !!}					
									  <div class="form-group row  " >
										<label for="Title" class=" control-label col-md-4 text-left"> Title <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='title' id='title' value='{{ $row['title'] }}' 
						required     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Thumbnail" class=" control-label col-md-4 text-left"> Thumbnail </label>
										<div class="col-md-6">
										  
						<div class="fileUpload btn " > 
						    <span>  <i class="fa fa-camera"></i>  </span>
						    <div class="title"> Browse File </div>
						    <input type="file" name="thumbnail" class="upload"   accept="image/x-png,image/gif,image/jpeg"     />
						</div>
						<div class="thumbnail-preview preview-upload">
							{!! SiteHelpers::showUploadedFile( $row["thumbnail"],"/uploads/images") !!}
						</div>
					 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Banner" class=" control-label col-md-4 text-left"> Banner </label>
										<div class="col-md-6">
										  
						<div class="fileUpload btn " > 
						    <span>  <i class="fa fa-camera"></i>  </span>
						    <div class="title"> Browse File </div>
						    <input type="file" name="banner" class="upload"   accept="image/x-png,image/gif,image/jpeg"     />
						</div>
						<div class="banner-preview preview-upload">
							{!! SiteHelpers::showUploadedFile( $row["banner"],"/uploads/images") !!}
						</div>
					 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Short Description" class=" control-label col-md-4 text-left"> Short Description <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <textarea name='short_description' rows='5' id='editor' class='form-control form-control-sm editor '  
						required >{{ $row['short_description'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Description" class=" control-label col-md-4 text-left"> Description <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <textarea name='description' rows='5' id='editor' class='form-control form-control-sm editor '  
						required >{{ $row['description'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Terms And Conditions" class=" control-label col-md-4 text-left"> Terms And Conditions <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <textarea name='terms_and_conditions' rows='5' id='editor' class='form-control form-control-sm editor '  
						required >{{ $row['terms_and_conditions'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Exclusion Clauses" class=" control-label col-md-4 text-left"> Exclusion Clauses <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <textarea name='exclusion_clauses' rows='5' id='editor' class='form-control form-control-sm editor '  
						required >{{ $row['exclusion_clauses'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Insurance Type" class=" control-label col-md-4 text-left"> Insurance Type </label>
										<div class="col-md-6">
										  <select name='insurance_type[]' multiple rows='5' id='insurance_type' class='select2'></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Package Duration" class=" control-label col-md-4 text-left"> Package Duration </label>
										<div class="col-md-6">
										  <select name='package_duration' rows='5' id='package_duration' class='select2 '   ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> {!! Form::hidden('price', $row['price']) !!}					
								    <div class="form-group row" >
										<label for="Family Pricing" class=" control-label col-md-4 text-left">Pricing</label>
										
										<div class="col-md-6">
										    <div class="row family_pricing_inputs">
											<?php 
											
											$dbData= $row['family_pricing'];
											$familyData = [];
											if(!$dbData){
												$familyData['price'] = 0;
												$familyData['number_of_people'] = 0;
											}else{
												$familyData = unserialize($dbData);
											}
											?>
											
											
										        @foreach($familyData as $fdata)
										        @php if($fdata['number_of_people'] == '' || $fdata['number_of_people'] == NULL) continue; @endphp
										        <div class="col-md-6"> 
    										        <select class="form-control form-control-sm" name="family_pricing[number_of_people][]" >'+
                                                        <option value="" disabled>-- Select Person --</option>
                                                        <option value="1"  @if($fdata['number_of_people'] == 1 ) selected @endif >For 1 Person</option>
                                                        <option value="2"  @if($fdata['number_of_people'] == 2 ) selected @endif >For 2 Person</option>
                                                        <option value="3"  @if($fdata['number_of_people'] == 3 ) selected @endif >For 3 Person</option>
                                                        <option value="4"  @if($fdata['number_of_people'] == 4 ) selected @endif >For 4 Person</option>
                                                        <option value="5"  @if($fdata['number_of_people'] == 5 ) selected @endif >For 5 Person</option>
                                                        <option value="6"  @if($fdata['number_of_people'] == 6 ) selected @endif >For 6 Person</option>
                                                        <option value="7"  @if($fdata['number_of_people'] == 7 ) selected @endif >For 7 Person</option>
                                                        <option value="8"  @if($fdata['number_of_people'] == 8 ) selected @endif >For 8 Person</option>
                                                        <option value="9"  @if($fdata['number_of_people'] == 9 ) selected @endif >For 9 Person</option>
                                                        <option value="10" @if($fdata['number_of_people'] == 10 ) selected @endif >For 10 Person</option>
                                        		    </select>
                                    		    </div>
                                                <div class="col-md-6">
                                                    <input placeholder="Price" type="number" name="family_pricing[price][]" value="{{ $fdata['price'] }}"  class="form-control form-control-sm family_pricing" />
                                                </div>
										        
										        @endforeach
										    </div>
										</div> 
										 <div class="col-md-2"><a href="javascript:void(0)" id="add_more_price" class="btn btn-success">Add new row</a></div>
									</div>				
									  <div class="form-group row  " >
										<label for="Segment" class=" control-label col-md-4 text-left"> Segment </label>
										<div class="col-md-6">
										  
					<?php $segment = explode(',',$row['segment']);
					$segment_opt = array( '0' => 'B2C' ,  '1' => 'B2B' ,  '2' => 'Both' , ); ?>
					<select name='segment' rows='5'   class='select2 '  > 
						<?php 
						foreach($segment_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['segment'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
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
									  </div>
									  
									  
									  
									  </fieldset></div>
	
		</div>

		<input type="hidden" name="action_task" value="save" />
		
		</div>
	</div>		
	{!! Form::close() !!}
		 
   <script type="text/javascript">
	$(document).ready(function() {

		$("#insurance_type").jCombo("{!! url('insurancepackage/comboselect?filter=con_insurance:id:title|claim_amount') !!}",
		{  selected_value : '{{ $row["insurance_type"] }}' });
		
		$("#package_duration").jCombo("{!! url('insurancepackage/comboselect?filter=con_periods:id:title') !!}",
		{  selected_value : '{{ $row["package_duration"] }}' });

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("insurancepackage/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	
	jQuery(document).on('click','#add_more_price',function(){
        var html = '<div class="col-md-6"> <select class="form-control form-control-sm" name="family_pricing[number_of_people][]" >'+
                        '<option value="" disabled selected>-- Select Person --</option>'+
                        '<option value="1" >For 1 Person</option>'+
                        '<option value="2" >For 2 Person</option>'+
                        '<option value="3" >For 3 Person</option>'+
                        '<option value="4" >For 4 Person</option>'+
                        '<option value="5" >For 5 Person</option>'+
                        '<option value="6" >For 6 Person</option>'+
                        '<option value="7" >For 7 Person</option>'+
                        '<option value="8" >For 8 Person</option>'+
                        '<option value="9" >For 9 Person</option>'+
                        '<option value="10" >For 10 Person</option>'+
        		    '</select></div>'+
                '</div>'+
                '<div class="col-md-6"> <input placeholder="Price" type="number" name="family_pricing[price][]"  class="form-control form-control-sm family_pricing" /></div>';
        jQuery('.family_pricing_inputs').append(html);
	});
	
	
	</script>		 
@stop