
<style>
.container {
  width: 1155px;
  max-width: 100%;
}
.stroke-color:hover
{
  stroke: #fff !important;
}
/* .col-xl, .col-xl-auto, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-lg, .col-lg-auto, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-md, .col-md-auto, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-sm, .col-sm-auto, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col, .col-auto, .col-12, .col-11, .col-10, .col-9, .col-8, .col-7, .col-6, .col-5, .col-4, .col-3, .col-2, .col-1
{
  padding-left:10px;
  padding-right:10px;
} */
.pbc-2-title{
  font-size:30px;
  font-weight:600 !important;
}
.product-based-cat-2 .pbc-2-header {
margin-bottom: 5px;
display: flex;
align-items: center;
}

.title_change{
  text-align:<?php echo $result['commonContent']['settings']['title_alignment']; ?> !important;
  font-size:<?php echo $result['commonContent']['settings']['title_font'].'px'; ?> !important;
  font-weight:<?php if($result['commonContent']['settings']['title_style'] == 1){ echo 'Bold'; }else{ echo 'normal';}; ?>
}

.btntabrecent4 {
  color: #777;
  padding: 5px 10px 5px 10px;
  text-decoration: none;
  margin: 5px;
  display:inline-block;
  cursor:pointer;
  font-size:1.1rem;
  text-transform:uppercase;
}


.Cate{
  margin-bottom:10px;
}
.recent4 .border-20 {
  margin-top: 15px;
}
.product-molla-22 article .content {
    height: 118px;
}

 .btn-more {
    min-width: 170px;
    border-color: #ebebeb !important;
}

.btn-more {
    padding-top: 0.85rem;
    padding-bottom: 0.85rem;
    min-width: 170px;
    text-transform: uppercase;
    font-weight:400 !important;
    font-size:1rem;
}
.btn-round {
    border-radius: 3rem;
}
.mt-1s{
  margin-top:1rem;
}
.ml-10e{
  margin-left:10px;
}

.newarrival-product4:before {
    content: "";
    position: absolute;
    left: 9.5rem;
    right: 9.5rem;
    height: 0.1rem;
    background-color: #ebebeb;
}


.newarrival-product4 .pbc-2-header{
  padding-top: 3.6rem;
}


@media screen and (max-width: 992px){

.recent4 .col-6 {
      position: relative;
      width: 100%;
      padding-right: 10px !important;
      padding-left: 10px !important;
    }
    .newarrival-product4:before {
      content: "";
      position: absolute;
      left: 1rem;
      right: 1rem;
      height: 0.1rem;
      background-color: #ebebeb;
    }
    .Cate {
      margin-bottom: 0px;
    }

    .mt-1s {
      margin-top: 3rem;
    }

  }

  </style>




<div id="getnewest_loading" ></div>

  <div id="getnewest_product"></div>

  <script>
    getallproductBynewest4();
    function getallproductBynewest4() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Category Section</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getnewest_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBynewest4")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getnewest_loading').html(' ');
              jQuery('#getnewest_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getqueryrecent4();
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

function getqueryrecent4(){

  $(document).ready(function() {
    

    var $btns = $('.btntabrecent4').click(function() {
      if (this.id == 'all') {
        $('#parent > div').fadeIn(450);
      } else {
        var $el = $('.' + this.id).fadeIn(450);
        $('#parent > div').not($el).hide();
      }
      $btns.removeClass('cateactive');
      $(this).addClass('cateactive');
    })
  });

}




  </script>
