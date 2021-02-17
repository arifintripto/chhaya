<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class status extends Concave  {
	
	protected $table = 'con_status';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT con_status.* FROM con_status  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE con_status.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
