@extends('layouts.default.master')
@section('title',$product->title)
@section('content')
@include('layouts.default.includes.product_header')
<br><br>
<div class="container">

<div class="row packages">
@foreach($packages as $package)

<?php 

$insurance_plan_ids =  explode(',',$package->insurance_type);
$totalCovarage = 0;
foreach($insurance_plan_ids as $ipId){
	$insuranceplan = \App\Models\Insuranceplans::find($ipId);
	$totalCovarage += $insuranceplan->claim_amount;

}

$durationTitle = \App\Models\Periods::find($package->package_duration)->title;
$prices = unserialize($package->family_pricing);
$price = 0;
foreach($prices as $p){
	if($p['number_of_people'] == 1){
		$price = $p['price']; // For single person
	}
}

 ?>
 
	<div class="col-md-4">
		<figure class="card card-product">
			<div class="img-wrap"><img src="{{asset('uploads/images/'.$package->thumbnail)}}"></div>
			<figcaption class="info-wrap">
					<h4 class="title text-center">{{$package->title}}</h4>
					<div class="text_div">{!! $package->short_description ?? '' !!}</div>
			</figcaption>
			<p class="bottom-wrap text-center">
				<a href="{{'/package/'.base64_encode($package->id)}}" class="btn btn-sm btn-package-v">View Details</a>
				<a href="{{'/checkout/'.base64_encode($package->id)}}" class="btn btn-sm btn-package-b">Buy Now</a>	
			</p> 
		</figure>
	</div>  
@endforeach


</div> <!-- row.// -->



</div> <br><br>
<!--container.//-->


@endsection