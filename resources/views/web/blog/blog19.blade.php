

<style>
    .blog-thumbnail{
  height:250px;
}
.blog-thumbnail img{
  object-fit:cover;
  height:250px !important;
}

.slick-slide img {
  display: block;
  height: 100%;
}
  .pro-blog3 {
    overflow: hidden;
    padding-bottom: 60px;
}
.pro-blog3 .row{
  margin-right: -12px;
    margin-left: -12px;
}
.content_loading {
  display: flex;
  justify-content: center;
  padding: 100px 0;
}

  .content_loading .dot {
    width: 1rem;
    height: 1rem;
    margin: 2rem 0.3rem;
    background: #979fd0;
    border-radius: 50%;
    animation: 0.9s bounce infinite alternate;
  }

  .content_loading .dot:nth-child(2) {
      animation-delay: 0.3s;
    }

    .content_loading .dot:nth-child(3) {
      animation-delay: 0.6s;
    }
  
    .title_change_blog8{
  text-align:left !important;
  font-size:24px !important;
  font-weight:600 !important;
  margin-bottom:2rem;
  letter-spacing:-.025em;
  display:inline-block;
}
.blog6 .blog-detial {
    padding: 20px 0px;
    text-align: left !important;
}
.title-link14 {
    color: #777;
    font-weight: 400;
    letter-spacing: -.01em;
    text-transform: uppercase;
    float:right;
    display:inline-block;
    font-size:1rem;
}

.read-more19 {
    display: inline-block;
    position: relative;
    font-weight: 400;
    letter-spacing: -.01em;
    padding-bottom: 0.1rem;
    -webkit-transition: all .3s ease;
    transition: all .3s ease;
    color:#777;
}
.read-more19:focus, .read-more19:hover {
    padding-right: 0.2rem;
    -webkit-box-shadow: 0 1px 0 0 #9ace69;
    box-shadow: 0 1px 0 0 #9ace69;
}
 
.blog6 .tag{
  font-size:1rem !important;
  font-weight:300 !important;
  color:#ccc;
}

.mtb30s {
    margin: 45px 0 0 0 !important;
}

.blog-molla-top5:hover {
  color:#445f84;
    background-color: #f5f6f9 !important;
}

.mtb40s {
    margin: 40px 0 0 0 !important;
}

.blog-slick-dots .slick-dots {
    position: absolute !important;
    bottom: 0px;
}

.blog-thumbnail{
  border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}
.slick-slide img{
  border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}

.blog14 .blog-padding .slick-slide {
    padding: 0px 10px !important;
}

.title-link14:focus, .title-link14:hover {
    -webkit-box-shadow: 0 1px 0 0;
    box-shadow: 0 1px 0 0;
}
.blog14 .col-lg-12{
  padding-right: 15px !important;
    padding-left: 15px !important;
}
@media (max-width: 992px){
  .title_change_blog8 {
    text-align: left !important;
    font-size: 24px !important;
    font-weight: 600 !important;
    margin-bottom: 1rem;
    letter-spacing: -.025em;
    display: inherit;
}
.title-link14 {
    color: #777;
    font-weight: 400;
    letter-spacing: -.01em;
    text-transform: uppercase;
    float: none;
    display: inherit;
    font-size: 1rem;
    text-align: center;
}
.banners-content .pro-blog3  .container {
    padding-left: 0px;
    padding-right: 0px;
  }
  .blog-slick-dots .slick-dots {
      position: absolute !important;
      bottom: -50px;
      text-align:center;
  }
}
@media screen and (min-width: 700px) and (max-width: 800px){

  .banners-content .general-product .container-fluid {
      padding-left: 0px;
      padding-right: 0px;
  }
  .blog14 .col-lg-12 {
    padding-right: 5px !important;
    padding-left: 5px !important;
}
}
@media (max-width: 600px){
  .pro-blog3 .container-fluid {
      padding-left: 10px;
      padding-right: 10px;
  }
   .banners-content .pro-blog3  .container {
    padding-left: 0px;
    padding-right: 0px;
  }
  .blog-padding .slick-slide {
    padding: 0px !important;
  }
  .title_change_blog6 {
    text-align: center !important;
    font-size: 26px !important;
    font-weight: 400 !important;
    margin-bottom: 2.5rem;
}
  .blog-slick-dots .slick-dots {
      position: absolute !important;
      bottom: -50px;
      text-align:center;
  }
  .title_change_blog8 {
    text-align: center !important;
    font-size: 24px !important;
    font-weight: 600 !important;
    margin-bottom: 1.5rem;
    letter-spacing: -.025em;
    display: inherit;
}
.title-link14 {
    color: #777;
    font-weight: 400;
    letter-spacing: -.01em;
    text-transform: uppercase;
    float: none;
    display: inherit;
    font-size: 1rem;
    text-align: center;
}
.blog14 .blog-padding .slick-slide {
    padding: 0px 0px !important;
}
}
  </style>




<div id="getnewsevent_loading" ></div>

  <div id="getnewsevent_product"></div>

  <script>
    getallnewsevent19();
    function getallnewsevent19() {
      var type = 'blog'
      var content ='';

      content +='<section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2 style="text-transform:initial" class="title_change">From Our Blog</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getnewsevent_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallnewsevent19")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getnewsevent_loading').html(' ');
              jQuery('#getnewsevent_product').html(res);
              getnewseventslick14();
              var imgEl = document.getElementsByTagName('img');
              for (var i=0; i<imgEl.length; i++) {
                  if(imgEl[i].getAttribute('data-src')) {
                    imgEl[i].setAttribute('src',imgEl[i].getAttribute('data-src'));
                    imgEl[i].removeAttribute('data-src'); //use only if you need to remove data-src attribute after setting src
                  }
              }
          
        },
        });
} 

function getnewseventslick14(){
jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.blog-carousel-js19');

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
          slidesToShow:  4,
          slidesToScroll:  4,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              dots: true,
              slidesToShow: 3,
              slidesToScroll: 3
            }
          },  {
            breakpoint: 992,
            settings: {
              dots: true,
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },{
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
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }]
        });
      });
    }

    ;
  })(jQuery);
}); // aboutus section
}



  </script>