<style>
 #getmultibannertwo_40_product .demo-2-banner-20-btn-new:hover
{
  background-color: #fff; 
  border: solid 1px #fff; 
}
#getmultibannertwo_40_product .demo-2-side-banner-content-outer
{
  position: relative;
}
#getmultibannertwo_40_product .demo-2-side-banner-content {
    position: absolute;
    width: 210px;
    top: 30px;
    z-index: 2;
    left: 20px;
    text-align: left;
}

#getmultibannertwo_40_product .demo-2-side-banner-20-title {
    color: #777;
    font-weight: 300;
    font-size: 14px;
    line-height: 1.2;
    letter-spacing: 0;
    margin-bottom: 13px;
    padding-left:7px;
}

#getmultibannertwo_40_product .demo-2-side-banner-20-p{
    color: #333;
    font-weight: 600;
    font-size: 18px;
    line-height: 1.2;
    margin-bottom: 0px;
    padding-left:7px;
}
#getmultibannertwo_40_product .demo-2-side-banner-20-p2{
    color: #333;
    font-weight: 300;
    font-size: 14px;
    margin:0;
    padding-left:7px;
   
}
#getmultibannertwo_40_product .demo-2-side-banner-20-btn-new
{
  font-size: 14px;
  font-weight: 400;
  display: inline-block;
  padding: 3px 7px;
  border: solid 0px transparent;
    border-radius: 30px;
}


#getmultibannertwo_40_product .demo-2-side-banner-20-btn-new:hover{
    border: solid 1px;
    border-radius: 30px;
    color: #fff !important;
}


#getmultibannertwo_40_product .banner-img-molla-40 .row{
  margin-right: -10px;
  margin-left: -10px;
}
#getmultibannertwo_40_product .banner-40-img{
    height:160px !important;
  }
  #getmultibannertwo_40_product .col40-padd{
  padding-left:10px !important;
  padding-right:10px !important;
 }
  </style>
<!-- //banner 31 -->
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

    
  @media only screen and (min-width: 700px) and (max-width: 800px){
    #getmultibannertwo_40_product .col40-padd {
        padding-left: 5px !important;
        padding-right: 5px !important;
        margin: 0px auto 20px auto;
    }
  }

  @media only screen and (max-width: 768px){
    #getmultibannertwo_40_product .col40-padd {
        padding-left: 5px !important;
        padding-right: 5px !important;
      }
      #getmultibannertwo_40_product .banner-img-molla-40 .group-banners .imagespace {
        margin-bottom: 0px !important;
      }
  }

  </style>


<div id="getmultibannertwo_40_loading"></div>

  <div id="getmultibannertwo_40_product"></div>

  <script>
    getbanner_40();
    function getbanner_40() {
      var type = '4'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibannertwo_40_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_40")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibannertwo_40_loading').html(' ');
              jQuery('#getmultibannertwo_40_product').html(res);
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