<style>

.info-5-style:hover{
  fill:#fff !important
}
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

.info-5-style:hover .info-color-5 {
    color: #fff !important;
}
  
.info-5-style:hover .info-color-5i {
    color: #fff !important;
}

.info-color-5{
  font-size:1.15rem !important;
  font-weight:600 !important;
}
.info-color-5i{
  font-size:1.7rem !important;
}

.info-color-p-5{
  font-size:0.9rem !important;
  font-weight:300 !important;
  color: #777 !important;
}
.info-5-style {
    border: 0.2rem solid #ebebeb;
    padding: 2.25rem 15px;
    width: 100% !important;
}
.info-5-style:hover {
    padding: 2.25rem 15px;
}
.infobox5 .container{
    width: 1190px;
    max-width: 100%;
    padding-left:10px;
    padding-right:10px;
}
  </style>




<div id="getinfobox_5_loading"  ></div>

  <div id="getinfobox_5_product"></div>

  <script>
    getinfobox_5();
    function getinfobox_5() {
      var type = '5'
      var content ='';

      content +='<section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Shopping Info</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getinfobox_5_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getinfobox_5")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getinfobox_5_loading').html(' ');
              jQuery('#getinfobox_5_product').html(res);
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



