@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{ trans('labels.Sliders') }} <small>{{ trans('labels.ListingAllImages') }}...</small> </h1>
    <ol class="breadcrumb">
       <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">{{ trans('labels.Sliders') }}</li>
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
            <div class="col-lg-10 form-inline">

            <?php $current_theme = DB::table('current_theme')->where('id', '=', '1')->first(); ?>


              <form  name='registration' id="registration" class="registration" method="get">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">

                  <div class="input-group-form search-panel ">
                      <select onchange="this.form.submit()" id="sliderType" type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="sliderType">

                          <option value="" selected disabled hidden>{{trans('labels.ChooseSliderType')}}</option>     
                         
                          @if($current_theme->template == 0)

                            @if($current_theme->recent_arrival == 17)

                            @if($current_theme->carousel == 1)
                                <option value="1" @if(request()->get('sliderType') == 1) selected @endif>Carousel Style 1</option>
                              @endif
                              @if($current_theme->carousel == 2)
                              <option value="2" @if(request()->get('sliderType') == 2) selected @endif>Carousel Style 2</option>
                              @endif
                              @if($current_theme->carousel == 3)
                              <option value="3" @if(request()->get('sliderType') == 3) selected @endif>Carousel Style 3</option>
                              @endif
                              @if($current_theme->carousel == 4)
                              <option value="4" @if(request()->get('sliderType') == 4) selected @endif>Carousel Style 4</option>
                              @endif
                              @if($current_theme->carousel == 5)
                              <option value="5" @if(request()->get('sliderType') == 5) selected @endif>Carousel Style 5</option>
                              @endif
                              @if($current_theme->carousel == 20)
                              <option value="20" @if(request()->get('sliderType') == 20) selected @endif>Carousel Style 20</option>
                              @endif
                              @if($current_theme->carousel == 24)
                              <option value="19" @if(request()->get('sliderType') == 24) selected @endif>Carousel Style 19</option>
                              @endif
                              @if($current_theme->carousel == 6)
                              <option value="6" @if(request()->get('sliderType') == 6) selected @endif>Carousel Style 6 (Demo-1)</option>
                              @endif
                              @if($current_theme->carousel == 7)
                              <option value="7" @if(request()->get('sliderType') == 7) selected @endif>Carousel Style 7 (Demo-2)</option>
                              @endif
                              @if($current_theme->carousel == 8)
                              <option value="8" @if(request()->get('sliderType') == 8) selected @endif>Carousel Style 8 (Demo-3)</option>
                              @endif
                              @if($current_theme->carousel == 9)
                              <option value="9" @if(request()->get('sliderType') == 9) selected @endif>Carousel Style 9 (Demo-4)</option>
                              @endif
                              @if($current_theme->carousel == 10)
                              <option value="10" @if(request()->get('sliderType') == 10) selected @endif>Carousel Style 10 (Demo-5)</option>
                              @endif
                              @if($current_theme->carousel == 11)
                              <option value="11" @if(request()->get('sliderType') == 11) selected @endif>Carousel Style 11 (Demo-6)</option>
                              @endif
                              @if($current_theme->carousel == 22)
                              <option value="22" @if(request()->get('sliderType') == 22) selected @endif>Carousel Style 22 (Demo-8)</option>
                              @endif
                              @if($current_theme->carousel == 12)
                              <option value="12" @if(request()->get('sliderType') == 12) selected @endif>Carousel Style 12 (Demo-9)</option>
                              @endif
                              @if($current_theme->carousel == 23)
                              <option value="23" @if(request()->get('sliderType') == 23) selected @endif>Carousel Style 23 (Demo-10)</option>
                              @endif
                              @if($current_theme->carousel == 13)
                              <option value="13" @if(request()->get('sliderType') == 13) selected @endif>Carousel Style 13 (Demo-11)</option>
                              @endif
                              @if($current_theme->carousel == 25)
                              <option value="25" @if(request()->get('sliderType') == 25) selected @endif>Carousel Style 25 (Demo-12)</option>
                              @endif
                              @if($current_theme->carousel == 26)
                              <option value="26" @if(request()->get('sliderType') == 26) selected @endif>Carousel Style 26 (Demo-13)</option>
                              @endif
                              @if($current_theme->carousel == 14)
                              <option value="14" @if(request()->get('sliderType') == 14) selected @endif>Carousel Style 14 (Demo-14)</option>
                              @endif
                              @if($current_theme->carousel == 30)
                              <option value="30" @if(request()->get('sliderType') == 30) selected @endif>Carousel Style 30 (Demo-15)</option>
                              @endif
                              @if($current_theme->carousel == 27)
                              <option value="27" @if(request()->get('sliderType') == 27) selected @endif>Carousel Style 27 (Demo-16)</option>
                              @endif
                              @if($current_theme->carousel == 28)
                              <option value="28" @if(request()->get('sliderType') == 28) selected @endif>Carousel Style 28 (Demo-18)</option>
                              @endif
                              @if($current_theme->recent_arrival == 17)
                              <option value="34" @if(request()->get('sliderType') == 34) selected @endif>Carousel Style 34 (Demo-19)</option>
                              @endif
                              @if($current_theme->carousel == 15)
                              <option value="15" @if(request()->get('sliderType') == 15) selected @endif>Carousel Style 15 (Demo-21)</option>
                              @endif
                              @if($current_theme->carousel == 29)
                              <option value="29" @if(request()->get('sliderType') == 29) selected @endif>Carousel Style 29 (Demo-22)</option>
                              @endif
                              @if($current_theme->carousel == 31)
                              <option value="31" @if(request()->get('sliderType') == 31) selected @endif>Carousel Style 31 (Demo-23)</option>
                              @endif
                              @if($current_theme->carousel == 32)
                              <option value="32" @if(request()->get('sliderType') == 32) selected @endif>Carousel Style 32 (Demo-24)</option>
                              @endif
                              @if($current_theme->carousel == 33)
                              <option value="33" @if(request()->get('sliderType') == 33) selected @endif>Carousel Style 33 (Demo-25)</option>
                              @endif
                              @if($current_theme->carousel == 16)
                              <option value="16" @if(request()->get('sliderType') == 16) selected @endif>Carousel Style 16 (Demo-26)</option>
                              @endif
                              @if($current_theme->carousel == 35)
                              <option value="35" @if(request()->get('sliderType') == 35) selected @endif>Carousel Style 35 (Demo-27)</option>
                              @endif
                              @if($current_theme->carousel == 17)
                              <option value="17" @if(request()->get('sliderType') == 17) selected @endif>Carousel Style 17 (Demo-28)</option>
                              @endif
                              @if($current_theme->carousel == 36)
                              <option value="36" @if(request()->get('sliderType') == 36) selected @endif>Carousel Style 36 (Demo-29)</option>
                              @endif
                              @if($current_theme->carousel == 37)
                              <option value="37" @if(request()->get('sliderType') == 37) selected @endif>Carousel Style 37 (Demo-30)</option>
                              @endif
                              @if($current_theme->carousel == 38)
                              <option value="38" @if(request()->get('sliderType') == 38) selected @endif>Carousel Style 38 (Demo-31)</option>
                              @endif
                              @if($current_theme->carousel == 19)
                              <option value="19" @if(request()->get('sliderType') == 19) selected @endif>Carousel Style 19 (Demo-32,33)</option>
                              @endif
                              @if($current_theme->carousel == 18)
                              <option value="18" @if(request()->get('sliderType') == 18) selected @endif>Carousel Style 18 (Demo-34)</option>
                              @endif
                              @if($current_theme->carousel == 21)
                              <option value="21" @if(request()->get('sliderType') == 21) selected @endif>Carousel Style 21 (Demo-35)</option>
                              @endif

                            @else

                              @if($current_theme->carousel == 1)
                                <option value="1" selected>Carousel Style 1</option>
                              @endif
                              @if($current_theme->carousel == 2)
                              <option value="2" selected>Carousel Style 2</option>
                              @endif
                              @if($current_theme->carousel == 3)
                              <option value="3" selected>Carousel Style 3</option>
                              @endif
                              @if($current_theme->carousel == 4)
                              <option value="4" selected>Carousel Style 4</option>
                              @endif
                              @if($current_theme->carousel == 5)
                              <option value="5" selected>Carousel Style 5</option>
                              @endif
                              @if($current_theme->carousel == 20)
                              <option value="20" selected>Carousel Style 20</option>
                              @endif
                              @if($current_theme->carousel == 24)
                              <option value="19" selected>Carousel Style 19</option>
                              @endif
                              @if($current_theme->carousel == 6)
                              <option value="6" selected>Carousel Style 6 (Demo-1)</option>
                              @endif
                              @if($current_theme->carousel == 7)
                              <option value="7" selected>Carousel Style 7 (Demo-2)</option>
                              @endif
                              @if($current_theme->carousel == 8)
                              <option value="8" selected>Carousel Style 8 (Demo-3)</option>
                              @endif
                              @if($current_theme->carousel == 9)
                              <option value="9" selected>Carousel Style 9 (Demo-4)</option>
                              @endif
                              @if($current_theme->carousel == 10)
                              <option value="10" selected>Carousel Style 10 (Demo-5)</option>
                              @endif
                              @if($current_theme->carousel == 11)
                              <option value="11" selected>Carousel Style 11 (Demo-6)</option>
                              @endif
                              @if($current_theme->carousel == 22)
                              <option value="22" selected>Carousel Style 22 (Demo-8)</option>
                              @endif
                              @if($current_theme->carousel == 12)
                              <option value="12" selected>Carousel Style 12 (Demo-9)</option>
                              @endif
                              @if($current_theme->carousel == 23)
                              <option value="23" selected>Carousel Style 23 (Demo-10)</option>
                              @endif
                              @if($current_theme->carousel == 13)
                              <option value="13" selected>Carousel Style 13 (Demo-11)</option>
                              @endif
                              @if($current_theme->carousel == 25)
                              <option value="25" selected>Carousel Style 25 (Demo-12)</option>
                              @endif
                              @if($current_theme->carousel == 26)
                              <option value="26" selected>Carousel Style 26 (Demo-13)</option>
                              @endif
                              @if($current_theme->carousel == 14)
                              <option value="14" selected>Carousel Style 14 (Demo-14)</option>
                              @endif
                              @if($current_theme->carousel == 30)
                              <option value="30" selected>Carousel Style 30 (Demo-15)</option>
                              @endif
                              @if($current_theme->carousel == 27)
                              <option value="27"selected>Carousel Style 27 (Demo-16)</option>
                              @endif
                              @if($current_theme->carousel == 28)
                              <option value="28" selected>Carousel Style 28 (Demo-18)</option>
                              @endif
                              @if($current_theme->carousel == 15)
                              <option value="15" selected>Carousel Style 15 (Demo-21)</option>
                              @endif
                              @if($current_theme->carousel == 29)
                              <option value="29" selected>Carousel Style 29 (Demo-22)</option>
                              @endif
                              @if($current_theme->carousel == 31)
                              <option value="31" selected>Carousel Style 31 (Demo-23)</option>
                              @endif
                              @if($current_theme->carousel == 32)
                              <option value="32" selected>Carousel Style 32 (Demo-24)</option>
                              @endif
                              @if($current_theme->carousel == 33)
                              <option value="33" selected>Carousel Style 33 (Demo-25)</option>
                              @endif
                              @if($current_theme->carousel == 16)
                              <option value="16" selected>Carousel Style 16 (Demo-26)</option>
                              @endif
                              @if($current_theme->carousel == 35)
                              <option value="35" selected>Carousel Style 35 (Demo-27)</option>
                              @endif
                              @if($current_theme->carousel == 17)
                              <option value="17" selected>Carousel Style 17 (Demo-28)</option>
                              @endif
                              @if($current_theme->carousel == 36)
                              <option value="36" selected>Carousel Style 36 (Demo-29)</option>
                              @endif
                              @if($current_theme->carousel == 37)
                              <option value="37" selected>Carousel Style 37 (Demo-30)</option>
                              @endif
                              @if($current_theme->carousel == 38)
                              <option value="38" selected>Carousel Style 38 (Demo-31)</option>
                              @endif
                              @if($current_theme->carousel == 19)
                              <option value="19" selected>Carousel Style 19 (Demo-32,33)</option>
                              @endif
                              @if($current_theme->carousel == 18)
                              <option value="18" selected>Carousel Style 18 (Demo-34)</option>
                              @endif
                              @if($current_theme->carousel == 21)
                              <option value="21" selected>Carousel Style 21 (Demo-35)</option>
                              @endif
                            @endif
                          @endif

                          @if($current_theme->template == 1)
                          <option value="6" selected>Carousel Style 6 (Demo-1)</option>
                          @endif

                          @if($current_theme->template == 2)
                          <option value="7" selected>Carousel Style 7 (Demo-2)</option>
                          @endif
                        
                          @if($current_theme->template == 3)
                          <option value="8" selected>Carousel Style 8 (Demo-3)</option>
                          @endif

                          @if($current_theme->template == 4)
                          <option value="9" selected>Carousel Style 9 (Demo-4)</option>
                          @endif

                          @if($current_theme->template == 5)
                          <option value="10" selected>Carousel Style 10 (Demo-5)</option>
                          @endif

                          @if($current_theme->template == 6)
                          <option value="11" selected>Carousel Style 11 (Demo-6)</option>
                          @endif

                          @if($current_theme->template == 8)
                          <option value="22" selected>Carousel Style 22 (Demo-8)</option>
                          @endif

                          @if($current_theme->template == 9)
                          <option value="12" selected>Carousel Style 12 (Demo-9)</option>
                          @endif

                          @if($current_theme->template == 10)
                          <option value="23" selected>Carousel Style 23 (Demo-10)</option>
                          @endif

                          @if($current_theme->template == 11)
                          <option value="13" selected>Carousel Style 13 (Demo-11)</option>
                          @endif

                          @if($current_theme->template == 12)
                          <option value="25" selected>Carousel Style 25 (Demo-12)</option>
                          @endif

                          @if($current_theme->template == 13)
                          <option value="26" selected>Carousel Style 26 (Demo-13)</option>
                          @endif

                          @if($current_theme->template == 14)
                          <option value="14" selected>Carousel Style 14 (Demo-14)</option>
                          @endif

                          @if($current_theme->template == 15)
                          <option value="30" selected>Carousel Style 30 (Demo-15)</option>
                          @endif

                          @if($current_theme->template == 16)
                          <option value="27" selected>Carousel Style 27 (Demo-16)</option>
                          @endif

                          @if($current_theme->template == 18)
                          <option value="28" selected>Carousel Style 28 (Demo-18)</option>
                          @endif

                          @if($current_theme->template == 19)
                          <option value="34" selected>Carousel Style 34 (Demo-19)</option>
                          @endif

                          @if($current_theme->template == 21)
                          <option value="15" selected>Carousel Style 15 (Demo-21)</option>
                          @endif

                          @if($current_theme->template == 22)
                          <option value="29" selected>Carousel Style 29 (Demo-22)</option>
                          @endif

                          @if($current_theme->template == 23)
                          <option value="31" selected>Carousel Style 31 (Demo-23)</option>
                          @endif

                          @if($current_theme->template == 24)
                          <option value="32" selected>Carousel Style 32 (Demo-24)</option>
                          @endif

                          @if($current_theme->template == 25)
                          <option value="33" selected>Carousel Style 33 (Demo-25)</option>
                          @endif

                          @if($current_theme->template == 26)
                          <option value="16" selected>Carousel Style 16 (Demo-26)</option>
                          @endif

                          @if($current_theme->template == 27)
                          <option value="35" selected>Carousel Style 35 (Demo-27)</option>
                          @endif

                          @if($current_theme->template == 28)
                          <option value="17" selected>Carousel Style 17 (Demo-28)</option>
                          @endif

                          @if($current_theme->template == 29)
                          <option value="36" selected>Carousel Style 36 (Demo-29)</option>
                          @endif

                          @if($current_theme->template == 30)
                          <option value="37" selected>Carousel Style 37 (Demo-30)</option>
                          @endif
                          
                          @if($current_theme->template == 31)
                          <option value="38" selected>Carousel Style 38 (Demo-31)</option>
                          @endif

                          @if($current_theme->template == 32)
                          <option value="19" selected>Carousel Style 19 (Demo-32)</option>
                          @endif

                          @if($current_theme->template == 33)
                          <option value="19" selected>Carousel Style 19 (Demo-33)</option>
                          @endif

                          @if($current_theme->template == 34)
                          <option value="18" selected>Carousel Style 18 (Demo-34)</option>
                          @endif

                          @if($current_theme->template == 35)
                          <option value="21" selected>Carousel Style 21 (Demo-35)</option>
                          @endif





                      </select>
                      {{-- <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button> --}}
                      @if(request()->get('sliderType'))  <a class="btn btn-danger " href="{{url('admin/sliders')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                  </div>
              </form>
              <div class="col-lg-4 form-inline" id="contact-form12"></div>
          </div>
            <div class="box-tools pull-right">
             <a href="{{ URL::to('admin/addsliderimage') }}" type="button" class="btn btn-block btn-primary">{{ trans('labels.AddSliderImage') }}</a>
            </div>

         
            
              
          </div>
         

          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
              @if($current_theme->carousel == 3 || $current_theme->carousel == 5 || $current_theme->carousel == 7 || $current_theme->carousel == 8 || $current_theme->carousel == 29 || $current_theme->carousel == 16 || $current_theme->carousel == 17 || $current_theme->carousel == 18 || $current_theme->carousel == 20)
              <p style="color:red;">Note: Please Add Thumb Image in Banner one page</p>                
              @endif
             
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
                      <th>{{ trans('labels.ID') }}</th>
                      <th>{{ trans('labels.Slider Type') }}</th>
                      <th>{{ trans('labels.Slider Image') }}</th>
                      <th>Slider Mobile Image</th>
                      <th>{{ trans('labels.AddedModifiedDate') }}</th>
                      <th>{{ trans('labels.languages') }}</th>
                      <th>{{ trans('labels.Action') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($result['sliders'])>0)
                    @foreach ($result['sliders'] as $key=>$sliders)
                        <tr>
                            <td>{{ $sliders->sliders_id }}</td>
                            <td>


                              @if($sliders->carousel_id == 1)
                              Carousel Style 1
                              @elseif($sliders->carousel_id == 2)
                              Carousel Style 2
                              @elseif($sliders->carousel_id == 3)
                              Carousel Style 3
                              @elseif($sliders->carousel_id == 4)
                              Carousel Style 4
                              @elseif($sliders->carousel_id == 5)
                              Carousel Style 5


                              @elseif($sliders->carousel_id == 6)
                              Carousel Style 6 (Demo-1)
                              @elseif($sliders->carousel_id == 7)
                              Carousel Style 7 (Demo-2)
                              @elseif($sliders->carousel_id == 8)
                              Carousel Style 8 (Demo-3)
                              @elseif($sliders->carousel_id == 9)
                              Carousel Style 9 (Demo-4)
                              @elseif($sliders->carousel_id == 10)
                              Carousel Style 10 (Demo-5)
                              @elseif($sliders->carousel_id == 11)
                              Carousel Style 11 (Demo-6)
                              @elseif($sliders->carousel_id == 12)
                              Carousel Style 12 (Demo-9)
                              @elseif($sliders->carousel_id == 13)
                              Carousel Style 13 (Demo-11)
                              @elseif($sliders->carousel_id == 14)
                              Carousel Style 14 (Demo-14)
                              @elseif($sliders->carousel_id == 15)
                              Carousel Style 15 (Demo-21)
                              @elseif($sliders->carousel_id == 16)
                              Carousel Style 16 (Demo-26)
                              @elseif($sliders->carousel_id == 17)
                              Carousel Style 17 (Demo-28)
                              @elseif($sliders->carousel_id == 18)
                              Carousel Style 18 (Demo-34)
                              @elseif($sliders->carousel_id == 19)
                              Carousel Style 19 (Demo-32,33)
                              @elseif($sliders->carousel_id == 20)
                              Carousel Style 20
                              @elseif($sliders->carousel_id == 21)
                              Carousel Style 21 (Demo-35)
                              @elseif($sliders->carousel_id == 22)
                              Carousel Style 22 (Demo-8)
                              @elseif($sliders->carousel_id == 23)
                              Carousel Style 23 (Demo-10)
                              @elseif($sliders->carousel_id == 24)
                              Carousel Style 19
                              @elseif($sliders->carousel_id == 25)
                              Carousel Style 25 (Demo-12)
                              @elseif($sliders->carousel_id == 26)
                              Carousel Style 26 (Demo-13)
                              @elseif($sliders->carousel_id == 27)
                              Carousel Style 27 (Demo-16)
                              @elseif($sliders->carousel_id == 28)
                              Carousel Style 28 (Demo-18)
                              @elseif($sliders->carousel_id == 29)
                              Carousel Style 29 (Demo-22)
                              @elseif($sliders->carousel_id == 30)
                              Carousel Style 30 (Demo-15)
                              @elseif($sliders->carousel_id == 31)
                              Carousel Style 31 (Demo-23)
                              @elseif($sliders->carousel_id == 32)
                              Carousel Style 32 (Demo-24)
                              @elseif($sliders->carousel_id == 33)
                              Carousel Style 33 (Demo-25)
                              @elseif($sliders->carousel_id == 34)
                              Carousel Style 34 (Demo-19)
                              @elseif($sliders->carousel_id == 35)
                              Carousel Style 35 (Demo-27)
                              @elseif($sliders->carousel_id == 36)
                              Carousel Style 36 (Demo-29)
                              @elseif($sliders->carousel_id == 37)
                              Carousel Style 37 (Demo-30)
                              @elseif($sliders->carousel_id == 38)
                              Carousel Style 38 (Demo-31)
                              @endif</td>


                            <td> <img src="{{asset($sliders->path)}}" alt="" width=" 200px"> </td>
                            <td><img src="{{asset($sliders->iconpath)}}" alt="" width=" 100px" height="100px"> </td>
                            <td><strong>{{ trans('labels.AddedDate') }}: </strong> {{ date('d M, Y', strtotime($sliders->date_added)) }}<br>
                            <strong>{{ trans('labels.ModifiedDate') }}: </strong>@if(!empty($sliders->date_status_change)) {{ date('d M, Y', strtotime($sliders->date_status_change)) }}  @endif<br>
                            <strong>{{ trans('labels.ExpiryDate') }}: </strong>@if(!empty($sliders->expires_date)) {{ date('d M, Y', strtotime($sliders->expires_date)) }}  @endif</td>

                            <td>{{ $sliders->language_name }}</td>
                            <td><a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Edit') }}" href="editslide/{{ $sliders->sliders_id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                             <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Delete') }}" id="deleteSliderId" sliders_id ="{{ $sliders->sliders_id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </tr>
                    @endforeach
                    @else
                       <tr>
                            <td colspan="5">{{ trans('labels.NoRecordFound') }}</td>
                       </tr>
                    @endif
                  </tbody>
                </table>
                <div class="col-xs-12 text-right">
                @if($result['sliders'] != null)
                                      <div class="col-xs-12 text-right">
                                          {{$result['sliders']->links()}}
                                      </div>
                                    @endif
                	
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

    <!-- deleteSliderModal -->
	<div class="modal fade" id="deleteSliderModal" tabindex="-1" role="dialog" aria-labelledby="deleteSliderModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="deleteSliderModalLabel">{{ trans('labels.DeleteSlider') }}</h4>
		  </div>
		  {!! Form::open(array('url' =>'admin/deleteSlider', 'name'=>'deleteSlider', 'id'=>'deleteSlider', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
				  {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
				  {!! Form::hidden('sliders_id',  '', array('class'=>'form-control', 'id'=>'sliders_id')) !!}
		  <div class="modal-body">
			  <p>{{ trans('labels.DeleteSliderText') }}</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
			<button type="submit" class="btn btn-primary" id="deleteSlider">{{ trans('labels.Delete') }}</button>
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
