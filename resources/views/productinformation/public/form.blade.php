

		 {!! Form::open(array('url'=>'productinformation', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> productinformation</legend>
				{!! Form::hidden('id', $row['id']) !!}					
									  <div class="form-group row  " >
										<label for="Title" class=" control-label col-md-4 text-left"> Title </label>
										<div class="col-md-6">
										  <input  type='text' name='title' id='title' value='{{ $row['title'] }}' 
						     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Slug" class=" control-label col-md-4 text-left"> Slug </label>
										<div class="col-md-6">
										  <input  type='text' name='slug' id='slug' value='{{ $row['slug'] }}' 
						     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Meta Title" class=" control-label col-md-4 text-left"> Meta Title </label>
										<div class="col-md-6">
										  <input  type='text' name='meta_title' id='meta_title' value='{{ $row['meta_title'] }}' 
						     class='form-control form-control-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Meta Description" class=" control-label col-md-4 text-left"> Meta Description </label>
										<div class="col-md-6">
										  <textarea name='meta_description' rows='5' id='meta_description' class='form-control form-control-sm '  
				           >{{ $row['meta_description'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Packages" class=" control-label col-md-4 text-left"> Packages </label>
										<div class="col-md-6">
										  <select name='packages[]' multiple rows='5' id='packages' class='select2 '   ></select> 
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
										<label for="Overview" class=" control-label col-md-4 text-left"> Overview </label>
										<div class="col-md-6">
										  <textarea name='overview' rows='5' id='editor' class='form-control form-control-sm editor '  
						 >{{ $row['overview'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Features" class=" control-label col-md-4 text-left"> Features </label>
										<div class="col-md-6">
										  <textarea name='features' rows='5' id='editor' class='form-control form-control-sm editor '  
						 >{{ $row['features'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Terms" class=" control-label col-md-4 text-left"> Terms </label>
										<div class="col-md-6">
										  <textarea name='terms' rows='5' id='editor' class='form-control form-control-sm editor '  
						 >{{ $row['terms'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Is Featured" class=" control-label col-md-4 text-left"> Is Featured </label>
										<div class="col-md-6">
										  <?php $is_featured = explode(",",$row['is_featured']); ?>
					  
					<input type='checkbox' name='is_featured[]' value ='1'   class=' minimal-green' 
					@if(in_array('1',$is_featured))checked @endif 
					 /> YES  
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group row  " >
										<label for="Attachment" class=" control-label col-md-4 text-left"> Attachment </label>
										<div class="col-md-6">
										  
						<div class="fileUpload btn " > 
						    <span>  <i class="fa fa-copy"></i>  </span>
						    <div class="title"> Browse File </div>
						    <input type="file" name="attachment" class="upload"       />
						</div>
						<div class="attachment-preview preview-upload">
							{!! SiteHelpers::showUploadedFile( $row["attachment"],"/uploads/files") !!}
						</div>
					 
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
		
		
		$("#packages").jCombo("{!! url('productinformation/comboselect?filter=con_package:id:title') !!}",
		{  selected_value : '{{ $row["packages"] }}' });
		
		$("#status").jCombo("{!! url('productinformation/comboselect?filter=con_status:id:name') !!}",
		{  selected_value : '{{ $row["status"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
