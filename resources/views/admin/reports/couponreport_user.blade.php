@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>{{ trans('labels.Coupon Usage Report') }} <small>{{ trans('labels.Coupon Usage Report') }}...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li><a href="{{ URL::to('admin/couponreport')}}"><i class="fa fa-database"></i>{{ trans('labels.Coupon Report') }}</a></li>
      <li class="active">{{ trans('labels.Coupon Usage Report') }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <!-- Main content -->
         <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                       

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
                                            <th>{{ trans('labels.CustomerName') }}</th>
                                            <th>{{ trans('labels.Amount') }}</th>
                                            <th>{{ trans('labels.Date') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($user)>0)
                                            @foreach ($user as $key=>$jesuser)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $jesuser->first_name }} {{ $jesuser->last_name }} </td>
                                                <td>{{ $jesuser->coupon_amount }} </td>
                                                <td>{{ $jesuser->date_purchased }} </td>
                                            </tr>
                                             @endforeach
                                              @else
                                            <tr>
                                                <td colspan="7">{{ trans('labels.NoRecordFound') }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    @if($user != null)
                                      <div class="col-xs-12 text-right">
                                          {{$user->links()}}
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

           

            <!-- Main row -->

            <!-- /.row -->
        </section>
  <!-- /.content -->
</div>
@endsection
