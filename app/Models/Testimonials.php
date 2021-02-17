<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class testimonials extends Concave  {
	
	protected $table = 'con_testimonial';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT con_testimonial.* FROM con_testimonial  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE con_testimonial.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
