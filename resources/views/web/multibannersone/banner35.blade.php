<style>
#banner_section_35
{
  padding-top:10px;
}
#banner_section_35 .banner_image_outer_35 {
    padding-top: 20px !important;
    padding-left: 20px !important;
}
#banner_section_35 .image_outer_35
{
    border-radius: 10px;
} 
#banner_section_35 .image_outer_35 img
{
    border-radius: 20px;
    height: 100%;
    width: 100%;
}
#banner_section_35 .img_35_row
{
  margin:0;
  padding:0;
  margin-right:20px;
}
@media only screen and (max-width: 769px)
{
  #banner_section_35
{
  padding-top:0px;
}
#banner_section_35 .banner_image_outer_35:first-of-type {
  padding-top:10px !important;
}
}
@media only screen and (max-width: 600px)
{

#banner_section_35 .banner_image_outer_35 {
  padding-top:10px !important;
  padding-left: 10px !important;
}
#banner_section_35 .img_35_row
{
  margin-right:10px;
}
  
}
</style>
<div id="getmultibannerone_35_loading"></div>

  <div id="getmultibannerone_35_product"></div>

  <script>
    getmultibannerone_35();
    function getmultibannerone_35() {
      var type = '3'
      var content ='';

      content +='<section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibannerone_35_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_35")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibannerone_35_loading').html(' ');
              jQuery('#getmultibannerone_35_product').html(res);
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