@extends('admin.layout')
@section('content')
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{ trans('labels.addadmins') }} <small>{{ trans('labels.addadmins') }}...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li><a href="{{ URL::to('admin/admins')}}"><i class="fa fa-users"></i> {{ trans('labels.admins') }}</a></li>
      <li class="active">{{ trans('labels.addadmins') }}</li>
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
            <h3 class="box-title">{{ trans('labels.addadmins') }} </h3>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
              		<div class="box box-info">
                        <br>                       
                       	
                        @if(session()->has('message'))
                            <div class="alert alert-success" role="alert">
						  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        
                        @if(session()->has('errorMessage'))
                            <div class="alert alert-danger" role="alert">
						  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ session()->get('errorMessage') }}
                            </div>
                        @endif
                        
                        <!-- form start -->                        
                         <div class="box-body">
                            {!! Form::open(array('url' =>'admin/addnewadmin', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}
                            <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.AdminType') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                    <select class="form-control field-validate" name="adminType" id="adminType">
                                    @foreach($result['adminTypes'] as $adminType)
                                          <option value="{{$adminType->user_types_id}}">{{$adminType->user_types_name}}</option>
                                    @endforeach
									</select>
                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                  {{ trans('labels.AdminTypeText') }}</span>
                                  </div>
                            </div>
                            <hr>
                            <h4>{{ trans('labels.Personal Info') }} </h4>
                            <hr> 
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FirstName') }}  <span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('first_name',  '', array('class'=>'form-control field-validate', 'id'=>'first_name')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.FirstNameText') }}</span>
                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.LastName') }}  <span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('last_name',  '', array('class'=>'form-control field-validate', 'id'=>'last_name')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.lastNameText') }}</span>
                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div> 
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Telephone') }} <span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('phone',  '', array('class'=>'form-control phone-validate', 'id'=>'phone')) !!}
                                   <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                   {{ trans('labels.TelephoneText') }}</span>
                                  </div>
                                </div>
                                 <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">Outlet</label>
                                  <div class="col-sm-10 col-md-4">
                                    <select class="form-control" name="outlet_id">
                                        <option value="">Select Outlet</option>
                                        @foreach($result['outlet'] as $outlet_data)
                                        <option value="{{ $outlet_data->id }}">{{ $outlet_data->name }}</option>
                                      @endforeach
                                    </select>
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter your outlet.</span>
                                  </div>
                                </div>

                                <div class="form-group" id="imageselected">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Profile</label>
                                            <div class="col-sm-10 col-md-4">
                                                {{--{!! Form::file('newImage', array('id'=>'newImage')) !!}--}}
                                                <!-- Modal -->
                                                <div class="modal fade" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <h3 class="modal-title text-primary" id="myModalLabel">{{ trans('labels.Choose Image') }} </h3>
                                                            </div>
                                                            <div class="modal-body manufacturer-image-embed">
                                                                @if(isset($allimage))
                                                                <select class="image-picker show-html" name="image_id" id="select_img">
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
                                                               <button type="button" class="btn btn-primary" id="selected" data-dismiss="modal">{{ trans('labels.Done') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="imageselected">
                                                    {!! Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary ", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )) !!}
                                                    <br>
                                                    <div id="selectedthumbnail" class="selectedthumbnail col-md-5"> </div>
                                                    <div class="closimage">
                                                        <button type="button" class="close pull-left image-close " id="image-close"
                                                          style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Upload profile image.</span>
                                            </div>
                                        </div>
                            <hr>
                            <h4>{{ trans('labels.AddressInfo') }}</h4>
                            <hr>
                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.StreetAddress') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('address',  '', array('class'=>'form-control', 'id'=>'address')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.StreetAddressText') }}</span>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Zip/Postal Code') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('zip',  '', array('class'=>'form-control', 'id'=>'zip')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.Zip/Postal Code Text') }}</span>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.City') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('city',  '', array('class'=>'form-control', 'id'=>'city')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.CityText') }}</span>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Country') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                    <select class="form-control select2" name="country" id="entry_country_id">
                                        <option value="">{{ trans('labels.SelectCountry') }}</option>
                                        @foreach($result['countries'] as $countries_data)
                                        <option value="{{ $countries_data->countries_id }}">{{ $countries_data->countries_name }}</option>
                                   		@endforeach
                                    </select>
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.CountryText') }}</span>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.State') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                   <select class="form-control zoneContent select2" name="state" id="entry_zone_id">		
                                      <option value="">{{ trans('labels.SelectState') }}</option>									 
                                   </select>
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.StateText') }}</span>
                                  </div>
                                </div>
                                
                                
                                <div id="posdiv">
                                <hr>
                                <h4>POS Info</h4>
                                <hr>
                                 <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">Tax ID<span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('taxid',  '', array('class'=>'form-control ', 'id'=>'taxid')) !!}
                                     <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                     Please enter tax id.</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">POS ID<span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('posid',  '', array('class'=>'form-control ', 'id'=>'posid')) !!}
                                     <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                     Please enter pos id.</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">Branch Name<span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('branch',  '', array('class'=>'form-control ', 'id'=>'branch')) !!}
                                     <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                     Please enter branch name.</span>
                                  </div>
                                </div>

                                 <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">POS Number<span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('posno',  '', array('class'=>'form-control ', 'id'=>'posno')) !!}
                                     <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                     Please enter pos number.</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">Opening Time<span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('opening',  '', array('class'=>'form-control ', 'id'=>'opening')) !!}
                                     <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                     Please enter opening time.</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">Closeing Time<span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('closeing',  '', array('class'=>'form-control ', 'id'=>'closeing')) !!}
                                     <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                     Please enter closeing time.</span>
                                  </div>
                                </div>

                                 <div class="form-group">
                                          <label class="col-sm-2 col-md-3 control-label" style="">Allow Notification<span style="color:red;">*</span></label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                    <input type="radio" name="notification" value="1" class="flat-red" checked> &nbsp;{{ trans('labels.Enabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                    <input type="radio" name="notification" value="0" class="flat-red">  &nbsp;{{ trans('labels.Disabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                    </div>

                                   <div class="form-group">
                                          <label class="col-sm-2 col-md-3 control-label" style="">Access Control<span style="color:red;">*</span></label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                    <input type="radio" name="access_control" value="1" class="flat-red" checked> &nbsp;Full
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                    <input type="radio" name="access_control" value="0" class="flat-red">  &nbsp;Half
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                    </div>

                                </div>

                                <hr>
                                <h4>{{ trans('labels.Login Info') }}</h4>
                                <hr>
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.EmailAddress') }}  <span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::text('email',  '', array('class'=>'form-control email-validate', 'id'=>'email')) !!}
                                     <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                     {{ trans('labels.EmailText') }}</span>
                                    <span class="help-block hidden"> {{ trans('labels.EmailError') }}</span>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Password') }} <span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    {!! Form::password('password', array('class'=>'form-control field-validate', 'id'=>'password')) !!}
                	                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                   {{ trans('labels.PasswordText') }}</span>
                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                                  <div class="col-sm-10 col-md-4">
                                    <select class="form-control" name="isActive">
                                          <option value="1">{{ trans('labels.Active') }}</option>
                                          <option value="0">{{ trans('labels.Inactive') }}</option>
									</select>
                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                  {{ trans('labels.StatusText') }}</span>
                                  </div>
                                </div>
                                
                              <!-- /.box-body -->
                              <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                <a href="{{ URL::to('admin/admins')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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