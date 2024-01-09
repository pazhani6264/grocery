<style>
 #getmultibannertwo_48_product .demo-32-banner-50-btn.hover-menu-13:before {
    height: 2px;
}


#getmultibannertwo_48_product .demo-32-banner-50-btn {
    font-size: 14px;
    padding: 10px 0 !important;
}
#getmultibannertwo_48_product .demo-32-banner-50-btn {
    position: relative;
    font-weight: 600 !important;
}
#getmultibannertwo_48_product .demo-33-banner-46-section
{

  margin-top: 20px;
}
#getmultibannertwo_48_product .demo-33-banner-46-container
{
  padding-right: 10px !important;
  padding-left: 10px !important;
}
#getmultibannertwo_48_product .demo-33-banner-46-row
{
  margin-right: -10px !important;
  margin-left: -10px !important;
  justify-content: center;
}

#getmultibannertwo_48_product .demo-33-banner-46-col
{
  padding-right: 10px !important;
  padding-left: 10px !important;
}
#getmultibannertwo_48_product .demo-33-banner-46-content {
    position: absolute;
    width: 185px;
    top: 50%;
    z-index: 2;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    left: 50%;
    padding: 7px 0 0 10px;
}
#getmultibannertwo_48_product .demo-33-banner-46-icon {
    font-size: 14px;
    margin-left: 10px;
}
#getmultibannertwo_48_product .demo-33-banner-46-btn:hover {
    border-bottom: solid 2px;
}
#getmultibannertwo_48_product .demo-32-banner-1-banner-overlay:focus>a:after, #getmultibannertwo_48_product .demo-32-banner-1-banner-overlay:focus:after, .demo-32-banner-1-banner-overlay:hover>a:after, .demo-32-banner-1-banner-overlay:hover:after {
    visibility: visible;
    opacity: 1;
}
#getmultibannertwo_48_product .demo-32-banner-1-banner-overlay>a:after, #getmultibannertwo_48_product .demo-32-banner-1-banner-overlay:after {
    content: "";
    display: block;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background-color: rgba(51,51,51,.25);
    z-index: 1;
    opacity: 0;
    visibility: hidden;
    -webkit-transition: all .4s ease;
    transition: all .4s ease;
}

#getmultibannertwo_48_product .demo-33-banner-46-btn {
    font-size: 14px;
    padding: 10px 0 !important;
    border-bottom: solid 2px transparent;
}
#getmultibannertwo_48_product  .demo-33-banner-46-outer-con {
    position: relative;
    margin-bottom: 20px !important;
}
#getmultibannertwo_48_product .demo-33-banner-46-image-outer
{
  height: 300px;
}
#getmultibannertwo_48_product  .demo-33-banner-46-image-outer img
{
  height: 100% !important;
}
#getmultibannertwo_48_product  .demo-33-banner-46-title {
    margin-bottom: 13px;
    font-size: 12px;
    line-height: 1;
    color: #000 !important;
    font-weight: 500!important;
}
#getmultibannertwo_48_product .demo-33-banner-46-p1 {
    font-size: 20px;
    color: #000;
    margin-bottom: 5px;
    font-weight: 600!important;
    line-height: 1.2;
    letter-spacing: -1px;
}
#getmultibannertwo_48_product .demo-33-banner-46-p {
    font-size: 20px;
    color: #000;
    margin-bottom: 16px;
    font-weight: 600!important;
    line-height: 1.2;
    letter-spacing: -1px;
    background-color: #fdda05!important;
    display: inline-block;
}
@media only screen and (max-width: 1150px)
{
  #getmultibannertwo_48_product .demo-33-banner-46-content {
    width: 180px;
}

#getmultibannertwo_48_product .demo-33-banner-46-p {
    font-size: 22px;
}

#getmultibannertwo_48_product .demo-33-banner-46-btn {
    font-size: 10px;
}
#getmultibannertwo_48_product .demo-33-banner-46-icon {
    font-size: 10px;
}
#getmultibannertwo_48_product .demo-33-banner-46-image-outer {
    height: 215px; 
}
}
@media only screen and (max-width: 991px)
{

  #getmultibannertwo_48_product .demo-33-banner-46-col:last-child {
  margin-top: 0px;
}
  
}
@media only screen and (max-width: 600px)
{
  

}
  </style>
<!-- //banner 23 -->
<style>
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

  </style>

<div id="getmultibannertwo_49_loading"></div>

  <div id="getmultibannertwo_48_product"></div>

  <script>
    getmultibannertwo_49();
    function getmultibannertwo_49() {
      var type = '4'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibannertwo_49_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_49")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibannertwo_49_loading').html(' ');
              jQuery('#getmultibannertwo_48_product').html(res);
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
  </script>
