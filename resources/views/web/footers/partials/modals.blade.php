 <!-- The Modal -->
 <div class="modal fade modalloyal" id="myModalLoyalty" style="z-index: 9999999;background: rgba(0, 0, 0, 0.50);">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header text-center common-bg" id="loyalty-desktop-header">
          <h4 class="modal-title">Introducing Loyalty Points</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-header common-bg" id="loyalty-mobile-header">
        <a class="mobile-close-button" data-dismiss="modal"><i class="fa fa-chevron-left" aria-hidden="true" style="margin-right:2px"></i> Return to store</a>
          
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <div class="popup-main">
                <div class="popup-main-left border">
                    <div class="popup-item">
                        <div class="popup-title"><span class="tb">Earn points </span> <span class="title1">when you complete activities</span></div>
                    </div>
                    @php
                       $items = DB::table('earn_points_settings')
                       ->leftJoin('image_categories', 'earn_points_settings.image', '=', 'image_categories.image_id')
                       ->leftJoin('earn_points_description', 'earn_points_description.earn_points_id', '=', 'earn_points_settings.id')
                        ->select('earn_points_settings.*', 'image_categories.path as image_path','image_categories.path_type as image_path_type', 'earn_points_description.earn_points_title', 'earn_points_description.earn_points_description')
                        ->where('earn_points_description.language_id', '=', Session::get('language_id'))
                        ->where('earn_points_settings.status', 1)
                        ->groupBy('earn_points_settings.id')
                         ->get();

                        $redeem = DB::table('redeem_points_settings')
                       ->leftJoin('image_categories', 'redeem_points_settings.image', '=', 'image_categories.image_id')
                       ->leftJoin('redeem_points_description', 'redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
                        ->select('redeem_points_settings.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type','redeem_points_description.redeem_points_title', 'redeem_points_description.redeem_points_description')
                        ->where('redeem_points_description.language_id', '=', Session::get('language_id'))
                        ->where('redeem_points_settings.status', 1)
                        ->groupBy('redeem_points_settings.id')
                         ->get();

                    @endphp
                    @if(count($items)>0)
                    @foreach ($items as $key=>$jesitems)
                    <div class="popup-item">
                     
                        <div class="popup-item-left">
                          @if($jesitems->image_path_type =='local')
                            
                          <img src="{{asset('').$jesitems->image_path}}" alt="" style="height: 100%;width: 100%;">
                          
                            @else
                            <img src="{{$jesitems->image_path}}" alt="" style="height: 100%;width: 100%;">
                            @endif
                        </div>
                        <div class="popup-item-right">
                            <div class="popup-titles">{{ $jesitems->earn_points_title}}</div>
                            @if($jesitems->no_rm =='0')
                             <p>{{$jesitems->points}} points</p>
                            @else
                             <p>{{$jesitems->points}} points per RM{{$jesitems->no_rm}}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="popup-main-left">
                    <div class="popup-item">
                        <div class="popup-title"><span class="tb">Redeem points</span> <span class="title1">for rewards from {{ $result['commonContent']['settings']['app_name'] }}</span></div>
                    </div>
                    @if(count($redeem)>0)
                    @foreach ($redeem as $key=>$jesredeem)
                    <div class="popup-item">
                        <div class="popup-item-left">
                        @if($jesredeem->image_path_type =='aws')
                        <img src="{{$jesredeem->image_path}}" alt="" style="height: 100%;width: 100%;">
                            @else
                            <img src="{{asset('').$jesredeem->image_path}}" alt="" style="height: 100%;width: 100%;">
                            @endif
                        </div>
                        <div class="popup-item-right">
                            <div class="popup-titles">{{ $jesredeem->redeem_points_title}}</div>
                            @if($jesredeem->no_rm =='0')
                             <p>{{$jesredeem->points}} points</p>
                            @else
                             <p>{{$jesredeem->points}} points per RM{{$jesredeem->no_rm}}</p>
                            @endif
                        </div>
                    </div>
                     @endforeach
                    @endif

                </div>
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <?php 
            $customer = auth()->guard('customer')->user();
          if(auth()->guard('customer')->check() && $customer->phone_verified =='1'){ ?>
          <a href="{{ URL::to('/point-transaction')}}" type="button" class="btn btn-success">My Points</a>
          <?php }else{ ?>
            <p class="footer-para">Log in or sign up to {{ $result['commonContent']['settings']['app_name'] }} to earn rewards today</p><br><br>
          <a href="{{ URL::to('/login')}}" style="-webkit-appearance: button-bevel;" type="button" class="btn btn-secondary">Login</a>
          <span class="button-slash">/</span>
          <a href="{{ URL::to('/login')}}" style="-webkit-appearance: button-bevel;" type="button" class="btn btn-secondary">SignUp</a>
           <?php } ?>
        </div>
        
      </div>
    </div>
  </div>


  @if($result['commonContent']['settings']['floating_button']=='1')
  <div class="floatingButtonWrap">
    <div class="floatingButtonInner">
        <a href="#" class="floatingButton common-bg" >
        <i class="fa fa-new fa-comments" aria-hidden="true"></i>
        </a>
        <ul class="floatingMenu">
        @if($result['commonContent']['settings']['instagram_chat']!='')
          <li class="social_media_button_instagram_outer">
            <a href="https://www.instagram.com/{{ $result['commonContent']['settings']['instagram_chat'] }}" target="_blank" class="social_media_button social_media_button_instagram fa_next_page" >
              <i class="fa fa-instagram " aria-hidden="true"></i>         
            </a>
            <div class="social_media_tooltip social_media_tooltip_instagram">Instagram</div>
            
          </li>
          @endif
          @if($result['commonContent']['settings']['whatsapp_chat']!='')
          <li class="social_media_button_whatsapp_outer">
            <a href="{{ $result['commonContent']['settings']['whatsapp_chat'] }}" target="_blank" class="social_media_button social_media_button_whatsapp fa_next_page" >
              <i class="fa fa-whatsapp" aria-hidden="true"></i>   
            </a>
            <div class="social_media_tooltip social_media_tooltip_whatsapp">Whatsapp</div>
          </li>
          @endif
          @if($result['commonContent']['settings']['facebook_chat']!='')
          <li  class="social_media_button_facebook_outer">
            <a href="https://m.me/{{ $result['commonContent']['settings']['facebook_chat'] }}" target="_blank" class="social_media_button social_media_button_facebook fa_next_page">
              <i class="fa fa-facebook" aria-hidden="true"></i>        
            </a>
            <div class="social_media_tooltip social_media_tooltip_facebook">Facebook</div>
          </li>
          @endif
          @if($result['commonContent']['settings']['telegram_chat']!='')
          <li  class="social_media_button_telegram_outer ">
            <a href="https://t.me/{{ $result['commonContent']['settings']['telegram_chat'] }}" target="_blank" class="social_media_button social_media_button_telegram fa_next_page">
              <i class="fa fa-telegram" aria-hidden="true"></i>      
            </a>
            <div class="social_media_tooltip social_media_tooltip_telegram">Telegram</div>
          </li>
          @endif
          @if($result['commonContent']['settings']['tiktok_id']!='')
          <li  class="social_media_button_telegram_outer ">
            <a href="https://t.me/{{ $result['commonContent']['settings']['tiktok_id'] }}" target="_blank" class="social_media_button social_media_button_tiktok fa_next_page">
            <svg class='fontawesomesvg' width="35" height="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z" fill="#fff"/></svg>
 
            </a>
            <div class="social_media_tooltip social_media_tooltip_telegram">TikTok</div>
          </li>
          @endif
        </ul>
    </div>
</div>
@endif
  

   <!-- Modal -->
  <div class="modal fade modalloyal" id="loginmyModal" style="z-index: 9999999;background: rgba(0, 0, 0, 0.50);" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        

        
          <div class="modal-body"> 
            
          <div class="modal-sidebar loyalty-desktop-header">
          <h4 class="sidebar__title">@lang('website.Loyalty_Points')</h4>
          @if(auth()->guard('customer')->check() && $customer->phone_verified =='1')
         
          <p class="sidebar-points"><span class="sidebar-points-value" id="add_loyalty_point">{{ auth()->guard('customer')->user()->loyalty_points }}</span><span class="sidebar-points-text">@lang('website.point')</span></P>
          @endif
          
       
            <div class="tab">
              <button class="tablinks-loyality" onclick="openCity(event, 'London')" id="defaultOpenLoyality"><i class="fa fa-star" aria-hidden="true" style="margin-right: 2px;"></i> @lang('website.eran_points')</button>
              <button class="tablinks-loyality" onclick="openCity(event, 'Paris')"><i class="fa fa-gift" aria-hidden="true" style="margin-right: 2px;"></i> @lang('website.get_rewards')</button>
              <button class="tablinks-loyality" onclick="openCity(event, 'Tokyo')"><i class="fa fa-briefcase" aria-hidden="true" style="margin-right: 2px;"></i> @lang('website.account')</button>
              <button class="tablinks-loyality" onclick="openCity(event, 'China')"><i class="fa fa-question-circle" aria-hidden="true" style="margin-right: 2px;"></i> @lang('website.help')</button>
            </div>
          </div>

          <div class="modal-sidebars loyalty-mobile-header">
          <a class="mobile-close-button" data-dismiss="modal"><i class="fa fa-chevron-left" aria-hidden="true" style="margin-right:2px"></i> Return to store</a>
          <div class="tab-right-headcon">

          @if(auth()->guard('customer')->check() && $customer->phone_verified =='1')     
         <p class="sidebar-points-tab"><i class="fa fa-star" aria-hidden="true" style="margin-right: 2px;"></i> <span class="sidebar-points-value-tab">{{ auth()->guard('customer')->user()->loyalty_points }}</span></P>
         @endif
          <span onClick="navhide()"><i class="fa fa-bars bar-icon-tab"  aria-hidden="true"></i></span>
       
</div>
<div class="tab loyalty-mobile-header-tab loyality-mobile-tab close-tab">
              <button class="tablinks-loyality" onclick="openCity(event, 'London')" id="defaultOpenLoyality"><i class="fa fa-star" aria-hidden="true" style="margin-right: 2px;"></i> @lang('website.eran_points')</button>
              <button class="tablinks-loyality" onclick="openCity(event, 'Paris')"><i class="fa fa-gift" aria-hidden="true" style="margin-right: 2px;"></i> @lang('website.get_rewards')</button>
              <button class="tablinks-loyality" onclick="openCity(event, 'Tokyo')"><i class="fa fa-briefcase" aria-hidden="true" style="margin-right: 2px;"></i> @lang('website.account')</button>
              <button class="tablinks-loyality" onclick="openCity(event, 'China')"><i class="fa fa-question-circle" aria-hidden="true" style="margin-right: 2px;"></i> @lang('website.help')</button>
            </div>
          </div>

         

          <div class="modal-page-con">

          
            
            <div id="London" class="tabcontent-loyality">
            <div class="modal-header">
              <h4 class="modal-title" style="margin:0;">@lang('website.eran_points')</h4>
              <button type="button" class="close modal-close-desktop-tab" data-dismiss="modal">&times;</button>
            </div> 
              <div class="col-md-12">
                <div class="row" style="padding-top: 10px;">
                  @if(count($items)>0)
                    @foreach ($items as $key=>$jesitems)
                      <div class="col-md-6" style="padding: 10px 15px;">
                      
                        <div class="card card-hover" style="width:100%">
                        @if($jesitems->image_path_type == 'aws')
                        <div class="item-icon"  style="background: url({{$jesitems->image_path}})center/contain no-repeat;"> </div>
                        @else
                        <div class="item-icon"  style="background: url({{asset('').$jesitems->image_path}})center/contain no-repeat;"> </div>
                        @endif
                          <div class="card-body" style="padding:0;">
                            <h5 class="card-title">{{ $jesitems->earn_points_title}}</h5>
                              @if($jesitems->no_rm =='0')
                             
                              <p class="card-text"><span class="card-value">{{$jesitems->points}}</span> points</p>
                              @else
                              <p class="card-text"><span class="card-value">{{$jesitems->points}} </span> points per @if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif {{ $jesitems->no_rm }} @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif </p>
                              @endif
                          </div>
                        </div>
                      </div>
                    @endforeach
                  @endif
                </div>
              </div>
            </div>

            <div id="Paris" class="tabcontent-loyality">
            <div class="modal-header">
              <h4 class="modal-title" style="margin:0;">@lang('website.get_rewards')</h4>
              <button type="button" class="close modal-close-desktop-tab" id="loyal-close-modal" data-dismiss="modal">&times;</button>
            </div> 
           
              <div class="col-md-12" style="height: 200px; overflow-y: auto; overflow-x: hidden;"> 
              <div class="row" style="padding-top: 10px;">
                    @php 
                      $redeem = DB::table('redeem_points_settings')
                       ->leftJoin('image_categories', 'redeem_points_settings.image', '=', 'image_categories.image_id')
                       ->leftJoin('redeem_points_description', 'redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
                        ->select('redeem_points_settings.*', 'image_categories.path as image_path','redeem_points_description.redeem_points_title', 'redeem_points_description.redeem_points_description')
                        ->where('redeem_points_description.language_id', '=', Session::get('language_id'))
                        ->where('redeem_points_settings.status', 1)
                        ->groupBy('redeem_points_settings.id')
                         ->get();
                      @endphp
                       @if(count($redeem)>0)
                       @foreach ($redeem as $key=>$jesredeem)
                    <div class="col-md-6" style="padding: 10px 15px;">
                    <div class="card" style="width:100%">
                       <div class="card-body" style="padding:10px;box-shadow: 0 2px 3px rgb(0 0 0 / 12%),0 1px 2px rgb(0 0 0 / 10%);">
                        <h5 class="card-title" style="text-align: center;padding:0;" >{{ $jesredeem->redeem_points_title}}</h5>
                        @if($jesredeem->no_rm =='0')
                             <p class="card-text" style="text-align: center;">{{$jesredeem->points}} points</p>
                            @else
                             <p class="card-text" style="text-align: center;padding: 5px 0 30px 0;">{{$jesredeem->points}} points per @if($jesredeem->discount_type=='fixed_cart')
                                @if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif {{ $jesredeem->no_rm }} @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif
                               @else
                                {{$jesredeem->no_rm}}%
                               @endif
                              </p>
                            @endif
                            <div class="get-reward-btn" style="margin-bottom: 15px;text-align: center;">
                             @if($result['commonContent']['settings']['voucher_redeem']=='0')
                            @if(auth()->guard('customer')->check() && $customer->phone_verified =='1')
                             @if($jesredeem->points <= auth()->guard('customer')->user()->loyalty_points )
                            <a href="javascript:;" id="activeVoucher" style="position:relative" redeem_id="{{$jesredeem->id}}" class="btn btn-secondary btn-sm buttonsize">@lang('website.get_reward')
                            <div class="card-item-fill" style="width: 40%; common-bg"></div>
                            </a>
                            
                            @else
                            <button style="cursor: not-allowed;position:relative" class="btn btn-secondary btn-sm disabled buttonsize" type="submit">@lang('website.more_points_needed')
                            <div class="card-item-fill common-bg" style="width: 40%;"></div></button>
                            
                            @endif
                             @endif
                             @endif
                          </div>
                       </div>
                     </div>
                     </div>
                     @endforeach
                     @endif


                
              </div>
              </div>
              <br>
              <h4 class="your-reward-title">@lang('website.your_rewards')</h4>

              <div class="alert alert-success alert-dismissible fade show loyality-success-btn" role="alert" style="margin:10px;">
                       Your reward added successfully.
                        <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
              @php 
                $your_redeem = DB::table('redeem_points_voucher')
              ->leftJoin('redeem_points_settings', 'redeem_points_settings.id', '=', 'redeem_points_voucher.redeem_id')
              ->leftJoin('image_categories', 'redeem_points_settings.image', '=', 'image_categories.image_id')
              ->leftJoin('redeem_points_description', 'redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
              ->select('redeem_points_settings.*', 'image_categories.path as image_path','redeem_points_description.redeem_points_title', 'redeem_points_description.redeem_points_description','redeem_points_voucher.id as voucher_id', 'redeem_points_voucher.created_at as voucher_date','image_categories.image_id')
              ->where('redeem_points_description.language_id', '=', Session::get('language_id'))
              ->where('redeem_points_voucher.user_id', session('customers_id'))
              ->where('redeem_points_voucher.status', 0)
              ->where('image_categories.image_type', '=', 'ACTUAL')
              ->orderBy('redeem_points_voucher.id', 'DESC')
              ->get();
              
              @endphp

             
                <div class="col-md-12" style="height: 200px; overflow-y: auto; overflow-x: hidden;">
                  <div class="get-redeem-vocher">
                  <div class="row">
                      @if(count($your_redeem)>0)
                        @foreach ($your_redeem as $key=>$jesresult)
                           <div class="col-md-12" style="padding: 10px 15px;">
                             <div class="card" style="width:100%">
                              <div class="card-body" style="padding:0">
                                <h5 class="card-title" style="text-align: left;padding: 15px 15px 10px 15px;" >{{ $jesresult->redeem_points_title}}</h5>
                                <?php  
                                     $date1 = $jesresult->voucher_date;
                                     $date2 = date("Y-m-d H:i:s");
                                      $from = date("Y-M-d H:i:s",strtotime($date1));
                                      $to = date("Y-m-d H:i:s",strtotime($date2));
    
                                      $diff = abs(strtotime($to) - strtotime($from));
                                      $years = floor($diff / (365*60*60*24)); 
  
                                      $months = floor(($diff - $years * 365*60*60*24)
                                                                     / (30*60*60*24)); 
                                    
                                      $days = floor(($diff - $years * 365*60*60*24 - 
                                                   $months*30*60*60*24)/ (60*60*24));
                                     
                                      $hours = floor(($diff - $years * 365*60*60*24 
                                             - $months*30*60*60*24 - $days*60*60*24)
                                                                         / (60*60)); 
                                     
                                      $minutes = floor(($diff - $years * 365*60*60*24 
                                               - $months*30*60*60*24 - $days*60*60*24 
                                                                - $hours*60*60)/ 60); 
                                      
                                      $seconds = floor(($diff - $years * 365*60*60*24 
                                               - $months*30*60*60*24 - $days*60*60*24
                                                      - $hours*60*60 - $minutes*60)); 

                                                   $hour = $hours.' hour '.$minutes." min ".$seconds." sec";
                                                   $min = $minutes." min ".$seconds." sec";
                                                   $sec = $seconds." sec";

                                ?>
                                <?php                    
                                  $dt = $jesresult->voucher_date;
                                  $date1 = date("Y-m-d",strtotime($dt));
                                  $date2 = date("Y-m-d");

                                  $diff = abs(strtotime($date2) - strtotime($date1));
                                  $days = round($diff / (60*60*24));
                                  if($days == 0)
                                  {
                                    if($hours != 0)
                                    {
                                      $count_date = $hour;
                                    }
                                    else
                                    {
                                      if($minutes != 0)
                                    {
                                      $count_date = $min;
                                    }
                                    else
                                    {
                                      $count_date = $sec;
                                    }

                                    }
                                  }
                                  else
                                  {
                                    $count_date = $days." days";
                                  }
                                   ?>
                                 
                                  <p class="card-text" style="text-align: left;padding-top:0;"><i class="fa fa-clock-o" aria-hidden="true" style="margin-right:2px"></i> {{$count_date}} ago 
                                  @if($result['commonContent']['settings']['voucher_redeem']=='0')
                                  <div class="view-btn-outer">
                                  <a href="javascript:;" id="get-reward-value"  redeem_id="{{$jesresult->voucher_id}}" class="btn btn-secondary btn-sm buttonsize">View reward                        
                                  </a>
                                  </div>
                                  @endif
                                
                              </div>
                             </div>   
                           </div>
                        @endforeach
                        @endif
                    </div>
                  </div>
                </div>
            </div>

            <div id="Tokyo" class="tabcontent-loyality">
            <div class="modal-header">
              <h4 class="modal-title" style="margin:0;">@lang('website.your_recent')</h4>
              <button type="button" class="close modal-close-desktop-tab" data-dismiss="modal">&times;</button>
            </div> 
           
              
              <div class="col-md-12">
                <div class="table-responsive get-pointhistory">
                  <table class="table" id="account_table">
                    <thead>
                      <tr>
                        <th>@lang('website.Date')</th>
                        <th>@lang('website.type')</th>
                        <th>@lang('website.Action')</th>
                        <th>@lang('website.point')</th>
                        <th>@lang('website.Status')</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $history = DB::table('transaction_points')->orderBy('id', 'DESC')->where('user_id', '=', Session::get('customers_id'))->get();
                      @endphp
                      @if(count($history)>0)
                      @foreach ($history as $key=>$jeshistory)
                      <tr>
                        <td>{{date('d/m/Y', strtotime($jeshistory->created_at)) }}</td>
                        <td>Activity</td>
                        <td>{{$jeshistory->description}}</td>
                        <td>{{$jeshistory->points}}</td>
                        <td><span class="history-approved common-bg">APPROVED</span></td>
                      </tr>
                      @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

             <div id="China" class="tabcontent-loyality">
             <div class="modal-header">
              <h4 class="modal-title" style="margin:0;">@lang('website.help')</h4>
              <button type="button" class="close modal-close-desktop-tab" data-dismiss="modal">&times;</button>
            </div> 
           
            
            
              <div class=col-md-12>
              <div class="help-content">
                  <h1 class="help-title">What is this?</h1>
                  <p class="help-para">This is our way of showing our appreciation. You’ll earn points for activities on our site, like referrals and purchases. You can use them to earn discounts off purchases, so the more you collect the more you save.</p>

                  <h1 class="help-title">Who can join?</h1>
                  <p class="help-para">Anyone with an account is automatically enrolled.</p>
                  
                  <h1 class="help-title">How do I earn points?</h1>
                  <p class="help-para">You can earn points for all sorts of activities, including referring friends, and making purchases. To see all the ways you can earn points click the Earn Points tab in the menu.</p>
                  
                  <h1 class="help-title">How do I view my point balance?</h1>
                  <p class="help-para">Your point balance is on every page in the top bar.</p>
                  
                  <h1 class="help-title">How do I redeem my points?</h1>
                  <p class="help-para">Select the tab called Redeem Points. Here you’ll see all the rewards we offer. If you have enough points, you can redeem them for a reward.</p>
                  
                  <h1 class="help-title">Is there a limit to the number of points I can earn?</h1>
                  <p class="help-para">No. Go ahead and earn as many as you can!</p>

                  <h1 class="help-title">What happens if a friend I refer cancels or returns their order?</h1>
                  <p class="help-para">Your pending points will become cancelled and will be removed from your account.</p>

                  <h1 class="help-title">Why did my account balance go down?</h1>
                  <p class="help-para">You, or someone you referred, cancelled or returned a purchase</p>

                  <h1 class="help-title">I completed an activity but didn't earn points!</h1>
                  <p class="help-para">It can sometimes take a few minutes for us to process your activity and provide your points.</p>

                  <h1 class="help-title">Can I use my points during checkout?</h1>
                  <p class="help-para">Not directly - please redeem your points for a voucher which can then be applied during checkout.</p>
                  
                  <h1 class="help-title">How do I leave the program?</h1>
                  <p class="help-para">If you no longer wish to earn points, please contact us and ask to be unenrolled. We'll unenroll you and you will lose any points you have accrued.</p>

                  
                  <h1 class="help-title">What happens if I leave and decide to join again?</h1>
                  <p class="help-para">Just contact us and we'll re-enroll you. However, your point total will begin from zero.</p>

                  
                  <h1 class="help-title">Where can I report a problem or give feedback?</h1>
                  <p class="help-para">Please use our normal contact details.</p>

                </div>

              
              

              </div>
            </div>

        </div>
</div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
      </div>
      
    </div>
  </div>

  <div class="modal fade" id="conformModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title">Redeem point</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding: 30px 0;">
          <p>Are you sure you want to redeem point?</p>
          <input type="hidden" name="redeem_id" id="redeem_id" value="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default addtoRedeem" style="margin-right: 20px;">Yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
      </div>
      
    </div>
  </div>


  <div class="modal fade" id="alreadyModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title">Redeem point</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>Already you redeem this voucher...</p>
          <input type="hidden" name="redeem_id" id="redeem_id" value="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="refreshPage()" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade" id="pointlowModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title">Redeem point</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>You have insufficient balance to redeem voucher</p>
          <input type="hidden" name="redeem_id" id="redeem_id" value="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="refreshPage()" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade" id="viewrewardModal" role="dialog">
    <div class="modal-dialog">

    <div class="get-redeem-detail"></div>
    </div>
  </div>

  <script>
function openCity(evt, cityName) {
  $('.loyality-mobile-tab').addClass('close-tab');
    $('.loyality-mobile-tab').removeClass('open-tab');
  var i, tabcontentloyality, tablinksloyality;
  tabcontentloyality = document.getElementsByClassName("tabcontent-loyality");
  for (i = 0; i < tabcontentloyality.length; i++) {
    tabcontentloyality[i].style.display = "none";
  }
  tablinksloyality = document.getElementsByClassName("tablinks-loyality");
  for (i = 0; i < tablinksloyality.length; i++) {
    tablinksloyality[i].className = tablinksloyality[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpenLoyality").click();

//deleteTaxClassModal
  $(document).on('click', '#activeVoucher', function(){
    var redeem_id = $(this).attr('redeem_id');
    $('#redeem_id').val(redeem_id);
    $("#conformModal").modal('show');
  });

  function navhide() {
    $('.loyality-mobile-tab').removeClass('close-tab');
    $('.loyality-mobile-tab').addClass('open-tab');
   
}


</script>




<style>

.captca-error
{
  color:red;
}
.g-recaptcha div
{
  margin: auto;
}
.fontawesomeicon::before {
    display: inline-block;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
 }

.Tiktok::before {
   font: var(--fa-font-brands);
    content: ' \e07b';
 }


.fill-hover-white:hover {
  fill: #fff !important;
}

  .quick-view-39 {
    opacity: 0;
}
  article:hover .quick-view-39 {
    opacity: 1;
}
article:hover .quick-view-39 {
    position: absolute;
    top: 35%;
    /* left: calc(50% - 1px); */
    width: 5em;
    height: 5em;
    border-radius: 50%;
    font-size: 1rem;
    color: #222;
    background-color: hsla(0,0%,98%,.9);
    -webkit-transform: translate(-50%,-50%) scale(.75);
    transform: translate(-50%,-50%) scale(.75);
    /* text-indent: 0rem; */
    -webkit-transition: opacity .3s,background-color .3s,color .3s;
    transition: opacity .3s,background-color .3s,color .3s;
    z-index: 2;
}

  .review-38
  {
    width: 100%;
    display: inline-block;
  }
  .ajax_product_24 .btn
  {
    padding: 7px;
  }

  .title_change {
    margin: 0;
    line-height: 1 !important;
}
  .product-molla-23 {
    margin-bottom: 0;
    margin-top: 30px;
}
.product-molla-24 {
    margin-bottom: 0;
    margin-top: 30px;
}
.product-molla-25 {
    margin-bottom: 0;
    margin-top: 30px;
}
.product-molla-26 {
    margin-bottom: 0;
    margin-top: 30px;
}
.product-molla-27 {
    margin-bottom: 0;
    margin-top: 30px;
}
.product-molla-28 {
    margin-bottom: 0;
}
.product-molla-29 {
    margin-bottom: 0;
    margin-top: 30px;
}
.product-molla-30 {
    margin-bottom: 0;
    margin-top: 30px;
}
.product-molla-31 {
    margin-bottom: 0;
    margin-top: 30px;
}
.product-molla-32 {
    margin-bottom: 0;
    margin-top: 30px;
}
.product-molla-33 {
    margin-bottom: 0;
    margin-top: 30px;
}
.product-molla-34 {
    margin-bottom: 0;
    margin-top: 30px;
}
.product-molla-35 {
    margin-bottom: 0;
    margin-top: 30px;
}
.product-molla-36 {
    margin-bottom: 0;
    margin-top: 30px;
}
.product-molla-37 {
    margin-bottom: 0;
    margin-top: 30px;
}
.product-molla-39 {
    margin-bottom: 0;
}
.product-molla-40 {
    margin-bottom: 0;
    margin-top: 30px;
}
.product-molla-41 {
    margin-bottom: 0;
    margin-top: 30px;
}
.product-molla-42 {
    margin-bottom: 0;
    margin-top: 30px;
}
.product-molla-43 {
    margin-bottom: 0;
    margin-top: 30px;
}
.product-molla-44 {
    margin-bottom: 0;
    margin-top: 30px;
}
  .mp_ajax_home_none
  {
    padding:0;
    margin:0;
  }
  .pcs-0
  {
    padding:0;
  }
  .categories-carousel-js .slick-slide {
    margin: 0px 10px 0 0;
}

  .breadcrumb-item + .breadcrumb-item::before {
    padding-right: 0.15rem !important;
}
.breadcrumb-item + .breadcrumb-item {
    padding-left: 0.15rem !important;
}

  .range-slider-main {
    border-bottom: 1px solid #dee2e6 !important;
    border:none;
}
.right-menu .color-range-main {
  border-bottom: 1px solid #dee2e6 !important;
    border:none;
}

  .brand-main-1 {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 8rem;
    padding: 20px;
    height: 100px;
    border: 0.1rem solid #ebebeb;
    border-left-width: 0;
}
  .brandimg {
    width: 100%;
    height: 100px;
    width: 100px !important;
    max-width: 100%!important;
    object-fit:contain;
}
.footer-molla .footer-logo {
    height: auto !important;
}
.logo_new_style_outer
{
    width: 125px !important;
    height:auto;
}
.logo_new_style_inner
{
  width:100% !important;
  height:100% !important;
  object-fit:contain;
}

.insta-img-outer {
    height: 88px;
}
  
  .categories-panel ul .nav-item .dropdown-menu .newstyle {
    padding: 0.55rem;
}

.pro-fs-content .general-product {
  margin-top: 0px !important;
}


.mtb30
{
  margin:30px 0 0 0 !important;
}
  .checkout-area .item-price, .checkout-area .item-total {
    font-size: 1rem !important;
}

.product article .content .title a {
   width: 100%;
    white-space: nowrap;
    overflow: hidden !important;
    text-overflow: ellipsis;
}
#viewrewardModal
{
  z-index: 99999999;
}
.body-overflow 
{
  overflow: hidden;
  height : 80vh;
}


  .search-field-module-s .dropdown-menu {

    transform: translate3d(-1px, 44px, 0px) !important;
    z-index: 100 !important;
  }

  .dropdown-menu-new {
    width: 225px !important;
    padding: 0.75rem 0 !important;
}
.dropdown-submenu-new {
    width: 225px !important;
    padding: 14px 0 !important;
}
  .disabled-ratings > label {
    float: right !important;
}
button:focus {
    outline: none !important;
}
#conformModal {
  z-index: 9999999 !important;
}

.categories-content .desktop_cat .cat-banner .categories-image {
    padding: 5px;
}

.submenu1 li.nav-item.dropdown.parent.dropright {
    padding: 0.1rem 0.5rem;
}

 

  .padding-top-65
  {
    padding-top: 65px !important;
  }

  .h-100
  {
    height: 100% !important;
  }

.categories-panel ul .nav-item a {
    font-weight: 600 !important;
}

.left-thumb-height .imagespace {
    height: 183px;
}

.listing .product2 article .pro-thumb .img-fluid {
    width: auto !important;
}

.listing .product6 article .btn-block {
    height: 40px;
    width: 32%;
    position: absolute;
    bottom: 0;
} 
.shop-content .listing .product6 article .content {
    width: 65% !important;
    padding-top: 30px;
}

.shop-content .griding .product6 article p {
    text-align:center;
    width: 100%;
}
.shop-content .listing .product7 article .thumb {
    width: 100%;
}
.shop-content .listing .product7 article {
    display: flow-root;
}
.shop-content .listing .product7 article .content {
    width: 60% !important;
    text-align:center;
    vertical-align:top;
}
.shop-content .listing .product7 article .tag {
    text-align: left !important;
}
.shop-content .listing .product7 article .title {
    display: unset;
}
.shop-content .listing .product7 article .price {
    display: unset;
}
.shop-content .listing .product7 article .btn-block {
    width: 47%;
    margin:initial;
    margin-bottom:10px
} 

.shop-content .listing .product12 .disabled-ratings {
    text-align: left;
} 
.shop-content .listing .product12 .price {
    margin-bottom: 35px;
} 
.shop-content .listing .ratingstar .disabled-ratings {
    text-align: left;
    display: flex;
} 
.shop-content .listing .product12 article p {
    text-align: left !important;
    width:100%;
}
.input-group .qty {
    height: 42px;
}
.product12.product article .content .pro-counter {
    display: flex;
     justify-content: left !important; 
    margin-bottom: 10px;
    margin-top: 5px;
}
.listing .product10 article .content {
    width: 57%;
    display: inline-block;
    padding: 10px;
    
}
.listing .product-16 article .content {
    padding: 10px;
}
.listing .product10 article .pro-thumb {
  width: 40%;
    display: inline-block;
}
.griding .p-text-center {
    text-align: center;
    width: 100%;
}
.listing .btn-pro-5
{
    position: absolute;
    left: 283px;
    bottom: 0;
}
.listing .product6.product article .thumb .product-action-vertical {
    top: 0px !important;
}

.listing .product9.product article .content .pricetag {
   display: unset; 
}

.listing .product9.product article .content .pricetag .icon {
   margin-top: 10px;
}

.listing .product2-listing article .pro-thumb{
    width: 32%;
    display: inline-block;
}
.listing .product2-listing article .content {
    width: 67%;
    display: inline-block;
    padding : 0 10px;
  
}

.griding .product13 article .content .title {
   text-align: center;
}

.listing .product2  .pricetag {
   display: unset; 
}
.listing .product2  .pricetag .price {
   display: block; 
}

.listing .product2  .pricetag .icon {
   margin-top: 10px;
}
.listing .product12.product article .content .btn {
  position: absolute;
    left: 280px;
    bottom: 0;
}

.griding .product13.product article .content .pricetag {
  display: unset;
}
.griding .product14 .title {
  text-align: center;
}

.product13 .pro-rating {
   text-align:center;
}
.product13 .pro-rating .disabled-ratings > label {
    float: unset;
}

.product14 .pro-rating {
   text-align:right;
}
.product14 .pro-rating .disabled-ratings > label {
    float: unset;
}

.griding .product-16 article .content .tag {
    text-align: left;
}

.griding .product17.product article .content .pro-counter {
    display: flex;
    justify-content: center !important;
    margin-bottom: 10px;
    margin-top: 5px;
}
.listing .product17.product article .content .pro-counter {
    display: flex;
    justify-content: left !important;
    margin-bottom: 10px;
    margin-top: 5px;
}

.product17.product article .content .btn-secondary {
    margin-left: 5px;
    padding: 10px 12px;
}
.product17.product article .content .btn {
    border-radius: 10px;
}
.griding .product17 .title {
  text-align: center;
}


.expand-fancy-thumb {
    font-size: 20px;
    cursor: pointer;
    position: absolute;
    right: 15px;
    z-index: 1;
}
.expand-fancy-thumbs {
    font-size: 20px;
    cursor: pointer;
    position: absolute;
    right: 15px;
    z-index: 1;
    bottom: 250px;
}


#footerNine .email-font {
    font-size: 0.75rem;
}
.parallex-banner-desktop
{
  display: block;
}
.parallex-banner-mobile
{
  display: none;
}
.fullwidth-static-banner {
position: relative;
}

.fullwidth-static-banner .parallax-banner-text {
  text-align: center;
  position: absolute;
  z-index: 10;
  left:0;
  right:0;
  top: 50%;
    transform: translateY(-50%);
}

.fullwidth-static-banner .parallax-banner-text h2 {
  font-size: 5rem;
  line-height: 1;
  
  color: #fff;
  margin: 0;
}

.fullwidth-static-banner .parallax-banner-text h4 {
  font-size: 40px;
  
  font-weight: 600;
  color: #fff;
  line-height: 1.5;
  margin: 0;
}
.fullwidth-static-banner .parallax-banner-text .hover-link {
  transform: translateY(-100px);
  transition: 1.2s ease-out;
  opacity: 0;
  margin-top: 15px;
}

.fullwidth-static-banner:hover .hover-link {
  opacity: 1;
  transition-timing-function: ease-in;
  transform: translateY(0px) !important;
  -webkit-transform: translateY(0px) !important;
  transition: 0.4s;
}










.sticky-header .header-sticky-inner nav .navbar-collapse ul .li-style .nav-link {
    padding-top: 0.5rem !important;
    padding-bottom: 0.5rem !important;
}
.sticky-header .header-sticky-inner nav .navbar-collapse ul .li-style {
    margin-left: 0px !important;
}
.sticky-header .header-sticky-inner nav .navbar-collapse ul li .dropdown-menu {
    padding: 0.75rem 0 !important;
}
.header-nine .header-navbar nav .navbar-collapse ul .li-style .nav-link {
    padding-top: 0.65rem !important;
    padding-bottom: 0.65rem !important;
}
.header-one .header-navbar nav .navbar-collapse ul .nav-item .nav-link {
    padding-top: 0.65rem !important;
    padding-bottom: 0.65rem !important;
}
.header-two .header-navbar nav .navbar-collapse ul .li-style .nav-link {
    padding-top: 0.65rem !important;
    padding-bottom: 0.65rem !important;
}
.header-three .header-navbar nav .navbar-collapse ul .li-style .nav-link {
    padding-top: 0.65rem !important;
    padding-bottom: 0.65rem !important;
}
.header-four .header-navbar nav .navbar-collapse ul .li-style .nav-link {
    padding-top: 0.65rem !important;
    padding-bottom: 0.65rem !important;
}
.header-five .header-navbar nav .navbar-collapse ul .li-style .nav-link {
    padding-top: 0.65rem !important;
    padding-bottom: 0.65rem !important;
}
.header-six .header-navbar nav .navbar-collapse ul .li-style .nav-link {
    padding-top: 0.65rem !important;
    padding-bottom: 0.65rem !important;
}
.header-seven .header-navbar nav .navbar-collapse ul .li-style .nav-link {
    padding-top: 0.65rem !important;
    padding-bottom: 0.65rem !important;
}
.header-eight .header-navbar nav .navbar-collapse ul .li-style .nav-link {
    padding-top: 0.65rem !important;
    padding-bottom: 0.65rem !important;
}
.header-ten .header-navbar nav .navbar-collapse ul .li-style .nav-link {
    padding-top: 0.65rem !important;
    padding-bottom: 0.65rem !important;
}
.header-ten .header-navbar nav .navbar-collapse ul .li-style .dropdown-menu {
    padding: 0.65rem 0 !important;
}
.header-nine .header-navbar nav .navbar-collapse ul .li-style .dropdown-menu {
    padding: 0.65rem 0 !important;
}
.header-one .header-navbar nav .navbar-collapse ul .li-style .dropdown-menu {
    padding: 0.65rem 0 !important;
}
.header-two .header-navbar nav .navbar-collapse ul .li-style .dropdown-menu {
    padding: 0.65rem 0 !important;
}
.header-three .header-navbar nav .navbar-collapse ul .li-style .dropdown-menu {
    padding: 0.65rem 0 !important;
}
.header-four .header-navbar nav .navbar-collapse ul .li-style .dropdown-menu {
    padding: 0.65rem 0 !important;
}
.header-five .header-navbar nav .navbar-collapse ul .li-style .dropdown-menu {
    padding: 0.65rem 0 !important;
}
.header-six .header-navbar nav .navbar-collapse ul .li-style .dropdown-menu {
    padding: 0.65rem 0 !important;
}
.header-seven .header-navbar nav .navbar-collapse ul .li-style .dropdown-menu {
    padding: 0.65rem 0 !important;
}
.header-eight .header-navbar nav .navbar-collapse ul .li-style .dropdown-menu {
    padding: 0.65rem 0 !important;
}

.header-one .dropdown-submenu .dropdown-menu {
    top: -10px;
}
.header-ten .dropdown-submenu .dropdown-menu {
    top: -0.75rem;
}
.header-two .dropdown-submenu .dropdown-menu {
    top: -12px;
    left: 100%;
    margin-left: 0 !important;
}
.header-three .dropdown-submenu .dropdown-menu {
  top: -0.75rem;
}
.header-four .dropdown-submenu .dropdown-menu {
    top: -11px;
    left: 100%;
    margin-left: 0 !important;
}
.header-five .dropdown-submenu .dropdown-menu {
    top: -11px;
}
.header-six .dropdown-submenu .dropdown-menu {
    top: -10px;
    left: 100%;
    margin-left: 0 !important;
}
.header-seven .dropdown-submenu .dropdown-menu {
    top: -11px;
}
.header-nine .dropdown-submenu .dropdown-menu {
    top: -11px;
    left: 100%;
    margin-left: 0 !important;
}
.header-eight .dropdown-submenu .dropdown-menu {
    top: -10px;
}


.header-four .dropdown-submenu {
    position: relative;
}
.header-four .dropdown-submenu:hover > .dropdown-menu {
    display: block;
}

.header-six .dropdown-submenu {
    position: relative;
}

.header-six .dropdown-submenu:hover > .dropdown-menu {
    display: block;
}


.sticky-header .more-submenu {
    top: -11px !important;
}
.sticky-header .more-submenu .dropdown-submenu .dropdown-menu {
    top: -11px !important;
}
.header-mobile .header-maxi .navigation-mobile-container #navigation-mobile .fa-chevron-down {
  padding: 0 10px;
  float: right;
  display: block;
  margin-top: 5px;
}
.header-mobile .header-maxi .navigation-mobile-container #navigation-mobile .main-manu:hover .fa-chevron-down {
  display: block !important;
  
}
.header-mobile .header-maxi .navigation-mobile-container #navigation-mobile .main-manu:hover .fa-chevron-up {
  display: none !important; 
}

.header-nine .dropdown-submenu .more-submenu {
    top: -10px;
    left: -101%;
    margin-left: 0 !important;
}
 .header-nine .header-navbar nav .navbar-collapse ul .li-style:last-child {
    margin-left: 0px !important;
    margin-right: 15px;
} 

.sticky-header .dropdown-submenu .dropdown-menu {
    top: -0.75rem;
}

/* .categories-sec-content-product-padding .product {
    padding: 30px 10px 0 10px;
} */

.shop-content-5.shop-topbar .listing .product article .thumb {
    width: 35% !important;
}


    #myModalLoyalty .modal-dialog {
    position: unset !important;
    transform: unset !important;
}

