
<style>
  .demo-blog-molla
  {
    padding: 11px 30px;
    border: 1px solid #d7d7d7; 
    letter-spacing: 0px;
    font-weight: 400 !important;
    color: #333;
  }
  .demo-blog-molla:hover
  {
    border:solid 1px;
  }
.ra7:first-of-type {
    margin-top: 4rem !important;
}
.ra7 .pbc-2-outer-pad {
    padding: 0 15px;
}

.ra7 .product-molla-24 {
    margin-bottom: 0;
    margin-top: 5px;
}

.ra7 .col-lg-20 {
    padding: 0 10px;
    padding-right: 10px;
    padding-left: 10px;
}

.pbc-2-title{
  font-size:20px;
  font-weight:400 !important;
  letter-spacing:.1em;
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

.btntabrecent7 {
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
  height: 20px;
}

@media (max-width: 600px){
  .ra7 .col-6 {
      position: relative;
      width: 100%;
      padding-right: 10px !important;
      padding-left: 10px !important;
  }
}
  </style>




<div id="getnewest_loading" ></div>

  <div id="getnewest_product"></div>

  <script>
    getallproductBynewest7();
    function getallproductBynewest7() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Category Section</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getnewest_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBynewest7")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getnewest_loading').html(' ');
              jQuery('#getnewest_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getrecentarrival7();
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

function getrecentarrival7(){

  $(document).ready(function() {
    

    var $btns = $('.btntabrecent7').click(function() {
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
