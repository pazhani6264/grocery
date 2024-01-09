<style>
   
    .testimonial{
    width: 100%;
    
    display: flex;
    justify-content: center;
    align-items: center;
   text-align:center;
   color: #000;
    }

    .testimonial-slide{
        padding:0;
    }
    

        .testimonial_box-top{
           
           
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
           
        }
        .testimonial_box-icon{
            padding: 10px 0;
        }
        .testimonial_box-icon i{
                font-size: 25px;
                color: #14213d;
            }
        
        .testimonial_box-text{
            padding: 10px 0;
        }
        .testimonial_box-text p{
                color: #293241;
                font-size: 14px;
                line-height: 20px;
                margin-bottom: 0;
            }
        
        .testimonial_box-img{
            padding: 20px 0 10px;
            display: flex;
            justify-content: center;
        }
        .testimonial_box-img img{
                width: 70px;
                height: 70px;
                border-radius: 50px;
                border: 2px solid #e5e5e5;
            }
        
        .testimonial_box-name{
            padding-top: 10px;
        }
        .testimonial_box-name  h4{
                font-size: 20px;
                line-height: 25px;
                color: #293241;
                margin-bottom: 0;
            }
        
        .testimonial_box-job p{
           
                color: #293241;
                font-size: 14px;
                text-transform: uppercase;
                letter-spacing: 3px;
                line-height: 20px;
                font-weight: 300;
                margin-bottom: 0;
            
        }

        .testimonial-title-and-link {
    margin-bottom: 24px;
}


.testimonial-title-and-link {
    width: calc(100% - 81px);
    margin: 0 auto 24px auto;
}
.testimonial-title {
    text-align: center;
    margin: 0;
}
.testimonial-star-outer > label:before {
    font-size: 1.2rem;
    margin-top:5px;
    font-family: "Font Awesome 5 Free";
    display: inline-block;
    content: "\F005";
}
.testimonial-main-p
{
    font-size: 14px;
}
.testimonial-star-outer label.active {
    color: #fac451 !important;
}
.testimonial-star-outer > label {
    color: #ddd;
}
    .testimonial-item {
    display: inline-block;
    height: 100%;
    vertical-align: middle;
   width: 100%;
    overflow: hidden;
    padding: 0 24px;
}
.testimonial-item_review {
    width: 100%;
    height: calc(72% - 4em);
    text-align: center;
    white-space: normal;
    overflow: hidden;
}
.testimonial-item_reviewer-name-wrapper {
    text-align: center;
    margin: 6px 0;
}
.testimonial-item_product {
    display: block;
    text-align: center;
    height: 50px;
    width: 50px;
    margin: auto;
}
.testimonial-item__product-image {
    display: block;
    height: 100%;
    width: 100%;
    margin: 0 auto;
}
.testimonial-item__review-content
{
    height:45px;
}

.testimonial-item__review-name {
    padding-bottom: 2px;
    line-height: 1;
    opacity: 0.6;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    
}
.testimonial-item__review-timestamp {
    font-style: italic;
    opacity: 0.35;
    line-height: 1;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    
}
.testimonial-slider .slider-prev:before, .testimonial-slider .slider-next:before {
    font-size: 50px;
    font-weight: 600;
}
.testimonial__inner {
    width: 80%;
    margin: auto;
    padding: 48px 0;
}
.testimonial-slider .slider-prev {
    left: 10px;
}
.testimonial-slider .slider-next {
    right: 10px;
}
@media only screen and (max-width: 768px)
{
    .testimonial__inner {
    width: 90%;
}

.testimonial-title {
    font-size: 18px;
}
.testimonial-star-outer > label:before {
    font-size: 0.8rem;
}
}
@media only screen and (max-width: 600px)
{
    .testimonial__inner {
    width: 100%;
}

.testimonial-title {
    font-size: 16px;
}

}

</style>
  <section>
    <div class="testimonial">
      <div class="container" style="width:100%; padding:0;">
       <div class="testimonial__inner">

       <div class="testimonial-title-and-link">
        <h2 class="testimonial-title">What our customers say</h2>
        <span class="jdgm-all-reviews-rating-wrapper" href="javascript:void(0)">
        <fieldset class="testimonial-star-outer text-center">
       
        <label class = "full fa active" for="star1" title="bad_1_stars"></label>
        <label class = "full fa active" for="star_2" title="average_2_stars"></label>
        <label class = "full fa active" for="star_3" title="good_3_stars"></label> 
        <label class = "full fa active" for="star_4" title="pretty_good_4_stars"></label> 
        <label class = "full fa" for="star_5" title="awesome_5_stars"></label>    
        </fieldset>
       
          <span style="display: block" class="testimonial-main-p" data-number-of-reviews="500">from latest reviews</span>
        </span>
      </div>

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

         <div class="testimonial-slider">

         @if(count($reviews) > 0)
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
           <div class="testimonial-slide">
             <div class="testimonial_box">
               <div class="testimonial_box-inner">
                 <div class="testimonial_box-top">

                 <div class="testimonial-item" style="font-size: 14px;"> 
                    <div class="testimonial-item_review"> 
                        <div class="testimonial-item__review-rating" tabindex="0" aria-label="5 stars" role="img"> 
                        <fieldset class="testimonial-star-outer text-center">
                            
                            <label class = "full fa {{$new_active_class1}}" for="star1" title="bad_1_stars "></label>
                            <label class = "full fa {{$new_active_class2}}" for="star_2" title="average_2_stars"></label>
                            <label class = "full fa {{$new_active_class3}}" for="star_3" title="good_3_stars"></label> 
                            <label class = "full fa {{$new_active_class4}}" for="star_4" title="pretty_good_4_stars"></label> 
                            <label class = "full fa {{$new_active_class5}}" for="star_5" title="awesome_5_stars"></label>    
                        </fieldset>
                        </div> 
                        <div class="testimonial-item__review-content">  <div class="testimonial-item__review-body" style="-webkit-line-clamp: 2;"><p>{{$rev->comments}}</p></div> </div> </div> <div class="testimonial-item_reviewer-name-wrapper"> <div class="testimonial-item__review-name"> {{$rev->customers_name}} </div> <div class="testimonial-item__review-timestamp">{{date('d/m/Y', strtotime($rev->created_at))}}</div> </div>
                         <a  href="{{url('/product-detail/'.$rev->products_slug)}}">  <div class="testimonial-item_product"> <img class="testimonial-item__product-image" src="{{$rev->image_path}}"></div>  <div class="testimonial-item__product-title"> {{$rev->products_name}}</div> </a> </div>


                   
                  
                
                 </div>
               </div>
             </div>
           </div>
            @endforeach
            @endif




   
         </div>
       </div>
      </div>
    </div>
</section>

<script>
    $('.testimonial-slider').slick({
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 1000,
        draggable: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<div class="slider-arrow slider-prev fa fa-angle-left"></div>',
    	nextArrow: '<div class="slider-arrow slider-next fa fa-angle-right"></div>',
        
        dots: false,
        responsive: [
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
              }
            },
            {
                breakpoint: 575,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                }
            }
        ]
    });
</script>