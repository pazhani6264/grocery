<style>
  .tabsec5{
    padding:3rem 0rem 0rem 0rem;
  }

  .tabsec5 .product-molla-29 {
    margin-bottom: 0;
    margin-top: 0px;
}
  .headet-tab{
    font-size:22px;
  }
  .tabsec5 .container{
    width: 1160px;
    max-width: 100%;
    padding-left: 10px;
    padding-right: 10px;
  }

  .pro-content .tabs-main a.nav-link3 {
    font-size: 13px !important;
    font-weight: 400 !important;
   
    padding: 0.9rem !important;
    margin-left: 1.5rem;
    text-transform: initial !important;
    letter-spacing: -.01em;
}
.pro-content .tabs-main a.nav-link3.active {
    color: #333 !important;
    border-bottom: 1px solid !important;
}

.pro-content .tabs-main a.nav-link3 {
    font-size: 1rem !important;
}

  .tab-carousel-js .slick-slide {
    margin: 0px 10px 0 0px !important;
}
.tab-5 .slick-slide {
    outline: none;
    padding: 10px !important;
}

.tab-5 .product-molla-25 {
    margin-bottom: 0;
    margin-top: 0px;
}

.product-molla .padd-10 {
    padding: 12px 1rem !important;
}
.pro-content .tabs-main a.nav-link1 {
    font-size: 1rem !important;
}
.pro-content .tabs-main a.nav-link1:hover {
    font-size: 1rem !important;
}
@media only screen and (max-width: 768px)
{
 .pm-0
 {
   padding: 12px;
 } 
 .tab-carousel-js .slick-slide {
    margin: 0px 5px !important;
}
.tabsec5{
    padding:2rem 0rem 0rem 0rem !important;
  }
    .tabsec5 .tabs-main a.nav-link1 {
      margin-left: 1.5rem;
    }
    .tab-content {
      padding: 20px 15px;
    }
    .tabsec5 .tab-content .col-6 {
      position: relative;
      width: 100%;
      padding-right: 10px !important;
      padding-left: 10px !important;
  }
}
@media only screen and (max-width: 420px)
{
  .product article .btn-all {
    height: 300px;
}

}
@media only screen and (max-width: 367px)
{
  .product article .btn-all {
    height: 300px;
}

}

</style>



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
  
    .title_change{
  text-align:<?php echo $result['commonContent']['settings']['title_alignment']; ?> !important;
  font-size:<?php echo $result['commonContent']['settings']['title_font'].'px'; ?> !important;
  font-weight:<?php if($result['commonContent']['settings']['title_style'] == 1){ echo 'Bold'; }else{ echo 'normal';}; ?>
}
  </style>




<div id="gettabcontent6_loading"></div>

  <div id="gettabcontent6_product"></div>

  @include('web.product-sections.collections')

  <script>
    getalltabcontent6();


    
    function getalltabcontent6() {
      var type = 'tab'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Currently Popular Items</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#gettabcontent6_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getalltabcontent6")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#gettabcontent6_loading').html(' ');
              jQuery('#gettabcontent6_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getquerytab6();
              
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

function getquerytab6(){
  $(document).ready(function() {

    $cu_id = $('.p24-tab-id-value').val();
    $('.p24-slider-cat-tab6').hide();
    $('#p24-slider-cat-tab6-'+$cu_id).show();

    $('.p24-tabs-nav-tab6').on('click', function (event) {
      event.preventDefault();
    
      $('.p24-tab-active-tab6').removeClass('p24-tab-active-tab6 active show');
      $(this).addClass('p24-tab-active-tab6 active show');
    
      var id = $(this).attr('id');
    
      $('.p24-slider-cat-tab6').hide();
      $('#p24-slider-cat-tab6-'+id).show();
    
    });
  });
}


  </script>