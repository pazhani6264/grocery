@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{ trans('labels.manageroles') }} <small>{{ trans('labels.manageroles') }}...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">{{ trans('labels.manageroles') }}</li>
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
            <h3 class="box-title">{{ trans('labels.manageroles') }} </h3>
            <!-- <div class="box-tools pull-right">
            	<a href="{{ URL::to('admin/addadmintype')}}" type="button" class="btn btn-block btn-primary">{{ trans('labels.addadmintype') }}</a>
            </div> -->
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
                      <th>{{ trans('labels.ID') }}</th>
                      <th>Name</th>
                      <th>{{ trans('labels.Date') }}</th>
                      <th>{{ trans('labels.Status') }}</th>
                      <th>{{ trans('labels.Manage Role') }}</th>
                     <!--  <th>{{ trans('labels.Action') }}</th> -->
                    </tr>
                  </thead>
                  <tbody>
                   @if (count($result['cashier']) > 0)
                   @foreach ($result['cashier']  as $key=>$jescashier)
        							<tr>
        								<td>{{ $key+1 }}</td>
        								<td>{{ $jescashier->first_name }} {{ $jescashier->last_name }}</td>
        								<td><strong>{{ trans('labels.AddedDate')}}: </strong>{{ date('Y-m-d', strtotime(str_replace('-','/', $jescashier->created_at))) }}<br>
                        <strong>{{ trans('labels.ModifiedDate')}}: </strong>@if(!empty($jescashier->updated_at)){{ date('Y-m-d', strtotime(str_replace('-','/', $jescashier->updated_at))) }}@else --- @endif
                        </td>
                        <td>
                          @if($jescashier->status==1)
                            <strong class="badge bg-green">{{trans('labels.Active')}} </strong>
                          @else
                            <strong class="badge bg-light-grey">{{trans('labels.InActive')}} </strong>
                          @endif
                        </td>
                        <td>
                          <a href="cashierroleupdate/{{ $jescashier->id }}" class="manage-role-popup" user_types_id = "{{ $jescashier->id }}"> {{ trans('labels.Manage Role')}}</span>
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
			<h4 class="modal-title" id="deleteCustomerModalLabel">{{ trans('labels.AdminType') }}</h4>
		  </div>
		  {!! Form::open(array('url' =>'admin/deleteadmintype', 'name'=>'deleteadmintype', 'id'=>'deleteadmintype', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
				  {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
				  {!! Form::hidden('user_types_id',  '', array('class'=>'form-control', 'id'=>'user_types_id')) !!}
		  <div class="modal-body">
			  <p>{{ trans('labels.Are you sure you want to delete this admin type') }}</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
			<button type="submit" class="btn btn-primary">{{ trans('labels.Delete') }}</button>
		  </div>
		  {!! Form::close() !!}
		</div>
	  </div>
	</div>

    <div class="modal fade" id="manageRoleModal" tabindex="-1" role="dialog" aria-labelledby="manageRoleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content" id="manage-role-content">

		</div>
	  </div>
	</div>

    <!-- Main row -->

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
@endsection
