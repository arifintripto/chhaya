<?php

namespace App\Helpers;
use DB;
use Illuminate\Database\Eloquent\Model;

class Helper
{

    public static function getThumbnailByPageId($id){
        $data = DB::table('tb_pages')->where('pageID', $id)->first();
        return $data->image;
    }
	
	
	//Return true if order is not expired
	public static function verifyOrder($orderId){
		$order = DB::table('con_orders')->where('id', $orderId)->first();
		if($order->status != 1){
			$result = false;
		}else{
			$currentDate = date('Y-m-d H:i:s');
			$activatedTime = $order->updated_at;
			$packageId = $order->package_id;
			$package = DB::table('con_package')->where('id', $packageId)->first();
			$durationMonth = '+'.$package->package_duration.' months';
			$effectiveDate = date('Y-m-d H:i:s', strtotime($durationMonth, strtotime($activatedTime)));
			
			if ($currentDate < $effectiveDate) {
				$result = true;
			}else{
				$result = false;
			}
			
		}

		return $result;

	}
	
	public static function getAgentMeta($user_id,$key){
		$user = DB::table('con_agent_meta')->where('user_id',$user_id)->first();
		return $user->$key;
	}
	
	public static function getExportUser($user_id,$key){

		$title = '';
		if($key == 'state'){
			$id  =  \DB::table('tb_users')->where('id',$user_id)->first()->$key;
			$title = \DB::table('con_division')->where('id',$id)->first()->title;

		}elseif($key == 'city'){
			$id  =  \DB::table('tb_users')->where('id',$user_id)->first()->$key;
			$title = \DB::table('con_district')->where('id',$id)->first()->title;

		}else{
			$title =  \DB::table('tb_users')->where('id',$user_id)->first()->$key;
		}

		return $title;
	}
	
	public static function check_report_user($seach_user_id, $hierarchy_level){
		$data = DB::table('tb_users')->where('id', $seach_user_id)->where('hierarchy_level', $hierarchy_level)->first();
		return $data;
	}
	
	public static function isValidDate($date) {
		return preg_match("/^(\d{4})-(\d{1,2})-(\d{1,2})$/", $date, $m)
			? checkdate(intval($m[2]), intval($m[3]), intval($m[1]))
			: false;
	}
		
 
	
}