<style>

.demo-33-testimonial-star-outer > label:before {
    font-size: 14px !important;
    margin-right: 0px;
}
.testimonial-star-outer > label:before {
    font-size: 1.2rem;
    margin-top:5px;
    font-family: "Font Awesome 5 Free";
    display: inline-block;
    content: "\F005";
}

.testimonial-star-outer > label {
    color: #ddd;
}


.demo-33-testimonial-item__review-rating{
    text-align:center;
}
.ratings {
    border: none;
    float: none;
}


.home-page-cr7 .slick-slide img {
    display: block;
    border-radius: 50%;
}

.mt-12 {
    margin-top: 12rem!important;
}


.testimonials-box {
    position: relative;
    padding-top: 5.5rem;
    border: 1px solid #e1e1e1;
    border-radius: 5px;
    -webkit-transition: -webkit-box-shadow .35s ease;
    transition: -webkit-box-shadow .35s ease;
    transition: box-shadow .35s ease;
    transition: box-shadow .35s ease,-webkit-box-shadow .35s ease;
}
.home-page-cr7 .testimonials {
    position: static;
    font-style: normal;
}
.text-center {
    text-align: center!important;
}
blockquote {
    position: relative;
    margin: 0 0 4.2rem;
    padding: 0;
    color: #777;
    font-style: italic;
    font-size: 1.6rem;
    line-height: 1.625;
}
.home-page-cr7 .testimonials .avatar {
    position: absolute;
    left: 50%;
    top: 0;
    z-index: 100;
    -webkit-transform: translate(-50%,-50%);
    transform: translate(-50%,-50%);
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

.home-page-cr7 .testimonials .comment-title {
    color: #222;
    font-size: 1.45rem;
    font-weight: 700;
    line-height: 1;
    letter-spacing: -.025em;
    margin-bottom:1rem;
}
.home-page-cr7 .testimonials p {
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    color: #666;
    font-family: Playfair Display,Sans-serif;
    font-size: 1.15rem;
    font-style: italic;
    font-weight: 400;
    letter-spacing: 0;
    line-height: 1.6;
    overflow: hidden;
    padding: 0 5rem;
    margin-bottom:0;
}
.home-page-cr7 .testimonials cite {
    font-weight: 700;
}
blockquote cite {
    font-style: normal;
    font-weight: 500;
    color: #333;
    letter-spacing: -.01em;
    line-height: 1;
    font-size: 1.15rem;
}
.testimonials-box:hover {
    -webkit-box-shadow: 0 7px 12px 5px rgb(0 0 0 / 5%);
    box-shadow: 0 7px 12px 5px rgb(0 0 0 / 5%);
}

.mb-10 {
    margin-bottom: 10rem!important;
}
.home-page-cr7 .heading .subtitle {
    font-size: 1.7rem;
    font-weight: 700;
    line-height: 1.1;
    letter-spacing: -.025em;
    color: #222;
    margin-bottom: 1rem;
}
.home-page-cr7 .heading .title {
    font-size: 4.3rem;
    font-weight: 700;
    line-height: 1;
    letter-spacing: -.025em;
    color: #222;
    text-align: center;
    display: block;
    text-transform:initial !important;
}
.heading .title {
    margin-bottom: 0;
}

.home-page-cr7 .slick-slide {
    outline: none;
    padding: 0 10px !important;
}
.home-page-cr7 .slick-list {
    position: relative;
    display: block;
    overflow: initial;
    margin: 0;
    padding: 0;
}



@media only screen and (max-width: 768px)
{
    .banners-content  .home-page-cr7  .container-fluid {
    padding-left: 10px;
    padding-right: 10px;
}
.blog-slick-dots .slick-dots {
    position: absolute !important;
    bottom: -50px;
    display: block;
    width: 100%;
    padding: 0;
    margin: 0;
    list-style: none;
    text-align: center;
}
}
@media only screen and (max-width: 600px)
{
    .banners-content  .home-page-cr7  .container-fluid {
    padding-left: 10px;
    padding-right: 10px;
}
    .home-page-cr7 .slick-slide {
        outline: none;
        padding: 0 10px;
    }
    .home-page-cr7 .heading .title {
    font-size: 3rem;
    font-weight: 700;
    line-height: 1;
    letter-spacing: -.025em;
    color: #222;
    text-align: center;
    display: block;
    text-transform: initial !important;
}
.blog-slick-dots .slick-dots {
    position: absolute !important;
    bottom: -50px;
    display: block;
    width: 100%;
    padding: 0;
    margin: 0;
    list-style: none;
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

$current_theme = DB::table('current_theme')->where('id', '=', '1')->first();

if($current_theme->template == 0)
{
    $customized_class = '';
}
else
{
    $customized_class = 'mt-12';
}

      ?>


<div class="home-page-cr7  blog-slick-dots {{$customized_class}} ">
    @if(count($reviews) > 0)
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-12">
                    <div class="heading mb-10 text-center">
                        <h4 class="subtitle">Our users love us</h4>
                        <h2 class="title">Customer Reviews</h2>
                    </div>
                </div>
            </div>

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
                $new_active_class1 = 'active common-color';
            }
            if($rev->rating >= 2)
            {
                $new_active_class2 = 'active common-color';
            }
            if($rev->rating >= 3)
            {
                $new_active_class3 = 'active common-color';
            }
            if($rev->rating >= 4)
            {
                $new_active_class4 = 'active common-color';
            }
            if($rev->rating >= 5)
            {
                $new_active_class5 = 'active common-color';
            }

      ?>
      
                <div class="slick">
                    <div class="testimonials-box">
                        <blockquote class="testimonials text-center">
                            <div class="avatar">
                                <div class="lazy-overlay bg-transparent"></div>
                                <span class=" lazy-load-image-background blur lazy-load-image-loaded" style="display: inline-block; height: 100px; width: 100px;">
                                    <img alt="User" src="{{$rev->image_path}}" width="100" height="100">
                                </span>
                            </div>
                            <div class="ratings-contianer">
                                <div id="demo-30-ratings" class="ratings">
                                    <div class="demo-33-testimonial-item__review-rating" tabindex="0" aria-label="5 stars" role="img"> 
                                        <fieldset class="demo-33-testimonial-star-outer testimonial-star-outer">
                                            <label class = "full fa {{$new_active_class1}}" for="star1" title="bad_1_stars "></label>
                                            <label class = "full fa {{$new_active_class2}}" for="star_2" title="average_2_stars"></label>
                                            <label class = "full fa {{$new_active_class3}}" for="star_3" title="good_3_stars"></label> 
                                            <label class = "full fa {{$new_active_class4}}" for="star_4" title="pretty_good_4_stars"></label> 
                                            <label class = "full fa {{$new_active_class5}}" for="star_5" title="awesome_5_stars"></label>    
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <h5 class="comment-title">{{$rev->products_name}}</h5>
                            <p>{{$rev->customers_name}}</p>
                            <cite>{{$rev->customers_name}}</cite>
                        </blockquote>
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
          autoplaySpeed: 2000,

          prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-left-arrow fill-color-arrow-car common-fill-hover slider-arrow slider-prev" width="20" height="20" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
    	  nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-right-arrow fill-color-arrow-car common-fill-hover slider-arrow slider-next" width="20" height="20" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',

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
              dots: true,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
              dots: true,
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
              dots: true,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);




</script>