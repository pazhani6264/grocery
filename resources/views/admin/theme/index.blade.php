@extends('admin.layout')
@section('content')

<style>
  body{
    padding-right:0px !important;
  }
  
  .web_color_finder {
    height: 34px;
    border: solid 1px #ccc;
}
.background_color_0
{
  background-color: #28B293 !important;
}
.background_color_1
{
  background-color: #b7853f !important;
}
.background_color_2
{
  background-color: #B3182A !important;
}
.background_color_3
{
  background-color: #3E5902 !important;
}
.background_color_4
{
  background-color: #483A6F !important;
}
.background_color_5
{
  background-color: #621529 !important;
}
.background_color_6
{
  background-color: #212529 !important;
}
.background_color_7
{
  background-color: #479af1 !important;
}
.background_color_8
{
  background-color: #e83e8c !important;
}
.background_color_9
{
  background-color: #ff4c3b !important;
}
.background_color_10
{
  background-color: #c99d7b !important;
}
.background_color_11
{
  background-color: #866e6c !important;
}
.background_color_12
{
  background-color: #dc457e !important;
}
.background_color_13
{
  background-color: #6d7e87 !important;
}
.background_color_14
{
  background-color: #81ba00 !important;
}
.background_color_15
{
  background-color: #01effc !important;
}
.background_color_16
{
  background-color: #5d7227 !important;
}
.background_color_17
{
  background-color: #5fcbc4 !important;
}
.background_color_18
{
  background-color: #e38888 !important;
}
.background_color_19
{
  background-color: #000000 !important;
}
.background_color_20
{
  background-color: #a6c76c !important;
}
.background_color_21
{
  background-color: #c96 !important;
}
.background_color_22
{
  background-color: #fcb941 !important;
}
.background_color_23
{
  background-color: #39f !important;
}
.background_color_24
{
  background-color: #c66 !important;
}
.background_color_25
{
  background-color: #8A6BAA !important;
}
.background_color_26
{
  background-color: #eea287 !important;
}
.background_color_27
{
  background-color: #1cc0a0 !important;
}
.background_color_28
{
  background-color: #445f84 !important;
}
.background_color_29
{
  background-color: #fcb842 !important;
}
.background_color_30
{
  background-color: #66f !important;
}
.background_color_31
{
  background-color: #61ab00 !important;
}
.background_color_32
{
  background-color: #fdda05 !important;
}
.background_color_33
{
  background-color: #f05970 !important;
}
.background_color_34
{
  background-color: #ffcc02 !important;
}
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> {{ trans('labels.Theme Setting') }}
          @if($data['section_id'] == 1)
          <small>Home Page...</small>
          @elseif($data['section_id'] == 2)
          <small>Cart Page Settings...</small>
          @elseif($data['section_id'] == 3)
          <small>Blog Page Settings...</small>
          @elseif($data['section_id'] == 4)
          <small>Detail Page Settings...</small>
          @elseif($data['section_id'] == 5)
          <small>Shop Page Settings...</small>
          @elseif($data['section_id'] == 7)
            <small>Colors Settings</small>
          
          @elseif($data['section_id'] == 8)
          <small>@lang('labels.Login Page Settings') </small>
          @elseif($data['section_id'] == 9)
          <small>@lang('labels.News Page Settings') </small>
          @elseif($data['section_id'] == 10)
          <small>@lang('labels.News Page Settings') </small>
          @elseif($data['section_id'] == 11)
          <small>@lang('labels.Product Card Style') </small>

          @elseif($data['section_id'] == 12)
          <small>@lang('labels.Categorywidget') </small>

          @elseif($data['section_id'] == 13)
          <small>@lang('labels.Categories Section') </small>
                 
          @elseif($data['section_id'] == 14)
          <small>@lang('labels.Font Section') </small>
          @elseif($data['section_id'] == 15)
          <small>@lang('labels.Background Setting') </small>
          @elseif($data['section_id'] == 16)
          <small>Checkout Page Settings...</small>
                              
          @else
          <small>Contact Page Settings...</small>
          @endif

          </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li >{{ trans('labels.link_site_settings') }}</li>
            <li >{{ trans('labels.Theme Setting') }}</li>
            @if($data['section_id'] == 1)
            <li class="active">Home Page</li>
            @elseif($data['section_id'] == 2)
            <li class="active">Cart Page Settings</li>
            @elseif($data['section_id'] == 3)
            <li class="active">Blog Page Settings</li>
            @elseif($data['section_id'] == 4)
            <li class="active">Detail Page Settings</li>
            @elseif($data['section_id'] == 5)
            <li class="active">Shop Page Settings</li>
            @elseif($data['section_id'] == 6)
            <li class="active">Shop Page Settings</li>
            @elseif($data['section_id'] == 7)
            <li class="active">Colors Settings</li>
            @elseif($data['section_id'] == 15)
            <li class="active">Background Settings</li>
            @elseif($data['section_id'] == 8)
            <li class="active">@lang('labels.Login Page Settings') </li>
            @elseif($data['section_id'] == 9)
            <li class="active">@lang('labels.News Page Settings') </li>            
            @elseif($data['section_id'] == 10)
            
            @elseif($data['section_id'] == 11)
              <li class="active">@lang('labels.Product Card Style') </li>
            @elseif($data['section_id'] == 12)
              <li class="active">@lang('labels.Categorywidget') </li>
            @elseif($data['section_id'] == 13)
            <li class="active">@lang('labels.Categories Section') </li>
            @elseif($data['section_id'] == 14)
            <li class="active">@lang('labels.Font Section') </li>  
 @elseif($data['section_id'] == 16)
            <li class="active">checkout page setting </li>
            @endif


        </ol>
    </section>

    <!-- Main content -->
    <section class="content" style="box-shadow:none;">

    @if(session()->has('message'))
                                        <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong> {{ session()->get('message') }} </strong>
                                        </div>
                                    @endif

                                    @if (count($errors) > 0)
                                      @if($errors->any())
                                      <div class="alert alert-danger alert-dismissible" role="alert">
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          {{$errors->first()}}
                                      </div>
                                      @endif
                                    @endif

        <div class="row">
          <div class="col-md-2">
          </div>
            <div class="col-md-8">
          

                    <div class="box-header">
                        @if($data['section_id'] == 1)
                        <h3 class="box-title">Home Page Settings </h3>
                        @elseif($data['section_id'] == 2)
                        <h3 class="box-title">Cart Page Settings </h3>
                        @elseif($data['section_id'] == 3)
                        <h3 class="box-title">Blog Page Settings </h3>
                        @elseif($data['section_id'] == 4)
                        <h3 class="box-title">Detail Page Settings </h3>
                        @elseif($data['section_id'] == 5)
                        <h3 class="box-title">Shop Page Settings </h3>
                        @elseif($data['section_id'] == 6)
                        <h3 class="box-title">Contact Page Settings</h3>
                        @elseif($data['section_id'] == 8)
                        <h3 class="box-title">@lang('labels.Login Page Settings') </h3>
                        @elseif($data['section_id'] == 9)
                        <h3 class="box-title">@lang('labels.News Page Settings') </h3>
                        @elseif($data['section_id'] == 10)
                        <h3 class="box-title">@lang('labels.Banner Transition Settings') </h3>
                        @elseif($data['section_id'] == 11)
                        <h3 class="box-title">@lang('labels.Product Card Style') </h3>
                        @elseif($data['section_id'] == 12)
                        <h3 class="box-title">@lang('labels.Categorywidget') </h3>
                        @elseif($data['section_id'] == 13)
                        <h3 class="box-title">@lang('labels.Categories Section') </h3>
                        @elseif($data['section_id'] == 14)
                        <h3 class="box-title">@lang('labels.Font Section') </h3>
                        @elseif($data['section_id'] == 15)
                        <h3 class="box-title">@lang('labels.Background Settings') </h3>
 @elseif($data['section_id'] == 16)
                        <h3 class="box-title">Checkout Page Setting</h3>
                        @else
                        <h3 class="box-title">Colors Settings</h3>
                        @endif
                    </div>

                    <!-- /.box-header -->
                    <div id="app">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style="box-shadow: 2px 4px 21px lightgrey"class="box box-info">
                                    @if($data['section_id'] == 1)

                                    <?php  $dataa = json_encode(array('data' =>$data,'current_theme' => $current_theme)); 
                                    ?>
                                    
                                    <theme-component :data="{{$dataa}}"></theme-component>
                                    @endif
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body">
                                        @if( count($errors) > 0)
                                            @foreach($errors->all() as $error)
                                                <div class="alert alert-success" role="alert">
                                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                    <span class="sr-only">{{ trans('labels.Error') }}:</span>
                                                    {{ $error }}
                                                </div>
                                            @endforeach
                                        @endif
                                        {!! Form::open(array('url' =>'admin/theme/setting/setPages', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}
                                        <input type="hidden" name="page" value="{{$data['section_id']}}" />

                                      @if($data['section_id'] == 2)
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.cart') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control field-validate" onchange="showCartImage();" id="cart_id" name="cart_id">
                                                      @foreach($data['cart'] as $cart)
                                                        <?php  if($cart['id'] == $current_theme->cart){ ?>
                                                          <option selected value="{{$cart['id']}}">{{$cart['name']}} {{$cart['ref']}}</option>
                                                        <?php }else{ ?>
                                                          <option value="{{$cart['id']}}">{{$cart['name']}} {{$cart['ref']}}</option>
                                                        <?php } ?>
                                                      @endforeach
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.cart') }}</span>
                                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                    <img id="cart_image1" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/cart1.png')}}" />
                                                    <img id="cart_image2"  style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/cart2.png')}}" />
                                                    <img id="cart_image3"  style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/cart3.png')}}" />
                                                    <img id="cart_image4"  style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/cart4.png')}}" />

                                                </div>
                                            </div>

                                      @endif
                                      


 @if($data['section_id'] == 16)
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Checkout</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control field-validate" onchange="showCheckoutImage();" id="checkout_id" name="checkout_id">
                                                      @foreach($data['checkout'] as $checkout)
                                                        <?php  if($checkout['id'] == $current_theme->checkout){ ?>
                                                          <option selected value="{{$checkout['id']}}">{{$checkout['name']}} {{$checkout['ref']}}</option>
                                                        <?php }else{ ?>
                                                          <option value="{{$checkout['id']}}">{{$checkout['name']}} {{$checkout['ref']}}</option>
                                                        <?php } ?>
                                                      @endforeach
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">checkout</span>
                                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                    <img id="checkout_image1" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/checkout1.png')}}" />
                                                    <img id="checkout_image2"  style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/checkout2.png')}}" />
                                                    <img id="checkout_image3"  style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/checkout3.png')}}" />
                                                   
                                                </div>
                                            </div>

                                      @endif
                                      @if($data['section_id'] == 3)
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.news') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <select class="form-control field-validate" name="news_id">
                                                  @foreach($data['blog'] as $news)
                                                    <?php  if($news['id'] == $current_theme->news){ ?>
                                                      <option selected value="{{$news['id']}}">{{$news['name']}}</option>
                                                    <?php }else{ ?>
                                                      <option value="{{$news['id']}}">{{$news['name']}}</option>
                                                    <?php } ?>
                                                  @endforeach
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.news') }}</span>
                                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                            </div>
                                        </div>
                                      @endif
                                        @if($data['section_id'] == 4)
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.detail') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <select class="form-control field-validate" onchange="showDetailImage();" id="detail_id" name="detail_id">
                                                  @foreach($data['detail'] as $detail)
                                                    <?php  if($detail['id'] == $current_theme->detail){ ?>
                                                      <option selected value="{{$detail['id']}}">{{$detail['name']}}</option>
                                                    <?php }else{ ?>
                                                      <option value="{{$detail['id']}}">{{$detail['name']}}</option>
                                                    <?php } ?>
                                                  @endforeach
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.detail') }}</span>
                                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                <img id="detail_image1" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/detail1.png')}}" />
                                                <img id="detail_image2" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/detail2.png')}}" />
                                                <img id="detail_image3" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/detail3.png')}}" />
                                                <img id="detail_image4" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/detail4.png')}}" />
                                                <img id="detail_image5" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/detail5.png')}}" />
                                                <img id="detail_image6" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/detail6.png')}}" />
                                                <img id="detail_image7" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/detail7.png')}}" />
                                                <img id="detail_image8" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/detail11.png')}}" />
                                                <img id="detail_image9" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/detail10.png')}}" />
                                              

                                            </div>
                                        </div>
                                        @endif
                                        @if($data['section_id'] == 5)
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.shop') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <select class="form-control field-validate" onchange="showShopImage();" id="shop_id" name="shop_id">
                                                  @foreach($data['shop'] as $shop)
                                                    <?php  if($shop['id'] == $current_theme->shop){ ?>
                                                      <option selected value="{{$shop['id']}}">{{$shop['name']}}</option>
                                                    <?php }else{ ?>
                                                      <option value="{{$shop['id']}}">{{$shop['name']}}</option>
                                                    <?php } ?>
                                                  @endforeach
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.shop') }}</span>
                                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                <img id="shop_image1" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/shop1.png')}}" />
                                                <img id="shop_image2" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/shop2.png')}}" />
                                                <img id="shop_image3" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/shop3.png')}}" />
                                                <img id="shop_image4" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/shop4.png')}}" />
                                                <img id="shop_image5" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/shop5.png')}}" />
                                                <img id="shop_image6" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/shop6.png')}}" />
                                                <img id="shop_image7" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/shop7.png')}}" />

                                            </div>
                                        </div>
                                        @endif
                                          @if($data['section_id'] == 6)
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.contact') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <select  class="form-control field-validate"  onchange="showContactImage();" id="contact_id" name="contact_id">
                                                  @foreach($data['contact'] as $contact)
                                                    <?php  if($contact['id'] == $current_theme->contact){ ?>
                                                      <option selected value="{{$contact['id']}}">{{$contact['name']}}</option>
                                                    <?php }else{ ?>
                                                      <option value="{{$contact['id']}}">{{$contact['name']}}</option>
                                                    <?php } ?>
                                                  @endforeach
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.contact') }}</span>
                                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                <img id="contact_image1" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/contact1.png')}}" />
                                                <img id="contact_image2"  style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/contact2.png')}}" />
                                            </div>
                                        </div>
                                        @endif
                                        @if($data['section_id'] == 7)
                                      <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">Colors</label>
                                          <div class="col-sm-9 col-md-4">
                                          
                                         
                                            <select name="web_color_style" onchange="getval(this);" class="form-control web_color_style_select">
                                                <option @if($data['settings'][81]->value == 'app')
                                                        selected
                                                        @endif
                                                        value="app">Default </option>
                                                <option @if($data['settings'][81]->value == 'app.theme.1')
                                                        selected
                                                        @endif
                                                        value="app.theme.1"> @lang('labels.app_theme_2')</option>
                                                <option @if($data['settings'][81]->value == 'app.theme.2')
                                                        selected
                                                        @endif
                                                        value="app.theme.2"> @lang('labels.app_theme_3')</option>
                                                <option @if($data['settings'][81]->value == 'app.theme.3')
                                                        selected
                                                        @endif
                                                        value="app.theme.3"> @lang('labels.app_theme_4')</option>
                                                <option @if($data['settings'][81]->value == 'app.theme.4')
                                                        selected
                                                        @endif
                                                        value="app.theme.4"> @lang('labels.app_theme_5')</option>
                                                <option @if($data['settings'][81]->value == 'app.theme.5')
                                                        selected
                                                        @endif
                                                        value="app.theme.5"> @lang('labels.app_theme_6')</option>
                                                <option @if($data['settings'][81]->value == 'app.theme.6')
                                                        selected
                                                        @endif
                                                        value="app.theme.6"> @lang('labels.app_theme_7')</option>
                                                <option @if($data['settings'][81]->value == 'app.theme.7')
                                                        selected
                                                        @endif
                                                        value="app.theme.7"> @lang('labels.app_theme_8')</option>
                                                <option @if($data['settings'][81]->value == 'app.theme.8')
                                                        selected
                                                        @endif
                                                        value="app.theme.8"> @lang('labels.app_theme_9')</option>
                                                <option @if($data['settings'][81]->value == 'app.theme.9')
                                                        selected
                                                        @endif
                                                        value="app.theme.9"> Orange</option>
                                                <option @if($data['settings'][81]->value == 'app.theme.10')
                                                        selected
                                                        @endif
                                                        value="app.theme.10"> Cameo</option>
                                                <option @if($data['settings'][81]->value == 'app.theme.11')
                                                        selected
                                                        @endif
                                                        value="app.theme.11"> Americano</option>
                                                <option @if($data['settings'][81]->value == 'app.theme.12')
                                                        selected
                                                        @endif
                                                        value="app.theme.12"> Cranberry</option>
                                                <option @if($data['settings'][81]->value == 'app.theme.13')
                                                        selected
                                                        @endif
                                                        value="app.theme.13"> Pale Sky</option>
                                                <option @if($data['settings'][81]->value == 'app.theme.14')
                                                        selected
                                                        @endif
                                                        value="app.theme.14"> Sheen Green</option>
                                                <option @if($data['settings'][81]->value == 'app.theme.15')
                                                        selected
                                                        @endif
                                                        value="app.theme.15"> Cyan / Aqua</option>
                                                        
                                                <option @if($data['settings'][81]->value == 'app.theme.16')
                                                        selected
                                                        @endif
                                                        value="app.theme.16"> Crete</option>
                                                <option @if($data['settings'][81]->value == 'app.theme.17')
                                                        selected
                                                        @endif
                                                        value="app.theme.17"> Downy </option>
                                                <option @if($data['settings'][81]->value == 'app.theme.18')
                                                        selected
                                                        @endif
                                                        value="app.theme.18"> Tonys Pink </option>
                                                <option @if($data['settings'][81]->value == 'app.theme.19')
                                                        selected
                                                        @endif
                                                        value="app.theme.19"> Black </option>
                                              <option @if($data['settings'][81]->value == 'app.theme.25')
                                                        selected
                                                        @endif
                                                        value="app.theme.25"> Lavender </option>
                                              <option @if($data['settings'][81]->value == 'app.theme.20')
                                                        selected
                                                        @endif
                                                        value="app.theme.20"> Light Green (Demo-1)</option>
                                              <option @if($data['settings'][81]->value == 'app.theme.21')
                                                        selected
                                                        @endif
                                                        value="app.theme.21"> Brown (Demo-2,6,11,12,15,16,18,23,25,27,29,31)</option>
                                              <option @if($data['settings'][81]->value == 'app.theme.22')
                                                        selected
                                                        @endif
                                                        value="app.theme.22"> Light Orange (Demo-3,14,22,24)</option>
                                              <option @if($data['settings'][81]->value == 'app.theme.23')
                                                        selected
                                                        @endif
                                                        value="app.theme.23"> brilliant azure (Demo-4,13)</option>

                                              <option @if($data['settings'][81]->value == 'app.theme.24')
                                                        selected
                                                        @endif
                                                        value="app.theme.24"> Fuzzy Wuzzy (Demo-5,7)</option>
                                              <option @if($data['settings'][81]->value == 'app.theme.26')
                                                        selected
                                                        @endif
                                                        value="app.theme.26"> Coral Dust (Demo-8)</option>
                                              <option @if($data['settings'][81]->value == 'app.theme.27')
                                                        selected
                                                        @endif
                                                        value="app.theme.27">  Aloha (Demo-9,17,20)</option>
                                              <option @if($data['settings'][81]->value == 'app.theme.28')
                                                        selected
                                                        @endif
                                                        value="app.theme.28">  Purple (Demo-10)</option>
                                              <option @if($data['settings'][81]->value == 'app.theme.29')
                                                        selected
                                                        @endif
                                                        value="app.theme.29">  Butterscotch (Demo-19)</option>
                                              <option @if($data['settings'][81]->value == 'app.theme.30')
                                                        selected
                                                        @endif
                                                        value="app.theme.30">  Crayola Blue (Demo-21,30)</option>      
                                              <option @if($data['settings'][81]->value == 'app.theme.31')
                                                        selected
                                                        @endif
                                                        value="app.theme.31">  yellowish green (Demo-26,28)</option>     
                                              <option @if($data['settings'][81]->value == 'app.theme.32')
                                                        selected
                                                        @endif
                                                        value="app.theme.32">  yellow (Demo-32)</option>    
                                              <option @if($data['settings'][81]->value == 'app.theme.33')
                                                        selected
                                                        @endif
                                                        value="app.theme.33"> Dark Pink (Demo-33)</option>    
                                              <option @if($data['settings'][81]->value == 'app.theme.34')
                                                        selected
                                                        @endif
                                                        value="app.theme.34"> Tangerine Yellow (Demo-34)</option>    
                                            </select> 
                                          </div>
                                          <div class="col-sm-1 col-md-1 web_color_finder" style="background:{{$data['settings'][168]->value}}"></div>
                                              
                                      </div>
                                      @endif

                                      @if($data['section_id'] == 8)
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Login') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <select  class="form-control field-validate"  onchange="showLoginImage();" id="login_id" name="login_id">
                                                  @foreach($data['login'] as $login)
                                                    <?php  if($login['id'] == $current_theme->login){ ?>
                                                      <option selected value="{{$login['id']}}">{{$login['name']}} {{$login['ref']}}</option>
                                                    <?php }else{ ?>
                                                      <option value="{{$login['id']}}">{{$login['name']}} {{$login['ref']}}</option>
                                                    <?php } ?>
                                                  @endforeach
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.login') }}</span>
                                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                <img id="login_image1" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/login1.png')}}" />
                                                <img id="login_image2"  style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/login2.png')}}" />
                                                <img id="login_image3"  style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/login3.png')}}" />
                                                <img id="login_image4"  style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/login4.png')}}" />
                                                <img id="login_image5"  style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/login4.png')}}" />
                                                <img id="login_image6"  style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/login4.png')}}" />
                                                <img id="login_image7"  style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/login4.png')}}" />
                                                <img id="login_image8"  style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/login5.png')}}" />
                                                <img id="login_image9"  style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/login6.png')}}" />

                                            </div>
                                        </div>
                                        @endif

                                        @if($data['section_id'] == 9)
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.News') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <select  class="form-control field-validate"  onchange="showNewsImage();" id="news_id" name="news_id">
                                                  @foreach($data['news'] as $news)
                                                    <?php  if($news['id'] == $current_theme->news){ ?>
                                                      <option selected value="{{$news['id']}}">{{$news['name']}}</option>
                                                    <?php }else{ ?>
                                                      <option value="{{$news['id']}}">{{$news['name']}}</option>
                                                    <?php } ?>
                                                  @endforeach
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.News') }}</span>
                                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                <img id="news_image1" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/news1.png')}}" />
                                                <img id="news_image2"  style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/news2.png')}}" />
                                                <img id="news_image3"  style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/news3.png')}}" />
                                            </div>
                                        </div>
                                        @endif

                                        @if($data['section_id'] == 10)
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Transition') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <select  class="form-control field-validate"  onchange="showTransitionImage();" id="transitions_id" name="transitions_id">
                                                  @foreach($data['transitions'] as $transition)
                                                    <?php  if($transition['id'] == $current_theme->transitions){ ?>
                                                      <option selected value="{{$transition['id']}}">{{$transition['name']}}</option>
                                                    <?php }else{ ?>
                                                      <option value="{{$transition['id']}}">{{$transition['name']}}</option>
                                                    <?php } ?>
                                                  @endforeach
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.Transition') }}</span>
                                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                <img id="transition_image1" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/transition1.png')}}" />
                                                <img id="transition_image2"  style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/transition2.png')}}" />
                                                <img id="transition_image1" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/transition3.png')}}" />
                                                <img id="transition_image2"  style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/transition4.png')}}" />
                                                <img id="transition_image1" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/transition5.png')}}" />
                                            </div>
                                        </div>
                                        @endif       
                                        
                                        

                                        @if($data['section_id'] == 11)
                                      <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">@lang('labels.Product Card Style')</label>
                                          <div class="col-sm-10 col-md-4">
                                            <select onchange="showCardImage();" id="card_id" name="web_card_style" class="form-control">
                                              <option @if($data['settings'][129]->value == '1')
                                                selected
                                                @endif
                                                value="1"> @lang('labels.Style1')</option>    
                                                <option @if($data['settings'][129]->value == '2')
                                                    selected
                                                    @endif
                                                    value="2"> @lang('labels.Style2')</option>    
                                                <option @if($data['settings'][129]->value == '3')
                                                    selected
                                                    @endif
                                                    value="3"> @lang('labels.Style3')</option>   
                                                <option @if($data['settings'][129]->value == '4')
                                                    selected
                                                    @endif
                                                    value="4"> @lang('labels.Style4')</option>  
                                                <option @if($data['settings'][129]->value == '5')
                                                    selected
                                                    @endif
                                                    value="5"> @lang('labels.Style5')</option>   
                                                    
                                                <option @if($data['settings'][129]->value == '6')
                                                    selected
                                                    @endif
                                                    value="6"> @lang('labels.Style6')</option>   
                                                    
                                                <option @if($data['settings'][129]->value == '7')
                                                selected
                                                @endif
                                                value="7"> @lang('labels.Style7')</option>    
                                                
                                                <option @if($data['settings'][129]->value == '8')
                                                selected
                                                @endif
                                                value="8"> @lang('labels.Style8')</option>     
                                                
                                                <option @if($data['settings'][129]->value == '9')
                                                selected
                                                @endif
                                                value="9"> @lang('labels.Style9')</option>               
                                                
                                                <option @if($data['settings'][129]->value == '10')
                                                selected
                                                @endif
                                                value="10"> @lang('labels.Style10')</option>   
                                                <option @if($data['settings'][129]->value == '11')
                                                selected
                                                @endif
                                                value="11"> @lang('labels.Style11')</option> 
                                                <option @if($data['settings'][129]->value == '12')
                                                selected
                                                @endif
                                                value="12"> @lang('labels.Style12')</option>
                                                <option @if($data['settings'][129]->value == '13')
                                                selected
                                                @endif
                                                value="13"> @lang('labels.Style13')</option>
                                                <option @if($data['settings'][129]->value == '14')
                                                selected
                                                @endif
                                                value="14"> @lang('labels.Style14')</option>
                                                <option @if($data['settings'][129]->value == '15')
                                                selected
                                                @endif
                                                value="15"> @lang('labels.Style15')</option>

                                                <!-- quantity cards -->
                                                <option @if($data['settings'][129]->value == '16')
                                                selected
                                                @endif
                                                value="16"> @lang('labels.Style16')</option>
                                                <option @if($data['settings'][129]->value == '17')
                                                selected
                                                @endif
                                                value="17"> @lang('labels.Style17')</option>
                                                
                                                <option @if($data['settings'][129]->value == '18')
                                                selected
                                                @endif
                                                value="18"> @lang('labels.Style18')</option>
                                                
                                                <option @if($data['settings'][129]->value == '19')
                                                selected
                                                @endif
                                                value="19"> @lang('labels.Style19') (Demo-1,2)</option>
                                                
                                                <option @if($data['settings'][129]->value == '20')
                                                selected
                                                @endif
                                                value="20"> @lang('labels.Style20') (Demo-3)</option>
                                                
                                                <option @if($data['settings'][129]->value == '21')
                                                selected
                                                @endif
                                                value="21"> @lang('labels.Style21') (Demo-4)</option>  

                                                <option @if($data['settings'][129]->value == '22')
                                                selected
                                                @endif
                                                value="22"> @lang('labels.Style22') (Demo-5,15,16,17)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '23')
                                                selected
                                                @endif
                                                value="23"> @lang('labels.Style23') (Demo-6)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '24')
                                                selected
                                                @endif
                                                value="24"> @lang('labels.Style24') (Demo-7)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '25')
                                                selected
                                                @endif
                                                value="25"> @lang('labels.Style25') (Demo-8)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '26')
                                                selected
                                                @endif
                                                value="26"> @lang('labels.Style26') (Demo-9)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '27')
                                                selected
                                                @endif
                                                value="27"> @lang('labels.Style27') (Demo-10)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '28')
                                                selected
                                                @endif
                                                value="28"> @lang('labels.Style28') (Demo-11)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '29')
                                                selected
                                                @endif
                                                value="29"> @lang('labels.Style29') (Demo-12,18)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '30')
                                                selected
                                                @endif
                                                value="30"> @lang('labels.Style30') (Demo-13)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '31')
                                                selected
                                                @endif
                                                value="31"> @lang('labels.Style31') (Demo-14)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '32')
                                                selected
                                                @endif
                                                value="32"> @lang('labels.Style32') (Demo-19)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '33')
                                                selected
                                                @endif
                                                value="33"> @lang('labels.Style33') (Demo-20)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '34')
                                                selected
                                                @endif
                                                value="34"> @lang('labels.Style34') (Demo-21)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '35')
                                                selected
                                                @endif
                                                value="35"> @lang('labels.Style35') (Demo-22)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '36')
                                                selected
                                                @endif
                                                value="36"> @lang('labels.Style36') (Demo-24)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '37')
                                                selected
                                                @endif
                                                value="37"> @lang('labels.Style37') (Demo-25)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '38')
                                                selected
                                                @endif
                                                value="38"> @lang('labels.Style38') (Demo-26)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '39')
                                                selected
                                                @endif
                                                value="39"> @lang('labels.Style39') (Demo-28)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '40')
                                                selected
                                                @endif
                                                value="40"> @lang('labels.Style40') (Demo-29)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '41')
                                                selected
                                                @endif
                                                value="41"> @lang('labels.Style41') (Demo-31)</option>  
                                                        
                                                <option @if($data['settings'][129]->value == '42')
                                                selected
                                                @endif
                                                value="42"> @lang('labels.Style42') (Demo-32)</option>  

                                                <option @if($data['settings'][129]->value == '43')
                                                selected
                                                @endif
                                                value="43"> @lang('labels.Style43') (Demo-33)</option>  

                                                <option @if($data['settings'][129]->value == '44')
                                                selected
                                                @endif
                                                value="44"> @lang('labels.Style44') (Demo-34)</option>  

                                                <option @if($data['settings'][129]->value == '45')
                                                selected
                                                @endif
                                                value="45"> Style 45 (Demo-35)</option>  

                                                <option @if($data['settings'][129]->value == '46')
                                                selected
                                                @endif
                                                value="46"> Style 46 (Demo-23,27)</option>  
                                                        
                                                        
                                            </select> 
                                            
                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.Product Card Style') }}</span><hr>
                                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>

                                            <img id="card_image1" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card1.jpg')}}" />
                                            <img id="card_image2" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card2.jpg')}}" />
                                            <img id="card_image3" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card3.jpg')}}" />
                                            <img id="card_image4" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card4.jpg')}}" />
                                            <img id="card_image5" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card5.jpg')}}" />
                                            <img id="card_image6" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card6.jpg')}}" />
                                            <img id="card_image7" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card7.jpg')}}" />
                                            <img id="card_image8" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card8.jpg')}}" />
                                            <img id="card_image9" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card9.jpg')}}" />
                                            <img id="card_image10" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card10.jpg')}}" />
                                            <img id="card_image11" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card11.jpg')}}" />
                                            <img id="card_image12" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card12.jpg')}}" />
                                            <img id="card_image13" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card13.jpg')}}" />
                                            <img id="card_image14" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card14.jpg')}}" />
                                            <img id="card_image15" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card15.jpg')}}" />
                                            <img id="card_image16" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card16.jpg')}}" />
                                            <img id="card_image17" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card17.jpg')}}" />
                                            <img id="card_image18" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card18.jpg')}}" />
                                            <img id="card_image19" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card19.png')}}" />
                                            <img id="card_image20" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card20.png')}}" />
                                            <img id="card_image21" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card21.png')}}" />
                                            <img id="card_image22" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card22.png')}}" />
                                            <img id="card_image23" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card23.png')}}" />
                                            <img id="card_image24" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card24.png')}}" />
                                            <img id="card_image25" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card25.png')}}" />
                                            <img id="card_image26" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card26.png')}}" />
                                            <img id="card_image27" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card27.png')}}" />
                                            <img id="card_image28" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card28.png')}}" />
                                            <img id="card_image29" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card29.png')}}" />
                                            <img id="card_image30" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card30.png')}}" />
                                            <img id="card_image31" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card31.png')}}" />
                                            <img id="card_image32" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card32.png')}}" />
                                            <img id="card_image33" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card33.png')}}" />
                                            <img id="card_image34" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card34.png')}}" />
                                            <img id="card_image35" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card35.png')}}" />
                                            <img id="card_image36" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card36.png')}}" />
                                            <img id="card_image37" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card37.png')}}" />
                                            <img id="card_image38" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card38.png')}}" />
                                            <img id="card_image39" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card39.png')}}" />
                                            <img id="card_image40" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card40.png')}}" />
                                            <img id="card_image41" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card41.png')}}" />
                                            <img id="card_image42" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card42.png')}}" />
                                            <img id="card_image43" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card43.png')}}" />
                                            <img id="card_image44" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card45.png')}}" />
                                            <img id="card_image45" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card44.png')}}" />
                                            <img id="card_image46" style="display: none" width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/card46.png')}}" />

                                               
                                          </div>
                                      </div>
                                      @endif   

                                      @if($data['section_id'] == 12)
                                      <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-4 control-label">@lang('labels.Categories Icons / Image')</label>
                                          <div class="col-sm-10 col-md-4">
                                            <select name="home_categories_img_icn" class="form-control">
                                              <option @if($result['commonContent']['setting']['home_categories_img_icn'] == 'Image')
                                                selected
                                                @endif
                                                value="Image"> @lang('labels.Image')</option> 
                                              <option @if($result['commonContent']['setting']['home_categories_img_icn'] == 'Icon')
                                                selected
                                                @endif
                                                value="Icon"> @lang('labels.Icon')</option>  
                                            </select> 
                                          </div>
                                      </div>

                                     

                                      <div class="form-group">
                                        <label for="name" class="col-sm-2 col-md-4 control-label">Number of Records ( Desktop )</label>
                                        <div class="col-sm-10 col-md-4">
                                        <input type="number" class="form-control" name="home_categories_records" value="{{$result['commonContent']['setting']['home_categories_records']}}"> 
                                        </div>
                                      </div>      
                                      
                                      <div class="form-group">
                                        <label for="name" class="col-sm-2 col-md-4 control-label">Number of Records ( Mobile )</label>
                                        <div class="col-sm-10 col-md-4">
                                        <input type="number" class="form-control" name="home_categories_records_mobile" value="{{$result['commonContent']['setting']['home_categories_records_mobile']}}"> 
                                        </div>
                                      </div>       
                                      
                                      @endif  


                                      @if($data['section_id'] == 13)

                                      <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">Select Category</label>
                                          <div class="col-sm-10 col-md-4">
                                            <select id="selectCategory" name="selectCategory" class="form-control">
                                              <option value="139"> Home Category</option> 
                                              <option value="240"> TopSell Category</option>  
                                              <option value="241"> NewArrival Category</option>  
                                              <option value="242"> Trending Category</option> 
                                              <option value="243"> Special Category</option>   
                                            </select> 
                                          </div>
                                      </div>

                                      @php
                                        $homecat_array = explode(',',$result['commonContent']['setting']['home_category']);      
                                        $topsellcat_array = explode(',',$result['commonContent']['setting']['topsell_category']);      
                                        $newarrivalcat_array = explode(',',$result['commonContent']['setting']['newarrival_category']);      
                                        $trendingcat_array = explode(',',$result['commonContent']['setting']['trending_category']);      
                                        $specialcat_array = explode(',',$result['commonContent']['setting']['special_category']);                                   
                                      @endphp
                                      
                                      <div id="homecategory" class="field_wrapper">
                                        
                                        @foreach ($homecat_array as $key=>$item)
                                          <div class="form-group ">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">@lang('labels.ChooseCategory')</label>
                                            <div class="col-sm-10 col-md-4 content-remove">
                                              <select name="home_category[]" class="form-control">
                                                <option value=""> @lang('labels.ChooseCategory')</option> 
                                                  @if(!empty($categories) and count($categories)>0)
                                                    @foreach($categories as $category)
                                                    <option 
                                                    value="{{$category->id}}"  @if($category->id == $item))  selected @endif> {{$category->name}}</option>  
                                                    @endforeach
                                                  @endif
                                              </select>
                                            </div>
                                            <div class="col-sm-2">  
                                              @if($key == 0)                                        
                                              <a href="javascript:void(0);" class="btn btn-default add_button" title="Add field"><i class="fa fa-plus"></i></a>
                                              @else
                                              <a href="javascript:void(0);" class="btn btn-danger remove_button" title="Add field"><i class="fa fa-remove"></i></a>
                                              @endif
                                            </div>
                                          </div>
                                        @endforeach
                                      </div>

                                      <div id="topsellcategory" class="topsell_field_wrapper">
                                        
                                        @foreach ($topsellcat_array as $key=>$item)
                                          <div class="form-group ">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">@lang('labels.ChooseCategory')</label>
                                            <div class="col-sm-10 col-md-4 content-remove">
                                              <select name="topsell_category[]" class="form-control">
                                                <option value=""> @lang('labels.ChooseCategory')</option> 
                                                  @if(!empty($categories) and count($categories)>0)
                                                    @foreach($categories as $category)
                                                    <option 
                                                    value="{{$category->id}}"  @if($category->id == $item))  selected @endif> {{$category->name}}</option>  
                                                    @endforeach
                                                  @endif
                                              </select>
                                            </div>
                                            <div class="col-sm-2">  
                                              @if($key == 0)                                        
                                              <a href="javascript:void(0);" class="btn btn-default topsell_add_button" title="Add field"><i class="fa fa-plus"></i></a>
                                              @else
                                              <a href="javascript:void(0);" class="btn btn-danger topsell_remove_button" title="Add field"><i class="fa fa-remove"></i></a>
                                              @endif
                                            </div>
                                          </div>
                                        @endforeach
                                      </div>


                                      <div id="newarrivalcategory" class="newarrival_field_wrapper">
                                        
                                        @foreach ($newarrivalcat_array as $key=>$item)
                                          <div class="form-group ">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">@lang('labels.ChooseCategory')</label>
                                            <div class="col-sm-10 col-md-4 content-remove">
                                              <select name="newarrival_category[]" class="form-control">
                                                <option value=""> @lang('labels.ChooseCategory')</option> 
                                                  @if(!empty($categories) and count($categories)>0)
                                                    @foreach($categories as $category)
                                                    <option 
                                                    value="{{$category->id}}"  @if($category->id == $item))  selected @endif> {{$category->name}}</option>  
                                                    @endforeach
                                                  @endif
                                              </select>
                                            </div>
                                            <div class="col-sm-2">  
                                              @if($key == 0)                                        
                                              <a href="javascript:void(0);" class="btn btn-default newarrival_add_button" title="Add field"><i class="fa fa-plus"></i></a>
                                              @else
                                              <a href="javascript:void(0);" class="btn btn-danger newarrival_remove_button" title="Add field"><i class="fa fa-remove"></i></a>
                                              @endif
                                            </div>
                                          </div>
                                        @endforeach
                                      </div>


                                      <div id="trendingcategory" class="trending_field_wrapper">
                                        
                                        @foreach ($trendingcat_array as $key=>$item)
                                          <div class="form-group ">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">@lang('labels.ChooseCategory')</label>
                                            <div class="col-sm-10 col-md-4 content-remove">
                                              <select name="trending_category[]" class="form-control">
                                                <option value=""> @lang('labels.ChooseCategory')</option> 
                                                  @if(!empty($categories) and count($categories)>0)
                                                    @foreach($categories as $category)
                                                    <option 
                                                    value="{{$category->id}}"  @if($category->id == $item))  selected @endif> {{$category->name}}</option>  
                                                    @endforeach
                                                  @endif
                                              </select>
                                            </div>
                                            <div class="col-sm-2">  
                                              @if($key == 0)                                        
                                              <a href="javascript:void(0);" class="btn btn-default trending_add_button" title="Add field"><i class="fa fa-plus"></i></a>
                                              @else
                                              <a href="javascript:void(0);" class="btn btn-danger trending_remove_button" title="Add field"><i class="fa fa-remove"></i></a>
                                              @endif
                                            </div>
                                          </div>
                                        @endforeach
                                      </div>

                                      <div id="specialcategory" class="special_field_wrapper">
                                        
                                        @foreach ($specialcat_array as $key=>$item)
                                          <div class="form-group ">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">@lang('labels.ChooseCategory')</label>
                                            <div class="col-sm-10 col-md-4 content-remove">
                                              <select name="special_category[]" class="form-control">
                                                <option value=""> @lang('labels.ChooseCategory')</option> 
                                                  @if(!empty($categories) and count($categories)>0)
                                                    @foreach($categories as $category)
                                                    <option 
                                                    value="{{$category->id}}"  @if($category->id == $item))  selected @endif> {{$category->name}}</option>  
                                                    @endforeach
                                                  @endif
                                              </select>
                                            </div>
                                            <div class="col-sm-2">  
                                              @if($key == 0)                                        
                                              <a href="javascript:void(0);" class="btn btn-default special_add_button" title="Add field"><i class="fa fa-plus"></i></a>
                                              @else
                                              <a href="javascript:void(0);" class="btn btn-danger special_remove_button" title="Add field"><i class="fa fa-remove"></i></a>
                                              @endif
                                            </div>
                                          </div>
                                        @endforeach
                                      </div>

                                    
                                      @endif 
                                        

                                      @if($data['section_id'] == 14)
                                      <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">Font</label>
                                          <div class="col-sm-10 col-md-4">
                                            <select name="font" class="form-control">
                                                <option @if($data['settings'][153]->value == 'roboto')
                                                        selected
                                                        @endif
                                                        value="roboto">Roboto (Demo-31)</option>
                                                <option @if($data['settings'][153]->value == 'open-sanserif')
                                                        selected
                                                        @endif
                                                        value="open-sanserif">Open Sans-Serif (Demo-22,29,34)</option>
                                                <option @if($data['settings'][153]->value == 'helvetica')
                                                        selected
                                                        @endif
                                                        value="helvetica">Helvetica</option>
                                                <option @if($data['settings'][153]->value == 'poppins')
                                                        selected
                                                        @endif
                                                        value="poppins"> Poppins (Demo-3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,23,24,25,26,27,28,30)</option>
                                                <option @if($data['settings'][153]->value == 'jost')
                                                        selected
                                                        @endif
                                                        value="jost">Jost (Demo-1,33)</option>
                                                <option @if($data['settings'][153]->value == 'manrope')
                                                        selected
                                                        @endif
                                                        value="manrope"> Manrope (Demo-2,32)</option> 
                                                        <option @if($data['settings'][153]->value == 'centurygothic')
                                                        selected
                                                        @endif
                                                        value="centurygothic"> Century Gothic (Demo-35)</option> 
                                            </select> 
                                          </div>
                                      </div>
                                      @endif


                                      @if($data['section_id'] == 15)

                                    

                                      <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">Background Type</label>
                                          <div class="col-sm-10 col-md-4">
                                        <select onchange="hidedata();" id="background_type" name="background_type" class="form-control">
                                              <option @if($result['commonContent']['setting']['background_type'] == '1') selected @endif 
                                                value="1"> Color</option>    
                                                <option @if($result['commonContent']['setting']['background_type'] == '2') selected @endif 
                                                    value="2"> Image</option>    
                          
                                            </select> 
                                    </div>
                                    </div>

                                  <br>

                                    <div class="form-group enablecolor">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Background color</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input class="form-control field-validate" data-jscolor="{position:'bottom', previewSize:130}" id="back_theme_color" name="back_theme_color"  value="{{ $result['commonContent']['setting']['background_color'] }}">
                                                </div>
                                            </div>
                                       <br> 

                                      <div class="form-group enableimage" id="bgimage">
                                        <div class="" id="imageIcone">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">Background Image</label>
                                            <div class="col-sm-10 col-md-4">
                                                        <!-- Modal -->
                                              <div class="modal fade embed-images" id="ModalmanufacturedICone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                      <h3 class="modal-title text-primary" id="myModalLabel">{{ trans('labels.Choose Image') }} </h3>
                                                    </div>
                                                    <div class="modal-body manufacturer-image-embed">
                                                      @if(isset($allimage))
                                                        <select class="image-picker show-html " name="website_logo" id="select_img">
                                                          <option value=""></option>

                                                          @foreach($allimage as $key=>$image)
                                                            <option data-img-src="{{asset($image->path)}}" class="imagedetail" data-img-alt="{{$key}}" value="{{$image->id}}"> {{$image->id}} </option>
                                                          @endforeach
                                                        </select>
                                                      @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                      <a href="{{url('admin/media/add')}}" target="_blank" class="btn btn-primary pull-left" >{{ trans('labels.Add Image') }}</a>
                                                      <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                      <button type="button" class="btn btn-success" id="selectedICONE" data-dismiss="modal">{{ trans('labels.Done') }}</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <div id="imageselected">
                                                {!! Form::button(trans('labels.Add Image'), array('id'=>'newIcon','class'=>"btn btn-primary", 'data-toggle'=>"modal", 'data-target'=>"#ModalmanufacturedICone" )) !!}
                                                <br>
                                                <div id="selectedthumbnailIcon" class="selectedthumbnail col-md-5"> </div>
                                                  <div class="closimage">
                                                    <button type="button" class="close pull-left image-close " id="image-Icone" style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                </div>
                                                <br/>
                                                <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">  </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.OldImage') }}</span>
                                                    <br>
                                                   

                                                    {!! Form::hidden('oldImage',  $result['commonContent']['setting']['background_image'] , array('id'=>'website_logo')) !!}
                                                    <img src="{{asset($result['commonContent']['setting']['background_image'])}}" alt="" width="80px">
                                                </div>
                                            </div>
                                                <div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        @endif
                                      
                                      
                                        <!-- /.box-body -->
                                        @if($data['section_id'] != 1)
                                        <div class=" text-center">
                                            <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }} </button>
                                        </div>
                                        @endif
                                        @if($data['section_id'] == 1)
                                        <div class=" text-center">
                                            <a href="{{url('/')}}" target="_blank" class="btn btn-default">Go To Website </a>
                                        </div>
                                        @endif
                                        <!-- /.box-footer -->
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->

        <!-- /.row -->
    </section>
