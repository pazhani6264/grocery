<style>

.home-page .testimonial {
    display: flex;
}
.avatar {
    margin-right: 3.2rem;
    min-width: 98px;
}
.lazy-overlay {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background: #f4f4f4;
}

.bg-transparent {
    background-color: transparent!important;
}
.lazy-load-image-background.lazy-load-image-loaded {
    display: inline!important;
    z-index: 2;
}
.lazy-load-image-background {
    position: relative;
    width: 100%;
    z-index: -1;
}
.avatar img {
    min-width: 98px;
    margin-top: 3rem;
}
.testimonial img {
    display: inline-block!important;
    max-width: 70px;
    border-radius: 50%;
    margin-top: 1rem;
    margin-bottom: 2.1rem;
}
.content {
    width: 100%;
    text-align:left;
}
.home-page .comment-title {
    margin-bottom: 0.2rem;
    font-size: 1rem;
    color: #222;
    letter-spacing: -.01em;
}
.font-weight-semibold {
    font-weight: 600!important;
}
.home-page .comment {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-bottom: 0.5rem;
    color: #666;
    font-style: italic;
    line-height: 2.4rem;
    font-size: 1rem;
}
.comment {
    position: relative;
    display: flex;
    align-items: flex-start;
}
.home-page .commenter {
    color: #222;
    letter-spacing: -.01em;
    font-size: 1rem;
}
.font-weight-normal {
    font-weight: 400!important;
}

.testimonial-slider6 .slick-slide img {
    border-top-left-radius: 50% !important; 
     border-top-right-radius: 50% !important; 
}

.demo-33-testimonial-star-outer > label:before {
    font-size: 12px !important;
    margin-right: 5px;
    
}
.testimonial-star-outer > label:before {
    font-size: 1.2rem;
    margin-top:5px;
    font-family: "Font Awesome 5 Free";
    display: inline-block;
    content: "\F005";
}
.testimonial-star-outer label.active {
    color: #fac451 !important;
}
.testimonial-star-outer > label {
    color: #ddd;
}
.demo-33-testimonial-star-outer > label:before {
    font-size: 12px !important;
    margin-right: 5px;
    
}

.demo-33-testimonial-item__review-rating{
    text-align:left;
}




.testimonial-slider6 .slick-next {
    right: 1%;
    width:25px !important;
  }

.testimonial-slider6 .border-20 {
    border: 0.1rem solid #ebebeb;
    background: #fff;
    margin: 15px 0px !important;
    padding-top: 0px !important;
}
.testimonial-slider6 .slick-next:hover, .slick-next:focus {
  background:transparent !important;
}


.testimonial-slider6  .slick-next:before {
    content: '\203A';
    font-size:5rem;
}

.testimonial-slider6  .slider-next {
    right: 0%;
    top:-30%;
}
.testimonial-slider6  .slider-prev {
    left: 96%;
    top:-30%;
}



.quick-fill:hover
{
  fill: #fff !important;
}
.fill-color-arrow-car
{
  fill: #999;
}


.banners-content .cr6 .container-fluid [class^=col] {
    padding-right: 10px;
    padding-left: 10px;
}
.cr6 .row{
    margin-left:-10px;
    margin-right:-10px;
}


.cr6 .title_change_blog8 {
    text-align: left !important;
    font-size: 22px !important;
    font-weight: 600 !important;
    letter-spacing: -.025em;
    display: inline-block;
    margin-bottom:0px
}
.cr6{
    margin:0 0 4rem 0;
}

@media only screen and (max-width: 768px)
{
    .testimonial-slider6 .slider-prev {
    left: 93%;
    top: -29%;
}
  
}
@media only screen and (max-width: 600px)
{
    .blog-slick-dots .slick-dots {
position: absolute !important;
bottom: -50px !important;
text-align: center;
}

}

</style>


      <?php 

$reviews = DB::table('reviews')
->join('reviews_description','reviews_description.review_id','=','reviews.reviews_id')
->LeftJoin('products', 'products.products_id', '=', 'reviews.products_id')
->LeftJoin('image_categories', 'products.products_image', '=', 'image_categories.image_id')
->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
->select('reviews.reviews_id', 'reviews.products_id', 'reviews.reviews_rating as rating', 'reviews.created_at','image_categories.path as image_path', 'reviews_description.reviews_text as comments', 'reviews.customers_name','reviews.created_at','products_description.products_name','products.products_slug')
->where('image_categories.image_type', 'ACTUAL')
->where('reviews.reviews_status', 1)
->where('products_description.language_id', Session::get('language_id'))
->where('reviews_description.language_id', Session::get('language_id'))->get();

      ?>

 
