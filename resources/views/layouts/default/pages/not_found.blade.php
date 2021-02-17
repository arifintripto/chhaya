@include('layouts.default.header')

<section class="no-padding">
<a href="/">
    <div class="background_image" style="background-image:url('{{ asset('frontend/default/images/404.png')}}');">
       <div class="container_advanced full-screen position-relative">
          <div class="slider-typography text-left container">
             <div class="scroll-bottom scroll-bottom-home" >
                <img src="{{ asset('frontend/default/images/down-arrow.png')}}" >
             </div>
          </div>
       </div>
    </div>
</a>
</section>
   
@include('layouts.default.footer')
	  
	  