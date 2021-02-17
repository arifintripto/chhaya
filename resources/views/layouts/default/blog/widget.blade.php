<div class="blog_sidebar">
	<div class="blog_sidebar-title">
		<h4 class="title">
			Popular Articles
		</h4>
	</div>
	<div class="w-lists">
		@foreach($popular as $pop)
		<div class="row mb-4">
			<div class="col-md-5 image-thumb">
				<a href="{{ url('posts/read/'.$pop->alias) }}">
				<img src="/uploads/images/{{ Helper::getThumbnailByPageId($pop->pageID)}}" alt=""  >
				</a>
			</div>
			<div class="col-md-7">
				<div><a href="{{ url('posts/read/'.$pop->alias) }}"> {{ $pop->title }}</a> </div>
				<div class="info ">
					<i class="fa fa-eye ">
					</i>
					<span>
						Views (
						<b>
							{{ $pop->views }}
						</b>
						)
					</span>
					<i class="icon-calendar3">
					</i>
					<span>
						{{ date("M j, Y " , strtotime($pop->created)) }}
					</span>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
<div class="blog_sidebar">
	<div class="blog_sidebar-title">
		<h4 class="title">
			Categories
		</h4>
	</div>
	<ul class="w-list-categories">
		@foreach($categories as $category)
		<li class="">
			<a href="{{ url('posts/category/'.$category->alias ) }}"> {{ $category->name }} ( {{ $category->total }} ) </a>
		</li>
		@endforeach
	</ul>
</div>
</div>