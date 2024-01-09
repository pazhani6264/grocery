<style>

.demo-33-instagram-4-section
{
  margin-bottom: 82px;
}
.demo-33-instagram-4-container
{
  padding-right: 10px !important;
  padding-left: 10px !important;
}
.demo-33-instagram-4-row
{
  margin-right: -10px !important;
  margin-left: -10px !important;
  justify-content: center;
}

.demo-33-instagram-4-col
{
  padding-right: 10px !important;
  padding-left: 10px !important;
}

.demo-33-instagram-4-icon {
    font-size: 14px;
    margin-left: 10px;
}
.demo-33-instagram-4-btn:hover {
    border-bottom: solid 2px;
}
.demo-33-instagram-4-btn {
    font-size: 14px;
    padding: 10px 0 !important;
    border-bottom: 2px solid #222;
}
.demo-33-instagram-4-outer-con {
    position: relative;
}
.demo-33-instagram-4-banner-title {
    margin-bottom: 10px;
    font-size: 40px;
    line-height: 1;
    color: #222!important;
    font-weight: 400!important;
}
.demo-33-instagram-4-banner-p {
    color: #666;
    line-height: 1.6;
    font-size: 15px;
    margin-bottom: 18px;
    font-weight: 400!important;
}
.demo-33-instagram-4-banner {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    font-size: 1rem;
    background-color: #fff;
}
.demo-33-instagram-4-banner-content {
    position: relative;
    left: auto;
    top: auto;
    -webkit-transform: none;
    transform: none;
    max-width: 70%;
    width: 100%;
    margin-top: 22px;
    text-align: center;
}
.demo-33-instagram-4-banner-content-icon
{
    font-size: 40px;
}
/* .demo-33-instagram-4-img-container {
    width: 215px;
    height: 215px;
} */
.demo-33-instagram-4-img-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.demo-33-instagram-4-instagram-feed:hover .demo-33-instagram-4-feed-contain, .demo-33-instagram-4-instagram-feed:hover:after {
    opacity: 1;
    visibility: visible;
}

.demo-33-instagram-4-feed-contain {
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
.demo-33-instagram-4-instagram-feed:after {
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
.demo-33-instagram-4-feed-contain i {
    font-weight: 400;
    margin-right: 8px;
}
.demo-33-instagram-4-feed-contain a {
    color: #fff;
    font-size: 16px;
    margin-right: 20px;
}
@media only screen and (max-width: 1150px)
{
    .demo-33-instagram-4-img-container {
    width: 160px;
    height: 160px;
}
.demo-33-instagram-4-banner-content {
    max-width: 100%;
}

}

@media screen and (max-width: 991px)
{
.demo-33-instagram-order {
    order: -1;
    margin-bottom:30px !important;
}
.demo-33-instagram-4-img-container {
    width: 183px;
    height: 183px;
}
}

@media only screen and (max-width: 600px)
{
    .demo-33-instagram-4-banner-content-icon
{
    font-size: 36px;
}
.demo-33-instagram-4-banner-title {
    font-size: 36px;
}
.demo-33-instagram-4-banner-p {
    font-size: 14px;
}
.demo-33-instagram-4-img-container {
    width: 150px;
    height: 150px;
}
  
}



</style>



<section class="demo-33-instagram-4-section">
    <div class="demo-33-instagram-4-container container-fluid">
        <div class="demo-33-instagram-4-row row justify-content-center">
            <div class="col-lg-4 col-sm-6 mb-md-2 demo-33-instagram-4-col">
                <div class="row no-gutters">
                    <?php 
                        $client = new GuzzleHttp\Client();
                        $access_token = $result['commonContent']['settings']['instagram_access_token'];
                        $response = $client->request('GET', 'https://graph.instagram.com/me/media', [
                            'query' => [
                                'fields' => 'id,media_type,media_url,thumbnail_url,permalink',
                                'access_token' => $access_token,
                                'limit' => 8,
                            ],
                        ]);

                        $body = json_decode($response->getBody()->getContents(), true);
                        $mediaData = $body['data'];

                    ?>
                    @foreach($mediaData as $key=>$media)
                        @if($key == 0 || $key == 1 || $key == 2 || $key == 3)
                            <div class="col-6 p-0">
                                <figure class="demo-33-instagram-4-instagram-feed">
                                    <div class="demo-33-instagram-4-img-container">
                                        <img alt="instagram" src="{{$media['media_url']}}" width="215" height="215">
                                        <div class="demo-33-instagram-4-feed-contain">
                                            <a href="/react/molla/demo-33#"><i class="fa fa-heart-o" aria-hidden="true"></i></i>387</a>
                                            <a href="/react/molla/demo-33#"><i class="fa fa-comments-o" aria-hidden="true"></i>45</a>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>     
            <div class="col-lg-4 col-12 mb-2 demo-33-instagram-order demo-33-instagram-4-col">
                <div class="demo-33-instagram-4-banner">
                    <div class="demo-33-instagram-4-banner-content">
                        <a target="_blank" class="icon demo-33-instagram-4-banner-content-icon" href="https://www.instagram.com/{{ $result['commonContent']['settings']['instauserid']}}"><i class="fa fa-instagram"></i></a>
                        <h3 class="demo-33-instagram-4-banner-title">Shop Instagram</h3>
                        <p class="demo-33-instagram-4-banner-p">Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit.</p>
                        <a target="_blank" class="btn btn-link btn-link-primary demo-33-instagram-4-btn" href="https://www.instagram.com/{{ $result['commonContent']['settings']['instauserid']}}">FOLLOW US<i class="fa fa-angle-right demo-33-instagram-4-icon" aria-hidden="true"></i></i></a>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-sm-6 mb-md-2 demo-33-instagram-4-col">
                <div class="row no-gutters">
                    @foreach($mediaData as $key=>$media)
                        @if($key != 0 && $key != 1 && $key != 2 && $key != 3)
                            <div class="col-6 p-0">
                                <figure class="demo-33-instagram-4-instagram-feed">
                                    <div class="demo-33-instagram-4-img-container">
                                        <img alt="instagram" src="{{$media['media_url']}}" width="215" height="215">
                                        <div class="demo-33-instagram-4-feed-contain">
                                            <a href="/react/molla/demo-33#"><i class="fa fa-heart-o" aria-hidden="true"></i></i>387</a>
                                            <a href="/react/molla/demo-33#"><i class="fa fa-comments-o" aria-hidden="true"></i>45</a>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        @endif
                    @endforeach
                </div>
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