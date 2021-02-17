<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class visitreports extends Concave  {
	
	protected $table = 'con_visit_report';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT con_visit_report.* FROM con_visit_report  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE con_visit_report.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
