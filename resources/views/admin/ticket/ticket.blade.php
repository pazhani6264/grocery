


@extends('admin.layout')
@section('content')



    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-7 col-md-7 align-self-center">
                    <h1 style="font-size: 20px;font-weight: 600;padding:0 10px;"> {{__('Ticket No.#')}}{{$data->id}} <small></small> </h1>
                    <ol class="breadcrumb" style="padding: 8px 10px 8px 10px;">
                        <li ><a class="text-muted" href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard text-muted"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                        <li class="active text-muted">{{__('Tickets')}}</li>
                        <li class="active text-muted">{{__('Ticket No.#')}}{{$data->id}}</li>
                    </ol>
                </div>
                <div class="col-5 col-md-5">
                    <span class="pull-right">
                      <form action="{{ URL::to('admin/ticket/update')}}" method="POST"> 
                            @csrf
                            @if($data->status == 1 or $data->status == 2)
                                <input type="hidden" name="ticket_id" value="{{$data->id}}">
                                <button type="submit" class="btn btn-primary btn-sm close_ticket_btn">{{__('Close Ticket')}}</a>
                            @elseif($data->status == 3)
                                <input type="hidden" name="ticketId" value="{{$data->id}}">
                                <button type="submit" class="btn btn-success btn-sm close_ticket_btn">{{__('Re-open Ticket')}}</a>
                            @endif
                        </form>
                    </span>
                </div>
            </div>
        </section>

        <!-- Main content -->
         <section class="content">
            <!-- Info boxes -->

            @if(session('success'))
