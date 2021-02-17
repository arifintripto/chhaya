<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class otplist extends Concave  {
	
	protected $table = 'con_otp';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT con_otp.* FROM con_otp  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE con_otp.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
