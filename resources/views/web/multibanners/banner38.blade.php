<style>
#banner_section_38
{
  padding-top:10px;
}
#banner_section_38 .banner_image_outer_38 {
    padding-top: 20px !important;
    padding-left: 20px !important;
}
#banner_section_38 .banner_38_main_outer {
    padding: 30px;
    border-radius: 20px;
    background-color: #e2183d;
    color: #fff;
    text-align: center;
    height:388px;
}
#banner_section_38 .p-banner-38 {
    margin-bottom: 12px;
    font-size: 14px;
    font-weight: 500;
}
#banner_section_38 .h3-banner-38 {
    font-weight: bold;
    letter-spacing: 1.3px;
    margin-bottom: 12px;
    font-size: 20px;
}
#banner_section_38 .p-banner-38 p {
   margin:0;
}
#banner_section_38 .btn-banner-38 {
    color: #e2183d;
    background-color: #fff;
    padding: 8px 14px;
    line-height: 1.42;
    text-decoration: none;
    text-align: center;
    white-space: normal;
    font-weight: 700 !important;
    display: inline-block;
    margin: 0;
    width: auto;
    min-width: 90px;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid transparent;
    border-radius: 3px;
}
#banner_section_38 .image_outer_38
{
    height:180px;
    margin-bottom:20px;
} 
#banner_section_38 .image_outer_38 img
{
   
    height: 100%;
    width: 100%;
}
#banner_section_38 .img_38_row
{
  margin:0;
  padding:0;
  margin-right:40px;
  margin-left:20px;
}
@media only screen and (max-width: 1150px)
{
  #banner_section_38 .image_outer_38
{
    height:125px;
} 
#banner_section_38 .banner_38_main_outer {
    height:352px;
}
}
@media only screen and (max-width: 769px)
{
  #banner_section_38 .p-banner-38 {
    margin-bottom: 8px;
    font-size: 12px;
    font-weight: 500;
}
#banner_section_38 .h3-banner-38 {
    margin-bottom: 8px;
    font-size: 16px;
}
  #banner_section_38 .image_outer_38
{
    height:352px;
} 
#banner_section_38 .banner_38_main_outer {
    height:532px;
}

  #banner_section_38
{
  padding-top:0px;
}
#banner_section_38 .banner_image_outer_38:first-of-type {
  padding-top:10px !important;
}
}
@media only screen and (max-width: 600px)
{
  #banner_section_38 .image_outer_38
{
    height:125px;
} 
#banner_section_38 .banner_38_main_outer {
    height:300px;
}
#banner_section_38 .banner_image_outer_38 {
  padding-top:10px !important;
  padding-left: 15px !important;
}
#banner_section_38 .img_38_row
{
  margin-right:15px;
  margin-left:0px;
}
#banner_section_38 .banner_38_main_outer {
    padding: 22px;
}


  
}
</style>
<div id="getmultibanner_38_loading"></div>

  <div id="getmultibanner_38_product"></div>

  <script>
    getmultibanner_38();
    function getmultibanner_38() {
      var type = '2'
      var content ='';

      content +='<section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibanner_38_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_38")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibanner_38_loading').html(' ');
              jQuery('#getmultibanner_38_product').html(res);
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