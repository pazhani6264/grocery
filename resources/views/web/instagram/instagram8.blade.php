<style>
.heading {
    margin-bottom: 2.6rem;
    margin-top: 4.5rem;
}
.instagram-feed img{
    width:100%;
    height:100%;
}
.instagram-store .banner-sm-div {
flex: 0 0 20%;
max-width: 20%;
}

.instagram-store .banner-lg {
flex: 0 0 40%;
max-width: 40%;
}

.heading .title {
    font-weight: 700;
    font-size: 2.45rem;
    letter-spacing: -.025em;
    display:inline;
}
.instagram-store .title {
    margin-bottom: 3.5rem;
   
}
.instagram-store .banner-sm-div {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding: 0;
}

.instagram-feed {
    margin-bottom: 0;
    background-color: transparent;
}
.instagram-feed {
    width: 100%;
    display: block;
    position: relative;
    background-color: #ccc;
    margin-bottom: 1rem;
}
.lazy-media {
    position: relative;
}
.instagram-feed:after {
    left: 0.5rem;
    top: 0.5rem;
    right: 0.5rem;
    bottom: 0.5rem;
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

.instagram-store .banner-sm-div {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding: 0;
}

.lazy-media:before {
    content: "";
    display: block;
    padding-top: 100%;
    width: 100%;
    background-color: #f4f4f4;
}
.instagram-feed:after {
    left: 0.5rem;
    top: 0.5rem;
    right: 0.5rem;
    bottom: 0.5rem;
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
    font-size: 1.15rem;
    -webkit-transition: all .45s ease;
    transition: all .45s ease;
    opacity: 0;
    visibility: hidden;
}
.instagram-feed-content i {
    font-weight: 400;
    margin-right: 0.8rem;
}
.instagram-feed:hover .instagram-feed-content, .instagram-feed:hover:after {
    opacity: 1;
    visibility: visible;
}
.instagram-store .row {
    margin-left:-5px;
    margin-right:-5px;
}
.instagram-feed-content a{
    margin-right:1rem;
}
.h-292{
    height:274px;
}

.h-520{
    height:550px;
}

.instagram-store{
    margin-bottom:3.2rem;
}



@media screen and (min-width: 700px) and (max-width:800px){

    .instagram-feed {
        flex: 0 0 100% !important;
        max-width: 100% !important;
    }
    .h-520{
        height:360px;
    }
    .banner-lg {
        flex: 0 0 40% !important;
        max-width: 40% !important;
    }
    .banner-sm-div {
        flex: 0 0 20% !important;
        max-width: 20% !important;
    }
}

@media screen and (max-width: 768px){

    .banners-content .instagram-store {
        padding-left: 10px !important;
        padding-right: 10px !important;
    }
    .instagram-feed {
        flex: 0 0 50%;
        max-width: 50%;
    }
    .h-292{
        height:180px;
    }
    .h-520{
    height:180px;
}

.instagram-store .banner-sm-div {
flex: 0 0 100%;
max-width: 100%;
}

    .instagram-store .banner-lg {
    order: 1;
}
}

</style>




<div class="container-fluid instagram-store text-center">
    <hr>
    <div class="heading"><h2 class="title">INSTAGRAM STORE</h2></div>
    <div class="row">
        <?php $instagrmData = DB::table('instagram')->get(); ?>
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
        <div class="col-sm-3 banner-sm-div">
            @foreach($mediaData as $key=>$media)
                @if($key == 0)
                <div class="instagram-feed h-292">
                    <img src="{{$media['media_url']}}" alt="img">
                    <div class="instagram-feed-content">
                        <a style="color:#fff;font-weight:400 !important;" href="#"><i class="fa fa-heart-o"></i>691</a>
                        <a style="color:#fff;font-weight:400 !important;" href="#"><i class="fa fa-comments"></i>87</a>
                    </div>
                </div>
                @endif
                @if($key == 1)
                    <div class="instagram-feed h-292">
                        <img src="{{$media['media_url']}}" alt="img">
                        <div class="instagram-feed-content">
                            <a style="color:#fff;font-weight:400 !important;" href="#"><i class="fa fa-heart-o"></i>691</a>
                            <a style="color:#fff;font-weight:400 !important;" href="#"><i class="fa fa-comments"></i>87</a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>


        <div class="col-sm-6 banner-lg instagram-feed">
            @foreach($mediaData as $key=>$media)
                @if($key == 2)
                
                        <figure class="h-520">
                            <span class=" lazy-load-image-background blur lazy-load-image-loaded" style="display: inline-block; height: auto; width: 100%;">
                                <img alt="banner" src="{{$media['media_url']}}" width="100%" height="auto">
                            </span>
                        </figure>
                        <div class="instagram-feed-content">
                            <a href="#"><i class="fa fa-heart-o"></i>280</a>
                            <a href="#"><i class="fa fa-comments"></i>22</a>
                        </div>
                @endif
            @endforeach
        </div>

        <div class="col-sm-2 banner-sm-div">
            @foreach($mediaData as $key=>$media)
                @if($key == 3)
                    <div class="instagram-feed h-292">
                        <img src="{{$media['media_url']}}" alt="img">
                        <div class="instagram-feed-content">
                            <a style="color:#fff;font-weight:400 !important;" href="#"><i class="fa fa-heart-o"></i>691</a>
                            <a style="color:#fff;font-weight:400 !important;" href="#"><i class="fa fa-comments"></i>87</a>
                        </div>
                    </div>
                @endif
                @if($key == 4)
                    <div class="instagram-feed h-292">
                        <img src="{{$media['media_url']}}" alt="img">
                        <div class="instagram-feed-content">
                            <a style="color:#fff;font-weight:400 !important;" href="#"><i class="fa fa-heart-o"></i>691</a>
                            <a style="color:#fff;font-weight:400 !important;" href="#"><i class="fa fa-comments"></i>87</a>
                        </div>
                    </div>
                @endif
            @endforeach
            </div>
            <div class="col-sm-2 banner-sm-div">
                @foreach($mediaData as $key=>$media)
                    @if($key == 5)
                        <div class="instagram-feed h-292">
                            <img src="{{$media['media_url']}}" alt="img">
                            <div class="instagram-feed-content">
                                <a style="color:#fff;font-weight:400 !important;" href="#"><i class="fa fa-heart-o"></i>691</a>
                                <a style="color:#fff;font-weight:400 !important;" href="#"><i class="fa fa-comments"></i>87</a>
                            </div>
                        </div>
                    @endif
                    @if($key == 6)
                        <div class="instagram-feed h-292">
                            <img src="{{$media['media_url']}}" alt="img">
                            <div class="instagram-feed-content">
                                <a style="color:#fff;font-weight:400 !important;" href="#"><i class="fa fa-heart-o"></i>691</a>
                                <a style="color:#fff;font-weight:400 !important;" href="#"><i class="fa fa-comments"></i>87</a>
                            </div>
                        </div>
                    @endif
                @endforeach
                </div>
            </div>
        </div>


<script>

  jQuery.ajax({
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        url: "{{url('/instagram_feed')}}",
        type: "POST",
			  data: '&user_id={{ $result['commonContent']['settings']['instauserid']}}',
        success: function(data)
        {
          jQuery("#instagram-feed").html(data);
        }
			 
      });

</script>