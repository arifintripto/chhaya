<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class periods extends Concave  {
	
	protected $table = 'con_periods';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT con_periods.* FROM con_periods  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE con_periods.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
