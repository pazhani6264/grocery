<style>
#subscribe-1-main .subscribe-1-outer-pad
{
    padding: 60px 0;
    position: relative;
    height:425px;
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
    border: 1px solid !important;
    border-color: #e8e8e1 !important;
    max-width: 100%;
    padding: 8px 10px;
    border-radius: 0;
}
.subscribe-1-btn:hover {
    color: #fff !important;
    text-decoration: none;
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
    max-width: 700px;
    padding:0 40px;
    margin: 0 auto;
    text-align:center;

}
#subscribe-1-main .subscribe-1-inner-content .h2{
    font-weight: 900;
    letter-spacing: 1px;
    color: #000 !important;
    margin:0;

}

#subscribe-1-main .theme-block {
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
    font-size:18px;
    margin:0;
}


.subscribe-1-image {
    position: absolute;
    width: 100%;
    height: 425px;
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
   
    color: #fff;
    font-size: 15px;
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
    width: 400px;
    color: #000;
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
    max-width: 380px;
}
#subscribe-1-main .subscribe-1-inner-content .h2 {
    font-size: 18px;
}
.subscribe-1-p {
    font-size: 14px;
}
}
@media only screen and (max-width: 768px)
{
    #subscribe-1-main .subscribe-1-inner-content {
    padding:0 20px;
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
            <div class="theme-block">
                <p class="subscribe-1-p">{{ $subscribe->subscribe_description }}</p>
            </div>
            <div class="">
            <form action="{{url('subscribeMail')}}"  class="mailchimp-form">

            <!-- <div class="g-recaptcha" style="margin-bottom:5px;" data-sitekey="6LcgaOIlAAAAANQ9-qy97ERNTHeRVjnFgiwRiK90"></div> 
                      <div class="captca" style="margin-bottom:30px;">please verify you are human! </div> -->
                      <div class=" d-flex justify-content-end justify-content-center">
                <div class="input-group subscribe-1-input-outer">
                  <input style="height: calc(3rem + 5px);" type="email" name="email" class="form-control mr-0 font-weight-normal border-0" placeholder="Enter your Email Address" aria-label="Email Adress" required="">
                  <div class="input-group-append">
                    <button id="mc-embedded-subscribe " class="btn subscribe-1-btn btn-secondary" type="submit"><span class="subscribe-1-text-desk">Subscribe</span> <i  class="fa fa-long-arrow-right mr-0 mt-0 subscribe-1-text-mobile"></i></button>
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