.header-mobile .header-navbar .form-inline .search .select-control::before {
    background: white;
    padding-left: 5px;
}

.product-16 article .desktop-hover {
    display: flex !important;
}

.typeheads-fixed-old {
    width: 230px !important;
}

.header-eight .header-navbar nav .navbar-collapse ul li:last-child .search-field-module {
    top: 2px;
}

.desktop_slider_view
{
  display: block !important;
}
.mobile_slider_view
{
  display: none !important;
}

#loginmyModal .modal-dialog {
    position: unset !important;
    transform: unset !important;
}

#loyalty-mobile-header
{
  display:none;
}
#loyalty-desktop-header
{
  display:block;
}

.loyalty-mobile-header
{
  display:none;
}
.loyalty-desktop-header
{
  display:block;
}


#loyalty-mobile-header .mobile-close-button
{
  display: inline-block;
    padding: 10px 10px 12px 16px;
    font-size: 1.1em;
    cursor: pointer;
    color: #fff;
   
}

#myModalLoyalty .modal-content {
  width: 100%;
  padding: 0px;
}

#myModalLoyalty .modal-title {
    font-size: 1.6em;
    text-align: center;
    color: #fff;
}
#myModalLoyalty .modal-body {
  padding: 0px;
}
#loginmyModal .modal-body {
  padding: 0px;
}

