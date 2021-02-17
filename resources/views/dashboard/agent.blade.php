@php
use Carbon\Carbon;
$seach_user_id   = $_GET['user_id'] ? $_GET['user_id'] :null;
$report_type     = $_GET['report'] ? $_GET['report'] : null;
$hierarchy_level = $_GET['hierarchy_level'] ? $_GET['hierarchy_level'] : null;
@endphp

@if($seach_user_id == null && $report_type == null && $hierarchy_level == null)

@php
    $user= \Auth::user();
    $user_id = $user->id;
    $hierarchy_level = $user->hierarchy_level;
    


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

//Today

$fist_day = Carbon::now()->startOfDay();
$now  = Carbon::now();
$packageSaleToday = \DB::table('con_reports')->where($column_title,$user_id)->where('status',1)->selectRaw('package_id,sum(price) as sum')->whereBetween('created_at', [$fist_day, $now])->groupBy('package_id')->get();
$totalCustomerToday =  \DB::table('con_reports')->where($column_title,$user_id)->whereBetween('created_at', [$fist_day, $now])->count();
$lifeTimeRevenueToday = \DB::table('con_reports')->where($column_title,$user_id)->where('status',1)->whereBetween('created_at', [$fist_day, $now])->sum('price');
$subscriptionsToday = \DB::table('con_reports')->where($column_title,$user_id)->whereBetween('created_at', [$fist_day, $now])->where('status',1);
$totalSubscriptionsToday = $subscriptionsToday->count();

  
//This month
$fist_day = Carbon::now()->firstOfMonth();
$now  = Carbon::now();

$packageSaleMonth = \DB::table('con_reports')->where($column_title,$user_id)->where('status',1)->selectRaw('package_id,sum(price) as sum')->whereBetween('created_at', [$fist_day, $now])->groupBy('package_id')->get();
$totalCustomerMonth =  \DB::table('con_reports')->where($column_title,$user_id)->whereBetween('created_at', [$fist_day, $now])->count();
$lifeTimeRevenueMonth = \DB::table('con_reports')->where($column_title,$user_id)->where('status',1)->whereBetween('created_at', [$fist_day, $now])->sum('price');
$subscriptionsMonth = \DB::table('con_reports')->where($column_title,$user_id)->whereBetween('created_at', [$fist_day, $now])->where('status',1);
$totalSubscriptionsMonth = $subscriptionsMonth->count();

//This year
$fist_day = Carbon::now()->firstOfYear();
$now  = Carbon::now();

$packageSaleYear = \DB::table('con_reports')->where($column_title,$user_id)->where('status',1)->selectRaw('package_id,sum(price) as sum')->whereBetween('created_at', [$fist_day, $now])->groupBy('package_id')->get();
$totalCustomerYear =  \DB::table('con_reports')->where($column_title,$user_id)->whereBetween('created_at', [$fist_day, $now])->count();
$lifeTimeRevenueYear = \DB::table('con_reports')->where($column_title,$user_id)->where('status',1)->whereBetween('created_at', [$fist_day, $now])->sum('price');
$subscriptionsYear = \DB::table('con_reports')->where($column_title,$user_id)->whereBetween('created_at', [$fist_day, $now])->where('status',1);
$totalSubscriptionsYear = $subscriptionsYear->count();


//Life time data
$packageSale = \DB::table('con_reports')->where($column_title,$user_id)->where('status',1)->selectRaw('package_id,sum(price) as sum')->groupBy('package_id')->get();
$totalCustomer =  \DB::table('con_reports')->where($column_title,$user_id)->count();
$lifeTimeRevenue = \DB::table('con_reports')->where($column_title,$user_id)->where('status',1)->sum('price');
$subscriptions = \DB::table('con_reports')->where($column_title,$user_id)->where('status',1);
$totalSubscriptions = $subscriptions->count();

@endphp


