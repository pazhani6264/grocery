
<style>
  .cateactive19:hover {
    color: #fff !important;
}
.demo-19-recent-section hr{
  margin-top:3.6rem;
  margin-bottom:4rem;
}
/* .col-xl, .col-xl-auto, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-lg, .col-lg-auto, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-md, .col-md-auto, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-sm, .col-sm-auto, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col, .col-auto, .col-12, .col-11, .col-10, .col-9, .col-8, .col-7, .col-6, .col-5, .col-4, .col-3, .col-2, .col-1
{
  padding-left:10px;
  padding-right:10px;
} */
.pbc-2-title{
  font-size:34px;
  font-weight:700 !important;
}
.product-based-cat-2 .pbc-2-header {
margin-bottom: 10px;
display: flex;
align-items: center;
}

.title_change{
  text-align:<?php echo $result['commonContent']['settings']['title_alignment']; ?> !important;
  font-size:<?php echo $result['commonContent']['settings']['title_font'].'px'; ?> !important;
  font-weight:<?php if($result['commonContent']['settings']['title_style'] == 1){ echo 'Bold'; }else{ echo 'normal';}; ?>
}
.demo-19-recent-section{
  margin-bottom:2rem;
}

.demo-19-recent-section .btntab {
  color: #777;
  padding: 5px 10px 5px 10px;
  text-decoration: none;
  margin: 0 5px;
  display:inline-block;
  cursor:pointer;
  font-size:1rem;
  text-transform:uppercase;
}

.demo-19-recent-section .border-20 {
    border: 0rem solid #ebebeb;
    background: #fff;
    margin-top: 30px;
    padding-top: 0px !important;
}

.demo-19-recent-section  .product-molla-33 {
    margin-bottom: 0;
    margin-top: 0px;
}

.product-based-cat-2 .pbc-2-outer-pads {
    padding: 0 7px;
}


.spacer {
  clear: both;
  height: 20px;
}

@media only screen and (max-width: 600px){
  .product-based-cat-2 .pbc-2-title {
      font-size: 22px;
  }
  .demo-19-recent-section .container-fluid {
    padding-left: 15px;
    padding-right: 15px;
  }
}
  </style>




<div id="getnewest_loading" ></div>

  <div id="getnewest_product"></div>

  <script>
    getallproductBynewest19();
    function getallproductBynewest19() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Category Section</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getnewest_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBynewest19")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getnewest_loading').html(' ');
              jQuery('#getnewest_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getqueryrecent19();
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

function getqueryrecent19(){

  $(document).ready(function() {
    

    var $btns = $('.btntab').click(function() {
      if (this.id == 'all') {
        $('#parent > div').fadeIn(450);
      } else {
        var $el = $('.' + this.id).fadeIn(450);
        $('#parent > div').not($el).hide();
      }
      $btns.removeClass('cateactive19');
      $(this).addClass('cateactive19');
    })
  });

}




  </script>
