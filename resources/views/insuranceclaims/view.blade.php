@extends('layouts.app')

@section('content')
<div class="page-header"><h2> {{ $pageTitle }} <small> {{ $pageNote }} </small></h2></div>

<div class="toolbar-nav">
	<div class="row">
		<div class="col-md-6 ">
			@if($access['is_add'] ==1)
	   		<a href="{{ url('insuranceclaims/'.$id.'/edit?return='.$return) }}" class="tips btn btn-default btn-sm  " title="{{ __('core.btn_edit') }}"><i class="fa  fa-pencil"></i></a>
			@endif
			<a href="{{ url('insuranceclaims?return='.$return) }}" class="tips btn btn-default  btn-sm  " title="{{ __('core.btn_back') }}"><i class="fa  fa-times"></i></a>		
		</div>
		<div class="col-md-6 text-right">			
	   		<a href="{{ ($prevnext['prev'] != '' ? url('insuranceclaims/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips btn btn-default  btn-sm"><i class="fa fa-arrow-left"></i>  </a>	
			<a href="{{ ($prevnext['next'] != '' ? url('insuranceclaims/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips btn btn-default btn-sm "> <i class="fa fa-arrow-right"></i>  </a>					
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
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Insurance Title', (isset($fields['insurance_id']['language'])? $fields['insurance_id']['language'] : array())) }}</td>
						<td>{{ SiteHelpers::formatLookUp($row->insurance_id,'insurance_id','1:con_insurance:id:title') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Package Title', (isset($fields['package_id']['language'])? $fields['package_id']['language'] : array())) }}</td>
						<td>{{ SiteHelpers::formatLookUp($row->package_id,'package_id','1:con_package:id:title') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Documents', (isset($fields['documents']['language'])? $fields['documents']['language'] : array())) }}</td>
						<td>
						@php
							$files = explode(',',$row->documents);
							
							foreach($files as $f){
								
								$extension = end(explode('.',$f));
								if($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'gif' ){
									echo '<a href="/uploads/files/'.$f.'" target="_blank"><img height="100px" src="/uploads/files/'.$f.'"></a>';
								}else{
									echo '<a href="/uploads/files/'.$f.'" target="_blank"><img height="100px" src="/uploads/images/example.png"></a>';
								}
							}
						@endphp
						
						</td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Payment Method', (isset($fields['payment_method']['language'])? $fields['payment_method']['language'] : array())) }}</td>
						<td>{{ $row->payment_method}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Hospital Name', (isset($fields['hospital_name']['language'])? $fields['hospital_name']['language'] : array())) }}</td>
						<td>{{ $row->hospital_name}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Admit Date', (isset($fields['admit_date']['language'])? $fields['admit_date']['language'] : array())) }}</td>
						<td>{{ $row->admit_date}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Release Date', (isset($fields['release_date']['language'])? $fields['release_date']['language'] : array())) }}</td>
						<td>{{ $row->release_date}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Premium', (isset($fields['premium']['language'])? $fields['premium']['language'] : array())) }}</td>
						<td>{{ $row->premium}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Payment Note', (isset($fields['payment_note']['language'])? $fields['payment_note']['language'] : array())) }}</td>
						<td>{{ $row->payment_note}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Insurance For', (isset($fields['entry_by']['language'])? $fields['entry_by']['language'] : array())) }}</td>
						<td>{{ SiteHelpers::formatLookUp($row->entry_by,'entry_by','1:tb_users:id:first_name') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Claim Note', (isset($fields['claim_note']['language'])? $fields['claim_note']['language'] : array())) }}</td>
						<td>{{ $row->claim_note}} </td>
						
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
