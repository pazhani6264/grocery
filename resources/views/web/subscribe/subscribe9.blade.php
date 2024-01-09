<style>
 
#subscribe-1-main .subscribe-1-outer-pad
{
    padding: 50px 0;
    position: relative;
    height:374px !important;
}
#subscribe-1-main input:focus {
    border: 0px solid  !important;
}
[class*=color-scheme-]:not(.color-scheme-none) input, [class*=color-scheme-]:not(.color-scheme-none) textarea {
    color: #000;
    color: var(--colorTextBody);
    background-color: #fff;
    background-color: var(--colorBody);
}
#subscribe-1-main .input-group-field {
    flex: 1 1 auto;
    margin: 0;
    min-width: 0;
}
#subscribe-1-main input, #subscribe-1-main select, #subscribe-1-main textarea {
    border: 0px solid !important;
    border-color: #e8e8e1 !important;
    max-width: 100%;
    padding: 8px 20px;
    border-top-left-radius: 50px;
    border-bottom-left-radius: 50px;
    background-color: #f4f4f4;
}

.color-scheme-2 .btn {
    color: #fff;
    color: var(--colorScheme2Bg);
    background-color: #000;
    background-color: var(--colorScheme2Text);
}

.form__submit--large {
    display: block;
}
.form__submit--small {
    display: none;
}
#subscribe-1-main .color-scheme-2 .btn {
    color: #fff;
    color: var(--colorScheme2Bg);
    background-color: #000;
    background-color: var(--colorScheme2Text);
}
#subscribe-1-main .input-group-btn {
    flex: 0 1 auto;
    margin: 0;
    display: flex;
}

.fill-color-long-sub
  {
    fill:#333;
  }
  .fill-color-long-sub:hover
  {
    fill:#fff;
  }



#subscribe-1-main .subscribe-1-inner-content{
    max-width: 650px;
    padding:0 40px;
    margin: 0 auto;
    text-align:center;

}
#subscribe-1-main .subscribe-1-inner-content .h2{
    font-weight: 600;
    letter-spacing: -.0em;
    color: #fff !important;
    margin: 0;
    font-size: 1.7rem;
}

#subscribe-1-main .theme-block {
    margin-bottom: 5px;
}

#subscribe-1-main .theme-block1 {
    margin-bottom: 30px;
}

.newsletter__input-group:last-of-type {
    margin-bottom: 0;
}
.newsletter__input-group {
    margin: 0 auto 20px;
    max-width: 400px;
}
.subscribe-1-p
{
    font-size:16px;
    margin:0;
    color:#fff !important;
    font-weight:300 !important;
}

.subscribe-2-btn{
    text-transform:initial;
    border-top-right-radius:50px !important;
    border-bottom-right-radius:50px !important;
    min-width: 160px;
}

.subscribe-1-image {
    position: absolute;
    width: 100%;
    height:374px !important;
    top: 0;
    left: 0;
    z-index: -1;
    display: block;
    width: 100%;
    -o-object-fit: cover;
    object-fit: cover;
    pointer-events: none;
    mix-blend-mode: multiply;
}
.subscribe-1-btn
{
    background: #fff;
    color: #000;
    font-size: 12px;
    font-weight: 700 !important;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid transparent;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid transparent;
}
.subscribe-1-input-outer
{
    color: #000;
    background:#fff;
}
.subscribe-1-text-desk
{
    display:block;
}
.subscribe-1-text-mobile
{
    display:none;
}

#subscribe-1-main input::placeholder{
    font-size:14px !important
}
@media only screen and (max-width: 768px)
{



    .subscribe-1-text-desk
{
    display:none;
}
.subscribe-1-text-mobile
{
    display:block;
}

#subscribe-1-main .subscribe-1-outer-pad
{
    padding: 40px 0;
}
#subscribe-1-main .subscribe-1-inner-content {
    max-width: 80%;
}
#subscribe-1-main .subscribe-1-inner-content .h2 {
    font-size: 20px;
}
.subscribe-1-p {
    font-size: 14px;
}



.molla_sub_btn_inner {
    margin-top: 0px !important;
    margin-left: auto;
}
#subscribe-1-main .theme-block {
    margin-bottom: 10px;
}

}

