

  <style>
    .title_changes_act{
  text-align:center !important;
  font-size:24px !important;
  font-weight:600 !important;
  margin-bottom:1.8rem;
}
    .categories-content .cat-banner .categories-image .categories-title h3 {
    font-size: 0.8rem;
    margin-bottom: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
}


.cat-block .img-fluid {
max-width: 100%;
height: 100px;
object-fit: contain;
}

.categories-content7{
    margin-top:1rem !important;
}

.cat-block, .cat-block figure {
    display: flex;
    align-items: center;
}
.cat-block {
    width: 100%;
    flex-direction: column;
    justify-content: center;
    text-align: center;
    margin-bottom: 3rem;
    background-color: #fff;
    border-radius: 0.4rem;
    -webkit-transition: -webkit-box-shadow .35s ease;
    transition: -webkit-box-shadow .35s ease;
    transition: box-shadow .35s ease;
    transition: box-shadow .35s ease,-webkit-box-shadow .35s ease;
    min-height: 160px;
    padding-bottom: 1rem;
}

.cat-block figure {
    position: relative;
    min-height: 124px;
    margin: 0;
}

.cat-block figure span {
    position: relative;
}
.lazy-overlay {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background: #f4f4f4;
}
.lazy-load-image-background.lazy-load-image-loaded {
    display: inline!important;
    z-index: 2;
}
.cat-block:hover {
    -webkit-box-shadow: 1px 5px 10px rgb(0 0 0 / 8%);
    box-shadow: 1px 5px 10px rgb(0 0 0 / 8%);
}

.cat-block-title{
    font-size:1rem !important;
    font-weight:400 !important;
    margin-bottom:0;
    padding-top:0.5rem;
}

.categories-content7 .container{
    width: 1185px;
    max-width: 100%;
}
.categories-content7 .col-lg-2{
    padding-left:10px;
    padding-right:10px;
}
.categories-content7 .row{
    margin-left: -15px;
    margin-right: -15px;
}

@media only screen and (max-width: 992px){
  .title_changes_act {
    text-align: center !important;
    font-size: 22px !important;
    font-weight: 600 !important;
    margin-bottom: 1.8rem;
  }
  .categories-content7 .col-6 {
    position: relative;
    width: 100%;
    padding-right: 10px !important;
    padding-left: 10px !important;
  }
 
}

@media only screen and (max-width: 420px)
{
  .categories-content .cat-banner .categories-image .categories-title h3 {
    font-size: 0.8rem;
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
  </style>




<div id="getcategory7_loading"></div>

  <div id="getcategory7_product"></div>

  <script>
    getallproductBycategory7();
    function getallproductBycategory7() {
      var type = 'category_section'
      var content ='';

      content +='<section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Category Section</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getcategory7_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBycategory7")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getcategory7_loading').html(' ');
              jQuery('#getcategory7_product').html(res);
              //getquerycat1();
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
