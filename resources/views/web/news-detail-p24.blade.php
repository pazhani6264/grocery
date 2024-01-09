<style>
  	.nav1[aria-label=breadcrumb] .breadcrumb .active::before {
content: "" !important;
font-family: "Font Awesome 5 Free";
font-weight: 900;
margin-top: 2px;
}

.breadcrumb {
display: flex;
flex-wrap: wrap;
padding: 0.75rem 1rem;
margin-bottom: 0rem !important;
list-style: none;
background-color: #fff !important;
border-radius: 0;
}
	.order-2-car3{
		padding-left:5px;
		padding-right:0px;
	}
	.page-heading-title {
		margin-top: -7px;
		padding-bottom: 0px !important;
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


.entry-footer {
  margin-top: 1rem;
  margin-bottom: 5rem;
  align-items: center;
}
.entry-tags {
display: flex;
align-items: center;
flex-flow: wrap;
padding-top: .2rem;
}
.entry-tags span {
margin-right: 1rem;
}
.entry-tags a {
display: block;
color: #777;
font-weight: 300;
font-size: 1rem;
line-height: 1.4;
border-radius: .3rem;
padding: .45rem .9rem;
background-color: #fafafa;
border: .1rem solid #ebebeb;
margin-right: .5rem;
margin-bottom: 0;
-webkit-transition: all .3s ease;
transition: all .3s ease;
}
.social-icons-color, .social-icons-simple {
line-height: 1;
}
.social-icon, .social-icons {
display: flex;
align-items: center;
}
.social-icons {
flex-flow: row wrap;
}
.social-icons-color .social-icon:not(:last-child), .social-icons-simple .social-icon:not(:last-child), .social-label {
margin-right: 2rem;
}
.entry-footer .social-icon {
font-size: 1rem;
}
.no-gutterss {
padding-left: 10px;
padding-right: 10px;
}

.pager-link:focus .pager-link-title, .pager-link:hover .pager-link-title {
-webkit-box-shadow: 0 .1rem 0 #333;
box-shadow: 0 .1rem 0 #333;
color:#333;
}

.pager-link.pager-link-prev {
padding-left: 10rem;
padding-right: 1rem;
}
.pager-link {
position: relative;
align-items: flex-start;
flex: 0 0 100%;
max-width: 100%;
font-weight: 400;
padding-top: .95rem;
padding-bottom: .95rem;
font-size: 1rem;
line-height: 1.5;
-webkit-transition: all .35s ease;
transition: all .35s ease;
}
.pager-link, .pager-nav {
width: 100%;
display: flex;
flex-direction: column;
}
.pager-nav {
align-items: center;
margin-bottom: 4.5rem;
padding-bottom: 1rem;
}

.pager-link.pager-link-next {
padding-left: 1rem;
padding-right: 10rem;
align-items: flex-end;
text-align: right;
}

.pager-link:focus.pager-link-prev, .pager-link:hover.pager-link-prev {
padding-left: 7rem;
}
.pager-link:focus.pager-link-next, .pager-link:hover.pager-link-next {
padding-right: 7rem;
}

.pager-link.pager-link-prev:after {
content: "\27F5";
left: 4rem;
}
.pager-link:after {
color: #333;
display: block;
font-size: 1rem;
line-height: 1;
position: absolute;
top: 50%;
-webkit-transition: all .35s ease .05s;
transition: all .35s ease .05s;
margin-top: -.8rem;
}
.pager-link:focus.pager-link-prev:after, .pager-link:hover.pager-link-prev:after {
left: 0;
}

.pager-link.pager-link-next:after {
content: "\2192";
right: 4rem;
}
.pager-link:focus.pager-link-next:after, .pager-link:hover.pager-link-next:after {
right: 0;
}

.related-posts {
  padding:0px 10px;
}
.related-posts .title {
font-weight: 600;
font-size: 1.5rem;
letter-spacing: -.025em;
margin-bottom: 2rem;
}

.p24 .blog-slick-dots .slick-dots {
position: absolute !important;
bottom: -30px !important;
display: block;
width: 100%;
padding: 0;
margin: 0;
list-style: none;
text-align: center;
}

.post-title{
  font-size:1.5rem;
  margin-bottom:0px
}

@media screen and (max-width: 992px){
	.mbdnone{
		display:none;
	}
  .blog-content .blog .blog-thumbnail .img-thumbnail {
height: auto !important;
}
}

@media (min-width: 768px){
  .flex-md-row {
    flex-direction: row !important;
    width: 100%;
  }
  .col-md {
    -ms-flex-preferred-size: 0;
    flex-basis: 0;
    -ms-flex-positive: 1;
    flex-grow: 1;
    max-width: 100%;
  }
  .col-md-auto {
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    width: auto;
    max-width: 100%;
  }
}

@media screen and (min-width: 576px){
  .pager-link {
    flex: 0 0 50%;
    max-width: 50%;
    padding-top: .55rem;
    padding-bottom: .55rem;
  }
  .pager-link+.pager-link {
border-top: none;
border-left: .1rem solid #ebebeb;
}
.pager-nav {
flex-direction: row;
padding-bottom: 2.5rem;
border-bottom: .1rem solid #ebebeb;
}


}
</style>

@extends('web.layout')
@section('content')


<div class="container-fuild text-center" style="background-image:url('{{asset('page-header-bg.jpeg')}}');padding:40px 0">
    <div class="page-heading-title">
        <h2 style="text-transform:initial;margin-bottom:10px !important;font-size:40px;font-weight:400">Home</h2>    
        <h5 style="font-size:20px;font-weight:400" class="common-text">@lang('website.News')</h5>       
    </div>
  </div>


  <div class="nav1" aria-label="breadcrumb" style="background:#fff;border-bottom:.1rem solid #ebebeb">
		<div class="container">
		<ol class="breadcrumb">
            <li class="breadcrumb-item"><a style="font-size:1rem;font-weight:300" href="{{ URL::to('/')}}">@lang('website.Home')</a></li><i style="margin:5px 10px" class="fa fa-angle-right"></i>
            <li class="breadcrumb-item active" aria-current="page">@lang('website.News')</li>
          </ol>
		</div>
</div>
</div>  

<section class="pro-content">
<!-- Site Content -->
<section class="blog-content">
<div class="container">

 <div class="blog-area">

   <div class="row">
    <div class="col-12 col-lg-9 order-2-car3">
      <div class="row blog5">
          <div class="blog blog-detial">
            <div class="blog-thumbnail">
              @if($result['newss']->image_path_type == 'aws')
              <img class="img-thumbnail" src="{{$result['newss']->image}}" width="100%">  
              @else
              <img class="img-thumbnail" src="{{asset('').$result['newss']->image}}" width="100%">  
              @endif     
            </div>

            by <span class="tag"> Superadmin </span>
              <span style="margin:0 10px;color:#ccc;">|</span>
              <span class="tag">{{ date('M d, Y', strtotime($result['newss']->created_at)) }}</span>
              <span style="margin:0 10px;color:#ccc;">|</span>
              <span class="tag">3 Comments </span>
          
            <h5 class="post-title">
              <a href="#">
              {{$result['newss']->news_name}}</a>
            </h5>

            <span class="tag">
              {{$result['newss']->categories_name}}                              
            </span>

            <div class="blog-title" style="margin-top:20px">
              <?php echo stripslashes($result['newss']->news_description); ?>
            </div>
          </div>

          <div class="entry-footer row no-gutterss flex-column flex-md-row">
            <div class="col-md">
              <div class="entry-tags">
                <span>Tags:</span>
                  <a href="#">photography</a>
                  <a href="#">style</a>
                </div>
              </div>
              <div class="col-md-auto mt-2 mt-md-0">
                <div class="social-icons social-icons-color">
                  <span class="social-label">Share this post:</span>
                  <a class="social-icon social-facebook" href="#"><i class="fa fa-facebook-f"></i></a>
                  <a class="social-icon social-twitter" href="#"><i class="fa fa-twitter"></i></a>
                  <a class="social-icon social-pinterest" href="#"><i class="fa fa-pinterest"></i></a>
                  <a class="social-icon social-linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                </div>
              </div>
            </div>


            <?php  

            //print_r($result['catid']);die();


          $next_product_id  = DB::table('news_to_news_categories')->where('news_id','>', $result['newsid'])->where('categories_id', $result['catid'])->orderBy('news_id')->first();
       

          $prev_product_id  = DB::table('news_to_news_categories')->where('news_id','<', $result['newsid'])->where('categories_id', $result['catid'])->orderBy('news_id')->first();

          if($next_product_id != '')
          {
            $next_record = DB::table('news')
              ->leftjoin('news_description','news_description.news_id','=','news.news_id')
              ->leftjoin('news_to_news_categories','news_to_news_categories.news_id','=','news.news_id')
              ->leftjoin('news_categories','news_categories.categories_id','=','news_to_news_categories.categories_id')
              ->LeftJoin('image_categories', 'news.news_image', '=', 'image_categories.image_id')
              ->leftjoin('news_categories_description','news_categories_description.categories_id','=','news_categories.categories_id')
              ->where([
                ['news.news_id','=',$next_product_id->news_id],
                ['news_description.language_id','=',Session::get('language_id')],
                ['news_categories_description.language_id','=',Session::get('language_id')]
              ])
              ->select('news.*','news_description.*','image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'news_categories_description.categories_name')
              ->groupBy('news.news_id')
              ->first();
          }
          else
          {
            $next_record = '';
          }

          if($prev_product_id != '')
          {
            $prev_record = DB::table('news')
              ->leftjoin('news_description','news_description.news_id','=','news.news_id')
              ->leftjoin('news_to_news_categories','news_to_news_categories.news_id','=','news.news_id')
              ->leftjoin('news_categories','news_categories.categories_id','=','news_to_news_categories.categories_id')
              ->LeftJoin('image_categories', 'news.news_image', '=', 'image_categories.image_id')
              ->leftjoin('news_categories_description','news_categories_description.categories_id','=','news_categories.categories_id')
              ->where([
                ['news.news_id','=',$prev_product_id->news_id],
                ['news_description.language_id','=',Session::get('language_id')],
                ['news_categories_description.language_id','=',Session::get('language_id')]
              ])
              ->select('news.*','news_description.*','image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'news_categories_description.categories_name')
              ->groupBy('news.news_id')
              ->first();
          }
          else
          {
            $prev_record = '';
          }

          
         
     ?>


            <nav class="pager-nav">
              <?php if($prev_record !='') { ?>
                <a class="pager-link pager-link-prev" href="{{ URL::to('/news-detail-p24/'.$prev_record->news_slug)}}"><span class="common-text">Previous Post</span><span class="pager-link-title">{{$prev_record->news_name}}</span>
              </a>
              <?php } if($next_record !='') {?>
                <a class="pager-link pager-link-next" href="{{ URL::to('/news-detail-p24/'.$next_record->news_slug)}}"><span class="common-text">Next Post</span><span class="pager-link-title">{{$next_record->news_name}}</span></a>
              <?php } ?>
            </nav>

            <div class="related-posts">
              <h3 class="title">Related Posts</h3>
            </div>
            <div class="general-product p24">
             <div class="container  p-0 blog-slick-dots">
             <div class="blog-carousel-jsp24 blog-padding">
             <?php 
              //print_r($result['categories_id']);die();
              $news1 = DB::table('news')
              ->leftjoin('news_description','news_description.news_id','=','news.news_id')
              ->leftjoin('news_to_news_categories','news_to_news_categories.news_id','=','news.news_id')
              ->leftjoin('news_categories','news_categories.categories_id','=','news_to_news_categories.categories_id')
              ->LeftJoin('image_categories', 'news.news_image', '=', 'image_categories.image_id')
              ->leftjoin('news_categories_description','news_categories_description.categories_id','=','news_categories.categories_id')
              ->where([
                ['news_categories.categories_id','=',3],
                ['news_description.language_id','=',Session::get('language_id')],
                ['news_categories_description.language_id','=',Session::get('language_id')]
              ])
              ->select('news.*','news_description.*','image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'news_categories_description.categories_name')
              ->groupBy('news.news_id')
              ->get();
             foreach($news1 as $key=>$news_data)
             {
                 $news_url = url('/news-detail-p24/'.$news_data->news_slug);
                 ?>
                 <div class="">
                 <div class="blog3 blog5">
                 <div class="blog-thumbnail">
                 <?php if($news_data->image_path_type == 'aws')
                 { ?>
                     <a href="{{ $news_url }}">
                 <img class="" src="{{ $news_data->image_path }}" width="100%" alt="{{ $news_data->news_name }}"></a>
                 <?php }
                 else
                 { ?>
                     <a href="{{ $news_url }}">
                 <img class="" src="'.asset('').$news_data->image_path.'" width="100%" alt="{{$news_data->news_name}}"></a>
                 <?php  } ?>
                 
                 <div class="over"></div>
                 </div>
                 <div class="blog-detial">
          
                 <span class="tag">{{ date('M d, Y', strtotime($news_data->created_at)) }}</span>
                  <span style="margin:0 10px;color:#ccc;">|</span>
                  <span class="tag">3 Comments </span>
                 <?php 
                    $descriptions = strip_tags($news_data->news_name);
                    $strip_name = stripslashes(substr($descriptions, 0, 150) . '...');
                 ?>
                 <h4 style="margin-top:5px;margin-bottom:5px"><a style="font-weight:500 !important;letter-spacing:0.4px;font-size: 18px;" href="{{ $news_url }}">{{ $strip_name }}</a></h4>
                 in<span class="tag"> {{ $news_data->categories_name }}</span>
                 </div>
                 </div>
                 </div>
                 
              <?php } ?>
            
             </div>
             </div>
             </div>

        </div>
    </div>

                     <div class="col-12 mbdnone col-lg-3 d-lg-block d-xl-block blog-menu">
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

<script>
  jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.blog-carousel-jsp24');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this),
            item = jQuery(this).data('item'),
            itemmobile = jQuery(this).data('itemmobile');
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: false,
          infinite: true,
          autoplay: true,
          //rtl:true,
          speed: 300,
          slidesToShow: item || 3,
          slidesToScroll: item || 3,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3
            }
          }, {
            breakpoint: 768,
            settings: {
              dots: true,
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }, {
            breakpoint: 650,
            settings: {
              dots: true,
              slidesToShow: itemmobile || 1,
              slidesToScroll: itemmobile || 1
            }
          }]
        });
      });
    }

    ;
  })(jQuery);
}); // aboutus section
</script>

@endsection
