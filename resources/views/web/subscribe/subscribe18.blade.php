<style>

#subscribe-1-main .subscribe-1-outer-pad
{
    padding: 4.7rem 0 2rem 0;
    position: relative;
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
.subscribe-8-btn {
    text-transform: initial;
    background: #9ACE69;
    padding: 8px 15px !important;
    min-width: 70px;
}
#subscribe-1-main input, #subscribe-1-main select, #subscribe-1-main textarea {
    border-bottom: 1px solid !important;
    border-color: #222 !important;
    max-width: 100%;
    padding: 8px 10px;
    border-radius: 0;
}
#subscribe-1-main input:focus {
    border-bottom: .1rem solid #222 !important;
    border-top: 0px solid #222 !important;
    border-left: 0px solid #222 !important;
    border-right: 0px solid #222 !important;
}
.molla_sub_btn_inner8:hover{
    color:#333 !important;
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


#subscribe-1-main .subscribe-1-inner-content{
    padding:0 40px;
    margin: 0 auto;
    text-align:center;

}
#subscribe-1-main .subscribe-1-inner-contents{
    max-width: 650px;
    padding:0 40px;
    margin: 0 auto;
    text-align:center;

}
#subscribe-1-main .subscribe-1-inner-content .h2{
    font-weight: 600;
    letter-spacing: -.0em;
    color: #000 !important;
    margin: 0;
    font-size: 0.9rem;
    text-transform:initial;
}

#subscribe-1-main .theme-block {
    margin-bottom: 5px;
}

#subscribe-1-main .theme-block1 {
    margin-bottom: 50px;
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
    font-size:30px;
    margin:0;
    color:#333 !important;
    font-weight: 300 !important;
}

.molla_sub_btn_outer8{
    border-bottom:.1rem solid #222;
}
.molla_sub_btn_inner8{
    padding: 0.6rem 1rem;
}


.subscribe-1-image {
    position: absolute;
    width: 100%;
    height: 100%;
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
@media only screen and (max-width: 768px)
{
    #subscribe-1-main .subscribe-1-inner-contents {
    max-width: 100%;
    padding: 0 20px;
    margin: 0 auto;
    text-align: center;
}
  

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
    padding: 4.7rem 0 2rem 0;
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
}
.mobile-group{
    width:100%;
}







@media only screen and (max-width: 768px)
{
    #subscribe-1-main .subscribe-1-inner-content {
    padding:0 10px;
}
    .molla_sub_btn_inner8{
        width:100%;
    }
}

@media only screen and (max-width: 540px)
{
    #subscribe-1-main .subscribe-1-inner-content {
        max-width: 100%;
    }
    .molla_sub_btn_inner8 {
        width: 100% !important;
    }   
    #subscribe-1-main .theme-block {
        margin-bottom: 5px;
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
            <div class="subscribe-1-inner-content">
                <div class="theme-block">
                    <p class="h2" style="text-transform:initial">{{ $subscribe->subscribe_title }}</p>
                </div>
                <div class="theme-block1">
                    <p class="subscribe-1-p">{{ $subscribe->subscribe_description }}</p>
                </div>
            </div>
            <div class="subscribe-1-inner-contents">
                <form action="{{url('subscribeMail')}}"  class="mailchimp-form">
                <!-- <div class="g-recaptcha" style="margin-bottom:5px;" data-sitekey="6LcgaOIlAAAAANQ9-qy97ERNTHeRVjnFgiwRiK90"></div> 
                      <div class="captca" style="margin-bottom:30px;">please verify you are human! </div> -->
                      <div class=" d-flex justify-content-end justify-content-center">
                    <div class="input-group mobile-group">
                    <input style="height: calc(3rem + 5px);" type="email" name="email" class="form-control mr-0 font-weight-normal border-0" placeholder="Enter your Email Address" aria-label="Email Adress" required="">
                    <div class="input-group-append molla_sub_btn_outer8" >
                        <button  id="mc-embedded-subscribe" class="btn common-text  molla_sub_btn_inner8" type="submit"><span style="font-weight: 500;letter-spacing: -0.02em;font-size:1rem;letter-spacing:.1em">SUBSCRIBE</span></button>
                    </div>
                    <div class="alert alert-success alert-dismissible success-subscribte" role="alert" style="opacity: 500; display: none;"></div>
                        <div class="alert alert-danger alert-dismissible error-subscribte" role="alert" style="opacity: 500; display: none;"></div>
                    </div>
                    </div>
                </form>
            </div>
    </div>
</div>
<?php  } ?>