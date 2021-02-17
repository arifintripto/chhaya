<div class="container" class="pt-3 pb-3">
    <div class="row m-b-lg animated fadeInDown delayp1 text-center">
        <h3> {{ $pageTitle }} <small> {{ $pageNote }} </small></h3>
        <hr />       
    </div>
</div>
<div class="m-t">
	<div class="table-container" > 	

		<table class="table table-striped table-bordered" >
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
						<td>{{ $row->documents}} </td>
						
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
						
					<tr>
						<td width='30%' class='label-view text-right'></td>
						<td> <a href="javascript:history.go(-1)"> Back To Grid <a> </td>
						
					</tr>					
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	