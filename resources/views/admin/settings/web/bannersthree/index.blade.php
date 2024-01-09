@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{ trans('labels.constantBanners') }} <small>{{ trans('labels.ListingConstantBanners') }}...</small> </h1>
    <ol class="breadcrumb">
       <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">{{ trans('labels.Banners') }}</li>
    </ol>
  </section>

  <style>
    p{
      margin-top:20px;color:red;font-size:2rem;
    }
    </style>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->

    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            {{-- <div class="box-tools pull-right">
            	 <a href="{{ URL::to('admin/addconstantbannerthree') }}" type="button" class="btn btn-block btn-primary">{{ trans('labels.AddNewBanner') }}</a>
            </div> --}}

            <div class="form-inline">

            <?php $current_theme = DB::table('current_theme')->where('id', '=', '1')->first(); ?>

              <form  name='registration' id="registration" class="" method="get">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">

                  <div class="input-group-form search-panel ">
                      <select id="parameter" type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="bannerType">
                          <option value="" selected disabled hidden>{{trans('labels.ChooseSliderType')}}</option>
                          @if($current_theme->template == 0)
                             <!-- Banner style -->

                         @if($current_theme->multibanner_one == 1)
                              <option value="banner1" @if(request()->get('bannerType') == 'banner1') selected @endif>Banner Style 1</option>
                            @endif
                            @if($current_theme->multibanner_one == 2)
                              <option value="banner2" @if(request()->get('bannerType') == 'banner2') selected @endif>@lang('labels.Banner Style 2')</option>
                            @endif
                            @if($current_theme->multibanner_one == 3)
                              <option value="banner3" @if(request()->get('bannerType') == 'banner3') selected @endif>@lang('labels.Banner Style 3')</option>
                            @endif
                            @if($current_theme->multibanner_one == 4)
                              <option value="banner4" @if(request()->get('bannerType') == 'banner4') selected @endif>@lang('labels.Banner Style 4')</option>
                            @endif
                            @if($current_theme->multibanner_one == 5)
                              <option value="banner5" @if(request()->get('bannerType') == 'banner5') selected @endif>@lang('labels.Banner Style 5')</option>
                            @endif
                            @if($current_theme->multibanner_one == 6)
                              <option value="banner6" @if(request()->get('bannerType') == 'banner6') selected @endif>@lang('labels.Banner Style 6')</option>
                            @endif
                            @if($current_theme->multibanner_one == 7)
                              <option value="banner7" @if(request()->get('bannerType') == 'banner7') selected   @endif>@lang('labels.Banner Style 7')</option>
                            @endif
                            @if($current_theme->multibanner_one == 8)
                              <option value="banner8" @if(request()->get('bannerType') == 'banner8') selected @endif>@lang('labels.Banner Style 8')</option>
                            @endif
                            @if($current_theme->multibanner_one == 9)
                              <option value="banner9" @if(request()->get('bannerType') == 'banner9') selected @endif>@lang('labels.Banner Style 9')</option>
                            @endif
                            @if($current_theme->multibanner_one == 10)
                              <option value="banner10" @if(request()->get('bannerType') == 'banner10') selected @endif>@lang('labels.Banner Style 10')</option>
                            @endif
                            @if($current_theme->multibanner_one == 11)
                              <option value="banner11" @if(request()->get('bannerType') == 'banner11') selected @endif>@lang('labels.Banner Style 11')</option>
                            @endif
                            @if($current_theme->multibanner_one == 12)
                              <option value="banner12" @if(request()->get('bannerType') == 'banner12') selected @endif>@lang('labels.Banner Style 12')</option>
                            @endif
                            @if($current_theme->multibanner_one == 13)
                              <option value="banner13" @if(request()->get('bannerType') == 'banner13') selected @endif>@lang('labels.Banner Style 13')</option>
                            @endif
                            @if($current_theme->multibanner_one == 14)
                              <option value="banner14" @if(request()->get('bannerType') == 'banner14') selected @endif>@lang('labels.Banner Style 14')</option>
                            @endif
                            @if($current_theme->multibanner_one == 15)
                              <option value="banner15" @if(request()->get('bannerType') == 'banner15') selected @endif>@lang('labels.Banner Style 15')</option>
                            @endif
                            @if($current_theme->multibanner_one == 16)
                              <option value="banner16" @if(request()->get('bannerType') == 'banner16') selected @endif>@lang('labels.Banner Style 16')</option>
                            @endif
                            @if($current_theme->multibanner_one == 17)
                              <option value="banner17" @if(request()->get('bannerType') == 'banner17') selected @endif>@lang('labels.Banner Style 17')</option>
                            @endif
                            @if($current_theme->multibanner_one == 18)
                              <option value="banner18" @if(request()->get('bannerType') == 'banner18') selected @endif>@lang('labels.Banner Style 18')</option>
                            @endif
                            @if($current_theme->multibanner_one == 19)
                              <option value="banner19" @if(request()->get('bannerType') == 'banner19') selected @endif>@lang('labels.Banner Style 19')</option>
                            @endif
                            @if($current_theme->multibanner_one == 20)
                              <option value="banner20" @if(request()->get('bannerType') == 'banner20') selected @endif>Banner Style 20 (Demo-1)</option>
                            @endif
                            @if($current_theme->multibanner_one == 22)
                              <option value="banner22" @if(request()->get('bannerType') == 'banner22') selected @endif>Banner Style 21 (Demo-5)</option>
                            @endif
                            @if($current_theme->multibanner_one == 23)
                              <option value="banner23" @if(request()->get('bannerType') == 'banner23') selected @endif>Banner Style 22 (Demo-6)</option>
                            @endif
                            @if($current_theme->multibanner_one == 24)
                              <option value="banner24" @if(request()->get('bannerType') == 'banner24') selected @endif>Banner Style 23 (Demo-7)</option>
                            @endif
                            @if($current_theme->multibanner_one == 25)
                              <option value="banner25" @if(request()->get('bannerType') == 'banner25') selected @endif>Banner Style 24 (Demo-8 banner-1)</option>
                            @endif
                            @if($current_theme->multibanner_one == 26)
                              <option value="banner26" @if(request()->get('bannerType') == 'banner26') selected @endif>Banner Style 25 (Demo-9)</option>
                            @endif
                            @if($current_theme->multibanner_one == 27)
                              <option value="banner27" @if(request()->get('bannerType') == 'banner27') selected @endif>Banner Style 26 (Demo-10 banner 1)</option>
                            @endif
                            @if($current_theme->multibanner_one == 28)
                              <option value="banner28" @if(request()->get('bannerType') == 'banner28') selected @endif>Banner Style 27 (Demo-12)</option>
                            @endif
                            @if($current_theme->multibanner_one == 30)
                              <option value="banner30" @if(request()->get('bannerType') == 'banner30') selected @endif>Banner Style 28 (Demo-18)</option>
                            @endif
                            @if($current_theme->multibanner_one == 31)
                              <option value="banner31" @if(request()->get('bannerType') == 'banner31') selected @endif>Banner Style 29 (Demo-26)</option> 
                            @endif
                            @if($current_theme->multibanner_one == 32)
                              <option value="banner32" @if(request()->get('bannerType') == 'banner32') selected @endif>Banner Style 30 (Demo-29)</option>
                            @endif
                            @if($current_theme->multibanner_one == 33)
                              <option value="banner33" @if(request()->get('bannerType') == 'banner33') selected @endif>Banner Style 31 (Demo-31)</option>
                            @endif
                            @if($current_theme->multibanner_one == 34)
                              <option value="banner34" @if(request()->get('bannerType') == 'banner34') selected @endif>Banner Style 32 (Demo-35 banner-1, type-1)</option>
                            @endif
                            @if($current_theme->multibanner_one == 35)
                              <option value="banner35" @if(request()->get('bannerType') == 'banner35') selected @endif>Banner Style 33 (Demo-35 banner-1, type-2)</option>
                            @endif
                            @if($current_theme->multibanner_one == 36)
                              <option value="banner36" @if(request()->get('bannerType') == 'banner36') selected @endif>Banner Style 34 (Demo-35 banner-1, type-3)</option>
                            @endif
                            @if($current_theme->multibanner_one == 37)
                              <option value="banner37" @if(request()->get('bannerType') == 'banner37') selected @endif>Banner Style 35 (Demo-35 banner-2,3)</option>
                            @endif
                            @if($current_theme->multibanner_one == 38)
                              <option value="banner38" @if(request()->get('bannerType') == 'banner38') selected @endif>Banner Style 36 (Demo-35 banner-4)</option>
                            @endif
                            @if($current_theme->multibanner_one == 39)
                              <option value="banner39" @if(request()->get('bannerType') == 'banner39') selected @endif>Banner Style 37</option>
                            @endif
                            @if($current_theme->multibanner_one == 40)
                              <option value="banner40" @if(request()->get('bannerType') == 'banner40') selected @endif>Banner Style 38</option>
                            @endif
                            @if($current_theme->multibanner_one == 41)
                              <option value="banner41" @if(request()->get('bannerType') == 'banner41') selected @endif>Banner Style 39 (Demo-5,24)</option>
                            @endif
                            @if($current_theme->multibanner_one == 42)
                              <option value="banner1" @if(request()->get('bannerType') == 'banner1') selected @endif>Banner Style 40 (Demo-34)</option>
                            @endif
                            @if($current_theme->multibanner_one == 43)
                              <option value="banner43" @if(request()->get('bannerType') == 'banner43') selected @endif>Banner Style 40 (Demo-8 banner-2)</option>
                            @endif
                            @if($current_theme->multibanner_one == 44)
                              <option value="banner44" @if(request()->get('bannerType') == 'banner44') selected @endif>Banner Style 41 (Demo-8 banner-3)</option>
                            @endif
                            @if($current_theme->multibanner_one == 45)
                              <option value="banner45" @if(request()->get('bannerType') == 'banner45') selected @endif>Banner Style 42 (Demo-33 banner-1)</option>
                            @endif
                            @if($current_theme->multibanner_one == 46)
                              <option value="banner46" @if(request()->get('bannerType') == 'banner46') selected @endif>Banner Style 43 (Demo-33 banner-3)</option>
                            @endif
                            @if($current_theme->multibanner_one == 47)
                              <option value="banner47" @if(request()->get('bannerType') == 'banner47') selected @endif>Banner Style 44 (Demo-33 banner-2)</option>
                            @endif
                            @if($current_theme->multibanner_one == 48)
                              <option value="banner48" @if(request()->get('bannerType') == 'banner48') selected @endif>Banner Style 45 (Demo-10 banner 2)</option>
                            @endif
                            @if($current_theme->multibanner_one == 49)
                              <option value="banner49" @if(request()->get('bannerType') == 'banner49') selected @endif>Banner Style 46 (Demo-32 banner 1)</option>
                            @endif
                            @if($current_theme->multibanner_one == 50)
                              <option value="banner50" @if(request()->get('bannerType') == 'banner50') selected @endif>Banner Style 47 (Demo-32 banner 2)</option>
                            @endif
                            @if($current_theme->multibanner_one == 51)
                              <option value="banner51" @if(request()->get('bannerType') == 'banner51') selected @endif>Banner Style 48 (Demo-13 banner 1)</option>
                            @endif
                            @if($current_theme->multibanner_one == 52)
                              <option value="banner52" @if(request()->get('bannerType') == 'banner52') selected @endif>Banner Style 49 (Demo-13 banner 2)</option>
                            @endif
                            @if($current_theme->multibanner_one == 53)
                              <option value="banner53" @if(request()->get('bannerType') == 'banner53') selected @endif>Banner Style 50 (Demo-15,16)</option>
                            @endif
                            @if($current_theme->multibanner_one == 54)
                              <option value="banner54" @if(request()->get('bannerType') == 'banner54') selected @endif>Banner Style 51 (Demo-17)</option>
                            @endif
                            @if($current_theme->multibanner_one == 55)
                              <option value="banner55" @if(request()->get('bannerType') == 'banner55') selected @endif>Banner Style 52 (Demo-19 banner 1)</option>
                            @endif
                            @if($current_theme->multibanner_one == 56)
                              <option value="banner56" @if(request()->get('bannerType') == 'banner56') selected @endif>Banner Style 53 (Demo-19 banner 2)</option>
                            @endif
                            @if($current_theme->multibanner_one == 57)
                              <option value="banner57" @if(request()->get('bannerType') == 'banner57') selected @endif>Banner Style 54 (Demo-20 banner 1)</option>
                            @endif
                            @if($current_theme->multibanner_one == 58)
                              <option value="banner58" @if(request()->get('bannerType') == 'banner58') selected @endif>Banner Style 55 (Demo-20 banner 2)</option>
                            @endif
                            @if($current_theme->multibanner_one == 59)
                              <option value="banner59" @if(request()->get('bannerType') == 'banner59') selected @endif>Banner Style 56 (Demo-22)</option>
                            @endif
                            @if($current_theme->multibanner_one == 60)
                              <option value="banner60" @if(request()->get('bannerType') == 'banner60') selected @endif>Banner Style 57 (Demo-23)</option>
                            @endif
                            @if($current_theme->multibanner_one == 61)
                              <option value="banner61" @if(request()->get('bannerType') == 'banner61') selected @endif>Banner Style 58 (Demo-24 banner 1)</option>
                            @endif
                            @if($current_theme->multibanner_one == 62)
                              <option value="banner62" @if(request()->get('bannerType') == 'banner62') selected @endif>Banner Style 59 (Demo-24 banner 2)</option>
                            @endif
                            @if($current_theme->multibanner_one == 63)
                              <option value="banner63" @if(request()->get('bannerType') == 'banner63') selected @endif>Banner Style 60 (Demo-25 banner 1)</option>
                            @endif
                            @if($current_theme->multibanner_one == 64)
                              <option value="banner64" @if(request()->get('bannerType') == 'banner64') selected @endif>Banner Style 61 (Demo-25 banner 2)</option>
                            @endif
                            @if($current_theme->multibanner_one == 65)
                              <option value="banner65" @if(request()->get('bannerType') == 'banner65') selected @endif>Banner Style 62 (Demo-26)</option>
                            @endif
                            @if($current_theme->multibanner_one == 67)
                              <option value="banner67" @if(request()->get('bannerType') == 'banner67') selected @endif>Banner Style 63 (Demo-28)</option>
                            @endif
                            @if($current_theme->multibanner_one == 68)
                              <option value="banner68" @if(request()->get('bannerType') == 'banner68') selected @endif>Banner Style 64 (Demo-30 bannner 1)</option>
                            @endif
                            @if($current_theme->multibanner_one == 69)
                              <option value="banner69" @if(request()->get('bannerType') == 'banner69') selected @endif>Banner Style 65 (Demo-30 bannner 2)</option>
                            @endif
                            @if($current_theme->multibanner_one == 70)
                              <option value="banner70" @if(request()->get('bannerType') == 'banner70') selected @endif>Banner Style 66 (Demo-30 bannner 3)</option>
                            @endif
                            @if($current_theme->multibanner_one == 71)
                              <option value="banner71" @if(request()->get('bannerType') == 'banner71') selected @endif>Banner Style 67 (Demo-31)</option>
                            @endif
                            @if($current_theme->multibanner_one == 72)
                              <option value="banner72" @if(request()->get('bannerType') == 'banner72') selected @endif>Banner Style 68 (Demo-32 banner 3)</option>
                            @endif
                            @if($current_theme->multibanner_one == 73)
                              <option value="banner73" @if(request()->get('bannerType') == 'banner73') selected @endif>Banner Style 69 (Demo-14)</option>
                            @endif

                          @endif


                          @if($current_theme->template == 8)
                          <option value="banner44" selected >Demo-8 Style</option>
                          @endif
                          @if($current_theme->template == 24)
                          <option value="banner41" selected>Demo-24 Style</option>
                          @endif
                          @if($current_theme->template == 30)
                          <option value="banner70" selected >Demo-30 Style</option>
                          @endif
                          @if($current_theme->template == 32)
                          <option value="banner72" selected >Demo-32 Style</option>
                          @endif
                          @if($current_theme->template == 33)
                          <option value="banner46" selected >Demo-33 Style</option>
                          @endif
                          @if($current_theme->template == 35)
                          <option value="banner37" selected>Demo-35 Style</option>
                          @endif
                          

                          
                      </select>
                      <select id="FilterBy" type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="languages_id">
                        <option value="" selected disabled hidden>{{trans('labels.ChooseLanguage')}}</option>
                          @foreach($result['languages'] as $language)
                              <option value="{{$language->languages_id}}" @if(request()->get('languages_id') == $language->languages_id) selected @endif>{{ $language->name }}</option>
                          @endforeach
                      </select>
                      <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                      @if(request()->get('bannerType'))  <a class="btn btn-danger " href="{{url('admin/constantbannersthree')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                  </div>
              </form>
              <div class="col-lg-4 form-inline" id="contact-form12"></div>

              @if(request()->get('bannerType') == 'banner1')
                <br>
               
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner1.jpg')}}" alt=""  width=100%>

              @elseif(request()->get('bannerType')  == 'banner2')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner2.jpg')}}" alt=""  width=100%>

              @elseif(request()->get('bannerType')  == 'banner3')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner3.jpg')}}" alt=""  width=100%>

              @elseif(request()->get('bannerType')  == 'banner4')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner4.jpg')}}" alt=""  width=100%>

              @elseif(request()->get('bannerType')  == 'banner5')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner5.jpg')}}" alt=""  width=100%>

               
              @elseif(request()->get('bannerType')  == 'banner6')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner6.jpg')}}" alt=""  width=100%>

               

              @elseif(request()->get('bannerType')  == 'banner7')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner7.jpg')}}" alt=""  width=100%>

               

              @elseif(request()->get('bannerType')  == 'banner8')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner8.jpg')}}" alt=""  width=100%>

              
              @elseif(request()->get('bannerType')  == 'banner9')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner9.jpg')}}" alt=""  width=100%>

               
              


              @elseif(request()->get('bannerType')  == 'banner10')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner10.jpg')}}" alt=""  width=100%>

              

              @elseif(request()->get('bannerType')  == 'banner11')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner11.jpg')}}" alt=""  width=100%>

                
              @elseif(request()->get('bannerType')  == 'banner12')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner12.jpg')}}" alt=""  width=100%>

              
              @elseif(request()->get('bannerType')  == 'banner13')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner13.jpg')}}" alt=""  width=100%>

             
              @elseif(request()->get('bannerType')  == 'banner14')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner14.jpg')}}" alt=""  width=100%>

               
              @elseif(request()->get('bannerType')  == 'banner15')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner15.jpg')}}" alt=""  width=100%>

              
              @elseif(request()->get('bannerType')  == 'banner16')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner16.jpg')}}" alt=""  width=100%>

              

              @elseif(request()->get('bannerType')  == 'banner17')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner17.jpg')}}" alt=""  width=100%>

               

              @elseif(request()->get('bannerType')  == 'banner18')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner18.jpg')}}" alt=""  width=100%>

               

              @elseif(request()->get('bannerType')  == 'banner19')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner19.jpg')}}" alt=""  width=100%>

               
                @elseif(request()->get('bannerType')  == 'banner20')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner20.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (470 × 510) </p>
                <p>Note: 2nd image resolution = (290 × 510) </p>
                <p>Note: 3rd image resolution = (370 × 245) </p>
                <p>Note: 4th image resolution = (370 × 245) </p>

                @elseif(request()->get('bannerType')  == 'banner22')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner22.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (574 × 630) </p>
                <p>Note: 2nd image resolution = (574 × 305) </p>
                <p>Note: 3rd image resolution = (574 × 305) </p>

                @elseif(request()->get('bannerType')  == 'banner23')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner23.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (575 × 600) </p>
                <p>Note: 2nd image resolution = (575 × 600) </p>

                @elseif(request()->get('bannerType')  == 'banner24')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner24.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (880 × 500) </p>
                <p>Note: 2nd image resolution = (880 × 500) </p>
                <p>Note: 3rd image resolution = (580 × 300) </p>
                <p>Note: 4th image resolution = (580 × 300) </p>
                <p>Note: 5th image resolution = (580 × 300) </p>

                @elseif(request()->get('bannerType')  == 'banner25')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner25.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (376 × 470) </p>
                <p>Note: 2nd image resolution = (376 × 470) </p>
                <p>Note: 3rd image resolution = (376 × 470) </p>

                @elseif(request()->get('bannerType')  == 'banner26')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner26.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (376 × 500) </p>
                <p>Note: 2nd image resolution = (376 × 240) </p>
                <p>Note: 3rd image resolution = (376 × 240) </p>
                <p>Note: 4th image resolution = (376 × 500) </p>

                @elseif(request()->get('bannerType')  == 'banner27')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner27.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (376 × 250) </p>
                <p>Note: 2nd image resolution = (376 × 250) </p>
                <p>Note: 3rd image resolution = (772 × 250) </p>
                <p>Note: 4th image resolution = (376 × 520) </p>

                @elseif(request()->get('bannerType')  == 'banner28')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner28.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (574 × 500) </p>
                <p>Note: 2nd image resolution = (574 × 240) </p>
                <p>Note: 3rd image resolution = (574 × 240) </p>

                @elseif(request()->get('bannerType')  == 'banner29')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner29.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (280 × 400) </p>
                <p>Note: 2nd image resolution = (580 × 250) </p>
                <p>Note: 3rd image resolution = (580 × 250) </p>
                <p>Note: 4th image resolution = (580 × 250) </p>
                <p>Note: 5th image resolution = (580 × 250) </p>

                @elseif(request()->get('bannerType')  == 'banner30')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner30.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (574 × 560) </p>
                <p>Note: 2nd image resolution = (277 × 560) </p>
                <p>Note: 3rd image resolution = (277 × 270) </p>
                <p>Note: 4th image resolution = (277 × 270) </p>

                @elseif(request()->get('bannerType')  == 'banner31')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner31.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (453 × 220) </p>
                <p>Note: 2nd image resolution = (453 × 220) </p>
                <p>Note: 3rd image resolution = (453 × 220) </p>

                @elseif(request()->get('bannerType')  == 'banner32')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner32.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (688 × 400) </p>
                <p>Note: 2nd image resolution = (688 × 400) </p>
                <p>Note: 3rd image resolution = (452 × 300) </p>
                <p>Note: 4th image resolution = (452 × 300) </p>
                <p>Note: 5th image resolution = (452 × 300) </p>

                @elseif(request()->get('bannerType')  == 'banner33')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner33.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (690 × 340) </p>
                <p>Note: 2nd image resolution = (335 × 340) </p>
                <p>Note: 3rd image resolution = (335 × 340) </p>
                <p>Note: 4th image resolution = (690 × 700) </p>

                @elseif(request()->get('bannerType')  == 'banner34')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner34.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (720 × 360) </p>
                <p>Note: 2nd image resolution = (720 × 360) </p>

                @elseif(request()->get('bannerType')  == 'banner35')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner35.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (720 × 360) </p>
                <p>Note: 2nd image resolution = (720 × 360) </p>
                <p>Note: 3rd image resolution = (720 × 360) </p>
                <p>Note: 4th image resolution = (720 × 360) </p>

                @elseif(request()->get('bannerType')  == 'banner36')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner36.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (720 × 360) </p>
                <p>Note: 2nd image resolution = (720 × 360) </p>
                <p>Note: 3rd image resolution = (720 × 360) </p>
                <p>Note: 4th image resolution = (720 × 360) </p>
                <p>Note: 5th image resolution = (720 × 360) </p>
                <p>Note: 6th image resolution = (720 × 360) </p>

                @elseif(request()->get('bannerType')  == 'banner37')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner37.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (500 × 300) </p>
                <p>Note: 2nd image resolution = (500 × 300) </p>
                <p>Note: 3rd image resolution = (500 × 300) </p>

                @elseif(request()->get('bannerType')  == 'banner38')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner38.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (360 × 183) </p>
                <p>Note: 2nd image resolution = (360 × 183) </p>
                <p>Note: 3rd image resolution = (360 × 183) </p>
               
                @elseif(request()->get('bannerType')  == 'banner39')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner39.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (376 × 500) </p>
                <p>Note: 2nd image resolution = (376 × 240) </p>
                <p>Note: 3rd image resolution = (376 × 240) </p>
                <p>Note: 4th image resolution = (376 × 500) </p>

                @elseif(request()->get('bannerType')  == 'banner40')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner40.png')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (376 × 160) </p>
                <p>Note: 2nd image resolution = (376 × 160) </p>
                <p>Note: 3rd image resolution = (376 × 160) </p>

                @elseif(request()->get('bannerType')  == 'banner41')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner41.png')}}" alt=""  width=100%>

                <p>Note: image resolution = (1920 × 560) </p>

                @elseif(request()->get('bannerType')  == 'carousal19rightthumbs')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/carousal40.png')}}" alt=""  width=100%>

                @elseif(request()->get('bannerType')  == 'flash1')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/flash1.png')}}" alt=""  width=100%>


              @elseif(request()->get('bannerType')  == 'tp1')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/tp1.png')}}" alt=""  width=100%>
                
                <p>Note: 1st image resolution = (225 × 375) </p>

              @elseif(request()->get('bannerType')  == 'rightsliderbanner')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/carousal3.jpg')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (370 × 179) </p>
                <p>Note: 2nd image resolution = (370 × 179) </p>

              @elseif(request()->get('bannerType')  == 'leftsliderbanner')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/carousal5.jpg')}}" alt=""  width=100%>

                <p>Note: 1st image resolution = (370 × 179) </p>
                <p>Note: 2nd image resolution = (370 × 179) </p>


              @elseif(request()->get('bannerType')  == 'sliderbanner1thumbs')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/carousal31.png')}}" alt=""  width=100%>

                <p>Note:  image resolution = (264 × 486) </p>

              @elseif(request()->get('bannerType')  == 'sliderbanner2thumbs')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/carousal7.png')}}" alt=""  width=100%>

                <p>Note:  image resolution = (376 × 205) </p>

              @elseif(request()->get('bannerType')  == 'sliderbanner3thumbs')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/carousal8.png')}}" alt=""  width=100%>

                <p>Note:  image resolution = (370 × 120) </p>

              @elseif(request()->get('bannerType')  == 'sliderbanner3bottomthumbs')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/carousal33.png')}}" alt=""  width=100%>

                <p>Note:  image resolution = (460 × 210) </p>

              @elseif(request()->get('bannerType')  == 'sliderbanner3bottomthumbs1')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/carousal26.png')}}" alt=""  width=100%>

                <p>Note:  image resolution = (460 × 260) </p>

                @elseif(request()->get('bannerType')  == 'sp1')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/sp1.png')}}" alt=""  width=100%>

                <p>Note: image resolution = (575 × 630) </p>

                @elseif(request()->get('bannerType')  == 'banner43')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner43.png')}}" alt=""  width=100%>

                <p>Note: image resolution = (1920 × 470) </p>

                @elseif(request()->get('bannerType')  == 'banner44')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner44.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (575 × 300) </p>
                <p>Note:2nd  image resolution = (575 × 300) </p>

                @elseif(request()->get('bannerType')  == 'banner45')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner45.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (700 × 680) </p>
                <p>Note:2nd  image resolution = (512 × 395) </p>

                @elseif(request()->get('bannerType')  == 'banner46')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner46.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (452 × 300) </p>
                <p>Note:2nd  image resolution = (452 × 300) </p>
                <p>Note:3rd  image resolution = (452 × 300) </p>

                @elseif(request()->get('bannerType')  == 'banner47')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner47.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (700 × 680) </p>
                <p>Note:2nd  image resolution = (700 × 680) </p>

                @elseif(request()->get('bannerType')  == 'banner48')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner48.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (452 × 300) </p>
                <p>Note:2nd  image resolution = (452 × 300) </p>
                <p>Note:3rd  image resolution = (452 × 300) </p>



                @elseif(request()->get('bannerType')  == 'banner49')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner49.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (452 × 300) </p>
                <p>Note:2nd  image resolution = (452 × 300) </p>
                <p>Note:3rd  image resolution = (452 × 300) </p>

                @elseif(request()->get('bannerType')  == 'banner50')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner50.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (680 × 370) </p>
                <p>Note:2nd  image resolution = (680 × 370) </p>

                @elseif(request()->get('bannerType')  == 'banner51')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner51.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (277 × 260) </p>
                <p>Note:2nd  image resolution = (576 × 260) </p>
                <p>Note:3rd  image resolution = (277 × 260) </p>


                @elseif(request()->get('bannerType')  == 'banner52')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner52.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (575 × 260) </p>
                <p>Note:2nd  image resolution = (575 × 260) </p>

                @elseif(request()->get('bannerType')  == 'spdemo15')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/spdemo15.png')}}" alt=""  width=100%>

                <p>Note:image resolution = (598 × 505) </p>

                @elseif(request()->get('bannerType')  == 'tpdemo15')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/tpdemo15.png')}}" alt=""  width=100%>

                <p>Note:image resolution = (598 × 505) </p>

                @elseif(request()->get('bannerType')  == 'rademo15')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/rademo15.png')}}" alt=""  width=100%>

                <p>Note:image resolution = (598 × 505) </p>

                @elseif(request()->get('bannerType')  == 'topselldemo15')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/topselldemo15.png')}}" alt=""  width=100%>

                <p>Note:image resolution = (598 × 505) </p>


                @elseif(request()->get('bannerType')  == 'banner53')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner53.png')}}" alt=""  width=100%>

                <p>Note:image resolution = (1920 × 900) </p>

                @elseif(request()->get('bannerType')  == 'topsell7_banner1')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/topsell7_banner1.png')}}" alt=""  width=100%>

                <p>Note:image resolution = (514 × 700) </p>


                @elseif(request()->get('bannerType')  == 'topsell7_banner2')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/topsell7_banner2.png')}}" alt=""  width=100%>

                <p>Note:image resolution = (514 × 700) </p>

                @elseif(request()->get('bannerType')  == 'banner54')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner54.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (475 × 560) </p>
                <p>Note:2nd  image resolution = (673 × 270) </p>
                <p>Note:3rd  image resolution = (326 × 270) </p>
                <p>Note:4th  image resolution = (326 × 270) </p>

                @elseif(request()->get('bannerType')  == 'recent16banner')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/recent16banner.png')}}" alt=""  width=100%>

                <p>Note:image resolution = (277 × 277) </p>

                @elseif(request()->get('bannerType')  == 'banner55')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner55.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (575 × 415) </p>
                <p>Note:2nd  image resolution = (278 × 261) </p>
                <p>Note:3rd  image resolution = (278 × 134) </p>
                <p>Note:4th  image resolution = (278 × 261) </p>
                <p>Note:5th  image resolution = (873 × 260) </p>

                @elseif(request()->get('bannerType')  == 'banner56')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner56.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (377 × 260) </p>
                <p>Note:2nd  image resolution = (377 × 260) </p>
                <p>Note:3rd  image resolution = (377 × 260) </p>

                @elseif(request()->get('bannerType')  == 'banner57')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner57.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (690 × 240) </p>
                <p>Note:2nd  image resolution = (335 × 420) </p>
                <p>Note:3rd  image resolution = (335 × 200) </p>
                <p>Note:4th  image resolution = (335 × 200) </p>

                @elseif(request()->get('bannerType')  == 'banner58')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner58.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (453 × 240) </p>
                <p>Note:2nd  image resolution = (453 × 240) </p>
                <p>Note:3rd  image resolution = (453 × 240) </p>

                @elseif(request()->get('bannerType')  == 'recent18banner')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/recent18banner.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (452 × 390) </p>
                <p>Note:2nd  image resolution = (452 × 390) </p>


                @elseif(request()->get('bannerType')  == 'spdemo21')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/spdemo21.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (1920 × 740) </p>

                @elseif(request()->get('bannerType')  == 'banner59')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner59.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (574 × 320) </p>
                <p>Note:2nd  image resolution = (574 × 320) </p>

                @elseif(request()->get('bannerType')  == 'banner60')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner60.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (1160 × 572) </p>
                <p>Note:2nd  image resolution = (570 × 305) </p>
                <p>Note:3rd  image resolution = (570 × 305) </p>


                @elseif(request()->get('bannerType')  == 'spdemo23')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/spdemo23.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (530 × 877) </p>


                @elseif(request()->get('bannerType')  == 'nademo23')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/nademo23.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (530 × 877) </p>


                @elseif(request()->get('bannerType')  == 'banner61')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner61.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (360 × 500) </p>
                <p>Note:2nd  image resolution = (430 × 540) </p>
                <p>Note:3rd  image resolution = (360 × 500) </p>

                @elseif(request()->get('bannerType')  == 'banner62')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner62.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (960 × 600) </p>
                <p>Note:2nd  image resolution = (480 × 300) </p>
                <p>Note:3rd  image resolution = (480 × 300) </p>
                <p>Note:4th  image resolution = (480 × 300) </p>
                <p>Note:5th  image resolution = (480 × 300) </p>

                @elseif(request()->get('bannerType')  == 'banner63')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner63.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (390 × 500) </p>
                <p>Note:2nd  image resolution = (390 × 500) </p>
                <p>Note:3rd  image resolution = (390 × 500) </p>
                <p>Note:4th  image resolution = (1170 × 500) </p>

                @elseif(request()->get('bannerType')  == 'banner64')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner64.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (1920 × 500) </p>

                @elseif(request()->get('bannerType')  == 'spdemo25')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/spdemo25.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (376 × 500) </p>
                <p>Note:2nd  image resolution = (376 × 500) </p>


                @elseif(request()->get('bannerType')  == 'banner65')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner65.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (690 × 220) </p>
                <p>Note:2nd  image resolution = (690 × 220) </p>

                @elseif(request()->get('bannerType')  == 'tabdemo22')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/tabdemo22.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (380 × 540) </p>


                @elseif(request()->get('bannerType')  == 'topdemo26')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/topdemo26.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (232 × 680) </p>

                @elseif(request()->get('bannerType')  == 'tpdemo26')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/tpdemo26.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (232 × 680) </p>

                @elseif(request()->get('bannerType')  == 'banner66')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner66.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (1903 × 1070) </p>

                @elseif(request()->get('bannerType')  == 'topdemo27')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/topdemo27.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (666 × 1070) </p>


                @elseif(request()->get('bannerType')  == 'tpdemo27')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/tpdemo27.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (666 × 1070) </p>

                 @elseif(request()->get('bannerType')  == 'banner67')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner67.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (695 × 230) </p>
                <p>Note:2nd  image resolution = (695 × 230) </p>


                @elseif(request()->get('bannerType')  == 'banner68')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner68.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (1440 × 790) </p>

                @elseif(request()->get('bannerType')  == 'banner69')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner69.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (472 × 530) </p>
                <p>Note:2nd  image resolution = (590 × 532) </p>
                <p>Note:3rd  image resolution = (471 × 300) </p>

                @elseif(request()->get('bannerType')  == 'banner70')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner70.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (1903 × 900) </p>

                @elseif(request()->get('bannerType')  == 'banner71')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner71.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (1919 × 700) </p>
                <p>Note:2nd  image resolution = (690 × 340) </p>
                <p>Note:3rd  image resolution = (690 × 340) </p>


                @elseif(request()->get('bannerType')  == 'banner72')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner72.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (1903 × 623) </p>
                <p>Note:2nd  image resolution = (475 × 165) </p>


                @elseif(request()->get('bannerType')  == 'banner73')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner73.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (280 × 400) </p>
                <p>Note:2nd  image resolution = (580 × 250) </p>
                <p>Note:3rd  image resolution = (580 × 250) </p>


                @elseif(request()->get('bannerType')  == 'banner74')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/banner74.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (730 × 250) </p>
                <p>Note:2nd  image resolution = (730 × 250) </p>

                @elseif(request()->get('bannerType')  == 'spoffdemo14')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/spoffdemo14.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (280 × 400) </p>


                @elseif(request()->get('bannerType')  == 'nademo14')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/nademo14.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (240 × 400) </p>


                @elseif(request()->get('bannerType')  == 'topdemo14')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/topdemo14.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (240 × 400) </p>


                @elseif(request()->get('bannerType')  == 'spdemo14')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/spdemo14.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (240 × 400) </p>


                @elseif(request()->get('bannerType')  == 'tpdemo14')
                <br>
                <img src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/tpdemo14.png')}}" alt=""  width=100%>

                <p>Note:1st  image resolution = (240 × 400) </p>
                
              @endif
          </div>
          
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
              		  @if (count($errors) > 0)
                          @if($errors->any())
                            <div class="alert alert-success alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              {{$errors->first()}}
                            </div>
                          @endif
                      @endif

              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      {{-- <th>{{ trans('labels.ID') }}</th> --}}
                      <th>{{ trans('labels.Language Name') }}</th>
                      <th>{{ trans('labels.Image') }}</th>
                      <th>{{ trans('labels.AddedModifiedDate') }}</th>
                      <th>{{ trans('labels.Action') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($result['banners'])>0)
                    @foreach ($result['banners'] as $key=>$banners)
                        <tr>
                            {{-- <td>{{ $banners->banners_id }}</td> --}}
                            <td>{{ $banners->language_name }}</td>
                            <td><img src="{{asset($banners->path)}}" alt="" style="max-width: 100px;height:100px;"></td>
                            <td><strong>{{ trans('labels.AddedDate') }}: </strong> {{ date('d M, Y', strtotime($banners->date_added)) }}<br>
                            </td>

                            <td><a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Edit') }}" href="editconstantbannerthree/{{ $banners->banners_id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <!-- <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Delete') }}" id="deleteBannerId" banners_id ="{{ $banners->banners_id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                        </tr>
                    @endforeach
                    @else
                       <tr>
                            <td colspan="5">{{ trans('labels.NoRecordFound') }}</td>
                       </tr>
                    @endif
                  </tbody>
                </table>
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

    <!-- deleteBannerModal -->
	<div class="modal fade" id="deleteBannerModal" tabindex="-1" role="dialog" aria-labelledby="deleteBannerModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="deleteBannerModalLabel">{{ trans('labels.DeleteBanner') }}</h4>
		  </div>
		  {!! Form::open(array('url' =>'admin/deleteconstantBannerthree', 'name'=>'deleteBanner', 'id'=>'deleteBanner', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
				  {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
				  {!! Form::hidden('banners_id',  '', array('class'=>'form-control', 'id'=>'banners_id')) !!}
		  <div class="modal-body">
			  <p>{{ trans('labels.DeleteBannerText') }}</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
			<button type="submit" class="btn btn-primary" id="deleteBanner">{{ trans('labels.Delete') }}</button>
		  </div>
		  {!! Form::close() !!}
		</div>
	  </div>
	</div>

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
@endsection
