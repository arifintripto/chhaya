@extends('layouts.app')
@section('content')

@php 
    $package = \App\Models\Insurancepackage::find($row->package_id);
    $duration = \App\Models\Periods::find($package->package_duration);
@endphp

<style>
    .title_h {
        padding: 10px;
        margin: 10px 0;
        font-size: 16px;
        background: #129748;
        color: #fff;
    }
    .insuredPersons table{margin-bottom:20px;}
</style>
<div class="page-header"><h2> {{ $pageTitle }} <small> {{ $pageNote }} </small></h2></div>
<div class="toolbar-nav">
	<div class="row">
		<div class="col-md-6 ">
			@if($access['is_add'] ==1)
	   		<a href="{{ url('insurancesubscriptions/'.$id.'/edit?return='.$return) }}" class="tips btn btn-default btn-sm  " title="{{ __('core.btn_edit') }}"><i class="fa  fa-pencil"></i></a>
			@endif
			<a href="{{ url('insurancesubscriptions?return='.$return) }}" class="tips btn btn-default  btn-sm  " title="{{ __('core.btn_back') }}"><i class="fa  fa-times"></i></a>		
		</div>
		<div class="col-md-6 text-right">			
	   		<a href="{{ ($prevnext['prev'] != '' ? url('insurancesubscriptions/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips btn btn-default  btn-sm"><i class="fa fa-arrow-left"></i>  </a>	
			<a href="{{ ($prevnext['next'] != '' ? url('insurancesubscriptions/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips btn btn-default btn-sm "> <i class="fa fa-arrow-right"></i>  </a>					
		</div>	

		
		
	</div>
</div>
<div class="p-5">		
<h5 class="title_h">Subscription Details</h5>
	<div class="table-responsive">
		<table class="table table-striped table-bordered" >
			<tbody>	
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Subscription ID', (isset($fields['id']['language'])? $fields['id']['language'] : array())) }}</td>
						<td>{{ $row->id}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Package Name', (isset($fields['package_id']['language'])? $fields['package_id']['language'] : array())) }}</td>
						<td>{{ SiteHelpers::formatLookUp($row->package_id,'package_id','1:con_package:id:title') }} </td>
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Created Time', (isset($fields['created_at']['language'])? $fields['created_at']['language'] : array())) }}</td>
						<td>{{ $row->created_at}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Updated  Time', (isset($fields['updated_at']['language'])? $fields['updated_at']['language'] : array())) }}</td>
						<td>{{ $row->updated_at}} </td>
						
					</tr>
					
					<tr>
						<td width='30%' class='label-view text-right'>Expired Date</td>
						<td>{{ date('Y-m-d', strtotime($row->updated_at. ' + '.$duration->number_of_days.' days')) }} </td>
						
					</tr>

					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Transaction ID', (isset($fields['transaction_id']['language'])? $fields['transaction_id']['language'] : array())) }}</td>
						<td>{{ $row->transaction_id}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Number Of People', (isset($fields['number_of_people']['language'])? $fields['number_of_people']['language'] : array())) }}</td>
						<td>{{ $row->number_of_people}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Price', (isset($fields['price']['language'])? $fields['price']['language'] : array())) }}</td>
						<td>BDT {{ $row->price}} </td>
						
					</tr>

					<tr>
						<td width='30%' class='label-view text-right'>Insured Person Name</td>
						<td>{{ SiteHelpers::formatLookUp($row->entry_by,'entry_by','1:tb_users:id:first_name|last_name') }} </td>
						
					</tr>
					
					@if(\Auth::user()->group_id != 7)
					<tr>
						<td width='30%' class='label-view text-right'>B2C User</td>
						<td>{{ SiteHelpers::formatLookUp($row->agent_id,'agent_id','1:tb_users:id:first_name|last_name') }} </td>
					</tr>
					@endif
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Status', (isset($fields['status']['language'])? $fields['status']['language'] : array())) }}</td>
						<td>
		
						@if(Helper::verifyOrder($row->id))
							{{ SiteHelpers::formatLookUp($row->status,'status','1:con_status:id:name') }}
						@else
            				 @if($row->status == 1)
                                Expired
                               @else
                                {{ SiteHelpers::formatLookUp($row->status,'status','1:con_status:id:name') }}
                            @endif
						@endif

						</td>
						
					</tr>
				
			</tbody>	
		</table>   
	</div>
	
	
	@php $familyData = unserialize($row->family_information); @endphp
	@if(count($familyData > 0 ))
	<div class="insuredPersons table-responsive">
	    <h5 class="title_h">Family Member Details</h5>
 
	    @foreach($familyData as $data)
	    @php if($data['fm_fullname'] == NULL) continue @endphp
	    <table class="table table-striped table-bordered">
	        <tr>
	            <td width='30%' class='label-view text-right'>Full Name</td>
	            <td>{{$data['fm_fullname']}}</td>
	        </tr>
	        <tr>
	            <td width='30%' class='label-view text-right'>Date of Birth</td>
	            <td>{{$data['fm_date_of_birth']}}</td>
	        </tr>
	        <tr>
	            <td width='30%' class='label-view text-right'>Relationship</td>
	            <td>{{$data['fm_relationship']}}</td>
	        </tr>
	        <tr>
	            <td width='30%' class='label-view text-right'>Gender</td>
	            <td>{{$data['fm_gender']}}</td>
	        </tr>
	   </table>
	    @endforeach
	    
	</div>
	@endif

</div>
@stop
