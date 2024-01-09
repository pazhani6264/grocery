<style>
    .demo-19-sub-bg
    {
        background: #fff;
        padding-top:0px !important;
    }
    .demo-19-sub-bg .home-page
    {
        padding-top: 0px;
    }
   .home-page .cta-horizontal-box {
    padding-left: 7rem;
    padding-right: 7rem;
}
.demo-19-sub-btn
{
    fill:#333;
    color:#333;
}

.cta-horizontal-box .btn {
font-weight: 600;
color: #fff;
background-color: hsla(0,0%,100%,.2);
}


.home-page .cta-horizontal-box .demo-19-sub-btn:hover
{
    color: #fff !important;
    border:none !important;
}
.home-page .cta-horizontal-box {
    padding: 2.6rem 3rem;
    margin:auto;
    max-width:70%;
}

.home-page .cta-horizontal-box .cta-title {
    font-weight: 600;
    font-size: 1.15rem;
    letter-spacing: -.01em;
    text-transform: uppercase;
    margin-bottom:0px;
}
.home-page .cta-horizontal-box .cta-desc {
    line-height: 1.4;
    font-size:1rem;
    margin-bottom:1rem;
}
.cta-horizontal .cta-desc, .cta-horizontal .form-control {
    margin-bottom: 0;
}
.text-light {
    color: #ccc!important;
}
.input-group {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-align: stretch;
    align-items: stretch;
    width: 100%;
}
.home-page .cta-horizontal-box .input-group .form-control {
    border-top-left-radius: 0.3rem;
    border-bottom-left-radius: 0.3rem;
    border: none;
}
.home-page .cta-horizontal-box .form-control {
    margin-right: 10px;
    background-color: #f8f8f8;
    font-size:1rem;
    border-radius:.3rem;
}
/* .input-group>.custom-select:not(:last-child), .input-group>.form-control:not(:last-child) {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
} */
.cta-horizontal .cta-desc, .cta-horizontal .form-control {
    margin-bottom: 0;
}
.cta-horizontal .form-control {
    flex-grow: 1;
    margin-right: 2rem;
}
.cta .form-control {
    height: 47px;
    padding-top: 1.15rem;
    padding-bottom: 1.15rem;
    background: #fff;
}
.home-page .cta-horizontal-box .input-group-append .btn {
    border-radius: 0.3rem;
}
.home-page .cta-horizontal-box .btn:not(.btn-block) {
    min-width: 160px;
    font-size:1rem;
}
.home-page .cta-horizontal-box .btn {
    text-transform: uppercase;
}
.input-group>.input-group-append>.btn, .input-group>.input-group-append>.input-group-text, .input-group>.input-group-prepend:first-child>.btn:not(:first-child), .input-group>.input-group-prepend:first-child>.input-group-text:not(:first-child), .input-group>.input-group-prepend:not(:first-child)>.btn, .input-group>.input-group-prepend:not(:first-child)>.input-group-text {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}
.sub21 .cta .btn {
    padding-top: 0.85rem;
    padding-bottom: 0.85rem;
}

.home-page .cta-horizontal-box form {
    width: 100%;
    max-width: 550px;
}
@media only screen and (max-width: 991px){
.home-page .cta-horizontal-box {
    padding: 2.6rem 3rem;
    margin: auto;
    max-width: 90%;
    text-align: center;
}
.home-page .cta-horizontal-box form {
    width: 100%;
    max-width: 100%;
}
}

@media only screen and (max-width: 576px){
    .banners-content .home-page {
        padding-left: 10px;
        padding-right: 10px;
    }
    .cta .input-group .form-control {
        width: 100%;
        margin-right: 0;
    }
    .cta .input-group .btn {
    margin-left: 0;
    margin-top: 1rem;
}
.cta .input-group .input-group-append, .cta .input-group .input-group-prepend {
    justify-content: center;
    margin: auto;
}
.home-page .cta-horizontal-box {
    padding: 2.6rem 2rem;
    text-align: center;
    margin: auto;
}
    .home-page .cta .input-group .form-control {
        border-top-right-radius: 0.3rem;
        border-bottom-right-radius: 0.3rem;
    }

    .home-page .cta-horizontal-box {
    padding: 2.6rem 2rem;
    margin: auto;
    max-width: 100%;

}

}

</style>
<?php   $subscribe = DB::table('home_subscribe')
        ->leftJoin('image_categories', 'home_subscribe.subscribe_image_id', 'image_categories.image_id')
        ->select('home_subscribe.*', 'image_categories.path_type as image_path_type', 'image_categories.path as image_path')
        ->where('image_type', 'ACTUAL')
        ->first(); if($subscribe !='') {?>

<div class="home-page sub21" style="background-image: url({{asset($subscribe->image_path)}});height:255px;">
    <div class="cta cta-horizontal cta-horizontal-box bg-image">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <h3 class="cta-title common-text">{{ $subscribe->subscribe_title }}</h3>
                <p class="cta-desc text-light">{{ $subscribe->subscribe_description }}</p>
            </div>
            <div class="col-lg-7 d-flex justify-content-lg-end">
                <form action="{{url('subscribeMail')}}"  class="mailchimp-form">
                <!-- <div class="g-recaptcha" style="margin-bottom:5px;" data-sitekey="6LcgaOIlAAAAANQ9-qy97ERNTHeRVjnFgiwRiK90"></div> 
                      <div class="captca" style="margin-bottom:30px;">please verify you are human! </div> -->
                      <div class=" d-flex justify-content-end justify-content-center">
                    <div class="input-group">
                        <input type="email" class="form-control form-control-white" placeholder="Enter your Email Address" aria-label="Email Adress" required="">
                        <div class="input-group-append">
                            <button id="mc-embedded-subscribe" class="btn demo-19-sub-btn common-fill-hover btn-primary-white btn-rounded" type="submit">
                                SUBSCRIBE
                            </button>
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