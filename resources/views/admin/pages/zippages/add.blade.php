@extends('admin.layout')
@section('content')



    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.AddPage') }} <small>{{ trans('labels.AddPage') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/webpages')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.ListingAllPages') }}</a></li>
                <li class="active">{{ trans('labels.AddPage') }}</li>
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
                            <h3 class="box-title">{{ trans('labels.AddPage') }} </h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            @if( count($errors) > 0)
                                                @foreach($errors->all() as $error)
                                                    <div class="alert alert-success" role="alert">
                                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                        <span class="sr-only">{{ trans('labels.Error') }}:</span>
                                                        {{ $error }}
                                                    </div>
                                                @endforeach
                                            @endif

                                            @if(Session::has('warnerror'))

                    <div class="alert alert-danger" role="alert">
                          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                          <span class="sr-only">@lang('website.Error'):</span>
                          {{ session()->get('warnerror') }}
                      </div>

                    @endif
                    <div id="error-zippage"></div>
             
        <div class="se-pre-con hidden" id="loader-zippage" style="/* display: none; */">
        <div class="pre-loader">
          <div class="la-line-scale">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>
          <p>@lang('labels.Loading')..</p>
        </div>
     
      </div>

  

                                        
                                            {!! Form::open(array('method'=>'post', 'id' => 'zipFormSubmit', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

                                            <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.PageName') }}<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" id="name"  name="name" class="form-control field-validate form-clear">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.PageName') }}</span>
                                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Zip File<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="file" name="zippage" id="zippage" accept="zip" class="form-control field-validate form-clear">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">upload only zip file</span>
                                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                    </div>
                                                </div>

                                                
                                           
                                          <!--   <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="1">{{ trans('labels.Active') }}</option>
                                                        <option value="0">{{ trans('labels.InActive') }}</option>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.StatusPageText') }}</span>
                                                </div>
                                            </div> -->

                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                                <a href="{{ URL::to('admin/webpages')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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
  
  <script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script> 

   <script>
$(document).ready(function(){

 $('#zipFormSubmit').on('submit', function(event){

    var checkname =  $('#name').val();
    var content='';
   if(checkname !='')
   {
 
    $("#loader-zippage").removeClass("hidden");
  
    
  event.preventDefault();
  $.ajax({
    url: '{{ URL::to("admin/insertzippage")}}',
   method:"POST",
   data:new FormData(this),
   dataType:'text',
   contentType: false,
   cache: false,
   processData: false,
 
   success: function (res) { 
    if(res=='already'){
        content +='<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <span class="sr-only"></span> Given Name already exists </div>';
      
    }else if(res=='notallowed'){
        content +='<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <span class="sr-only"></span> only zip file is allowed </div>';
    }
    else if(res=='failed'){
        content +='<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <span class="sr-only"></span> Unzipped Process failed </div>';
       
    }
    else if(res=='success'){
        content +='<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <span class="sr-only"></span> File Uploaded Successfully </div>';
        $('.form-clear').val('');    
    }else{
       
    } 
    $('#loader-zippage').addClass('hidden');             
    $('#error-zippage').html(content);             
            
},

  }) 
}
else
{
    /* content +='<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <span class="sr-only"></span> Required All Field </div>';
    $('#error-zippage').html(content);   */           
}
 });

});
</script> 


  
   
@endsection
