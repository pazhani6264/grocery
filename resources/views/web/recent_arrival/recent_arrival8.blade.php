
<style>
.ra8 .container {
  width: 1160px;
  max-width: 100%;
}

.ra8 .product-molla-25 {
    margin-bottom: 0;
    margin-top: 0px;
}
.common-fill-recent
{
  fill: #333;
}
.common-fill-recent:hover
{
  fill: #fff;
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


.btntabrecent8 {
  color: #777;
  padding: 5px 10px 5px 10px;
  text-decoration: none;
  margin: 5px;
  display:inline-block;
  cursor:pointer;
  font-size:1rem;
  text-transform:uppercase;
}

/* .button-two span:after {
    position: absolute;
    opacity: 0;
    top: 0;
    left: 20px;
    transition: 0.5s;
    font-family: "Font Awesome 5 Free";
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    content: "<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;"><path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z" fill="#fff"></path></svg>" !important;
   
} */


.Cate{
  margin-bottom:10px;
}
.spacer {
  clear: both;
  height: 20px;
}

@media only screen and (max-width: 992px){
  .ra8 .pbc-2-title {
      font-size: 26px;
  }
  .ra8 .col-6 {
    position: relative;
    width: 100%;
    padding-right: 10px !important;
    padding-left: 10px !important;
  }
  .info-boxes-contents .info-box-2 {
    display: flex;
    position: relative;
    align-items: center;
    justify-content: center;
    padding-right: 0px;
    text-align: -webkit-center;
  }
  .info-boxes-contents {
      padding: 2rem 5px 2rem 5px;
  }
  .infobox5 .mb-20px {
    margin: 10px auto;
  }

}
  </style>




<div id="getnewest_loading" ></div>

  <div id="getnewest_product"></div>

  <script>
    getallproductBynewest8();
    function getallproductBynewest8() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Category Section</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getnewest_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBynewest8")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getnewest_loading').html(' ');
              jQuery('#getnewest_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getqueryrecent8();
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

function getqueryrecent8(){

  $(document).ready(function() {
    

    var $btns = $('.btntabrecent8').click(function() {
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
