<style>
    .demo-34-whychooseus-banner-section {
      margin-top: 60px;
      padding: 80px 75px;
      background-position: 50%;
      background-size: contain;
      background-repeat: no-repeat;
      height: 540px;
      width:100%;
}
.demo-34-whychooseus-container
{
  padding-right: 10px;
  padding-left: 10px;
}
.demo-34-whychooseus-row {
    margin-left: -10px;
    margin-right: -10px;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}
.demo-34-whychooseus-justify-content-end {
    -ms-flex-pack: end!important;
    justify-content: flex-end!important;
}

.demo-34-whychooseus-banner-section .demo-34-whychooseus-banner-content {
    position: relative;
    left: 0;
    font-size: 10px;
}
.demo-34-whychooseus-banner-section .demo-34-whychooseus-banner-title {
    margin-bottom: 40px;
    font-size: 34px;
    color: #222;
}
.demo-34-whychooseus-banner-content-item {
    display: flex;
    justify-content: flex-start;
    margin-bottom: 30px;
}
.demo-34-whychooseus-icon {
    min-width: 50px;
    margin-right: 25px;
    text-align: center;
}
.demo-34-whychooseus-item-title {
    margin-bottom: 17px;
    font-size: 20px;
    color: #2f4787;
    font-weight: 600!important;
}
.demo-34-whychooseus-banner-section p {
    
    font-size: 15px;
    color: #666;
    line-height: 1.6;
}


@media screen and (min-width: 768px)
{
.demo-34-whychooseus-banner-content {
    left: 30px;
}
.demo-34-whychooseus-banner-content {
    display: inline-block;
    padding-top: 0.4rem;
    left: 20px;
    top: 50%;
    z-index: 2;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    -ms-transform: translateY(-50%);
}
}
@media screen and (min-width: 992px)
{
.demo-34-whychooseus-banner-content {
    left: 40px;
}
}
@media screen and (max-width: 600px)
{
.demo-34-whychooseus-banner-section {
    margin-top: 60px;
    padding-top: 40px !important;
    text-align:center;
   padding:0;
    background-position: 50%;
    background-size: cover;
    background-repeat: no-repeat;
    
}
.demo-34-whychooseus-icon {
    min-width: 20%;
    margin-right: 0;
    text-align: center;
    margin-bottom: 10px;
}
.demo-34-whychooseus-banner-content-item {
    display: block;
    justify-content: flex-start;
    margin-bottom: 30px;
}
}

</style>

<!-- //banner one -->
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

<div id="getwhychooseus_1_loading"></div>

  <div id="getwhychooseus_1_product"></div>

  <script>
  getwhychooseus_1();
  function getwhychooseus_1() {
    var type = '1';
    var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Why Choose Us</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getwhychooseus_1_loading').html(content);

    jQuery.ajax({
        url: '{{ URL::to("/getwhychooseus_1")}}',
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        data: 'type='+type,
          success: function (res) { 
            jQuery('#getwhychooseus_1_loading').html(' ');
            jQuery('#getwhychooseus_1_product').html(res);
           
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

 
