<style>
.demo-33-banner-46-section {
    margin-bottom: 82px;
    margin-top: 20px;
}
.demo-33-banner-46-container
{
  padding-right: 10px !important;
  padding-left: 10px !important;
}
.demo-33-banner-46-row
{
  margin-right: -10px !important;
  margin-left: -10px !important;
  justify-content: center;
}
.demo-33-right-arrow-fill
{
    fill: #999;
}
.demo-33-banner-46-col
{
  padding-right: 10px !important;
  padding-left: 10px !important;
}
.demo-33-banner-46-content {
    position: absolute;
    bottom: 0px;
    left: 22%;
    padding-top: 4px;
    width: 325px;
    top: auto;
    bottom: -72px;
}
.demo-33-banner-46-icon {
    font-size: 14px;
    margin-left: 10px;
}
.demo-33-banner-46-btn:hover {
    border-bottom: solid 2px;
}
.demo-33-banner-46-btn {
    font-size: 14px;
    padding: 10px 0 !important;
    border-bottom: solid 2px transparent;
    font-weight: 600 !important;
}
.demo-33-banner-46-outer-con {
    position: relative;
    margin-bottom: 60px;
}
.demo-33-banner-46-image-outer
{
  height: 300px;
}
.demo-33-banner-46-image-outer img
{
  height: 100% !important;
}
.demo-33-banner-46-title {
    margin-bottom: 1px;
    font-size: 40px;
    line-height: 1;
    color: #222!important;
    font-weight: 400!important;
}
.demo-33-banner-46-p {
    font-size: 17px;
    color: #999;
    margin-bottom: 5px;
    font-weight: 400!important;
}
@media only screen and (max-width: 1150px)
{
 
.demo-33-banner-46-content {
    position: absolute;
    padding-top: 4px;
    width: 325px;
    top: 50%;
    bottom: auto;
    transform: translateY(-50%);
    left: 5%;
}
.demo-33-banner-46-title {
    font-size: 32px;
}
.demo-33-banner-46-p {
    font-size: 14px;
}
}
@media only screen and (max-width: 992px)
{
.demo-33-banner-46-outer-con {
    margin-bottom: 10px !important;
}
}
@media only screen and (max-width: 991px)
{
  .demo-33-banner-46-col:last-child {
  margin-top: 20px;
}
.demo-33-banner-46-section {
    margin-bottom: 0px;
}
}
@media only screen and (max-width: 600px)
{
  .demo-33-banner-46-col{
  margin-top: 20px;
}
.demo-33-banner-46-col:first-child {
  margin-top: 0px !important;
}
.demo-33-banner-46-outer-con {
    margin-bottom: 0px !important;
}


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


<div id="getmultibannertwo_46_loading"></div>

  <div id="getmultibannertwo_46_product"></div>

  <script>
    getmultibannertwo_46();
    function getmultibannertwo_46() {
      var type = '4'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibannertwo_46_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_46")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibannertwo_46_loading').html(' ');
              jQuery('#getmultibannertwo_46_product').html(res);
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
