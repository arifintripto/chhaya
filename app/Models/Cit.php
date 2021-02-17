<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Cit extends Model {
    
    public static function getAllServiceCategory(){
        return DB::table('con_service_category')->where('status', 1)->get();
    }
    public static function getServiceByCatId($id){
        return DB::table('con_service_category')->where('id',$id)->first();
    }
    
    
    public static function getAllServiceByCatId($id){
        return DB::table('con_service') ->where('service_category',$id)
                                        ->where('status',1)
                                        ->get();
    }
    
    public static function getAllPortfolioByCatId($id){
        return DB::table('con_portfolio') ->where('portfolio_category',$id)
                                        ->where('status',1)
                                        ->get();
    }
    public static function getPortfolioCatById($id){
        return DB::table('con_portfolio_category')->where('id',$id)->first();
    }
    public static function getPortfolioBId($id){
        return DB::table('con_portfolio')->where('id',$id)->first();
    }
    
    public static function getAllAnnouncement(){
        return DB::table('con_circular')  ->where('status',1)
                                        ->whereDate('post_end_date', '>=', date("Y-m-d"))
                                        ->get();
    }
    
    public static function getCaerreById($id){
        return DB::table('con_circular')->where('id',$id)->first();
    }
    public static function getAllTeamMembers(){
        return DB::table('con_team')    ->where('status',1)
                                        ->get()
                                        ->sortBy('sort_number');
    }
    public static function saveCareerRequest($data){
        return DB::table('con_career')->insert($data);
    }
    
    
    
    
    
    
    
    
    


}