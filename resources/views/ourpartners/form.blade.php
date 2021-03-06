@extends('layouts.app')

@section('content')
<div class="page-header"><h2> {{ $pageTitle }} <small> {{ $pageNote }} </small> </h2></div>

	{!! Form::open(array('url'=>'ourpartners?return='.$return, 'class'=>'form-horizontal validated concave-form','files' => true ,'id'=> 'FormTable' )) !!}
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
						<fieldset><legend> Our Partners</legend>
				{!! Form::hidden('id', $row['id']) !!}					
									  <div class="form-group row  " >
										<label for="Title" class=" control-label col-md-4 text-left"> Title <span style="color:red">*</span> </label>
										<div class="col-md-6">
										  <input required type='text' name='title' id='title' value='{{ $row['title'] }}' 
						     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Weblink" class=" control-label col-md-4 text-left"> Weblink </label>
										<div class="col-md-6">
										  <input  type='text' name='weblink' id='weblink' value='{{ $row['weblink'] }}' 
						     class='form-control form-control-sm' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row " >
										<label for="Logo" class=" control-label col-md-4 text-left"> Logo<span style="color:red">*</span> </label>
										<div class="col-md-6">
										  
						<div class="fileUpload btn " > 
						    <span>  <i class="fa fa-file"></i>  </span>
						    <div class="title"> Browse File </div>
						    <input required type="file" name="logo" class="upload"   accept="image/x-png,image/gif,image/jpeg"     />
						</div>
						<div class="logo-preview preview-upload">
							{!! SiteHelpers::showUploadedFile( $row["logo"],"/uploads/images") !!}
						</div>
					 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  
									  <div class="form-group row" >
										<label for="Status" class=" control-label col-md-4 text-left"> Status <span style="color:red">*</span> </label>
										<div class="col-md-6">
										   <select required name='status' class='form-control'>
										      <option value='1' @if($row['status']==1) selected @endif>Active</option>
										      <option value='2' @if($row['status']==2) selected @endif>Inactive</option>
										  </select> 
										 </div> 
										 <div class="col-md-2"></div>
									  </div> 
									  
						</fieldset></div>
	
		</div>

		<input type="hidden" name="action_task" value="save" />
		
		</div>
	</div>		
	{!! Form::close() !!}
		 
   <script type="text/javascript">
	$(document).ready(function() { 

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("ourpartners/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop