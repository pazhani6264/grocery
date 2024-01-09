@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{ trans('labels.admins') }} <small>{{ trans('labels.admins') }}...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">{{ trans('labels.admins') }}</li>
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
            <h3 class="box-title">{{ trans('labels.admins') }} </h3>
            <div class="box-tools pull-right" style="right: 120px;">
            	<a href="javascript:;" data-toggle="modal" data-target="#myModal" type="button" class="btn btn-block btn-primary">Add Segment</a>
            </div>
             <div class="box-tools pull-right">
              <a href="{{ URL::to('admin/addadmins')}}" type="button" class="btn btn-block btn-primary">{{ trans('labels.addadmins') }}</a>
            </div>
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">

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
                      <th>{{ trans('labels.Full Name') }}</th>
                      <th>{{ trans('labels.Email') }}</th>
                      <th>{{ trans('labels.AdminType') }}</th>
                      <th>{{ trans('labels.Status') }}</th>
                      <th>{{ trans('labels.Action') }}</th>                      
                    </tr>
                  </thead>
                  <tbody>
                   @if (count($result['admins']) > 0)
						@foreach ($result['admins']  as $key=>$admin)
							<tr>
								<td>{{ $admin->id }}</td>
							
                <td>
                  {{ $admin->first_name }} {{ $admin->last_name }} 
                </td>
                <td>
                   {{ $admin->email }} 
                </td>
							               

              </td>
                                <td>
                                @if($admin->user_types_id==1)
                                	<strong class="badge bg-green">
                                @else
                                	<strong class="badge bg-light-blue">
                                @endif
                                  @if($admin->user_name=='segment')
                                	  {{$admin->user_types_name}} / Segment</strong>
                                  @else
                                    {{$admin->user_types_name}}</strong>
                                  @endif
                                </td>
                                <td>
                                  @if($admin->status==1)
                                    <strong class="badge bg-green">{{trans('labels.Active')}} </strong>
                               	  @else
                                	<strong class="badge bg-light-grey">{{trans('labels.InActive')}} </strong>
                                  @endif

                                </td>
								<td>
                                <ul class="nav table-nav">
                              <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                  {{ trans('labels.Action') }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    @if($admin->user_name=='segment')
                                    <li role="presentation"><a role="menuitem"  tabindex="-1" href="editsegment/{{ $admin->id }}">{{ trans('labels.editadmin') }}</a></li>
                                    @else
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="editadmin/{{ $admin->id }}">{{ trans('labels.editadmin') }}</a></li>
                                    @endif
                                    <li role="presentation" class="divider"></li>
                                     @if($admin->user_name=='segment')
                                     <li role="presentation"><a onclick="loadModalSegment({{$admin->id}})" href="javascript:;">View</a></li>
                                     @endif
                                    <li role="presentation"><a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Delete') }}" id="deleteCustomerFrom" users_id="{{ $admin->id }}">{{ trans('labels.Delete') }}</a></li>
                                </ul>
                              </li>
                            </ul>
								</td>
							</tr>
						@endforeach
                    @else
                    	<tr>
							<td colspan="5">{{ trans('labels.NoRecordFound') }}</td>
						</tr>
                    @endif
                  </tbody>
                </table>
                @if (count($result['admins']) > 0)
					<div class="col-xs-12 text-right">
						{{$result['admins']->links()}}
					</div>
                 @endif
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

    <!-- deleteCustomerModal -->
	<div class="modal fade" id="deleteCustomerModal" tabindex="-1" role="dialog" aria-labelledby="deleteCustomerModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="deleteCustomerModalLabel">{{ trans('labels.deleteAdmin') }}</h4>
		  </div>
		  {!! Form::open(array('url' =>'admin/deleteadmin', 'name'=>'deleteAdmin', 'id'=>'deleteAdmin', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
				  {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
				  {!! Form::hidden('users_id',  '', array('class'=>'form-control', 'id'=>'users_id')) !!}
		  <div class="modal-body">
			  <p>{{ trans('labels.Are you sure you want to delete this admin') }}</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
			<button type="submit" class="btn btn-primary">{{ trans('labels.Delete') }}</button>
		  </div>
		  {!! Form::close() !!}
		</div>
	  </div>
	</div>

    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content notificationContent">

		</div>
	  </div>
	</div>


  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Cashier Segment</h4>
        </div>
        <div class="modal-body">
        <div class="row">
        <div class="col-md-12">
          {!! Form::open(array('url' =>'admin/addnewsegment', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}
          <div class="form-group">
              <label for="name" class="col-sm-2 col-md-3 control-label">Segment Name<span style="color:red;">*</span></label>
                  <div class="col-sm-10 col-md-6">
                    {!! Form::text('segment_name',  '', array('class'=>'form-control field-validate', 'id'=>'segment_name')) !!}
                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.FirstNameText') }}</span>
                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                  </div>
            </div>

            <div class="form-group">
                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.EmailAddress') }}  <span style="color:red;">*</span></label>
                <div class="col-sm-10 col-md-6">
                    {!! Form::text('email',  '', array('class'=>'form-control email-validate', 'id'=>'email')) !!}
                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                    {{ trans('labels.EmailText') }}</span>
                    <span class="help-block hidden"> {{ trans('labels.EmailError') }}</span>
              </div>
          </div>

           <div class="form-group">
                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Password') }} <span style="color:red;">*</span></label>
                  <div class="col-sm-10 col-md-6">
                      {!! Form::password('password', array('class'=>'form-control field-validate', 'id'=>'password')) !!}
                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                      {{ trans('labels.PasswordText') }}</span>
                      <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                    </div>
           </div>

           <div class="form-group">
                <label for="name" class="col-sm-2 col-md-3 control-label">Cashier<span style="color:red;">*</span></label>
                  <div class="col-sm-10 col-md-6">
                    <select name="cashier_id[]"class="form-control ccode_output field-validate" multiple="multiple" multiple multiselect-search="true" >
                        @if (count($result['cash']) > 0)
                          @foreach ($result['cash']  as $key=>$jescash)
                            @php
                              $exist = DB::table('cashier_segment')->where('cashier_id', '=', $jescash->id)->get();
                            @endphp
                            @if(count($exist)==0)
                              <option value="{{ $jescash->id }}">{{ $jescash->first_name }} {{ $jescash->last_name }} </option>
                            @endif
                          @endforeach
                        @endif
                  </select> 
                  </div>
           </div>

        </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default">{{ trans('labels.Submit') }}</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          {!! Form::close() !!}
        </div>
      </div>
      
    </div>
  </div>



    <!-- Main row -->

     <div class="modal fade" id="mySegmentView" tabindex="-1" role="dialog" aria-labelledby="deleteLanguagesModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteLanguagesModalLabel">View Cashier Segment</h4>
                        </div>
                        <div class="modal-body">
                             <div id="myEventSegment"></div> 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                        </div>
                    </div>
                </div>
            </div>

           

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<script src="{!! asset('admin/js/multiselect.js') !!}"></script>

@endsection
