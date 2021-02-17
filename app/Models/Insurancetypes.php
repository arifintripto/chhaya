<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class insurancetypes extends Concave  {
	
	protected $table = 'con_insurance_type';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT con_insurance_type.* FROM con_insurance_type  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE con_insurance_type.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
