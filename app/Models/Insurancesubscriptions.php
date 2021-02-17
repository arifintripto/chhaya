<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class insurancesubscriptions extends Concave  {
	
	protected $table = 'con_orders';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT con_orders.* FROM con_orders  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE con_orders.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
