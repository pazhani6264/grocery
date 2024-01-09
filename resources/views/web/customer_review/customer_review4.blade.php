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
    font-size:20px;
    letter-spacing:.1em;
    font-weight:400 !important;
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
    height: 70px;
    width: 70px;
    margin: auto auto 2rem auto;
    border: 1px solid;
    border-radius: 50%;
    padding: 8px;
}
.testimonial-item__product-image {
    display: block;
    height: 100%;
    width: 100%;
    margin: 0 auto;
    border-radius:50%;
    
}
.testimonial-item__review-content
{
    margin-bottom:2.3rem;
    line-height: 2em;
}

.testimonial-item__review-name {
    padding-bottom: 2px;
    line-height: 1;
    opacity: 0.6;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-size:1.15rem;
    font-weight:600 !important;
    color:#333;
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
    width: 90%;
    margin: auto;
    padding: 70px 0 80px 0;
}
.testimonial-slider .slider-prev {
    left: 10px;
}
.testimonial-slider .slider-next {
    right: 10px;
}

.testimonial-item__product-title{
    font-size:1.15rem;
    font-weight:400 !important;
    letter-spacing:.1em;
    margin-bottom: 1rem;
}
.testimonial-item__review-name1{
    font-size:1rem;
    font-weight:300 !important;
    color:#333;
}

.demo-33-testimonial-section {
    padding-bottom: 112px;
    background-color: #f2f5fb;
}

.demo-33-testimonial-section  .slick-dots {
    bottom: -70px;
}
.demo-33-testimonial-title {
    font-size: 40px;
    font-weight: 400;
    color: #222;
    margin-bottom: 0;
}
.demo-33-testimonial-title-and-link
{
    padding: 72px 0 12px;
    margin-bottom: 14px;
}

.demo-33-testimonial-star-outer > label:before {
    font-size: 12px !important;
    margin-right: 5px;
    
}

.demo-33-testimonial-item__review-rating {
    margin-bottom: 22px;
}
.demo-33-testimonial-item {
    display: inline-block;
    height: 100%;
    vertical-align: middle;
    width: 100%;
    overflow: hidden;
}
.demo-33-testimonial-item__product-title {
    font-size: 20px;
    font-weight: 400 !important;
    letter-spacing: .1em;
    margin-bottom: 13px;
    line-height: 1;
}
.demo-33-testimonial-section p {
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 23px;
    max-width: 788px;
    font-size: 17px;
    line-height: 1.8;
    font-weight: 400!important;
    color: #333!important;
}


.demo-33-testimonial-item__review-name {
    font-size: 15px;
    color: #333!important;
    font-weight: 400;
    line-height: 1;
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

  <section class="demo-33-testimonial-section">
    <div class="testimonial">
      <div class="container-fluid p-0">
       <div class="estimonial__inner cus-review2">
        <div class="demo-33-testimonial-title-and-link">
            <h2 class="demo-33-testimonial-title">Customer Reviews</h2>
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

                 <div class="demo-33-testimonial-item" style="font-size: 14px;"> 
                    <div class="testimonial-item_review"> 

                    <div class="demo-33-testimonial-item__review-rating" tabindex="0" aria-label="5 stars" role="img"> 
                        <fieldset class="demo-33-testimonial-star-outer testimonial-star-outer text-center">
                            
                            <label class = "full fa {{$new_active_class1}}" for="star1" title="bad_1_stars "></label>
                            <label class = "full fa {{$new_active_class2}}" for="star_2" title="average_2_stars"></label>
                            <label class = "full fa {{$new_active_class3}}" for="star_3" title="good_3_stars"></label> 
                            <label class = "full fa {{$new_active_class4}}" for="star_4" title="pretty_good_4_stars"></label> 
                            <label class = "full fa {{$new_active_class5}}" for="star_5" title="awesome_5_stars"></label>    
                        </fieldset>
                        </div> 
                        <!-- <a class="testimonial-item_product common-text" href="{{url('/product-detail/'.$rev->products_slug)}}">  <img class="testimonial-item__product-image" src="{{$rev->image_path}}"></a>  -->
                        <div class="demo-33-testimonial-item__product-title">{{$rev->products_name}}</div> 
                        <div class="">  <div class="testimonial-item__review-body" style="-webkit-line-clamp: 2;"><p>{{$rev->comments}}</p></div> </div> </div> <div class="demo-33-testimonial-item_reviewer-name-wrapper"> 
                        <div class="demo-33-testimonial-item__review-name"> - {{$rev->customers_name}} </div>
                        <!-- <div class="testimonial-item__review-name1">Customer</div> -->
                    </div>
                </div>


                   
                  
                
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
        autoplay: false,
        autoplaySpeed: 3000,
        speed: 1000,
        draggable: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        prevArrow: '<div class="slider-arrow slider-prev fa fa-angle-left"></div>',
    	nextArrow: '<div class="slider-arrow slider-next fa fa-angle-right"></div>',
        
        dots: true,
        responsive: [
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 1,
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