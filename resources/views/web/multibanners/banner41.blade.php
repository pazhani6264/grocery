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
    .btn-video {
      width: 70px;
      height: 70px;
      font-size: 18px;
    }
  }

  @media screen and (max-width: 768px){
    .video-banner-bg {
      padding-top: 4rem;
        padding-bottom: 4rem;
    }
    .video-banner-title>strong {
      font-size: 2.8rem;
    }
    .btn-video {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 70px;
    height: 70px;
    font-size: 18px;
    line-height: 1;
    background-color: #fff;
    border-radius: 50%;
    -webkit-box-shadow: 0 0 0 1rem hsl(0deg 0% 100% / 20%);
    box-shadow: 0 0 0 1rem hsl(0deg 0% 100% / 20%);
    -webkit-transition: all .35s ease;
    transition: all .35s ease;
}
    .video-banner-title {
      letter-spacing: -.025em;
      margin-bottom: 36px;
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



  .btn-video {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 70px;
    height: 70px;
    font-size: 18px;
    line-height: 1;
    background-color: #fff;
    border-radius: 50%;
    -webkit-box-shadow: 0 0 0 1.5rem hsl(0deg 0% 100% / 20%);
    box-shadow: 0 0 0 1rem hsl(0deg 0% 100% / 20%);
    -webkit-transition: all .35s ease;
    transition: all .35s ease;
    cursor:pointer;
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
    margin-bottom: 36px;
}
.video-banner-title span {
    margin-bottom: 3rem;
}
.video-banner-title>span {
    display: block;
    font-weight: 400;
    font-size: 2rem;
    letter-spacing: -.03em;
    margin-bottom: 1.6rem;
}

.video-banner-title>strong {
  font-size: 3.8rem;
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

<div id="getmultibanner_41_loading"></div>

  <div id="getmultibanner_41_product"></div>

  <script>
    getbanner_41();
    function getbanner_41() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#ggetmultibanner_41_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_41")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibanner_41_loading').html(' ');
              jQuery('#getmultibanner_41_product').html(res);
              getmultibanner41script();
              var imgEl = document.getElementsByTagName('img');
              for (var i=0; i<imgEl.length; i++) {
                  if(imgEl[i].getAttribute('data-src')) {
                    imgEl[i].setAttribute('src',imgEl[i].getAttribute('data-src'));
                    imgEl[i].removeAttribute('data-src'); //use only if you need to remove data-src attribute after setting src
                  }
              }
          
        },
        });


        function getmultibanner41script(){

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