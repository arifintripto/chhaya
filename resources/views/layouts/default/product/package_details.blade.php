@extends('layouts.default.master')
@section('title',$package->title)
@section('content')
<style>
.col-md-6{ margin-bottom: 40px;}
#health_banner {
    background: url({{asset('uploads/images/'.$package->banner)}}) no-repeat;
    height: 25vw;
    background-size: 100% 100%;
}
#health_banner .text_div p{color:#fff;}
.description{
    margin-top: -100px;
}
@media (max-width: 767px){
	#health_banner {
		margin-top: 66px;
	}
}


</style>


<?php
$prices = unserialize($package->family_pricing);
$price = 0;
foreach($prices as $p){
	if($p['number_of_people'] == 1){
		$price = $p['price']; // For single person
	}
}

$insurance_plan_ids =  explode(',',$package->insurance_type);
$totalCovarage = 0;
foreach($insurance_plan_ids as $ipId){
	$insuranceplan = \App\Models\Insuranceplans::find($ipId);
	$totalCovarage += $insuranceplan->claim_amount;

}

$insurance_plans = [];
foreach(explode(',',$package->insurance_type) as $insurance_plan_id ){
	$insurance_plan = \App\Models\Insuranceplans::find($insurance_plan_id);
	$insurance_plans[($insurance_plan->sort_position) ? $insurance_plan->sort_position : $insurance_plan_id+10000 ] = $insurance_plan_id;
}
ksort($insurance_plans);

 ?>
   
<section id="health_banner"></section>

<div class="package-list health_banner_class">
   <div class="container">
		
      <div class="row justify-content-center">
         <div class="col-xs-12 col-lg-12">

            <div id="annually-package">
                <div class="row">
                    <div class="col-xs-12 col-lg-12">
                        <div class="package-list-item">
							  <div class="package-list-heading">
								 <div>
									<h4>Package Title: {{$package->title}}</h4><br>
									{!! $package->short_description ?? '' !!}
								 </div>
							  </div>
							  
							  <div class="package-list-table">
								 <table id="sort_tbody">
									<tbody>
									
									@foreach($insurance_plans as $insurance_plan_id)
									@php $insurance_plan = \App\Models\Insuranceplans::find($insurance_plan_id); if(!$insurance_plan) continue; @endphp
									   <tr data-order="{{$insurance_plan->claim_amount}}">
										  <td><img src="{{ asset('uploads/images/'.$insurance_plan->icon) }}" alt=""></td>
										  <td>{{$insurance_plan->title}}</td>
										  <td>
										  @if($insurance_plan->claim_amount > 0)
										 	 {{'Taka '.number_format($insurance_plan->claim_amount, 0, '.', ',')}} @if($insurance_plan->coverage_text)<br><small style="color: #129748;" >{{$insurance_plan->coverage_text}}</small> @endif
										  @else Yes 
										  @endif</td>
									   </tr>
									 @endforeach
									   

									</tbody>
								 </table>
							  </div>
							  <div class="btn">
								 <a href="{{'/checkout/'.base64_encode($package->id)}}" class="common-btn btn-details package-btn">Buy Now</a>
							  </div>
						   </div>
					  </div>
                </div>
            </div>
         </div>
      </div>
	  
	  <div class="description">{!! $package->description !!}</div>
	  <div class="terms">
		<h3>Terms and Conditions:</h3>
		{!! $package->terms_and_conditions !!}
	  </div>
	  <div class="panel-group panel-faq" id="accordion">
		<div class="panel panel-default">
		  <div data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="panel-heading">
			<h4 class="panel-title">Exclusion Clauses</h4>
		  </div>
		  <div id="collapse1" class="panel-collapse collapse">
			<div class="panel-body">{!! $package->exclusion_clauses !!}</div>
		  </div>
		</div>
	  </div> 
	  
   </div>
</div>

<!-- <script>

var $tbody = $('#sort_tbody tbody');

$tbody.find('tr').sort(function(a, b) {
  var tda = $(a).attr('data-order'); // target order attribute
  var tdb = $(b).attr('data-order'); // target order attribute
  // if a < b return 1
  return tda < tdb ? 1
    // else if a > b return -1
    : tda > tdb ? -1
    // else they are equal - return 0    
    : 0;
}).appendTo($tbody);

</script> -->
@endsection