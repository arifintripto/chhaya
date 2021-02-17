<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class ourpartners extends Concave  {
	
	protected $table = 'con_our_partners';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT con_our_partners.* FROM con_our_partners  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE con_our_partners.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
