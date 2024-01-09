<style>
.instagram-carousel-js2 .slick-slide {
outline: none;
padding: 0 0px !important;
}
.instagram2 .heading2 {
    margin-bottom: 2.5rem;
}

.instagram2 .container {
  width: 1180px;
  max-width: 100%;
}
.instagram2 .heading2 .title {
    font-size: 1.55rem;
    margin-bottom: 0.8rem;
    letter-spacing: .01em;
    text-transform:uppercase;
}
.instagram2 .heading2 .title-desc {
    font-size: 0.9rem;
    font-weight:300 !important;
}


.instagram-feed-title {
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        text-align: center;
        background-color: #fff;
        border: 0.1rem solid #ebebeb;
        margin-bottom: 2rem;
        color: #333;
    }
    .instagram-feed-title p {
        margin-bottom: 0.5rem;
    }
    .instagram-feed-title a {
        text-transform: uppercase;
        font-weight: 400;
        letter-spacing: -.01em;
    }

    .instagram-feed {
        width: 100%;
        display: block;
        position: relative;
        background-color: #ccc;
        height:257px;
    }

    .instagram-feed img {
        max-width: none;
        width: 100%;    
    }

    .instagram-feed-content {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
        width: 100%;
        left: 0;
        top: 0;
        bottom: 0;
        color: #fff;
        font-weight: 400;
        font-size: 1.6rem;
        -webkit-transition: all .45s ease;
        transition: all .45s ease;
        opacity: 0;
        visibility: hidden;
    }

    .feed-col {
        display: initial;
        align-items: stretch;
        flex: 0 0 50%;
        max-width: 50%;
    }


    .instagram-feed:hover:after {
        opacity: 1;
        visibility: visible;
    }
.instagram-feed:after {
    content: "";
    display: block;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background-color: rgba(51,51,51,.4);
    -webkit-transition: all .4s ease;
    transition: all .4s ease;
    opacity: 0;
    visibility: hidden;
    z-index: 1;
}
.instagram-feed:hover .instagram-feed-content, .instagram-feed:hover:after {
    opacity: 1;
    visibility: visible;
}
.instagram-feed-content {
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
    width: 100%;
    left: 0;
    top: 0;
    bottom: 0;
    color: #fff !important;
    font-weight: 400;
    font-size: 16px;
    -webkit-transition: all .45s ease;
    transition: all .45s ease;
    opacity: 0;
    visibility: hidden;
}
.instagram-feed-content a+a {
    margin-left: 2rem;
}
.instagram-feed-content i {
    font-weight: 400;
    margin-right: 0.8rem;
}
    @media screen and (min-width: 992px){
        .feed-col {
            flex: 0 0 20%;
            max-width: 20%;
        }
    }
    @media screen and (max-width: 991px){
        .instagram-feed {
            width: 100%;
            display: block;
            position: relative;
            background-color: #ccc;
            height: 195px;
        }
    }
    @media screen and (min-width: 992px) and (max-width: 1100px){
        .instagram-feed {
            width: 100%;
            display: block;
            position: relative;
            background-color: #ccc;
            height: 255px;
        }
    }
</style>

<section class="blog-content instagram2">
	<!-- <div class="container"> 
        <div class="heading2 text-center">
            <h2 class="title title-lg">Follow Us On Instagram</h2>
            <p class="title-desc">Wanna share your style with us?</p>
        </div>
    </div> -->

        <?php 
            $client = new GuzzleHttp\Client();
            $access_token = $result['commonContent']['settings']['instagram_access_token'];
            $response = $client->request('GET', 'https://graph.instagram.com/me/media', [
                'query' => [
                    'fields' => 'id,media_type,media_url,thumbnail_url,permalink',
                    'access_token' => $access_token,
                ],
            ]);

            $body = json_decode($response->getBody()->getContents(), true);
            $mediaData = $body['data'];

        ?>
        <div class="instagram-carousel-js2">                    
            @foreach($mediaData as $key=>$media)
                <div class="slick">
                    <div class="feed-col">
                        <div class="instagram-feed">
                            <img src="{{$media['media_url']}}" alt="img">
                            <div class="instagram-feed-content">
                                <a style="color:#fff;font-weight:400 !important;" href="#"><i class="fa fa-heart-o"></i>691</a>
                                <a style="color:#fff;font-weight:400 !important;" href="#"><i class="fa fa-comments"></i>87</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
</section>

<script>
    jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.instagram-carousel-js2');

   
    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this),
            item = jQuery(this).data('item'),
            itemmobile = jQuery(this).data('itemmobile');
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: false,
          infinite: false,
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow: 5,
          slidesToScroll: 5,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3
            }
          }, {
            breakpoint: 768,
            settings: {
              slidesToShow:  3,
              slidesToScroll: 3
            }
            }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }]
        });
      });
    }

    ;
  })(jQuery);
});

</script>


<script>

  jQuery.ajax({
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        url: "{{url('/instagram_feed')}}",
        type: "POST",
			  //data: '&user_id={{ $result['commonContent']['settings']['instauserid']}}',
        success: function(data)
        {
          jQuery("#instagram-feed").html(data);
        }
			 
      });

</script>