@extends('layouts.app')

@section('content')
<div class="page-header"><h2> Sales Team List </h2></div>

<div class="p-5">		
	<table class="DataTables table-hover cell-border" >
		<thead>
			<td>Serial</td>
			<td>Full Name</td>
			<td>Hierarchy Level</td>
			<td>Sales ID</td>
			<td>Action</td>
		</thead>
		<tbody>	
			@foreach($lowerLevels as $l)
				<tr>
					<td>{{($loop->index)+1}}</td>
					<td>{{$l->first_name}}</td>
					<td>{{$l->hierarchy_level}}</td>
					<td>{{\App\Http\Controllers\AgentController::getAgentMeta($l->id,"agent_serial")}}</td>
					<td> 
					@if(\Auth::id() != $l->id)
						<a href="/core/users/{{$l->id}}/edit" class="btn btn-sm btn-info text-white">Edit</a>
					@endif
					</td>

				</tr>
			@endforeach
			
		</tbody>	
	</table>   


</div>
@stop