#myModalLoyalty .tb
{
  font-weight:600;
}
#myModalLoyalty .popup-title {
    border: 0px solid;
    font-size: 1.3em;
    font-weight: 400; 
}
#myModalLoyalty .popup-titles {
    width: 100%;
    margin-bottom: 3px;
    font-size: 1.1em;
    font-weight: 600;
    color: #111;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

#myModalLoyalty .close {
    font-weight: bold;
    font-size: 33px;
    color: #fff !important;
    width: 40px;
    height: 40px;
    text-align: center;
    position: absolute;
    top: 15px;
    right: 30px;
    text-decoration: none;
    z-index: 250;
    cursor: pointer;
}

#myModalLoyalty .modal-header {
    color: #fff;
    border-bottom: 1px solid #344d33;
    border-top-left-radius: inherit;
    border-top-right-radius: inherit;
    height: 60px;
    width: 100%;
    position:relative;
}

#myModalLoyalty .border {
border-right: 1px solid #dadada;
}

#myModalLoyalty p.footer-para {
  color: #333;
}

#myModalLoyalty .page-content p, .modal-content p {
    margin: 2px 0 0 0;
}



    .modalloyal
    {
      padding-top:50px;
    }
    .modal-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    border-bottom: 1px solid #dee2e6;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
        .popup-main{
            border:0px solid;
        }
        .popup-main-left{
    
      width: 49%;
      display: inline-block;
      padding: 13px 15px 13px 15px;
      vertical-align: top;
      height: 405px;
      background: #fff;
      overflow-y: auto;
        }
        .popup-item{
            border:0px solid;
            vertical-align: middle;
            text-align: center;
            padding: 20px 0px;
            border-top:1px solid #f8f8f8
        }
        .popup-title{
            border:0px solid;
            font-size:1.3em;
            font-weight:600;
        }
        .title1{
            font-size:1em;
        }
        .popup-item-left{
            width: 55px;
            height: 55px;
            background-color: transparent;
            background-size: 46px;
            display: inline-block;
            vertical-align: top;
        }
        .popup-item-right{
            text-align: left;
            padding-left: 15px;
            flex: 1 0 0px;
            display: inline-block;
            min-width: 0px;
            width: 70%;
            vertical-align: top;
        }
        
        .footer-para{
            font-size: 1.2em;
            color: rgb(180, 169, 169);           
            text-align: center;
            width:100%;
        }
    
        .modal-footer {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -ms-flex-align: center;
            align-items: center;
            background: #fff;
            -ms-flex-pack: end;
            justify-content: center;
            padding: .75rem;
            border-top: 1px solid #dadada;
            border-bottom-right-radius: calc(.3rem - 1px);
            border-bottom-left-radius: calc(.3rem - 1px);
        }
        .button-slash{
            display: inline-block;
            margin: 0 20px;
            font-size: 1.4em;
            color: #ccc;
            pointer-events: none;
        }
        .fixedbutton {
    position: fixed;
    bottom: 0px;
    left: 10px; 
  z-index: 99999;
}
   
