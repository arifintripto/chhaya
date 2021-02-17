<?php
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename='.$title.'-data.'.strtotime(date("d-m-Y")).'.csv');

// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');

	$head= array();
	foreach($fields as $f ){
		if($f['download'] =='1'){
			$limited = isset($field['limited']) ? $field['limited'] :'';
			if(\SiteHelpers::filterColumn($limited )){
				$head[] = $f['label'];
				
			}
		}
	}

	fputcsv($output, $head); 

// fetch the data 

foreach ($rows as $row){
    $content= array();
    foreach($fields as $f ){
        if($f['download'] =='1'){

            if($f['field'] == 'username'){
                $content[]= '="' . \Helper::getExportUser($row->entry_by,$f['field']) . '"';
            }elseif($f['field'] == 'birth_of_day'){
                $content[]= \Helper::getExportUser($row->entry_by,$f['field']);
            }elseif($f['field'] == 'nid'){
                $content[]= \Helper::getExportUser($row->entry_by,$f['field']);
            }elseif($f['field'] == 'state'){
                $content[]= \Helper::getExportUser($row->entry_by,$f['field']);
            }elseif($f['field'] == 'city'){
                $content[]= \Helper::getExportUser($row->entry_by,$f['field']);
            }elseif($f['field'] == 'address_1'){
                $content[]= \Helper::getExportUser($row->entry_by,$f['field']);
            }elseif($f['field'] == 'gender'){
                $content[]= \Helper::getExportUser($row->entry_by,$f['field']);
            }elseif($f['field'] == 'email'){
                $content[]= \Helper::getExportUser($row->entry_by,$f['field']);
            }else{
                $limited = isset($field['limited']) ? $field['limited'] :'';
                if(SiteHelpers::filterColumn($limited )){
                    $content[]=  SiteHelpers::formatRows($row->{$f['field']},$f,$row) ;
                }
            }
        }
    }
    
    fputcsv($output,$content);	
}