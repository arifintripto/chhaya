@extends('layouts.app')

@section('content')
<div class="page-header"><h2> {{ $pageTitle }} <small> {{ $pageNote }} </small></h2></div>

<div class="toolbar-nav">
	<div class="row">
		<div class="col-md-6 ">
			@if($access['is_add'] ==1)
	   		<a href="{{ url('insurancepackage/'.$id.'/edit?return='.$return) }}" class="tips btn btn-default btn-sm  " title="{{ __('core.btn_edit') }}"><i class="fa  fa-pencil"></i></a>
			@endif
			<a href="{{ url('insurancepackage?return='.$return) }}" class="tips btn btn-default  btn-sm  " title="{{ __('core.btn_back') }}"><i class="fa  fa-times"></i></a>		
		</div>
		<div class="col-md-6 text-right">			
	   		<a href="{{ ($prevnext['prev'] != '' ? url('insurancepackage/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips btn btn-default  btn-sm"><i class="fa fa-arrow-left"></i>  </a>	
			<a href="{{ ($prevnext['next'] != '' ? url('insurancepackage/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips btn btn-default btn-sm "> <i class="fa fa-arrow-right"></i>  </a>					
		</div>	

		
		
	</div>
</div>
<div class="p-5">		

	<div class="table-responsive">
		<table class="table table-striped table-bordered " >
			<tbody>	
		
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Package ID', (isset($fields['id']['language'])? $fields['id']['language'] : array())) }}</td>
						<td>{{ $row->id}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Title', (isset($fields['title']['language'])? $fields['title']['language'] : array())) }}</td>
						<td>{{ $row->title}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Thumbnail', (isset($fields['thumbnail']['language'])? $fields['thumbnail']['language'] : array())) }}</td>
						<td> <img width="150px" src="{{ asset('uploads/images/'.$row->thumbnail)}}" alt="No Image Available" > </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Banner', (isset($fields['banner']['language'])? $fields['banner']['language'] : array())) }}</td>
						<td> <img width="150px" src="{{ asset('uploads/images/'.$row->banner)}}" alt="No Image Available" > </td>
			
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Short Description', (isset($fields['short_description']['language'])? $fields['short_description']['language'] : array())) }}</td>
						<td>{!! $row->short_description !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Description', (isset($fields['description']['language'])? $fields['description']['language'] : array())) }}</td>
						<td>{!! $row->description !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Terms And Conditions', (isset($fields['terms_and_conditions']['language'])? $fields['terms_and_conditions']['language'] : array())) }}</td>
						<td>{!! $row->terms_and_conditions !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Exclusion Clauses', (isset($fields['exclusion_clauses']['language'])? $fields['exclusion_clauses']['language'] : array())) }}</td>
						<td>{!! $row->exclusion_clauses !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Insurance Type', (isset($fields['insurance_type']['language'])? $fields['insurance_type']['language'] : array())) }}</td>
						<td>
							@foreach( explode(',',$row->insurance_type) as $plan_id)
							{{ App\Models\Insuranceplans::where('id',$plan_id)->first()->title }}<br>
							@endforeach
						
						</td>

					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Package Duration', (isset($fields['package_duration']['language'])? $fields['package_duration']['language'] : array())) }}</td>
						<td>{{ SiteHelpers::formatLookUp($row->package_duration,'package_duration','1:con_periods:id:title') }} </td>
						
					</tr>
				
					<!-- <tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Price', (isset($fields['price']['language'])? $fields['price']['language'] : array())) }}</td>
						<td>{{ $row->price}} </td>
						
					</tr> -->
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Pricing', (isset($fields['family_pricing']['language'])? $fields['family_pricing']['language'] : array())) }}</td>
						<td>
							@foreach(unserialize($row->family_pricing) as $p)
							@if($p['price'])
								Taka {{$p['price']}} for {{ $p['number_of_people'] }} person<br>
							@endif
							@endforeach
						</td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Segment', (isset($fields['segment']['language'])? $fields['segment']['language'] : array())) }}</td>
						<td> @if($row->segment == 0) B2C @elseif($row->segment == 1) B2B @else Both @endif </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Status', (isset($fields['status']['language'])? $fields['status']['language'] : array())) }}</td>
						<td>{{ SiteHelpers::formatLookUp($row->status,'status','1:con_status:id:name') }} </td>
						
					</tr>
				
			</tbody>	
		</table>   

	 	

	</div>

</div>
@stop
