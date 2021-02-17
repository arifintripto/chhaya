@extends('layouts.app')

@section('content')
<div class="page-header"><h2> {{ $pageTitle }} <small> {{ $pageNote }} </small> </h2></div>

	{!! Form::open(array('url'=>'settings?return='.$return, 'class'=>'form-vertical validated concave-form','files' => true ,'id'=> 'FormTable' )) !!}
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
	<ul class="nav nav-tabs form-tab"><li class=" nav-item "><a href="#SiteGraphics" data-toggle="tab" class="nav-link active">Site Graphics</a></li>
				<li class=" nav-item "><a href="#SocialLinks" data-toggle="tab" class="nav-link ">Social Links</a></li>
				<li class=" nav-item "><a href="#OtherSettings" data-toggle="tab" class="nav-link ">Other Settings</a></li>
				</ul><div class="tab-content"><div class="tab-pane m-t active" id="SiteGraphics"> 
				{!! Form::hidden('id', $row['id']) !!}					
									  <div class="form-group  " >
										<label for="ipt" class=" control-label "> Logo   <a href="#" data-toggle="tooltip" placement="left" class="tips" title="Image Size 180*80"><i class="icon-question2"></i></a> </label>									
										  
						<div class="fileUpload btn " > 
						    <span>  <i class="fa fa-camera"></i>  </span>
						    <div class="title"> Browse File </div>
						    <input type="file" name="logo" class="upload"   accept="image/x-png,image/gif,image/jpeg"     />
						</div>
						<div class="logo-preview preview-upload">
							{!! SiteHelpers::showUploadedFile( $row["logo"],"/uploads/images") !!}
						</div>
					 						
									  </div> 					
									  <div class="form-group  " >
										<label for="ipt" class=" control-label "> Favicon   <a href="#" data-toggle="tooltip" placement="left" class="tips" title="Image Size 16*16"><i class="icon-question2"></i></a> </label>									
										  
						<div class="fileUpload btn " > 
						    <span>  <i class="fa fa-camera"></i>  </span>
						    <div class="title"> Browse File </div>
						    <input type="file" name="favicon" class="upload"   accept="image/x-png,image/gif,image/jpeg"     />
						</div>
						<div class="favicon-preview preview-upload">
							{!! SiteHelpers::showUploadedFile( $row["favicon"],"/uploads/images") !!}
						</div>
					 						
									  </div> 
				</div>
				
				<div class="tab-pane m-t " id="SocialLinks"> 
									
									  <div class="form-group  " >
										<label for="ipt" class=" control-label "> Facebook    </label>									
										  <input  type='text' name='facebook' id='facebook' value='{{ $row['facebook'] }}' 
						     class='form-control form-control-sm ' /> 						
									  </div> 					
									  <div class="form-group  " >
										<label for="ipt" class=" control-label "> Twitter    </label>									
										  <input  type='text' name='twitter' id='twitter' value='{{ $row['twitter'] }}' 
						     class='form-control form-control-sm ' /> 						
									  </div> 					
									  <div class="form-group  " >
										<label for="ipt" class=" control-label "> Youtube    </label>									
										  <input  type='text' name='youtube' id='youtube' value='{{ $row['youtube'] }}' 
						     class='form-control form-control-sm ' /> 						
									  </div> 					
									  <div class="form-group  " >
										<label for="ipt" class=" control-label "> Instagram    </label>									
										  <input  type='text' name='instagram' id='instagram' value='{{ $row['instagram'] }}' 
						     class='form-control form-control-sm ' /> 						
									  </div> 					
									  <div class="form-group  " >
										<label for="ipt" class=" control-label "> Pinterest    </label>									
										  <input  type='text' name='pinterest' id='pinterest' value='{{ $row['pinterest'] }}' 
						     class='form-control form-control-sm ' /> 						
									  </div> 					
									  <div class="form-group  " >
										<label for="ipt" class=" control-label "> Linkedin    </label>									
										  <input  type='text' name='linkedin' id='linkedin' value='{{ $row['linkedin'] }}' 
						     class='form-control form-control-sm ' /> 						
									  </div> 
				</div>
				
				<div class="tab-pane m-t " id="OtherSettings"> 
									
									  <div class="form-group  " >
										<label for="ipt" class=" control-label "> Phone    </label>									
										  <input  type='text' name='phone' id='phone' value='{{ $row['phone'] }}' 
						     class='form-control form-control-sm ' /> 						
									  </div> 					
									  <div class="form-group  " >
										<label for="ipt" class=" control-label "> Email    </label>									
										  <input  type='text' name='email' id='email' value='{{ $row['email'] }}' 
						     class='form-control form-control-sm ' /> 						
									  </div> 					
									  <div class="form-group  " >
										<label for="ipt" class=" control-label "> Address    </label>									
										  <textarea name='address' rows='5' id='address' class='form-control form-control-sm '  
				           >{{ $row['address'] }}</textarea> 						
									  </div> 					
									  <div class="form-group  " >
										<label for="ipt" class=" control-label "> Hours    </label>									
										  <input  type='text' name='hours' id='hours' value='{{ $row['hours'] }}' 
						     class='form-control form-control-sm ' /> 						
									  </div> 					
									  <div class="form-group  " >
										<label for="ipt" class=" control-label "> Welcome Text    </label>									
										  <input  type='text' name='welcome_text' id='welcome_text' value='{{ $row['welcome_text'] }}' 
						     class='form-control form-control-sm ' /> 						
									  </div> 					
									  <div class="form-group  " >
										<label for="ipt" class=" control-label "> About Note    </label>									
										  <textarea name='about_note' rows='5' id='about_note' class='form-control form-control-sm '  
				           >{{ $row['about_note'] }}</textarea> 						
									  </div> 					
									  <div class="form-group" >
										<label for="ipt" class=" control-label "> Copyright Text    </label>									
										  <input  type='text' name='copyright_text' id='copyright_text' value='{{ $row['copyright_text'] }}' 
						     class='form-control form-control-sm' /> 						
									  </div> 
									  
								
								@php
								$disabled = $row['disabled_sales_team'];
								$selectedArray = [];
								if($disabled){
									$selectedArray = explode(',',$disabled);
								}
								@endphp
							 <div class="form-group" >
								<label  class=" control-label ">Disable Sales Team Creation</label>									
								<select name="disabled_sales_team[]" id="disabled_sales_team" class="form-control select2" multiple>
									<option  value="0" disabled>-- Select Hierarchy Level -- </option>
									<option @if(in_array(1,$selectedArray)) selected @endif value="1">Head of Sales</option>
									<option @if(in_array(2,$selectedArray)) selected @endif value="2">Regional Manager</option>
									<option @if(in_array(3,$selectedArray)) selected @endif value="3">Sales Manager</option>
									<option @if(in_array(4,$selectedArray)) selected @endif value="4">Area Manager</option>
									<option @if(in_array(5,$selectedArray)) selected @endif value="5">Teritory Manager</option>
								</select>
							</div> 
				</div>
				
				
	
		</div>

		<input type="hidden" name="action_task" value="save" />
		
		</div>
	</div>		
	{!! Form::close() !!}
		 
   <script type="text/javascript">
	$(document).ready(function() { 
		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("settings/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop