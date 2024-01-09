@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{ trans('labels.editconstantbanner') }} <small>{{ trans('labels.editconstantbanner') }}...</small> </h1>
    <ol class="breadcrumb">
       <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li><a href="{{ URL::to('admin/constantbanners')}}"><i class="fa fa-bars"></i> {{ trans('labels.ListingConstantBanners') }}</a></li>
      <li class="active">{{ trans('labels.editconstantbanner') }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->

    <!-- /.row -->
    <style>
      .selectedthumbnail {
          display: block;
          margin-bottom: 10px;
          padding: 0;
      }
      .thumbnail {
          padding: 0;
      }
      .closimage{
        position: relative
      }
      </style>

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{ trans('labels.editconstantbanner') }} </h3>
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
              		<div class="box box-info">
                    <br>
                        @if(session()->has('error'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              {{ session()->get('error') }}
                            </div>
                          @endif

                          @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              {{ session()->get('success') }}
                            </div>
                          @endif
                        <!-- /.box-header -->
                        <!-- form start -->
                         <div class="box-body">

                            {!! Form::open(array('url' =>'admin/updateconstantBanner', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}

                                {!! Form::hidden('id',  $result['banners'][0]->banners_id , array('class'=>'form-control', 'id'=>'id')) !!}
                                {!! Form::hidden('oldImage',  $result['banners'][0]->banners_image, array('id'=>'oldImage')) !!}

                                <div class="form-group hidden">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Language') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="languages_id">
                                          @foreach($result['languages'] as $language)
                                              <option value="{{$language->languages_id}}" @if($language->languages_id==$result['banners'][0]->languages_id) selected @endif>{{ $language->name }}</option>
                                          @endforeach
                                      </select>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.ChooseLanguageText') }}</span>
                                  </div>
                                </div>

                                <div class="form-group hidden">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Side Banner') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="type">
                                      <option value="1" @if($result['banners'][0]->type==1) selected @endif>{{ trans('labels.Right And Left Carousel Side Banner 1') }}</option>
                                          <option value="2" @if($result['banners'][0]->type==2) selected @endif>{{ trans('labels.Right And Left Carousel Side Banner 2') }}</option>
                                          <option value="3" @if($result['banners'][0]->type==3) selected @endif>{{ trans('labels.First Banner For Banner Style 1') }}</option>
                                          <option value="4" @if($result['banners'][0]->type==4) selected @endif>{{ trans('labels.Second Banner For Banner Style 1') }}</option>
                                          <option value="5" @if($result['banners'][0]->type==5) selected @endif>{{ trans('labels.Third Banner For Banner Style 1') }}</option>
                                          <option value="6" @if($result['banners'][0]->type==6) selected @endif>{{ trans('labels.First Banner For Banner Style 2 & 3 & 4') }}</option>
                                          <option value="7" @if($result['banners'][0]->type==7) selected @endif>{{ trans('labels.Second Banner For Banner Style 2 & 3 & 4') }}</option>
                                          <option value="8" @if($result['banners'][0]->type==8) selected @endif>{{ trans('labels.Third Banner For Banner Style 2 & 3 & 4') }}</option>
                                          <option value="9" @if($result['banners'][0]->type==9) selected @endif>{{ trans('labels.Fourth Banner For Banner Style 2 & 3 & 4') }}</option>
                                          <option value="10" @if($result['banners'][0]->type==10) selected @endif>{{ trans('labels.First Banner For Banner Style 5 & 6') }}</option>
                                          <option value="11" @if($result['banners'][0]->type==11) selected @endif>{{ trans('labels.Second Banner For Banner Style 5 & 6') }}</option>
                                          <option value="12" @if($result['banners'][0]->type==12) selected @endif>{{ trans('labels.Third Banner For Banner Style 5 & 6') }}</option>
                                          <option value="13" @if($result['banners'][0]->type==13) selected @endif>{{ trans('labels.Fourth Banner For Banner Style 5 & 6') }}</option>
                                          <option value="14" @if($result['banners'][0]->type==14) selected @endif>{{ trans('labels.Fifth Banner For Banner Style 5 & 6') }}</option>
                                          <option value="15" @if($result['banners'][0]->type==15) selected @endif>{{ trans('labels.First Banner For Banner Style 7 & 8') }}</option>
                                          <option value="16" @if($result['banners'][0]->type==16) selected @endif>{{ trans('labels.Second Banner For Banner Style 7 & 8') }}</option>
                                          <option value="17" @if($result['banners'][0]->type==17) selected @endif>{{ trans('labels.Third Banner For Banner Style 7 & 8') }}</option>
                                          <option value="18" @if($result['banners'][0]->type==18) selected @endif>{{ trans('labels.Fourth Banner For Banner Style 7 & 8') }}</option>
                                          <option value="19" @if($result['banners'][0]->type==19) selected @endif>{{ trans('labels.First Banner For Banner Style 9') }}</option>
                                          <option value="20" @if($result['banners'][0]->type==20) selected @endif>{{ trans('labels.Second Banner For Banner Style 9') }}</option>
                                          <option value="21" @if($result['banners'][0]->type==21) selected @endif>{{ trans('labels.First Banner For Banner Style 10 & 11 & 12') }}</option>
                                          <option value="22" @if($result['banners'][0]->type==22) selected @endif>{{ trans('labels.Second Banner For Banner Style 10 & 11 & 12') }}</option>
                                          <option value="23" @if($result['banners'][0]->type==23) selected @endif>{{ trans('labels.Third Banner For Banner Style 10 & 11 & 12') }}</option>
                                          <option value="24" @if($result['banners'][0]->type==24) selected @endif>{{ trans('labels.Fourth Banner For Banner Style 10 & 11 & 12') }}</option>
                                          <option value="25" @if($result['banners'][0]->type==25) selected @endif>{{ trans('labels.First Banner For Banner Style 13 & 14 & 15') }}</option>
                                          <option value="26" @if($result['banners'][0]->type==26) selected @endif>{{ trans('labels.Second Banner For Banner Style 13 & 14 & 15') }}</option>
                                          <option value="27" @if($result['banners'][0]->type==27) selected @endif>{{ trans('labels.Third Banner For Banner Style 13 & 14 & 15') }}</option>
                                          <option value="28" @if($result['banners'][0]->type==28) selected @endif>{{ trans('labels.Fourth Banner For Banner Style 13 & 14 & 15') }}</option>
                                          <option value="29" @if($result['banners'][0]->type==29) selected @endif>{{ trans('labels.Fifth Banner For Banner Style 13 & 14 & 15') }}</option>
                                          <option value="30" @if($result['banners'][0]->type==30) selected @endif>{{ trans('labels.First Banner For Banner Style 16 & 17') }}</option>
                                          <option value="31" @if($result['banners'][0]->type==31) selected @endif>{{ trans('labels.Second Banner For Banner Style 16 & 17') }}</option>
                                          <option value="32" @if($result['banners'][0]->type==32) selected @endif>{{ trans('labels.Third Banner For Banner Style 16 & 17') }}</option>
                                          <option value="33" @if($result['banners'][0]->type==33) selected @endif>{{ trans('labels.First Banner For Banner Style 18 & 19') }}</option>
                                          <option value="34" @if($result['banners'][0]->type==34) selected @endif>{{ trans('labels.Second Banner For Banner Style 18 & 19') }}</option>
                                          <option value="35" @if($result['banners'][0]->type==35) selected @endif>{{ trans('labels.Third Banner For Banner Style 18 & 19') }}</option>
                                          <option value="36" @if($result['banners'][0]->type==36) selected @endif>{{ trans('labels.Fourth Banner For Banner Style 18 & 19') }}</option>
                                          <option value="37" @if($result['banners'][0]->type==37) selected @endif>{{ trans('labels.Fifth Banner For Banner Style 18 & 19') }}</option>
                                          <option value="38" @if($result['banners'][0]->type==38) selected @endif>{{ trans('labels.Sixth Banner For Banner Style 18 & 19') }}</option>
                                          <option value="39" @if($result['banners'][0]->type==39) selected @endif>{{ trans('labels.Home Page First Banner') }}</option>
                                          <option value="40" @if($result['banners'][0]->type==40) selected @endif>{{ trans('labels.Home Page Second Banner') }}</option>

                                         
                                          <option value="42" @if($result['banners'][0]->type==42) selected @endif>{{ trans('labels.Second Banner For Banner Style 2 & 3 & 4') }}</option>
                                          <option value="43" @if($result['banners'][0]->type==43) selected @endif>{{ trans('labels.Third Banner For Banner Style 2 & 3 & 4') }}</option>
                                          <option value="44" @if($result['banners'][0]->type==44) selected @endif>{{ trans('labels.Fourth Banner For Banner Style 2 & 3 & 4') }}</option>

                                          <option value="45" @if($result['banners'][0]->type==45) selected @endif>{{ trans('labels.First Banner For Banner Style 2 & 3 & 4') }}</option>
                                          <option value="46" @if($result['banners'][0]->type==46) selected @endif>{{ trans('labels.Second Banner For Banner Style 2 & 3 & 4') }}</option>
                                          <option value="47" @if($result['banners'][0]->type==47) selected @endif>{{ trans('labels.Third Banner For Banner Style 2 & 3 & 4') }}</option>
                                          <option value="48" @if($result['banners'][0]->type==48) selected @endif>{{ trans('labels.Fourth Banner For Banner Style 2 & 3 & 4') }}</option>
                                          <option value="49" @if($result['banners'][0]->type==49) selected @endif>{{ trans('labels.First Banner For Banner Style 2 & 3 & 4') }}</option>
                                          <option value="50" @if($result['banners'][0]->type==50) selected @endif>{{ trans('labels.First Banner For Banner Style 5 & 6') }}</option>
                                          <option value="51" @if($result['banners'][0]->type==51) selected @endif>{{ trans('labels.Second Banner For Banner Style 5 & 6') }}</option>
                                          <option value="52" @if($result['banners'][0]->type==52) selected @endif>{{ trans('labels.Third Banner For Banner Style 5 & 6') }}</option>
                                          <option value="53" @if($result['banners'][0]->type==53) selected @endif>{{ trans('labels.Fourth Banner For Banner Style 5 & 6') }}</option>
                                          <option value="54" @if($result['banners'][0]->type==54) selected @endif>{{ trans('labels.Fifth Banner For Banner Style 5 & 6') }}</option>
                                          <option value="55" @if($result['banners'][0]->type==55) selected @endif>{{ trans('labels.First Banner For Banner Style 7 & 8') }}</option>
                                          <option value="56" @if($result['banners'][0]->type==56) selected @endif>{{ trans('labels.Second Banner For Banner Style 7 & 8') }}</option>
                                          <option value="57" @if($result['banners'][0]->type==57) selected @endif>{{ trans('labels.Third Banner For Banner Style 7 & 8') }}</option>
                                          <option value="58" @if($result['banners'][0]->type==58) selected @endif>{{ trans('labels.Fourth Banner For Banner Style 7 & 8') }}</option>
                                          <option value="59" @if($result['banners'][0]->type==59) selected @endif>{{ trans('labels.First Banner For Banner Style 10 & 11 & 12') }}</option>
                                          <option value="60" @if($result['banners'][0]->type==60) selected @endif>{{ trans('labels.Second Banner For Banner Style 10 & 11 & 12') }}</option>
                                          <option value="61" @if($result['banners'][0]->type==61) selected @endif>{{ trans('labels.Third Banner For Banner Style 10 & 11 & 12') }}</option>
                                          <option value="62" @if($result['banners'][0]->type==62) selected @endif>{{ trans('labels.Fourth Banner For Banner Style 10 & 11 & 12') }}</option>
                                          <option value="63" @if($result['banners'][0]->type==63) selected @endif>{{ trans('labels.First Banner For Banner Style 10 & 11 & 12') }}</option>
                                          <option value="64" @if($result['banners'][0]->type==64) selected @endif>{{ trans('labels.Second Banner For Banner Style 10 & 11 & 12') }}</option>
                                          <option value="65" @if($result['banners'][0]->type==65) selected @endif>{{ trans('labels.Third Banner For Banner Style 10 & 11 & 12') }}</option>
                                          <option value="66" @if($result['banners'][0]->type==66) selected @endif>{{ trans('labels.Fourth Banner For Banner Style 10 & 11 & 12') }}</option>
                                          <option value="67" @if($result['banners'][0]->type==67) selected @endif>{{ trans('labels.First Banner For Banner Style 13 & 14 & 15') }}</option>
                                          <option value="68" @if($result['banners'][0]->type==68) selected @endif>{{ trans('labels.Second Banner For Banner Style 13 & 14 & 15') }}</option>
                                          <option value="69" @if($result['banners'][0]->type==69) selected @endif>{{ trans('labels.Third Banner For Banner Style 13 & 14 & 15') }}</option>
                                          <option value="70" @if($result['banners'][0]->type==70) selected @endif>{{ trans('labels.Fourth Banner For Banner Style 13 & 14 & 15') }}</option>
                                          <option value="71" @if($result['banners'][0]->type==71) selected @endif>{{ trans('labels.Fifth Banner For Banner Style 13 & 14 & 15') }}</option> <option value="72" @if($result['banners'][0]->type==72) selected @endif>{{ trans('labels.First Banner For Banner Style 13 & 14 & 15') }}</option>
                                          <option value="73" @if($result['banners'][0]->type==73) selected @endif>{{ trans('labels.Second Banner For Banner Style 13 & 14 & 15') }}</option>
                                          <option value="74" @if($result['banners'][0]->type==74) selected @endif>{{ trans('labels.Third Banner For Banner Style 13 & 14 & 15') }}</option>
                                          <option value="75" @if($result['banners'][0]->type==75) selected @endif>{{ trans('labels.Fourth Banner For Banner Style 13 & 14 & 15') }}</option>
                                          <option value="76" @if($result['banners'][0]->type==76) selected @endif>{{ trans('labels.Fifth Banner For Banner Style 13 & 14 & 15') }}</option>
                                          <option value="77" @if($result['banners'][0]->type==77) selected @endif>{{ trans('labels.First Banner For Banner Style 16 & 17') }}</option>
                                          <option value="78" @if($result['banners'][0]->type==78) selected @endif>{{ trans('labels.Second Banner For Banner Style 16 & 17') }}</option>
                                          <option value="79" @if($result['banners'][0]->type==79) selected @endif>{{ trans('labels.Third Banner For Banner Style 16 & 17') }}</option>
                                          <option value="80" @if($result['banners'][0]->type==80) selected @endif>{{ trans('labels.First Banner For Banner Style 18 & 19') }}</option>
                                          <option value="81" @if($result['banners'][0]->type==81) selected @endif>{{ trans('labels.Second Banner For Banner Style 18 & 19') }}</option>
                                          <option value="82" @if($result['banners'][0]->type==82) selected @endif>{{ trans('labels.Third Banner For Banner Style 18 & 19') }}</option>
                                          <option value="124" @if($result['banners'][0]->type==124) selected @endif>{{ trans('labels.Fourth Banner For Banner Style 18 & 19') }}</option>
                                          <option value="125" @if($result['banners'][0]->type==125) selected @endif>{{ trans('labels.Fifth Banner For Banner Style 18 & 19') }}</option>
                                          <option value="126" @if($result['banners'][0]->type==126) selected @endif>{{ trans('labels.Sixth Banner For Banner Style 18 & 19') }}</option>
                                          <option value="127" @if($result['banners'][0]->type==127) selected @endif>{{ trans('labels.Right And Left Carousel Side Banner 1') }}</option>
                                          <option value="128" @if($result['banners'][0]->type==128) selected @endif>{{ trans('labels.Right And Left Carousel Side Banner 2') }}</option>
                                          <option value="129" @if($result['banners'][0]->type==129) selected @endif>{{ trans('labels. Banner Style 20') }}</option>
                                          <option value="130" @if($result['banners'][0]->type==130) selected @endif>{{ trans('labels. Banner Style 20') }}</option>
                                          <option value="131" @if($result['banners'][0]->type==131) selected @endif>{{ trans('labels. Banner Style 20') }}</option>
                                          <option value="132" @if($result['banners'][0]->type==132) selected @endif>{{ trans('labels. Banner Style 20') }}</option>

                                          <option value="133" @if($result['banners'][0]->type==133) selected @endif>{{ trans('labels. Banner Style 22') }}</option>
                                          <option value="134" @if($result['banners'][0]->type==134) selected @endif>{{ trans('labels. Banner Style 22') }}</option>
                                          <option value="135" @if($result['banners'][0]->type==135) selected @endif>{{ trans('labels. Banner Style 22') }}</option>

                                          <option value="136" @if($result['banners'][0]->type==136) selected @endif>{{ trans('labels. Banner Style 23') }}</option>
                                          <option value="137" @if($result['banners'][0]->type==137) selected @endif>{{ trans('labels. Banner Style 23') }}</option>
                                          

                                          <option value="138" @if($result['banners'][0]->type==138) selected @endif>{{ trans('labels. Banner Style 24') }}</option>
                                          <option value="139" @if($result['banners'][0]->type==139) selected @endif>{{ trans('labels. Banner Style 24') }}</option>
                                          <option value="140" @if($result['banners'][0]->type==140) selected @endif>{{ trans('labels. Banner Style 24') }}</option>
                                          <option value="141" @if($result['banners'][0]->type==141) selected @endif>{{ trans('labels. Banner Style 24') }}</option>
                                          <option value="142" @if($result['banners'][0]->type==142) selected @endif>{{ trans('labels. Banner Style 24') }}</option>

                                          <option value="143" @if($result['banners'][0]->type==143) selected @endif>{{ trans('labels. Banner Style 25') }}</option>
                                          <option value="144" @if($result['banners'][0]->type==144) selected @endif>{{ trans('labels. Banner Style 25') }}</option>
                                          <option value="145" @if($result['banners'][0]->type==145) selected @endif>{{ trans('labels. Banner Style 25') }}</option>
                                          
                                          <option value="146" @if($result['banners'][0]->type==146) selected @endif>{{ trans('labels. Banner Style 26') }}</option>
                                          <option value="147" @if($result['banners'][0]->type==147) selected @endif>{{ trans('labels. Banner Style 26') }}</option>
                                          <option value="148" @if($result['banners'][0]->type==148) selected @endif>{{ trans('labels. Banner Style 26') }}</option>
                                          <option value="149" @if($result['banners'][0]->type==149) selected @endif>{{ trans('labels. Banner Style 26') }}</option>


                                          <option value="150" @if($result['banners'][0]->type==150) selected @endif>{{ trans('labels. Banner Style 27') }}</option>
                                          <option value="151" @if($result['banners'][0]->type==151) selected @endif>{{ trans('labels. Banner Style 27') }}</option>
                                          <option value="152" @if($result['banners'][0]->type==152) selected @endif>{{ trans('labels. Banner Style 27') }}</option>
                                          <option value="153" @if($result['banners'][0]->type==153) selected @endif>{{ trans('labels. Banner Style 27') }}</option>


                                          <option value="154" @if($result['banners'][0]->type==154) selected @endif>{{ trans('labels. Banner Style 28') }}</option>
                                          <option value="155" @if($result['banners'][0]->type==155) selected @endif>{{ trans('labels. Banner Style 28') }}</option>
                                          <option value="156" @if($result['banners'][0]->type==156) selected @endif>{{ trans('labels. Banner Style 28') }}</option>


                                          <option value="157" @if($result['banners'][0]->type==157) selected @endif>{{ trans('labels. Banner Style 29') }}</option>
                                          <option value="158" @if($result['banners'][0]->type==158) selected @endif>{{ trans('labels. Banner Style 29') }}</option>
                                          <option value="159" @if($result['banners'][0]->type==159) selected @endif>{{ trans('labels. Banner Style 29') }}</option>
                                          <option value="160" @if($result['banners'][0]->type==160) selected @endif>{{ trans('labels. Banner Style 29') }}</option>
                                          <option value="161" @if($result['banners'][0]->type==161) selected @endif>{{ trans('labels. Banner Style 29') }}</option>


                                          <option value="162" @if($result['banners'][0]->type==162) selected @endif>{{ trans('labels. Banner Style 30') }}</option>
                                          <option value="163" @if($result['banners'][0]->type==163) selected @endif>{{ trans('labels. Banner Style 30') }}</option>
                                          <option value="164" @if($result['banners'][0]->type==164) selected @endif>{{ trans('labels. Banner Style 30') }}</option>
                                          <option value="165" @if($result['banners'][0]->type==165) selected @endif>{{ trans('labels. Banner Style 30') }}</option>
                                          
                                          
                                          <option value="166" @if($result['banners'][0]->type==166) selected @endif>{{ trans('labels. Banner Style 31') }}</option>
                                          <option value="167" @if($result['banners'][0]->type==167) selected @endif>{{ trans('labels. Banner Style 31') }}</option>
                                          <option value="168" @if($result['banners'][0]->type==168) selected @endif>{{ trans('labels. Banner Style 31') }}</option>


                                          <option value="169" @if($result['banners'][0]->type==169) selected @endif>{{ trans('labels. Banner Style 32') }}</option>
                                          <option value="170" @if($result['banners'][0]->type==170) selected @endif>{{ trans('labels. Banner Style 32') }}</option>
                                          <option value="171" @if($result['banners'][0]->type==171) selected @endif>{{ trans('labels. Banner Style 32') }}</option>
                                          <option value="172" @if($result['banners'][0]->type==172) selected @endif>{{ trans('labels. Banner Style 32') }}</option>
                                          <option value="173" @if($result['banners'][0]->type==173) selected @endif>{{ trans('labels. Banner Style 32') }}</option>

                                          <option value="174" @if($result['banners'][0]->type==174) selected @endif>{{ trans('labels. Banner Style 33') }}</option>
                                          <option value="175" @if($result['banners'][0]->type==175) selected @endif>{{ trans('labels. Banner Style 33') }}</option>
                                          <option value="176" @if($result['banners'][0]->type==176) selected @endif>{{ trans('labels. Banner Style 33') }}</option>
                                          <option value="177" @if($result['banners'][0]->type==177) selected @endif>{{ trans('labels. Banner Style 33') }}</option>


                                          <option value="193" @if($result['banners'][0]->type==193) selected @endif>{{ trans('labels. Banner Style 34') }}</option>
                                          <option value="194" @if($result['banners'][0]->type==194) selected @endif>{{ trans('labels. Banner Style 34') }}</option>

                                          <option value="195" @if($result['banners'][0]->type==195) selected @endif>{{ trans('labels. Banner Style 35') }}</option>
                                          <option value="196" @if($result['banners'][0]->type==196) selected @endif>{{ trans('labels. Banner Style 35') }}</option>
                                          <option value="197" @if($result['banners'][0]->type==197) selected @endif>{{ trans('labels. Banner Style 35') }}</option>
                                          <option value="198" @if($result['banners'][0]->type==198) selected @endif>{{ trans('labels. Banner Style 35') }}</option>

                                          <option value="199" @if($result['banners'][0]->type==199) selected @endif>{{ trans('labels. Banner Style 36') }}</option>
                                          <option value="200" @if($result['banners'][0]->type==200) selected @endif>{{ trans('labels. Banner Style 36') }}</option>
                                          <option value="201" @if($result['banners'][0]->type==201) selected @endif>{{ trans('labels. Banner Style 36') }}</option>
                                          <option value="202" @if($result['banners'][0]->type==202) selected @endif>{{ trans('labels. Banner Style 36') }}</option>
                                          <option value="203" @if($result['banners'][0]->type==203) selected @endif>{{ trans('labels. Banner Style 36') }}</option>
                                          <option value="204" @if($result['banners'][0]->type==204) selected @endif>{{ trans('labels. Banner Style 36') }}</option>

                                          <option value="205" @if($result['banners'][0]->type==205) selected @endif>{{ trans('labels. Banner Style 37') }}</option>
                                          <option value="206" @if($result['banners'][0]->type==206) selected @endif>{{ trans('labels. Banner Style 37') }}</option>
                                          <option value="207" @if($result['banners'][0]->type==207) selected @endif>{{ trans('labels. Banner Style 37') }}</option>

                                          <option value="208" @if($result['banners'][0]->type==208) selected @endif>{{ trans('labels. Banner Style 38') }}</option>
                                          <option value="209" @if($result['banners'][0]->type==209) selected @endif>{{ trans('labels. Banner Style 38') }}</option>
                                          <option value="210" @if($result['banners'][0]->type==210) selected @endif>{{ trans('labels. Banner Style 38') }}</option>


                                          <option value="212" @if($result['banners'][0]->type==212) selected @endif>{{ trans('labels. Banner Style 39') }}</option>
                                          <option value="213" @if($result['banners'][0]->type==213) selected @endif>{{ trans('labels. Banner Style 39') }}</option>
                                          <option value="214" @if($result['banners'][0]->type==214) selected @endif>{{ trans('labels. Banner Style 39') }}</option>
                                          <option value="215" @if($result['banners'][0]->type==215) selected @endif>{{ trans('labels. Banner Style 39') }}</option>

                                          <option value="211" @if($result['banners'][0]->type==211) selected @endif>Flash Sale 1</option>


                                          <option value="39" @if($result['banners'][0]->type==39) selected @endif>{{ trans('labels.Home Page First Banner') }}</option>
                                          <option value="40" @if($result['banners'][0]->type==40) selected @endif>{{ trans('labels.Home Page Second Banner') }}</option>


                                          <option value="178" @if($result['banners'][0]->type==178) selected @endif>@lang('labels.Slider with 1 Thumbs') </option>

                                          <option value="180" @if($result['banners'][0]->type==180) selected @endif>@lang('labels.Slider with 2 Thumbs') </option>
                                          <option value="181" @if($result['banners'][0]->type==181) selected @endif>@lang('labels.Slider with 2 Thumbs') </option>

                                          <option value="182" @if($result['banners'][0]->type==182) selected @endif>@lang('labels.Slider with 3 Thumbs') </option>
                                          <option value="183" @if($result['banners'][0]->type==183) selected @endif>@lang('labels.Slider with 3 Thumbs') </option>
                                          <option value="184" @if($result['banners'][0]->type==184) selected @endif>@lang('labels.Slider with 3 Thumbs') </option>

                                          <option value="185" @if($result['banners'][0]->type==185) selected @endif>@lang('labels.Slider with 3 Bottom Thumbs') </option>
                                          <option value="186" @if($result['banners'][0]->type==186) selected @endif>@lang('labels.Slider with 3 Bottom Thumbs') </option>
                                          <option value="187" @if($result['banners'][0]->type==187) selected @endif>@lang('labels.Slider with 3 Bottom Thumbs') </option>


                                          <option value="188" @if($result['banners'][0]->type==188) selected @endif>@lang('labels.Slider with 3 Bottom Thumbs1') </option>
                                          <option value="189" @if($result['banners'][0]->type==189) selected @endif>@lang('labels.Slider with 3 Bottom Thumbs1') </option>
                                          <option value="190" @if($result['banners'][0]->type==190) selected @endif>@lang('labels.Slider with 3 Bottom Thumbs1') </option>

                                          <option value="191" @if($result['banners'][0]->type==191) selected @endif>@lang('labels.Carousal 19 Right Thumbs') </option>
                                          <option value="192" @if($result['banners'][0]->type==192) selected @endif>@lang('labels.Carousal 19 Right Thumbs') </option>

                                          <option value="216" @if($result['banners'][0]->type==216) selected @endif>Trending Product Banner (demo-3)</option>


                                          <option value="217" @if($result['banners'][0]->type==217) selected @endif>Banner Style 40 </option>
                                          <option value="218" @if($result['banners'][0]->type==218) selected @endif>{{ trans('labels. Banner Style 40') }}</option>
                                          <option value="219" @if($result['banners'][0]->type==219) selected @endif>{{ trans('labels. Banner Style 40') }}</option>

                                          <option value="220" @if($result['banners'][0]->type==220) selected @endif>demo5 banner</option>

                                          <option value="221" @if($result['banners'][0]->type==221) selected @endif>Special Product ( demo-5)</option>

                                          <option value="222" @if($result['banners'][0]->type==222) selected @endif>Banner 43</option>

                                          <option value="223" @if($result['banners'][0]->type==223) selected @endif>Banner 44</option>
                                          <option value="224" @if($result['banners'][0]->type==224) selected @endif>Banner 44</option>

                                          <option value="225" @if($result['banners'][0]->type==225) selected @endif>Banner 45</option>
                                          <option value="226" @if($result['banners'][0]->type==226) selected @endif>Banner 45</option>

                                          <option value="227" @if($result['banners'][0]->type==227) selected @endif>Banner 46</option>
                                          <option value="228" @if($result['banners'][0]->type==228) selected @endif>Banner 46</option>
                                          <option value="229" @if($result['banners'][0]->type==229) selected @endif>Banner 46</option>

                                          
                                          <option value="230" @if($result['banners'][0]->type==230) selected @endif>Banner 47</option>
                                          <option value="231" @if($result['banners'][0]->type==231) selected @endif>Banner 47</option>

                                          <option value="232" @if($result['banners'][0]->type==232) selected @endif>Banner 48</option>
                                          <option value="233" @if($result['banners'][0]->type==233) selected @endif>Banner 48</option>
                                          <option value="234" @if($result['banners'][0]->type==234) selected @endif>Banner 48</option>

                                          <option value="235" @if($result['banners'][0]->type==235) selected @endif>Banner 49</option>
                                          <option value="236" @if($result['banners'][0]->type==236) selected @endif>Banner 49</option>
                                          <option value="237" @if($result['banners'][0]->type==237) selected @endif>Banner 49</option>

                                          
                                          <option value="238" @if($result['banners'][0]->type==238) selected @endif>Banner 50</option>
                                          <option value="239" @if($result['banners'][0]->type==239) selected @endif>Banner 50</option>

                                          <option value="240" @if($result['banners'][0]->type==240) selected @endif>Banner 51</option>
                                          <option value="241" @if($result['banners'][0]->type==241) selected @endif>Banner 51</option>
                                          <option value="242" @if($result['banners'][0]->type==242) selected @endif>Banner 51</option>

                                          <option value="243" @if($result['banners'][0]->type==243) selected @endif>Banner 52</option>
                                          <option value="244" @if($result['banners'][0]->type==244) selected @endif>Banner 52</option>


                                          <option value="245" @if($result['banners'][0]->type==245) selected @endif>Tending Product (Demo-15)</option>
                                          <option value="246" @if($result['banners'][0]->type==246) selected @endif>Special Product (Demo-15)</option>
                                          <option value="247" @if($result['banners'][0]->type==247) selected @endif>Recent Arrival (Demo-15)</option>
                                          <option value="248" @if($result['banners'][0]->type==248) selected @endif>Top Sell (Demo-15)</option>

                                          <option value="249" @if($result['banners'][0]->type==249) selected @endif>Banner 53</option>


                                          <option value="250" @if($result['banners'][0]->type==250) selected @endif>Top Sell 7 Banner1 (Demo-16)</option>
                                          <option value="251" @if($result['banners'][0]->type==251) selected @endif>Top Sell 7 Banner2 (Demo-16)</option>

                                          <option value="252" @if($result['banners'][0]->type==252) selected @endif>Banner 54</option>
                                          <option value="253" @if($result['banners'][0]->type==253) selected @endif>Banner 54</option> 
                                          <option value="254" @if($result['banners'][0]->type==254) selected @endif>Banner 54</option>
                                          <option value="255" @if($result['banners'][0]->type==255) selected @endif>Banner 54</option>

                                          <option value="256" @if($result['banners'][0]->type==256) selected @endif>Recent 16 Banner (Demo-16)</option>

                                          <option value="257" @if($result['banners'][0]->type==257) selected @endif>Banner 55</option>
                                          <option value="258" @if($result['banners'][0]->type==258) selected @endif>Banner 55</option>
                                          <option value="259" @if($result['banners'][0]->type==259) selected @endif>Banner 55</option>
                                          <option value="260" @if($result['banners'][0]->type==260) selected @endif>Banner 55</option>
                                          <option value="261" @if($result['banners'][0]->type==261) selected @endif>Banner 55</option>

                                          <option value="262" @if($result['banners'][0]->type==262) selected @endif>Banner 56</option>
                                          <option value="263" @if($result['banners'][0]->type==263) selected @endif>Banner 56</option>
                                          <option value="264" @if($result['banners'][0]->type==264) selected @endif>Banner 56</option>


                                          <option value="265" @if($result['banners'][0]->type==265) selected @endif>Banner 57</option>
                                          <option value="266" @if($result['banners'][0]->type==266) selected @endif>Banner 57</option>
                                          <option value="267" @if($result['banners'][0]->type==267) selected @endif>Banner 57</option>
                                          <option value="268" @if($result['banners'][0]->type==268) selected @endif>Banner 57</option>

                                          <option value="269" @if($result['banners'][0]->type==269) selected @endif>Banner 58</option>
                                          <option value="270" @if($result['banners'][0]->type==270) selected @endif>Banner 58</option>
                                          <option value="271" @if($result['banners'][0]->type==271) selected @endif>Banner 58</option>

                                          <option value="272" @if($result['banners'][0]->type==272) selected @endif>Recent 18 Banner (Demo-20)</option>
                                          <option value="273" @if($result['banners'][0]->type==273) selected @endif>Recent 18 Banner (Demo-20)</option>
                                          
                                          <option value="274" @if($result['banners'][0]->type==274) selected @endif>Special Product (Demo-21)</option>

                                          <option value="275" @if($result['banners'][0]->type==275) selected @endif>Banner 59</option>
                                          <option value="276" @if($result['banners'][0]->type==276) selected @endif>Banner 59</option>

                                          <option value="277" @if($result['banners'][0]->type==277) selected @endif>Banner 60</option>
                                          <option value="278" @if($result['banners'][0]->type==278) selected @endif>Banner 60</option>
                                          <option value="279" @if($result['banners'][0]->type==279) selected @endif>Banner 60</option>


                                          <option value="280" @if($result['banners'][0]->type==280) selected @endif>Special Product (Demo-23)</option>
                                          <option value="281" @if($result['banners'][0]->type==281) selected @endif>New Arrival (Demo-23)</option>

                                          <option value="282" @if($result['banners'][0]->type==282) selected @endif>Banner 61</option>
                                          <option value="283" @if($result['banners'][0]->type==283) selected @endif>Banner 61</option>
                                          <option value="284" @if($result['banners'][0]->type==284) selected @endif>Banner 61</option>

                                          <option value="285" @if($result['banners'][0]->type==285) selected @endif>Banner 62</option>
                                          <option value="286" @if($result['banners'][0]->type==286) selected @endif>Banner 62</option>
                                          <option value="287" @if($result['banners'][0]->type==287) selected @endif>Banner 62</option>
                                          <option value="288" @if($result['banners'][0]->type==288) selected @endif>Banner 62</option>
                                          <option value="289" @if($result['banners'][0]->type==289) selected @endif>Banner 62</option>

                                          <option value="290" @if($result['banners'][0]->type==290) selected @endif>Banner 63</option>
                                          <option value="291" @if($result['banners'][0]->type==291) selected @endif>Banner 63</option>
                                          <option value="292" @if($result['banners'][0]->type==292) selected @endif>Banner 63</option>
                                          <option value="293" @if($result['banners'][0]->type==293) selected @endif>Banner 63</option>

                                          <option value="294" @if($result['banners'][0]->type==294) selected @endif>Banner 64</option>

                                          <option value="295" @if($result['banners'][0]->type==295) selected @endif>Special Product (Demo-25)</option>
                                          <option value="296" @if($result['banners'][0]->type==296) selected @endif>Special Product (Demo-25)</option>

                                          <option value="297" @if($result['banners'][0]->type==297) selected @endif>Banner 65</option>
                                          <option value="298" @if($result['banners'][0]->type==298) selected @endif>Banner 65</option>


                                          <option value="299" @if($result['banners'][0]->type==299) selected @endif>Tab Section (Demo-22)</option>
                                          <option value="300" @if($result['banners'][0]->type==300) selected @endif>Top selling (Demo-26)</option>
                                          <option value="301" @if($result['banners'][0]->type==301) selected @endif>Trending Product (Demo-26)</option>

                                          <option value="302" @if($result['banners'][0]->type==302) selected @endif>Banner 66 (Demo-27)</option>

                                          <option value="303" @if($result['banners'][0]->type==303) selected @endif>Top Selling (Demo-27)</option>
                                          <option value="304" @if($result['banners'][0]->type==304) selected @endif>Trending Product (Demo-27)</option>


                                          <option value="305" @if($result['banners'][0]->type==305) selected @endif>Banner 67</option>
                                          <option value="306" @if($result['banners'][0]->type==306) selected @endif>Banner 67</option>

                                          <option value="307" @if($result['banners'][0]->type==307) selected @endif>Banner 68</option>

                                          <option value="308" @if($result['banners'][0]->type==308) selected @endif>Banner 69</option>
                                          <option value="309" @if($result['banners'][0]->type==309) selected @endif>Banner 69</option>
                                          <option value="310" @if($result['banners'][0]->type==310) selected @endif>Banner 69</option>

                                          <option value="311" @if($result['banners'][0]->type==311) selected @endif>Banner 70</option>

                                          <option value="312" @if($result['banners'][0]->type==312) selected @endif>Banner 71</option>
                                          <option value="313" @if($result['banners'][0]->type==313) selected @endif>Banner 71</option>
                                          <option value="314" @if($result['banners'][0]->type==314) selected @endif>Banner 71</option>

                                          <option value="315" @if($result['banners'][0]->type==315) selected @endif>Banner 72</option>
                                          <option value="316" @if($result['banners'][0]->type==316) selected @endif>Banner 72</option>


                                          <option value="317" @if($result['banners'][0]->type==317) selected @endif>Banner 72</option>
                                          <option value="318" @if($result['banners'][0]->type==318) selected @endif>Banner 72</option>
                                          <option value="319" @if($result['banners'][0]->type==319) selected @endif>Banner 72</option>

                                          <option value="320" @if($result['banners'][0]->type==320) selected @endif>Banner 73</option>
                                          <option value="321" @if($result['banners'][0]->type==321) selected @endif>Banner 73</option>


                                          <option value="322" @if($result['banners'][0]->type==322) selected @endif>Special Offer ( Demo-14 )</option>
                                          <option value="323" @if($result['banners'][0]->type==323) selected @endif>New Arrival ( Demo-14 )</option>
                                          <option value="324" @if($result['banners'][0]->type==324) selected @endif>Top Sell ( Demo-14 )</option>
                                          <option value="325" @if($result['banners'][0]->type==325) selected @endif>Special Product ( Demo-14 )</option>
                                          <option value="326" @if($result['banners'][0]->type==326) selected @endif>Top Product ( Demo-14 )</option>

                                          <option value="327" @if($result['banners'][0]->type==327) selected @endif>Special Product ( Demo-9 )</option>
                                          <option value="328" @if($result['banners'][0]->type==328) selected @endif>Recent  Product ( Demo-9 )</option>


                                      </select>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.AddBannerText') }}</span>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Constant Image') }}</label>
                                    <div class="col-sm-10 col-md-4">
                                        {{--{!! Form::file('newImage', array('id'=>'newImage')) !!}--}}
                                        <!-- Modal -->
                                            <div class="modal fade embed-images" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" id ="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                            <h3 class="modal-title text-primary" id="myModalLabel">{{ trans('labels.Choose Constant Image') }} </h3>
                                                        </div>
                                                        <div class="modal-body manufacturer-image-embed">
                                                            @if(isset($allimage))
                                                                <select class="image-picker show-html " name="image_id" id="select_img">
                                                                    <option  value=""></option>
                                                                    @foreach($allimage as $key=>$image)
                                                                        <option data-img-src="{{asset($image->path)}}"  class="imagedetail" data-img-alt="{{$key}}" value="{{$image->id}}"> {{$image->id}} </option>
                                                                    @endforeach
                                                                </select>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                          <a href="{{url('admin/media/add')}}" target="_blank" class="btn btn-primary pull-left" >{{ trans('labels.Add Icon') }}</a>
                                                          <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                          <button type="button" class="btn btn-success" id="selectedICONE" data-dismiss="modal">{{ trans('labels.Done') }}</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div  id ="imageselected">
                                                {!! Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )) !!}
                                                <div id="selectedthumbnailIcon" style="display:none" class="selectedthumbnail col-md-12"> </div>
                                                <div class="closimage">
                                                    <button type="button" class="close pull-left image-close " id="image-Icone"
                                                    style="display:none; position: absolute;left: -3px !important;top: 15px !important;background-color: black;color: white;opacity: 2.2;" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <br>
                                                {!! Form::hidden('oldImage', $result['languages'][0]->image, array('id'=>'oldImage')) !!}
                                                @if(($result['languages'][0]->path!== null))
                                                @if($result['banners'][0]->path_type == 'aws')
                                                    <img style="max-width: 100%;height:100px;" src="{{$result['banners'][0]->path}}" class="">
                                                    @else
                                                    <img style="max-width: 100%;height:100px;" src="{{asset('').$result['banners'][0]->path}}" class="">
                                                    @endif

                                                @else
                                                @if($result['banners'][0]->path_type == 'aws')
                                                    <img style="max-width: 100%;height:100px;" src="{{$result['banners'][0]->path}}" class="">
                                                    @else
                                                    <img style="max-width: 100%;height:100px;" src="{{asset('').$result['banners'][0]->path}}" class="">
                                                    @endif
                                                @endif

                                            </div>
                                    </div>
                                </div>

                               

                                @if(
                                  $result['banners'][0]->type==3 || $result['banners'][0]->type==4 || $result['banners'][0]->type==5 || $result['banners'][0]->type==129 || $result['banners'][0]->type==130 || $result['banners'][0]->type==131 || $result['banners'][0]->type==132 || $result['banners'][0]->type==133 || $result['banners'][0]->type==134 || $result['banners'][0]->type==135 || $result['banners'][0]->type==136 || $result['banners'][0]->type==137 || $result['banners'][0]->type==138 || $result['banners'][0]->type==139 || $result['banners'][0]->type==140 || $result['banners'][0]->type==141 || $result['banners'][0]->type==142 || $result['banners'][0]->type==143 || $result['banners'][0]->type==144 || $result['banners'][0]->type==145 || $result['banners'][0]->type==146 || $result['banners'][0]->type==147 || $result['banners'][0]->type==148 || $result['banners'][0]->type==149 || $result['banners'][0]->type==150 || $result['banners'][0]->type==151 || $result['banners'][0]->type==152 || $result['banners'][0]->type==153 || $result['banners'][0]->type==154 || $result['banners'][0]->type==155 || $result['banners'][0]->type==156 || $result['banners'][0]->type==162 || $result['banners'][0]->type==163 || $result['banners'][0]->type==164 || $result['banners'][0]->type==165 || $result['banners'][0]->type==166 || $result['banners'][0]->type==167 || $result['banners'][0]->type==168 || $result['banners'][0]->type==169 || $result['banners'][0]->type==170 || $result['banners'][0]->type==171 || $result['banners'][0]->type==172 || $result['banners'][0]->type==173 || $result['banners'][0]->type==174 || $result['banners'][0]->type==175 || $result['banners'][0]->type==176 || $result['banners'][0]->type==177 || $result['banners'][0]->type==205 || $result['banners'][0]->type==206 || $result['banners'][0]->type==207 || $result['banners'][0]->type==208 || $result['banners'][0]->type==209 || $result['banners'][0]->type==210 || $result['banners'][0]->type==217 || $result['banners'][0]->type==218 || $result['banners'][0]->type==219 || $result['banners'][0]->type==220 || $result['banners'][0]->type==222 || $result['banners'][0]->type==223 || $result['banners'][0]->type==224 || $result['banners'][0]->type==225 || $result['banners'][0]->type==226 || $result['banners'][0]->type==227 || $result['banners'][0]->type==228 || $result['banners'][0]->type==229 || $result['banners'][0]->type==230 || $result['banners'][0]->type==232 || $result['banners'][0]->type==233 || $result['banners'][0]->type==234 || $result['banners'][0]->type==235 || $result['banners'][0]->type==236 || $result['banners'][0]->type==237 || $result['banners'][0]->type==238 || $result['banners'][0]->type==239 || $result['banners'][0]->type==240 || $result['banners'][0]->type==241 || $result['banners'][0]->type==242 || $result['banners'][0]->type==243 || $result['banners'][0]->type==244 || $result['banners'][0]->type==249 || $result['banners'][0]->type==252 || $result['banners'][0]->type==253 || $result['banners'][0]->type==254 || $result['banners'][0]->type==255 || $result['banners'][0]->type==257 || $result['banners'][0]->type==258 || $result['banners'][0]->type==259 || $result['banners'][0]->type==260 || $result['banners'][0]->type==261 || $result['banners'][0]->type==262 || $result['banners'][0]->type==263 || $result['banners'][0]->type==264 || $result['banners'][0]->type==265 || $result['banners'][0]->type==266 || $result['banners'][0]->type==267 || $result['banners'][0]->type==268 || $result['banners'][0]->type==269 || $result['banners'][0]->type==270 || $result['banners'][0]->type==271 || $result['banners'][0]->type==275 || $result['banners'][0]->type==276 || $result['banners'][0]->type==277 || $result['banners'][0]->type==278 || $result['banners'][0]->type==279 || $result['banners'][0]->type==282 || $result['banners'][0]->type==283 || $result['banners'][0]->type==284 || $result['banners'][0]->type==285 || $result['banners'][0]->type==286 || $result['banners'][0]->type==287 || $result['banners'][0]->type==288 || $result['banners'][0]->type==289 || $result['banners'][0]->type==290 || $result['banners'][0]->type==292 || $result['banners'][0]->type==293 || $result['banners'][0]->type==294 || $result['banners'][0]->type==297 || $result['banners'][0]->type==298 || $result['banners'][0]->type==305 || $result['banners'][0]->type==306 || $result['banners'][0]->type==307 || $result['banners'][0]->type==308 || $result['banners'][0]->type==312 || $result['banners'][0]->type==313 || $result['banners'][0]->type==314 || $result['banners'][0]->type==316 || $result['banners'][0]->type==317 || $result['banners'][0]->type==318 || $result['banners'][0]->type==319 || $result['banners'][0]->type==248 || $result['banners'][0]->type==250 || $result['banners'][0]->type==251 || $result['banners'][0]->type==300 || $result['banners'][0]->type==247 || $result['banners'][0]->type==256 || $result['banners'][0]->type==281 || $result['banners'][0]->type==211 || $result['banners'][0]->type==245 || $result['banners'][0]->type==324 || $result['banners'][0]->type==325 || $result['banners'][0]->type==326 || $result['banners'][0]->type==221 || $result['banners'][0]->type==327 || $result['banners'][0]->type==328 || $result['banners'][0]->type==246 || $result['banners'][0]->type==274 || $result['banners'][0]->type==280 || $result['banners'][0]->type==295 || $result['banners'][0]->type==296 || $result['banners'][0]->type==322 || $result['banners'][0]->type==323 || $result['banners'][0]->type==320 || $result['banners'][0]->type==321 || $result['banners'][0]->type==180 || $result['banners'][0]->type==181
                                  )   

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">Title</label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('title', $result['banners'][0]->title, array('class'=>'form-control','id'=>'title')) !!}

                                  </div>
                                </div>

                                @endif

                                @if(
                                  $result['banners'][0]->type==3 || $result['banners'][0]->type==4 || $result['banners'][0]->type==5 || $result['banners'][0]->type==129 || $result['banners'][0]->type==130 || $result['banners'][0]->type==131 || $result['banners'][0]->type==132 || $result['banners'][0]->type==133 || $result['banners'][0]->type==134 || $result['banners'][0]->type==135 || $result['banners'][0]->type==136 || $result['banners'][0]->type==137 || $result['banners'][0]->type==138 || $result['banners'][0]->type==139 || $result['banners'][0]->type==140 || $result['banners'][0]->type==141 || $result['banners'][0]->type==142 || $result['banners'][0]->type==143 || $result['banners'][0]->type==144 || $result['banners'][0]->type==145 || $result['banners'][0]->type==146 || $result['banners'][0]->type==147 || $result['banners'][0]->type==148 || $result['banners'][0]->type==149 || $result['banners'][0]->type==150 || $result['banners'][0]->type==151 || $result['banners'][0]->type==152 || $result['banners'][0]->type==153 || $result['banners'][0]->type==166 || $result['banners'][0]->type==167 || $result['banners'][0]->type==168 || $result['banners'][0]->type==169 || $result['banners'][0]->type==170 || $result['banners'][0]->type==171 || $result['banners'][0]->type==172 || $result['banners'][0]->type==173 || $result['banners'][0]->type==174 || $result['banners'][0]->type==175 || $result['banners'][0]->type==176 || $result['banners'][0]->type==177 || $result['banners'][0]->type==208 || $result['banners'][0]->type==209 || $result['banners'][0]->type==210 || $result['banners'][0]->type==217 || $result['banners'][0]->type==218 || $result['banners'][0]->type==219 || $result['banners'][0]->type==220 || $result['banners'][0]->type==222 || $result['banners'][0]->type==223 || $result['banners'][0]->type==224 || $result['banners'][0]->type==225 || $result['banners'][0]->type==227 || $result['banners'][0]->type==228 || $result['banners'][0]->type==229 || $result['banners'][0]->type==230 || $result['banners'][0]->type==232 || $result['banners'][0]->type==233 || $result['banners'][0]->type==234 || $result['banners'][0]->type==235 || $result['banners'][0]->type==236 || $result['banners'][0]->type==237 || $result['banners'][0]->type==238 || $result['banners'][0]->type==239 || $result['banners'][0]->type==240 || $result['banners'][0]->type==241 || $result['banners'][0]->type==242 || $result['banners'][0]->type==243 || $result['banners'][0]->type==244 || $result['banners'][0]->type==249 || $result['banners'][0]->type==252 || $result['banners'][0]->type==253 || $result['banners'][0]->type==254 || $result['banners'][0]->type==255 || $result['banners'][0]->type==257 || $result['banners'][0]->type==258 || $result['banners'][0]->type==260 || $result['banners'][0]->type==262 || $result['banners'][0]->type==263 || $result['banners'][0]->type==264 || $result['banners'][0]->type==265 || $result['banners'][0]->type==266 || $result['banners'][0]->type==267 || $result['banners'][0]->type==268 || $result['banners'][0]->type==269 || $result['banners'][0]->type==270 || $result['banners'][0]->type==271 || $result['banners'][0]->type==275 || $result['banners'][0]->type==276 || $result['banners'][0]->type==277 || $result['banners'][0]->type==278 || $result['banners'][0]->type==279 || $result['banners'][0]->type==282 || $result['banners'][0]->type==283 || $result['banners'][0]->type==284 || $result['banners'][0]->type==285 || $result['banners'][0]->type==286 || $result['banners'][0]->type==287 || $result['banners'][0]->type==288 || $result['banners'][0]->type==289 || $result['banners'][0]->type==290 || $result['banners'][0]->type==293 || $result['banners'][0]->type==294 || $result['banners'][0]->type==297 || $result['banners'][0]->type==298 || $result['banners'][0]->type==305 || $result['banners'][0]->type==306 || $result['banners'][0]->type==307 || $result['banners'][0]->type==308 || $result['banners'][0]->type==312 || $result['banners'][0]->type==313 || $result['banners'][0]->type==314 || $result['banners'][0]->type==316 || $result['banners'][0]->type==317 || $result['banners'][0]->type==318 || $result['banners'][0]->type==319 || $result['banners'][0]->type==248 || $result['banners'][0]->type==250 || $result['banners'][0]->type==251 || $result['banners'][0]->type==300 || $result['banners'][0]->type==247 || $result['banners'][0]->type==256 || $result['banners'][0]->type==281 || $result['banners'][0]->type==211 || $result['banners'][0]->type==245 | $result['banners'][0]->type==324 || $result['banners'][0]->type==325 || $result['banners'][0]->type==326 || $result['banners'][0]->type==221 || $result['banners'][0]->type==327 || $result['banners'][0]->type==328 || $result['banners'][0]->type==246 || $result['banners'][0]->type==274 || $result['banners'][0]->type==280 || $result['banners'][0]->type==322 || $result['banners'][0]->type==323 || $result['banners'][0]->type==320 || $result['banners'][0]->type==321 || $result['banners'][0]->type==180 || $result['banners'][0]->type==181
                                  )
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">Description</label>
                                  <div class="col-sm-10 col-md-4">
                                  <textarea class="form-control" name="description" id="description">{{$result['banners'][0]->description}}</textarea>

                                  </div>
                                </div>
                                @endif

                                @if(
                                  $result['banners'][0]->type==129 || $result['banners'][0]->type==130 || $result['banners'][0]->type==132 || $result['banners'][0]->type==143 || $result['banners'][0]->type==144 || $result['banners'][0]->type==145 || $result['banners'][0]->type==146 || $result['banners'][0]->type==149 || $result['banners'][0]->type==151 || $result['banners'][0]->type==152 || $result['banners'][0]->type==153 || $result['banners'][0]->type==168 || $result['banners'][0]->type==169 || $result['banners'][0]->type==170 || $result['banners'][0]->type==174 || $result['banners'][0]->type==217 || $result['banners'][0]->type==218 || $result['banners'][0]->type==219 || $result['banners'][0]->type==222 || $result['banners'][0]->type==225 || $result['banners'][0]->type==235 || $result['banners'][0]->type==236 || $result['banners'][0]->type==237 || $result['banners'][0]->type==238 || $result['banners'][0]->type==239 || $result['banners'][0]->type==240 || $result['banners'][0]->type==241 || $result['banners'][0]->type==242 || $result['banners'][0]->type==243 || $result['banners'][0]->type==244 || $result['banners'][0]->type==249 || $result['banners'][0]->type==258 || $result['banners'][0]->type==260 || $result['banners'][0]->type==262 || $result['banners'][0]->type==263 || $result['banners'][0]->type==275 || $result['banners'][0]->type==276 || $result['banners'][0]->type==277 || $result['banners'][0]->type==278 || $result['banners'][0]->type==279 || $result['banners'][0]->type==283 || $result['banners'][0]->type==285 || $result['banners'][0]->type==293 || $result['banners'][0]->type==294 || $result['banners'][0]->type==297 || $result['banners'][0]->type==298 || $result['banners'][0]->type==305 || $result['banners'][0]->type==306 || $result['banners'][0]->type==307 || $result['banners'][0]->type==308 || $result['banners'][0]->type==312 || $result['banners'][0]->type==316 || $result['banners'][0]->type==318 || $result['banners'][0]->type==319 || $result['banners'][0]->type==248 || $result['banners'][0]->type==247 || $result['banners'][0]->type==281 || $result['banners'][0]->type==211 || $result['banners'][0]->type==245 | $result['banners'][0]->type==324 || $result['banners'][0]->type==325 || $result['banners'][0]->type==326 || $result['banners'][0]->type==221 || $result['banners'][0]->type==327 || $result['banners'][0]->type==328 || $result['banners'][0]->type==246 || $result['banners'][0]->type==274 || $result['banners'][0]->type==280 || $result['banners'][0]->type==322 || $result['banners'][0]->type==323 || $result['banners'][0]->type==320 || $result['banners'][0]->type==321
                                  ) 

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">Description Two</label>
                                  <div class="col-sm-10 col-md-4">
                                  <textarea class="form-control" name="description2" id="description2">{{$result['banners'][0]->description2}}</textarea>

                                  </div>
                                </div>

                                @endif

                                @if($result['banners'][0]->type==225 || $result['banners'][0]->type==283 || $result['banners'][0]->type==316 || $result['banners'][0]->type==248 || $result['banners'][0]->type==247 || $result['banners'][0]->type==245 || $result['banners'][0]->type==221 || $result['banners'][0]->type==327 || $result['banners'][0]->type==328 || $result['banners'][0]->type==274)

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">Description Three</label>
                                  <div class="col-sm-10 col-md-4">
                                  <textarea class="form-control" name="description3" id="description3">{{$result['banners'][0]->description3}}</textarea>

                                  </div>
                                </div>

                                @endif

                                @if($result['banners'][0]->type=='')

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">Description Four</label>
                                  <div class="col-sm-10 col-md-4">
                                  <textarea class="form-control" name="description4" id="description4">{{$result['banners'][0]->description4}}</textarea>

                                  </div>
                                </div>

                                @endif

                                @if($result['banners'][0]->type=='')

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">Description Five</label>
                                  <div class="col-sm-10 col-md-4">
                                  <textarea class="form-control" name="description5" id="description5">{{$result['banners'][0]->description5}}</textarea>

                                  </div>
                                </div>

                                @endif

                                @if(
                                  $result['banners'][0]->type==3 || $result['banners'][0]->type==4 || $result['banners'][0]->type==5 ||$result['banners'][0]->type==129 || $result['banners'][0]->type==130 || $result['banners'][0]->type==131 || $result['banners'][0]->type==132 || $result['banners'][0]->type==133 || $result['banners'][0]->type==134 || $result['banners'][0]->type==135 || $result['banners'][0]->type==136 || $result['banners'][0]->type==137 || $result['banners'][0]->type==138 || $result['banners'][0]->type==139 || $result['banners'][0]->type==140 || $result['banners'][0]->type==141 || $result['banners'][0]->type==142 || $result['banners'][0]->type==143 || $result['banners'][0]->type==144 || $result['banners'][0]->type==145 || $result['banners'][0]->type==146 || $result['banners'][0]->type==147 || $result['banners'][0]->type==148 || $result['banners'][0]->type==149 || $result['banners'][0]->type==150 || $result['banners'][0]->type==151 || $result['banners'][0]->type==152 || $result['banners'][0]->type==153 || $result['banners'][0]->type==154 || $result['banners'][0]->type==155 || $result['banners'][0]->type==156 || $result['banners'][0]->type==162 || $result['banners'][0]->type==163 || $result['banners'][0]->type==164 || $result['banners'][0]->type==165 || $result['banners'][0]->type==166 || $result['banners'][0]->type==167 || $result['banners'][0]->type==168 || $result['banners'][0]->type==171 || $result['banners'][0]->type==172 || $result['banners'][0]->type==173 || $result['banners'][0]->type==175 || $result['banners'][0]->type==176 || $result['banners'][0]->type==177 || $result['banners'][0]->type==208 || $result['banners'][0]->type==209 || $result['banners'][0]->type==210 || $result['banners'][0]->type==212 || $result['banners'][0]->type==213 || $result['banners'][0]->type==214 || $result['banners'][0]->type==215 || $result['banners'][0]->type==217 || $result['banners'][0]->type==218 || $result['banners'][0]->type==219 || $result['banners'][0]->type==222 || $result['banners'][0]->type==223 || $result['banners'][0]->type==224 || $result['banners'][0]->type==225 || $result['banners'][0]->type==226 || $result['banners'][0]->type==227 || $result['banners'][0]->type==228 || $result['banners'][0]->type==229 || $result['banners'][0]->type==230 || $result['banners'][0]->type==235 || $result['banners'][0]->type==236 || $result['banners'][0]->type==237 || $result['banners'][0]->type==238 || $result['banners'][0]->type==239 || $result['banners'][0]->type==240 || $result['banners'][0]->type==241 || $result['banners'][0]->type==242 || $result['banners'][0]->type==243 || $result['banners'][0]->type==244 || $result['banners'][0]->type==252 || $result['banners'][0]->type==253 || $result['banners'][0]->type==254 || $result['banners'][0]->type==255 || $result['banners'][0]->type==257 || $result['banners'][0]->type==258 || $result['banners'][0]->type==259 || $result['banners'][0]->type==260 || $result['banners'][0]->type==261 || $result['banners'][0]->type==262 || $result['banners'][0]->type==263 || $result['banners'][0]->type==264 || $result['banners'][0]->type==265 || $result['banners'][0]->type==266 || $result['banners'][0]->type==267 || $result['banners'][0]->type==268 || $result['banners'][0]->type==269 || $result['banners'][0]->type==270 || $result['banners'][0]->type==271 || $result['banners'][0]->type==275 || $result['banners'][0]->type==276 || $result['banners'][0]->type==277 || $result['banners'][0]->type==278 || $result['banners'][0]->type==279 || $result['banners'][0]->type==282 || $result['banners'][0]->type==283 || $result['banners'][0]->type==284 || $result['banners'][0]->type==285 || $result['banners'][0]->type==286 || $result['banners'][0]->type==287 || $result['banners'][0]->type==288 || $result['banners'][0]->type==289 || $result['banners'][0]->type==292 || $result['banners'][0]->type==293 || $result['banners'][0]->type==294 || $result['banners'][0]->type==297 || $result['banners'][0]->type==298 || $result['banners'][0]->type==305 || $result['banners'][0]->type==306 || $result['banners'][0]->type==312 || $result['banners'][0]->type==313 || $result['banners'][0]->type==314 || $result['banners'][0]->type==316 || $result['banners'][0]->type==317 || $result['banners'][0]->type==318 || $result['banners'][0]->type==319 || $result['banners'][0]->type==248 || $result['banners'][0]->type==250 || $result['banners'][0]->type==251 || $result['banners'][0]->type==300 || $result['banners'][0]->type==247 || $result['banners'][0]->type==256 || $result['banners'][0]->type==281 || $result['banners'][0]->type==211 || $result['banners'][0]->type==245 | $result['banners'][0]->type==324 || $result['banners'][0]->type==325 || $result['banners'][0]->type==326 || $result['banners'][0]->type==221 || $result['banners'][0]->type==327 || $result['banners'][0]->type==328 || $result['banners'][0]->type==246 || $result['banners'][0]->type==274 || $result['banners'][0]->type==280 || $result['banners'][0]->type==322 || $result['banners'][0]->type==323 || $result['banners'][0]->type==320 || $result['banners'][0]->type==321 || $result['banners'][0]->type==290 || $result['banners'][0]->type==180 || $result['banners'][0]->type==181
                                  )

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">Button name</label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('name', $result['banners'][0]->name, array('class'=>'form-control','id'=>'name')) !!}

                                  </div>
                                </div>

                                @endif


                               


                             




                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.URL') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::url('banners_url', $result['banners'][0]->banners_url, array('class'=>'form-control','id'=>'banners_url')) !!}

                                  </div>
                                </div>

                                <div class="form-group hidden">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="status">
                                          <option value="1" @if($result['banners'][0]->status==1) selected @endif>{{ trans('labels.Active') }}</option>
                                          <option value="0" @if($result['banners'][0]->status==0) selected @endif>{{ trans('labels.Inactive') }}</option>
                                      </select>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.StatusBannerText') }}</span>
                                  </div>
                                </div>


                              <!-- /.box-body -->
                              <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                <a href="{{ URL::to('admin/constantbanners')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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
    </div>
    <!-- /.row -->

    <!-- Main row -->

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
@endsection
