<style>
	nav[aria-label=breadcrumb] .breadcrumb .active::before {
content: "" !important;
font-family: "Font Awesome 5 Free";
font-weight: 900;
margin-top: 2px;
}
	.order-2-car3{
		padding-left:5px;
		padding-right:0px;
	}
	.page-heading-title {
		margin-top: -7px;
		padding-bottom: 0px;
	}
	.pro-content {
overflow: hidden;
padding-top: 50px;
padding-bottom: 50px;
border-bottom:.1rem solid #ebebeb;
}


.blog-title{
	color:#777;
	font-size:14px;
}
.pro-blog3 .title_change {
    font-size: 24px !important;
}
  .content_loading .dot {
    width: 1rem;
    height: 1rem;
    margin: 2rem 0.3rem;
    background: #979fd0;
    border-radius: 50%;
    animation: 0.9s bounce infinite alternate;
  }

  .read-more {
    display: inline-block;
    position: relative;
    font-weight: 400;
    letter-spacing: -.01em;
    padding-bottom: 0.1rem;
    -webkit-transition: all .3s ease;
    transition: all .3s ease;
    color:#777;
}
.read-more:focus:after, .read-more:hover:after {
    opacity: 1;
    -webkit-transform: translateX(0);
    transform: translateX(0);
}

.read-more::after {
    font-family: "Font Awesome 5 Brands";
    content: "\2192";
    font-size: 1.5rem;
    line-height: 1;
    display: block;
    position: absolute;
    right: 0px;
    top: 50%;
    margin-top: -0.75rem;
    opacity: 0;
    transform: translateX(-6px);
    transition: all 0.25s ease 0s;
}
.blog5 .blog-detial .tag {
    color: #777;
    font-size: 14px;
    font-weight: 300 !important;
    transition: all .3s ease;
    cursor: pointer;
}

  .content_loading .dot:nth-child(2) {
      animation-delay: 0.3s;
    }

    .content_loading .dot:nth-child(3) {
      animation-delay: 0.6s;
    }
  
    .title_change{
  text-align:<?php echo $result['commonContent']['settings']['title_alignment']; ?> !important;
  font-size:<?php echo $result['commonContent']['settings']['title_font'].'px'; ?> !important;
  font-weight:<?php if($result['commonContent']['settings']['title_style'] == 1){ echo 'Bold'; }else{ echo 'normal';}; ?>
}


.widget {
margin-bottom: 3.5rem;
}
.widget-search .widget-title {
margin-bottom: 1.3rem;
}
.widget-title {
color: #333;
font-weight: 400;
font-size: 1.3rem;
line-height: 1.1;
letter-spacing: -.01em;
margin-bottom: 1rem;
}
.sr-only {
position: absolute;
width: 1px;
height: 1px;
padding: 0;
overflow: hidden;
clip: rect(0,0,0,0);
white-space: nowrap;
border: 0;
}
label {
color: #666;
font-weight: 300;
font-size: 1.4rem;
margin: 0 0 1.1rem;
}
label {
display: inline-block;
margin-bottom: .5rem;
}
.widget-search .form-control {
height: 40px;
padding: .95rem 2.5rem .95rem 1.4rem;
font-weight: 300;
font-size: 1rem;
background-color: transparent;
margin-bottom: 0;
}

.widget-search .btnn {
position: absolute;
right: 0.5rem;
top: 65%;
min-width: 0;
font-weight: 400;
font-size: 1.8rem;
color: #666;
padding: 0;
width: 2rem;
height: 2rem;
margin-top: -1.4rem;
border:none;
background:#fff;
}

.btnn {
display: inline-flex;
align-items: center;
justify-content: center;
text-align: center;
padding: .85rem 1.5rem;
font-weight: 400;
font-size: 1rem;
line-height: 1.5;
letter-spacing: -.01em;
border-radius: 0;
white-space: normal;
-webkit-transition: all .3s;
transition: all .3s;
}

.widget-cats li:not(:last-child) {
margin-bottom: 1rem;
}
.widget-cats a {
color: #333;
display: block;
font-weight: 300;
font-size: 1rem;
line-height: 1.5;
}
.widget-cats a span {
float: right;
}

.tagcloud {
display: flex;
align-items: center;
flex-flow: wrap;
padding-top: .3rem;
margin-right: -1rem;
margin-bottom: -1rem;
}
.tagcloud a {
display: block;
color: #777;
font-weight: 300;
font-size: 1rem;
line-height: 0.7;
border-radius: .3rem;
padding: .65rem .9rem;
background-color: #fafafa;
border: .1rem solid #ebebeb;
margin-right: 1rem;
margin-bottom: 1rem;
-webkit-transition: all .3s ease;
transition: all .3s ease;
}

.tagcloud a:focus, .tagcloud a:hover {
background-color: #fff;
}

