<!DOCTYPE html>
<html>
    <head>
        <title>SUCCESS</title>
        <meta charset="utf-8">
        <meta name="description" content="QRCODE Scanning">
        <meta name="keywords" content="QRCODE Scanning">
        <meta name="author" content="Platinum Code">
        <meta name = "viewport" content = "width=device-width, minimum-scale=1.0, maximum-scale = 1.0, user-scalable = no">
       
        @php
        $color_style = DB::table('settings')->where('id',236)->first();
        $color = DB::table('settings')->where('id',237)->first();
		$inv = DB::table('settings')->where('id',145)->first();
        
    @endphp
    <style>
            .pc-in-main-success {
    border: 0px solid;
    padding: 2rem 20px 0rem 20px;
}


.pc-in-button-main {
    position: fixed;
    width: 95%;
    left: 0;
    right: 0;
    bottom: 20px;
}
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('web/table').'/'.$color_style->value}}.css">
        <link rel="stylesheet" href="{{asset('web/table/font-awesome/css/all.min.css')}}">
    </head>
    <body>
        <h1 class="pc-title mobile-none">This Site Only View on Mobile And Tab</h1>
        <div class="pc-mobile-tab in-main">
            <div class="pc-in-main-success">
                <div class="pc-in-logo">
                    <!-- <img src="img/logo.png" alt="Logo"> -->

                    @if($result['commonContent']['settings']['sitename_logo']=='name')
                        <?=stripslashes($result['commonContent']['settings']['website_name'])?>
                    @endif
                
                    @if($result['commonContent']['settings']['sitename_logo']=='logo')
                        <?php 
                            $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['website_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 
                        ?>
                        @if($imagepath->path_type == 'aws')
                            <img src="{{$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                        @else
                            <img  src="{{asset('').$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                        @endif
                    @endif
                </div>
                <div class="pc-success-main-img" style="display: flex;align-items: center;justify-content: center;">
                    <!-- <img src="{{asset('web/table/img/success.png')}}" alt="Success"> -->
                    @if(session('tablepaystatus') == 3)
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24"><path fill="green" d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10s10-4.5 10-10S17.5 2 12 2m0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m4.59-12.42L10 14.17l-2.59-2.58L6 13l4 4l8-8l-1.41-1.42Z"/></svg>
                    @elseif(session('tablepaystatus') == 2)
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24"><path fill="green" d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10s10-4.5 10-10S17.5 2 12 2m0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m4.59-12.42L10 14.17l-2.59-2.58L6 13l4 4l8-8l-1.41-1.42Z"/></svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24"><path fill="red" d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6L8.4 17Zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Zm0-2q3.35 0 5.675-2.325T20 12q0-3.35-2.325-5.675T12 4Q8.65 4 6.325 6.325T4 12q0 3.35 2.325 5.675T12 20Zm0-8Z"/></svg>
                        
                    @endif

                </div>
                <div class="pc-success-text-main">
                    @if(session('tablepaystatus') == 3)
                        <div class="pc-success-text-title">Your order successfully sent</div>
                        <div class="pc-success-text-title">您的订单已成功发送</div>
                    @elseif(session('tablepaystatus') == 2)
                        <div class="pc-success-text-title">Your order successfully sent</div>
                        <div class="pc-success-text-title">您的订单已成功发送</div>
                    @else
                        <div class="pc-success-text-title">Your Online Payment Failed</div>
                        <div class="pc-success-text-title">您的在线支付失败</div>
                    @endif

                </div>
                <div class="pc-in-button-main">
                    <a href="{{url('/qrcodeorder')}}">
                        <button type="submit" class="pc-success-button common-bg">Back to main page</button>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>