</div>
<script src="{{asset('web/js/app.js')}}"></script>

<script type="text/javascript">


  
  function getval(sel)
{

  $(".web_color_finder").removeClass("background_color_0");
$(".web_color_finder").removeClass("background_color_1");
$(".web_color_finder").removeClass("background_color_2");
$(".web_color_finder").removeClass("background_color_3");
$(".web_color_finder").removeClass("background_color_4");
$(".web_color_finder").removeClass("background_color_5");
$(".web_color_finder").removeClass("background_color_6");
$(".web_color_finder").removeClass("background_color_7");
$(".web_color_finder").removeClass("background_color_8");
$(".web_color_finder").removeClass("background_color_9");
$(".web_color_finder").removeClass("background_color_10");
$(".web_color_finder").removeClass("background_color_11");
$(".web_color_finder").removeClass("background_color_12");
$(".web_color_finder").removeClass("background_color_13");
$(".web_color_finder").removeClass("background_color_14");
$(".web_color_finder").removeClass("background_color_15");
$(".web_color_finder").removeClass("background_color_16");
$(".web_color_finder").removeClass("background_color_17");
$(".web_color_finder").removeClass("background_color_18");
$(".web_color_finder").removeClass("background_color_19");
$(".web_color_finder").removeClass("background_color_20");
$(".web_color_finder").removeClass("background_color_21");
$(".web_color_finder").removeClass("background_color_22");
$(".web_color_finder").removeClass("background_color_23");
$(".web_color_finder").removeClass("background_color_24");
$(".web_color_finder").removeClass("background_color_25");
$(".web_color_finder").removeClass("background_color_26");
$(".web_color_finder").removeClass("background_color_27");
$(".web_color_finder").removeClass("background_color_28");
$(".web_color_finder").removeClass("background_color_29");
$(".web_color_finder").removeClass("background_color_30");
$(".web_color_finder").removeClass("background_color_31");
$(".web_color_finder").removeClass("background_color_32");
$(".web_color_finder").removeClass("background_color_33");
$(".web_color_finder").removeClass("background_color_34");
   
    if(sel.value == 'app')
    {
      $(".web_color_finder").addClass("background_color_0");
    }
    if(sel.value == 'app.theme.1')
    {
      $(".web_color_finder").addClass("background_color_1");
    }
    if(sel.value == 'app.theme.2')
    {
      $(".web_color_finder").addClass("background_color_2");
    }
    if(sel.value == 'app.theme.3')
    {
      $(".web_color_finder").addClass("background_color_3");
    }
    if(sel.value == 'app.theme.4')
    {
      $(".web_color_finder").addClass("background_color_4");
    }
    if(sel.value == 'app.theme.5')
    {
      $(".web_color_finder").addClass("background_color_5");
    }
    if(sel.value == 'app.theme.6')
    {
      $(".web_color_finder").addClass("background_color_6");
    }
    if(sel.value == 'app.theme.7')
    {
      $(".web_color_finder").addClass("background_color_7");
    }
    if(sel.value == 'app.theme.8')
    {
      $(".web_color_finder").addClass("background_color_8");
    }
    if(sel.value == 'app.theme.9')
    {
      $(".web_color_finder").addClass("background_color_9");
    }
    if(sel.value == 'app.theme.1')
    {
      $(".web_color_finder").addClass("background_color_1");
    }
    if(sel.value == 'app.theme.10')
    {
      $(".web_color_finder").addClass("background_color_10");
    }
    if(sel.value == 'app.theme.11')
    {
      $(".web_color_finder").addClass("background_color_11");
    }
    if(sel.value == 'app.theme.12')
    {
      $(".web_color_finder").addClass("background_color_12");
    }
    if(sel.value == 'app.theme.13')
    {
      $(".web_color_finder").addClass("background_color_13");
    }
    if(sel.value == 'app.theme.14')
    {
      $(".web_color_finder").addClass("background_color_14");
    }
    if(sel.value == 'app.theme.15')
    {
      $(".web_color_finder").addClass("background_color_15");
    }
    if(sel.value == 'app.theme.16')
    {
      $(".web_color_finder").addClass("background_color_16");
    }
    if(sel.value == 'app.theme.17')
    {
      $(".web_color_finder").addClass("background_color_17");
    }
    if(sel.value == 'app.theme.18')
    {
      $(".web_color_finder").addClass("background_color_18");
    }
    if(sel.value == 'app.theme.19')
    {
      $(".web_color_finder").addClass("background_color_19");
    }
    if(sel.value == 'app.theme.20')
    {
      $(".web_color_finder").addClass("background_color_20");
    }
    if(sel.value == 'app.theme.21')
    {
      $(".web_color_finder").addClass("background_color_21");
    }
    if(sel.value == 'app.theme.22')
    {
      $(".web_color_finder").addClass("background_color_22");
    }
    if(sel.value == 'app.theme.23')
    {
      $(".web_color_finder").addClass("background_color_23");
    }
    if(sel.value == 'app.theme.24')
    {
      $(".web_color_finder").addClass("background_color_24");
    }
    if(sel.value == 'app.theme.25')
    {
      $(".web_color_finder").addClass("background_color_25");
    }
    if(sel.value == 'app.theme.1')
    {
      $(".web_color_finder").addClass("background_color_1");
    }
    if(sel.value == 'app.theme.26')
    {
      $(".web_color_finder").addClass("background_color_26");
    }
    if(sel.value == 'app.theme.27')
    {
      $(".web_color_finder").addClass("background_color_27");
    }
    if(sel.value == 'app.theme.28')
    {
      $(".web_color_finder").addClass("background_color_28");
    }
    if(sel.value == 'app.theme.29')
    {
      $(".web_color_finder").addClass("background_color_29");
    }
    if(sel.value == 'app.theme.30')
    {
      $(".web_color_finder").addClass("background_color_30");
    }
    if(sel.value == 'app.theme.31')
    {
      $(".web_color_finder").addClass("background_color_31");
    }
    if(sel.value == 'app.theme.32')
    {
      $(".web_color_finder").addClass("background_color_32");
    } if(sel.value == 'app.theme.33')
    {
      $(".web_color_finder").addClass("background_color_33");
    }
    if(sel.value == 'app.theme.34')
    {
      $(".web_color_finder").addClass("background_color_34");
    }
    
}

