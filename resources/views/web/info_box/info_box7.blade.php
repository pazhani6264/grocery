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
  .info-boxes-contents .block{
    padding-right:48px;
  }
  .info-boxes-contents .info-box .panel .fas {
    font-size: 35px;
    margin-bottom: 0;
    text-align: center;
    align-self: center;
    margin: 0px 20px;
}

@media screen and (max-width: 992px){

.info-box-border-right {
    border-right: 0rem solid #ccc;
}
}
  </style>




<div id="getinfobox_7_loading" ></div>

  <div id="getinfobox_7_product"></div>

  <script>
    getinfobox_7();
    function getinfobox_7() {
      var type = '7'
      var content ='';

      content +='<section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Shopping Info</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getinfobox_7_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getinfobox_7")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getinfobox_7_loading').html(' ');
              jQuery('#getinfobox_7_product').html(res);
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

