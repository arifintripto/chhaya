<?php namespace App\Http\Controllers\Services;

use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Core\Users;
use App\Models\Core\Groups;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class SiteController extends Controller
{
    public $user ;
    public function __construct( Request $request )
    {
       // $this->user = ConcaveHelper::getUserByToken( $request );
    }

    public function info( )
    {
        $config = config('concave');
        $data = [
            'appname'       => $config['cnf_appname'] ,
            'appdesc'       => $config['cnf_appdesc'] ,
            'comname'       => $config['cnf_comname'] ,
            'email'         => $config['cnf_email'] ,
            'logo'          => $config['cnf_logo'] ,
            'logo_path'     => asset('uploads/images/'.$config['cnf_logo']),
            'registration'  => $config['cnf_regist'] ,
            'site_url'      => url('')
        ];
        return response()->json(['status'=>'success','data'=> $data ] );
    }

    public function show( Request $request  , $route ) {

        switch( $route ) {
            default :
                return $this->info();
                break ;


        }

    }
    public function profile( Request $request ) {
         
        $profile = $request->get('profile');
        if(file_exists('./uploads/users/'.$profile->avatar) &&  $profile->avatar !='' ) {
            $profile->avatar_url = asset('uploads/users/'.$profile->avatar);

        } else {
           $profile->avatar_url = asset('uploads/users/avatar.png');
        }
        return response()->json(['status' => 'success', 'data'=> $profile ]);  
    }

    public function config( Request $request)
    {
        $config = config('concave');
        $groups = \DB::table('groups')->get();
        $activation = [
          ['value'=>'auto' , 'text'  => 'Auto activation by system'],
          ['value'=>'email' , 'text'  => 'Verification by email'],
          ['value'=>'manual' , 'text'  => 'Manual activation by admin']
        ];
        return response()->json(['status'=>'success','data'=> $config , 'groups' => $groups , 'activation' => $activation ] );
    }
    public function cruds( Request $request ) {

        if($request->has('config')) {
            $cruds = \DB::table('tb_module')->where('module_name',$request->get('config'))->get();
            $r = $cruds[0];
            $data = [] ;
            $langs = (json_decode($r->module_lang,true));
            $data['id']     = $r->module_id; 
            $data['title']  = \SiteHelpers::infoLang($r->module_title,$langs,'title'); 
            $data['note']   = \SiteHelpers::infoLang($r->module_note,$langs,'note'); 
            $data['controller']   = $r->module_name ; 
            $data['table']  = $r->module_db; 
            $data['key']    = $r->module_db_key;
            $data['type']   = $r->module_type;
            $data['config'] = \SiteHelpers::CF_decode_json($r->module_config);
            $rows = $data ;
        }
        else {
            $cruds = \DB::table('tb_module')->where('module_type','!=','core')->get();    

            $rows = [] ;
            foreach($cruds as $r) {
                $data = [] ;
                $langs = (json_decode($r->module_lang,true));
                $data['id']     = $r->module_id; 
                $data['title']  = \SiteHelpers::infoLang($r->module_title,$langs,'title'); 
                $data['note']   = \SiteHelpers::infoLang($r->module_note,$langs,'note'); 
                $data['controller']   = $r->module_name ; 
                $data['table']  = $r->module_db; 
                $data['key']    = $r->module_db_key;
                $data['type']   = $r->module_type;
                $data['config'] = \SiteHelpers::CF_decode_json($r->module_config);
               
                $rows[] = $data ;
            }
        }
        return response()->json( array( 'status' => 'success' , 'data' => $rows )  );

    }
 
    public function notification( Request $request ) {
        $s = $request->get('s');
        if(!is_null($s))
        {
            $result = DB::table('tb_notification')->where('is_read','0')->get();
        } else {
            $result = DB::table('tb_notification')->orderby('created','desc')->get();   
             DB::table('tb_notification')->update(['is_read'=>'1']);   
        }
        
        return response()->json(['status'=>'success','data'=> $result ] );

    }   
}
