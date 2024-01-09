<style>


.demo-22-sub-btn-hover:hover
{
   color: #333 !important;
}
#subscribe-17-main .subscribe-13-outer-pad
{
    padding: 65px 0 95px 0;
    position: relative;
    border:.1rem solid #ebebeb;
    height:517px;
}
[class*=color-scheme-]:not(.color-scheme-none) input, [class*=color-scheme-]:not(.color-scheme-none) textarea {
    color: #000;
    color: var(--colorTextBody);
    background-color: #fff;
    background-color: var(--colorBody);
}
#subscribe-17-main .input-group-field {
    flex: 1 1 auto;
    margin: 0;
    min-width: 0;
}
#subscribe-17-main input, #subscribe-17-main select, #subscribe-17-main textarea {
    border: 0px solid !important;
    border-color: #e8e8e1 !important;
    max-width: 100%;
    padding: 8px 20px;
    -webkit-box-shadow: 0 8px 10px rgb(51 51 51 / 5%);
    box-shadow: 0 8px 10px rgb(51 51 51 / 5%);
    border: 0.1rem solid #e1e1e1 !important;
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
#subscribe-17-main .color-scheme-2 .btn {
    color: #fff;
    color: var(--colorScheme2Bg);
    background-color: #000;
    background-color: var(--colorScheme2Text);
}
#subscribe-17-main .input-group-btn {
    flex: 0 1 auto;
    margin: 0;
    display: flex;
}


#subscribe-17-main .subscribe-13-inner-content{
    max-width: 650px;
    padding:0 40px;
    margin: 0 auto;
    text-align:center;

}
#subscribe-17-main .subscribe-13-inner-content .h2{
    font-weight: 700;
    letter-spacing: -.01em;
    color: #000 !important;
    margin: 0;
    font-size: 1.4rem;
    text-transform:uppercase;
}

#subscribe-17-main .subscribe-13-inner-content .h2s{
    font-weight: 700;
    letter-spacing: -.01em;
    color: #000 !important;
    margin: 0;
    font-size: 3.15rem;
   
}

#subscribe-17-main .theme-block {
    margin-bottom: 10px;
}

#subscribe-17-main .theme-block1 {
    margin-bottom: 20px;
}

.newsletter__input-group:last-of-type {
    margin-bottom: 0;
}
.newsletter__input-group {
    margin: 0 auto 20px;
    max-width: 400px;
}
.subscribe-13-p
{
    font-size:16px;
    margin:0;
    color:#000 !important;
    font-weight:300 !important;
}

.subscribe-2-btns{
    text-transform:initial;
    min-width: 130px;
    padding: 0.6rem 1.3rem !important;

}

#subscribe-17-main .btn-secondary:hover {
    color: #fff !important;
    background-color: #ffd04d !important;
    border-color: #ffd04d !important;
}

.subscribe-13-image {
    position: absolute;
    width: 100%;
    height:517px;
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
.subscribe-13-btn
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
.subscribe-13-input-outer
{
    color: #000;
    background:#fff;
}
.subscribe-13-text-desk
{
    display:block;
}
.subscribe-13-text-mobile
{
    display:none;
}

#subscribe-17-main input::placeholder{
    font-size:14px !important
}

#subscribe-17-main{
    padding:0 15px;
    /* background:#fafafa!important; */
}

@media only screen and (max-width: 992px)
{
    #subscribe-17-main {
        margin: 0px 0px 0px 0px;
    }
}

@media only screen and (max-width: 768px)
{



    .subscribe-13-text-desk
{
    display:none;
}
.subscribe-13-text-mobile
{
    display:block;
}

#subscribe-17-main .subscribe-13-outer-pad
{
    padding: 40px 0;
}
#subscribe-17-main .subscribe-13-inner-content {
    max-width: 80%;
}
#subscribe-17-main .subscribe-13-inner-content .h2 {
    font-size: 20px;
}
.subscribe-13-p {
    font-size: 14px;
}
}
.mobile-group{
    width:100%;
}
@media only screen and (max-width: 768px)
{
    #subscribe-17-main .subscribe-13-inner-content {
    padding:0 10px;
}
    .molla_sub_btn_inner{
        width:100%;
    }
}

@media only screen and (max-width: 540px)
{
    #subscribe-17-main .subscribe-13-inner-content {
        max-width: 100%;
    }
    .molla_sub_btn_inner {
        width: 50% !important;
    }   
    #subscribe-17-main .theme-block {
        margin-bottom: 5px;
    }
    /* .subscribe-2-btns {
  
    border-radius: 0.3rem !important;
} */
    #subscribe-17-main input, #subscribe-17-main select, #subscribe-17-main textarea {
   
    max-width: 80%;
   
    margin: auto !important;
}
#subscribe-17-main {
    padding: 0 10px;
    /* background: #fafafa!important; */
}
}

</style>
<?php   $subscribe = DB::table('home_subscribe')
        ->leftJoin('image_categories', 'home_subscribe.subscribe_image_id', 'image_categories.image_id')
        ->select('home_subscribe.*', 'image_categories.path_type as image_path_type', 'image_categories.path as image_path')
        ->where('image_type', 'ACTUAL')
        ->first(); if($subscribe !='') {?>
<div id="subscribe-17-main">
    <div class="subscribe-13-outer-pad">
        <img class="subscribe-13-image"  src="{{asset($subscribe->image_path)}}">
        <div class="subscribe-13-inner-content">
            <div class="theme-block">
                <p class="h2">New Customer Discount</p>
            </div>
            <div class="theme-block">
                <p class="h2s">{{ $subscribe->subscribe_title }}</p>
            </div>
            <div class="theme-block1">
                <p class="subscribe-13-p">{{ $subscribe->subscribe_description }}</p>
            </div>
            <div class="">
            <form action="{{url('subscribeMail')}}"  class="mailchimp-form">
            <!-- <div class="g-recaptcha" style="margin-bottom:5px;" data-sitekey="6LcgaOIlAAAAANQ9-qy97ERNTHeRVjnFgiwRiK90"></div> 
                      <div class="captca" style="margin-bottom:30px;">please verify you are human! </div> -->
                      <div class=" d-flex justify-content-end justify-content-center">
                <div class="input-group mobile-group">
                  <input style="height: calc(3rem + 5px);" type="email" name="email" class="form-control mr-0 font-weight-normal border-0" placeholder="Enter your Email Address" aria-label="Email Adress" required="">
                  <div class="input-group-append molla_sub_btn_outer" >
                    <button  id="mc-embedded-subscribe" class="btn subscribe-2-btns demo-22-sub-btn-hover molla_sub_btn_inner btn-secondary common-bg-hover" type="submit"><span style="font-weight: 700;letter-spacing: -0.01em;font-size:1rem">SUBSCRIBE</span></button>
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