<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Panel | </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="Themescoder" content="">
      
      <link rel="stylesheet" type="text/css" href="{{ asset('admin/keditor/plugins/bootstrap-3.4.1/css/bootstrap.min.css') }}" data-type="keditor-style" />
      <link rel="stylesheet" type="text/css" href="{!! asset('admin/keditor/plugins/font-awesome-4.7.0/css/font-awesome.min.css') !!}" data-type="keditor-style" />
      <!-- Start of KEditor styles -->
      <link rel="stylesheet" type="text/css" href="{!! asset('admin/keditor/css/keditor.css') !!}" data-type="keditor-style" />
      <link rel="stylesheet" type="text/css" href="{!! asset('admin/keditor/css/keditor-components.css') !!}" data-type="keditor-style" />
      <!-- End of KEditor styles -->
      <link rel="stylesheet" type="text/css" href="{!! asset('admin/keditor/plugins/code-prettify/src/prettify.css') !!}" />
      <link rel="stylesheet" type="text/css" href="{!! asset('admin/keditor/css/examples.css') !!}" />

    </head>
    
    <body>

   <!--  <div class="col-sm-12" data-type="container-content">
                            <div class="form-group">
							  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.PageSlug') }}</label>
							  <div class="col-sm-10 col-md-4">
								{!! Form::text('slug',  '', array('class'=>'form-control field-validate', 'id'=>'slug')) !!}
								<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.pageSlugWithDashesText') }}</span>
							  </div>
							 </div>

                            </div> -->
        <div data-keditor="html" id="whole-content">
        

            <div id="content-area">

            <?php 
          
             $pages = DB::table('pages_description')
                ->where([
                    ['pages_description.language_id','=',1],
                    ['pages_description.page_id','=',$page_id]
                    ])
                ->first();
           echo $pages->description;

            ?>
       
            </div>
        </div>
        
        <script type="text/javascript" src="{!! asset('../admin/keditor/plugins/jquery-1.11.3/jquery-1.11.3.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('admin/keditor/plugins/bootstrap-3.4.1/js/bootstrap.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('admin/keditor/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('admin/keditor/plugins/ckeditor-4.11.4/ckeditor.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('admin/keditor/plugins/formBuilder-2.5.3/form-builder.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('admin/keditor/plugins/formBuilder-2.5.3/form-render.min.js') !!}"></script>
        <!-- Start of KEditor scripts -->
        <script src="{!! asset('admin/keditor/js/keditor.js') !!}"></script>
        <script src="{!! asset('admin/keditor/js/keditor-components.js') !!}"></script>
        <!-- End of KEditor scripts -->
        <script type="text/javascript" src="{!! asset('admin/keditor/plugins/code-prettify/src/prettify.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('admin/keditor/plugins/js-beautify-1.7.5/js/lib/beautify.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('admin/keditor/plugins/js-beautify-1.7.5/js/lib/beautify-html.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('admin/keditor/js/examples.js') !!}"></script>
        <script type="text/javascript" data-keditor="script">
            $(function () {
                $('#content-area').keditor();
            });
        </script>

<script type="text/javascript">
  
 
     function addnew()
    {
        var allcontent =  $('#content-area').keditor('getContent');
        var page_id = <?php echo $page_id; ?>;
        jQuery.ajax({
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        url: '{{ URL::to("admin/addcontentpagebuilder")}}',
        type: "POST",
        data: '&allcontent='+encodeURIComponent(allcontent)+'&page_id='+page_id,
        success:function(response){
           window.location.href= '{{ URL::to("admin/webpages")}}';
           },
           error:function(error){
              console.log(error)
           }
        });
    } 
  </script> 
    </body>
</html>
