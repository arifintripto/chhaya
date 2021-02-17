<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class insuranceplans extends Concave  {
	
	protected $table = 'con_insurance';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT con_insurance.* FROM con_insurance  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE con_insurance.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