.posts-list li {
    margin-bottom: 1rem;
	height:80px;
}
.posts-list figure {
float: left;
width: 80px;
margin-right: 2rem;
margin-bottom: 0;
}
.position-relative {
position: relative!important;
}
.posts-list figure a {
display: block;
}
.posts-list span {
display: block;
color: #ccc;
font-weight: 300;
font-size: 1rem;
line-height: 1.25;
letter-spacing: -.01em;
margin-bottom: .5rem;
}
.posts-list h4 {
display: -webkit-box;
-webkit-line-clamp: 2;
-webkit-box-orient: vertical;
overflow: hidden;
font-weight: 400;
font-size: 1rem;
line-height: 1.4;
letter-spacing: 0;
margin-bottom: 0;
}
.posts-list figure img {
-webkit-object-fit: cover;
object-fit: cover;
height: 80px;
width:100%;
}

.banner-sidebar {
position: relative;
text-align: center;
line-height: 0;
}

.banner-sidebar-title {
color: #777;
text-align: center;
font-weight: 300;
font-size: 1rem;
line-height: 1;
letter-spacing: -.01em;
margin-bottom: .8rem;
text-transform: uppercase;
}

.banner-content {
display: inline-block;
position: absolute;
padding-top: .4rem;
left: 2rem;
top: 50%;
z-index: 2;
-webkit-transform: translateY(-50%);
transform: translateY(-50%);
-ms-transform: translateY(-50%);
}
.banner-sidebar .banner-content {
left: 3rem;
}
.banner-sidebar .banner-content p {
font-size: 0.9rem;
line-height: 1.4;
color: #dfdfdf;
}
.banner-sidebar .banner-content .banner-subtitle {
font-size: 1.3rem;
font-weight: 400;
line-height: 1.4;
color: #fff;
letter-spacing: 0;
margin-bottom: 1rem;
}
.banner-sidebar .banner-content .banner-title {
font-size: 1.65rem;
font-weight: 700;
margin-bottom: 2.5rem;
text-transform: uppercase;
line-height: 1.2;
letter-spacing: -.01em;
color: #fff;
}
.banner-sidebar .banner-content .btnn {
display: flex;
padding: 12px;
min-width: auto;
}
.btnn-outline-white {
color: #fff;
background-color: transparent;
background-image: none;
border-color: #fff;
-webkit-box-shadow: none;
box-shadow: none;
}

@media screen and (max-width: 992px){
	.mbdnone{
		display:none;
	}
}
</style>

<div class="container-fuild">

 <div class="container-fuild text-center" style="background-image:url('{{asset('page-header-bg.jpeg')}}');padding:40px 0">
    <div class="page-heading-title">
        <h2 style="text-transform:initial;margin-bottom:10px !important;font-size:40px;font-weight:400">Home</h2>    
        <h5 style="font-size:20px;font-weight:400" class="common-text">Blog</h5>       
    </div>
  </div>


  <nav aria-label="breadcrumb" style="background:#fff;border-bottom:.1rem solid #ebebeb">
		<div class="container">
		<ol class="breadcrumb">
            <li class="breadcrumb-item"><a style="font-size:1rem;font-weight:300" href="{{ URL::to('/')}}">@lang('website.Home')</a></li><i style="margin:5px 10px" class="fa fa-angle-right"></i>
            <li class="breadcrumb-item active" aria-current="page">@lang('website.News')</li>
          </ol>
		</div>
	</nav>
</div>  

<section class="pro-content">

