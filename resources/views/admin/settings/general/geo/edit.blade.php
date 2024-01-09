@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.edit-geo-fencing') }} <small>{{ trans('labels.edit-geo-fencing') }} ...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/geo-fencing')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.ListingAllgeo') }}</a></li>
                <li class="active">{{ trans('labels.edit-geo-fencing') }} </li>
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
                            <h3 class="box-title">{{ trans('labels.edit-geo-fencing') }}  </h3>
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
                                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                        <span class="sr-only">{{ trans('labels.Error') }}:</span>
                                                        {{ $error }}
                                                    </div>
                                                @endforeach
                                            @endif

                                            {!! Form::open(array('url' =>'admin/editgeofencingaction', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

                                            {!! Form::hidden('id', $geo->id , array('class'=>'form-control', 'id'=>'id')) !!}

                                            <div class="form-group">
                                                 <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Country') }} </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control field-validate select2" name="country_id" id="entry_country_id">
                                                        <option value="">{{ trans('labels.SelectCountry') }}</option>
                                                        @foreach($data['countries'] as $countries)
                                                            <option  @if( $countries->countries_id == $geo->country_id)
                                                                    selected
                                                                    @endif value="{{ $countries->countries_id }}">{{ $countries->countries_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    {{ trans('labels.CountryText') }}</span>
        
                                                </div>
                                            </div>
                                           

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.State') }} </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control zoneContent select2" name="state_id" id="entry_zone_id">
                                                        <option value="">{{ trans('labels.SelectZone') }}</option>
                                                        <?php   $getZones = DB::table('zones')->where('zone_country_id', $geo->country_id)->get(); ?>
                                                         @foreach($getZones as $state)
                                                         <option  @if( $state->zone_id == $geo->state_id)
                                                                    selected
                                                                    @endif value="{{ $state->zone_id}}">{{ $state->zone_name }}</option>
                                                         @endforeach
                                                       </select>
                                                     <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                      {{ trans('labels.SelectZoneText') }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Zip/Postal Codes') }}</label>
                                            <div class="col-sm-10 col-md-6">
                                              <textarea id="editor" name="pincode" class="form-control" rows="10" cols="80">{{ $geo->pincode}}</textarea>
                                              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.Zip/Postal Codes') }} </span>
      
                                              <br>
                                            </div>
                                        </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control" name="news_status">
                                                       <option value="1" @if($geo->status=='1') selected @endif>{{ trans('labels.Active') }}</option>
                                                  <option value="0" @if($geo->status=='0') selected @endif>{{ trans('labels.Inactive') }}</option>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                      {{ trans('labels.StatusInfo') }}</span>
                                                </div>
                                            </div>

                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }} </button>
                                                <a href="{{ URL::to('admin/geo-fencing')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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
    <script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
    
@endsection
