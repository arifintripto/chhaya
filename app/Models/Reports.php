<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class reports extends Concave  {
	
	protected $table = 'con_reports';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT con_reports.* FROM con_reports  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE con_reports.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
