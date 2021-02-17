

		 {!! Form::open(array('url'=>'settings', 'class'=>'form-vertical','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


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
									  <div class="form-group  " >
										<label for="ipt" class=" control-label "> Copyright Text    </label>									
										  <input  type='text' name='copyright_text' id='copyright_text' value='{{ $row['copyright_text'] }}' 
						     class='form-control form-control-sm ' /> 						
									  </div> 
				</div>
				
				

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
		
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
