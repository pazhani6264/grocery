@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>{{ trans('labels.Loyalty Report') }} <small>{{ trans('labels.Loyalty Report') }}...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">{{ trans('labels.Loyalty Report') }}</li>
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
                        <div class="box-header">
                            <div class="col-lg-6 form-inline">
                                <form  name='registration' id="registration" class="registration" method="get" action="{{url('admin/loyaltyreportfilter')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="FilterBy" id="FilterBy" >
                                            <option value="" selected disabled hidden>{{trans('labels.Filter By')}}</option>
                                            <option value="Name"  @if(isset($name)) @if  ($name == "Name") {{ 'selected' }} @endif @endif>{{trans('labels.Title')}}</option>
                                            <!-- <option value="Main"  @if(isset($name)) @if  ($name == "Main") {{ 'selected' }} @endif @endif>Main Category</option> -->
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="{{trans('labels.Search')}}..." id="parameter"  @if(isset($param)) value="{{$param}}" @endif >
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        @if(isset($param,$name))  <a class="btn btn-danger " href="{{url('admin/loyaltyreport')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
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
                                            <th>{{ trans('labels.ID') }}</th>
                                            <th>{{ trans('labels.Title') }}</th>
                                            <th>{{ trans('labels.Descriptions') }}</th>
                                            <th>{{ trans('labels.redeem_type') }} </th>
                                            <th>{{ trans('labels.point') }}</th>
                                            <th>{{ trans('labels.amount') }}</th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($earn_points)>0)
                                            @php $earn_unique = $earn_points->unique('id'); @endphp
                                            @foreach ($earn_points as $key=>$earn)
                                            <tr>
                                                <td>@if($earn->id == -1) 0 @else {{ $earn->id }} @endif</td>
                                                <td>{{ $earn->name }}</td>
                                                <td>{{ $earn->description }}</td>
                                                 <td>{{ str_replace('_', ' ', $earn->discount_type) }} </td>
                                                <td>{{ $earn->points }}</td>
                                                <td>
                                                     @if($earn->discount_type=='fixed_cart')
                                                      @if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif {{ $earn->no_rm }} @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif
                                                    @else
                                                            {{ $earn->no_rm }}%
                                                    @endif
                                                    
                                                </td>
                                                <td>
                                                    <a data-toggle="tooltip" data-placement="bottom" title="View" href="{{url('admin/loyaltyreportuser/'. $earn->id) }}" class="badge bg-light-blue"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                        </td>
                                            </tr>
                                             @endforeach
                                              @else
                                            <tr>
                                                <td colspan="7">{{ trans('labels.NoRecordFound') }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    @if($earn_points != null)
                                      <div class="col-xs-12 text-right">
                                          {{$earn_points->links()}}
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