* {box-sizing: border-box}

/* Style the tab */
.tab {
  float: left;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
  width: 30%;
  height: 300px;
}




.contactus-2-border-input
{
  border: solid 1px #dee2e6 !important;
}

.contactus-2-outer-form {
    background: #fff;
    padding: 15px;
}

.range-slider-main .form-inline .form-group span .form-control {
   
    width: 60px !important;
  
}


.categories-content .cat-banner {
   padding: 10px;
}

.w-80
{
  max-width: 80% !important;
}
.footer-one .socials li .sgo:hover {
    color: #EA4335;
}
.footer-one .socials li .sln:hover {
    color: #0e76a8;
}
.footer-nine-outer-bg
{
  background-color: #474747 !important;
}
.footer-nine-inner-bg
{
  background-color: #808080 !important;
}

.footer-nine1 .links-list li a {
    color: #fff ;
}
.footer-nine1 .links-tag li a {
  color: #fff ;
}
.footer-nine1 .links-tag li a {
  color: #fff ;
}
.footer-nine1 {
  color: #fff ;
}
.footer-nine1 .contact-list li a {
  color: #fff ;
}
.footer-nine1 .social-content .footer-info {
    color: #080808 ;
}
.footer-nine1 .social-content .social li a {
    background-color: black ;
    color:  #fff ;
    border: none !important;
}
.car-4-cat-height .navbar-nav
{
  height: 302px;
    background: #fff;
    overflow-y: auto;
    overflow-x: hidden;
}

