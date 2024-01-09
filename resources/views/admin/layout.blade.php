<!DOCTYPE html>
<html>

<!-- meta contains meta taga, css and fontawesome icons etc -->
@include('admin.common.meta')
<!-- ./end of meta -->

<body class=" hold-transition skin-blue sidebar-mini">
<!-- wrapper -->
<div class="wrapper">

    <div class="se-pre-con" id="loader" style="/* display: none; */">
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

    <!-- header contains top navbar -->
@include('admin.common.header')
<!-- ./end of header -->

    <!-- left sidebar -->
@include('admin.common.sidebar')
<!-- ./end of left sidebar -->

    <!-- dynamic content -->
@yield('content')
<!-- ./end of dynamic content -->


<div class="modal fade" id="myModal_molla" tabindex="-1" role="dialog" aria-hidden="true">
      
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-body">
              <!-- <div id="loadermodal2" class="lds-dual-ring2 hidden overlay2"></div> -->

                  <div class="container" id="products-detail2">

                  </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
          </div>
        </div>
      </div>
      

    <!-- right sidebar -->
@include('admin.common.controlsidebar')
<!-- ./right sidebar -->
    @include('admin.common.footer')
</div>
<!-- ./wrapper -->

<!-- The actual snackbar -->
<div id="snackbar">{{ trans('labels.Cache Cleared Successfully') }}</div>

<!-- all js scripts including custom js -->
@include('admin.common.scripts')
<!-- ./end of js scripts -->

</body>
</html>
