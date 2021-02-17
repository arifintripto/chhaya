<!-- Load page -->
	<div class="animationload">
		<div class="loader"></div>
	</div>

	<!--
	<div class="topbar">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="topbar-left">
						<div class="welcome-text">
							{{ $settings->welcome_text }}
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="topbar-right">
						<ul class="topbar-sosmed">
							@if(!empty($settings->facebook))
								<li>
								<a href="{{$settings->facebook}}"><i class="fa fa-facebook"></i></a>
								</li>
							@endif
							@if(!empty($settings->twitter))
							<li>
							<a href="{{$settings->twitter}}"><i class="fa fa-twitter"></i></a>
							</li>
							@endif
							@if(!empty($settings->youtube))
							<li>
							<a href="{{$settings->youtube}}"><i class="fa fa-youtube"></i></a>
							</li>
							@endif
							@if(!empty($settings->instagram))
							<li>
							<a href="{{$settings->instagram}}"><i class="fa fa-instagram"></i></a>
							</li>
							@endif
							@if(!empty($settings->pinterest))
							<li>
							<a href="{{$settings->pinterest}}"><i class="fa fa-pinterest"></i></a>
							</li>
							@endif
							@if(!empty($settings->linkedin))
							<li>
							<a href="{{$settings->linkedin}}"><i class="fa fa-linkedin"></i></a>
							</li>
							@endif
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div> TOPBAR -->



	<!-- NAVBAR SECTION -->
	<div id="navbar" class="navbar navbar-main stiky">

		<div class="container container-nav">

			<div class="navbar-header">

				<div class="mobile_logo">
					<a href="/"><img src="{{ asset('uploads/images/'.$settings->logo)}}" alt=""/></a>
				</div>

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<nav class="navbar-collapse collapse">
    			<a class="navbar-brand desktop_logo" href="/" style="margin-bottom: 10px">
    				<img width="200px" src="{{ asset('uploads/images/'.$settings->logo)}}" alt=""/>
    			</a>
				<ul class="nav navbar-nav navbar-right mtn-10">
					<li><a class="about_action" href="#about">ABOUT</a></li>
					<li><a class="about_products" href="#products">PRODUCTS</a></li>


					@if(\Auth::check())
					@if(\Auth::user()->group_id == 7 )
					<li class="bg_spcl" ><a href="/insuranceclaims/create">CLAIM</a></li>
					@endif
				    <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-user"></i> <i class="fa fa-chevron-down"></i></a>

						<ul class="dropdown-menu">
							<li><a href="/user/profile">MY ACCOUNT</a></li>
							<li><a href="/dashboard">DASHBOARD</a></li>
							<li><a href="/user/logout">LOGOUT</a></li>
						 </ul>

					</li>





					@else
					<li class="bg_spcl" ><a href="/dashboard">LOGIN/CLAIM</a></li>

					@endif


				</ul>
			</nav>

		</div>
    </div>
