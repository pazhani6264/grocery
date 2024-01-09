@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.Email') }} <small>{{ trans('labels.emailsetting') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">{{ trans('labels.emailsetting') }}</li>
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
                            <h3 class="box-title">{{ trans('labels.emailsetting') }} </h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <!--<div class="box-header with-border">
                                          <h3 class="box-title">Setting</h3>
                                        </div>-->
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            @if( count($errors) > 0)
                                                @foreach($errors->all() as $error)
                                                    <div class="alert alert-success" role="alert">
                                                        <span class="icon fa fa-check" aria-hidden="true"></span>
                                                        <span class="sr-only">{{ trans('labels.Setting') }}Error:</span>
                                                        {{ $error }}
                                                    </div>
                                                @endforeach
                                            @endif
                                            
                                            {!! Form::open(array('url' =>'admin/email/addemail', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data','id'=>'signup-form')) !!}
                                            <br>                                      
                                                                            
                                           
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Email id <span>*</span></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="emailid" id="emailid" class="form-control" required>
                                                </div>
                                            </div>
                                           
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Password <span>*</span> </label>
                                                <div class="col-sm-10 col-md-4">
                                                <input type="password" name="password" id="password_reg" class="form-control" required>
                                                    <span class="glyphicon form-control-feedback" id="password_reg1"></span>
                                                </div>
                                            </div>


                                        </div>

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }} </button>
                                            <a href="{{ URL::to('admin/email/display')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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

            <!-- /.row -->
            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/jquery.validate.min.js"></script>
<script type="text/javascript">
    var value = $("#password_reg").val();

$.validator.addMethod("checklower", function(value) {
  return /[a-z]/.test(value);
});
$.validator.addMethod("checkupper", function(value) {
  return /[A-Z]/.test(value);
});
$.validator.addMethod("checkdigit", function(value) {
  return /[0-9]/.test(value);
});
$.validator.addMethod("pwcheck", function(value) {
  return /[;:_\-!@\"\]\[]/.test(value);
});

$('#signup-form').validate({
  rules: {
    password: {
      minlength: 8,
      maxlength: 30,
      required: true,
      pwcheck: true,
      checklower: true,
      checkupper: true,
      checkdigit: true
    },
  },
  messages: {
    password: {
      pwcheck: "Need atleast 1 special characters",
      checklower: "Need atleast 1 lowercase alphabet",
      checkupper: "Need atleast 1 uppercase alphabet",
      checkdigit: "Need atleast 1 digit"
    }
  },
  highlight: function(element) {
    var id_attr = "#" + $(element).attr("id") + "1";
    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    $(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');
    $('.form-group').css('margin-bottom', '5px');
    $('.form').css('padding', '30px 40px');
    $('.tab-group').css('margin', '0 0 25px 0');
    $('.help-block').css('display', '');
  },
  unhighlight: function(element) {
    var id_attr = "#" + $(element).attr("id") + "1";
    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
    $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');
    $('#confirmPassword').attr('disabled', false);
  },
  errorElement: 'span',
  errorClass: 'validate_cus',
  errorPlacement: function(error, element) {
    x = element.length;
    if (element.length) {
      error.insertAfter(element);
    } else {
      error.insertAfter(element);
    }
  }

});
</script>
@endsection
