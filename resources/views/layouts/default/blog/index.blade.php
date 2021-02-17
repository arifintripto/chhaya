<section id="blog" class="section">
      <!-- Container Starts -->
      <div class="container">  
        <!-- Row Starts -->
        <div class="row">  
          <div class="col-md-8 ">
            @foreach( $posts as $post)        
                <!-- Blog Item Starts -->
                <div class="blog-item-wrapper wow fadeIn animated" >
                    <div class="row">
                        <div class="col-md-4">
                          <div class="blog-item-img">
                            <a href="{{ url('posts/read/'.$post->alias) }}">
                              @if(file_exists('./uploads/images/'.$post->image) && $post->image !='' )
                              <img src="{{ asset('uploads/images/'.$post->image) }}" alt="" class="img-responisve">
                              @else
                              <img src="{{ asset('uploads/images/no-image.png') }}" alt="" class="img-responisve">
                              @endif
                            </a>   
                          </div>
                        </div>
                        <div class="col-md-8">  
                            <div class="blog-item-text">
                                <h3 class="small-title"><a href="{{ url('posts/read/'.$post->alias) }}">{{ $post->title }}</a></h3>
                                <div class="section-tool text-left ">
                                    <i class="fa fa-eye "></i>  <span>  Views (<b> {{ $post->views }} </b>)  </span>   
                                    <i class="fa fa-user "></i>  <span>  {{ ucwords($post->username) }}  </span>   
                                    <i class="icon-calendar3"></i>  <span> {{ date("M j, Y " , strtotime($post->created)) }} </span> 
                                    <i class="fa fa-comment-o "></i>   <span>  {{ $post->comments }} comment(s)  </span> 
                                </div>
                                <p>{{ $post->metadesc }}</p>
                                <div class="blog-one-footer">
                                    <a href="{{ url('posts/read/'.$post->alias) }}">Read More >> </a>             
                                </div>
                            </div>
                        </div>  
                    </div>    
                </div><!-- Blog Item Wrapper Ends-->
              
              @endforeach
          </div>
          
          <div class="col-md-4">
              @include('layouts.default.blog.widget')
          </div>

        </div><!-- Row Ends -->
        <div class="row text-center">
        {!!  $posts->links() !!}
        </div>
      </div><!-- Container Ends -->
    </section>