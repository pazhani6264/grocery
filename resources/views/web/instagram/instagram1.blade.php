<style>

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
        margin-bottom: 2rem;
    }

    .instagram-feed img {
        max-width: none;
        width: 100%;    
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
        color: #fff;
        font-weight: 400;
        font-size: 1.6rem;
        -webkit-transition: all .45s ease;
        transition: all .45s ease;
        opacity: 0;
        visibility: hidden;
    }

    .feed-col {
        display: flex;
        align-items: stretch;
        padding-left: 0.7rem;
        padding-right: 0.7rem;
        flex: 0 0 50%;
        max-width: 50%;
    }

    .pt-5 {
        padding-top: 5rem!important;
    }

    .pb-1r {
        padding-bottom: 1rem!important;
    }

    @media screen and (min-width: 992px){
        .feed-col {
            flex: 0 0 20%;
            max-width: 20%;
        }
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

    .info-boxes-contents .info-box .panel .fas {
        margin: 0px 30px 0px 15px !important;
    }

    .info-boxes-contents .info-box .panel .block p {
        font-size: 1.1rem !important;
        font-weight:300 !important;
    }

.instagram1 .container {
  width: 1180px;
  max-width: 100%;
}

.instagram-feed-content a+a {
    margin-left: 1rem;
}
.instagram-feed-content i {
    font-weight: 400;
    margin-right: 0.8rem;
}
</style>

<section class="blog-content pt-5 pb-1r instagram1" style="background-color: rgb(250, 250, 250);">
	<div class="container"> 
	  <div class="row">
        <?php 
            $client = new GuzzleHttp\Client();
            $response = $client->request('GET', 'https://graph.instagram.com/me/media', [
                'query' => [
                    'fields' => 'id,media_type,media_url,thumbnail_url,permalink',
                    'access_token' => 'IGQWRQc0ZAUdGFaZAV9PZAkppbEg4eGpwc2pQajBJcGdvSXRWZAXMxazdrVUktb1dHM3ZA6clU4NnJ2dUJhQW1mNTZA2RW82am52RS1QdWtRamExWWhMOHlkb0czd0Y5TGJnZAmVqcXdtRWNPVTg4bGJsVnV5U3FVZAmQzdkEZD',
                    'limit' => 9,
                ],
            ]);

            $body = json_decode($response->getBody()->getContents(), true);
            $mediaData = $body['data'];

        ?>
            @foreach($mediaData as $key=>$media)
                @if($key == 0 || $key == 1)
                    <div class="feed-col">
                        <div class="instagram-feed">
                            <img src="{{$media['media_url']}}" alt="img" width="218" height="218">
                            <div class="instagram-feed-content">
                                <a style="color:#fff;font-weight:400 !important;font-size:1.1rem" href="#"><i class="fa fa-heart-o"></i>0</a>
                                <a style="color:#fff;font-weight:400 !important;font-size:1.1rem" href="#"><i class="fa fa-comments"></i>87</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            <div class="feed-col feed-col-title">
                <div class="instagram-feed-title">
                    <i class="fa fa-instagram"></i>
                    <p>@<?php echo $result['commonContent']['settings']['instauserid'];?><br>on instagram</p>
                    <a href="https://www.instagram.com/{{ $result['commonContent']['settings']['instauserid']}}">FOLLOW</a>
                </div>
            </div>

            @foreach($mediaData as $keys=>$media)
                @if($keys != 0 && $keys != 1)
                    <div class="feed-col">
                        <div class="instagram-feed">
                            <img src="{{$media['media_url']}}" alt="img" width="218" height="218">
                            <div class="instagram-feed-content">
                                <a style="color:#fff;font-weight:400 !important;font-size:1.1rem" href="#"><i class="fa fa-heart-o"></i>0</a>
                                <a style="color:#fff;font-weight:400 !important;font-size:1.1rem" href="#"><i class="fa fa-comments"></i>87</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>

    <?php 
        $shoppinginfo = DB::table('shopping_info')
        ->leftJoin('shopping_info_description','shopping_info_description.shopping_info_id','=','shopping_info.shopping_info_id')
        ->where('shopping_info_description.language_id',Session::get('language_id'))
        ->groupBY('shopping_info.shopping_info_id')
        ->get();
     ?>
    <div class="container">
        <div class="info-boxes-contents">
            <div class="row justify-content-center">
            @foreach(($shoppinginfo) as $info)
                @if($info->type==1)
                    <div class="col-12 col-md-6  col-sm-6 col-lg-4 pl-xl-0 mb-20px">
                    <div class="info-box first">
                    <div class="panel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 32.362 31.943" style="margin-right:20px;">
                <path id="free_shipping" d="M11.634,31.858a1,1,0,0,1-.6-.862l-.221-4.066a1.009,1.009,0,0,1-.223-.171l-5.1-5.207a1,1,0,0,1-.267-.509L.941,20.787a1,1,0,0,1-.633-1.72l5.207-4.994a1,1,0,0,1,.692-.278h4.262L20.084,1.532a1,1,0,0,1,.679-.376L31.253.007A1,1,0,0,1,32.36,1.073l-.715,9.863a1,1,0,0,1-.38.714L18.757,21.477V26.2a1,1,0,0,1-.362.77l-5.722,4.741a.99.99,0,0,1-1.039.147Zm1.292-2.953,3.831-3.174V23.174L15.287,24.2l-2.509,1.972ZM21.4,3.1,7.535,20.778l3.725,3.8,2.854-2L29.682,10.35l.6-8.224ZM3.344,18.927l2.778.165,2.666-3.3H6.609Zm-1.876,11.2a1,1,0,0,1-.2-1.1l2.539-5.8,1.832.8L4.1,27.526,7.732,26l.776,1.843-5.939,2.5a1,1,0,0,1-1.1-.22ZM20.542,9.2a2,2,0,1,1,2,2A2,2,0,0,1,20.542,9.2Z" transform="translate(0)" fill="#383838"/>
              </svg>
                    <div class="block">
                    <h4 class="title info-color-1">{{ $info->shopping_info_name }}</h4>
                    <p class="info-color-p-1">{{ $info->shopping_info_description }}</p>
                    </div>
                    </div>
                    </div>
                    </div>
                @endif
                @if($info->type==2)
                    <div class="col-12 col-md-6  col-sm-6 col-lg-4 pl-xl-0 mb-20px">
                    <div class="info-box">
                    <div class="panel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 42.597 42.619" style="margin-right:20px;">
                    <path id="Union_120" data-name="Union 120" d="M12.74,40.977A20.877,20.877,0,0,1,0,22.721H2.871A18.015,18.015,0,0,0,33.908,34.159l1.611-1.69h-6.95V29.606l9.591,0,.926,0a1.434,1.434,0,0,1,1.433,1.433V41.6H37.652V34.4l-1.721,1.792a20.882,20.882,0,0,1-6.736,4.7,20.911,20.911,0,0,1-16.456.089ZM41.749,20.72H38.88A18.017,18.017,0,0,0,7.841,9.282l-1.613,1.69h7.027v2.863H3.065l-.4,0A1.433,1.433,0,0,1,1.231,12.4V1.668H4.1l0,7.376L5.819,7.252a20.912,20.912,0,0,1,6.734-4.7,20.884,20.884,0,0,1,29.2,18.167h0Zm.846-1.8a21.822,21.822,0,0,0-4.01-10.085A21.678,21.678,0,0,1,42.6,18.916ZM23.679,0A21.629,21.629,0,0,1,33.764,4.01,21.826,21.826,0,0,0,23.679,0Z"/>
                  </svg>
                    <div class="block">
                    <h4 class="title info-color-1">{{ $info->shopping_info_name }}</h4>
                    <p class="info-color-p-1">{{ $info->shopping_info_description }}</p>
                    </div>
                    </div>
                    </div>
                    </div>
                @endif
                @if($info->type==3)
                    <div class="col-12 col-md-6  col-sm-6 col-lg-4 pl-xl-0 mb-20px">
                    <div class="info-box">
                    <div class="panel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 29.999 30.003" style="margin-right:20px;">
                <path id="Union_121" data-name="Union 121" d="M286.006-12728.779a14.9,14.9,0,0,1-4.392-10.607,14.9,14.9,0,0,1,4.392-10.6,14.905,14.905,0,0,1,10.608-4.4,14.911,14.911,0,0,1,10.608,4.4,14.9,14.9,0,0,1,4.392,10.6,14.9,14.9,0,0,1-4.392,10.607,14.911,14.911,0,0,1-10.608,4.4A14.905,14.905,0,0,1,286.006-12728.779Zm10.608,2.395a13,13,0,0,0,2-.154v-5.1a8,8,0,0,1-2,.253,8,8,0,0,1-2-.253v5.1A13,13,0,0,0,296.614-12726.385Zm-4-.63v-5.372h.129a8.061,8.061,0,0,1-3.128-3.132v.133h-5.369A13.064,13.064,0,0,0,292.613-12727.015Zm8-5.372v5.372a13.064,13.064,0,0,0,8.368-8.371h-5.369v-.133a8.061,8.061,0,0,1-3.129,3.132Zm-10-7a6,6,0,0,0,6,6,6,6,0,0,0,6-6,6,6,0,0,0-6-6A6,6,0,0,0,290.616-12739.387Zm18.844,2a13.056,13.056,0,0,0,.154-2,13.062,13.062,0,0,0-.153-2h-5.1a7.99,7.99,0,0,1,.252,2,7.983,7.983,0,0,1-.253,2Zm-20.591,0a7.983,7.983,0,0,1-.253-2,7.99,7.99,0,0,1,.252-2h-5.1a13.062,13.062,0,0,0-.153,2,13.052,13.052,0,0,0,.154,2Zm14.746-5.868v-.13h5.369a13.062,13.062,0,0,0-8.369-8.371v5.372h-.128A8.053,8.053,0,0,1,303.615-12743.255Zm-14-.13v.13a8.053,8.053,0,0,1,3.127-3.129h-.128v-5.372a13.062,13.062,0,0,0-8.369,8.371Zm9-3.748v-5.1a13.12,13.12,0,0,0-2-.153,13.12,13.12,0,0,0-2,.153v5.1a8,8,0,0,1,2-.253A8,8,0,0,1,298.615-12747.133Z" transform="translate(-281.615 12754.387)"/>
              </svg>
                    <div class="block">
                    <h4 class="title info-color-1">{{ $info->shopping_info_name }}</h4>
                    <p class="info-color-p-1">{{ $info->shopping_info_description }}</p>
                    </div>
                    </div>
                    </div>
                    </div>
                @endif
            @endforeach
            </div>
        </div>
    </div>
</section>


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