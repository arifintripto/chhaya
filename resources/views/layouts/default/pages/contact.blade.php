@include('layouts.default.header')
      <!-- slider -->
      <section  id="home" class="no-padding">
         <div class="owl-slider-full-home owl-carousel owl-theme light-pagination square-pagination dark-pagination-without-next-prev-arrow main-slider">
            <!-- slider item -->
            <div class="item owl-bg-img"  style="background-image:url('{{ asset('frontend/default/images/contact.jpg')}}');">
               <div class="container_advanced full-screen position-relative">
                   <div class="slider-typography text-left container">
                     <div class="scroll-bottom scroll-bottom-home" >
                        <img src="{{ asset('frontend/default/images/down-arrow.png')}}" >
                     </div>
                  </div>
               </div>
            </div>

         </div>
      </section>
      <!-- end slider -->
	  
	  
	    <section id="overview-section" class="no-padding-bottom">
         <div class="container">
            <div class="row">
               <div class="col-md-10 col-sm-10 center-col cursor-default">
                  <span class="title-medium margin-top--5 letter-spacing-2 text-uppercase  black-text margin-six no-margin-lr no-margin-top display-block">
                  ABOUT US</span>
				  
                  <p class="text-medium">
                     Dcastalia, derived from the name Castalia Digital, inspires spontaneous flow of creative ideas and innovations. Since our inception dated back in 2008, we have delivered amazing and effective set of solutions for the small and medium enterprises to the top businesses in Bangladesh as well as around the world.
                     <br/><br/>
                    We thrive to present simple and innovative solutions to complex set of problems. <br/><br/><br/>                  
                  </p>
               </div>
            </div>
         </div>
      </section>
	  
	  
	    <section id="about" class="fix-background countdown-section lazy-load" data-medium="{{ asset('frontend/default/images/k.jpg')}}" data-tablet="{{ asset('frontend/default/images/k.jpg')}}"  data-original="{{ asset('frontend/default/images/k.jpg')}}" >
         
         <div class="container position-relative">
            <div class="row">
               <!-- counter item -->
               <div class="col-md-3 col-sm-6 counter-style1 text-center border-right">
                  <span class="timer counter-number  font-weight-500 white-text" data-to="11" data-speed="3000"></span>
                  <span class="text-uppercase text-small font-weight-200 letter-spacing-2 text-uppercase margin-six no-margin-lr display-block  xs-margin-one xs-no-margin-lr xs-no-margin-buttom white-text">Years</span>
               </div>
               <!-- end counter item -->
               <!-- counter item -->
               <div class="col-md-3 col-sm-6 counter-style1 text-center border-right sm-no-border xs-margin-twenty-three xs-no-margin-lr xs-n_m_b">
                  <span class="timer counter-number  font-weight-500 white-text" data-to="170" data-speed="3000"></span>
                  <span class="text-uppercase text-small font-weight-200 letter-spacing-2 text-uppercase margin-six no-margin-lr display-block  xs-margin-one xs-no-margin-lr xs-no-margin-buttom white-text">Clients Worldwide</span>
               </div>
               <!-- end counter item -->
               <!-- counter item -->
               <div class="col-md-3 col-sm-6 counter-style1 text-center border-right sm-margin-nine sm-no-margin-lr sm-n_m_b xs-margin-twenty-three xs-no-margin-lr xs-n_m_b">
                  <span class="timer counter-number  font-weight-500 white-text" data-to="550" data-speed="3000"></span>
                  <span class="text-uppercase text-small font-weight-200 letter-spacing-2 text-uppercase margin-six no-margin-lr display-block  xs-margin-one xs-no-margin-lr xs-no-margin-buttom white-text">In Bangladesh</span>
               </div>
               <!-- end counter item -->
               <!-- counter item -->
               <div class="col-md-3 col-sm-6 counter-style1 text-center sm-margin-nine sm-no-margin-lr sm-n_m_b xs-margin-twenty-three xs-no-margin-lr xs-n_m_b">
                  <span class="timer counter-number  font-weight-500 white-text" data-to="1000" data-speed="3000"></span><span class="counter-number  font-weight-500 white-text">+</span>
                  <span class="text-uppercase text-small font-weight-200 letter-spacing-2 text-uppercase margin-six no-margin-lr display-block  xs-margin-one xs-no-margin-lr xs-no-margin-buttom white-text">Projects Completed</span>
               </div>
               <!-- end counter item -->
            </div>
         </div>
      </section>
	  
	  
<section id="focus-section" class="gray_bgs">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-sm-10 center-col cursor-default">
                <span class="title-medium letter-spacing-2 text-uppercase alt-font black-text margin-six no-margin-lr no-margin-top display-block">
				Our focus</span>
				<p class="text-medium">
				Dcastalia believes that visually refined realization is the stepping stone towards the project&rsquo;s completion. Still, we know that is just one part of the recipe for success. That&rsquo;s why we are equally concerned about implementing state-of-the-art technology in our projects.<br />
				<br />
				We want our realizations to help the users find the services and information easily, effortlessly and pleasantly. We feel proud whenever our work results in positive emotions and our realizations are remembered.</p>
            </div>
        </div>
    </div>
</section>
	  

<section id="team-section" data-spy="scroll" data-target="#spy" class="myClassName bluish_bgs wow fadeIn fix-background section-casestudy animated lazy-load" data-medium="{{ asset('frontend/default/images/bbb.jpg')}}" data-tablet="{{ asset('frontend/default/images/bbb.jpg')}}" data-original="{{ asset('frontend/default/images/bbb.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-sm-10 center-col cursor-default">
                <span class="title-medium letter-spacing-2 text-uppercase alt-font white-text margin-six no-margin-lr no-margin-top display-block">
                    Team Dcastalia                </span>
                <p class="text-medium white-text">
                    Together we form one of the promising technology companies in Bangladesh in the area of Web &amp; Mobile Platforms. We are practical &amp; pragmatic to address &amp; solve the challenges that we deal with. Blending of Talents, Skills &amp; most importantly &quot;Craftsmanship&quot; makes us confident to cover it all, whatever comes in between from Planning to Deployment.                </p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <!-- <a class="btn btn-sm text-uppercase custom_btn1" href="/about-us/our-team">Meet our people</a> -->
            </div>
        </div>
    </div>
</section>	  
	 



@include('layouts.default.footer')