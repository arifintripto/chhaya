<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class corporatepartner extends Concave  {
	
	protected $table = 'con_corporate_partners';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT con_corporate_partners.* FROM con_corporate_partners  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE con_corporate_partners.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