.bg-red
{
  background: red !important;
  border: solid 1px red;
}

iframe {
    width: 100%;
    height: 300px ;
}

.slider-wrapper .slider-for-vertical iframe {
    width: 100% !important;
    height: 300px !important;
}
.slider-for-vertical .slick-list .slick-track .slick-slide img {
    height: 300px;
    object-fit: contain;
}
.slider-wrapper .slider-nav-vertical img {
    width: 100%;
    height: 100px;
}
.pro-content .slider-nav-vertical .slick-arrow.slick-prev {
    left: 40px;
    top: -35px;
}
.slider-nav-vertical .slick-arrow.slick-prev:before {
    content: '\2191';
    font-size: 20px;
}
.slider-nav-vertical .slick-arrow.slick-next:before {
    content: '\2193';
    font-size: 20px;
}

.pro-content .slider-nav-vertical .slick-arrow.slick-next {
    right: 40px;
    bottom: -35px;
}

/* Style the buttons inside the tab */
.tab button {
  display: block;
  background-color: inherit;
  color: black;
  padding: 22px 16px;
  width: 100%;
  border: none;
  outline: none;
  text-align: left;
  cursor: pointer;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current "tab button" class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent-loyality {
  float: left;
  width: 70%;
  border-left: none;
}
/* #loginmyModal .modal-dialog {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) !important;
    margin-top: 0;
    margin-bottom: 0;
    width: 100%;
} */
#loginmyModal .view-btn-outer {
    position: absolute;
    right: 15px;
    transform: translate(0%, -50%) !important;
    top: 50%;

}

#conformModal .modal-dialog {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) !important;
    margin-top: 0;
    margin-bottom: 0;
    width: 100%;
}


#alreadyModal .modal-dialog {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) !important;
    margin-top: 0;
    margin-bottom: 0;
    width: 100%;
}
#pointlowModal .modal-dialog {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) !important;
    margin-top: 0;
    margin-bottom: 0;
    width: 100%;
}

#viewrewardModal .modal-dialog {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) !important;
    margin-top: 0;
    margin-bottom: 0;
    width: 100%;
}


#loginmyModal .modal-content {
  width: 100%;
  padding: 0px;
  min-height: 600px;
    height: auto;
}
#loginmyModal .mobile-close-button
{
  display: inline-block;
    padding: 10px 10px 12px 16px;
    font-size: 1.1em;
    cursor: pointer;
    color: #fff;
    width: 50%;
}

#conformModal .modal-content {
  width: 600px;
  padding:0;
}
#conformModal .modal-body {
 text-align:center;
}

#conformModal .close {
  font-size: 33px;
    line-height: 45px;
    width: 45px;
    height: 45px;
    text-align: center;
    cursor: pointer;
    position: absolute;
    top: 5px;
    right: 15px;
    color: #000;
    opacity: 1;
}

#conformModal .modal-header {
    background-color: #f9f9f9;
    border-bottom: 1px solid #eee;
    border-radius: 3px 3px 0 0;
    display: flex;
    cursor: default;
    position: relative;
    padding:0;
}
#conformModal .modal-title {
  flex-grow: 1;
    padding: 10px;
    font-size: 1.6em;
    margin: 0;
}

#alreadyModal .modal-content {
  width: 600px;
  padding:0;
}
#alreadyModal .modal-body {
 text-align:center;
}

#alreadyModal .close {
  font-size: 33px;
    line-height: 45px;
    width: 45px;
    height: 45px;
    text-align: center;
    cursor: pointer;
    position: absolute;
    top: 5px;
    right: 15px;
    color: #000;
    opacity: 1;
}

#alreadyModal .modal-header {
    background-color: #f9f9f9;
    border-bottom: 1px solid #eee;
    border-radius: 3px 3px 0 0;
    display: flex;
    cursor: default;
    position: relative;
    padding:0;
}
#alreadyModal .modal-title {
  flex-grow: 1;
    padding: 10px;
    font-size: 1.6em;
    margin: 0;
}

#pointlowModal .modal-content {
  width: 600px;
  padding:0;
}
#pointlowModal .modal-body {
 text-align:center;
}

#pointlowModal .close {
  font-size: 33px;
    line-height: 45px;
    width: 45px;
    height: 45px;
    text-align: center;
    cursor: pointer;
    position: absolute;
    top: 5px;
    right: 15px;
    color: #000;
    opacity: 1;
}

