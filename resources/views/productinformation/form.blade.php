@extends('layouts.app')

@section('content')
<div class="page-header"><h2> {{ $pageTitle }} <small> {{ $pageNote }} </small> </h2></div>

	{!! Form::open(array('url'=>'productinformation?return='.$return, 'class'=>'form-horizontal validated concave-form','files' => true ,'id'=> 'FormTable' )) !!}
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
	<div class="col-md-6">
						<fieldset><legend>General Information</legend>
				{!! Form::hidden('id', $row['id']) !!}					
									  <div class="form-group row  " >
										<label for="Title" class=" control-label col-md-3 text-left"> Title <span style="color:red">*</span></label>
										<div class="col-md-9">
										  <input required type='text' name='title' id='title' value='{{ $row['title'] }}' class='form-control form-control-sm' /> 
										 </div> 
										 
									  </div> 

									  
									  <div class="form-group row " >
										<label for="Slug" class=" control-label col-md-3 text-left"> Slug </label>
										<div class="col-md-9">
										  <input  type='text' name='slug' id='slug' value='{{ $row['slug'] }}' class='form-control form-control-sm' /> 
										 </div> 
										 
									  </div> 
									  
									  <div class="form-group row" >
										<label for="Meta Title" class=" control-label col-md-3 text-left"> Meta Title </label>
										<div class="col-md-9">
										  <input  type='text' name='meta_title' id='meta_title' value='{{ $row['meta_title'] }}' class='form-control form-control-sm' /> 
										 </div> 
										 
									  </div> 
									  
									  <div class="form-group row" >
										<label for="Meta Description" class=" control-label col-md-3 text-left"> Meta Description </label>
										<div class="col-md-9">
										  <textarea name='meta_description' rows='5' id='meta_description' class='form-control form-control-sm'  
				           >{{ $row['meta_description'] }}</textarea> 
										 </div> 
										 
									  </div> 	
									  
									  <div class="form-group row" >
										<label for="Packages" class=" control-label col-md-3 text-left"> Packages <span style="color:red">*</span> </label>
										<div class="col-md-9">
										  <select required name='packages[]' multiple rows='5' id='packages' class='select2'></select> 
										 </div> 
										 
									  </div> 					

									  
									  <div class="form-group row" >
										<label for="Overview" class=" control-label col-md-3 text-left"> Overview </label>
										<div class="col-md-9">
										  <textarea name='overview' rows='5' id='editor' class='form-control form-control-sm editor' >{{ $row['overview'] }}</textarea> 
										 </div> 
										 
									  </div> 
									  
									  <div class="form-group row" >
										<label for="Features" class=" control-label col-md-3 text-left"> Features </label>
										<div class="col-md-9">
										  <textarea name='features' rows='5' id='editor' class='form-control form-control-sm editor' >{{ $row['features'] }}</textarea> 
										 </div> 
										 
									  </div> 					

					</fieldset>
		</div>
		<div class="col-md-6">
		<fieldset><legend>Extended Information</legend>
			 <div class="form-group row" >
				<label for="Banner" class=" control-label col-md-3 text-left"> Banner <span style="color:red">*</span> </label>
				<div class="col-md-6">
					<div class="fileUpload btn " > 
						<span>  <i class="fa fa-file"></i>  </span>
						<div class="title"> Browse File </div>
						<input type="file" name="banner" class="upload"   accept="image/x-png,image/gif,image/jpeg"     />
					</div>
					<div class="banner-preview preview-upload">
						{!! SiteHelpers::showUploadedFile( $row["banner"],"/uploads/images") !!}
					</div>
				 </div> 
				 <div class="col-md-2">Image Dimension should be 1920x450 pixels</div>
			  </div> 
			  
			  <div class="form-group row  " >
				<label for="Thumbnail" class=" control-label col-md-3 text-left"> Thumbnail <span style="color:red">*</span> </label>
				<div class="col-md-6">
				  
					<div class="fileUpload btn " > 
						<span>  <i class="fa fa-file"></i>  </span>
						<div class="title"> Browse File </div>
						<input type="file" name="thumbnail" class="upload"   accept="image/x-png,image/gif,image/jpeg"     />
					</div>
					<div class="thumbnail-preview preview-upload">
						{!! SiteHelpers::showUploadedFile( $row["thumbnail"],"/uploads/images") !!}
					</div>

				 </div> 
				 <div class="col-md-2">Image Dimension should be 500x350 pixels</div>
			  </div>

			<div class="form-group row" >
				<label for="Is Featured" class=" control-label col-md-3 text-left"> Is Featured </label>
				<div class="col-md-9">
				  <?php $is_featured = explode(",",$row['is_featured']); ?>
				<input type='checkbox' name='is_featured[]' value ='1'   class=' minimal-green' @if(in_array('1',$is_featured))checked @endif /> YES  
				 </div> 
				 
			  </div> 	
			<div class="form-group row" >
				<label for="Attachment" class=" control-label col-md-3 text-left"> Attachment </label>
				<div class="col-md-9">
						<div class="fileUpload btn " > 
							<span>  <i class="fa fa-file"></i>  </span>
							<div class="title"> Browse File </div>
							<input type="file" name="attachment" class="upload" />
						</div>
						<div class="attachment-preview preview-upload">
							{!! SiteHelpers::showUploadedFile( $row["attachment"],"/uploads/files") !!}
						</div>
				 </div> 

			</div> 
				<div class="form-group row" >
					<label for="Terms" class=" control-label col-md-3 text-left"> Terms </label>
					<div class="col-md-9">
					  <textarea name='terms' rows='5' id='editor' class='form-control form-control-sm editor' >{{ $row['terms'] }}</textarea> 
					 </div> 
				 </div> 	
			<div class="form-group row" >
				<label for="Status" class=" control-label col-md-3 text-left"> Status <span style="color:red">*</span> </label>
				<div class="col-md-9">
				   <select required name='status' class='form-control'>
					  <option value='1' @if($row['status']==1) selected @endif>Active</option>
					  <option value='2' @if($row['status']==2) selected @endif>Inactive</option>
				  </select> 
				 </div> 
				 
			</div> 
		</fieldset>
		</div>
</div>

		<input type="hidden" name="action_task" value="save" />
		
		</div>
	</div>		
	{!! Form::close() !!}
		 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		
		$("#packages").jCombo("{!! url('productinformation/comboselect?filter=con_package:id:title') !!}",
		{  selected_value : '{{ $row["packages"] }}' });
		
		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("productinformation/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop