<style>
#banner_section_37
{
  padding-top:10px;
}
#banner_section_37 .banner_image_outer_37 {
    padding-top: 20px !important;
    padding-left: 20px !important;
}
/* #banner_section_37 .banner_image_outer_37:after {
    content: "";
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1;
    background: linear-gradient(15deg,rgba(0,0,0,.6),transparent 40%);
} */
.promo-grid__content {
    align-self: flex-end;
    padding: 30px;
}
.promo-grid__content {
    flex: 0 1 auto;
    padding: 2em 2.5em;
    position: absolute;
    min-width: 200px;
    z-index: 4;
    bottom:0;
}
.promo-grid__text {
    color: #fff;
}
.promo-grid__content p:last-child {
    margin-bottom: 0;
    font-weight:600 !important;
}
#banner_section_37 .image_outer_37
{
    border-radius: 10px;
    height: 280px;
    position:relative;
} 
#banner_section_37 .image_outer_37 img
{
    border-radius: 20px;
    height: 100%;
    width: 100%;
}
#banner_section_37 .img_37_row
{
  margin:0;
  padding:0;
  margin-right:40px;
  margin-left:20px;
}
#banner_section_37 .image_outer_37:after {
    content: "";
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1;
    border-radius:20px;
    background: linear-gradient(15deg,rgba(0,0,0,.6),transparent 40%);
}
@media only screen and (max-width: 1150px)
{
  #banner_section_37 .image_outer_37
{
    height: 220px;
}
}
@media only screen and (max-width: 769px)
{
  .promo-grid__content {
    padding: 15px;
}
  #banner_section_37
{
  padding-top:0px;
}
#banner_section_37 .image_outer_37 img
{
   object-fit:cover;
}
.promo-grid__content p:last-child {
   font-size: 18px;
}
#banner_section_37 .img_37_row
{
  margin:0;
  padding:0;
  margin-right:20px;
  margin-left:0px;
}
#banner_section_37 .image_outer_37
{
    height: 180px;
}
#banner_section_37 .banner_image_outer_37:first-of-type {
  padding-top:10px !important;
}
}
@media only screen and (max-width: 600px)
{

#banner_section_37 .banner_image_outer_37 {
  padding-top:10px !important;
  padding-left: 15px !important;
}
#banner_section_37 .img_37_row
{
  margin-right:15px;
}


  
}
</style>
<div id="getmultibannertwo_37_loading"></div>

  <div id="getmultibannertwo_37_product"></div>

  <script>
    getmultibannertwo_37();
    function getmultibannertwo_37() {
      var type = '4'
      var content ='';

      content +='<section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibannertwo_37_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_37")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibannertwo_37_loading').html(' ');
              jQuery('#getmultibannertwo_37_product').html(res);
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