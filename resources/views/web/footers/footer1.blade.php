<!-- //footer style One -->
@include('web.footers.partials.modals') 
 @php
  $customer = auth()->guard('customer')->user();
@endphp
<footer id="footerOne"  class="footer-area footer-content footer-one footer-desktop d-none d-lg-block d-xl-block footer-mb-100">
  <div class="container">
    <div class="row">
        <div class="col-12 col-lg-4">
         
            <figure>
            <div class="logo_new_style_outer"> 
                  <a href="{{ URL::to('/')}}" class="logo" data-toggle="" data-placement="bottom" title="@lang('website.logo')">
                    @if($result['commonContent']['settings']['sitename_logo']=='name')
                    <?=stripslashes($result['commonContent']['settings']['website_name'])?>
                    @endif

                    @if($result['commonContent']['settings']['sitename_logo']=='logo')
                      <?php 
                      $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['footer_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 

                      ?>
                      @if($imagepath->path_type == 'aws')
                        <img class="img-fluid logo_new_style_inner" src="{{$result['commonContent']['settings']['footer_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                      @else
                        <img class="img-fluid logo_new_style_inner" src="{{asset('').$result['commonContent']['settings']['footer_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                      @endif
                    @endif

                  </a>
</div>
            </figure>
            <ul class="mail">
              <li>
                <a class="email-font common-hover" href="mailto:{{$result['commonContent']['setting'][3]->value}}" data-toggle="" data-placement="bottom" class="" title="@lang('website.mail')">
                <i class="fas fa-envelope"></i>{{$result['commonContent']['setting'][3]->value}}</a>
                </a>

              </li>
            </ul>
                <p>
                {{ $result['commonContent']['settings']['about_content'] }}
                </p>
            
                <ul class="socials">
                <li>
                  @if(!empty($result['commonContent']['setting'][50]->value))
                      <a href="{{$result['commonContent']['setting'][50]->value}}" class="fab fb fa-facebook-f" target="_blank"></a>
                  @else
                  <a href="{{$result['commonContent']['setting'][50]->value}}" class="fab fb fa-facebook-f"></a>
                  @endif
                </li> 
                <li>
                  @if(!empty($result['commonContent']['setting'][52]->value))
                      <a href="{{$result['commonContent']['setting'][52]->value}}"  class="fab tw fa-twitter" target="_blank"></a>
                  @else
                      <a href="#" class="fab tw fa-twitter" ></a>
                  @endif
                </li>

                <li>
                  @if(!empty($result['commonContent']['setting'][51]->value))
                      <a href="{{$result['commonContent']['setting'][51]->value}}" class="fab sgo fa-google" target="_blank" ></a>
                  @else
                      <a href="#"><i class="fab sgo fa-google" ></i></a>
                  @endif
                </li>

                <li>
                @if(!empty($result['commonContent']['setting'][53]->value))
                          <a href="{{$result['commonContent']['setting'][53]->value}}" class="fab sln fa-linkedin-in" target="_blank"></a>
                      @else
                          <a href="#" class="fab sln fa-linkedin-in"></a>
                      @endif
                </li>          
                </ul>
          </div>
          <div class="col-12 col-lg-2">
              <div class="single-footer">
                  <h5>                    
                    @lang('website.Quick Links')
                  </h5>
                </div>
              <div class="single-footer single-footer-left">
           
                <ul class="links-list pl-0">
                  <li> <a href="{{ URL::to('/')}}" data-toggle="" data-placement="left" title="@lang('website.Home')">@lang('website.Home')</a> </li>
                  <li> <a href="{{ URL::to('/shop')}}" data-toggle="" data-placement="left" title="@lang('website.Shop')">@lang('website.Shop')</a> </li>
                  <li> <a href="{{ URL::to('/orders')}}" data-toggle="" data-placement="left" title="@lang('website.Orders')">@lang('website.Orders')</a> </li>
                  <li> <a href="{{ URL::to('/viewcart')}}" data-toggle="" data-placement="left" title="@lang('website.Shopping Cart')">@lang('website.Shopping Cart')</a> </li>           
                  <li> <a href="{{ URL::to('/wishlist')}}" data-toggle="" data-placement="left" title="@lang('website.Wishlist')">@lang('website.Wishlist')</a> </li>   
                            
                </ul>
              </div>
        </div>
        <div class="col-12 col-lg-2">
            <div class="single-footer">
                <h5>                    
                    @lang('website.Personalization')
                </h5>
              </div>
    
          <ul class="links-list pl-0">
            @if(count($result['commonContent']['pages']))
              @foreach($result['commonContent']['pages'] as $page)
                  <li> <a href="{{ URL::to('/page?name='.$page->slug)}}" data-toggle="" data-placement="left" title="{{$page->name}}">{{$page->name}}</a> </li>
              @endforeach
            @endif
            <?php $zippage = DB::table('zippages')->where('status',1)->get();  ?>
            @if(count($zippage)>0)
              @foreach ($zippage as  $key=>$zip)
              <li> <a href="{{ URL::to($zip->link)}}" target="_blank" data-toggle="" data-placement="left" title="{{$zip->name}}">{{$zip->name}}</a> </li>
              @endforeach
            @endif
            
            <li> <a href="{{ URL::to('/contact')}}"  data-toggle="" data-placement="left" title="@lang('website.Contact Us')">@lang('website.Contact Us')</a> </li>

          </ul>
        </div>
      <div class="col-12 col-lg-4">
          <div class="single-footer">
              <h5>                  
                  @lang('website.Instagram Feed')
              </h5>
          </div>
          <div class="row">
          <div class="col-12">
        <div class="instagram-content" id="instagram-feed"> 

        <?php
    //     $client_id = '1579447569149917';
    //     $client_secret ='5e2d694bd0783b6013fbc6a0632a1987';
    //         $redirect_uri = 'https://grocery.platinum24.net';
    //     $code ='IGQVJYTW0yY3JjRk9tSF9sWmgySUVoeGRfUWpOOHdfRGgyOUFna3ZAEcjZAfZAjRkSnNBM1FzNHBab3pzSUprUkRXS0swUUtxWEFDVS1mZAURDVUpHZAVlucGJCMWtZAWldwX3hyWjBIdmxRZA0hxOG1qZATNvMgZDZD';
    
    //     $url = "https://api.instagram.com/oauth/access_token";
    //     $access_token_parameters = array(
    //         'client_id'                =>     $client_id,
    //         'client_secret'            =>     $client_secret,
    //         'grant_type'               =>     'authorization_code',
    //         'redirect_uri'             =>     $redirect_uri,
    //         'code'                     =>     $code
    //     );
    
    // $curl = curl_init($url);    // we init curl by passing the url
    //     curl_setopt($curl,CURLOPT_POST,true);   // to send a POST request
    //     curl_setopt($curl,CURLOPT_POSTFIELDS,$access_token_parameters);   // indicate the data to send
    //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   // to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
    //     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);   // to stop cURL from verifying the peer's certificate.
    //     $result = curl_exec($curl);   // to perform the curl session
    //     curl_close($curl);   // to close the curl session
    
    //      var_dump($result);

  

         ?>
          
          
            <div><i class="fa fa-spinner" aria-hidden="true" style="margin-right:10px;"></i> <span> Loading ...</span></div>
       
              </div>
          </div>

      
          </div>
      </div>
  </div>
  </div>
  <div class="container-fluid p-0">
    <div class="copyright-content">
        <div class="container">
          <div class="row align-items-center">
              <div class="col-12">
                <div class="footer-info">
                © @lang('website.Copy Rights') <a href="https://platinum24.net/" target="_blank"> Platinum24, Inc</a> . <a href="{{url('/page?name=refund-policy')}}">@lang('website.Privacy')</a>
                    &nbsp;•&nbsp;
                    <a href="{{url('/page?name=term-services')}}">@lang('website.Terms')</a>
                </div>
                  
              </div>
          </div>
        </div>
      </div>
  </div>


   @if($result['commonContent']['settings']['Loyalty']=='1')
  <button type="button" id="subscribe" class="btn btn-secondary fixedbutton" data-toggle="modal" style="border-top-left-radius: 5px;border-top-right-radius: 5px;" data-target="
  @if(auth()->guard('customer')->check() && $customer->phone_verified =='1')
  #loginmyModal
  @else
  #myModalLoyalty
  @endif
  ">@lang('website.Loyalty_Points')
    @if(auth()->guard('customer')->check() && $customer->phone_verified =='1')
    - {{ auth()->guard('customer')->user()->loyalty_points }} </button>
    @endif
  @endif
  
</footer>

<script src="{!! asset('web/js/jquery.instagramFeed.js') !!}"></script>
<script src="{!! asset('web/js/jquery.instagramFeed.min.js') !!}"></script>

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







