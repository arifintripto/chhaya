
@php
$msg = false;
$from  = $_GET['from'] ? $_GET['from'] :null;
$b_to     = $_GET['to'] ? $_GET['to'] :null;
if($from || $b_to){
    if(Helper::isValidDate($from) == false || Helper::isValidDate($b_to) == false){
        $msg = 'Ops..! please give a valid date.';
    }

    if(date('Y', strtotime($b_to)) ==  date('Y', strtotime($from))){
        if(date('m', strtotime($b_to)) > date('m', strtotime($from)) || date('d', strtotime($b_to)) > date('d', strtotime($from))){
            $to  = $b_to;
        }else{
            $msg = 'Ops..! please give a valid date.';
        }
    }elseif(date('Y', strtotime($b_to)) > date('Y', strtotime($from))){
        $to  = $b_to;
    }elseif(date('Y', strtotime($b_to)) < date('Y', strtotime($from))){
        $msg = 'Ops..! please give a valid date.';
    }
}

$seach_user_id   = $_GET['user_id'] ? $_GET['user_id'] :null;
$report_type     = $_GET['report'] ? $_GET['report'] : null;
$hierarchy_level = $_GET['hierarchy_level'] ? $_GET['hierarchy_level'] : null;



if($seach_user_id && $report_type && $hierarchy_level >= 1){
    $checked_user = \Helper::check_report_user($seach_user_id, $hierarchy_level);
    if($checked_user){
        $user_id = $seach_user_id;
        $hierarchy_level = $hierarchy_level;
    }else{
        $msg = 'Ops..! invalid hierarchy level.';
    }
}else{
    $user= \Auth::user();
    $user_id = $user->id;
    $hierarchy_level = $user->hierarchy_level;
}




if($hierarchy_level == 6){
    $column_title = 'agent_id';
}elseif($hierarchy_level == 5){
    $column_title = 'teritory_manager';
}elseif($hierarchy_level == 4){
    $column_title = 'area_manager';
}elseif($hierarchy_level == 3){
    $column_title = 'sales_manager';
}elseif($hierarchy_level == 2){
    $column_title = 'regional_manager';
}elseif($hierarchy_level == 1){
    $column_title = 'head_of_sales';
}
use Carbon\Carbon;

if(!empty($from) && !empty($to)){
    $fist_day = $from;
    $now      = $to;
}else{
    $fist_day = '2020-01-01';
    $now  = Carbon::now()->format('Y-m-d');

}



$packageSale = \DB::table('con_reports')->where($column_title,$user_id)->where('status',1)->selectRaw('package_id,sum(price) as sum')->whereBetween('created_at', [$fist_day, $now])->groupBy('package_id')->get();
$totalCustomer =  \DB::table('con_reports')->where($column_title,$user_id)->whereBetween('created_at', [$fist_day, $now])->count();
$lifeTimeRevenue = \DB::table('con_reports')->where($column_title,$user_id)->where('status',1)->whereBetween('created_at', [$fist_day, $now])->sum('price');
$subscriptions = \DB::table('con_reports')->where($column_title,$user_id)->whereBetween('created_at', [$fist_day, $now])->where('status',1);
$totalSubscriptions = $subscriptions->count();
@endphp

<div class="container-fluid">
<div class="row">
    <div class="col-md-12 text-center mt-4 mb-4 text-uppercase">
        <h2>Date range Statistics @if($checked_user) <br><span>For <br> <strong style="color:#dc3545">{{$checked_user->first_name}}</strong></span>@endif</h2>
    </div>
