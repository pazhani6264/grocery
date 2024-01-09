<style>

  .video-banner-bg {
    padding-top: 8.5rem;
    padding-bottom: 7.5rem;
}

  @media screen and (min-width: 992px){
    .video-banner-bg {
        padding-top: 13rem;
        padding-bottom: 13rem;
    }
    .btn-video53 {
      width: 7rem;
      height: 7rem;
      font-size: 1.8rem;
    }
  }



  @media screen and (max-width: 768px){
    .video-banner-bg {
        padding-top: 4rem;
        padding-bottom: 4rem;
    }
    .video-banner-title>strong {
      font-size: 2.85rem !important;
    }
    .btn-video53 {
      display: inline-flex;
      justify-content: center;
      align-items: center;
      width: 4rem;
      height: 4rem;
      font-size: 1.6rem;
      line-height: 1;
      background-color: #fff;
      border-radius: 50%;
      -webkit-box-shadow: 0 0 0 1.5rem hsl(0deg 0% 100% / 20%);
      box-shadow: 0 0 0 1.5rem hsl(0deg 0% 100% / 20%);
      -webkit-transition: all .35s ease;
      transition: all .35s ease;
    }
    .video-banner-title {
      letter-spacing: -.025em;
      margin-bottom: 3.6rem;
    }
    .video-banner-title>span {
      margin-bottom: 3.4rem;
    }
    .banner-img-molla-22 .row{
      margin-left: -10px;
      margin-right: -10px;
    }
    .col-padding {
      padding-left: 5px !important;
      padding-right: 5px !important;
    }

  }



.btn-video53 {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 5rem;
    height: 5rem;
    font-size: 1.3rem;
    line-height: 1;
    background-color: #fff;
    border-radius: 50%;
    -webkit-box-shadow: 0 0 0 1rem hsl(0deg 0% 100% / 10%);
    box-shadow: 0 0 0 1rem hsl(0deg 0% 100% / 10%);
    -webkit-transition: all .35s ease;
    transition: all .35s ease;
}

  .css-1pcoa0j {
    animation-duration: 1000ms;
    animation-timing-function: ease;
    animation-delay: 200ms;
    animation-name: animation-6oza6e;
    animation-direction: normal;
    animation-fill-mode: both;
    animation-iteration-count: 1;
}

.video-banner-title {
    letter-spacing: -.025em;
    margin-bottom: 1.6rem;
}
.video-banner-title span {
    margin-bottom: 3rem;
}
.video-banner-title>span {
    display: block;
    font-weight: 400;
    font-size: 1.15rem;
    letter-spacing: -.03em;
    margin-bottom: 1.3rem;
}

.video-banner-title>strong {
  font-size: 3.55rem;
}




.youtube-video .modal-dialog {
    max-width: 1050px;
    margin: 1.75rem auto;
}

.youtube-video .modal-content{
  background:transparent;
  border:0px solid;
}
.youtube-video .modal-body{
  padding:0;
}
.youtube-video #close-video{
    position: absolute;
    right: -10px;
    color: #fff;
    top: 8px;
}


.youtube-video iframe {
    width: 100% !important;
    height: 500px !important;
}
  </style>

<div id="getbanner_53_loading"></div>

  <div id="getbanner_53_product"></div>

  <script>
    getbanner_53();
    function getbanner_53() {
      var type = '1'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getbanner_53_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_53")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getbanner_53_loading').html(' ');
              jQuery('#getbanner_53_product').html(res);
              getbanner41script();
              var imgEl = document.getElementsByTagName('img');
              for (var i=0; i<imgEl.length; i++) {
                  if(imgEl[i].getAttribute('data-src')) {
                    imgEl[i].setAttribute('src',imgEl[i].getAttribute('data-src'));
                    imgEl[i].removeAttribute('data-src'); //use only if you need to remove data-src attribute after setting src
                  }
              }
          
        },
        });


        function getbanner41script(){

          $('.play-button').click(function(e){
              var iframeEl = $('<iframe>', { src: $(this).data('url') });
              $('#youtubevideo').attr('src', $(this).data('url'));
          })

          $('#close-video').click(function(e){
              $('#youtubevideo').attr('src', '');
          }); 

          $(document).on('hidden.bs.modal','#myModal', function () {
              $('#youtubevideo').attr('src', '');
          }); 
        } 

} 



  </script>