<div class="home-page cr6 blog-slick-dots">
    @if(count($reviews) > 0)
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-12">
                    <div class="pro-heading-title mtb40s p-0" style="margin-bottom:5px !important">
                        <h2 style="text-transform:initial" class="title_change_blog8">Reviews From Real Customers</h2>
                        <!-- <a class="title-link14 common-fill-hover" href="#">View more posts <svg xmlns="http://www.w3.org/2000/svg" width="11" height="17" viewBox="0 0 33.908 19.619" style="margin-left: 10px;">
                        <path id="arrow_right" d="M28.861,11.627a1.335,1.335,0,0,0-.01,1.88l6.212,6.223L6.928,19.342a1.328,1.328,0,0,0,0,2.657l28.125.388-6.212,6.223a1.345,1.345,0,0,0,.01,1.88,1.323,1.323,0,0,0,1.87-.01L39.14,22h0a1.492,1.492,0,0,0,.276-.419,1.268,1.268,0,0,0,.1-.511,1.332,1.332,0,0,0-.378-.93l-8.42-8.481A1.3,1.3,0,0,0,28.861,11.627Z" transform="translate(-5.61 -11.252)"/>
                        </svg></a> -->
                    </div>
                </div>
            </div>
        <hr>


        <div class="testimonial-slider6">
            @foreach($reviews as $rev)

            <?php 
        $new_active_class1 ='';
        $new_active_class2 ='';
        $new_active_class3 ='';
        $new_active_class4 ='';
        $new_active_class5 ='';

            if($rev->rating >= 1)
            {
                $new_active_class1 = 'active';
            }
            if($rev->rating >= 2)
            {
                $new_active_class2 = 'active';
            }
            if($rev->rating >= 3)
            {
                $new_active_class3 = 'active';
            }
            if($rev->rating >= 4)
            {
                $new_active_class4 = 'active';
            }
            if($rev->rating >= 5)
            {
                $new_active_class5 = 'active';
            }

      ?>
      
                <div class="slick">
                    <div class="testimonial">
                        <div class="avatar">
                            <div class="lazy-overlay bg-transparent"></div>
                            <span class=" lazy-load-image-background blur lazy-load-image-loaded" style="display: inline-block;">
                                <img alt="Comment Image" src="{{$rev->image_path}}" width="98" height="98">
                            </span>
                        </div>
                        <div class="content">
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div class="demo-33-testimonial-item__review-rating" tabindex="0" aria-label="5 stars" role="img"> 
                                <fieldset class="demo-33-testimonial-star-outer testimonial-star-outer">
                                    <label class = "full fa {{$new_active_class1}}" for="star1" title="bad_1_stars "></label>
                                    <label class = "full fa {{$new_active_class2}}" for="star_2" title="average_2_stars"></label>
                                    <label class = "full fa {{$new_active_class3}}" for="star_3" title="good_3_stars"></label> 
                                    <label class = "full fa {{$new_active_class4}}" for="star_4" title="pretty_good_4_stars"></label> 
                                    <label class = "full fa {{$new_active_class5}}" for="star_5" title="awesome_5_stars"></label>    
                                </fieldset>
                            </div>
                            <div class="comment-title font-weight-semibold">{{$rev->products_name}}</div>
                            <p class="comment">{{$rev->comments}}</p>
                            <div class="commenter"><span class="name font-weight-normal">{{$rev->customers_name}}</span></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    </div>

</div>



<script>


(function (jQuery) {
  var tabCarousel = jQuery('.testimonial-slider6');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: true,
          infinite: false,
          autoplay: false,
          autoplaySpeed: 300,

          prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-left-arrow fill-color-arrow-car common-fill-hover slider-arrow slider-prev" width="18" height="18" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
    	  nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-right-arrow fill-color-arrow-car common-fill-hover slider-arrow slider-next" width="18" height="18" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',

          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  3,
          slidesToScroll:  1,
          adaptiveHeight: false,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
              dots: false,
              arrows: true,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
              dots: false,
              arrows: true,
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
              dots: true,
              arrows: false,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);




</script>