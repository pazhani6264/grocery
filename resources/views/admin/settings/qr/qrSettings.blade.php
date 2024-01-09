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
            <h1> Table Settings <small>Table Settings...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">Table settings</li>
            </ol>
        </section>

        

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Table Settings </h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            @if( count($errors) > 0)
                                                @foreach($errors->all() as $error)
                                                    <div class="alert alert-success" role="alert">
                                                        <span class="icon fa fa-check" aria-hidden="true"></span>
                                                        <span class="sr-only">{{ trans('labels.Setting') }}:</span>
                                                        {{ $error }}
                                                    </div>
                                                @endforeach
                                            @endif

                                            {!! Form::open(array('url' =>'admin/updateqrSetting', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                                            <h4>{{ trans('labels.generalSetting') }} </h4>
                                            <hr>

                                            <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">Colors</label>
                                          <div class="col-sm-9 col-md-4">
                                          
                                         
                                            <select name="web_color_style" onchange="getval(this);" class="form-control web_color_style_select">
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style')
                                                        selected
                                                        @endif
                                                        value="style">Default </option>
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.1')
                                                        selected
                                                        @endif
                                                        value="style.1"> @lang('labels.app_theme_2')</option>
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.2')
                                                        selected
                                                        @endif
                                                        value="style.2"> @lang('labels.app_theme_3')</option>
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.3')
                                                        selected
                                                        @endif
                                                        value="style.3"> @lang('labels.app_theme_4')</option>
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.4')
                                                        selected
                                                        @endif
                                                        value="style.4"> @lang('labels.app_theme_5')</option>
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.5')
                                                        selected
                                                        @endif
                                                        value="style.5"> @lang('labels.app_theme_6')</option>
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.6')
                                                        selected
                                                        @endif
                                                        value="style.6"> @lang('labels.app_theme_7')</option>
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.7')
                                                        selected
                                                        @endif
                                                        value="style.7"> @lang('labels.app_theme_8')</option>
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.8')
                                                        selected
                                                        @endif
                                                        value="style.8"> @lang('labels.app_theme_9')</option>
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.9')
                                                        selected
                                                        @endif
                                                        value="style.9"> Orange</option>
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.10')
                                                        selected
                                                        @endif
                                                        value="style.10"> Cameo</option>
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.11')
                                                        selected
                                                        @endif
                                                        value="style.11"> Americano</option>
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.12')
                                                        selected
                                                        @endif
                                                        value="style.12"> Cranberry</option>
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.13')
                                                        selected
                                                        @endif
                                                        value="style.13"> Pale Sky</option>
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.14')
                                                        selected
                                                        @endif
                                                        value="style.14"> Sheen Green</option>
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.15')
                                                        selected
                                                        @endif
                                                        value="style.15"> Cyan / Aqua</option>
                                                        
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.16')
                                                        selected
                                                        @endif
                                                        value="style.16"> Crete</option>
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.17')
                                                        selected
                                                        @endif
                                                        value="style.17"> Downy </option>
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.18')
                                                        selected
                                                        @endif
                                                        value="style.18"> Tonys Pink </option>
                                                <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.19')
                                                        selected
                                                        @endif
                                                        value="style.19"> Black </option>
                                              <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.25')
                                                        selected
                                                        @endif
                                                        value="style.25"> Lavender </option>
                                              <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.20')
                                                        selected
                                                        @endif
                                                        value="style.20"> Light Green (Demo-1)</option>
                                              <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.21')
                                                        selected
                                                        @endif
                                                        value="style.21"> Brown (Demo-2,6,11,12,15,16,18,23,25,27,29,31)</option>
                                              <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.22')
                                                        selected
                                                        @endif
                                                        value="style.22"> Light Orange (Demo-3,14,22,24)</option>
                                              <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.23')
                                                        selected
                                                        @endif
                                                        value="style.23"> brilliant azure (Demo-4,13)</option>

                                              <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.24')
                                                        selected
                                                        @endif
                                                        value="style.24"> Fuzzy Wuzzy (Demo-5,7)</option>
                                              <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.26')
                                                        selected
                                                        @endif
                                                        value="style.26"> Coral Dust (Demo-8)</option>
                                              <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.27')
                                                        selected
                                                        @endif
                                                        value="style.27">  Aloha (Demo-9,17,20)</option>
                                              <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.28')
                                                        selected
                                                        @endif
                                                        value="style.28">  Purple (Demo-10)</option>
                                              <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.29')
                                                        selected
                                                        @endif
                                                        value="style.29">  Butterscotch (Demo-19)</option>
                                              <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.30')
                                                        selected
                                                        @endif
                                                        value="style.30">  Crayola Blue (Demo-21,30)</option>      
                                              <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.31')
                                                        selected
                                                        @endif
                                                        value="style.31">  yellowish green (Demo-26,28)</option>     
                                              <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.32')
                                                        selected
                                                        @endif
                                                        value="style.32">  yellow (Demo-32)</option>    
                                              <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.33')
                                                        selected
                                                        @endif
                                                        value="style.33"> Dark Pink (Demo-33)</option>    
                                              <option @if($result['commonContent']['setting']['qr_color_style'] == 'style.34')
                                                        selected
                                                        @endif
                                                        value="style.34"> Tangerine Yellow (Demo-34)</option>    
                                            </select> 
                                          </div>
                                          <div class="col-sm-1 col-md-1 web_color_finder" style="background:{{$result['commonContent']['setting']['qr_color_code']}}"></div>
                                              
                                      </div>
                                      

                                   

                                        </div>



                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }} </button>
                                            <a href="{{ URL::to('admin/dashboard/this_month')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
                                        </div>

                                        <!-- /.box-footer -->
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

    <!-- /.row -->

    <!-- Main row -->

    <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
@endsection

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
   
    if(sel.value == 'style')
    {
      $(".web_color_finder").addClass("background_color_0");
    }
    if(sel.value == 'style.1')
    {
      $(".web_color_finder").addClass("background_color_1");
    }
    if(sel.value == 'style.2')
    {
      $(".web_color_finder").addClass("background_color_2");
    }
    if(sel.value == 'style.3')
    {
      $(".web_color_finder").addClass("background_color_3");
    }
    if(sel.value == 'style.4')
    {
      $(".web_color_finder").addClass("background_color_4");
    }
    if(sel.value == 'style.5')
    {
      $(".web_color_finder").addClass("background_color_5");
    }
    if(sel.value == 'style.6')
    {
      $(".web_color_finder").addClass("background_color_6");
    }
    if(sel.value == 'style.7')
    {
      $(".web_color_finder").addClass("background_color_7");
    }
    if(sel.value == 'style.8')
    {
      $(".web_color_finder").addClass("background_color_8");
    }
    if(sel.value == 'style.9')
    {
      $(".web_color_finder").addClass("background_color_9");
    }
    if(sel.value == 'style.1')
    {
      $(".web_color_finder").addClass("background_color_1");
    }
    if(sel.value == 'style.10')
    {
      $(".web_color_finder").addClass("background_color_10");
    }
    if(sel.value == 'style.11')
    {
      $(".web_color_finder").addClass("background_color_11");
    }
    if(sel.value == 'style.12')
    {
      $(".web_color_finder").addClass("background_color_12");
    }
    if(sel.value == 'style.13')
    {
      $(".web_color_finder").addClass("background_color_13");
    }
    if(sel.value == 'style.14')
    {
      $(".web_color_finder").addClass("background_color_14");
    }
    if(sel.value == 'style.15')
    {
      $(".web_color_finder").addClass("background_color_15");
    }
    if(sel.value == 'style.16')
    {
      $(".web_color_finder").addClass("background_color_16");
    }
    if(sel.value == 'style.17')
    {
      $(".web_color_finder").addClass("background_color_17");
    }
    if(sel.value == 'style.18')
    {
      $(".web_color_finder").addClass("background_color_18");
    }
    if(sel.value == 'style.19')
    {
      $(".web_color_finder").addClass("background_color_19");
    }
    if(sel.value == 'style.20')
    {
      $(".web_color_finder").addClass("background_color_20");
    }
    if(sel.value == 'style.21')
    {
      $(".web_color_finder").addClass("background_color_21");
    }
    if(sel.value == 'style.22')
    {
      $(".web_color_finder").addClass("background_color_22");
    }
    if(sel.value == 'style.23')
    {
      $(".web_color_finder").addClass("background_color_23");
    }
    if(sel.value == 'style.24')
    {
      $(".web_color_finder").addClass("background_color_24");
    }
    if(sel.value == 'style.25')
    {
      $(".web_color_finder").addClass("background_color_25");
    }
    if(sel.value == 'style.1')
    {
      $(".web_color_finder").addClass("background_color_1");
    }
    if(sel.value == 'style.26')
    {
      $(".web_color_finder").addClass("background_color_26");
    }
    if(sel.value == 'style.27')
    {
      $(".web_color_finder").addClass("background_color_27");
    }
    if(sel.value == 'style.28')
    {
      $(".web_color_finder").addClass("background_color_28");
    }
    if(sel.value == 'style.29')
    {
      $(".web_color_finder").addClass("background_color_29");
    }
    if(sel.value == 'style.30')
    {
      $(".web_color_finder").addClass("background_color_30");
    }
    if(sel.value == 'style.31')
    {
      $(".web_color_finder").addClass("background_color_31");
    }
    if(sel.value == 'style.32')
    {
      $(".web_color_finder").addClass("background_color_32");
    } if(sel.value == 'style.33')
    {
      $(".web_color_finder").addClass("background_color_33");
    }
    if(sel.value == 'style.34')
    {
      $(".web_color_finder").addClass("background_color_34");
    }
    
}

</script>