#pointlowModal .modal-header {
    background-color: #f9f9f9;
    border-bottom: 1px solid #eee;
    border-radius: 3px 3px 0 0;
    display: flex;
    cursor: default;
    position: relative;
    padding:0;
}
#pointlowModal .modal-title {
  flex-grow: 1;
    padding: 10px;
    font-size: 1.6em;
    margin: 0;
}

#viewrewardModal .modal-content {
  width: 600px;
  padding:0;
}
#viewrewardModal .modal-body {
 text-align:center;
}

#viewrewardModal .close {
  font-size: 33px;
    line-height: 45px;
    width: 45px;
    height: 45px;
    text-align: center;
    cursor: pointer;
    position: absolute;
    top: 5px;
    right: 15px;
    color: #000;
    opacity: 1;
}

#viewrewardModal .modal-header {
    background-color: #f9f9f9;
    border-bottom: 1px solid #eee;
    border-radius: 3px 3px 0 0;
    display: flex;
    cursor: default;
    position: relative;
    padding:0;
}
#viewrewardModal .modal-title {
  flex-grow: 1;
    padding: 10px;
    font-size: 1.6em;
    margin: 0;
}

#loginmyModal .modal-sidebar {
    width: 25%;
    display: inline-block;
    vertical-align: top;
    min-height: 600px;
    height: auto;
}
#loginmyModal .modal-sidebars {
    width: 25%;
    vertical-align: top;
    min-height: 600px;
    height: auto;
}

#loginmyModal .modal-page-con{
  width: 74%;
  display: inline-block;
    vertical-align: top;
}

#loginmyModal .tab {
  width: 100%;
    flex-grow: 1;
    padding: 20px 0 40px;
    background: transparent;
    border: none;
}


#loginmyModal .tablinks-loyality {
    display: block;
    color: #fff;
    text-decoration: none;
    padding: 7px 10px 7px 11px;
    outline: none;
    font-size: 1em;
    cursor: pointer;
}
#loginmyModal .tabcontent-loyality {
  width: 100%;
  
}
#loginmyModal .modal-header {
  padding: 10px;
  background-color: #fff;
}
#loginmyModal .modal-body {
  background-color: #f5f5f5;
}


#loginmyModal .sidebar__title {
    font-size: 1em;
    padding: 18px;
    border-top-left-radius: inherit;
    color: #fff;
    margin:0;
}
#loginmyModal .sidebar-points-value {
  font-size: 1.2em;
    display: inline-block;
    margin-right: 5px;
    
}
#loginmyModal .sidebar-points-text {
  font-size: 1.2em;
  }

  #loginmyModal .sidebar-points{
    text-align: right;
    padding: 10px;
    color: #fff !important;
    width: 100%;
}
#loginmyModal .tabcontent-loyality {
  padding: 0;
  }

#loginmyModal .card-title {
    font-size: 1.3em;
    flex-grow: 1;
    padding: 15px 40px 15px 15px;
    overflow: hidden;
    margin:0;
}
 
#loginmyModal .card-text {
    text-align: left;
    border-radius: 0 0 3px 3px;
    padding: 15px;

}
#loginmyModal .card-value {
    display: inline-block;
    color: #000;
    margin-right: 4px;
    font-weight: bold;
}


#loginmyModal .item-icon {
    width: 55px;
    height: 55px;
    background-color: white;
    border-radius: 100px;
    position: absolute;
    top: -10px;
    right: -10px;
    background-size: 35px;
    box-shadow: 0 0 3px 1px rgb(25 25 25 / 10%);
}

#loginmyModal .card-item-fill {
    height: 4px;
    position: absolute;
    bottom: 0;
    left: 0;
    border-radius: 0 3px 3px 3px;
    z-index: 20;
}
#loginmyModal .btn-secondary.disabled, .btn-secondary:disabled {
    color: #fff;
    background-color: #999;
    border-color: #6c757d;
}
#loginmyModal .btn,#loginmyModal .btn:active,#loginmyModal .btn:active:focus, #loginmyModal .btn:visited, #loginmyModal .btn:focus {
    text-decoration: none;
    color: #fff;
    outline: none;
    box-shadow: none !important;
}
#loginmyModal .your-reward-title {
    border-bottom: 1px dotted #ddd;
    color: #333;
    font-weight: 600;
    font-size: 1.6em;
    padding: 8px 10px 7px 15px;
}
#loginmyModal .history-approved {
    color: #fff;
    padding: 3px 6px;
    font-size: 12px;
    text-transform: uppercase;
    border-radius: 3px;
    box-sizing: border-box;
    
}
.help-title
{
  font-size: 1.3em;
    line-height: 30px;
    font-weight: 600;
    color: #333;
    margin-bottom: 4px;
    margin-top: 1.3em;
}
.help-para {
    color: #333;
    margin-top: 0;
}
.help-content
{
  height: 548px;
  overflow-y: scroll;
}
#loginmyModal .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 10px !important;
}

#loginmyModal tr:nth-child(even) {
  background-color: #dddddd !important;
}
#loginmyModal .table thead {
  background-color: #dddddd
}

#loginmyModal .table {
    background: #fff;
    margin-top: 10px;
}
.notifications {
    white-space: normal;
}
.alert-cookie {
    z-index: 99999 !important;
}
#back-to-top {
    bottom: 31px;
    z-index: 999999 !important;
    width: 42px;
    height: 42px;
  
}
.desktop_cat
{
  display:block;
}
.mobile_cat
{
  display:none;
}
.categories-content .slick-prev,
.categories-content .slick-next
{
    border-radius: 50%;
    opacity: 1;
    visibility: visible;
    transform: translateX(calc(50% - 0px));
    background-color: #bdbdbd;
    box-shadow: 0 1px 12px 0 rgb(0 0 0 / 12%);
    transition: all .1s cubic-bezier(.4,0,.6,1);
}

.categories-icon-outer {
    width: 125px;
    height: 125px;
    margin: auto;
}
#loginmyModal .table-responsive {
  height: 548px;
    overflow-y: scroll;
}
figure.categories-icon-mobile {
    height: 100px;
   width: 100px;
   margin: auto;
}

.categories-icon-outer-mobile {
    width: 100px;
    height: 100px;
    margin: auto;
   
}
.categories-content .cat-banner .categories-icon img {
    width: 100%;
    height: 100%;
}
.categories-content .slick-slider .slick-track:hover + .slick-arrow  {
  transform: scale(2) !important;
}

.categories-content .general-product:hover .slick-arrow {
    transition: 0.4s ease-in-out;
    transform: scale(2) !important;
    opacity: 1 !important;
    overflow: hidden;
}


.sticky-header .header-sticky-inner .pro-header-right-options .profile-tags .dropdown-menu {
    width: 200px !important;
}
.sticky-header .header-sticky-inner .pro-header-right-options .dropdown .dropdown-menu {
    margin-top: 14px;
}

.sticky-header {
    z-index: 160 !important;
}

  .mar-top-mobile-3
{
  margin-top: 30px;
}

.slider-wrapper .slider-for .slider-for__item img {
    width: 100%;
    height: 300px;
    object-fit: contain;
}
.slider-wrapper .slider-for {
    margin-bottom: 20px;
    height: 300px;
    width: 100%;
}
.mar-top-mobile-7 {
    margin-top: 30px;
}
.group-banners .imagespace-8 {
    margin-bottom: 30px;
}
.group-banners .imagespace-13 {
    margin-bottom: 33px;
}

.product3.product article .content {
    padding-bottom: 48px;
}
.product4.product article .content {
    padding-bottom: 48px;
}

  .listing .product-action-14
  {
    justify-content: flex-start !important;
  }
  .listing .product-action-14 .btn
  {
    width:275px;
  }

.product article .display-grid .icon {
    display: inline-grid;
}
/* .tabs-content .tab-content .product {
  padding: 30px 10px 0 10px;
}

.tabs-content .tab-content .product2 {
  padding: 30px 10px 0 10px !important;
} */


.blog {
  padding: 0px 10px 30px 10px !important;
}

.product12.product article .content .btn-secondary:hover {
    color: #fff !important;
}

.product9.product article .content .btn-secondary:hover {
    color: #fff !important;
}
  
.search_outer_con {
    position: absolute;
    z-index: 100;
    background: #fff;
    top: 45px;
    width: 250px;
    border: 1px solid rgba(0, 0, 0, 0.15);
    min-width: 10rem;
    padding: 0.5rem 0.5rem;
    margin: 0.125rem 0 0;
    font-size: 0.875rem;
    color: #111;
    display: none;
    max-height: 400px;
    overflow-y: auto;
    overflow-x: hidden;
}
.search_outer_con_fixed {
    position: absolute;
    z-index: 100;
    background: #fff;
    top: 30px;
    width: 270px;
    border: 1px solid rgba(0, 0, 0, 0.15);
    min-width: 10rem;
    padding: 0.5rem 0.5rem;
    margin: 0.125rem 0 0;
    font-size: 0.875rem;
    color: #111;
    display: none;
    max-height: 400px;
    overflow-y: auto;
    overflow-x: hidden;
}
.search_outer_con_mobile {
    position: absolute;
    z-index: 100;
    background: #fff;
    top: 45px;
    width: 250px;
    border: 1px solid rgba(0, 0, 0, 0.15);
    min-width: 10rem;
    padding: 0.5rem 0.5rem;
    margin: 0.125rem 0 0;
    font-size: 0.875rem;
    color: #111;
    display: none;
    max-height: 400px;
    overflow-y: auto;
    overflow-x: hidden;
}
.searchdropdown {
    padding: 10px 0;
}

.notifications {
    z-index: 1;
}


.enable_search
{
  display: block;
}

  .floatingButtonWrap {
    display: block;
    position: fixed;
    bottom: 15px;
    right: 15px;
    z-index: 120;
}

.floatingButtonInner {
    position: relative;
}

.floatingButton {
    display: block;
    text-align: center;
    color: #fff;
    width: 60px;
    height: 60px;
    position: absolute;
    border-radius: 50% 50%;
    bottom: 0px;
    right: 0px;
    /* opacity: 0.3; */
    opacity: 1;
    transition: all 0.4s;
}

.floatingButton .fa-comments {
    font-size: 30px !important;
    padding: 15px 13px;
}

.floatingButton .fa-close {
  font-size: 30px !important;
    padding: 15px;
}

.floatingButton.open,
.floatingButton:hover,
.floatingButton:focus,
.floatingButton:active {
    opacity: 1;
    color: #fff;
    box-shadow: rgb(0 0 0 / 70%) 2px 2px 11px;
  -webkit-box-shadow: rgb(0 0 0 / 70%) 2px 2px 11px;
}



.floatingButton .fa {
    transform: rotate(0deg);
    transition: all 0.4s;
}

