

<style>
    .blog-thumbnail{
  height:250px;
}
.slick-slide img {
  display: block;
  height: 100%;
}
.blog-thumbnail img{
  object-fit:cover;
  height:250px !important;
}
  .plr5px{
    padding-left:7px;
    padding-right:7px;
  }
  .blog16{
    margin:3.6rem 0 0rem 0;
  }
  .pro-blog3 {
    overflow: hidden;
    padding-bottom: 20px;
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
    padding: 18px 15px 18px 15px;
    text-align: center !important;
    background:#fff;
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

.read-more>a{
  visibility: hidden;
    opacity: 0;
    -webkit-transition: all .3s;
    transition: all .3s;
}

.blog6:hover .read-more>a{
  visibility: visible;
    opacity: 1;
}

.read-more:focus:after, .read-more:hover:after {
    opacity: 1;
    -webkit-transform: translateX(0);
    transform: translateX(0);
}

.read-more:focus, .read-more:hover {
    padding-right: 2.2rem;
    -webkit-box-shadow: 0 0px 0 0;
    box-shadow: 0 0px 0 0;
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
.blog6 .tag{
  font-size:0.9rem !important;
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
  border-top-left-radius: 0px;
    border-top-right-radius: 0px;
}
.slick-slide img{
  border-top-left-radius: 0px;
    border-top-right-radius: 0px;
}

.blog16 .blog-padding .slick-slide {
    padding: 0px 10px !important;
}

.section-title {
    margin-bottom: 2.2rem;
}
.section-title {
    margin-left: 2rem;
    margin-bottom: 2rem;
    display: flex;
    justify-content: space-between;
    background-color: #333;
    align-items: center;
}
.section-title .title {
    margin-bottom: 0;
    margin-left: -1.4rem;
    padding: 0.8rem 3.5rem;
    position: relative;
    font-size: 1.45rem;
    font-family: Roboto;
    font-weight: 700;
    letter-spacing: -.025rem;
    color: #333;
}
.section-title .title:before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    background-color: #fcb941;
    -webkit-transform: skewX(-16deg);
    transform: skewX(-16deg);
}
.section-title .title span {
    position: relative;
}
.section-title .link {
    padding: 1.1rem 3.5rem 1.1rem 4rem;
    font-size: 1rem;
    font-weight: 700 !important;
    letter-spacing: -.01rem;
    color: #fcb941;
    text-transform: uppercase;
}





@media (max-width: 992px){
  .title_change_blog8 {
    text-align: center !important;
    font-size: 24px !important;
    font-weight: 600 !important;
    margin-bottom: 0.5rem;
    letter-spacing: -.025em;
    display: inherit;
}

.banners-content .pro-blog3  .container {
    padding-left: 10px;
    padding-right: 10px;
  }
  .blog-slick-dots .slick-dots {
      position: absolute !important;
      bottom: -50px;
      text-align:center;
  }
  .blog-slick-dots .slick-dots {
      position: absolute !important;
      bottom: 0px;
      text-align:center;
  }
}

@media (max-width: 600px){
  .pro-blog3 .container-fluid {
      padding-left: 10px;
      padding-right: 10px;
  }
   .banners-content .pro-blog3  .container {
    padding-left: 10px;
    padding-right: 10px;
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
      bottom: 0px;
      text-align:center;
  }
  .title_change_blog8 {
    text-align: center !important;
    font-size: 24px !important;
    font-weight: 600 !important;
    margin-bottom: 0.5rem;
    letter-spacing: -.025em;
    display: inherit;
}
.blog16 .blog-padding .slick-slide {
    padding: 0px 0px !important;
}

}
  </style>




<div id="getnewsevent_loading" ></div>

  <div id="getnewsevent_product"></div>

  <script>
    getallnewsevent16();
    function getallnewsevent16() {
      var type = 'blog'
      var content ='';

      content +='<section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2 style="text-transform:initial" class="title_change">From Our Blog</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getnewsevent_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallnewsevent16")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getnewsevent_loading').html(' ');
              jQuery('#getnewsevent_product').html(res);
              getnewseventslick16();
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

function getnewseventslick16(){
jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.blog-carousel-js14');

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
          slidesToShow:  3,
          slidesToScroll:  3,
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