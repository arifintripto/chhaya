<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class insurancepackage extends Concave  {
	
	protected $table = 'con_package';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT con_package.* FROM con_package  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE con_package.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
