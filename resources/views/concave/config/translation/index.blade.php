@extends('layouts.app')


@section('content')
<div class="page-header"><h2> {{ $pageTitle }}  <small> {{ $pageNote }} </small> </h2></div>
@include('concave.config.tab',array('active'=>'translation'))
<div class="p-5">



	
 	{!! Form::open(array('url'=>'concave/config/translation/', 'class'=>'form-vertical row')) !!}
		
			<a href="{{ URL::to('concave/config/addtranslation')}} " onclick="ConcaveModal(this.href,'Add New Language');return false;" class="btn btn-sm "><i class="fa fa-plus"></i> New </a>  
			<hr />
			<table class="table table-borderd mt-2">
				<thead>
					<tr>
						<th> Name </th>
						<th> Folder </th>
						<th> Author </th>
						<th> Action </th>
					</tr>
				</thead>
				<tbody>		
			
				@foreach(SiteHelpers::langOption() as $lang)
					<tr>
						<td>  {{  $lang['name'] }}   </td>
						<td> {{  $lang['folder'] }} </td>
						<td> {{  $lang['author'] }} </td>
					  	<td>
						@if($lang['folder'] !='en')
						<a href="{{ URL::to('concave/config/translation?edit='.$lang['folder'])}} " class="btn"> Manage </a>
						<a href="{{ URL::to('concave/config/removetranslation/'.$lang['folder'])}} " onclick="ConcaveConfirmDelete(this.href); return false;" class="btn "> Delete </a> 
						 
						@endif 
					
					</td>
					</tr>
				@endforeach
				
				</tbody>
			</table>
		
		{!! Form::close() !!}

</div>
@endsection