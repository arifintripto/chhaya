@extends('layouts.app')

@section('content')

<div class="page-header"><h2>  {{ $pageTitle }} <small> {{ $pageNote }} </small> </h2></div>

	<div class="toolbar-nav">
		<a href="{{ url($pageModule.'?return='.$return) }}" class="tips btn btn-sm  "  title="{{ __('core.btn_back') }}" ><i class="fa  fa-times"></i></a> 

	</div>	

<div class="p-5 ">

		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>			
			



		 {!! Form::open(array('url'=>'cms/pages', 'class'=>'form-vertical validated','files' => true , 'id'=>'pageForm' )) !!}			
		 <div class="row">
			<div class="col-sm-9 ">
	

						<ul class="nav nav-tabs form-tab" >
						  <li class="nav-item"><a href="#info" data-toggle="tab" class="nav-link active"> Page Content </a></li>
						  <li class="nav-item"><a href="#meta" data-toggle="tab" class="nav-link"> Meta & Description </a></li>
						</ul>	

						<div class="tab-content bg-white">
						  <div class="tab-pane active m-t" id="info">
				  <div class="form-group  " >
					<label for="ipt" > Title </label>
					
					  {!! Form::text('title', $row['title'],array('class'=>'form-control input-sm', 'placeholder'=>'', 'required'=>'true'  )) !!} 
					
				  </div> 					
				  <div class="form-group  " >
					<label for="ipt" class=" btn-primary  btn btn-sm">  {!! url('')!!}/  </label>						 
						{!! Form::text('alias', $row['alias'],array('class'=>'form-control input-sm', 'placeholder'=>'', 'style'=>'width:150px; display:inline-block;' , 'required'=>'true'   )) !!} 
				  </div> 

							  <div class="form-group" >
								<div>
								  <textarea name='note' style="min-height: 200px;" rows='25' id='note' class='form-control editors'  
									 >{{ $row['note'] }}</textarea> 
								 </div> 
							  </div> 						  

						  </div>

						  <div class="tab-pane m-t" id="meta">

					  		<div class="form-group  " >
								<label class=""> Metakey </label>
								<div class="" style="background:#fff;">
								  <textarea name='metakey' rows='5' id='metakey' class='form-control markItUp'>{{ $row['metakey'] }}</textarea> 
								 </div> 
							  </div> 

				  			<div class="form-group  " >
								<label class=""> Meta Description </label>
								<div class="" style="background:#fff;">
								  <textarea name='metadesc' rows='10' id='metadesc' class='form-control markItUp'>{{ $row['metadesc'] }}</textarea> 
								 </div> 
							  </div> 							  						  

						  </div>

						</div>  
		 	</div>		 
		 
		 	<div class="col-sm-3 ">
					
				  <div class="form-group hidethis " style="display:none;">
					<label for="ipt" class=""> PageID </label>
					
					  {!! Form::text('pageID', $row['pageID'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
					
				  </div> 					
					

				  <div class="form-group  " >
				  <label for="ipt"> Who can view this page ? </label>
					@foreach($groups as $group) 
					<div class="">					
					  <input  type='checkbox' name='group_id[{{ $group['id'] }}]'    value="{{ $group['id'] }}"
					  @if($group['access'] ==1 or $group['id'] ==1)
					  	checked
					  @endif	
					  class="minimal-green" 			 
					   /> 
					  <label>{{ $group['name'] }}</label>
					</div>  
					@endforeach	
						  
				  </div> 
				  <div class="form-group  " >
					<label> Show for Guest ? unlogged  </label>
					<div class="">
						<input  type='checkbox' name='allow_guest'  class="minimal-green" 
 						@if($row['allow_guest'] ==1 ) checked  @endif	
					   value="1"	/> <label> Allow Guest ? </label>  </div>
				  </div>


				  	
	
				  <div class="form-group  " >
					<label> Status </label>
					<div class="">					
					  <input  type='radio' name='status'  value="enable" required class="minimal-green" 
					  @if( $row['status'] =='enable')  	checked	  @endif				  
					   /> 
					  <label>Enable </label>
					</div> 
					<div class="">					
					  <input  type='radio' name='status'  value="disabled" required class="minimal-green" 
					   @if( $row['status'] =='disabled')  	checked	  @endif				  
					   /> 
					  <label> Disabled</label>
					</div> 					 
				  </div> 

				  <div class="form-group  " >
					<label> Template </label>
					<div class="">					
					  <input  type='radio' name='template'  value="frontend" required class="minimal-green" 
					  @if( $row['template'] =='frontend')  	checked	  @endif				  
					   /> 
					  <label> Frontend </label>
					</div> 
					<div class="">					
					  <input  type='radio' name='template'  value="backend" required class="minimal-green" 
					   @if( $row['template'] =='backend')  	checked	  @endif				  
					   /> 
					  <label> Backend </label>
					</div> 					 
				  </div> 	

				  <div class="form-group  " >
					<label> Set As Homepage ? </label>
					<div class=""><input  type='checkbox' name='default[]' class="minimal-green" 
 						@if($row['default'] ==1 ) checked  @endif	
					   value="1"	/> <label> Yes </label>  
					</div>					 
				  </div> 
				  <div class="form-group  " >
					<label for="ipt" > Page Template </label>

					<select class="form-control input-sm" name="filename">
						<option value="page"> Select Template </option>
						@foreach($pagetemplate['template'] as $key=> $val)
							<option value="{{ $val }}" @if($row['filename'] == $val) selected @endif>{{ $key}}</option>
						@endforeach


					</select>
					
					  
					
				  </div> 

				  
			  <div class="form-group">
				
				<button type="button" id="saveBtn" class="btn btn-success " name="apply">  Save Change(s) </button>
				<a href="{{ url('cms/pages')}}" class="btn btn-info"> Close </a>
				 
		
			  </div> 
						  				  
				  		
			</div>
		 	<input type="hidden" name="action_task" value="save" />

		</div> 	
		 	{!! Form::close() !!}
	
</div>	


<script>
	$(document).ready(function() { 

		$('.editors').summernote({
			height: 350,
			codemirror: {
				theme: 'monokai'
			}
		});

		$('#saveBtn').click(function(){
			$('#pageForm').submit();
		})

	});

</script>
	
	<style type="text/css">
		#content-editor {
			min-height: 500px;
			border:solid 1px #ddd;
		}
	</style>		 
@stop
