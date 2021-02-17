<!-- FOOTER SECTION -->
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-6 col-md-4 hide_on_mobile">
					<div class="footer-item">
						<img width="100px" src="{{ asset('uploads/images/'.$settings->logo)}}" alt="logo bottom">
					<p>{{ $settings->about_note}}</p>


						<div class="footer-sosmed hide_on_mobile">
							@if(!empty($settings->facebook))
								<a href="{{$settings->facebook}}">
									<div class="item">
										<i class="fa fa-facebook"></i>
									</div>
								</a>
							@endif

							@if(!empty($settings->instagram))

							<a href="{{$settings->instagram}}">
								<div class="item">
									<i class="fa fa-instagram"></i>
								</div>
							</a>

							@endif

							@if(!empty($settings->linkedin))

							<a href="{{$settings->linkedin}}">
								<div class="item">
									<i class="fa fa-linkedin"></i>
								</div>
							</a>

							@endif

                                @if(!empty($settings->youtube))

                                    <a href="{{$settings->youtube}}">
                                        <div class="item">
                                            <i class="fa fa-youtube"></i>
                                        </div>
                                    </a>

                                @endif

                                @if(!empty($settings->twitter))

                                    <a href="{{$settings->twitter}}">
                                        <div class="item">
                                            <i class="fa fa-twitter"></i>
                                        </div>
                                    </a>

                                @endif
						</div>

					</div>
				</div>
				<div class="col-xs-7 col-sm-6 col-md-4">
					<div class="footer-item">
						<div class="footer-title">
							Contact Info
						</div>
						<ul class="list-info">
							<li>
								<div class="info-icon">
									<span class="fa fa-phone"></span>
								</div>
								<div class="info-text">{{ $settings->phone}}</div>
							</li>
							<li>
								<div class="info-icon">
									<span class="fa fa-envelope"></span>
								</div>
								<div class="info-text">{{ $settings->email}}</div>
							</li>
						</ul>
						<div class="footer-sosmed hide_on_desktop">
							@if(!empty($settings->facebook))
								<a href="{{$settings->facebook}}">
									<div class="item">
										<i class="fa fa-facebook"></i>
									</div>
								</a>
							@endif
							@if(!empty($settings->twitter))

							<a href="{{$settings->twitter}}">
								<div class="item">
									<i class="fa fa-twitter"></i>
								</div>
							</a>

							@endif
							@if(!empty($settings->youtube))

							<a href="{{$settings->youtube}}">
								<div class="item">
									<i class="fa fa-youtube"></i>
								</div>
							</a>

							@endif
							@if(!empty($settings->instagram))

							<a href="{{$settings->instagram}}">
								<div class="item">
									<i class="fa fa-instagram"></i>
								</div>
							</a>

							@endif
							@if(!empty($settings->pinterest))

							<a href="{{$settings->pinterest}}">
								<div class="item">
									<i class="fa fa-pinterest"></i>
								</div>
							</a>

							@endif
							@if(!empty($settings->linkedin))

							<a href="{{$settings->linkedin}}">
								<div class="item">
									<i class="fa fa-linkedin"></i>
								</div>
							</a>

							@endif
						</div>

					</div>
				</div>
				<div class="col-xs-5 col-sm-4 col-md-4">
					<div class="footer-item">
						<div class="footer-title">
							Additional Links
						</div>
						<ul class="list">
							<li><a href="/contact-us" title="">Contact Us</a></li>
							<li><a href="/our-policies" title="">Our Policies</a></li>
							<li><a target="_blank" href="/pdf/NetworkHospitals.pdf" title="">Discount Partner List</a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>

		<div class="fcopy">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12">
					<p class="ftex"><a href="#">Disclaimer </a>| {{ $settings->copyright_text}} | Designed by <a href="https://vmsl.com.bd">VMSL</a></p>
					</div>
				</div>
			</div>
		</div>

	</div>



	<!-- JS VENDOR -->
	<script type="text/javascript" src="{{ asset('frontend/default/js/vendor/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('frontend/default/js/vendor/jquery.superslides.js')}}"></script>
	<script type="text/javascript" src="{{ asset('frontend/default/js/vendor/owl.carousel.js')}}"></script>
	<script type="text/javascript" src="{{ asset('frontend/default/js/vendor/bootstrap-hover-dropdown.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('frontend/default/js/vendor/jquery.magnific-popup.min.js')}}"></script>
	<script type='text/javascript' src='https://maps.google.com/maps/api/js?sensor=false&#038;ver=4.1.5'></script>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script type="text/javascript" src="{{ asset('frontend/default/js/script.js')}}"></script>
	<script>AOS.init();</script>


	@php $urlArray = explode('/',url()->current()); @endphp

	@if(count($urlArray) > 3)
	    <script>
	    jQuery(document).ready(function(){
            jQuery('.about_action').attr('href','<?= url('/')?>/#about');
            jQuery('.about_products').attr('href','<?= url('/')?>/#products');
        });
	    </script>
	@endif
	@if(count($urlArray) < 4)
    	<script>
    	/* =================================
    	BANNER ROTATOR IMAGE
    	=================================== */
    	$('#slides').superslides({
    		//animation: "fade",
    		play: 5000,
    		slide_speed: 800,
    		pagination: true,
    		hashchange: false,
    		scrollable: true,
    		inherit_height_from: slides,

    	});
    	const navbar = $('.navbar');
    		jQuery('a[href^="#"]').on('click', function(e) {
    			e.preventDefault();
    			const scrollTop =
    			jQuery(jQuery(this).attr('href')).position().top - navbar.outerHeight();
    			jQuery('html, body').animate({ scrollTop },10);
    		})
    	</script>
	@endif

	<script>
	    jQuery(document).ready(function(){
	        jQuery('.right_side_about img').css('height',jQuery('.bg_about').height()+200)
	    })
	</script>

<!--Start of Tawk.to Script-->
	<script type="text/javascript">
		var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
		(function(){
		var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
		s1.async=true;
		s1.src='https://embed.tawk.to/5f52bcb9f0e7167d000d934e/default';
		s1.charset='UTF-8';
		s1.setAttribute('crossorigin','*');
		s0.parentNode.insertBefore(s1,s0);
		})();
	</script>
<!--End of Tawk.to Script-->


</script>
	    <script>
	    jQuery(document).on('click', '.in_mobile_work', function(){
            jQuery('.works').slideToggle();
			jQuery('.fa').removeClass('fa-chevron-down').addClass('fa-chevron-up');
			jQuery('.in_mobile_work').addClass('up');
        });
	    jQuery(document).on('click', '.up', function(){
			jQuery('.fa').removeClass('fa-chevron-up').addClass('fa-chevron-down');
			jQuery('.in_mobile_work').removeClass('up');
        });
</script>

<script>
$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
	navText:false,
	autoplay:true,
	dots: false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
</script>

</body>
</html>
