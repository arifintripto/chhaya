<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class sliders extends Concave  {
	
	protected $table = 'con_sliders';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT con_sliders.* FROM con_sliders  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE con_sliders.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
