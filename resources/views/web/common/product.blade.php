<?php 
    $url = Request::url();
    $final_url = substr_replace($url ,"", -1);
    $mainurl = url('readytemplate_demo').'/';
    $mainurl_string = strval($mainurl);
    // print_r($final_url);
    // print_r($mainurl_string);die();
?>

@if( $final_url == $mainurl_string )
    @include('web.common.product_card_style.'.$result['commonContent']['settings']['demo_card_style'])
@else
    @include('web.common.product_card_style.'.$result['commonContent']['settings']['web_card_style'])
@endif
