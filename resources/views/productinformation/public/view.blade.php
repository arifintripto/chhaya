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
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Title', (isset($fields['title']['language'])? $fields['title']['language'] : array())) }}</td>
						<td>{{ $row->title}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Slug', (isset($fields['slug']['language'])? $fields['slug']['language'] : array())) }}</td>
						<td>{{ $row->slug}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Meta Title', (isset($fields['meta_title']['language'])? $fields['meta_title']['language'] : array())) }}</td>
						<td>{{ $row->meta_title}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Meta Description', (isset($fields['meta_description']['language'])? $fields['meta_description']['language'] : array())) }}</td>
						<td>{{ $row->meta_description}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Packages', (isset($fields['packages']['language'])? $fields['packages']['language'] : array())) }}</td>
						<td>{{ SiteHelpers::formatLookUp($row->packages,'packages','1:con_package:id:title') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Banner', (isset($fields['banner']['language'])? $fields['banner']['language'] : array())) }}</td>
						<td>{{ $row->banner}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Thumbnail', (isset($fields['thumbnail']['language'])? $fields['thumbnail']['language'] : array())) }}</td>
						<td>{{ $row->thumbnail}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Overview', (isset($fields['overview']['language'])? $fields['overview']['language'] : array())) }}</td>
						<td>{{ $row->overview}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Features', (isset($fields['features']['language'])? $fields['features']['language'] : array())) }}</td>
						<td>{{ $row->features}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Terms', (isset($fields['terms']['language'])? $fields['terms']['language'] : array())) }}</td>
						<td>{{ $row->terms}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Is Featured', (isset($fields['is_featured']['language'])? $fields['is_featured']['language'] : array())) }}</td>
						<td>{{ $row->is_featured}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Attachment', (isset($fields['attachment']['language'])? $fields['attachment']['language'] : array())) }}</td>
						<td>{{ $row->attachment}} </td>
						
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