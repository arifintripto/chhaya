@extends('layouts.app')

@section('content')
<div class="page-header"><h2> {{ $pageTitle }} <small> {{ $pageNote }} </small></h2></div>

<div class="toolbar-nav">
	<div class="row">
		<div class="col-md-6 ">
			@if($access['is_add'] ==1)
	   		<a href="{{ url('insuranceplans/'.$id.'/edit?return='.$return) }}" class="tips btn btn-default btn-sm  " title="{{ __('core.btn_edit') }}"><i class="fa  fa-pencil"></i></a>
			@endif
			<a href="{{ url('insuranceplans?return='.$return) }}" class="tips btn btn-default  btn-sm  " title="{{ __('core.btn_back') }}"><i class="fa  fa-times"></i></a>		
		</div>
		<div class="col-md-6 text-right">			
	   		<a href="{{ ($prevnext['prev'] != '' ? url('insuranceplans/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips btn btn-default  btn-sm"><i class="fa fa-arrow-left"></i>  </a>	
			<a href="{{ ($prevnext['next'] != '' ? url('insuranceplans/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips btn btn-default btn-sm "> <i class="fa fa-arrow-right"></i>  </a>					
		</div>	

		
		
	</div>
</div>
<div class="p-5">		

	<div class="table-responsive">
		<table class="table table-striped table-bordered " >
			<tbody>	
		
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Id', (isset($fields['id']['language'])? $fields['id']['language'] : array())) }}</td>
						<td>{{ $row->id}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Title', (isset($fields['title']['language'])? $fields['title']['language'] : array())) }}</td>
						<td>{{ $row->title}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Icon', (isset($fields['icon']['language'])? $fields['icon']['language'] : array())) }}</td>
						<td>{{ $row->icon}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Required Doccuments', (isset($fields['required_doccuments']['language'])? $fields['required_doccuments']['language'] : array())) }}</td>
						<td>{{ $row->required_doccuments}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Coverage Text', (isset($fields['coverage_text']['language'])? $fields['coverage_text']['language'] : array())) }}</td>
						<td>{{ $row->coverage_text}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Insurance Type', (isset($fields['insurance_type']['language'])? $fields['insurance_type']['language'] : array())) }}</td>
						<td>{{ SiteHelpers::formatLookUp($row->insurance_type,'insurance_type','1:con_insurance_type:id:title') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Claim Amount', (isset($fields['claim_amount']['language'])? $fields['claim_amount']['language'] : array())) }}</td>
						<td>{{ $row->claim_amount}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Details Of Coverage', (isset($fields['details_of_coverage']['language'])? $fields['details_of_coverage']['language'] : array())) }}</td>
						<td>{{ $row->details_of_coverage}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Premium Period', (isset($fields['premium_period']['language'])? $fields['premium_period']['language'] : array())) }}</td>
						<td>{{ SiteHelpers::formatLookUp($row->premium_period,'premium_period','1:con_periods:id:title') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Insurance Provider', (isset($fields['insurance_provider']['language'])? $fields['insurance_provider']['language'] : array())) }}</td>
						<td>{{ $row->insurance_provider}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Hidden Fields', (isset($fields['hidden_fields']['language'])? $fields['hidden_fields']['language'] : array())) }}</td>
						<td>{{ $row->hidden_fields}} </td>
						
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
