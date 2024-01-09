
<style>
.top5 .container {
  width: 1160px;
  max-width: 100%;
}

.top5 .product-molla-25 {
    margin-bottom: 0;
    margin-top: 0px;
}

/* .col-xl, .col-xl-auto, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-lg, .col-lg-auto, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-md, .col-md-auto, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-sm, .col-sm-auto, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col, .col-auto, .col-12, .col-11, .col-10, .col-9, .col-8, .col-7, .col-6, .col-5, .col-4, .col-3, .col-2, .col-1
{
  padding-left:10px;
  padding-right:10px;
} */
.top5 .pbc-2-title{
  font-size:24px;
  font-weight:500 !important;
}
.product-based-cat-2 .pbc-2-header {
margin-bottom: 5px;
display: flex;
align-items: center;
}


.btntabtop5 {
  color: #777;
  padding: 5px 10px 5px 10px;
  text-decoration: none;
  margin: 5px;
  display:inline-block;
  cursor:pointer;
  font-size:1rem;
  text-transform:uppercase;
}

.spacer {
  clear: both;
  height: 20px;
}

.top5 .product-molla-27 {
    margin-bottom: 0;
    margin-top: 0px;
    border-bottom:.1rem solid #eee;
}

.top5 #parenttop5 [class*=col-] {
    border-right: 0.1rem solid #eee;
}

.top5 #parenttop5 [class*=col-]:nth-child(5n) {
    border-right-width: 0;
}

.top5 .col-lg-20 {
    flex: 0 0 20%;
    max-width: 20%;
    padding-left:0px !important;
    padding-right:0px !important;
}

.top5 .row {
    display: flex;
    flex-wrap: wrap;
    margin-right: 0px;
    margin-left: 0px;
}
.top5 .product-molla-27 article .thumb {
    height: 221px;
}

.top5active{
  border-bottom: 1px solid #333;
    color: #333 !important;
}

.blog-molla-top5:hover {
  color:#445f84;
    background-color: #f5f6f9 !important;
}

@media only screen and (max-width: 992px){
  .top5 .pbc-2-title {
      font-size: 26px;
  }
  .top5 .col-6 {
    position: relative;
    width: 100%;
    padding-right: 0px !important;
    padding-left: 0px !important;
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
  .top5 .pbc-2-outer-pad {
    padding: 0 10px;
}
.top5 #parenttop5 [class*=col-]:nth-child(2n) {
    border-right-width: 0;
}
.top5 .left-27 {
    width: 49%;
    display: inline-block;
    text-align: center;
    cursor: pointer;
    vertical-align: middle;
}
}


@media only screen and (min-width: 700px) and (max-width: 800px){

.top5 .col-lg-20 {
    flex: 0 0 33%;
    max-width: 33%;
    padding-left: 0px !important;
    padding-right: 0px !important;
}

}
  </style>




<div id="gettopselling_5_loading" ></div>

  <div id="gettopselling_5_product"></div>

  <script>
    getallproductBytopselling5();
    function getallproductBytopselling5() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Top Selling</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#gettopselling_5_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBytopselling5")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#gettopselling_5_loading').html(' ');
              jQuery('#gettopselling_5_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getquerytopsell5();
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

function getquerytopsell5(){

  $(document).ready(function() {
    

    var $btns = $('.btntabtop5').click(function() {
      if (this.id == 'all') {
        $('#parenttop5 > div').fadeIn(450);
      } else {
        var $el = $('.' + this.id).fadeIn(450);
        $('#parenttop5 > div').not($el).hide();
      }
      $btns.removeClass('top5active');
      $(this).addClass('top5active');
    })
  });

}




  </script>
