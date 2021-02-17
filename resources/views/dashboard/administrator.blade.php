<?php
$parentBalance = (float) file_get_contents('http://smpp.ajuratech.com/portal/sms/smsConfiguration/smsClientBalance.jsp?client=expotech');
$childBalance = (float) file_get_contents('http://smpp.ajuratech.com/portal/sms/smsConfiguration/smsClientBalance.jsp?client=expotech_api');
$totalCustomer = \App\Models\Core\Users::where('group_id',7)->count();
$totalAgents = \App\Models\Core\Users::where('group_id',5)->where('hierarchy_level',6)->count();
$lifeTimeRevenue = \App\Models\Insurancesubscriptions::where('status',1)->sum('price');
$totalSubscriptions = \App\Models\Insurancesubscriptions::where('status',1)->count();
$totalClaims = \App\Models\Insuranceclaims::count();
$packageSale = \App\Models\Insurancesubscriptions::where('status',1)->selectRaw('package_id,sum(price) as sum')->groupBy('package_id')->get();

$thisYear = date('Y');
$currentYearData =  \App\Models\Insurancesubscriptions::whereYear('created_at',$thisYear)->where('status',1)->get();
$lastYearData =  \App\Models\Insurancesubscriptions::whereYear('created_at',($thisYear-1))->where('status',1)->get();
$before2YearData =  \App\Models\Insurancesubscriptions::whereYear('created_at',($thisYear-2))->where('status',1)->get();
$before3YearData =  \App\Models\Insurancesubscriptions::whereYear('created_at',($thisYear-3))->where('status',1)->get();

$this_year_chart = ['1' => 0,'2' => 0,'3' => 0,'4' => 0,'5' => 0,'6' => 0,'7' => 0,'8' => 0,'9' => 0,'10' => 0,'11' => 0,'12' => 0,];
$last_year_chart = ['1' => 0,'2' => 0,'3' => 0,'4' => 0,'5' => 0,'6' => 0,'7' => 0,'8' => 0,'9' => 0,'10' => 0,'11' => 0,'12' => 0,];
$before_2yr_chart = ['1' => 0,'2' => 0,'3' => 0,'4' => 0,'5' => 0,'6' => 0,'7' => 0,'8' => 0,'9' => 0,'10' => 0,'11' => 0,'12' => 0,];
$before_3yr_chart = ['1' => 0,'2' => 0,'3' => 0,'4' => 0,'5' => 0,'6' => 0,'7' => 0,'8' => 0,'9' => 0,'10' => 0,'11' => 0,'12' => 0,];

if($currentYearData){
	foreach($currentYearData as $data){
		$month  = (int) \Carbon\Carbon::parse($data->created_at)->format('m');
		if($this_year_chart[$month] > 0){
			$this_year_chart[$month] = $this_year_chart[$month]+$data->price;
		}else{
			$this_year_chart[$month] = $data->price;
		}
	}
}

if($lastYearData){
	foreach($lastYearData as $data){
		$month  = (int) \Carbon\Carbon::parse($data->created_at)->format('m');
		if($last_year_chart[$month] > 0){
			$last_year_chart[$month] = $last_year_chart[$month]+$data->price;
		}else{
			$last_year_chart[$month] = $data->price;
		}
	}
}

if($before2YearData){
	foreach($before2YearData as $data){
		$month  = (int) \Carbon\Carbon::parse($data->created_at)->format('m');
		if($this_year_chart[$month] > 0){
			$before_2yr_chart[$month] = $before_2yr_chart[$month]+$data->price;
		}else{
			$before_2yr_chart[$month] = $data->price;
		}
	}
}

if($before3YearData){
	foreach($before3YearData as $data){
		$month  = (int) \Carbon\Carbon::parse($data->created_at)->format('m');
		if($before_3yr_chart[$month] > 0){
			$before_3yr_chart[$month] = $before_3yr_chart[$month]+$data->price;
		}else{
			$before_3yr_chart[$month] = $data->price;
		}
	}
}


?>

<style>
.box_design {
    background: #fff;
    padding: 40px 20px;
    margin: 15px 0;
    box-shadow: 1px 2px 3px 1px #bdbdbd;
    min-height: 186px;
    border-radius: 10px;
}
.box_design2 {
    background: #fff;
    padding: 20px;
    box-shadow: 1px 2px 3px 1px #bdbdbd;
	min-height: 402px;
	border-radius: 10px;
}
.balance span {
    color: #48ae71;
    font-weight: bold;
    font-size: 14px;
}
.balance p{
	margin-bottom:0px;
}
.balance p b{
	font-weight:600;
}
.box_title {
    text-align: center;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    top: 0;
    background: #48ae71;
    padding: 6px 17px;
    color: #fff;
    border-radius: 30px;
	text-transform:uppercase;
}
.box_design a {
    color: #48ae71;
}
#revenue_data {
    box-shadow: 1px 2px 3px 1px #bdbdbd;
    border-radius: 10px;
	background:#fff;
}
.pk_title {
    text-transform: uppercase;
    font-size: 18px;
    font-weight: 400;
}
.highcharts-title {
    text-transform: uppercase;
}
</style>

