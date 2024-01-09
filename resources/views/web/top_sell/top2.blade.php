<style>
.content_loading {
  display: flex;
  justify-content: center;
  padding: 100px 0;
}
.top-selling-2-sec .product article .thumb {
    height: 218px;
}
  .content_loading .dot {
    width: 1rem;
    height: 1rem;
    margin: 2rem 0.3rem;
    background: #979fd0;
    border-radius: 50%;
    animation: 0.9s bounce infinite alternate;
  }
  .product-based-cat-2 .pbc-2-header {
    margin-bottom: 5px !important;
    display: flex;
    align-items: center;
}
.product-based-cat-2 .pbc-2-title {
    margin-bottom: 0;
    flex: 1 1 auto;
    font-size: 24px;
    font-weight: 500;
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


.btntop2 {
  color: #777;
  padding: 5px 10px 5px 10px;
  text-decoration: none;
  margin: 5px;
  display:inline-block;
  cursor:pointer;
  font-size:1rem;
  text-transform:uppercase;
}


.Cate{
  margin-bottom:10px;
}
.spacer {
  clear: both;
  height: 30px;
}

  </style>




<div id="gettopselling_loading"></div>

  <div id="gettopselling_product"></div>

  <script>
    getallproductBytopselling2();
    function getallproductBytopselling2() {
      var type = 'topselling'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Top Selling of the Weeks</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#gettopselling_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBytopselling2")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#gettopselling_loading').html(' ');
              jQuery('#gettopselling_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getquerytop2();
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

function getquerytop2(){

$(document).ready(function() {

  var $btns = $('.btntop2').click(function() {
    if (this.id == 'all') {
      $('#parenttop2 > div').fadeIn(450);
    } else {
      var $el = $('.' + this.id).fadeIn(450);
      $('#parenttop2 > div').not($el).hide();
    }
    $btns.removeClass('cateactive');
    $(this).addClass('cateactive');
  })
});

}


  </script>
