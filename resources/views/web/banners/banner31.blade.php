<style>
  .col-padding{
    padding-left:10px !important;
    padding-right:10px !important;
  }
 #getbanner_31_product .banner-31-img{
    height:220px !important;
  }
  #getbanner_31_product .banner-img-molla-31{
    background-color: rgb(250, 250, 250);
  }


  .banners-content #getbanner_31_product .container-fluid [class^=col] {
    padding-right: 10px;
    padding-left: 10px;
}

#getbanner_31_product .banner-content31 {
   
    flex-direction: column;
    padding-top: 0;
    top: 30px;
    right: 0;
    bottom: 0;
    position: absolute;
    text-align: left;
    width: 50%;
}
#getbanner_31_product .banner-content31 .banner-title a
{
   font-weight: 600 !important;
}
#getbanner_31_product .banner-subtitle {
    font-weight: 300;
    font-size: 0.9rem;
    letter-spacing: -.01em;
    margin-bottom: 0rem;
    
  }
  #getbanner_31_product .banner-subtitle a{
    color:#777 !important;
  }
  #getbanner_31_product  .banner-content31 .banner-title {
    flex-grow: 0.4;
    font-weight: 600;
    font-size: 1.45rem;
    line-height: 1.25;
    letter-spacing: -.025em;
    margin-bottom: 1.5rem;
}


#getbanner_31_product .banner-content31 .banner-link {
    align-self: end;
    width: auto;
    color: #333;
    font-weight: 600 !important;
    font-size: 0.9rem;
    line-height: 1.4;
    letter-spacing: -.01em;
    padding: 0.6rem 2rem;
    background-color: #fcb941;
    -webkit-transition: all .35s ease;
    transition: all .35s ease;
    border-radius: 0;
    border: none;
}
#getbanner_31_product .banner-content31 .banner-link:hover {
    color: #333;
    text-decoration: none!important;
    background-color: #fff;
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
    @media only screen and (max-width: 992px){


      #getbanner_31_product .banner-content31 {

width: 90%;
}
#getbanner_31_product .banner-img-molla-31 .container-fluid {
    padding-left: 15px !important;
    padding-right: 15px !important;
}
}
    @media only screen and (max-width: 767px){

    .banners-content #getbanner_31_product  .container-fluid {
    padding-left: 15px;
    padding-right: 15px;
}
#getbanner_31_product .banner-content31 {
    
    width: 90%;
}
    }

    @media only screen and (max-width: 992px){


      #getbanner_31_product .banner-content31 {

width: 75%;
}

}

  </style>

<div id="getbanner_31_loading"></div>

  <div id="getbanner_31_product"></div>

  <script>
    getbanner_31();
    function getbanner_31() {
      var type = '1'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getbanner_31_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_31")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getbanner_31_loading').html(' ');
              jQuery('#getbanner_31_product').html(res);
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