.floatingButton.open .fa {
    transform: rotate(270deg);
}

.floatingMenu {
    position: absolute;
    bottom: 60px;
    right: 0px;
    /* width: 200px; */
    display: none;
}

.social_media_button
{
    padding: 15px;
    font-size: 35px;
    border-radius: 50%;
    width: 60px;
    height: 60px;
}

.social_media_button_instagram{ 
  background: #f09433; 
background: -moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); 
background: -webkit-linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); 
background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); 
padding: 6px 14px 0 0;
  }

  .social_media_button_telegram{ 
  background: #0088cc; 
  padding: 5px 12px 0 0;
  }

  .social_media_button_tiktok{ 
  background: #000000; 
  padding: 5px 12px 0 0;
  }

.social_media_button_whatsapp {
  background: #4FCE5D;
  padding: 5px 13px 0 0;
}
.social_media_button_facebook {
  background: #3B5998;
  padding: 7px 20px 0 0;
}
.social_media_button_instagram_outer {
  position: relative;
}
.social_media_button_whatsapp_outer {
  position: relative;
}
.social_media_button_telegram_outer {
  position: relative;
}
.social_media_button_facebook_outer {
  position: relative;
}

.social_media_button_instagram_outer:hover .social_media_tooltip_instagram {
  display: block;
}
.social_media_button_facebook_outer:hover .social_media_tooltip_facebook {
  display: block;
}
.social_media_button_whatsapp_outer:hover .social_media_tooltip_whatsapp {
    display: block;
}
.social_media_button_telegram_outer:hover .social_media_tooltip_telegram {
    display: block; 
   
}
.social_media_tooltip {
  order: 1;
   
    font-size: 13px;
    border: 1px solid rgb(226, 226, 226);
    padding: 4px 9px 6px;
    margin: auto 14px auto 0px;
    border-radius: 4px;
    color: rgb(51, 51, 51);
    background: white;
    top: 16px;
    box-shadow: rgb(0 0 0 / 20%) 2px 2px 5px;
    white-space: nowrap;
    display: none; 
    z-index: 100;
    line-height: 15px;
    position: absolute;
    right: 65px;
    top: 0;
    bottom: 0;
    height: 25px;
    animation-name: example;
    animation-duration: 0.3s;
}

@keyframes example {
  from {right: 30px;}
  to {right: 65px;}
}



.floatingMenu li {
    width: 100%;
    float: right;
    list-style: none;
    text-align: right;
    margin-bottom: 5px;
}

.floatingMenu li a {
    display: inline-block;
    color: #fff;
    overflow: hidden;
    white-space: nowrap;
    transition: all 0.4s;
     -webkit-box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.22);
    box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.22); 
    -webkit-box-shadow: 1px 3px 5px rgba(211, 224, 255, 0.5);
    box-shadow: 1px 3px 5px rgba(211, 224, 255, 0.5);
}

.floatingMenu li a:hover {
  box-shadow: rgb(0 0 0 / 70%) 2px 2px 11px;
  -webkit-box-shadow: rgb(0 0 0 / 70%) 2px 2px 11px;
    text-decoration: none;
}

@media only screen and (max-width: 992px)
{
.product8.product article .content {
    padding-bottom: 50px !important;
}
.pagination {
    margin-bottom: 20px !important;
}
.fullwidth-static-banner .parallax-banner-text .hover-link {
    opacity: 1;
    transition-timing-function: ease-in;
    transform: translateY(0px) !important;
    -webkit-transform: translateY(0px) !important;
    transition: 0.4s;
  }
}
@media only screen and (min-width: 768px) and (max-width: 991px)
{
.checkout-area .checkout-module .checkoutd-nav .nav-item {
    width: 20%;
}
}

@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : landscape) {

  #headerOne .dropdown-menu-new {
    width: 195px !important;
}
.pm-0 {
    padding: 0 10px 0 8px;
}

.left-thumb-height .imagespace {
    height: 159px;
}
.desktop_slider_view {
    height: 350px;
}
.group-banners .imagespace-8 {
    margin-bottom: 27px;
}
.center-thumb-18-height
{
  height:177px;
}
.last-thumb-19-height
{
  height:226px;
}
}

@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : portrait) {

  #headerOne .dropdown-menu-new {
    width: 195px !important;
}
.left-thumb-height .imagespace {
    height: 159px;
}
.desktop_slider_view {
    display: block !important;
    height: 350px;
}
.group-banners .imagespace-8 {
    margin-bottom: 24px;
}
.center-thumb-18-height
{
  height:130px;
}
.last-thumb-19-height
{
  height:165px;
}
  
}

@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : portrait) {
    .mobile-mt-10
  {
    margin-top: 15px !important;
  }
  .product article .right-side-badges {
    left: unset !important;
    right: 10px !important;
}
.parallex-banner-desktop
{
  display: none;
}
.parallex-banner-mobile
{
  display: block;
}
.fullwidth-static-banner .parallax-banner-text h2 {
    font-size: 3rem !important;
  }
  .listing .product-action-14 .btn {
    width: 235px;
}

}
@media only screen and (max-width: 768px)
{
  .tab-land-review-33 {
    display: block;
    width: 100%;
}
.mb-center
{
  text-align:center;
}
  .pm-0 {
    padding: 12px;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}
  .cart-sdropdown .dropdown-menu
  {
    transform: translate3d(-233px, 20px, 0px) !important;
  }
  .search_outer_con_mobile {
    left:95px;
}
  .categories-content .slick-prev, .categories-content .slick-next {
    display: none !important;
}
  .left-thumb-height .imagespace {
    height: auto;
}
.header-mobile .header-maxi .navigation-mobile-container #navigation-mobile .sub-manu .unorder-list li a {
    border-bottom: none !important; 
}

.header-mobile .header-maxi .navigation-mobile-container #navigation-mobile .sub-manu .unorder-list li .main-manu{
  border-bottom: none !important;
}

.header-mobile .header-maxi .navigation-mobile-container #navigation-mobile .sub-manu{
    border-bottom: 1px solid white;
}


  .order-2-car3
  {
    order:2;
  }
  .order-3-car3
  {
    order:3;
  }
  .order-1-car3
  {
    order:1;
  }
  .mb-30
  {
    margin-bottom: 30px;
  }

  .fullwidth-banner {
    background-attachment: unset;
}
.parallex-banner-desktop
{
  display: none;
}
.parallex-banner-mobile
{
  display: block;
}


}

@media only screen and (max-width: 767px)
{
  .pro-content .tabs-main .nav-link {
    width: 28% !important;
}

  
  .fullwidth-static-banner .hover-link {
    opacity: 1 !important;
    transition-timing-function: ease-in;
    transform: translateY(0px) !important;
    -webkit-transform: translateY(0px) !important;
  }
  .categories-content .slick-prev, .categories-content .slick-next {
    display: none !important;
}


  .fullwidth-static-banner .parallax-banner-text h2 {
    font-size: 2rem !important;
  }

  .fullwidth-static-banner .parallax-banner-text h4 {
    font-size: 25px !important;
  }


.mar-top-mobile
{
  margin-top: 15px;
}
.mar-top-mobile-3
{
  margin-top: 15px;
}

.mar-bottom-mobile
{
    margin-bottom: 15px;
}
}

@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : landscape) {
    .mobile-mt-10
  {
    margin-top: 15px !important;
  }
  .product article .right-side-badges {
    left: unset !important;
    right: 10px !important;
}
.parallex-banner-desktop
{
  display: none;
}
.parallex-banner-mobile
{
  display: block;
}
.fullwidth-static-banner .parallax-banner-text h2 {
    font-size: 3rem !important;
  }
  .listing .product-action-14 .btn {
    width: 235px;
}

}
@media only screen and (min-width: 992px) and (max-width: 1002px) {
  .product article .desktop-hover .icon {
    width: 38px;
    height: 38px;
}
}

@media only screen and (min-width: 768px) and (max-width: 991px) {
  .sticky-header {
    display: none !important;
  } 
  .mar-bottom-mobile
{
    margin-bottom: 15px;
}
  .contact-2-text-center
  {
    text-align: center;
    margin-bottom: 40px;
  }
  .group-banners .imagespace-13 {
    margin-bottom: 19px !important;
}

}
@media only screen and (min-width: 991px) and (max-width: 1024px) {
  .footer-eight h5 {
    font-size: 0.8rem;
}
.group-banners .imagespace-13 {
    margin-bottom: 25px !important;
}
}




@media (max-width: 767px)
{


  .group-banners .imagespace-13 {
    margin-bottom: 15px !important;
}

  .pro-content .tabs-main a.nav-link.active::before {
    left: 40% !important;
}

  .margin-top-7-mobile
  {
      margin-top: 7px;
  }

  .margin-left-6-mobile
  {
      margin-left: 6px !important;
  }



.mobile-align-check-btn
{
  width: 100%;
  text-align: center;
}
.mobile-mt-10
{
  margin-top: 10px;
}
.text-center-mobile
{
  text-align: center;
}
/* .carousel-content .carousel-item img {
    height: 100% !important;
} */
.desktop_slider_view
{
  display: none !important;
}
.mobile_slider_view
{
  display: block !important;
}

.categories-sec-content .slick-prev
{
    top: -40px;
    right: 60px;
    left: unset;
    z-index: 1000;
}

.categories-sec-content .slick-next
{
    top: -40px;
    right: 30px;
    z-index: 1000;
}
.categories-sec-content .general-product:hover .slick-arrow {
    transform: unset !important;
}


.desktop_cat
{
  display:none !important;
}

.mobile_cat {
    display: block !important;
    width: 95%;
    margin: auto;
}


.categories-content .cat-banner .categories-icon h3 {
    font-size: 10px !important;
    overflow: hidden;
}
.product article .desktop-hover
{
  display: none !important;
}

.product-15 article .desktop-hover
{
  display: block !important;
}
  .alert_btn_fnd {
    justify-content: center;
    margin: auto;
    display: flex;
    padding: 10px;
}
#back-to-top {
    bottom: 41px !important;
}
/* .btn {
     padding: 5px !important; 
} */

      #viewrewardModal .modal-content {
      width:100% !important;
    }
    #conformModal .modal-content {
      width:100% !important;
    }
    #alreadyModal .modal-content {
      width:100% !important;
    }
    #pointlowModal .modal-content {
      width:100% !important;
    }
    #loyalty-mobile-header
    {
      display:block !important;
    }
    #loyalty-desktop-header 
    {
      display:none !important;
    }
    .modal-close-desktop-tab
    {
      display:none !important;
    }
    .loyalty-mobile-header
    {
      display:block !important;
    }
    .loyalty-desktop-header 
    {
      display:none !important;
    }
    #myModalLoyalty .modal-content {
      width: 100% !important;
     
    }
   
    #myModalLoyalty .modal-dialog {
      width: 100% !important;
      height: 100vh !important;

    }
    #loginmyModal .modal-content {
      width: 100% !important;
      height: 100vh !important;
    }
    #loginmyModal .modal-dialog {
      width: 100% !important;

    }
    .modalloyal {
    padding-top: 0px !important;
    }
    .popup-main-left {
    width: 100%;
    }
    #subscribe
    {
      z-index: 100;
    }
    #myModalLoyalty .modal-header {
    height: auto !important;
    padding:5px !important;
    }
    #loginmyModal .modal-sidebars {
    width: 100% !important;
    min-height: auto !important;
}
#loginmyModal .modal-page-con {
    width: 100% !important;
   
}



