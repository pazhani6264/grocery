<style>
    .sub10{
        height:285px;
    }
    .sub10 .row{
        margin-left:-10px;
        margin-right:-10px;
    }
  
#subscribe-1-main .subscribe-1-outer-pad
{
    padding: 3.65rem 0;
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
#subscribe-1-main input, #subscribe-1-main select, #subscribe-1-main textarea {
    border: 1px solid !important;
    border-color: #dadada !important;
    max-width: 100%;
    padding: 8px 20px;
    border-radius: 0;
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
    text-align:left;

}
#subscribe-1-main .subscribe-1-inner-content .h2{
    font-weight: 600;
    letter-spacing: -.0em;
    color: #fff !important;
    margin: 0;
    font-size: 1.15rem;
    text-transform:initial;
}

#subscribe-1-main .theme-block {
    margin-bottom: 5px;
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
    font-size:14px;
    margin:0;
    color:#fff !important;
    font-weight: 300 !important;
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
    padding: 3.65rem 0;
}
#subscribe-1-main .subscribe-1-inner-content {
    max-width: 100%;
}
#subscribe-1-main .subscribe-1-inner-content .h2 {
    font-size: 16px;
}
.subscribe-1-p {
    font-size: 14px;
}
}
.mobile-group{
    width:100%;
}


.col-2xl-5col {
    flex: 0 0 40%;
    max-width: 40%;
}

.col-3xl-5col {
    flex: 0 0 60%;
    max-width: 60%;
}
.subscribe-8-btn{
    border-color:#fff;
}

@media only screen and (max-width: 768px)
{
    #subscribe-1-main .subscribe-1-inner-content {
    padding:0 10px;
}
    .molla_sub_btn_inner8{
        width:100%;
    }
    .col-2xl-5col {
        flex: 0 0 40%;
        max-width: 40%;
    }
    .col-3xl-5col {
        flex: 0 0 60%;
        max-width: 60%;
        margin-top: 15px;
    }
    #subscribe-1-main .subscribe-1-inner-content {
        padding: 0 20px;
        margin: 0 auto;
        text-align: center;
    }
    .sub10 .input-group > .form-control, .input-group > .form-control-plaintext, .input-group > .custom-select, .input-group > .custom-file {
        position: relative;
        flex: 1 1 auto;
        width: 100%;
        margin-bottom: 0;
    }
    .sub10 .theme-block1{
        margin-bottom:1rem;
    }
    .sub10 .input-group-append {
        margin-left: -1px;
    }
}

@media only screen and (min-width: 700px) and (max-width: 800px){
    #subscribe-1-main input, #subscribe-1-main select, #subscribe-1-main textarea {
        border: 1px solid !important;
        border-color: #dadada !important;
        max-width: 61%;
        padding: 8px 20px;
        border-radius: 0;
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
    .col-2xl-5col {
        flex: 0 0 100%;
        max-width: 100%;
    }
    .col-3xl-5col {
        flex: 0 0 100%;
        max-width: 100%;
    }
    #subscribe-1-main .subscribe-1-inner-content {
        padding: 0 20px;
        margin: 0 auto;
        text-align: center;
    }
    .sub10 .input-group > .form-control, .input-group > .form-control-plaintext, .input-group > .custom-select, .input-group > .custom-file {
        position: relative;
        flex: 1 1 auto;
        width: 100%;
        margin-bottom: 0;
    }
    .sub10 .theme-block1{
        margin-bottom:1rem;
    }
    .sub10 .input-group-append {
        margin: 10px auto auto auto;
    }
    #subscribe-1-main input, #subscribe-1-main select, #subscribe-1-main textarea {
        border: 1px solid !important;
        border-color: #dadada !important;
        max-width: 100%;
        padding: 8px 20px;
        border-radius: 0;
    }
}

</style>
<?php   $subscribe = DB::table('home_subscribe')
        ->leftJoin('image_categories', 'home_subscribe.subscribe_image_id', 'image_categories.image_id')
        ->select('home_subscribe.*', 'image_categories.path_type as image_path_type', 'image_categories.path as image_path')
        ->where('image_type', 'ACTUAL')
        ->first(); if($subscribe !='') {?>
<div id="subscribe-1-main" class="common-bg sub10">
    <div class="subscribe-1-outer-pad">
        <div class="subscribe-1-inner-content">
            <div class="container">
                <div class="row" style="align-items: center;">
                    <div class="col-2xl-5col col-12">
                        <div class="theme-block">
                            <p class="h2" style="text-transform:initial">{{ $subscribe->subscribe_title }}</p>
                        </div>
                        <div class="theme-block1">
                            <p class="subscribe-1-p">{{ $subscribe->subscribe_description }}</p>
                        </div>
                    </div>
                    <div class="col-3xl-5col col-12">
                        <form action="{{url('subscribeMail')}}"  class="mailchimp-form">
                        <!-- <div class="g-recaptcha" style="margin-bottom:5px;" data-sitekey="6LcgaOIlAAAAANQ9-qy97ERNTHeRVjnFgiwRiK90"></div> 
                      <div class="captca" style="margin-bottom:30px;">please verify you are human! </div> -->
                      <div class=" d-flex justify-content-end justify-content-center">
                            <div class="input-group mobile-group">
                            <input style="height: calc(3rem + 5px);border-color:#fff !important;font-size:1rem" type="email" name="email" class="form-control mr-0 font-weight-normal border-0" placeholder="Enter your Email Address" aria-label="Email Adress" required="">
                            <div class="input-group-append molla_sub_btn_outer8" >
                                <button style="border-color: #fff !important;" id="mc-embedded-subscribe" class="btn btn-secondary subscribe-8-btn molla_sub_btn_inner8" type="submit"><span style="color:#fff;font-weight: 500;letter-spacing: -0.02em;font-size:1rem">SUBSCRIBE <svg xmlns="http://www.w3.org/2000/svg" width="11" height="17" viewBox="0 0 33.908 19.619" style="margin-left: 10px;">
             <path id="arrow_right" d="M28.861,11.627a1.335,1.335,0,0,0-.01,1.88l6.212,6.223L6.928,19.342a1.328,1.328,0,0,0,0,2.657l28.125.388-6.212,6.223a1.345,1.345,0,0,0,.01,1.88,1.323,1.323,0,0,0,1.87-.01L39.14,22h0a1.492,1.492,0,0,0,.276-.419,1.268,1.268,0,0,0,.1-.511,1.332,1.332,0,0,0-.378-.93l-8.42-8.481A1.3,1.3,0,0,0,28.861,11.627Z" transform="translate(-5.61 -11.252)" fill="#fff"/>
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
    </div>
</div>
<?php  } ?>