<section class="blog-content">
	<div class="container"> 
	  
	  <div class="blog-area">

		<div class="row">
			
		  <div class="col-12 col-lg-9 order-2-car3">
			<div class="row">
        

				@if($result['news']['success']==1)
          @foreach($result['news']['news_data'] as $key=>$news_data)
          
          <div class="col-12 col-sm-12 blog5">
            <div class="blog-detial  blog">
              <div class="blog-thumbnail">
				@if($news_data->image_path_type =='aws')
				<img class="img-thumbnail lazy_img_load" data-src="{{$news_data->image_path}}" width="100%" alt="{{$news_data->news_name}}">
				@else
				<img class="img-thumbnail lazy_img_load" data-src="{{asset('').$news_data->image_path}}" width="100%" alt="{{$news_data->news_name}}">
				@endif           
              </div>
              
			  by<span class="tag common-hover"> Superadmin</span>
                <span style="margin:0 10px;color:#777;">|</span>
                <span class="tag common-hover">{{ date('M d, Y', strtotime($news_data->created_at)) }}</span>
                <span style="margin:0 10px;color:#777;">|</span>
                <span class="tag common-hover">3 Comments </span>


			  <h4 style="margin-top:5px;margin-bottom:5px"><a style="font-weight:600 !important;letter-spacing:0.4px;font-size: 22px;" href="{{ URL::to('/news-detail-p24/'.$news_data->news_slug)}}">{{$news_data->news_name}}</a></h4>

			  <p class="blog-title">in Category</p>

              <div class="blog-title">
				<p><?php
					$descriptions = strip_tags($news_data->news_description);
					$string = stripslashes($descriptions);

					$string = (strlen($string) > 200) ? substr($string,0,200).'...' : $string;

					echo $string
					?></p>  
              </div>
				  <span class="common-text"><a style="font-size:14px;letter-spacing: .1em;;font-weight:400 !important" class="read-more common-color" href="{{ URL::to('/news-detail-p24/'.$news_data->news_slug)}}">Continue Reading</a></span>
            </div>
        </div>

					@endforeach
				@endif
					   
			  </div>

      </div>
      
      <div class="col-12 col-lg-3 mbdnone d-lg-block d-xl-block blog-menu order-1-car3"> 

	  			<div class="widget widget-search">
					<h3 class="widget-title">Search</h3>
					<form action="#" method="get" style="position:relative">
						<div class="header-search-wrapper search-wrapper-wide">
							<label for="ws" class="sr-only">Search in blog</label>
							<input type="search" class="form-control" name="ws" id="ws" placeholder="Search in blog" required="">
							<button type="submit" class="btnn">
								<svg class="common-fill-hover" id="search" xmlns="http://www.w3.org/2000/svg" width="16" height="27" viewBox="0 0 27 27">
									<g id="Layer_1" data-name="Layer 1" transform="translate(0 0)">
										<path id="Path_55427" data-name="Path 55427" d="M.216,25.052l6.72-6.72a11.27,11.27,0,1,1,1.591,1.591l-6.72,6.72A1.127,1.127,0,0,1,.216,25.052Zm15.427-4.833a9.007,9.007,0,1,0-9-9,9.007,9.007,0,0,0,9,9Z" transform="translate(0.07 0.07)"></path>
									</g>
								</svg>
								<span class="sr-only">Search</span>
							</button>
						</div>
					</form>
				</div>

				<div class="widget widget-cats">
					<h3 class="widget-title">Categories</h3>
					<ul>
						@if(!empty($result['news_categories']) and count($result['news_categories'])>0)
							@foreach ($result['news_categories'] as $item)
							<?php $cCount = DB::table('news_to_news_categories')->where('categories_id',$item->id)->count(); ?>
								<li><a class="common-hover @if($item->id == $result['categories_id']) common-text @endif" href="{{ URL::to('/news?category='.$item->slug)}}">{{$item->name}}<span>{{ $cCount }}</span></a></li>
							@endforeach		
						@endif	
					</ul>
				</div>


				<div class="widget">
					<h3 class="widget-title">Popular Posts</h3>
					<ul class="posts-list">
						@if($result['news']['success']==1)
							@foreach($result['news']['news_data'] as $key=>$news_data)
								<li>
									<figure class="position-relative">
										<a class="w-100" href="{{ URL::to('/news-detail-p24/'.$news_data->news_slug)}}">
											<span class=" lazy-load-image-background blur lazy-load-image-loaded" style="display: inline-block;">
												@if($news_data->image_path_type == 'aws')
													<img alt="Post" src="{{$news_data->image_path}}" height="80">
												@else
													<img alt="Post" src="{{asset('').$news_data->image_path}}" height="80">
												@endif 
											</span>
										</a>
									</figure>
									<div>
										<span>{{date('M d, Y', strtotime($news_data->created_at))}}</span>
										<h4><a href="{{ URL::to('/news-detail-p24/'.$news_data->news_slug)}}">{{$news_data->news_name}}</a></h4>
									</div>
								</li>
							@endforeach
						@endif
					</ul>
				</div>


				<div class="widget widget-banner-sidebar">
					<div class="banner-sidebar-title">ad box 280 x 280</div>
					<div class="banner-sidebar banner-overlay">
						<a class="w-100" href="#">
							<span class=" lazy-load-image-background opacity lazy-load-image-loaded" style="display: inline-block; height: 277px;">
								<img alt="banner" src="{{asset('news-banner.jpeg')}}" height="277" width="280">
							</span>
						</a>
						<div class="banner-content text-left">
							<p class="mb-1">online &amp; in-store</p>
							<h3 class="banner-subtitle text-uppercase">Spring Sale</h3>
							<h2 class="banner-title">Up to 60% off<br>from $55</h2>
							<a style="border:1px solid #fff;color:#fff" class="btn btn-outline btn-md btn-outline-white text-uppercase m-0" href="#">Shop Now</a>
						</div>
					</div>
				</div>


			  <div class="widget">
				<h3 class="widget-title">Browse Tags</h3>
				<div class="tagcloud">
					@if(!empty($result['news_categories']) and count($result['news_categories'])>0)
						@foreach ($result['news_categories'] as $item)
							<a class="common-hover" href="#">{{$item->name}}</a>
						@endforeach		
					@endif
				</div>
			</div>

			  
			  <div class="widget widget-text">
				<h3 class="widget-title">About Blog</h3>
				<div class="widget-text-content">
					<p style="color:#777;font-size:1rem;">Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, pulvinar nunc sapien ornare nisl.</p>
				</div>
			</div>


			</div>

		
		</div>
		
	  </div>
	</div>
  </section>
  </section>
