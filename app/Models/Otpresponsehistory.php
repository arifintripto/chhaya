<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class otpresponsehistory extends Concave  {
	
	protected $table = 'con_otp_response_history';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT con_otp_response_history.* FROM con_otp_response_history  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE con_otp_response_history.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
