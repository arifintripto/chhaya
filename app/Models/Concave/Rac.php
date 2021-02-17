<?php namespace App\Models\Concave;

use App\Models\Concave;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class rac extends Concave  {
	
	protected $table = 'tb_restapi';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_restapi.* FROM tb_restapi  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_restapi.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
