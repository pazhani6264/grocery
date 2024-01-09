
<style>
  .info-bg-13 {
    background-color: #fff;
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

    .info-boxes-contents .info-box .panel .block h4 {
      margin-bottom:5px !important;
    }

    .info-boxes-contents {
      padding: 1.7rem 15px 1.7rem 15px;
      border-bottom: 1px solid #ebebeb;
    }

    .info-boxes-contents .info-box .panel .block p {
      font-size: 1.15rem;
      font-weight:300 !important;
    }
  
  </style>




<div id="getinfobox_17_loading" ></div>

  <div id="getinfobox_17_product"></div>

  <script>
    getinfobox_17();
    function getinfobox_17() {
      var type = '1'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Shopping Info</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getinfobox_17_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getinfobox_17")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getinfobox_17_loading').html(' ');
              jQuery('#getinfobox_17_product').html(res);
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
