

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
  .pro-blog5 {
    overflow: hidden;
  }

  .pro-blog5 .container{
    width: 1185px;
    max-width: 100%;
  }

.blog5{
-webkit-transition: -webkit-box-shadow .35s ease;
    transition: -webkit-box-shadow .35s ease;
    transition: box-shadow .35s ease;
    transition: box-shadow .35s ease,-webkit-box-shadow .35s ease;
    margin-bottom:50px;
}
.blog-molla {
    padding: 7px;
    width: 100%;
    background-color: #fafafa;
    border: 0.1rem solid #ebebeb;
    color: #000;
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
  
    .title_change_blog5{
  text-align:center !important;
  font-size:24px !important;
  font-weight:600 !important;
  letter-spacing: -.025em;
}
.blog5 .blog-detial {
  padding:20px 0px;
    margin: 0px 0px;
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

.blog5 .blog-detial .tag{
  color:#777;
  font-size:0.9rem;
  font-weight:300 !important;
  transition: all .3s ease;
  cursor:pointer;
}

@media only screen and (min-width: 993px) and (max-width: 1100px){

  .blog5 .blog-detial {
      padding: 20px 10px !important;
      margin: 0px 0px;
      text-align: center !important;
  }
}


@media only screen and (max-width: 991px){

  .pro-blog5 {
    margin-top:3rem;
  }
  .footerpayemnt-dark {
      float: none;
      margin: 0px auto;
  }
  .footer-copyright {
      margin-bottom: 0.5rem;
      text-align: center !important;
  }
  .blog-slick-dots .slick-dots {
    margin-top:0px !important;
  }
}
@media only screen and (max-width: 600px){

  #subscribe-1-main .theme-block {
      text-align: center !important;
  }
  #subscribe-1-main .theme-block1 {
      text-align: center !important;
  }
}
  </style>




<div id="getnewsevent_loading" ></div>

  <div id="getnewsevent_product"></div>

  <script>
    getallnewsevent5();
    function getallnewsevent5() {
      var type = 'blog'
      var content ='';

      content +='<section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2 style="text-transform:initial" class="title_change">From Our Blog</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getnewsevent_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallnewsevent5")}}',
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
}



  </script>