@media only screen and (max-width: 600px)
{
.molla_sub_btn_outer {
    background-color: transparent !important;
    border-top-right-radius: 0px;
    border-bottom-right-radius: 0px;
    margin-top:10px !important;
}
.input-group > .form-control:not(:last-child), .input-group > .custom-select:not(:last-child) {
    border-top-right-radius: 50px;
    border-bottom-right-radius: 50px;
}
}




.mobile-group{
    width:100%;
}

#subscribe-1-main input::placeholder{
    font-style:italic;
}

.molla_sub_btn_outer{
    background-color: #f4f4f4;
    border-top-right-radius:50px;
    border-bottom-right-radius:50px;
}

.input-group > .input-group-append > .btn, .input-group > .input-group-append > .input-group-text, .input-group > .input-group-prepend:not(:first-child) > .btn, .input-group > .input-group-prepend:not(:first-child) > .input-group-text, .input-group > .input-group-prepend:first-child > .btn:not(:first-child), .input-group > .input-group-prepend:first-child > .input-group-text:not(:first-child){
    border-top-left-radius:50px;
    border-bottom-left-radius:50px;
}
.subscribe-2-btn {
    background:#fff;
}
@media only screen and (max-width: 768px)
{
    #subscribe-1-main .subscribe-1-inner-content {
    padding:0 10px;
}
    .molla_sub_btn_inner{
        width:100%;
    }
}

@media only screen and (max-width: 540px)
{
    #subscribe-1-main .subscribe-1-inner-content {
        max-width: 100%;
    }
    .molla_sub_btn_inner {
        width: 50% !important;
    }  
}

</style>
<?php   $subscribe = DB::table('home_subscribe')
        ->leftJoin('image_categories', 'home_subscribe.subscribe_image_id', 'image_categories.image_id')
        ->select('home_subscribe.*', 'image_categories.path_type as image_path_type', 'image_categories.path as image_path')
        ->where('image_type', 'ACTUAL')
        ->first(); if($subscribe !='') {?>
<div id="subscribe-1-main">
    <div class="subscribe-1-outer-pad">
        <img class="subscribe-1-image"  src="{{asset($subscribe->image_path)}}">
        <div class="subscribe-1-inner-content">
            <div class="theme-block">
                <p class="h2">{{ $subscribe->subscribe_title }}</p>
            </div>
            <div class="theme-block1">
                <p class="subscribe-1-p">{{ $subscribe->subscribe_description }}</p>
            </div>
            <div class="">
            <form action="{{url('subscribeMail')}}"  class="mailchimp-form">
            <!-- <div class="g-recaptcha" style="margin-bottom:5px;" data-sitekey="6LcgaOIlAAAAANQ9-qy97ERNTHeRVjnFgiwRiK90"></div> 
                      <div class="captca" style="margin-bottom:30px;">please verify you are human! </div> -->
                      <div class=" d-flex justify-content-end justify-content-center">
                <div class="input-group mobile-group">
                  <input style="height: calc(3rem + 5px);" type="email" name="email" class="form-control mr-0 font-weight-normal border-0" placeholder="Enter your Email Address" aria-label="Email Adress" required="">
                  <div class="input-group-append molla_sub_btn_outer" >
                    <button  id="mc-embedded-subscribe" class="btn subscribe-2-btn molla_sub_btn_inner common-hover fill-color-long-sub" type="submit"><span style="font-weight: 400;letter-spacing: -0.02em;font-size:1rem">SUBSCRIBE <svg xmlns="http://www.w3.org/2000/svg" width="11" height="17" viewBox="0 0 33.908 19.619" style="margin-left: 10px;">
             <path id="arrow_right" d="M28.861,11.627a1.335,1.335,0,0,0-.01,1.88l6.212,6.223L6.928,19.342a1.328,1.328,0,0,0,0,2.657l28.125.388-6.212,6.223a1.345,1.345,0,0,0,.01,1.88,1.323,1.323,0,0,0,1.87-.01L39.14,22h0a1.492,1.492,0,0,0,.276-.419,1.268,1.268,0,0,0,.1-.511,1.332,1.332,0,0,0-.378-.93l-8.42-8.481A1.3,1.3,0,0,0,28.861,11.627Z" transform="translate(-5.61 -11.252)"/>
           </svg></span></button>
                  </div>
                  <div class="alert alert-success alert-dismissible success-subscribte" role="alert" style="opacity: 500; display: none;"></div>
                    <div class="alert alert-danger alert-dismissible error-subscribte" role="alert" style="opacity: 500; display: none;"></div>
                </div>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
<?php  } ?>