.loyality-mobile-tab {
    width: 40% !important;
    position: absolute;
    right: 0;
    z-index: 9999;
    height: auto !important;
}
#loginmyModal .tablinks-loyality {
    white-space: nowrap;
}
.bar-icon-tab
{
  font-size: 20px;
    color: white;
    text-align: right;
    display: inline-block;
}
#loginmyModal .sidebar-points-value-tab {
    font-size: 1.1em;
    padding: 12px 5px 0 0;
}


#loginmyModal .sidebar-points-tab {
    display: inline-block;
    color: #fff;
    margin-right: 20px;
}
#loginmyModal .tab-right-headcon
{
  display: inline-block;
    width: 45%;
    text-align: right;
}
.close-tab
{
  display:none;
}
.open-tab
{
  display:block;
}
.help-content {
    height: auto !important;
}

}

@media (max-width: 600px)
{
  .load_more_outer_mobile
  {
    margin: auto;
      margin-bottom: 10px;
  }
  .load_more_outer_mobile .btn
  {
   font-size:11px;
  }
  .categories-content .cat-banner {
     margin-top: 0px; 
}

}

@media only screen and (max-width: 576px)
{
  .mtb30 {
     margin: 0 !important; 
     margin-top: 30px !important; 
}
.col-6 .btn-33:hover {
    padding: 10px 5px;
    width: 100%;
    border-radius: 4px;
    font-size: 0.875rem !important;
}
.col-6 .btn-33 {
    padding: 10px 5px;
    width: 100%;
    border-radius: 4px;
    font-size: 0.875rem !important;
}
.col-6 .btn-38 {
    padding: 10px 5px;
   
}


.new-products-content .title_change
{
  padding-bottom: 0px !important;
}

.pro-fs-content .title_change
{
  padding-bottom: 0px !important;
}
.tabs-content .title_change
{
  padding-bottom: 0px !important;
}
.tabs-content .tabs-main {
    margin-top: 15px !important;
}
.pro-blog .general-product {
    margin-top: 15px;
}
.pm-0 {
    padding: 5px 12px;
}
  .molla_sub_btn_inner {
    margin-top: 15px;
    margin-left: auto;
    margin-right: auto;
}
.molla_sub_btn_outer {
    width: 100%;
}
  .cart-sdropdown .dropdown-menu
  {
    transform: translate3d(-233px, 30px, 0px) !important;
  }
  
  .search_outer_con_mobile {
    left:unset;
    right:0;
}
  .btn-pd {
    padding: 5px 15px !important;
}
.mb-15
  {
    margin-bottom : 15px;
  }

.product article .thumb-size {
   height : 185px !important;
}
.disabled-ratings > label {
    font-size: 10px !important;
}
.col-6 .product2 article .content .price span {
    font-size: 1rem ;
}
.col-6 .product2 article .content .price {
    font-size: 1.2rem ;
}

.col-6 .product article .content .price {
    font-size: 1.2rem;
}
.btn-fs {
    font-size: 1rem;
    padding: 5px 2px !important;
}
.btn-fs12 {
    font-size: 1rem;
}
.product9.product article .content .pricetag .icon {
  width: 30px ;
    height: 30px ;
}
.product9 article .content .price {
    font-size: 1rem ;
}
.product9 article .content .price span {
    font-size: 0.7rem ;
}
.product9.product .thumb .product-action-vertical .icon {
  width: 30px ;
    height: 30px ;
}
.product2 article .pro-hover-icons .icons .icon {
  width: 30px ;
    height: 30px ;
}

.btn-fs15 {
    font-size: 0.8rem;
}
.product-content-15.product article .content
{
  padding: 10px 0 30px 0 ;
}
.product-content-15.product .thumb .product-action-vertical .icon {
    width: 30px;
    height: 30px;
}


.wishlist-content .media-main .media img {
    margin: auto !important;
}

.product2 .pricetag .icon {
  width: 30px ;
    height: 30px ;
}
.product4.product .thumb .product-action-vertical .icon {
    width: 30px;
    height: 30px;
}
.product5.product .thumb .product-action-vertical .icon {
  width: 30px;
    height: 30px;
}
.product6.product article .thumb .product-action-vertical .icon {
  width: 30px;
    height: 30px;
}
.product7.product article .thumb .product-action-vertical .icon {
  width: 30px;
    height: 30px;
}


 .product17.product article .content .btn-secondary {
  width: 40px;
} 
.product18.product article .content .btn-secondary {
  width: 40px;
} 
.slider-wrapper .slider-for .slider-for__item img {
    height: 200px;
}
iframe {
    height: 200px !important;
}
.slider-wrapper .slider-for {
    height: 250px;
}
.slider-wrapper .slider-for-vertical iframe {
    height: 200px !important;
}
.slider-wrapper .slider-for-vertical .slider-for__item img {
    height: 200px;
}
.slider-wrapper .slider-for-vertical {
    height: 250px;
}
.slider-wrapper .slider-for-vertical .slick-list .slick-track .slick-slide img {
    height: 200px;
}

}

        @media only screen and (max-width: 320px)
        {

          .fullwidth-static-banner .parallax-banner-text h2 {
    font-size: 1.5rem !important;
  }
  .body-overflow 
{
  overflow: hidden;
  height : 50vh;
}

  .fullwidth-static-banner .parallax-banner-text h4 {
    font-size: 18px !important;
  }

          .col-6 .product article .content .price {
            font-size: 0.8rem ;
        }
        .col-6 .product article .content .price span {
          font-size: 0.8rem ;
        }

          .btn-pd {
            padding: 5px 12px !important;
        }
        .pro-content .tabs-main .nav-link {
            font-size: 10px;
        }
        .top-bar label {
            width: 90px;
        }
       
        .btn-fs {
            font-size: 0.7rem;
            padding: 5px 2px !important;
        }
        .product article .content {
            padding: 10px 5px !important;
        }
        .btn-fs12 {
            font-size: 0.7rem;
        }
        .btn-fs15 {
            font-size: 0.8rem;
        }
        .product-content-15.product article .content
        {
          padding: 10px 0 30px 0 !important;
        }
        .product-content-15.product .thumb .product-action-vertical .icon {
            width: 25px;
            height: 25px;
        }

        .product8.product article .content {
            padding-bottom: 45px !important;
        }
        .product9.product article .content .pricetag .icon {
          width: 25px ;
            height: 25px ;
        }
        .col-6 .product9 article .content .price {
            font-size: 0.9rem ;
        }
        .col-6 .product9 article .content .price span {
            font-size: 0.6rem ;
        }
        .col-6 .product9.product .thumb .product-action-vertical .icon {
          width: 25px ;
            height: 25px ;
        }
        .col-6 .product2 article .pro-hover-icons .icons .icon {
          width: 30px ;
            height: 30px ;
        }
        .col-6 .product2 article .content .price span {
            font-size: 0.8rem ;
        }
        .col-6 .product2 article .content .price {
            font-size: 0.8rem ;
        }
        .disabled-ratings > label {
            font-size: 8px !important;
        }
        .col-6 .product article .title {
            font-size: 12px !important;
        }

        .col-6 .product4.product .thumb .product-action-vertical .icon {
            width: 25px;
            height: 25px;
        }
        .col-6 .product5.product .thumb .product-action-vertical .icon {
          width: 25px;
            height: 25px;
        }
        .col-6 .product6.product article .thumb .product-action-vertical .icon{
          width: 25px;
            height: 25px;
        }
        .col-6 .product7.product article .thumb .product-action-vertical .icon {
          width: 25px;
            height: 25px;
        }
        }

    @media only screen and (max-width: 280px)
    {
      .disabled-ratings > label {
        font-size: 5px !important;
    }
    .pro-content .tabs-main .nav-link {
        font-size: 9px;
    }
    .product4.product .thumb .product-action-vertical .icon {
        width: 25px;
        height: 25px;
    }
    .top-bar label {
        width: 65px;
    }

    .product-content-15.product article .content
    {
      padding: 10px 0 30px 0 !important;
    }
    .product-content-15.product .thumb .product-action-vertical .icon {
        width: 25px;
        height: 25px;
    }

    .btn-pd {
        padding: 5px 10px !important;
    }

    .btn-fs15 {
        font-size: 0.7rem;
    }

    .product article .title {
        font-size: 12px !important;
    }

    .col-6 .product article .content .price span {
        font-size: 0.6rem ;
    }
    .col-6 .product article .content .price {
        font-size: 0.8rem ;
    }
    .product article .mobile-icons .icon {
        width: 30px ;
        height: 30px ;
    }
    .product2 article .pro-hover-icons .icons .icon {
      width: 25px ;
        height: 25px ;
    }
    .col-6 .product2 article .content .price span {
        font-size: 0.8rem ;
    }
    .col-6 .product2 article .content .price {
        font-size: 0.8rem ;
    }
    .col-6 .product2 .pricetag .icon {
      width: 25px ;
        height: 25px ;
    }

    .btn-fs {
        font-size: 0.55rem;
        padding: 5px 1px !important;
    }
    .btn-fs12 {
        font-size: 0.55rem;
    }
    .product5.product .thumb .product-action-vertical .icon {
      width: 30px ;
        height: 30px ;
    }
    .product9.product article .content .pricetag .icon {
      width: 25px ;
        height: 25px ;
    }
    .product9 article .content .price {
        font-size: 0.6rem ;
    }
    .product9 article .content .price span {
        font-size: 0.5rem ;
    }
    .product9.product .thumb .product-action-vertical .icon {
      width: 25px ;
        height: 25px ;
    }
    .product5.product .thumb .product-action-vertical .icon {
      width: 25px;
        height: 25px;
    }
    .product6.product article .thumb .product-action-vertical .icon {
      width: 25px;
        height: 25px;
    }
    .product7.product article .thumb .product-action-vertical .icon {
      width: 25px;
        height: 25px;
    }
    }
    
</style>