<style>
 
 .slider-prev, .slider-next {
   
    z-index: 1;
}
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
   /* border: 1px solid;
    border-radius: 50%;
    padding: 8px; */
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
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-size:0.9rem;
    font-weight:600 !important;
    color:#333;
    letter-spacing:0;
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
    font-size:0.9rem;
    font-weight:300 !important;
    color:#777;
}
@media only screen and (max-width: 1150px)
{
.t-d-none
{
    display: none !important;
}
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


<div class="page-content-div ml-auto">

  <section>
    <div class="testimonial">
      <div class="container" style="width:100%; padding:0;">
       <div class="testimonial__inner cus-review2">

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
                        <a class="testimonial-item_product common-text" href="{{url('/product-detail/'.$rev->products_slug)}}">  <img class="testimonial-item__product-image" src="{{$rev->image_path}}"></a> 
                        <div class="testimonial-item__review-content">  <div class="testimonial-item__review-body" style="-webkit-line-clamp: 2;"><p style="font-size:18px;margin-bottom:0px">{{$rev->comments}}</p></div> </div> </div> <div class="testimonial-item_reviewer-name-wrapper"> 
                        <div style="color:#000" class="testimonial-item__review-name"> {{$rev->customers_name}} </div>
                        <div class="testimonial-item__review-name1">Customer</div>
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

</div>

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
        // prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="common-fill t-d-none fill-left-arrow slider-arrow slider-prev" width="20" height="20" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
    	// nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="common-fill t-d-none fill-right-arrow slider-arrow slider-next" width="20" height="20" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
        
        dots: false,
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