/* var val = $('input[name="background_type"]:checked').val();
if(val == 1)
{
  $('.enableimage').hide();
}
else
{
  $('.enablecolor').hide();
}



$('.checked').click(function(){
  alert("The paragraph was clicked.");
});
 */

 
hidedata();


function hidedata()
{

  var cart_id = jQuery('#background_type').val();
  jQuery('.enableimage').hide();
  jQuery('.enablecolor').hide();
 

  if(cart_id == 1){
    jQuery('.enablecolor').show();
  }

  if(cart_id == 2){
    jQuery('.enableimage').show();
  }
 
}



/* $('.background_type').click(function(){
            var radioValue = $("input[name='background_type']:checked").val();
            if(radioValue == 1)
              {
                $('.enableimage').hide();
                $('.enablecolor').show();
              }
              else
              {
                $('.enablecolor').hide();
                $('.enableimage').show();
              }
        }); */

  $(document).ready(function(){

  

     
  });
</script>

<script>
	$(function() {
		$('#topsellcategory').hide(); 
		$('#newarrivalcategory').hide(); 
		$('#trendingcategory').hide(); 
		$('#specialcategory').hide(); 

    $('#homecategory').show();
				$('#topsellcategory').hide(); 
				$('#newarrivalcategory').hide(); 
				$('#trendingcategory').hide(); 
				$('#specialcategory').hide(); 

        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        // var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"/></a></div>'; //New input field html 
        var fieldHTML = '<div class="form-group"><label for="name" class="col-sm-2 col-md-3 control-label">@lang("labels.ChooseCategory")</label><div class="col-sm-10 col-md-4"><select name="home_category[]" class="form-control"><option value=""> @lang("labels.ChooseCategory")</option> @if(!empty($categories) and count($categories)>0) @foreach($categories as $category) <option value="{{$category->id}}"> {{$category->name}}</option>  @endforeach @endif </select> </div> <div class="col-sm-2">   <a href="javascript:void(0);" class="btn btn-danger remove_button" title="Add field"><i class="fa fa-remove"></i></a></div> </div>'
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parents('.form-group').remove(); //Remove field html
            x--; //Decrement field counter
        });

        
		$('#selectCategory').change(function(){
     
			if($('#selectCategory').val() == '139') {
				$('#homecategory').show();
				$('#topsellcategory').hide(); 
				$('#newarrivalcategory').hide(); 
				$('#trendingcategory').hide(); 
				$('#specialcategory').hide(); 

      

        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        // var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"/></a></div>'; //New input field html 
        var fieldHTML = '<div class="form-group"><label for="name" class="col-sm-2 col-md-3 control-label">@lang("labels.ChooseCategory")</label><div class="col-sm-10 col-md-4"><select name="topsell_category[]" class="form-control"><option value=""> @lang("labels.ChooseCategory")</option> @if(!empty($categories) and count($categories)>0) @foreach($categories as $category) <option value="{{$category->id}}"> {{$category->name}}</option>  @endforeach @endif </select> </div> <div class="col-sm-2">   <a href="javascript:void(0);" class="btn btn-danger topsell_remove_button" title="Add field"><i class="fa fa-remove"></i></a></div> </div>'
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parents('.form-group').remove(); //Remove field html
            x--; //Decrement field counter
        });

			} else if($('#selectCategory').val() == '240') {
				$('#homecategory').hide();
				$('#topsellcategory').show(); 
				$('#newarrivalcategory').hide(); 
				$('#trendingcategory').hide(); 
				$('#specialcategory').hide(); 

        var maxField = 10; //Input fields increment limitation
        var addButton = $('.topsell_add_button'); //Add button selector
        var wrapper = $('.topsell_field_wrapper'); //Input field wrapper
        // var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"/></a></div>'; //New input field html 
        var fieldHTML = '<div class="form-group"><label for="name" class="col-sm-2 col-md-3 control-label">@lang("labels.ChooseCategory")</label><div class="col-sm-10 col-md-4"><select name="topsell_category[]" class="form-control"><option value=""> @lang("labels.ChooseCategory")</option> @if(!empty($categories) and count($categories)>0) @foreach($categories as $category) <option value="{{$category->id}}"> {{$category->name}}</option>  @endforeach @endif </select> </div> <div class="col-sm-2">   <a href="javascript:void(0);" class="btn btn-danger topsell_remove_button" title="Add field"><i class="fa fa-remove"></i></a></div> </div>'
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.topsell_remove_button', function(e){
            e.preventDefault();
            $(this).parents('.form-group').remove(); //Remove field html
            x--; //Decrement field counter
        });

			} else if($('#selectCategory').val() == '241') {
				$('#homecategory').hide();
				$('#topsellcategory').hide(); 
				$('#newarrivalcategory').show(); 
				$('#trendingcategory').hide(); 
				$('#specialcategory').hide(); 

        var maxField = 10; //Input fields increment limitation
        var addButton = $('.newarrival_add_button'); //Add button selector
        var wrapper = $('.newarrival_field_wrapper'); //Input field wrapper
        // var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"/></a></div>'; //New input field html 
        var fieldHTML = '<div class="form-group"><label for="name" class="col-sm-2 col-md-3 control-label">@lang("labels.ChooseCategory")</label><div class="col-sm-10 col-md-4"><select name="newarrival_category[]" class="form-control"><option value=""> @lang("labels.ChooseCategory")</option> @if(!empty($categories) and count($categories)>0) @foreach($categories as $category) <option value="{{$category->id}}"> {{$category->name}}</option>  @endforeach @endif </select> </div> <div class="col-sm-2">   <a href="javascript:void(0);" class="btn btn-danger newarrival_remove_button" title="Add field"><i class="fa fa-remove"></i></a></div> </div>'
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.newarrival_remove_button', function(e){
            e.preventDefault();
            $(this).parents('.form-group').remove(); //Remove field html
            x--; //Decrement field counter
        });

			} else if($('#selectCategory').val() == '242') {
				$('#homecategory').hide();
				$('#topsellcategory').hide(); 
				$('#newarrivalcategory').hide(); 
				$('#trendingcategory').show(); 
				$('#specialcategory').hide(); 

        var maxField = 10; //Input fields increment limitation
        var addButton = $('.trending_add_button'); //Add button selector
        var wrapper = $('.trending_field_wrapper'); //Input field wrapper
        // var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"/></a></div>'; //New input field html 
        var fieldHTML = '<div class="form-group"><label for="name" class="col-sm-2 col-md-3 control-label">@lang("labels.ChooseCategory")</label><div class="col-sm-10 col-md-4"><select name="trending_category[]" class="form-control"><option value=""> @lang("labels.ChooseCategory")</option> @if(!empty($categories) and count($categories)>0) @foreach($categories as $category) <option value="{{$category->id}}"> {{$category->name}}</option>  @endforeach @endif </select> </div> <div class="col-sm-2">   <a href="javascript:void(0);" class="btn btn-danger trending_remove_button" title="Add field"><i class="fa fa-remove"></i></a></div> </div>'
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.trending_remove_button', function(e){
            e.preventDefault();
            $(this).parents('.form-group').remove(); //Remove field html
            x--; //Decrement field counter
        });

			} else if($('#selectCategory').val() == '243') {
				$('#homecategory').hide();
				$('#topsellcategory').hide(); 
				$('#newarrivalcategory').hide(); 
				$('#trendingcategory').hide(); 
				$('#specialcategory').show(); 

        var maxField = 10; //Input fields increment limitation
        var addButton = $('.special_add_button'); //Add button selector
        var wrapper = $('.special_field_wrapper'); //Input field wrapper
        // var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"/></a></div>'; //New input field html 
        var fieldHTML = '<div class="form-group"><label for="name" class="col-sm-2 col-md-3 control-label">@lang("labels.ChooseCategory")</label><div class="col-sm-10 col-md-4"><select name="special_category[]" class="form-control"><option value=""> @lang("labels.ChooseCategory")</option> @if(!empty($categories) and count($categories)>0) @foreach($categories as $category) <option value="{{$category->id}}"> {{$category->name}}</option>  @endforeach @endif </select> </div> <div class="col-sm-2">   <a href="javascript:void(0);" class="btn btn-danger special_remove_button" title="Add field"><i class="fa fa-remove"></i></a></div> </div>'
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.special_remove_button', function(e){
            e.preventDefault();
            $(this).parents('.form-group').remove(); //Remove field html
            x--; //Decrement field counter
        });

			} else {
				$('#homecategory').show();
				$('#topsellcategory').hide(); 
				$('#newarrivalcategory').hide(); 
				$('#trendingcategory').hide(); 
				$('#specialcategory').hide(); 

        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        // var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"/></a></div>'; //New input field html 
        var fieldHTML = '<div class="form-group"><label for="name" class="col-sm-2 col-md-3 control-label">@lang("labels.ChooseCategory")</label><div class="col-sm-10 col-md-4"><select name="home_category[]" class="form-control"><option value=""> @lang("labels.ChooseCategory")</option> @if(!empty($categories) and count($categories)>0) @foreach($categories as $category) <option value="{{$category->id}}"> {{$category->name}}</option>  @endforeach @endif </select> </div> <div class="col-sm-2">   <a href="javascript:void(0);" class="btn btn-danger remove_button" title="Add field"><i class="fa fa-remove"></i></a></div> </div>'
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parents('.form-group').remove(); //Remove field html
            x--; //Decrement field counter
        });

			}
		});
	});
</script>

@endsection
