<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class insuranceclaims extends Concave  {
	
	protected $table = 'con_claims';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT con_claims.* FROM con_claims  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE con_claims.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
