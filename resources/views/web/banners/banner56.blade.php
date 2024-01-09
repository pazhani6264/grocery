<style>
  #getbanner_56_product .col-padding{
    padding-left:10px !important;
    padding-right:10px !important;
  }
  #getbanner_56_product .banner-img-molla-56{
    
    padding-top: 50px;
  }

  .demo-56-banner-overlay:focus:after, .demo-56-banner-overlay:hover:after {
    visibility: visible;
    opacity: 1;
}

.demo-56-banner-overlay:after {
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
 
  #getbanner_56_product .banner-img-molla-56 .col-md-4{
    padding-left:10px;
    padding-right:10px;
   
  }
  #getbanner_56_product hr {
    margin:0;
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
    width: 100%;
}
  /* .banner-img-molla-56 .row{
    margin-left:-px;
    margin-right:10px;
  } */

@media only screen and (max-width: 768px) {
  #getbanner_56_product  .banners-content {
    padding-top: 0px !important; 
    
}
#getbanner_56_product .demo-19-m-h
  {
    height:260px !important;
  }
  #getbanner_56_product  .demo-19-banner-1 {
    font-size: 30px;
    color: #fff;
    font-weight: 700;
}
}
@media only screen and (max-width: 600px) {
  #getbanner_56_product .banner-img-molla-56{
   
  }
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

    #getbanner_56_product   .banner-subtitle {
    font-size: 1rem;
    font-weight: 400;
    color: #fcb842;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 0.3rem;
}
#getbanner_56_product .banner-price {
    font-size: 1rem;
    font-weight: 400;
    letter-spacing: -.01em;
    text-transform: uppercase;
    color: #fff;
    margin-bottom: 1.8rem;
}
#getbanner_56_product a.banner-link {
    font-size: 1rem;
    letter-spacing: -.01em;
    color: #333;
    background-color: #fcb842;
    text-transform: uppercase;
    padding: 0.4rem 1.55rem;
    border-radius: 5px;
    -webkit-transition: all .3s;
    transition: all .3s;
}
#getbanner_56_product .banner-content-right {
    display: inline-block;
    position: absolute;
    padding-top: 0.4rem;
    right: 2rem;
    top: 50%;
    z-index: 2;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    -ms-transform: translateY(-50%);
}
#getbanner_56_product .banner-content-left {
    display: inline-block;
    position: absolute;
    padding-top: 0.4rem;
    left: 2rem;
    top: 50%;
    z-index: 2;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    -ms-transform: translateY(-50%);
}
#getbanner_56_product a.banner-link:hover {
    text-decoration: none;
    color: #333;
    background-color: #fff;
}

#getbanner_56_product .banner-img-molla-31 hr {
    margin: 1.5rem auto 2rem auto;
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
    width:98%;
}

#getbanner_56_product .demo-19-banner-2-t2
{
  margin-bottom:20px !important;
}

#getbanner_56_product .demo-19-banner-2-t4 {
    font-size: 24px !important; 
    font-weight: 700 !important;
    color: #fff !important;
}
#getbanner_56_product .demo-19-banner-2-tn {
    font-size: 20px !important;
    color: #fff !important;
    margin-bottom: 40px !important;
}
#getbanner_56_product .demo-19-banner-2-tn1 {
    color: #333 !important;
    font-size: 28px !important;
    margin-bottom: 18px !important;
}
#getbanner_56_product .demo-19-banner-2-t1
{
    margin-bottom:0 !important;
}
#getbanner_56_product .demo-19-banner-content-right
{
  text-align:right;
}
#getbanner_56_product .demo-19-banner-t3{
    color: #fff !important;
    font-size: 18px !important;
}
  </style>
<div id="getbanner_56_loading" style="background:#fff;"></div>

  <div id="getbanner_56_product" style="background:#fff;"></div>

  <script>
    getbanner_56();
    function getbanner_56() {
      var type = '1'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getbanner_56_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_56")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getbanner_56_loading').html(' ');
              jQuery('#getbanner_56_product').html(res);
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