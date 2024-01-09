

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
.blog-molla:hover svg{
  fill:#fff;
}
.content_loading {
  display: flex;
  justify-content: center;
  padding: 100px 0;
}
.banner-image .over {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    overflow: hidden;
    transform: unset !important;
    transition: unset !important;
    opacity: 0;
    background-color: #dadadacf;
    cursor: pointer;
}
.color-fill-black-hover:hover
{
  fill:#fff !important;
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
  
    .title_change_blog6{
  text-align:center !important;
  font-size:20px !important;
  font-weight:400;
  letter-spacing: .1em;
  margin-bottom:1rem;
  text-transform: uppercase;
}
.blog6 .blog-detial {
    margin: 18px 0px;
    text-align: center !important;
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
.blog6 .tag{
  font-size:1rem !important;
  font-weight:300 !important;
  color:#ccc;
}

.mtb30s {
    margin: 45px 0 0 0 !important;
}

@media (max-width: 600px){
  .pro-blog3 .container-fluid {
      padding-left: 10px;
      padding-right: 10px;
  }
}
  </style>




<div id="getnewsevent_loading" ></div>

  <div id="getnewsevent_product"></div>

  <script>
    getallnewsevent6();
    function getallnewsevent6() {
      var type = 'blog'
      var content ='';

      content +='<section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2 style="text-transform:initial" class="title_change">From Our Blog</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getnewsevent_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallnewsevent6")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getnewsevent_loading').html(' ');
              jQuery('#getnewsevent_product').html(res);
              getnewseventslick();
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

function getnewseventslick(){
jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.blog-carousel-js');

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
              slidesToShow: 3,
              slidesToScroll: 3
            }
          }, {
            breakpoint: 768,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }, {
            breakpoint: 650,
            settings: {
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