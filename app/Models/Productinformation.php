<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class productinformation extends Concave  {
	
	protected $table = 'con_products';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT con_products.* FROM con_products  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE con_products.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}


}
