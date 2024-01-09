<!DOCTYPE html>
<html style="background: #ebebeb;">
  <head>
    <title>REVIEW ORDER</title>
    <meta charset="utf-8">
    <meta name="description" content="QRCODE Scanning">
    <meta name="keywords" content="QRCODE Scanning">
    <meta name="author" content="Platinum Code">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name = "viewport" content = "width=device-width, minimum-scale=1.0, maximum-scale = 1.0, user-scalable = no">
    @php
      $color_style = DB::table('settings')->where('id',236)->first();
      $color = DB::table('settings')->where('id',237)->first();
      $country_id = DB::table('settings')->where('id',235)->first();
      $tax_class = DB::table('settings')->where('id',234)->first();
      $inv = DB::table('settings')->where('id',145)->first();

      if(session('language_id') == '')
      {
        $language_id = 1;
      }
      else
      {
        $language_id = session('language_id');
      }
      $label1 = DB::table('table_label_value')->where('label_id',11)->where('language_id', '=', $language_id)->first();
      $label2 = DB::table('table_label_value')->where('label_id',20)->where('language_id', '=', $language_id)->first();
      $label3 = DB::table('table_label_value')->where('label_id',21)->where('language_id', '=', $language_id)->first();
      $label4 = DB::table('table_label_value')->where('label_id',22)->where('language_id', '=', $language_id)->first();
    @endphp
       
    <link rel="stylesheet" type="text/css" href="{{asset('web/table').'/'.$color_style->value}}.css">
    <link rel="stylesheet" href="{{asset('web/table/font-awesome/css/all.min.css')}}">
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('web/css/stripe.css') }}" data-rel-css="" />
  </head>
  <body>
    <style>
      .header-title {
        padding: 20px;
        text-align: center;
        color: #fff;
        position: relative;
        width: 85%;
        margin:auto;
      }
body
{
  background: #ebebeb;
}
      .header-inner-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
        width: 85%;
        margin: auto;
        height:40px;
        border-radius: 30px;
        position: relative;
      }
      .header-content
      {
          padding-bottom: 30px;
      }
      .center-content-outer
      {
        margin-top: 40%;
      }
      .center-content {
   padding-bottom: 10px;
    width: 85%;
    margin: auto;
 position: relative;
    background: #fff;
    box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
    text-align: center; /* Center the image horizontally */
  
}
.profile-view-img-circle {
  position: absolute;
    top: -130px;
    left: 0;
    right: 0;
}
.profile-view-img-circle img
{
  width: 10rem;
    height: 10rem;
    border-radius: 50%;

}
.profile-detail
{
  padding-top:50px;
}
.logout-btn
{
padding: 10px 25px;

width: 50%;
    margin: auto;
    border-radius: 30px;
    color: #fff;
    margin-top: 30px;
    margin-bottom: 30px;
}
    </style>
    <h1 class="pc-title mobile-none">This Site Only View on Mobile And Tab</h1>
    <div class="pc-mobile-tab">
      <div class="common-bg">
        <div class="header">
          <div class="header-title">
              <a href="javascript:history.back()" style="position:absolute;left:0;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="" style="color:#fff;" viewBox="0 0 24 24"><g id="evaArrowBackFill0"><g id="evaArrowBackFill1"><path id="evaArrowBackFill2" fill="currentColor" d="M19 11H7.14l3.63-4.36a1 1 0 1 0-1.54-1.28l-5 6a1.19 1.19 0 0 0-.09.15c0 .05 0 .08-.07.13A1 1 0 0 0 4 12a1 1 0 0 0 .07.36c0 .05 0 .08.07.13a1.19 1.19 0 0 0 .09.15l5 6A1 1 0 0 0 10 19a1 1 0 0 0 .64-.23a1 1 0 0 0 .13-1.41L7.14 13H19a1 1 0 0 0 0-2Z"/></g></g></svg>
              </a>
            <h1>Profile</h1>
          </div>
        
        
          <div class="header-content">
            <div class="header-inner-content">
              <div style="display:flex;align-items:center;width:50%;">
                <svg xmlns="http://www.w3.org/2000/svg" style="margin-left:15px;margin-right:5px;fill:#ffaa25;" width="24" height="24" viewBox="0 0 36 36"><path  d="M30.61 24.52a17.16 17.16 0 0 0-25.22 0a1.51 1.51 0 0 0-.39 1v6A1.5 1.5 0 0 0 6.5 33h23a1.5 1.5 0 0 0 1.5-1.5v-6a1.51 1.51 0 0 0-.39-.98Z" class="clr-i-solid clr-i-solid-path-1"/><circle cx="18" cy="10" r="7" class="clr-i-solid clr-i-solid-path-2"/><path fill="none" d="M0 0h36v36H0z"/></svg>
                {{ $user->first_name }}
                </div>
                <div style="display:flex;align-items:center;width:50%;">
                <svg xmlns="http://www.w3.org/2000/svg" style="margin-left:15px;margin-right:5px;" class="common-fill" width="24" height="24" viewBox="-2 -1.5 24 24"><path  d="M9 13.858h-.051A.949.949 0 0 1 8 12.909a1 1 0 1 0-2 0a2.949 2.949 0 0 0 2.949 2.949H9v1a1 1 0 0 0 2 0v-1a3 3 0 0 0 0-6v-2h.022c.54 0 .978.438.978.978a1 1 0 0 0 2 0a2.978 2.978 0 0 0-2.978-2.978H11v-1a1 1 0 0 0-2 0v1a3 3 0 1 0 0 6v2zm2 0v-2a1 1 0 0 1 0 2zm-2-6v2a1 1 0 1 1 0-2zm1 13c-5.523 0-10-4.477-10-10s4.477-10 10-10s10 4.477 10 10s-4.477 10-10 10z"/></svg> {{Session::get('symbol_left')}} {{ $user->wallet_amount }} {{Session::get('symbol_right')}}</div>
            </div>
          </div>
        </div>

      </div>   
      
      
      <div class="center-content-outer">
        <div class="center-content">
          <div class="profile-view-img-circle">
            <?php $avatar = auth()->guard('customer')->user()->avatar; ?>
            @if($avatar == '' )
              <img class="profile-view-main-left-image" src="{{ asset('images/user.png') }}" alt="">
            @else
              <img class="profile-view-main-left-image"  src="{{ asset('').$avatar }}" alt="">
            @endif
          </div>


          <div class="profile-detail">
        
            <div style="display:flex;margin-bottom: 5px;">
              <div style="width: 50%;text-align: right;margin-right: 20px;">Full Name</div>
              <div style="width: 50%;text-align: left;">: {{$user->first_name}} {{$user->last_name}}</div>
            </div>
            <div style="display:flex;margin-bottom: 5px;">
              <div style="width: 50%;text-align: right;margin-right: 20px;">Level</div>
              <div style="width: 50%;text-align: left;">: <?php  $level = DB::table('member_type')->where('id', auth()->guard('customer')->user()->users_level)->first(); if($level != ''){ echo $level->member_type_name;}else {echo 'Normal';} ?></div>
            </div>
            <div style="display:flex;margin-bottom: 5px;">
              <div style="width: 50%;text-align: right;margin-right: 20px;">Mobile</div>
              <div style="width: 50%;text-align: left;">: {{$user->phone}}</div>
            </div>
          </div>

          <div class="logout-container">
            <a href="qrcodelogout"><div class="common-bg logout-btn">Logout</div></a>
          </div>
        </div>
      </div>
    </div>

  </body>
  <script>

  </script>
</html>



