<style>
  .demo-33-info-15-container
  {
     padding-left:10px !important;
     padding-right:10px !important;
  }
  .demo-33-info-15-container .info-boxes-contents {
    padding: 13px 15px 2rem 15px;
}
  .info-box-15-margin
  {
    margin-right: 20px;
  }
  .info-box-15-display
  {
    display: inline-block;
  }
  .info-box-15-mobile-img
{
    margin: auto;
    margin-bottom: 5px;
}
  .demo-33-info-box-15-title
  {
    color: #333;
    font-weight: 600;
    text-transform: initial;
    font-size: 15px;
    margin-bottom:0;
  }
  .demo-33-info-box-15-p
  {
    color: #999;
    font-size: 15px;
    line-height: 1.4;
    margin-bottom:0;
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

    @media screen and (max-width: 600px){
    .info-boxes-contents .info-box .mob-panel {
    display: flex;
    align-items: center;
    width: 100% !important;
    margin-bottom: 0px;
}
    }
  
  </style>




<div id="getinfobox_15_loading" ></div>

  <div id="getinfobox_15_product"></div>

  <script>
    getinfobox_15();
    function getinfobox_15() {
      var type = '15'
      var content ='';

      content +='<section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Shopping Info</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getinfobox_15_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getinfobox_15")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getinfobox_15_loading').html(' ');
              jQuery('#getinfobox_15_product').html(res);
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



