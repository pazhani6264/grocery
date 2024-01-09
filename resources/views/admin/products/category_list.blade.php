@extends('admin.layout')
@section('content')
<script src ="https://code.jquery.com/ui/1.9.2/jquery-ui.js" defer></script>
<style>
   .box
   {
   /* width:1270px;*/
    padding:20px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:25px;
   }
   #page_list li
   {
    padding:16px;
    background-color:#f9f9f9;
    border:1px dotted #ccc;
    cursor:pointer;
    margin:10px; float:left;
    color:#000;
   }
   #page_list li.ui-state-highlight
   {
    padding:24px;
    background-color:#ffffcc;
    border:1px dotted #ccc;
    cursor:pointer;
    margin-top:12px;
   }
</style>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Category List <small>{{ trans('labels.ListingAllMainCategories') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">{{ trans('labels.MainCategories') }}</li>
            </ol>
        </section>

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

                            <h3>Category List</h3>
                            <div class="container box">  
                                <ul class="list-unstyled" id="page_list">
                                @if(count($categories)>0)
                                    @foreach ($categories as $key=>$category)
                                        <a href="{{ URL::to('admin/products/sorting') }}/{{ $category->id }}">
                                            <li data-id="{{ $category->id }}">
                                                @if($category->parent_name)
                                                    {{$category->parent_name}} /
                                                @endif
                                                {{ $category->name }}
                                            </li>  
                                        </a>
                                    @endforeach
                                @endif
                            </ul>
                            <input type="hidden" name="page_order_list" id="page_order_list" />
                            </div>
                            <a href="{{ URL::to('admin/products/display')}}" type="button" class="btn btn-primary">Back</a>
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


