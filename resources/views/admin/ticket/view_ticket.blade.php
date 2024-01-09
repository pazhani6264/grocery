@extends('admin.layout')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.tickets') }} <small>{{ trans('labels.ListingAllticket') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">{{ trans('labels.tickets') }}</li>
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
                            <div style="margin-right:38px;"class="box-tools pull-left">
                            <a href="{{ URL::to('admin/ticket/view/close')}}" type="button" class="btn btn-block btn-danger">Closed Tickets</a>

                        </div> 
                        <div style="margin-right:164px;"class="box-tools pull-left">
                            <a href="{{ URL::to('admin/ticket/view/answer')}}" type="button" class="btn btn-block btn-success" >Answered Tickets</a>

                        </div>
                        <div style="margin-right:309px;"class="box-tools pull-left">
                            <a href="{{ URL::to('admin/ticket/view/open')}}" type="button" class="btn btn-block btn-info" >Opened Tickets</a>

                        </div>
                            
                        </div><br>

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
                                            <th>{{ trans('labels.ID') }} </th>
                                            <th>{{ trans('labels.newuser_subject') }}</th>
                                            <th>{{ trans('labels.date_time') }}</th>
                                            <th>{{ trans('labels.Status') }}</th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @if(count($open_tickets)>0)
                                           @foreach($open_tickets as $open_ticket)
                                            <tr>
                                                <td>{{$open_ticket->id}}</td>
                                                <td>{{$open_ticket->subject}}</td>
                                                <td>{{$open_ticket->created_at}}</td>
                                                <td>
                                                    @if($open_ticket->status == 1)
                                                <span class="badge badge-pill badge-primary">{{ __('Opened')}}</span>
                                                @elseif($open_ticket->status == 2)
                                                <span class="badge badge-pill badge-success">{{ __('Answered')}}</span>
                                                @elseif($open_ticket->status == 3)
                                                <span class="badge badge-pill badge-danger">{{ __('Closed')}}</span>
                                                @endif
                                                </td>
                                                <td>
                                                    <a href="{{url('admin/ticket/view_ticket/'. $open_ticket->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
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
                                     @if($open_tickets != null)
                                      <div class="col-xs-12 text-right">
                                          {{$open_tickets->links()}}
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



            <div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteNewsModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteNewsModalLabel">{{ trans('labels.DeleteMember') }}</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/ticket/delete_product', 'name'=>'deleteNews', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'id')) !!}
                        <div class="modal-body">
                            <p>{{ trans('labels.Deleteticket_products') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deleteNews">{{ trans('labels.Delete') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
