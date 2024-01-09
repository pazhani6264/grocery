@extends('admin.layout')
@section('content')
<style>
      .modal-footer
    {
        margin:20px;
    }
      .pac-container{
        z-index: 1052 !important;
      }
      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
        height: 42px;
        top: 9px !important;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }
  </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Edit Outlet</h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/appointment/outlet')}}"><i class="fa fa-industry"></i> Outlet</a></li>
                <li class="active">Edit Outlet</li>
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
                            <h3 class="box-title">Edit Outlet</h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <br>

                                        @if (session('update'))
                                            <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong> {{ session('update') }} </strong>
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
                                    <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            {!! Form::open(array('url' =>'admin/appointment/edit_outlet_action', 'method'=>'post', 'class' => 'form-horizontal form-validate ', 'enctype'=>'multipart/form-data')) !!}
                                            {!! Form::hidden('oldImage',  $result['outlet']->image, array('id'=>'oldImage','class'=>'field-validate ')) !!}

                                            <input type="hidden" name="id" value="{{ $result['outlet']->id }}"/>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Outlet Name</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input class="form-control" type="text" value="{{ $result['outlet']->name }}" name="outlet_name" id="outlet_name" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Phone</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input class="form-control" type="text" value="{{ $result['outlet']->phone }}" name="phone" id="phone" required>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Address</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <textarea type="text" rows="5" class="form-control" name="address" required>{{ $result['outlet']->address }}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Postal Code</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input class="form-control" type="text"  name="postal_code" value="{{ $result['outlet']->postal_code }}"  id="postal_code" required>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Latitude & Longtitude</label>
                                                <div class="col-sm-10 col-md-4">
                                                     <input type="text" required class="form-control" data-toggle="modal" data-target="#mapModal" name="location" id="location" aria-describedby="addressHelp" placeholder="map picker" value="({{$result['outlet']->lat }},{{$result['outlet']->lng }})">
                                                </div>
                                            </div>

                                            <input type="hidden" name="latitude" id="latitude" >
                                            <input type="hidden" name="longitude" id="longitude">

                                             <div class="form-group">
                                                 <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Country') }} </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control field-validate select2" name="country_id" id="entry_country_id">
                                                        <option value="">{{ trans('labels.SelectCountry') }}</option>
                                                        @foreach($data['countries'] as $countries)
                                                            <option  @if($countries->countries_id == $result['outlet']->countries_id)
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
                                                    <select class="form-control field-validate select2" name="state_id" id="entry_zone_id">
                                                        <option value="">{{ trans('labels.SelectZone') }}</option>
                                                        <?php   $getZones = DB::table('zones')->where('zone_country_id', $result['outlet']->countries_id)->get(); ?>
                                                         @foreach($getZones as $state)
                                                         <option  @if( $state->zone_id == $result['outlet']->zone_id)
                                                                    selected
                                                                    @endif value="{{ $state->zone_id}}">{{ $state->zone_name }}</option>
                                                         @endforeach
                                                       </select>
                                                     <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                      {{ trans('labels.SelectZoneText') }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group" id="imageIcone">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Image') }} (800 x 450)</label>
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
                                                                    <select class="image-picker show-html " name="image_id" id="select_img">
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
                                                          <button type="button" class="close pull-left image-close " id="image-Icone"
                                                            style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                    </div>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.ImageText') }}</span>

                                                    <br>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"></label>
                                                <div class="col-sm-10 col-md-4">

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.OldImage') }}</span>
                                                    <br>

                                                    <img src="{{asset($result['outlet_image']->path)}}" alt="" width=" 100px">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control" name="status">
                                                        <option value="1" <?php if($result['outlet']->status == 1){ ?> selected <?php } ?>>{{ trans('labels.Active') }}</option>
                                                        <option value="0" <?php if($result['outlet']->status == 0){ ?> selected <?php } ?>>{{ trans('labels.Inactive') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            
                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary">{{ trans('labels.submit') }}</button>
                                                <a href="{{ URL::to('admin/appointment/outlet')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
                                            </div>
                                            <!-- /.box-footer -->
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>



                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                        <div class="box-header">
                            <h3 class="box-title">Manage Booking Slot</h3>
                        </div>
                            <div class="box box-info"><br>
                                <div class="col-lg-3 pull-right">
                                    <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->add_slot_view == 1){ ?>
                                        <button data-toggle="modal" data-target="#addslotModal" type="button" class="btn btn-block btn-primary">Add Booking Slot</button>
                                    <?php } ?>
                                </div>
                                <br><br>
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Start Hour</th>
                                            <th>End Hour</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($result['slot'])>0)
                                            @foreach ($result['slot'] as $key=>$resultdata)
                                                <tr>
                                                    <td>{{ $resultdata->start_hour }}</td>
                                                    <td>{{ $resultdata->end_hour }}</td>
                                                    @if($resultdata->status == 1)
                                                        <td>Active</td>
                                                    @else
                                                        <td>Inactive</td>
                                                    @endif
                                                    <td>{{ $resultdata->created_at }}</td>
                                                    <td>
                                                        <!-- <a data-toggle="tooltip" data-placement="bottom" title="Edit Slot"  id="editSlotID" editslot_id ="{{ $resultdata->id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> -->
                                                        <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->edit_slot_view == 1){ ?>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="Edit Slot"  href="../edit_slot/{{ $resultdata->id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->delete_slot_view == 1){ ?>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="Delete Slot" id="deleteOrdersId" orders_id ="{{ $resultdata->id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="11">{{ trans('labels.NoRecordFound') }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    <div class="col-xs-12 text-right">

                                        {!! $result['slot']->appends(\Request::except('page'))->render() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                        <div class="box-header">
                            <h3 class="box-title">Manage Booking Holiday</h3>
                        </div>
                            <div class="box box-info"><br>
                                <div class="col-lg-3 pull-right">
                                    <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->add_holiday_view == 1){ ?>
                                        <button data-toggle="modal" data-target="#addholidayModal" type="button" class="btn btn-block btn-primary">Add Booking Holiday</button>
                                    <?php } ?>
                                </div>
                                <br><br>
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($result['holiday'])>0)
                                            @foreach ($result['holiday'] as $key=>$resultdata)
                                                <tr>
                                                    <td>{{ $resultdata->date }}</td>
                                                    @if($resultdata->status == 1)
                                                        <td>Active</td>
                                                    @else
                                                        <td>Inactive</td>
                                                    @endif
                                                    <td>{{ $resultdata->created_at }}</td>
                                                    <td>
                                                        <!-- <a data-toggle="tooltip" data-placement="bottom" title="Edit Holiday"  id="editholidayID" editholiday_id ="{{ $resultdata->id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> -->
                                                        <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->edit_holiday_view == 1){ ?>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="Edit Holiday"  href="../edit_holiday/{{ $resultdata->id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->delete_holiday_view == 1){ ?>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="Delete Holiday" id="deleteHoliday" holiday_id ="{{ $resultdata->id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="11">{{ trans('labels.NoRecordFound') }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    <div class="col-xs-12 text-right">

                                        {!! $result['holiday']->appends(\Request::except('page'))->render() !!}
                                    </div>
                                </div>
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


<!-- map model code start -->
<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-modal="true">
       
    <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
        <div class="modal-content">
           
             <div class="modal-body">
                <div class="container" style="width:100% !important">
                <button style="font-size: 5rem;margin-right: 15px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button> 
                    <div class="row align-items-center">                   
                        <div class="form-group">
                            <input type="text" id="pac-input" name="address_address" class="form-control map-input" placeholder="Search your location">
                        </div>
                        <div id="address-map-container" style="width:100%;height:400px; ">
                            <div style="width: 100%; height: 100%" id="map"></div>
                        </div>
                   </div>
                 </div>
               </div>
               <div class="modal-footer">
                <button style="padding:8px 15px"  type="button" class="btn btn-primary" onclick="setUserLocation()"><i  class="fa fa-location-arrow"></i></button>
                <button type="button" class="btn btn-secondary" onclick="saveAddress()">Save</button>
                </div>
            </div>
       </div>
    </div>
<!-- map modal code end -->



<!-- deleteModal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteModalLabel">Delete Booking Slot</h4>
            </div>
            {!! Form::open(array('url' =>'admin/appointment/delete_slot', 'name'=>'deleteOrder', 'id'=>'deleteOrder', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
            {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
            {!! Form::hidden('orders_id',  '', array('class'=>'form-control', 'id'=>'orders_id')) !!}
            <div class="modal-body">
                <p>Are You Sure You want to delete Booking Slot</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                <button type="submit" class="btn btn-primary" id="deleteOrder">{{ trans('labels.Delete') }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


<!-- deleteModal holiday -->
<div class="modal fade" id="deleteHolidayModal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteModalLabel">Delete Booking Holiday</h4>
            </div>
            {!! Form::open(array('url' =>'admin/appointment/delete_holiday', 'name'=>'deleteOrder', 'id'=>'deleteOrder', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
            {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
            {!! Form::hidden('holiday_id',  '', array('class'=>'form-control', 'id'=>'holiday_id')) !!}
            <div class="modal-body">
                <p>Are You Sure You want to delete Booking Holiday</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                <button type="submit" class="btn btn-primary" id="deleteOrder">{{ trans('labels.Delete') }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


<!-- Add Slot -->
<div class="modal fade" id="addslotModal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteModalLabel">Add Booking Slot</h4>
            </div>
            {!! Form::open(array('url' =>'admin/appointment/add_slot_action', 'method'=>'post',  'name'=>'addSlot', 'id'=>'deleteOrder','class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}

            <input type="hidden" name="outlet_id" value="{{ $result['outlet']->id }}"/>

            <div class="form-group">
                <label for="name" class="col-sm-2 col-md-3 control-label">Start Hour</label>
                <div class="col-sm-10 col-md-4 bootstrap-timepicker">
                    <input class="form-control timepicker" type="text"  name="start_hour" id="start_hour" required>
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="col-sm-2 col-md-3 control-label">End Hour</label>
                <div class="col-sm-10 col-md-4 bootstrap-timepicker">
                    <input class="form-control timepicker" type="text"  name="end_hour" id="end_hour">
                </div>
            </div>


            <div class="form-group">
                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                <div class="col-sm-10 col-md-4">
                    <select class="form-control" name="status">
                        <option value="1">{{ trans('labels.Active') }}</option>
                        <option value="0">{{ trans('labels.Inactive') }}</option>
                    </select>
                </div>
            </div>

            
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary">{{ trans('labels.submit') }}</button>
            </div>
            <!-- /.box-footer -->
            {!! Form::close() !!}
        </div>
    </div>
</div>




<!-- Edit Slot -->
<div class="modal fade" id="editslotModal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteModalLabel">Edit Booking Slot</h4>
            </div>
            {!! Form::open(array('url' =>'admin/appointment/edit_slot_action', 'method'=>'post','class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
            {!! Form::hidden('editslot_id',  '', array('class'=>'form-control', 'id'=>'editslot_id')) !!}
            <input type="hidden" name="outlet_id" value="{{ $result['outlet']->id }}"/>

            <div class="form-group">
                <label for="name" class="col-sm-2 col-md-3 control-label">Start Hour</label>
                <div class="col-sm-10 col-md-4 bootstrap-timepicker">
                    <input class="form-control timepicker" type="text"  name="start_hour" id="start_hour" required>
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="col-sm-2 col-md-3 control-label">End Hour</label>
                <div class="col-sm-10 col-md-4 bootstrap-timepicker">
                    <input class="form-control timepicker" type="text"  name="end_hour" id="end_hour">
                </div>
            </div>


            <div class="form-group">
                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                <div class="col-sm-10 col-md-4">
                    <select class="form-control" name="status">
                        <option value="1">{{ trans('labels.Active') }}</option>
                        <option value="0">{{ trans('labels.Inactive') }}</option>
                    </select>
                </div>
            </div>

            
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary">{{ trans('labels.submit') }}</button>
            </div>
            <!-- /.box-footer -->
            {!! Form::close() !!}
        </div>
    </div>
</div>




<!-- Add Holiday -->
<div class="modal fade" id="addholidayModal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteModalLabel">Add Booking Holiday</h4>
            </div>
            {!! Form::open(array('url' =>'admin/appointment/add_holiday_action', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}

            <input type="hidden" name="outlet_id" value="{{ $result['outlet']->id }}"/>

            <div class="form-group">
                <label for="name" class="col-sm-2 col-md-3 control-label">Date</label>
                <div class="col-sm-10 col-md-4">
                    <input class="form-control datepicker" type="text"  name="date" id="date" required>
                </div>
            </div>


            <div class="form-group">
                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                <div class="col-sm-10 col-md-4">
                    <select class="form-control" name="status">
                        <option value="1">{{ trans('labels.Active') }}</option>
                        <option value="0">{{ trans('labels.Inactive') }}</option>
                    </select>
                </div>
            </div>

            
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary">{{ trans('labels.submit') }}</button>
            </div>
            <!-- /.box-footer -->
            {!! Form::close() !!}
        </div>
    </div>
</div>



<!-- Edit Holiday -->
<div class="modal fade" id="editholidayModal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteModalLabel">Edit Booking Holiday</h4>
            </div>
            {!! Form::open(array('url' =>'admin/appointment/edit_holiday_action', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
            {!! Form::hidden('editholiday_id',  '', array('class'=>'form-control', 'id'=>'editholiday_id')) !!}
            <input type="hidden" name="outlet_id" value="{{ $result['outlet']->id }}"/>

            <div class="form-group">
                <label for="name" class="col-sm-2 col-md-3 control-label">Date</label>
                <div class="col-sm-10 col-md-4">
                    <input class="form-control datepicker" type="text"  name="date" id="date" value="" required>
                </div>
            </div>


            <div class="form-group">
                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                <div class="col-sm-10 col-md-4">
                    <select class="form-control" name="status">
                        <option value="1">{{ trans('labels.Active') }}</option>
                        <option value="0">{{ trans('labels.Inactive') }}</option>
                    </select>
                </div>
            </div>

            
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary">{{ trans('labels.submit') }}</button>
            </div>
            <!-- /.box-footer -->
            {!! Form::close() !!}
        </div>
    </div>
</div>