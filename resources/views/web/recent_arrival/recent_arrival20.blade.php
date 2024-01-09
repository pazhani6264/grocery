
<style>
   
   #getnewest_product .new-women .col-lg-6{
    display:inline-block;
    vertical-align:top;
   }
   .new-women {
    position: relative;
    padding-top: 5rem;
}
.new-women:before {
    position: absolute;
    content: "";
    left: 1rem;
    right: 1rem;
    height: 0.1rem;
    top: 0;
    background-color: #ebebeb;
}
   .new-women .products {
    padding-left: 0;
    padding-right: 4rem;
  }
  .new-women .banner {
    padding-left: 5rem;
}

.banner-lg .intro3 {
    position: absolute;
    left: 10rem;
    top: 2.5rem;
}

.banner-lg .intro3 .title h3 {
    color: #777;
}
.intro3 .title h3 {
    font-size: 0.9rem;
    font-weight: 300;
    letter-spacing: .1em;
    color: #fff;
    text-transform: uppercase;
}
.banner-lg .intro3 .content {
    margin-top: 2.3rem;
}
.banner-lg .intro3 .content h4 {
    font-size: 3rem;
    color: #222;
    text-indent: -0.2rem;
    margin-bottom: 0.6rem;
    letter-spacing: .01em;
    text-transform: uppercase;
    line-height:1;
}
.banner-lg .intro3 .action {
    margin-top: 5.5rem;
}


.banner-lg .intro3 .action a {
    font-weight: 400;
    color: #222;
    padding: 0.9rem 2rem;
    border: 0.1rem solid #c96;
}
.intro3 .action a {
    font-size: 0.9rem;
    font-weight: 300;
    letter-spacing: .1em;
    color: #fff;
    text-transform: uppercase;
    -webkit-transition: all .3s;
    transition: all .3s;
}

@media screen and (max-width: 992px){
  .new-women {
    position: relative;
    padding-top: 3rem;
  }
  .demo-23-pad-right
  {
    padding-left:10px !important;
  }
  .demo-23-pad-left
  {
    padding-right:10px !important;
  }
  .page-content-div {
      max-width: 100% !important;
      flex: 0 0 100%;
  }
  .new-women .banner {
    padding-left: 0rem;
    padding-right: 0rem;
  }
  .banner-lg .intro3 {
    position: absolute;
    left: 3rem !important;
    top: 2rem !important;
  }
  .new-women .products {
    padding-left: 0;
    padding-right: 0rem;
  }
  #getnewest_product .col-sm-6a{
    width: 50%;
  } 
}

@media screen and (max-width: 574px){
  .demo-23-pad-right
  {
    padding-right:10px !important;
  }

  .demo-23-pad-left
  {
    padding-left:10px !important;
  }

}
  </style>





<div id="getnewest_loading" ></div>

  <div id="getnewest_product"></div>

  <script>
    getallproductBynewest20();
    function getallproductBynewest20() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Category Section</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getnewest_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBynewest20")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getnewest_loading').html(' ');
              jQuery('#getnewest_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
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