</div>
<div class="row mb-5">
    <form action="" style="width: 100%;background: #f1f1f1;padding: 20px;" class="form-inline">
        <div class="col-md-2 pr-1">
            <select id="hierarchy_trigger" name="hierarchy_level" class="form-control border-0 rounded-0" style="width: 100%;" required>
                <option value="-1" disabled selected>-- Select Hierarchy --</option>
                @php
                    $user= \Auth::user();
                    $user_id = $user->id;
                    $level = $user->hierarchy_level;
                @endphp 
                @if($level == 1)
                    <option @if($hierarchy_level == 2) selected @endif value="2">Regional Manager</option>
                    <option @if($hierarchy_level == 3) selected @endif value="3">Sales Manager</option>
                    <option @if($hierarchy_level == 4) selected @endif  value="4">Area Manager</option>
                    <option @if($hierarchy_level == 5) selected @endif value="5">Teritory Manager</option>
                    <option @if($hierarchy_level == 6) selected @endif value="6">Agent</option>
                @elseif($level == 1 || $level == 2)
                    <option @if($hierarchy_level == 3) selected @endif value="3">Sales Manager</option>
                    <option @if($hierarchy_level == 4) selected @endif  value="4">Area Manager</option>
                    <option @if($hierarchy_level == 5) selected @endif value="5">Teritory Manager</option>
                    <option @if($hierarchy_level == 6) selected @endif value="6">Agent</option>
                @elseif($level == 1 || $level == 2 || $level == 3)
                    <option @if($hierarchy_level == 4) selected @endif  value="4">Area Manager</option>
                    <option @if($hierarchy_level == 5) selected @endif value="5">Teritory Manager</option>
                    <option @if($hierarchy_level == 6) selected @endif value="6">Agent</option>
                @elseif($level == 1 || $level == 2 || $level == 3 || $level == 4)
                    <option @if($hierarchy_level == 5) selected @endif value="5">Teritory Manager</option>
                    <option @if($hierarchy_level == 6) selected @endif value="6">Agent</option>
                @elseif($level == 1 || $level == 2 || $level == 3 || $level == 4  || $level == 5)
                    <option @if($hierarchy_level == 6) selected @endif value="6">Agent</option>
                @elseif($level == 6)
                @endif
            </select>
        </div>

        <div class="col-md-2 pr-1 pl-1">
            <select name="user_id" id="select_user" class="form-control border-0 rounded-0" style="width: 100%;" required>
                <option value="-1" disabled selected>-- Select Hierarchy First--</option>
                @if($hierarchy_level)
                    @php $users = DB::table('tb_users')->where('hierarchy_level',$hierarchy_level)->get();  @endphp
                    @foreach($users as $user)
                    <option  @if($user->id == $seach_user_id ) selected @endif value="{{$user->id}}">{{$user->first_name.'('.\Helper::getAgentMeta($user->id,"agent_serial").')'}}</option>;
                    @endforeach
                @else
                    <option value="-1" disabled selected>-- Select Hierarchy First--</option>
                @endif
            </select>
        </div>

        <div class="col-md-2 pr-1 pl-1">
            <input value="{{$fist_day}}" type="date" name="from" class="form-control border-0 rounded-0 from_date" style="width: 100%;" required placeholder="From">
        </div>
        <div class="col-md-2 pr-1 pl-1">
            <input value="{{$now}}" type="date" name="to" class="form-control border-0 rounded-0 to_date" style="width: 100%;" required placeholder="To">
        </div>

        <div class="col-md-2 pl-0 pr-1">
            <button class="filter_btn" type="submit">
                <div class="seach_filer text-center">
                    @if(!$hierarchy_level)
                    <input type="hidden" name="hierarchy_level" value="{{$user->hierarchy_level}}">
                    @endif
                    <input type="hidden" name="report" value="date-range">
                    <i class="fa fa-search" aria-hidden="true"></i> <span>Search</span>
                </div>
            </button>
        </div>
        <div class="col-md-2 pl-0">
        <div class="seach_filer text-center bg-danger">
            <a class="text-white" href="/dashboard?report={{$_GET['report']}}">
                <i class="fa fa-refresh" aria-hidden="true"></i> <span>Reset</span>
            </a>
        </div>
        </div>
    </form>
</div>


@if(!$msg)

@if($packageSale['package_id'] || $totalCustomer>1 || $lifeTimeRevenue || $totalSubscriptions)
<div class="row">
    <div class="col-md-6">
        <div class="box_design balance">
            <p class="box_title">Short Statistics</p>
            <ul class="nav sort_stat_box">
                <li>
                    <span>{{$totalSubscriptions}}</span><br>
                    <b>Subscriptions</b>
                </li>
                <li>
                    <span>BDT {{$lifeTimeRevenue}}</span><br>
                    <b>Revenues</b>
                </li>
            </ul>

        </div>
    </div>
    <div class="col-md-6">
        <div class="box_design balance">
            <p class="box_title">Package Wise Revenue</p>
            <table class="table table-striped">
                <tr>
                    <td><b>Package Name</b></td>
                    <td><b>Total Revenue</b></td>
                </tr>
                 @foreach($packageSale as $data)
                     <tr>
                        <td><span><a target="_blank" href="{{'/insurancepackage/'.$data->package_id }}">{{ \App\Models\Insurancepackage::find($data->package_id)->title ?? '' }}</a></span></td>
                        <td><span>BDT {{ $data->sum }}</span></td>
                     </tr>
                 @endforeach
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-4">
        <div class="box_design balance">
            <p class="box_title">Customers list</p>
            <table class="table table-hover data_table display">
                <thead>
                <tr>
                    <th>Serial</th>
                    <th>Fullname</th>
                    <th>Mobile</th>
                    <th>Package</th>
                    <th>Activation Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subscriptions->get() as $sub)
                @php $dBuser = \App\Models\Core\Users::find($sub->user_id); @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$dBuser->first_name }}</td>
                        <td>{{$dBuser->username }}</td>
                        <td>{{\App\Models\Insurancepackage::find($sub->package_id)->title}}</td>
                        <td>{{$sub->created_at}}</td>
                    </tr>
                @endforeach
            
                </tbody>
            </table>
          </div>
    </div>
</div>
@else
<div class="row  mt-4">
    <div class="col-md-2"></div>
    <div class="col-md-8 text-center">
        <div class="box_design balance">
            <h2 style="color:#dc3545"> <i style="font-size: 65px;" class="fa fa-exclamation-circle" aria-hidden="true"></i> <br><br> No data found.</h2>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
@endif

@else
    <div class="row  mt-4">
        <div class="col-md-2"></div>
        <div class="col-md-8 text-center">
            <div class="box_design balance">
            <h2 style="color:#dc3545"> <i style="font-size: 65px;" class="fa fa-exclamation-circle" aria-hidden="true"></i><br> <br>{{$msg}}</h2>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
@endif

</div>




<script>
jQuery(document).on('change','#hierarchy_trigger',function(){
    
    jQuery('.ajaxLoading').show();
    var hierarchy_level = jQuery(this).find('option:selected').val()
    jQuery.ajax({
    method:'POST',
        url: "{{ url('/user-by-hierarchy-level')}}",
        data:{_token: "{{ csrf_token() }}", hierarchy_level:hierarchy_level},
        cache: false,
        success: function(response){
            jQuery('.ajaxLoading').hide();
        jQuery('#select_user').html(response);
        }
    });
});
</script>

