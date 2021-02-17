@extends('layouts.default.master')
@section('title','Home')
@section('content')
<!-- BANNER -->
	<div id="slides" class="section banner">
		<ul class="slides-container">
			@foreach( $sliders as $slider )
				<li>
                    <img src="{{ asset('uploads/images/sliders/'.$slider->image)}}" alt="" class="img-responsive myresponsive">
					<div class="overlay">
					    <div class="container">
    						<div class="wrap-caption">
    						<h2 class="caption-heading">{{ $slider->title }}</h2>
    							<p class="excerpt">{{ $slider->subtitle }}</p>
    							@if(!empty($slider->button_link))
    							<a href="{{ $slider->button_link }}" class="btn btn-primary" title="{{ $slider->button_text }}">{{ $slider->button_text }}</a>
    							@endif
    						</div>
    					</div>
					</div>
				</li>
			@endforeach
		</ul>

		<nav class="slides-navigation">
			<div class="container">
				<a href="#" class="next">
					<i class="fa fa-angle-right"></i>
				</a>
				<a href="#" class="prev">
					<i class="fa fa-angle-left"></i>
				</a>
	      	</div>
	    </nav>

	</div>



	<div class="section we_offer">
		<div class="container">
		    <p class="why_chhaya section_m text-center">WHAT WE OFFER</p>
			<div class="row">
			    <div class="col-xs-6 col-md-3">
			        <p class="text-center"> <img width="100px" src="{{asset('uploads/static/1.png')}}"></p>
			        <p class="text-center offer_title">Affordable Insurance Plans</p>
			    </div>
			    <div class="col-xs-6 col-md-3">
			        <p class="text-center"> <img width="100px" src="{{asset('uploads/static/2.png')}}"></p>
			        <p class="text-center offer_title">Simple Registration Procedure</p>
			    </div>
			     <div class="col-xs-6 col-md-3">
			        <p class="text-center"> <img width="100px" src="{{asset('uploads/static/4.png')}}"></p>
			        <p class="text-center offer_title">Easy Claims Submission Process</p>
			    </div>
			    <div class="col-xs-6 col-md-3">
			        <p class="text-center"> <img width="100px" src="{{asset('uploads/static/3.png')}}"></p>
			        <p class="text-center offer_title">End-to-End Paperless Service</p>
			    </div>
			</div>
		</div>
	</div>





	<div id="products" class="section services">
		<div class="container">
			<p class="why_chhaya section_m text-center">OUR SERVICES</p>
			<div class="row grid-services">
				@foreach(App\Models\Productinformation::where('status',1)->get() as $product)
					<div class="col-sm-6 col-md-4">
						<div class="box-image-1">
							<div class="image">
								<a href="{{'/products/'.$product->slug}}" title="House Insurance"><img src="{{ asset('uploads/images/'.$product->thumbnail) }}" alt="" class="img-responsive"></a>
							</div>
							<div class="description">
								<h3 class="blok-title">{{ $product->title }}</h3>
							<!--	<a href="{{'/product/'.$product->slug}}" title="See More" class="btn btn-secondary">SEE MORE</a> -->
						        <a href="{{'/products/'.$product->slug}}" class="btn btn-secondary">LEARN MORE</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	<div class="section how_it_works">
		<div class="container">
			<p class="why_chhaya section_m text-center in_mobile_work">
				HOW IT WORKS
				<span class="work_botton">
					<i class="fa fa-chevron-down" aria-hidden="true"></i>
				</span>
			</p>
			<p class="why_chhaya section_m text-center in_desktop_work">
				HOW IT WORKS
				<span class="work_botton">
					<i class="fa fa-chevron-down" aria-hidden="true"></i>
				</span>
			</p>


			<!--<br><br><br>-->

            <div class="row works">
				<div class="col-md-3">
					<p class="step text-center"><span>STEP-1</span></p>
					<p class="text-center work_text">Select your preferred Chhaya plan</p>
				</div>

				<div class="col-md-3">
					<p class="step text-center"><span>STEP-2</span></p>
					<p class="text-center work_text">Provide your required information and make the payment online</p>
				</div>

				<div class="col-md-3">
					<p class="step text-center"><span>STEP-3</span></p>
					<p class="text-center work_text">Check the welcome SMS sent by Chhaya and your subscription is confirmed </p>
				</div>
				<div class="col-md-3">
					<p class="step text-center"><span>STEP-4</span></p>
					<p class="text-center work_text">Login with your mobile number to make insurance claims or to check your subscription status </p>
				</div>


			</div>
		</div>
	</div>


	<div class="section stat-client">
		<div class="container">
			<p class="why_chhaya section_m text-center">OUR PARTNERS</p>
			<div class="margin-bottom-50"></div>
			<div class="owl-carousel owl-theme">
				@foreach(App\Models\Ourpartners::where('status',1)->get() as $partner)
				@if($partner->logo)
					<div class="item">
						<div class="client-img">
						<a  target="_blank" href="{{ $partner->weblink}}"><img src="{{ asset('uploads/images/'.$partner->logo) }}" alt="" class="img-responsive"></a>
						</div>
					</div>
					@endif
				@endforeach

			</div>
		</div>
	</div>




	<div style="background:url({{asset('uploads/static/service.jpg')}})no-repeat;background-attachment: fixed;background-size: cover;" class="section">
		<div class="container">
			<p class="why_chhaya section_m text-center">WHAT PEOPLE SAY</p>
			<div id="owl-testimony">
				@foreach(App\Models\Testimonials::where('status',1)->get() as $testimonial)
					<div class="item">
						<div class="box-testimony">
							<div class="quote-box">
							<blockquote>{{ $testimonial->testimonial }}</blockquote>
								<p class="quote-name"><img style="width: 65px;float: left;margin-right: 5px;border-radius: 50%;height: 65px;object-fit:cover;" src="{{ asset('uploads/images/'.$testimonial->image) }}">
									{{ $testimonial->person_name }} <span>{{ $testimonial->designation }}</span>
								</p>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		<br>
	</div>

	<div class="section stat-client">
	     <br><br><p class="why_chhaya text-center">OUR CORPORATE CLIENTS</p>
		<div class="container">
			<div class="margin-bottom-50"></div>
			<div class="owl-carousel owl-theme">
				@foreach(\App\Models\Corporatepartner::where('status',1)->get() as $partner)
				@if($partner->logo)
					<div class="item">
						<div class="client-img">
						<a  target="_blank" href="{{ $partner->weblink}}">
                            <img style="width: 150px" src="{{ asset('uploads/images/'.$partner->logo) }}" alt="">
                        </a>
						</div>
					</div>
				@endif
				@endforeach

			</div>
		</div>
	</div>

	<div id="about"></div>
	<div class="section about">
		<div class="container-fluid">
			<div class="row">
                <div class="col-md-6 bg_about">
                    <h3 class="text-white">ABOUT US</h3>
                    <p class="text-justify">Chhaya™, a brand of Expotech Solutions Ltd, is here to empower people with enhanced accessibility to avail fintech, education inclusion and agriculture related services through its easy-to-use information technology enabled platform. Salaried employees or entrepreneurs, students or self-employed, or even homemakers – you name a segment and we have got customized solutions for each of them. We are here to help you in times of your need.</p>

                </div>
                <div class="col-md-6 m0 p0 right_side_about">
                    <img src="{{asset('uploads/static/about.jpg')}}">
                </div>
			</div>
		</div>
	</div>

@endsection