<div class="container-fluid mt-4 mb-4">
	<div class="row">
		<div class="col-sm-6 col-md-6 col-xl-3">
			<div class="box_design balance">
				<p class="box_title">REVE BALANCE</p>
				<p><b>Main Account Balance:</b> <span>BDT {{ number_format((float)($parentBalance*85), 2, '.', '') }}</span></p>
				<p><b>API Account Balance:</b> <span>BDT {{  number_format((float)($childBalance*85), 2, '.', '') }}</span></p>
			</div>
		</div>
		<div class="col-sm-6 col-md-6 col-xl-3">
			<div class="box_design balance">
				<p class="box_title">Short Statistics</p>
				<p><b>Total Customers:</b> <span>{{$totalCustomer}}</span></p>
				<p><b>Total Subscriptions:</b> <span>{{$totalSubscriptions}}</span></p>
				<p><b>Total Claims:</b> <span>{{$totalClaims}}</span></p>
				<p><b>Total Agents:</b> <span>{{$totalAgents}}</span></p>
				<p><b>Lifetime Revenue:</b> <span>BDT {{$lifeTimeRevenue}}</span></p>
			</div>
		</div>
		<div class="col-sm-6 col-md-6 col-xl-3">
			<div class="box_design balance">
				<p class="box_title">Product Creation</p>
				<p><b>Step 01:</b> <span><a href="/insurancetypes/create">Insurance Type (Optional)</a></span></p>
				<p><b>Step 02:</b> <span><a href="/insuranceplans/create">Insurance Plan</a></span></p>
				<p><b>Step 03:</b> <span><a href="/insurancepackage/create">Package Creation</a></span></p>
				<p><b>Step 04:</b> <span><a href="/productinformation/create">Product Creation</a></span></span></p>
			</div>
		</div>
		<div class="col-sm-6 col-md-6 col-xl-3">
			<div class="box_design balance">
				<p class="box_title">Statistics Links</p>
				<p><b>Link 01. </b><span><a href="#">Monthly Statistics</a></span></p>
				<p><b>Link 02. </b><span><a href="#">Yearly Statistics</a></span></p>
				<p><b>Link 03. </b><span><a href="#">Lifetime Statistics</a></span></p>
				<p><b>link 04. </b><span><a href="#">Date Range Statistics</a></span></p>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12 col-md-12 col-xl-6">
			<div class="box_design2 balance">
				<h5 class="text-center pk_title">Package wise Total Revenue</h5>
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
		<div class="col-sm-12 col-md-12 col-xl-6">
			<div id="revenue_data"></div>
		</div>
		
		
		<div class="col-sm-12 col-md-12 col-xl-6">
			<div class="box_design">
				<h5 class="text-center pk_title">Bkash Transaction Validation</h5>
					<legend>
						<form id="searchpayment" action="/searchpayment" method="post">
							<p>Search Transaction</p>
							@csrf
							<p> <input type="text" id="transaction_id" name="transaction_id" style="width: 70%;float: left;margin-right: 0;border-radius: 0;" class="form-control" placeholder="bKash Transaction ID"> <button type="submit" style="border-radius: 0;" class="btn btn-primary">Search Transaction</button> </p>
						</form>
						<div id="res_bkash2"></div>
					</legend>

			</div>
		</div>
		
	</div>
</div>


<script>

	jQuery(document).ready(function(){
		jQuery.ajaxSetup({ 
			headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }
		});
		jQuery.ajax({
			url: "initial-state",
			type: 'POST',
			contentType: 'application/json',
			success: function (data) {
				accessToken = JSON.stringify(data);
			},
			error: function () {
				console.log('error');
			}
		});
	});

	/* jQuery(document).on('submit','#querypayment',function(event){
		event.preventDefault();
		jQuery.ajaxSetup({ 
			headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }
		});
		jQuery('#res_bkash').html('');
		jQuery('.ajaxLoading').show();
		jQuery.ajax({
		url: jQuery(this).attr('action'),
		cache: false,
		method: 'post',
		data: {payment_id: jQuery('#payment_id').val()},
		success: function(response){
			jQuery('.ajaxLoading').hide();
			var data = JSON.parse(response);
			var html = '';
			jQuery.each(data, function(key,valueObj){
				html += '<p><b>'+key + "</b>: " + valueObj+'</p>'
			});

			jQuery('#res_bkash').html(html);
		}
		});
	}); */



	
	jQuery(document).on('submit','#searchpayment',function(event){
		event.preventDefault();
		jQuery.ajaxSetup({ 
			headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }
		});
		jQuery('#res_bkash').html('');
		jQuery('.ajaxLoading').show();
		jQuery.ajax({
		url: jQuery(this).attr('action'),
		cache: false,
		method: 'post',
		data: {transaction_id: jQuery('#transaction_id').val()},
		success: function(response){
			jQuery('.ajaxLoading').hide();
			var data = JSON.parse(response);
			var html = '';
			jQuery.each(data, function(key,valueObj){
				html += '<p><b>'+key + "</b>: " + valueObj+'</p>'
			});

			jQuery('#res_bkash2').html(html);
		}
		});
	});

</script>


<script>
Highcharts.chart('revenue_data', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'Revenue Analysis'
  },
  xAxis: {
    categories: [
      'Jan',
      'Feb',
      'Mar',
      'Apr',
      'May',
      'Jun',
      'Jul',
      'Aug',
      'Sep',
      'Oct',
      'Nov',
      'Dec'
    ],
    crosshair: true
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Total Revenue (BDT)'
    }
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>BDT {point.y:.1f}</b></td></tr>',
    footerFormat: '</table>',
    shared: true,
    useHTML: true
  },
  plotOptions: {
    column: {
      pointPadding: 0.1,
      borderWidth: 0
    }
  },
  series: [{
    name: '<?= date('Y'); ?>',
    data: [<?php foreach($this_year_chart as $data){ echo $data.','; } ?>]

  }, {
    name: '<?= date('Y')-1; ?>',
    data: [<?php foreach($last_year_chart as $data){ echo $data.','; } ?>]

  }, {
    name: '<?= date('Y')-2; ?>',
    data: [<?php foreach($before_2yr_chart as $data){ echo $data.','; } ?>]

  }, {
    name: '<?= date('Y')-3; ?>',
    data: [<?php foreach($before_3yr_chart as $data){ echo $data.','; } ?>]

  }]
});
</script>