<div class="note note-success">
<span class="icon"><i class="fa fa-check"></i></span>
{{session('success')}}
</div>
@endif

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="padding:0;">
                       
                        <!-- /.box-header -->
                        <div class="card-body ">
                            
                        @php
                       
                $user = DB::table('users')->where('id','=', $data->user_id)->first();
                
            @endphp
            @if($user != '')
            <span class="text-muted ttv"><i class="fa fa-user"></i> {{__('Opend by :')}} {{$user->first_name.' '.$user->last_name}}</span>
            @endif
            <span class="text-muted ttv"><i class="fa fa-clock-o"></i> {{__('at :')}} {{\Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</span>
            <span class="text-muted ttv"><i class="fa fa-archive"></i> {{__('Product :')}} {{$data->product}}</span>
            <span class="text-muted pull-right"><i class="fa fa-fire"></i> {{__('Priority :')}}
                @if($data->priority == 1)
                <span class="badge badge-pill badge-secondary">{{ __('Low')}}</span>
                @elseif($data->priority == 2)
                <span class="badge badge-pill badge-warning">{{ __('high')}}</span>
                @elseif($data->priority == 3)
                <span class="badge badge-pill badge-danger">{{ __('Urgent')}}</span>
                @endif
            </span>
            <h3 class="text-dark mt-2">{{$data->subject}}</h3>
            <p>{{$data->description}}</p>
            @if(!$data->attachfile == null)
            <a data-toggle="modal" data-target=".bd-example-modal-lg" href="" target="_blank" class="btn btn-outline-primary">
            <i class="fa fa-download"></i> {{ __('File attachment')}}</a>
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="ticketModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('File attachment')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                           
                            </button>
                        </div>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="{{asset('uploads/tickets/'.$data->attachfile)}}" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            @endif

                          
                        </div>
                        <!-- /.box-body -->

                        @if($replies->count())
        <div class="replies">
            @foreach($replies as $reply)
            @php
                       
            $user1 = DB::table('users')->where('id','=', $reply->user_id)->first();
                       
                   @endphp
            <div class="auth__reply">
                <span class="reply__posted"><i class="fa fa-clock-o"></i> {{__('Replied at :')}} {{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}</span>
                <h4 class="text-dark mt-2"><i class="fa fa-user"></i> {{__('by :')}} {{$user1->first_name}} {{$user1->last_name}}</h4>
                <p class="text-dark">{{$reply->replay_body}}</p>
                @if(!$reply->replay_file == null)
                <a data-toggle="modal" data-target=".rpl{{ $reply->id }}" href="" target="_blank" class="btn btn-outline-primary">
                <i class="fa fa-download"></i> {{ __('File attachment')}}</a>
                <div class="modal fade bd-example rpl{{ $reply->id }}" tabindex="-1" role="dialog" aria-labelledby="ticketModal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ __('File attachment')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="{{asset('uploads/replies/'.$reply->replay_file)}}" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <div class="nodata text-center pt-3 pb-3">
            <span class="text-muted">{{ __('No replies yet')}}</span>
        </div>
        @endif
    </div>

    <div class="card">
        <div class="card-body">
            @if($data->status == 3)
            <div class="text-center pt-3 pb-3">
                <span class="text-muted">{{ __('This ticket is now closed you cannot add any reply')}}</span>
            </div>
            @else
           <form action="{{ URL::to('admin/ticket/store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="ticket_id" value="{{$data->id}}">
                <div class="form-group">
                    <label for="replay_body">{{__('Your Replay : ')}}<span style="color:red;">*</span></label>
                    <textarea name="replay_body" class="form-control @error('replay_body') is-invalid @enderror"" rows="6" required>{{ old('replay_body') }}</textarea>
                    @error('replay_body')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="replay_body">{{__('Your Reply (optional) : ')}}</label>
                    <input type="file" name="replay_file" class="form-control @error('replay_file') is-invalid @enderror">
                  
                    <small class="text-muted">{{ __('Only allowed (JPEG, JPG, PNG, PDF)') }}</small>
                    @error('replay_file')
                    <span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
                    @enderror
                </div>
                <button class="btn btn-primary" type="submit">{{__('Submit')}}</button>
            </form>
            @endif
        </div>
    </div>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->



           <!--  <div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteNewsModalLabel">
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
            </div> -->

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    
@endsection

<style>

.breadcrumb {
    background-color: unset !important;
}
.close_ticket_btn {
    margin-top: 65px;
    margin-right: 10px;
}
.card_outer {
    box-shadow: 0 3px 9px 0 rgb(169 184 200 / 15%) !important;
    -webkit-box-shadow: 0 3px 9px 0 rgb(169 184 200 / 15%) !important;
    -moz-box-shadow: 0 3px 9px 0 rgba(169, 184, 200, 0.15) !important;
    border-top: none !important;
}
.ttv {
    margin-right: 13px;
}
.text-muted {
    color: #9eabc0 !important;
}
.text-dark {
    color: #1c2d41 !important;
}
.card-body {
    flex: 1 1 auto;
    padding: 25px !important;
}

.nodata {
    border-top: 1px solid #eaeaea;
}

.text-center {
    text-align: center !important;
}
.pb-3, .py-3 {
    padding-bottom: 1rem !important;
    padding-top: 1rem !important;
}

.card {
    box-shadow: 0 3px 9px 0 rgb(169 184 200 / 15%);
    -webkit-box-shadow: 0 3px 9px 0 rgb(169 184 200 / 15%);
    -moz-box-shadow: 0 3px 9px 0 rgba(169, 184, 200, 0.15);
}

.card, .card-group {
    margin-bottom: 30px;
}
.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid #e9ecef;
    border-radius: 0.25rem;
}
.auth__reply:first-child {
    border-top: 1px solid #eaeaea;
}
.auth__reply {
    border-bottom: 1px solid #eaeaea;
    padding: 25px;
    background: #fff8f2;
    color: #7c8798;
}
.badge-danger {
    color: #fff !important;
    background-color: #ff4f70 !important;
}
.badge-warning {
    color: #212529 !important;
    background-color: #fdc16a !important;
}
.badge-secondary {
    color: #fff !important;
    background-color: #6c757d !important;
}
.note-success {
    background-color: #8aef9a;
    border-color: #013a0b;
    border-top: 5px solid #27b33e;
    color: #124e1c;
}

.note {
    padding: 19px;
    font-size: 15px;
    border-radius: 6px;
    margin-bottom: 1em;
}



.is-invalid~.invalid-feedback, .is-invalid~.invalid-tooltip, .was-validated :invalid~.invalid-feedback, .was-validated :invalid~.invalid-tooltip {
    display: block;
}

.invalid-feedback {
    display: none;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 80%;
    color: #dc3545;
}


.form-control.is-invalid, .was-validated .form-control:invalid {
    border-color: #dc3545;
    padding-right: calc(1.5em + 0.75rem);
    background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e);
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}


</style>











