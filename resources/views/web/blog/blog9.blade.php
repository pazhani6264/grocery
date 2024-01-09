

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
.demo-32-blog-btn {
    font-size: 14px;
    letter-spacing: 1px !important;
    font-weight: 600 !important;
    padding: 8px 0 !important;
}
.read-more:focus, .read-more:hover {
    padding-right: 2.2rem !important;
}
.read-more:focus:after, .read-more:hover:after {
    opacity: 1;
    -webkit-transform: translateX(0);
    transform: translateX(0);
}
.demo-32-blog-container
{
    padding-right: 10px !important;
    padding-left: 10px !important;
}
.demo-32-blog-section .blog-detial {
    padding: 0px;
    margin: 0px 0px;
    text-align: center !important;
    padding-top: 30px;
}
.demo-32-blog-section .slick-slide {
    padding: 0 10px !important;
}
.demo-32-blog-heading-outer{
    margin-bottom: 34px;
    text-align: center;
}
.demo-32-blog-title
{
  margin: 50px 0 3px;
  font-size: 28px;
  color: #222;
  font-weight: 600!important;
}
.demo-32-blog-p {
    font-size: 15px;
    color: #999;
    letter-spacing: 0;
}
.pro-blog5 {
  overflow: hidden;
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



.read-more {
  display: inline-block;
  position: relative;
  font-weight: 400;
  letter-spacing: -.01em;
  padding-bottom: 0.1rem;
  -webkit-transition: all .3s ease;
  transition: all .3s ease;
  color:#777;
  box-shadow: 0 1px 0 0;

}




.blog5 .blog-detial .tag{
color:#777;
font-size:15px;
font-weight:300 !important;
transition: all .3s ease;
}


.header-top-color-37s{
  color:#000;
}
.header-top-color-37s:hover{
    color: #fdda05 !important;
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
.blog-slick-dots .slick-dots {
    margin-top: 10px !important;
    position: relative !important;
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




<div id="getnewsevent_9_loading" ></div>

<div id="getnewsevent_9_product"></div>

<script>
  getallnewsevent9();
  function getallnewsevent9() {
    var type = 'blog'
    var content ='';

    content +='<section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2 style="text-transform:initial" class="title_change">From Our Blog</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
    jQuery('#getnewsevent_9_loading').html(content);
    
    jQuery.ajax({
        url: '{{ URL::to("/getallnewsevent9")}}',
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        data: 'type='+type,
          success: function (res) { 
            jQuery('#getnewsevent_9_loading').html(' ');
            jQuery('#getnewsevent_9_product').html(res);
            getnewsevent7_slick();
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

function getnewsevent7_slick(){
jQuery(document).ready(function () {
(function (jQuery) {
  var tabCarousel = jQuery('.newsevent-carousel-js-9');

  if (tabCarousel.length) {
    tabCarousel.each(function () {
      var thisCarousel = jQuery(this),
          item = jQuery(this).data('item'),
          itemmobile = jQuery(this).data('itemmobile');
      thisCarousel.slick({
        lazyLoad: 'progressive',
        dots: false,
        arrows: false,
        infinite: false,
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
            slidesToScroll: 1
          }
        }, {
          breakpoint: 992,
          settings: {
            dots: true,
            slidesToShow: 2,
            slidesToScroll: 1
          }
        }, {
          breakpoint: 768,
          settings: {
            dots: true,
            slidesToShow: 2,
            slidesToScroll: 1
          }
        }, {
          breakpoint: 650,
          settings: {
            dots: true,
            slidesToShow: itemmobile || 1,
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