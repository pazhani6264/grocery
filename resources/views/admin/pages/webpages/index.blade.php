@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.Pages') }} <small>{{ trans('labels.ListingAllPages') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">{{ trans('labels.Pages') }} </li>
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
                            <div class="box-tools pull-right" style="position:unset;">
                                <a href="{{ URL::to('admin/addwebpage') }}" type="button" class="btn btn-block btn-success">Normal Editor</a>
                               
                            </div>
                            <div class="box-tools pull-right" style="position:unset;padding-right:15px;">
                            <a href="{{ URL::to('admin/addwebpagebuild') }}" type="button" class="btn btn-block btn-primary">Page Builder Editor</a>
                            </div>
                            <div class="box-tools pull-right" style="position:unset;padding-right:15px;">
                            <a href="{{ URL::to('admin/zippageadd') }}" type="button" class="btn btn-block btn-warning">Zip Page Editor</a>
                            </div>
                            <br>
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


                                            <th>@sortablelink('page_id', trans('labels.ID') )</th>
                                            <th>@sortablelink('Name', trans('labels.Name') )</th>
                                            <th>@sortablelink('slug', trans('labels.Slug') )</th>
                                            <th>{{ trans('labels.Status') }}</th>
                                            <th>Editor</th>
                                            <th>{{ trans('labels.Action') }}</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($result["pages"])>0)
                                            @foreach ($result["pages"] as  $key=>$data)

                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>
                                                        {{ $data->name }}
                                                    </td>
                                                    <td>
                                                        {{ $data->slug }}
                                                    </td>
                                                    <td>
                                                
                                                        @if($data->status==0)
                                                            <span class="label label-warning">
										{{ trans('labels.InActive') }}
									</span>
                                                        @else
                                                            <a href="{{ URL::to("admin/pageStatus")}}?id={{ $data->page_id}}&active=no" class="method-status">
                                                                {{ trans('labels.InActive') }}
                                                            </a>
                                                        @endif
                                                        &nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;
                                                        @if($data->status==1)
                                                            <span class="label label-success">
										{{ trans('labels.Active') }}
									</span>
                                                        @else
                                                            <a href="{{ URL::to("admin/pageStatus")}}?id={{ $data->page_id}}&active=yes" class="method-status">
                                                                {{ trans('labels.Active') }}
                                                            </a>
                                                        @endif
                                                      

                                                    </td>
                                                   <!--  <td>
                                                        <label class=" control-label">
                                                        <input type="radio" name="cancal{{ $data->page_id }}" value="1" class="form-check-input set_cancel" status_id="{{$data->page_build_status}}" @if($data->page_build_status == '1') checked @endif > &nbsp;{{ trans('labels.Yes') }}
                                                        </label>
                                                        <label class=" control-label">
                                                        <input type="radio" name="cancal{{ $data->page_id }}" value="0" class="form-check-input set_cancel" status_id="{{$data->page_build_status}}" @if($data->page_build_status == '0') checked @endif > &nbsp;{{ trans('labels.No') }}
                                                        </label>
                                                    </td> -->

                                                    <td>@if($data->page_build_status==0)
                                                            Normal
                                                        @else
                                                            Page Builder
                                                        @endif
                                                    </td>
                                                    <td>
                                                    @if($data->page_build_status==0)
                                                        <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Edit') }}" href="editwebpage/{{ $data->page_id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                    @else
                                                        <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Edit') }}" href="editwebpagebuilder/{{ $data->page_id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        @endif
                                                        @if($data->page_id !=5 && $data->page_id !=6 &&$data->page_id !=7 &&
                                                        $data->page_id !=8)
                                                        <a id="deletePageId" data-toggle="tooltip" data-placement="bottom" title="Delete" page_id="{{$data->page_id}}" href="#" class="badge bg-red " ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach


<?php $zippage = DB::table('zippages')->get(); 
$pagecount =  count($result["pages"]);  ?>



@if(count($zippage)>0)
    @foreach ($zippage as  $key=>$zip)
    <?php $pagecount ++; ?>

<tr>
    <td>{{ $pagecount }}</td>
    <td>{{ $zip->name }}</td>
    <td>{{ $zip->link }}</td>
    <td>  @if($zip->status==0)
    <span class="label label-warning">
	{{ trans('labels.InActive') }}
	</span>
    @else
        <a href="{{ URL::to("admin/zippageStatus")}}?id={{ $zip->id}}&active=no" class="method-status">
            {{ trans('labels.InActive') }}
        </a>
    @endif
    &nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;
    @if($zip->status==1)
        <span class="label label-success">
        {{ trans('labels.Active') }}
    </span>
    @else
        <a href="{{ URL::to("admin/zippageStatus")}}?id={{ $zip->id}}&active=yes" class="method-status">
            {{ trans('labels.Active') }}
        </a>
    @endif
</td>
    <td>Zip Page Editor</td>
    <td>
        <a data-toggle="tooltip" data-placement="bottom" title="Download" href="{{ asset($zip->zip_download) }}" class="badge bg-light-green"><i class="fa fa-download" aria-hidden="true"></i></a>
        <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Edit') }}" href="zippageedit/{{ $zip->id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
        <a id="deleteZipPageId" data-toggle="tooltip" data-placement="bottom" title="Delete" zippage_id="{{$zip->id}}" href="#" class="badge bg-red " ><i class="fa fa-trash" aria-hidden="true"></i></a>
    </td>
</tr>
@endforeach

@endif







                                            
                                        @else
                                            <tr>
                                                <td colspan="6">{{ trans('labels.NoRecordFound') }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    <div class="col-xs-12 text-right">


                                        {!! $result["pages"]->appends(\Request::except('page'))->render() !!}
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

            <!-- deletePageModal -->
            <div class="modal fade" id="deletePageModal" tabindex="-1" role="dialog" aria-labelledby="deletePageModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deletePageModalLabel">{{ trans('labels.DeletePage') }}</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/deletepage', 'name'=>'deletePage', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'id')) !!}
                        <div class="modal-body">
                            <p>{{ trans('labels.DeletePageDilogue') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deletePage">{{ trans('labels.Delete') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- /.row -->



            <!-- deletePageModal -->
            <div class="modal fade" id="deletezipPageModal" tabindex="-1" role="dialog" aria-labelledby="deletezipPageModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deletezipPageModalLabel">{{ trans('labels.DeletePage') }}</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/deletezippage', 'name'=>'deletezipPage', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'zipid')) !!}
                        <div class="modal-body">
                            <p>{{ trans('labels.DeletePageDilogue') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deletePage">{{ trans('labels.Delete') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
