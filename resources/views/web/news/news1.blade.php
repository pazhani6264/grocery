<div class="container-fuild">
	<nav aria-label="breadcrumb">
		<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
			<li class="breadcrumb-item active" aria-current="page">@lang('website.News')</li>

		</ol>
		</div>
	</nav>
</div>  

<section class="pro-content">
	<div class="container">
	  <div class="page-heading-title">
		  <h2> @lang('website.News') 
		  </h2>
	   
		  </div>
  </div>

<section class="blog-content">
	<div class="container"> 
	  
	  <div class="blog-area">

		<div class="row">
			<div class="col-12 col-lg-4  d-lg-block d-xl-block blog-menu"> 
				@if(!empty($result['news_categories']) and count($result['news_categories'])>0)
				<div class="right-menu-categories category-div">
				@foreach ($result['news_categories'] as $item)
				<a class="main-manu" href="{{ URL::to('/news?category='.$item->slug)}}">
				@if($item->image_path_type == 'aws')
				<img class="img-fuild lazy_img_load" data-src="{{$item->news_image}}">
				@else
				<img class="img-fuild lazy_img_load" data-src="{{asset('').$item->news_image}}">
				@endif
					{{$item->name}}				
				</a>
				@endforeach				  
						
				  </div>
				@endif
			  <div class="category-div">
				@if($result['news']['success']==1)
					@foreach($result['news']['news_data'] as $key=>$news_data)

						<div class="media">
							<div class="media-img"> 
							@if($news_data->image_path_type == 'aws')
							<img class="lazy_img_load" data-src="{{$news_data->image_path}}" alt="{{$news_data->news_name}}" width="100%">
							@else
							<img class="img-fuild lazy_img_load" data-src="{{asset('').$news_data->image_path}}" alt="{{$news_data->news_name}}" width="100%">
							@endif 
						   	</div>
							<div class="media-body">
							<h5><a href="{{ URL::to('/news-detail/'.$news_data->news_slug)}}">{{$news_data->news_name}}</a></h5>
								<div class="post-date">
									<i class="fa fa-calendar" aria-hidden="true"></i>
									{{date('M d, Y', strtotime($news_data->created_at))}} 
								</div>
							
							</div>
						</div>

					@endforeach
				@endif		
					  
			  </div>
			  

			 
			</div>
		  <div class="col-12 col-lg-8">
			<div class="row">

				@if($result['news']['success']==1)
					@foreach($result['news']['news_data'] as $key=>$news_data)
						<div class="col-12 col-sm-12 col-md-6">
							<div class="blog">
							  <div class="blog-thumbnail">
								  <span class="date-tag badge">{{date('d-M-Y', strtotime($news_data->created_at))}}</span>
								  <a href="{{ URL::to('/news-detail/'.$news_data->news_slug)}}">
									@if($news_data->image_path_type =='aws')
								<img class="img-thumbnail lazy_img_load" data-src="{{$news_data->image_path}}" width="100%" alt="{{$news_data->news_name}}">
								@else
								<img class="img-thumbnail lazy_img_load" data-src="{{asset('').$news_data->image_path}}" width="100%" alt="{{$news_data->news_name}}">
								@endif
								</a>
							  </div>
							  <div class="blog-detial">
								  <span class="tag">
									 {{$news_data->categories_name}}                              
								  </span>
								  <h5><a href="{{ URL::to('/news-detail/'.$news_data->news_slug)}}">
									{{$news_data->news_name}}</a>
								  </h5>
								
									  <div>
										  <p>
										<?php
										$descriptions = strip_tags($news_data->news_description);
										$string = stripslashes($descriptions);

										$string = (strlen($string) > 200) ? substr($string,0,200).'...' : $string;

										echo $string
									  ?>
									  </p>
									  </div>
									  <span class="blink"><a href="{{ URL::to('/news-detail/'.$news_data->news_slug)}}"> @lang('website.Read More') .. </a></span>
							  </div>
							 
							</div>
						</div>

					@endforeach
				@endif					   
			  </div>
		  </div>
 
		</div>
		
	  </div>
	</div>
  </section>
  </section>
