<style>
  
#subscribe-1-main .subscribe-1-outer-pad
{
    padding: 38px 0;
    position: relative;
    height:120px !important;
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
    max-width: 850px;
    padding: 0 36px 0 42px;
    margin: 0 auto;
    text-align:center;

}
#subscribe-1-main .subscribe-1-inner-content .h2{
    font-weight: 600;
    letter-spacing: -.0em;
    color: #fff !important;
    margin: 0;
    font-size: 2.15rem;
}

#subscribe-1-main .theme-block {
    margin-bottom: 0px;
    text-align:left;
}

#subscribe-1-main .theme-block1 {
    margin-bottom: 0px;
    text-align:left;
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
    background:transparent;
    border:1px solid;
    color:#fff;
    min-width: 170px;
    padding:11px;
}

.molla_sub_btn_outer{
    margin:12px 0px;
    float: right;
}

.subscribe-2-btn:hover{
    text-transform:initial;
    border:1px solid;
    color:#fff
}

.subscribe-1-image {
    position: absolute;
    width: 100%;
    height:120px !important;
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
    padding: 35px 0;
}
#subscribe-1-main .subscribe-1-inner-content {
    max-width: 80%;
}
#subscribe-1-main .subscribe-1-inner-content .h2 {
    font-size: 26px;
}
.subscribe-1-p {
    font-size: 16px;
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
    .molla_sub_btn_inner{
        width:100%;
    }
    .subscribe-2-btn {
    text-transform: initial;
    background: transparent;
    border: 1px solid;
    color: #fff;
    min-width: 0px;
    padding: 8px;
}
/* .col-md-8 {
    flex: 0 0 66.6666666667%;
    max-width: 66.6666666667%;
}
.col-md-4 {
    flex: 0 0 33.3333333333%;
    max-width: 33.3333333333%;
} */
    
}

@media only screen and (max-width: 540px)
{
    #subscribe-1-main .subscribe-1-inner-content {
        max-width: 100%;
    }
    .molla_sub_btn_inner {
        width: 27% !important;
    }   
    #subscribe-1-main .theme-block {
        margin-bottom: 0px;
        margin-top:10px;
    }
    .molla_sub_btn_outer {
        margin: 3px 0px;
        float: right;
    }
    /* .col-md-8 {
        flex: 0 0 100%;
        max-width: 100%;
    }
    .col-md-4 {
        flex: 0 0 100%;
        max-width: 100%;
    } */
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
            <div class="row">
                <div class="col-md-8">
                    <div class="theme-block">
                        <p class="h2">{{ $subscribe->subscribe_title }}</p>
                    </div>
                    <div class="theme-block1">
                        <p class="subscribe-1-p">{{ $subscribe->subscribe_description }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group-append molla_sub_btn_outer" >
                        <button  id="mc-embedded-subscribe" class="btn subscribe-2-btn molla_sub_btn_inner" type="submit"><span style="font-weight: 400;letter-spacing: -0.02em;font-size:1rem;">SIGN UP <svg xmlns="http://www.w3.org/2000/svg" width="11" height="17" viewBox="0 0 33.908 19.619" style="margin-left: 10px;">
             <path id="arrow_right" d="M28.861,11.627a1.335,1.335,0,0,0-.01,1.88l6.212,6.223L6.928,19.342a1.328,1.328,0,0,0,0,2.657l28.125.388-6.212,6.223a1.345,1.345,0,0,0,.01,1.88,1.323,1.323,0,0,0,1.87-.01L39.14,22h0a1.492,1.492,0,0,0,.276-.419,1.268,1.268,0,0,0,.1-.511,1.332,1.332,0,0,0-.378-.93l-8.42-8.481A1.3,1.3,0,0,0,28.861,11.627Z" transform="translate(-5.61 -11.252)" fill="#fff"/>
           </svg></span></button>
                    </div>
                </div>
            </div>
    </div>
</div>
<?php  } ?>