<div class="container-fluid">

    @if($packageSale['package_id'] || $totalCustomer>1 || $lifeTimeRevenue || $totalSubscriptions)
    <div class="row mt-5">


        <div class="col-md-4">
			<div class="box_design balance">
                <p class="box_title">Today</p>

                <p> <b>Subscriptions:</b>  {{$totalSubscriptionsToday}}</p>
                <p> <b>Revenues:</b> <span>BDT </span> <b> {{$lifeTimeRevenueToday}}</b></p>
                 <hr>
                    <p class="text-uppercase">Package Wise Revenue</p><br>
                    <table class="table table-striped">
                        <tr>
                            <td><b>Package Name</b></td>
                            <td><b>Total Revenue</b></td>
                        </tr>
                         @foreach($packageSaleToday as $data)
                             <tr>
                                <td><span><a target="_blank" href="{{'/insurancepackage/'.$data->package_id }}">{{ \App\Models\Insurancepackage::find($data->package_id)->title ?? '' }}</a></span></td>
                                <td><span>BDT {{ $data->sum }}</span></td>
                             </tr>
                         @endforeach
                    </table>
 

			</div>
        </div>


        <div class="col-md-4">
			<div class="box_design balance">
                <p class="box_title">This Month</p>

                <p> <b>Subscriptions:</b>  {{$totalSubscriptionsMonth}}</p>
                <p> <b>Revenues:</b> <span>BDT </span><b> {{$lifeTimeRevenueMonth}}</b></p>
                 <hr>
                    <p class="text-uppercase">Package Wise Revenue</p><br>
                    <table class="table table-striped">
                        <tr>
                            <td><b>Package Name</b></td>
                            <td><b>Total Revenue</b></td>
                        </tr>
                         @foreach($packageSaleMonth as $data)
                             <tr>
                                <td><span><a target="_blank" href="{{'/insurancepackage/'.$data->package_id }}">{{ \App\Models\Insurancepackage::find($data->package_id)->title ?? '' }}</a></span></td>
                                <td><span>BDT {{ $data->sum }}</span></td>
                             </tr>
                         @endforeach
                    </table>
 

			</div>
        </div>

        <div class="col-md-4">
			<div class="box_design balance">
                <p class="box_title">This Year</p>

                <p> <b>Subscriptions:</b>  {{$totalSubscriptionsYear}}</p>
                <p> <b>Revenues:</b> <span>BDT </span><b> {{$lifeTimeRevenueYear}}</b></p>
                 <hr>
                    <p class="text-uppercase">Package Wise Revenue</p><br>
                    <table class="table table-striped">
                        <tr>
                            <td><b>Package Name</b></td>
                            <td><b>Total Revenue</b></td>
                        </tr>
                         @foreach($packageSaleYear as $data)
                             <tr>
                                <td><span><a target="_blank" href="{{'/insurancepackage/'.$data->package_id }}">{{ \App\Models\Insurancepackage::find($data->package_id)->title ?? '' }}</a></span></td>
                                <td><span>BDT {{ $data->sum }}</span></td>
                             </tr>
                         @endforeach
                    </table>
 

			</div>
        </div>


      
      
        <div class="col-md-6">
			<div class="box_design balance">
                <p class="box_title">Lifetime</p>

                <p> <b>Subscriptions:</b>  {{$totalSubscriptions}}</p>
                <p> <b>Revenues:</b> <span>BDT </span><b>{{$lifeTimeRevenue}}</b></p>
                 <hr>
                    <p class="text-uppercase">Package Wise Revenue</p><br>
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


        <div class="col-md-6">
			<div class="box_design balance dash">
                <p class="box_title">Quick links</p>
                <div class="lists">
                    <ul>
						<li><a href="{{ url('/') }}/dashboard?report=month"><span class="iconic">  <i class="lni-timer"></i></span>Monthly Statistics</a> </li>
						<li><a href="{{ url('/') }}/dashboard?report=year"><span class="iconic">  <i class="lni-pie-chart"></i></span>Yearly Statistics</a> </li>
						<li><a href="{{ url('/') }}/dashboard?report=lifetime"><span class="iconic">  <i class="lni-cup"></i></span>Lifetime Statistics</a> </li>
						<li><a href="{{ url('/') }}/dashboard?report=date-range"><span class="iconic">  <i class="lni-calendar"></i></span>Date Range Statistics</a> </li>
					</ul>
                </div>
            </div>
    </div>
    </div>

    @else
    <div class="row  mt-4">
        <div class="col-md-2"></div>
        <div class="col-md-8 text-center">
            <div class="box_design balance">
                <h2 style="color:#48ae71"> <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <br><br> No data found.</h2>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    @endif
</div>
@endif

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

@if(isset($_GET['report']) && $_GET['report'] == lifetime)
    @include('dashboard/agent/lifetime')
@elseif(isset($_GET['report']) && $_GET['report'] == month)
    @include('dashboard/agent/monthly')
@elseif(isset($_GET['report']) && $_GET['report'] == year)
    @include('dashboard/agent/yearly')
@elseif(isset($_GET['report']) && $_GET['report'] == date-range)
    @include('dashboard/agent/date-range')
@endif