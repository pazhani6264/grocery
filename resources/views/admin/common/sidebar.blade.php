<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">{{ trans('labels.navigation') }}</li>
        <li class="treeview {{ Request::is('admin/dashboard/this_month') ? 'active' : '' }}">
          <a href="{{ URL::to('admin/dashboard/this_month')}}">
            <i class="fa fa-dashboard"></i> <span>{{ trans('labels.header_dashboard') }}</span>
          </a>
        </li>

        <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->general_setting_view == 1){
      ?>
        <li class="treeview {{ Request::is('admin/managements/merge') ? 'active' : '' }} {{ Request::is('admin/managements/updater') ? 'active' : '' }} {{ Request::is('admin/managements/factory_reset') ? 'active' : '' }} {{ Request::is('admin/managements/backup') ? 'active' : '' }} {{ Request::is('admin/managements/import') ? 'active' : '' }} {{ Request::is('admin/admobSettings') ? 'active' : '' }} {{ Request::is('admin/applabel') ? 'active' : '' }} {{ Request::is('admin/applicationapi') ? 'active' : '' }} {{ Request::is('admin/setting_developer') ? 'active' : '' }}  {{ Request::is('admin/firebase_developer') ? 'active' : '' }} {{ Request::is('admin/facebooksettings') ? 'active' : '' }}  {{ Request::is('admin/googlesettings') ? 'active' : '' }} {{ Request::is('admin/email/emailsetting_developer') ? 'active' : '' }} {{ Request::is('admin/pushnotification') ? 'active' : '' }} {{ Request::is('admin/instagramsettings') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-modx"></i> <span>Developers</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview {{ Request::is('admin/email/emailsetting_developer') ? 'active' : '' }} ">
              <a href="{{url('admin/email/emailsetting_developer')}}">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> Email Settings </span>
              </a>
          </li>

          <li class="{{ Request::is('admin/pushnotification') ? 'active' : '' }}"><a href="{{ URL::to('admin/pushnotification')}}"><i class="fa fa-circle-o"></i> Push Notification</a></li>

          @if($result['commonContent']['setting']['is_deliverboy_purchased'] == '0')
            <li class="{{ Request::is('admin/managements/merge') ? 'active' : '' }}"><a href="{{ URL::to('admin/managements/merge')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_merge') }}</a></li>
          @endif
            <li class="{{ Request::is('admin/managements/updater') ? 'active' : '' }}"><a href="{{ URL::to('admin/managements/updater')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_updater') }}</a></li>

          <li class="treeview  {{ Request::is('admin/setting_developer') ? 'active' : '' }} {{ Request::is('admin/firebase_developer') ? 'active' : '' }} {{ Request::is('admin/facebooksettings') ? 'active' : '' }}  {{ Request::is('admin/googlesettings') ? 'active' : '' }} {{ Request::is('admin/instagramsettings') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
          <span> {{ trans('labels.link_general_settings') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">            
            <li class="{{ Request::is('admin/setting_developer') ? 'active' : '' }}"><a href="{{ URL::to('admin/setting_developer')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_store_setting') }}</a></li>
            <li class="{{ Request::is('admin/facebooksettings') ? 'active' : '' }}"><a href="{{ URL::to('admin/facebooksettings')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_facebook') }}</a></li>
            <li class="{{ Request::is('admin/googlesettings') ? 'active' : '' }}"><a href="{{ URL::to('admin/googlesettings')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_google') }}</a></li>
            <li class="{{ Request::is('admin/facebooksettings') ? 'active' : '' }}"><a href="{{ URL::to('admin/instagramsettings')}}"><i class="fa fa-circle-o"></i> Instagram </a></li>
            <li class="{{ Request::is('admin/firebase_developer') ? 'active' : '' }}"><a href="{{ URL::to('admin/firebase_developer')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.Firebase') }}</a></li>
         
          </ul>
        </li>

       

          <li class="treeview {{ Request::is('admin/admobSettings') ? 'active' : '' }} {{ Request::is('admin/applabel') ? 'active' : '' }} {{ Request::is('admin/applicationapi') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
            <span> {{ trans('labels.link_app_settings') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
           
            <li class="{{ Request::is('admin/admobSettings') ? 'active' : '' }}"><a href="{{ URL::to('admin/admobSettings')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_admob') }}</a></li>

            <li class="android-hide {{ Request::is('admin/applabel') ? 'active' : '' }} {{ Request::is('admin/addappkey') ? 'active' : '' }}"><a href="{{ URL::to('admin/applabel')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.labels') }}</a></li>

            <li class="{{ Request::is('admin/applicationapi') ? 'active' : '' }}"><a href="{{ URL::to('admin/applicationapi')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.applicationApi') }}</a></li>

          </ul>
        </li>


        <li class="treeview  {{ Request::is('admin/managements/factory_reset') ? 'active' : '' }} {{ Request::is('admin/managements/backup') ? 'active' : '' }} {{ Request::is('admin/managements/import') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
            <span> {{ trans('labels.Backup / Restore') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>

          <ul class="treeview-menu">
            <li class="{{ Request::is('admin/managements/updater') ? 'active' : '' }}"><a href="{{ URL::to('admin/managements/backup')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.backup') }}</a></li>
            <li class="{{ Request::is('admin/managements/updater') ? 'active' : '' }}"><a href="{{ URL::to('admin/managements/import')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.restore') }}</a></li>
           <li class="{{ Request::is('admin/managements/updater') ? 'active' : '' }}"><a href="{{ URL::to('admin/managements/factory_reset')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.factory_reset') }}</a></li>
          </ul>
        </li>

        </ul>
      </li>

      <?php } ?>


      <?php
        if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->view_media == 1){
      ?>
      <li class="treeview {{ Request::is('admin/media/add') ? 'active' : '' }} {{ Request::is('admin/media/display') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-picture-o"></i> <span>{{ trans('labels.media') }}</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview {{ Request::is('admin/media/add') ? 'active' : '' }} ">
              <a href="{{url('admin/media/add')}}">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.media') }} </span>
              </a>
          </li>

          <li class="treeview {{ Request::is('admin/media/display') ? 'active' : '' }} {{ Request::is('admin/addimages') ? 'active' : '' }} {{ Request::is('admin/uploadimage/*') ? 'active' : '' }} ">
              <a href="{{url('admin/media/display')}}">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.Media Setings') }} </span>
              </a>
          </li>
        </ul>
      </li>

      <?php } ?>

      <?php
        if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->language_view == 1){
      ?>

        <li class="treeview {{ Request::is('admin/languages/display') ? 'active' : '' }} {{ Request::is('admin/languages/add') ? 'active' : '' }} {{ Request::is('admin/languages/edit/*') ? 'active' : '' }} ">
          <a href="{{ URL::to('admin/languages/display')}}">
            <i class="fa fa-language" aria-hidden="true"></i> <span> {{ trans('labels.languages') }} </span>
          </a>
        </li>

      <?php } ?>
      <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->general_setting_view == 1){
      ?>
      <li class="treeview {{ Request::is('admin/currencies/display') ? 'active' : '' }} {{ Request::is('admin/currencies/add') ? 'active' : '' }} {{ Request::is('admin/currencies/edit/*') ? 'active' : '' }} {{ Request::is('admin/currencies/filter') ? 'active' : '' }}">
          <a href="{{ URL::to('admin/currencies/display')}}">
            <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.currency') }} </span>
          </a>
        </li>

      <?php } ?>    
      <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->customers_view == 1){
      ?>
        <li class="treeview {{ Request::is('admin/customers/display') ? 'active' : '' }}  {{ Request::is('admin/customers/add') ? 'active' : '' }}  {{ Request::is('admin/customers/edit/*') ? 'active' : '' }} {{ Request::is('admin/customers/address/display/*') ? 'active' : '' }} {{ Request::is('admin/customers/filter') ? 'active' : '' }} ">
          <a href="{{ URL::to('admin/customers/display')}}">
            <i class="fa fa-users" aria-hidden="true"></i> <span>{{ trans('labels.link_customers') }}</span>
          </a>
        </li>
      <?php }        

        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->products_view == 1 or $result['commonContent']['roles']!= null and $result['commonContent']['roles']->categories_view == 1 or $result['commonContent']['roles']->manufacturer_view == 1){
      ?>
        <li class="treeview {{ Request::is('admin/reviews/display') ? 'active' : '' }} {{ Request::is('admin/manufacturers/display') ? 'active' : '' }} {{ Request::is('admin/manufacturers/add') ? 'active' : '' }} {{ Request::is('admin/manufacturers/edit/*') ? 'active' : '' }} {{ Request::is('admin/units') ? 'active' : '' }} {{ Request::is('admin/editunit/*') ? 'active' : '' }} {{ Request::is('admin/products/display') ? 'active' : '' }} {{ Request::is('admin/products/add') ? 'active' : '' }} {{ Request::is('admin/products/edit/*') ? 'active' : '' }} {{ Request::is('admin/editattributes/*') ? 'active' : '' }} {{ Request::is('admin/products/attributes/display') ? 'active' : '' }}  {{ Request::is('admin/products/attributes/add') ? 'active' : '' }} {{ Request::is('admin/products/attributes/add/*') ? 'active' : '' }} {{ Request::is('admin/addinventory/*') ? 'active' : '' }} {{ Request::is('admin/addproductimages/*') ? 'active' : '' }} {{ Request::is('admin/categories/display') ? 'active' : '' }} {{ Request::is('admin/categories/add') ? 'active' : '' }} {{ Request::is('admin/categories/edit/*') ? 'active' : '' }} {{ Request::is('admin/categories/filter') ? 'active' : '' }} {{ Request::is('admin/products/inventory/display') ? 'active' : '' }} {{ Request::is('admin/products/images/display/*') ? 'active' : '' }} {{ Request::is('admin/products/images/add/*') ? 'active' : '' }} {{ Request::is('admin/products/videos/display/*') ? 'active' : '' }} {{ Request::is('admin/products/videos/add/*') ? 'active' : '' }} {{ Request::is('admin/inventory/stockmovement') ? 'active' : '' }} {{ Request::is('admin/inventory/stockinview') ? 'active' : '' }} {{ Request::is('admin/inventory/stockin') ? 'active' : '' }} {{ Request::is('admin/inventory/stockoutview') ? 'active' : '' }} {{ Request::is('admin/inventory/stockout') ? 'active' : '' }} {{ Request::is('admin/manufacturers/filter') ? 'active' : '' }} {{ Request::is('admin/inventory/adjuststock') ? 'active' : '' }} {{ Request::is('admin/inventory/addadjuststock') ? 'active' : '' }} {{ Request::is('admin/inventory/vendor') ? 'active' : '' }} {{ Request::is('admin/inventory/addvendor') ? 'active' : '' }} {{ Request::is('admin/inventory/editvendor/*') ? 'active' : '' }} {{ Request::is('admin/reviews/filter') ? 'active' : '' }} {{ Request::is('admin/categories/sorting') ? 'active' : '' }} {{ Request::is('admin/categories/subcategory/sorting/*') ? 'active' : '' }} {{ Request::is('admin/products/category_list') ? 'active' : '' }} {{ Request::is('admin/products/sorting/*') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-database"></i> <span>{{ trans('labels.Catalog') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            @if ($result['commonContent']['roles']!= null and $result['commonContent']['roles']->manufacturer_view == 1)
              <li class="{{ Request::is('admin/manufacturers/display') ? 'active' : '' }} {{ Request::is('admin/manufacturers/add') ? 'active' : '' }} {{ Request::is('admin/manufacturers/filter') ? 'active' : '' }} {{ Request::is('admin/manufacturers/edit/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/manufacturers/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_brand') }}</a></li>
            @endif
			@if($result['commonContent']['setting']['Inventory'] == '1' && $result['commonContent']['setting']['inventory_type'] == '1')
            @if ($result['commonContent']['roles']!= null and $result['commonContent']['roles']->vendor_view == 1)
               <li class="{{ Request::is('admin/inventory/vendor') ? 'active' : '' }} {{ Request::is('admin/inventory/addvendor') ? 'active' : '' }} {{ Request::is('admin/inventory/editvendor/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/inventory/vendor')}}"><i class="fa fa-circle-o"></i>Vendor</a></li>
            @endif
            @endif
            @if ($result['commonContent']['roles']!= null and $result['commonContent']['roles']->categories_view == 1)
              <li class="{{ Request::is('admin/categories/display') ? 'active' : '' }} {{ Request::is('admin/categories/add') ? 'active' : '' }} {{ Request::is('admin/categories/edit/*') ? 'active' : '' }} {{ Request::is('admin/categories/filter') ? 'active' : '' }}  {{ Request::is('admin/categories/sorting') ? 'active' : '' }} {{ Request::is('admin/categories/subcategory/sorting/*') ? 'active' : '' }} "><a href="{{ URL::to('admin/categories/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_main_categories') }}</a></li>
            @endif

            @if ($result['commonContent']['roles']!= null and $result['commonContent']['roles']->products_view == 1)
              <li class="{{ Request::is('admin/products/attributes/display') ? 'active' : '' }}  {{ Request::is('admin/products/attributes/add') ? 'active' : '' }}  {{ Request::is('admin/products/attributes/*') ? 'active' : '' }}" ><a href="{{ URL::to('admin/products/attributes/display' )}}"><i class="fa fa-circle-o"></i> {{ trans('labels.products_attributes') }}</a></li> 
             <!--  <li class="{{ Request::is('admin/units') ? 'active' : '' }} {{ Request::is('admin/addunit') ? 'active' : '' }} {{ Request::is('admin/editunit/*') ? 'active' : '' }} "><a href="{{ URL::to('admin/units')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_units') }}</a></li> -->
              <li class="{{ Request::is('admin/products/display') ? 'active' : '' }} {{ Request::is('admin/products/add') ? 'active' : '' }} {{ Request::is('admin/products/edit/*') ? 'active' : '' }} {{ Request::is('admin/products/attributes/add/*') ? 'active' : '' }} {{ Request::is('admin/addinventory/*') ? 'active' : '' }} {{ Request::is('admin/addproductimages/*') ? 'active' : '' }} {{ Request::is('admin/products/images/display/*') ? 'active' : '' }} {{ Request::is('admin/products/images/add/*') ? 'active' : '' }} {{ Request::is('admin/products/videos/display/*') ? 'active' : '' }} {{ Request::is('admin/products/videos/add/*') ? 'active' : '' }} {{ Request::is('admin/products/category_list') ? 'active' : '' }}  {{ Request::is('admin/products/sorting/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/products/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_all_products') }}</a></li>
              @if($result['commonContent']['setting']['Inventory'] == '1' && $result['commonContent']['setting']['inventory_type'] == '0')
                <li class="{{ Request::is('admin/products/inventory/display') ? 'active' : '' }}"><a href="{{ URL::to('admin/products/inventory/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.inventory') }}</a></li>
              @endif
			   @if($result['commonContent']['setting']['Inventory'] == '1' && $result['commonContent']['setting']['inventory_type'] == '1')
              <li class="treeview {{ Request::is('admin/inventory/stockmovement') ? 'active' : '' }} {{ Request::is('admin/inventory/stockinview') ? 'active' : '' }} {{ Request::is('admin/inventory/stockin') ? 'active' : '' }} {{ Request::is('admin/inventory/stockoutview') ? 'active' : '' }} {{ Request::is('admin/inventory/stockout') ? 'active' : '' }} {{ Request::is('admin/inventory/adjuststock') ? 'active' : '' }} {{ Request::is('admin/inventory/addadjuststock') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-circle-o" aria-hidden="true"></i>
            <span> New Inventory </span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu"> 
            @if ($result['commonContent']['roles']!= null and $result['commonContent']['roles']->stock_movement_view == 1)           
            <li class="{{ Request::is('admin/inventory/stockmovement') ? 'active' : '' }}"><a href="{{ URL::to('admin/inventory/stockmovement')}}"><i class="fa fa-circle-o"></i>Stock Movement</a></li>
            @endif
            @if ($result['commonContent']['roles']!= null and $result['commonContent']['roles']->stockin_view == 1) 
            <li class="{{ Request::is('admin/inventory/stockinview') ? 'active' : '' }} {{ Request::is('admin/inventory/stockin') ? 'active' : '' }} "><a href="{{ URL::to('admin/inventory/stockinview')}}"><i class="fa fa-circle-o"></i>Stock-in</a></li>
            @endif
            @if ($result['commonContent']['roles']!= null and $result['commonContent']['roles']->stockout_view == 1)
            <li class="{{ Request::is('admin/inventory/stockoutview') ? 'active' : '' }} {{ Request::is('admin/inventory/stockout') ? 'active' : '' }}"><a href="{{ URL::to('admin/inventory/stockoutview')}}"><i class="fa fa-circle-o"></i>Stock-out</a></li>
            @endif
            @if ($result['commonContent']['roles']!= null and $result['commonContent']['roles']->adjuststock_view == 1)
            <li class="{{ Request::is('admin/inventory/adjuststock') ? 'active' : '' }} {{ Request::is('admin/inventory/addadjuststock') ? 'active' : '' }}"><a href="{{ URL::to('admin/inventory/adjuststock')}}"><i class="fa fa-circle-o"></i>Adjust Stock </a></li>
            @endif
            @if ($result['commonContent']['roles']!= null and $result['commonContent']['roles']->checkctock_view == 1)
            <li class="{{ Request::is('admin/firebase_developer') ? 'active' : '' }}"><a href="#"><i class="fa fa-circle-o"></i>Check Stock</a></li>
            @endif
          </ul>
        </li>
              @endif
            @endif
            <?php
              $status_check = DB::table('reviews')->where('reviews_read',0)->first();
              if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->reviews_view == 1){
            ?>
              <li class="{{ Request::is('admin/reviews/display') ? 'active' : '' }} {{ Request::is('admin/reviews/filter') ? 'active' : '' }}">
                <a href="{{ URL::to('admin/reviews/display')}}">
                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span>{{ trans('labels.reviews') }}</span>@if($result['commonContent']['new_reviews']>0)<span class="label label-success pull-right">{{$result['commonContent']['new_reviews']}} {{ trans('labels.new') }}</span>@endif
                </a>
              </li>
            <?php } ?>
          </ul>
        </li>
      <?php } ?>

      <?php 
            if($result['commonContent']['setting']['appointment'] == '1'){
      if( $result['commonContent']['roles'] != null && ($result['commonContent']['roles']->appointment_view == 1 || $result['commonContent']['roles']->appointment_setting_view == 1 || $result['commonContent']['roles']->outlet_view == 1 || $result['commonContent']['roles']->appstatus_view == 1)){ ?>

      <li class="treeview {{ Request::is('admin/appointment/appointment') ? 'active' : '' }} {{ Request::is('admin/appointment/appointment_setting') ? 'active' : '' }} {{ Request::is('admin/appointment/outlet') ? 'active' : '' }} {{ Request::is('admin/appointment/appointment_status') ? 'active' : '' }} {{ Request::is('admin/appointment/appointment_detail/*') ? 'active' : '' }} {{ Request::is('admin/appointment/addappointmentsetting') ? 'active' : '' }} {{ Request::is('admin/appointment/editappointmentsetting/*') ? 'active' : '' }} {{ Request::is('admin/appointment/add_outlet') ? 'active' : '' }}  {{ Request::is('admin/appointment/edit_outlet/*') ? 'active' : '' }}  {{ Request::is('admin/appointment/view_slot/*') ? 'active' : '' }} {{ Request::is('admin/appointment/add_slot/*') ? 'active' : '' }} {{ Request::is('admin/appointment/edit_slot/*') ? 'active' : '' }} {{ Request::is('admin/appointment/add_appointment_status') ? 'active' : '' }} {{ Request::is('admin/appointment/edit_appointment_status/*') ? 'active' : '' }}{{ Request::is('admin/appointment/appointment_filter') ? 'active' : '' }} {{ Request::is('admin/appointment/appointment_setting_filter') ? 'active' : '' }} {{ Request::is('admin/appointment/outlet_filter') ? 'active' : '' }} {{ Request::is('admin/appointment/appointment_services') ? 'active' : '' }} {{ Request::is('admin/appointment/add_appointment_services') ? 'active' : '' }} {{ Request::is('admin/appointment/edit_appointment_services/*') ? 'active' : '' }} {{ Request::is('admin/appointment/filter_appointment_services') ? 'active' : '' }} {{ Request::is('admin/appointment/appointment_staffs') ? 'active' : '' }} {{ Request::is('admin/appointment/add_appointment_staffs') ? 'active' : '' }} {{ Request::is('admin/appointment/edit_appointment_staffs/*') ? 'active' : '' }} {{ Request::is('admin/appointment/filter_appointment_staffs') ? 'active' : '' }} ">
          <a href="#">
            <i class="fa fa-rocket" aria-hidden="true"></i>
            <span> Appointments</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          
          <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->appointment_view == 1){ ?>

            <li class="{{ Request::is('admin/appointment/appointment') ? 'active' : '' }} {{ Request::is('admin/appointment/appointment_detail/*') ? 'active' : '' }} {{ Request::is('admin/appointment/appointment_filter') ? 'active' : '' }}"><a href="{{ URL::to('admin/appointment/appointment')}}"><i class="fa fa-circle-o"></i> Appointments</a></li>

          <?php } ?>
          <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->appointment_setting_view == 1){ ?>

            <li class="{{ Request::is('admin/appointment/appointment_setting') ? 'active' : '' }} {{ Request::is('admin/appointment/addappointmentsetting') ? 'active' : '' }} {{ Request::is('admin/appointment/editappointmentsetting/*') ? 'active' : '' }} {{ Request::is('admin/appointment/appointment_setting_filter') ? 'active' : '' }}"><a href="{{ URL::to('admin/appointment/appointment_setting')}}"><i class="fa fa-circle-o"></i> Appointments Settings</a></li>

          <?php } ?>
          <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->outlet_view == 1){ ?>

            <li class="{{ Request::is('admin/appointment/outlet') ? 'active' : '' }} {{ Request::is('admin/appointment/add_outlet') ? 'active' : '' }}  {{ Request::is('admin/appointment/edit_outlet/*') ? 'active' : '' }}  {{ Request::is('admin/appointment/view_slot/*') ? 'active' : '' }} {{ Request::is('admin/appointment/add_slot/*') ? 'active' : '' }} {{ Request::is('admin/appointment/edit_slot/*') ? 'active' : '' }} {{ Request::is('admin/appointment/outlet_filter') ? 'active' : '' }}"><a href="{{ URL::to('admin/appointment/outlet')}}"><i class="fa fa-circle-o"></i> Outlet</a></li>

          <?php } ?>
          <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->appstatus_view == 1){ ?>

            <li class="{{ Request::is('admin/appointment/appointment_status') ? 'active' : '' }} {{ Request::is('admin/appointment/add_appointment_status') ? 'active' : '' }} {{ Request::is('admin/appointment/edit_appointment_status/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/appointment/appointment_status')}}"><i class="fa fa-circle-o"></i> Appointment Status</a></li>

          <?php } ?>

          <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->appstatus_view == 1){ ?>

            <li class="{{ Request::is('admin/appointment/appointment_services') ? 'active' : '' }} {{ Request::is('admin/appointment/add_appointment_services') ? 'active' : '' }} {{ Request::is('admin/appointment/edit_appointment_services/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/appointment/appointment_services')}}"><i class="fa fa-circle-o"></i> Appointment Services</a></li>

          <?php } ?>

          <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->appstatus_view == 1){ ?>

            <li class="{{ Request::is('admin/appointment/appointment_staffs') ? 'active' : '' }} {{ Request::is('admin/appointment/add_appointment_staffs') ? 'active' : '' }} {{ Request::is('admin/appointment/edit_appointment_staffs/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/appointment/appointment_staffs')}}"><i class="fa fa-circle-o"></i> Appointment Staffs</a></li>

          <?php } ?>
          </ul>
          </li>
          <?php } }?>

      <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->orders_view == 1){
      ?>
        <li class="treeview {{ Request::is('admin/orderstatus') ? 'active' : '' }} {{ Request::is('admin/addorderstatus') ? 'active' : '' }} {{ Request::is('admin/editorderstatus/*') ? 'active' : '' }} {{ Request::is('admin/orders/display') ? 'active' : '' }}  {{ Request::is('admin/orders/vieworder/*') ? 'active' : '' }} {{ Request::is('admin/orders/filter') ? 'active' : '' }}">
          <a href="#" ><i class="fa fa-list-ul" aria-hidden="true"></i> <span> {{ trans('labels.link_orders') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          <li class="{{ Request::is('admin/orderstatus') ? 'active' : '' }} {{ Request::is('admin/addorderstatus') ? 'active' : '' }} {{ Request::is('admin/editorderstatus/*') ? 'active' : '' }} "><a href="{{ URL::to('admin/orderstatus')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_order_status') }}</a></li>
            <li class="{{ Request::is('admin/orders/display') ? 'active' : '' }} {{ Request::is('admin/orders/vieworder/*') ? 'active' : '' }} {{ Request::is('admin/orders/filter') ? 'active' : '' }}">
              <a href="{{ URL::to('admin/orders/display')}}" >
                <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.link_orders') }}</span>
              </a>
            </li>
          </ul>
        </li>
      <?php } ?>
      <?php
        if($result['commonContent']['setting']['wallet'] == '1'){
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->wallet_view == 1){
      ?>
         <li class="treeview {{ Request::is('admin/wallet/walletreport') ? 'active' : '' }} {{ Request::is('admin/wallet/banktransfer') ? 'active' : '' }}">
          <a href="#" ><i class="fa fa-google-wallet" aria-hidden="true"></i> <span>Wallet</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
             <li class="{{ Request::is('admin/wallet/walletreport') ? 'active' : '' }} "><a href="{{ URL::to('admin/wallet/walletreport')}}"><i class="fa fa-circle-o"></i>{{ trans('labels.link_orders') }}</a></li>
             <li class="{{ Request::is('admin/wallet/banktransfer') ? 'active' : '' }} "><a href="{{ URL::to('admin/wallet/banktransfer')}}"><i class="fa fa-circle-o"></i>Verify Bank Transfer </a></li>
          </ul>
        </li>
      <?php } } ?>
      <?php
        if($result['commonContent']['setting']['table_menu'] == '1'){
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->table_view == 1){
      ?>
          <li class="treeview {{ Request::is('admin/table/view') ? 'active' : '' }} {{ Request::is('admin/table/add') ? 'active' : '' }} {{ Request::is('admin/table/edit/*') ? 'active' : '' }} {{ Request::is('admin/table/filter') ? 'active' : '' }}">
          <a href="#" ><i class="fa fa-table" aria-hidden="true"></i> <span>Table Menu</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
             <li class="{{ Request::is('admin/table/view') ? 'active' : '' }} {{ Request::is('admin/table/add') ? 'active' : '' }} {{ Request::is('admin/table/edit/*') ? 'active' : '' }} {{ Request::is('admin/table/filter') ? 'active' : '' }}"><a href="{{ URL::to('admin/table/view')}}"><i class="fa fa-circle-o"></i>Table</a></li>
          </ul>
        </li>
      <?php } } ?>
      <?php
            if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->reports_view == 1){
          ?>
        <li class="treeview {{ Request::is('admin/maxstock') ? 'active' : '' }} {{ Request::is('admin/minstock') ? 'active' : '' }} {{ Request::is('admin/inventoryreport') ? 'active' : '' }} {{ Request::is('admin/salesreport') ? 'active' : '' }} {{ Request::is('admin/couponreport') ? 'active' : '' }} {{ Request::is('admin/customers-orders-report') ? 'active' : '' }} {{ Request::is('admin/outofstock') ? 'active' : '' }} {{ Request::is('admin/statsproductspurchased') ? 'active' : '' }} {{ Request::is('admin/statsproductsliked') ? 'active' : '' }} {{ Request::is('admin/lowinstock') ? 'active' : '' }} {{ Request::is('admin/loyaltyreport') ? 'active' : '' }} {{ Request::is('admin/loyaltyreportuser/*') ? 'active' : '' }} {{ Request::is('admin/customers-wallet-report') ? 'active' : '' }} {{ Request::is('admin/appointment/appointment_report') ? 'active' : '' }} {{ Request::is('admin/couponreportuser/*') ? 'active' : '' }} {{ Request::is('admin/loyaltyreportuser/*') ? 'active' : '' }} {{ Request::is('admin/profit_loss') ? 'active' : '' }} {{ Request::is('admin/couponreportfilter') ? 'active' : '' }} {{ Request::is('admin/loyaltyreportfilter') ? 'active' : '' }} {{ Request::is('admin/productsalesreport') ? 'active' : '' }} {{ Request::is('admin/sales_person_report') ? 'active' : '' }} {{ Request::is('admin/salescancelreport') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
  <span>{{ trans('labels.link_reports') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <!-- <li class="{{ Request::is('admin/lowinstock') ? 'active' : '' }} "><a href="{{ URL::to('admin/lowinstock')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_products_low_stock') }}</a></li> -->
            @if($result['commonContent']['setting']['Inventory'] == '1')
            <li class="{{ Request::is('admin/outofstock') ? 'active' : '' }} "><a href="{{ URL::to('admin/outofstock')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_out_of_stock_products') }}</a></li>
            <li class="{{ Request::is('admin/inventoryreport') ? 'active' : '' }} "><a href="{{ URL::to('admin/inventoryreport')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.Inventory Report') }}</a></li>
             <li class="{{ Request::is('admin/minstock') ? 'active' : '' }} "><a href="{{ URL::to('admin/minstock')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.Min Stock Report') }}</a></li>
            <li class="{{ Request::is('admin/maxstock') ? 'active' : '' }} "><a href="{{ URL::to('admin/maxstock')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.Max Stock Report') }}</a></li> 
            @endif
            <li class="{{ Request::is('admin/customers-orders-report') ? 'active' : '' }} "><a href="{{ URL::to('admin/customers-orders-report')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_customer_orders_total') }}</a></li>

            @if($result['commonContent']['setting']['wallet'] == '1')
            <li class="{{ Request::is('admin/customers-wallet-report') ? 'active' : '' }} "><a href="{{ URL::to('admin/customers-wallet-report')}}"><i class="fa fa-circle-o"></i>Customers Wallet Report</a></li>
             @endif
            
            <!-- <li class="{{ Request::is('admin/statsproductsliked') ? 'active' : '' }}"><a href="{{ URL::to('admin/statsproductsliked')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_products_liked') }}</a></li> -->

            @if($result['commonContent']['setting']['Loyalty'] == '1')
            <li class="{{ Request::is('admin/couponreport') ? 'active' : '' }} {{ Request::is('admin/couponreportuser/*') ? 'active' : '' }} {{ Request::is('admin/couponreportfilter') ? 'active' : '' }}"><a href="{{ URL::to('admin/couponreport')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.Coupon Report') }}</a></li>

             <li class="{{ Request::is('admin/loyaltyreport') ? 'active' : '' }} {{ Request::is('admin/loyaltyreportuser/*') ? 'active' : '' }} {{ Request::is('admin/loyaltyreportfilter') ? 'active' : '' }}"><a href="{{ URL::to('admin/loyaltyreport')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.Loyalty Report') }}</a></li>
            @endif
            <li class="{{ Request::is('admin/salesreport') ? 'active' : '' }}"><a href="{{ URL::to('admin/salesreport')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.Sales Report') }}</a></li>

            <li class="{{ Request::is('admin/salescancelreport') ? 'active' : '' }}"><a href="{{ URL::to('admin/salescancelreport')}}"><i class="fa fa-circle-o"></i>Cancel Report (Sales)</a></li>

			  <li class="{{ Request::is('admin/productsalesreport') ? 'active' : '' }}"><a href="{{ URL::to('admin/productsalesreport')}}"><i class="fa fa-circle-o"></i>Product Sales Report</a></li>

        <?php if($result['commonContent']['setting']['appointment'] == '1'){?>
            <li class="{{ Request::is('admin/appointment/appointment_report') ? 'active' : '' }} "><a href="{{ URL::to('admin/appointment/appointment_report')}}"><i class="fa fa-circle-o"></i> Appointment Report</a></li>
        <?php } ?>
             <li class="{{ Request::is('admin/profit_loss') ? 'active' : '' }} "><a href="{{ URL::to('admin/profit_loss')}}"><i class="fa fa-circle-o"></i> Profit Loss Report</a></li>

        <?php if($result['commonContent']['setting']['salesperson_commission'] == '1'){?>
             <li class="{{ Request::is('admin/sales_person_report') ? 'active' : '' }}"><a href="{{ URL::to('admin/sales_person_report')}}"><i class="fa fa-circle-o"></i>Sales Person Report</a></li>
         <?php } ?>    
          </ul>
        </li>
      <?php } ?>
     
  
      
      <?php
          if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->tax_location_view == 1){
        ?>
          <li class="treeview {{ Request::is('admin/countries/display') ? 'active' : '' }} {{ Request::is('admin/countries/add') ? 'active' : '' }} {{ Request::is('admin/countries/edit/*') ? 'active' : '' }} {{ Request::is('admin/zones/display') ? 'active' : '' }} {{ Request::is('admin/zones/add') ? 'active' : '' }} {{ Request::is('admin/zones/edit/*') ? 'active' : '' }} {{ Request::is('admin/tax/taxclass/display') ? 'active' : '' }} {{ Request::is('admin/tax/taxclass/add') ? 'active' : '' }} {{ Request::is('admin/tax/taxclass/edit/*') ? 'active' : '' }} {{ Request::is('admin/tax/taxrates/display') ? 'active' : '' }} {{ Request::is('admin/tax/taxrates/add') ? 'active' : '' }} {{ Request::is('admin/tax/taxrates/edit/*') ? 'active' : '' }} {{ Request::is('admin/countries/filter') ? 'active' : '' }} {{ Request::is('admin/zones/filter') ? 'active' : '' }} {{ Request::is('admin/tax/taxclass/filter') ? 'active' : '' }} {{ Request::is('admin/tax/taxrates/filter') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-money" aria-hidden="true"></i>
              <span>{{ trans('labels.link_tax_location') }}</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('admin/countries/display') ? 'active' : '' }} {{ Request::is('admin/countries/add') ? 'active' : '' }} {{ Request::is('admin/countries/edit/*') ? 'active' : '' }} {{ Request::is('admin/countries/filter') ? 'active' : '' }} "><a href="{{ URL::to('admin/countries/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_countries') }}</a></li>
              <li class="{{ Request::is('admin/zones/display') ? 'active' : '' }} {{ Request::is('admin/zones/add') ? 'active' : '' }} {{ Request::is('admin/zones/edit/*') ? 'active' : '' }} {{ Request::is('admin/zones/filter') ? 'active' : '' }}"><a href="{{ URL::to('admin/zones/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_zones') }}</a></li>
              <li class="{{ Request::is('admin/tax/taxclass/display') ? 'active' : '' }} {{ Request::is('admin/tax/taxclass/add') ? 'active' : '' }} {{ Request::is('admin/tax/taxclass/edit/*') ? 'active' : '' }} {{ Request::is('admin/tax/taxclass/filter') ? 'active' : '' }} "><a href="{{ URL::to('admin/tax/taxclass/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_tax_class') }}</a></li>
              <li class="{{ Request::is('admin/tax/taxrates/display') ? 'active' : '' }} {{ Request::is('admin/tax/taxrates/add') ? 'active' : '' }} {{ Request::is('admin/tax/taxrates/edit/*') ? 'active' : '' }} {{ Request::is('admin/tax/taxrates/filter') ? 'active' : '' }}"><a href="{{ URL::to('admin/tax/taxrates/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_tax_rates') }}</a></li>
              </ul>
          </li>
        <?php } ?>
       <!-- <?php
          if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->coupons_view ==1){
        ?>
        <li class="treeview {{ Request::is('admin/coupons/display') ? 'active' : '' }} {{ Request::is('admin/editcoupons/*') ? 'active' : '' }}">
          <a href="{{ URL::to('admin/coupons/display')}}" ><i class="fa fa-tablet" aria-hidden="true"></i> <span>{{ trans('labels.link_coupons') }}</span></a>
        </li>
      <?php } ?> -->

      <?php
        if( $result['commonContent']['roles'] != null and ($result['commonContent']['roles']->view_loyalty == 1 || $result['commonContent']['roles']->coupons_view == 1)){
      ?>
       @if($result['commonContent']['setting']['Loyalty'] == '1')
      <li class="treeview {{ Request::is('admin/loyalty/earn_points_view') ? 'active' : '' }} {{ Request::is('admin/loyalty/add_earn_points') ? 'active' : '' }} {{ Request::is('admin/loyalty/edit_earn_points/*') ? 'active' : '' }} {{ Request::is('admin/loyalty/redeem_points_view') ? 'active' : '' }} {{ Request::is('admin/loyalty/redeem_earn_points') ? 'active' : '' }} {{ Request::is('admin/loyalty/edit_redeem_points/*') ? 'active' : '' }} {{ Request::is('admin/coupons/display') ? 'active' : '' }} {{ Request::is('admin/editcoupons/*') ? 'active' : '' }} {{ Request::is('admin/coupons/add') ? 'active' : '' }} {{ Request::is('admin/loyalty/view_member_type') ? 'active' : '' }} {{ Request::is('admin/loyalty/add_member_type') ? 'active' : '' }} {{ Request::is('admin/loyalty/edit_member_type/*') ? 'active' : '' }} {{ Request::is('admin/coupons/edit/*') ? 'active' : '' }} {{ Request::is('admin/loyalty/filter') ? 'active' : '' }} {{ Request::is('admin/coupons/filter') ? 'active' : '' }} {{ Request::is('admin/loyalty/redeem_filter') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-gift"></i> <span>{{ trans('labels.loyalty') }}</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview {{ Request::is('admin/loyalty/earn_points_view') ? 'active' : '' }} {{ Request::is('admin/loyalty/edit_earn_points/*') ? 'active' : '' }} {{ Request::is('admin/loyalty/filter') ? 'active' : '' }}">
              <a href="{{url('admin/loyalty/earn_points_view')}}">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.loyalty_point_set') }} </span>
              </a>
          </li>
          <?php
        if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->coupons_view == 1){
      ?>
         
           <li class="treeview {{ Request::is('admin/coupons/display') ? 'active' : '' }} {{ Request::is('admin/editcoupons/*') ? 'active' : '' }} {{ Request::is('admin/coupons/add') ? 'active' : '' }} {{ Request::is('admin/coupons/edit/*') ? 'active' : '' }} {{ Request::is('admin/coupons/filter') ? 'active' : '' }}">
              <a href="{{ URL::to('admin/coupons/display')}}">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.promo_code') }} </span>
              </a>
          </li>

          <?php } ?>

          <?php
        if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->view_loyalty == 1){
      ?>
         
          <li class="treeview {{ Request::is('admin/loyalty/redeem_points_view') ? 'active' : '' }} {{ Request::is('admin/loyalty/redeem_earn_points') ? 'active' : '' }} {{ Request::is('admin/loyalty/edit_redeem_points/*') ? 'active' : '' }} {{ Request::is('admin/loyalty/redeem_filter') ? 'active' : '' }}">
              <a href="{{url('admin/loyalty/redeem_points_view')}}">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.loyalty_redeem_set') }} </span>
              </a>
          </li>

          <?php } ?>
           @if($result['commonContent']['setting']['Membertype'] == '1')
          <li class="treeview {{ Request::is('admin/loyalty/view_member_type') ? 'active' : '' }}">
              <a href="{{url('admin/loyalty/view_member_type')}}">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.member_type') }} </span>
              </a>
          </li>
          @endif
        </ul>
      </li>
      @endif
      
      <?php } ?>

      <?php
        if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->collections_view == 1){
      ?>
      <li class="treeview {{ Request::is('admin/collection/view') ? 'active' : '' }} {{ Request::is('admin/collection/add') ? 'active' : '' }} {{ Request::is('admin/collection/edit/*') ? 'active' : '' }} {{ Request::is('admin/collection/filter') ? 'active' : '' }} {{ Request::is('admin/collection/product') ? 'active' : '' }} {{ Request::is('admin/collection/view_product/*') ? 'active' : '' }} {{ Request::is('admin/collection/product_edit/*') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-object-group"></i> <span>{{ trans('labels.collection') }}</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview {{ Request::is('admin/collection/view') ? 'active' : '' }} {{ Request::is('admin/collection/add') ? 'active' : '' }} {{ Request::is('admin/collection/edit/*') ? 'active' : '' }} {{ Request::is('admin/collection/filter') ? 'active' : '' }} {{ Request::is('admin/collection/view_product/*') ? 'active' : '' }} ">
              <a href="{{url('admin/collection/view')}}">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.collection') }} </span>
              </a>
          </li>

           <li class="treeview {{ Request::is('admin/collection/product') ? 'active' : '' }} {{ Request::is('admin/collection/product_edit/*') ? 'active' : '' }}">
              <a href="{{url('admin/collection/product')}}">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.product_collection') }} </span>
              </a>
          </li>

        </ul>
      </li>

      <?php } ?>

       <?php
        if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->view_ticket == 1){
      ?>
      <li class="treeview {{ Request::is('admin/ticket/product') ? 'active' : '' }} {{ Request::is('admin/ticket/add_product') ? 'active' : '' }} {{ Request::is('admin/ticket/edit_product/*') ? 'active' : '' }} {{ Request::is('admin/ticket/view/*') ? 'active' : '' }} {{ Request::is('admin/ticket/view_ticket/*') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-object-group"></i> <span>{{ trans('labels.ticket') }}</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu {{ Request::is('admin/ticket/view/*') ? 'active' : '' }} {{ Request::is('admin/ticket/view_ticket/*') ? 'active' : '' }}">
          <li class="treeview {{ Request::is('admin/ticket/view/*') ? 'active' : '' }} {{ Request::is('admin/ticket/view_ticket/*') ? 'active' : '' }}">
              <a href="{{url('admin/ticket/view/open')}}">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.manage_tickets') }} </span>
              </a>
          </li>

           <li class="treeview {{ Request::is('admin/ticket/product') ? 'active' : '' }} {{ Request::is('admin/ticket/add_product') ? 'active' : '' }} {{ Request::is('admin/ticket/edit_product/*') ? 'active' : '' }}">
              <a href="{{url('admin/ticket/product')}}">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.ticket_products') }} </span>
              </a>
          </li>

        </ul>
      </li>

      <?php } ?>

      <?php

        if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->newsletter_view == 1){
        ?>
        <li class="treeview {{ Request::is('admin/newsletter/view') ? 'active' : '' }} {{ Request::is('admin/newsletter/add') ? 'active' : '' }} ">
          <a href="{{ URL::to('admin/newsletter/view')}}"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span> Newsletter</span>
          </a>
        </li>
  <?php } ?>

  <?php

    if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->shopping_info_view == 1){
    ?>
    <li class="treeview {{ Request::is('admin/shoppinginfo/view') ? 'active' : '' }} {{ Request::is('admin/shoppinginfo/add') ? 'active' : '' }} {{ Request::is('admin/shoppinginfo/edit/*') ? 'active' : '' }} {{ Request::is('admin/shoppinginfo/filter') ? 'active' : '' }}">
      <a href="{{ URL::to('admin/shoppinginfo/view')}}"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span> Shopping Info</span>
      </a>
    </li>
    <?php } ?>


    <!-- <?php

    if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->shopping_info_view == 1){
    ?>
    <li class="treeview {{ Request::is('admin/clientbrand/display') ? 'active' : '' }} {{ Request::is('admin/clientbrand/add') ? 'active' : '' }} ">
      <a href="{{ URL::to('admin/clientbrand/display')}}"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span> Client Brand</span>
      </a>
    </li>
    <?php } ?> -->


      <?php

        if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->shipping_methods_view == 1){
      ?>
        <li class="treeview {{ Request::is('admin/shippingmethods/display') ? 'active' : '' }} {{ Request::is('admin/shippingmethods/upsShipping/display') ? 'active' : '' }} {{ Request::is('admin/shippingmethods/flateRate/display') ? 'active' : '' }} {{ Request::is('admin/shippingmethods/detail/free_shipping') ? 'active' : '' }}">
          <a href="{{ URL::to('admin/shippingmethods/display')}}"><i class="fa fa-truck" aria-hidden="true"></i> <span> {{ trans('labels.link_shipping_methods') }}</span>
          </a>
        </li>
          <?php } ?>
          <?php
            if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->payment_methods_view == 1){
          ?>
            <li class="treeview {{ Request::is('admin/paymentmethods/index') ? 'active' : '' }} {{ Request::is('admin/paymentmethods/display/*') ? 'active' : '' }}">
              <a  href="{{ URL::to('admin/paymentmethods/index')}}"><i class="fa fa-credit-card" aria-hidden="true"></i> <span>
              {{ trans('labels.link_payment_methods') }}</span>
              </a>
            </li>
          <?php } ?>
          <?php

        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->news_view == 1){
      ?>
        <li class="treeview {{ Request::is('admin/newscategories/display') ? 'active' : '' }} {{ Request::is('admin/newscategories/add') ? 'active' : '' }} {{ Request::is('admin/newscategories/edit/*') ? 'active' : '' }} {{ Request::is('admin/news/display') ? 'active' : '' }}  {{ Request::is('admin/news/add') ? 'active' : '' }}  {{ Request::is('admin/news/edit/*') ? 'active' : '' }} {{ Request::is('admin/newscategories/filter') ? 'active' : '' }} {{ Request::is('admin/news/filter') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-database" aria-hidden="true"></i>
<span>      {{ trans('labels.Blog') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          	<li class="{{ Request::is('admin/newscategories/display') ? 'active' : '' }} {{ Request::is('admin/newscategories/add') ? 'active' : '' }} {{ Request::is('admin/newscategories/edit/*') ? 'active' : '' }} {{ Request::is('admin/newscategories/filter') ? 'active' : '' }}"><a href="{{ URL::to('admin/newscategories/display')}}"><i class="fa fa-circle-o"></i>{{ trans('labels.link_news_categories') }}</a></li>
            <li class="{{ Request::is('admin/news/display') ? 'active' : '' }}  {{ Request::is('admin/news/add') ? 'active' : '' }}  {{ Request::is('admin/news/edit/*') ? 'active' : '' }} {{ Request::is('admin/news/filter') ? 'active' : '' }}"><a href="{{ URL::to('admin/news/display')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_sub_news') }}</a></li>
          </ul>
        </li>
      <?php } ?> 

      <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->general_setting_view == 1){
      ?>

      <li class="treeview {{ Request::is('admin/email/emailsetting') ? 'active' : '' }} {{ Request::is('admin/email/newuser') ? 'active' : '' }} {{ Request::is('admin/email/subscription') ? 'active' : '' }} ">
          <a href="#">
            <i class="fa fa-envelope-o" aria-hidden="true"></i>
<span>      {{ trans('labels.Email') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          	<li class="{{ Request::is('admin/email/emailsetting') ? 'active' : '' }}"><a href="{{ URL::to('admin/email/emailsetting')}}"><i class="fa fa-circle-o"></i>{{ trans('labels.emailsetting') }}</a></li>
            <li class="{{ Request::is('admin/email/newuser') ? 'active' : '' }}"><a href="{{ URL::to('admin/email/newuser')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.newuser') }}</a></li>
            <li class="{{ Request::is('admin/email/subscription') ? 'active' : '' }}"><a href="{{ URL::to('admin/email/subscription')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.subscription') }}</a></li>
          </ul>
        </li>
        <?php } ?> 
        
      @if($result['commonContent']['roles']!= null and ($result['commonContent']['roles']->notifications_view == 1 or  $result['commonContent']['roles']->general_setting_view == 1))
      <li class="treeview {{ Request::is('admin/pushnotification') ? 'active' : '' }}{{ Request::is('admin/devices/display') ? 'active' : '' }} {{ Request::is('admin/devices/viewdevices/*') ? 'active' : '' }} {{ Request::is('admin/devices/notifications') ? 'active' : '' }}">
          <a href="{{ URL::to('admin/devices/display')}} ">
            <i class="fa fa-bell-o" aria-hidden="true"></i>
            <span>{{ trans('labels.link_notifications') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->general_setting_view == 1){
      ?>

          <li class="{{ Request::is('admin/pushnotification') ? 'active' : '' }}"><a href="{{ URL::to('admin/pushnotification')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_setting') }}</a></li>
            <?php } ?>
            <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->notifications_view == 1){
      ?>

            <li class="{{ Request::is('admin/devices/display') ? 'active' : '' }} {{ Request::is('admin/devices/viewdevices/*') ? 'active' : '' }}">
          		<a href="{{ URL::to('admin/devices/display')}}"><i class="fa fa-circle-o"></i>{{ trans('labels.link_devices') }} </a>
            </li>
            <li class="{{ Request::is('admin/devices/notifications') ? 'active' : '' }} ">
            	<a href="{{ URL::to('admin/devices/notifications') }}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_send_notifications') }}</a>
            </li>
            <?php } ?>
          </ul>
        </li>
        @endif
        <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->general_setting_view == 1){
      ?>

        <li class="treeview {{ Request::is('admin/loginsetting') ? 'active' : '' }} {{ Request::is('admin/firebase') ? 'active' : '' }} {{ Request::is('admin/facebooksettings') ? 'active' : '' }} {{ Request::is('admin/setting') ? 'active' : '' }} {{ Request::is('admin/googlesettings') ? 'active' : '' }}  {{ Request::is('admin/alertsetting') ? 'active' : '' }} {{ Request::is('admin/geo-fencing') ? 'active' : '' }} {{ Request::is('admin/add-geo-fencing') ? 'active' : '' }} {{ Request::is('admin/geo-filter') ? 'active' : '' }} {{ Request::is('admin/edit-geo-fencing/*') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
          <span> {{ trans('labels.link_general_settings') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">            
            <li class="{{ Request::is('admin/setting') ? 'active' : '' }}"><a href="{{ URL::to('admin/setting')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_store_setting') }}</a></li>
            <!-- <li class="{{ Request::is('admin/facebooksettings') ? 'active' : '' }}"><a href="{{ URL::to('admin/facebooksettings')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_facebook') }}</a></li>
            <li class="{{ Request::is('admin/googlesettings') ? 'active' : '' }}"><a href="{{ URL::to('admin/googlesettings')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_google') }}</a></li> -->
            
            <li class="{{ Request::is('admin/alertsetting') ? 'active' : '' }}"><a href="{{ URL::to('admin/alertsetting')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.alertSetting') }}</a></li>
            <li class="{{ Request::is('admin/firebase') ? 'active' : '' }}"><a href="{{ URL::to('admin/firebase')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.Firebase') }}</a></li>
            <li class="{{ Request::is('admin/geo-fencing') ? 'active' : '' }} {{ Request::is('admin/geo-filter') ? 'active' : '' }}"><a href="{{ URL::to('admin/geo-fencing')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.geo-fencing') }}</a></li>
            <!-- <li class="{{ Request::is('admin/loginsetting') ? 'active' : '' }}"><a href="{{ URL::to('admin/loginsetting')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.Login Setting') }}</a></li> -->
         
          </ul>
        </li>
      <?php } ?>
      <?php

      $route =  DB::table('settings')
                 ->where('name','is_web_purchased')
                 ->where('value', 1)
                 ->first();
                 $current_theme = DB::table('current_theme')->where('id', '=', '1')->first();
                
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->website_setting_view == 1 and $route != null){
      ?>

<li class="treeview {{ Request::is('admin/webPagesSettings/12') ? 'active' : '' }} {{ Request::is('admin/instafeed') ? 'active' : '' }} {{ Request::is('admin/menus') ? 'active' : '' }} {{ Request::is('admin/mailchimp') ? 'active' : '' }} {{ Request::is('admin/topoffer/display') ? 'active' : '' }} {{ Request::is('admin/subscribe') ? 'active' : '' }} {{ Request::is('admin/newdeal') ? 'active' : '' }} {{ Request::is('admin/webPagesSettings/') ? 'active' : '' }} {{ Request::is('admin/homebanners') ? 'active' : '' }} {{ Request::is('admin/sliders') ? 'active' : '' }} {{ Request::is('admin/addsliderimage') ? 'active' : '' }} {{ Request::is('admin/editslide/') ? 'active' : '' }} {{ Request::is('admin/webpages') ? 'active' : '' }}  {{ Request::is('admin/addwebpage') ? 'active' : '' }}  {{ Request::is('admin/editwebpage/') ? 'active' : '' }} {{ Request::is('admin/websettings') ? 'active' : '' }} {{ Request::is('admin/webthemes') ? 'active' : '' }} {{ Request::is('admin/constantbannerstwo') ? 'active' : '' }} {{ Request::is('admin/constantbannersthree') ? 'active' : '' }} {{ Request::is('admin/constantbannersfour') ? 'active' : '' }} {{ Request::is('admin/customstyle') ? 'active' : '' }} {{ Request::is('admin/constantbanners') ? 'active' : '' }} {{ Request::is('admin/addconstantbanner') ? 'active' : '' }} {{ Request::is('admin/editconstantbannertwo/') ? 'active' : '' }} {{ Request::is('admin/editconstantbannerthree/') ? 'active' : '' }} {{ Request::is('admin/editconstantbanner/') ? 'active' : '' }} {{ Request::is('admin/seo') ? 'active' : '' }} {{ Request::is('admin/addwebpage') ? 'active' : '' }}  {{ Request::is('admin/editwebpage/*') ? 'active' : '' }}  {{ Request::is('admin/addwebpagebuild') ? 'active' : '' }} {{ Request::is('admin/zippageadd') ? 'active' : '' }} {{ Request::is('admin/addmenus') ? 'active' : '' }}  {{ Request::is('admin/editmenus/*') ? 'active' : '' }} {{ Request::is('admin/editslide/*') ? 'active' : '' }} {{ Request::is('admin/readytemplate') ? 'active' : '' }}{{ Request::is('admin/constantbanners/') ? 'active' : '' }} {{ Request::is('admin/editconstantbanner/*') ? 'active' : '' }} {{ Request::is('admin/editconstantbannertwo/*') ? 'active' : '' }} {{ Request::is('admin/editconstantbannerthree/*') ? 'active' : '' }} {{ Request::is('admin/editconstantbannerfour/*') ? 'active' : '' }} {{ Request::is('admin/webPagesSettings/*') ? 'active' : '' }} {{ Request::is('admin/subscribe_modal/display') ? 'active' : '' }} {{ Request::is('admin/whychooseus/whychooseus') ? 'active' : '' }} {{ Request::is('admin/whychooseus/add_whychooseus') ? 'active' : '' }} {{ Request::is('admin/whychooseus/edit_whychooseus/*') ? 'active' : '' }} {{ Request::is('admin/gallery/view') ? 'active' : '' }} {{ Request::is('admin/gallery/add_gallery') ? 'active' : '' }} {{ Request::is('admin/gallery/edit_gallery') ? 'active' : '' }} {{ Request::is('admin/gallery/viewgalleryimage/*') ? 'active' : '' }} {{ Request::is('admin/gallery/add_galleryimage/*') ? 'active' : '' }} {{ Request::is('admin/gallery/edit_galleryimage/*') ? 'active' : '' }}  {{ Request::is('admin/whychooseus/viewwhychooseusimage/*') ? 'active' : '' }} {{ Request::is('admin/whychooseus/add_whychooseusimage/*') ? 'active' : '' }} {{ Request::is('admin/whychooseus/edit_whychooseusimage/*') ? 'active' : '' }} {{ Request::is('admin/homebannerstwo') ? 'active' : '' }} {{ Request::is('admin/homebannersthree') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
            <span> {{ trans('labels.link_site_settings') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="treeview {{ Request::is('admin/topoffer/display') ? 'active' : '' }} {{ Request::is('admin/subscribe') ? 'active' : '' }} {{ Request::is('admin/newdeal') ? 'active' : '' }} {{ Request::is('admin/webPagesSettings/*') ? 'active' : '' }} {{ Request::is('admin/subscribe_modal/display') ? 'active' : '' }} {{ Request::is('admin/whychooseus/whychooseus') ? 'active' : '' }} {{ Request::is('admin/whychooseus/add_whychooseus') ? 'active' : '' }} {{ Request::is('admin/whychooseus/edit_whychooseus/*') ? 'active' : '' }} {{ Request::is('admin/gallery/view') ? 'active' : '' }} {{ Request::is('admin/gallery/add_gallery') ? 'active' : '' }} {{ Request::is('admin/gallery/edit_gallery') ? 'active' : '' }} {{ Request::is('admin/gallery/viewgalleryimage/*') ? 'active' : '' }} {{ Request::is('admin/gallery/add_galleryimage/*') ? 'active' : '' }} {{ Request::is('admin/gallery/edit_galleryimage/*') ? 'active' : '' }} {{ Request::is('admin/whychooseus/viewwhychooseusimage/*') ? 'active' : '' }} {{ Request::is('admin/whychooseus/add_whychooseusimage/*') ? 'active' : '' }} {{ Request::is('admin/whychooseus/edit_whychooseusimage/*') ? 'active' : '' }}">
              <a href="#">
                <i class="fa fa-picture-o"></i> <span>{{ trans('labels.Theme Setting') }}</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
             
              <ul class="treeview-menu">
              @if($current_theme->template == 0)
                <li class="treeview {{ Request::is('admin/webPagesSettings/1') ? 'active' : '' }} ">
                    <a href="{{url('admin/webPagesSettings')}}/1">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Home Page Builder') }} </span>
                    </a>
                </li>
                @endif
                
                <li class="treeview {{ Request::is('admin/webPagesSettings/7') ? 'active' : '' }} ">
                    <a href="{{url('admin/webPagesSettings')}}/7">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Colors Settings') }}</span>
                    </a>
                </li>
               

                
                
                <li class="treeview {{ Request::is('admin/webPagesSettings/15') ? 'active' : '' }} ">
                    <a href="{{url('admin/webPagesSettings')}}/15">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Background Settings') }}</span>
                    </a>
                </li>
                

                @if($current_theme->template == 0)
               
                <li class="treeview {{ Request::is('admin/webPagesSettings/10') ? 'active' : '' }} ">
                  <a href="{{url('admin/webPagesSettings')}}/10">
                      <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Banner Transition Settings') }} </span>
                  </a>
                </li>
                
                <li class="treeview {{ Request::is('admin/webPagesSettings/11') ? 'active' : '' }} ">
                  <a href="{{url('admin/webPagesSettings')}}/11">
                      <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Product Card Style') }} </span>
                  </a>
               </li>
               @endif
               <li class="treeview {{ Request::is('admin/webPagesSettings/12') ? 'active' : '' }} ">
                 <a href="{{url('admin/webPagesSettings')}}/12">
                     <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Categorywidget') }} </span>
                 </a>
              </li>
             
              <li class="treeview {{ Request::is('admin/webPagesSettings/13') ? 'active' : '' }} ">
                <a href="{{url('admin/webPagesSettings')}}/13">
                    <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Categories Section') }} </span>
                </a>
             </li>
            
             @if($current_theme->template == 0 || $current_theme->template == 21 || $current_theme->template == 28 || $current_theme->template == 30 || $current_theme->template == 35)
                <li class="treeview {{ Request::is('admin/topoffer/display') ? 'active' : '' }} ">
                    <a href="{{url('admin/topoffer/display')}}">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Top Offer') }} </span>
                    </a>
                </li>
                @endif
               
                <li class="treeview {{ Request::is('admin/subscribe_modal/display') ? 'active' : '' }} ">
                    <a href="{{url('admin/subscribe_modal/display')}}">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> Subscribe Modal </span>
                    </a>
                </li>
                
                @if($current_theme->template == 0 || $current_theme->template == 1 || $current_theme->template == 2 || $current_theme->template == 3 || $current_theme->template == 4 || $current_theme->template == 5 || $current_theme->template == 6 || $current_theme->template == 9 || $current_theme->template == 10 || $current_theme->template == 13 || $current_theme->template == 14 || $current_theme->template == 15 || $current_theme->template == 16 || $current_theme->template == 17 || $current_theme->template == 19 || $current_theme->template == 20 || $current_theme->template == 21 || $current_theme->template == 22 || $current_theme->template == 24 || $current_theme->template == 28 || $current_theme->template == 29 || $current_theme->template == 35)
                <li class="treeview {{ Request::is('admin/subscribe') ? 'active' : '' }} ">
                    <a href="{{url('admin/subscribe')}}">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span>Home Subscribe</span>
                    </a>
                </li>
                @endif
                @if($current_theme->template == 0 || $current_theme->template == 3 || $current_theme->template == 4 || $current_theme->template == 10 || $current_theme->template == 22 || $current_theme->template == 26)
                <li class="treeview {{ Request::is('admin/newdeal') ? 'active' : '' }} ">
                    <a href="{{url('admin/newdeal')}}">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span>New Deal</span>
                    </a>
                </li>
                @endif
               
                <li class="treeview {{ Request::is('admin/webPagesSettings/8') ? 'active' : '' }} ">
                    <a href="{{url('admin/webPagesSettings')}}/8">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.login') }} </span>
                    </a>
                </li>
              
                
                <li class="treeview {{ Request::is('admin/webPagesSettings/9') ? 'active' : '' }} ">
                  <a href="{{url('admin/webPagesSettings')}}/9">
                      <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.News') }} </span>
                    </a>
                </li>

                <li class="treeview {{ Request::is('admin/webPagesSettings/5') ? 'active' : '' }} ">
                  <a href="{{url('admin/webPagesSettings')}}/5">
                      <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Shop Page Settings') }} </span>
                  </a>
               </li>
             
                <li class="treeview {{ Request::is('admin/webPagesSettings/2') ? 'active' : '' }} ">
                    <a href="{{url('admin/webPagesSettings')}}/2">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Cart Page Settings') }} </span>
                    </a>
                </li>
               
                <li class="treeview {{ Request::is('admin/webPagesSettings/16') ? 'active' : '' }} ">
                    <a href="{{url('admin/webPagesSettings')}}/16">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> Checkout Page Settings </span>
                    </a>
                </li>
                <li class="treeview {{ Request::is('admin/webPagesSettings/6') ? 'active' : '' }} ">
                    <a href="{{url('admin/webPagesSettings')}}/6">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Contact Page Settings') }}</span>
                    </a>
                </li>
               
              
                <li class="treeview {{ Request::is('admin/webPagesSettings/4') ? 'active' : '' }} ">
                    <a href="{{url('admin/webPagesSettings')}}/4">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('labels.Product Page Settings') }} </span>
                    </a>
                </li>


                <li class="treeview {{ Request::is('admin/whychooseus/whychooseus') ? 'active' : '' }} {{ Request::is('admin/whychooseus/add_whychooseus') ? 'active' : '' }} {{ Request::is('admin/whychooseus/edit_whychooseus/*') ? 'active' : '' }} {{ Request::is('admin/whychooseus/viewwhychooseusimage/*') ? 'active' : '' }} {{ Request::is('admin/whychooseus/add_whychooseusimage/*') ? 'active' : '' }} {{ Request::is('admin/whychooseus/edit_whychooseusimage/*') ? 'active' : '' }}">
                    <a href="{{url('admin/whychooseus/whychooseus')}}">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> WhyChooseUs </span>
                    </a>
                </li>

              <!--   <li class="treeview {{ Request::is('admin/gallery/view') ? 'active' : '' }} {{ Request::is('admin/gallery/add_gallery') ? 'active' : '' }} {{ Request::is('admin/gallery/edit_gallery') ? 'active' : '' }} {{ Request::is('admin/gallery/viewgalleryimage/*') ? 'active' : '' }} {{ Request::is('admin/gallery/add_galleryimage/*') ? 'active' : '' }} {{ Request::is('admin/gallery/edit_galleryimage/*') ? 'active' : '' }}">
                    <a href="{{url('admin/gallery/view')}}">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> Gallery </span>
                    </a>
                </li> -->


                <li class="treeview {{ Request::is('admin/webPagesSettings/14') ? 'active' : '' }} ">
                    <a href="{{url('admin/webPagesSettings')}}/14">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> {{ trans('Font Settings') }} </span>
                    </a>
                </li>
             
            
             

              </ul>
            </li>

            @if($current_theme->template == 0 || $current_theme->template == 1 || $current_theme->template == 2 || $current_theme->template == 3 || $current_theme->template == 4 || $current_theme->template == 5 || $current_theme->template == 6 || $current_theme->template == 7 || $current_theme->template == 8 || $current_theme->template == 9 || $current_theme->template == 10 || $current_theme->template == 12 || $current_theme->template == 13 || $current_theme->template == 14 || $current_theme->template == 15 || $current_theme->template == 16 || $current_theme->template == 17 || $current_theme->template == 18 || $current_theme->template == 19 || $current_theme->template == 20 || $current_theme->template == 21 || $current_theme->template == 22 || $current_theme->template == 23 || $current_theme->template == 24 || $current_theme->template == 25 || $current_theme->template == 26 || $current_theme->template == 27 || $current_theme->template == 28 || $current_theme->template == 29 || $current_theme->template == 30 || $current_theme->template == 31 || $current_theme->template == 32 || $current_theme->template == 33 || $current_theme->template == 34 || $current_theme->template == 35) 

            <li class="treeview {{ Request::is('admin/constantbanners') ? 'active' : '' }} {{ Request::is('admin/constantbannerstwo') ? 'active' : '' }} {{ Request::is('admin/constantbannersthree') ? 'active' : '' }} {{ Request::is('admin/constantbannersfour') ? 'active' : '' }} {{ Request::is('admin/editconstantbannertwo/*') ? 'active' : '' }} {{ Request::is('admin/editconstantbannerthree/*') ? 'active' : '' }} {{ Request::is('admin/editconstantbannerfour/*') ? 'active' : '' }} {{ Request::is('admin/editconstantbanner/*') ? 'active' : '' }}">
              <a href="#">
                <i class="fa fa-picture-o"></i> <span>Banners</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              @if($current_theme->template == 0 || $current_theme->template == 1 || $current_theme->template == 2  || $current_theme->template == 3 || $current_theme->template == 4 || $current_theme->template == 5 || $current_theme->template == 6 || $current_theme->template == 7 || $current_theme->template == 8 || $current_theme->template == 9 || $current_theme->template == 10 || $current_theme->template == 12 || $current_theme->template == 13 || $current_theme->template == 14 || $current_theme->template == 15 || $current_theme->template == 16 || $current_theme->template == 17 || $current_theme->template == 18 || $current_theme->template == 19 || $current_theme->template == 20 || $current_theme->template == 21 || $current_theme->template == 22 || $current_theme->template == 23 || $current_theme->template == 24 || $current_theme->template == 25 || $current_theme->template == 26 || $current_theme->template == 27 || $current_theme->template == 28 || $current_theme->template == 29 || $current_theme->template == 30 || $current_theme->template == 31 || $current_theme->template == 32 || $current_theme->template == 33 || $current_theme->template == 34 || $current_theme->template == 35)
                <li class="treeview {{ Request::is('admin/constantbanners') ? 'active' : '' }} {{ Request::is('admin/editconstantbanner/*') ? 'active' : '' }}">
                  <a href="{{ URL::to('admin/constantbanners')}} ">
                      <i class="fa fa-circle-o"></i> Banner one
                  </a>
                </li>
                @endif
                @if($current_theme->template == 0 || $current_theme->template == 5 || $current_theme->template == 8 || $current_theme->template == 10 || $current_theme->template == 13 || $current_theme->template == 19 || $current_theme->template == 20 || $current_theme->template == 24 || $current_theme->template == 25 || $current_theme->template == 26 || $current_theme->template == 30 || $current_theme->template == 31 || $current_theme->template == 32 || $current_theme->template == 33 || $current_theme->template == 35)
                <li class="treeview {{ Request::is('admin/constantbannerstwo') ? 'active' : '' }} {{ Request::is('admin/editconstantbannertwo/*') ? 'active' : '' }}">
                  <a href="{{ URL::to('admin/constantbannerstwo')}}">
                      <i class="fa fa-circle-o"></i> Banner two
                  </a>
                </li>
                @endif
                @if($current_theme->template == 0 || $current_theme->template == 8 || $current_theme->template == 24 || $current_theme->template == 30 || $current_theme->template == 32 || $current_theme->template == 33 || $current_theme->template == 35)
                <li class="treeview {{ Request::is('admin/constantbannersthree') ? 'active' : '' }} {{ Request::is('admin/editconstantbannerthree/*') ? 'active' : '' }}">
                  <a href="{{ URL::to('admin/constantbannersthree')}}">
                      <i class="fa fa-circle-o"></i> Banner three
                  </a>
                </li>
                @endif
                @if($current_theme->template == 0 || $current_theme->template == 35)
                <li class="treeview {{ Request::is('admin/constantbannersfour') ? 'active' : '' }} {{ Request::is('admin/editconstantbannerfour/*') ? 'active' : '' }}">
                  <a href="{{ URL::to('admin/constantbannersfour')}}">
                      <i class="fa fa-circle-o"></i> Banner four
                  </a>
                </li>
                @endif
               
              
              </ul>
            </li>

            @endif

            <li class="treeview {{ Request::is('admin/readytemplate') ? 'active' : '' }} ">
                <a href="{{url('admin/readytemplate')}}">
                    <i class="fa fa-apple" aria-hidden="true"></i> <span> Ready Templates </span>
                </a>
            </li>
            
            @if($current_theme->template != 7)
            @if($current_theme->template != 17)
            @if($current_theme->template != 20)
           
            <li class="{{ Request::is('admin/sliders') ? 'active' : '' }} {{ Request::is('admin/addsliderimage') ? 'active' : '' }} {{ Request::is('admin/editslide/*') ? 'active' : '' }} "><a href="{{ URL::to('admin/sliders')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_Sliders') }}</a></li>
           
            @endif
            @endif
            @endif
            @if($current_theme->template == 0)
            <li class="treeview {{ Request::is('admin/homebanners') ? 'active' : '' }} {{ Request::is('admin/homebannerstwo') ? 'active' : '' }} {{ Request::is('admin/homebannersthree') ? 'active' : '' }}">
              <a href="#">
                <i class="fa fa-picture-o"></i> <span>{{ trans('labels.Parallax Banners') }}</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @if($current_theme->template == 0)
                  <li class="{{ Request::is('admin/homebanners') ? 'active' : '' }} "><a href="{{ URL::to('admin/homebanners')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.Parallax Banners') }} One</a></li>
                  <li class="{{ Request::is('admin/homebannerstwo') ? 'active' : '' }} "><a href="{{ URL::to('admin/homebannerstwo')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.Parallax Banners') }} Two</a></li>
                  <li class="{{ Request::is('admin/homebannersthree') ? 'active' : '' }} "><a href="{{ URL::to('admin/homebannersthree')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.Parallax Banners') }} Three</a></li>
                @endif
              </ul>
          </li>
            @endif
           <!--  <li class="{{ Request::is('admin/constantbanners') ? 'active' : '' }} {{ Request::is('admin/constantbanners') ? 'active' : '' }} {{ Request::is('admin/constantbanners/*') ? 'active' : '' }} "><a href="{{ URL::to('admin/constantbanners')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_Banners') }}</a></li> -->
           
            <li class="{{ Request::is('admin/menus') ? 'active' : '' }}  {{ Request::is('admin/addmenus') ? 'active' : '' }}  {{ Request::is('admin/editmenus/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/menus')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.menus') }}</a></li>

            <li class="{{ Request::is('admin/webpages') ? 'active' : '' }}  {{ Request::is('admin/addwebpage') ? 'active' : '' }}  {{ Request::is('admin/editwebpage/*') ? 'active' : '' }}  {{ Request::is('admin/addwebpagebuild') ? 'active' : '' }} {{ Request::is('admin/zippageadd') ? 'active' : '' }}"><a href="{{ URL::to('admin/webpages')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.content_pages') }}</a></li>

            <!-- <li class="{{ Request::is('admin/webthemes') ? 'active' : '' }} "><a href="{{ URL::to('admin/webthemes')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.website_themes') }}</a></li> -->

            <li class="{{ Request::is('admin/seo') ? 'active' : '' }} "><a href="{{ URL::to('admin/seo')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.seo content') }}</a></li>

            <li class="{{ Request::is('admin/customstyle') ? 'active' : '' }} "><a href="{{ URL::to('admin/customstyle')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.custom_style_js') }}</a></li>
           <!--  <li class="{{ Request::is('admin/newsletter') ? 'active' : '' }}"><a href="{{ URL::to('admin/newsletter')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.mailchimp') }}</a></li> -->
            <li class="{{ Request::is('admin/instafeed') ? 'active' : '' }}"><a href="{{ URL::to('admin/instafeed')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.instagramfeed') }}</a></li>
            <li class="{{ Request::is('admin/websettings') ? 'active' : '' }}"><a href="{{ URL::to('admin/websettings')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_setting') }}</a></li>
          </ul>
        </li>
      <?php } ?>
      <?php
      $route =  DB::table('settings')
                 ->where('name','is_app_purchased')
                 ->where('value', 1)
                 ->first();

        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->application_setting_view == 1 and $route != null){
      ?>

        <li class="treeview {{ Request::is('admin/banners') ? 'active' : '' }} {{ Request::is('admin/banners/add') ? 'active' : '' }} {{ Request::is('admin/banners/edit/*') ? 'active' : '' }} {{ Request::is('admin/pages') ? 'active' : '' }}  {{ Request::is('admin/addpage') ? 'active' : '' }}  {{ Request::is('admin/editpage/*') ? 'active' : '' }}  {{ Request::is('admin/appsettings') ? 'active' : '' }} {{ Request::is('admin/admobSettings') ? 'active' : '' }} {{ Request::is('admin/applabel') ? 'active' : '' }} {{ Request::is('admin/addappkey') ? 'active' : '' }} {{ Request::is('admin/applicationapi') ? 'active' : '' }} {{ Request::is('admin/banners_two/add_two') ? 'active' : '' }} {{ Request::is('admin/banners_two/edit_two/*') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
  <span> {{ trans('labels.link_app_settings') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('admin/banners') ? 'active' : '' }} {{ Request::is('admin/banners/add') ? 'active' : '' }} {{ Request::is('admin/banners/edit/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/banners')}}"><i class="fa fa-circle-o"></i>Banner One</a></li>

            <li class="{{ Request::is('admin/banners_two') ? 'active' : '' }} {{ Request::is('admin/banners_two/add_two') ? 'active' : '' }} {{ Request::is('admin/banners_two/edit_two/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/banners_two')}}"><i class="fa fa-circle-o"></i>Banner Two</a></li>


            <li class="{{ Request::is('admin/pages') ? 'active' : '' }}  {{ Request::is('admin/addpage') ? 'active' : '' }}  {{ Request::is('admin/editpage/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/pages')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.content_pages') }}</a></li>

            <!-- <li class="{{ Request::is('admin/admobSettings') ? 'active' : '' }}"><a href="{{ URL::to('admin/admobSettings')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_admob') }}</a></li>

            <li class="android-hide {{ Request::is('admin/applabel') ? 'active' : '' }} {{ Request::is('admin/addappkey') ? 'active' : '' }}"><a href="{{ URL::to('admin/applabel')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.labels') }}</a></li>

            <li class="{{ Request::is('admin/applicationapi') ? 'active' : '' }}"><a href="{{ URL::to('admin/applicationapi')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.applicationApi') }}</a></li> -->

            <li class="{{ Request::is('admin/appsettings') ? 'active' : '' }}"><a href="{{ URL::to('admin/appsettings')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_setting') }}</a></li>

          </ul>
        </li>
      <?php } 
        ?>
        <?php
      $route =  DB::table('settings')
                 ->where('name','is_pos_purchased')
                 ->where('value', 1)
                 ->first();

        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->pos_setting_view == 1 and $route != null){
      ?>
      <li class="treeview {{ Request::is('admin/possettings') ? 'active' : '' }} {{ Request::is('admin/cashierrole') ? 'active' : '' }} {{ Request::is('admin/cashierroleupdate/*') ? 'active' : '' }} {{ Request::is('admin/posfastcash') ? 'active' : '' }} {{ Request::is('admin/pospayment') ? 'active' : '' }} {{ Request::is('admin/addpospayment') ? 'active' : '' }} {{ Request::is('admin/pospaymentedit/*') ? 'active' : '' }} {{ Request::is('admin/drawercate') ? 'active' : '' }} {{ Request::is('admin/adddrawercate') ? 'active' : '' }} {{ Request::is('admin/editdrawercate/*') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
  <span> {{ trans('labels.link_pos_settings') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('admin/possettings') ? 'active' : '' }}"><a href="{{ URL::to('admin/possettings')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_setting') }}</a></li>

            <li class="{{ Request::is('admin/posfastcash') ? 'active' : '' }}"><a href="{{ URL::to('admin/posfastcash')}}"><i class="fa fa-circle-o"></i>Fast Cash</a></li>

            <li class="{{ Request::is('admin/pospayment') ? 'active' : '' }} {{ Request::is('admin/addpospayment') ? 'active' : '' }} {{ Request::is('admin/pospaymentedit/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/pospayment')}}"><i class="fa fa-circle-o"></i>Payment Methods</a></li>

            <li class="{{ Request::is('admin/drawercate') ? 'active' : '' }} {{ Request::is('admin/adddrawercate') ? 'active' : '' }} {{ Request::is('admin/editdrawercate/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/drawercate')}}"><i class="fa fa-circle-o"></i>Drawer Category</a></li>

			     <li class="{{ Request::is('admin/cashierroleupdate/*') ? 'active' : '' }} {{ Request::is('admin/cashierrole') ? 'active' : '' }}"><a href="{{ URL::to('admin/cashierrole')}}"><i class="fa fa-circle-o"></i>Manage Roles</a></li>

          </ul>
        </li>

      <?php } 
        ?>

        
<li class="treeview {{ Request::is('admin/qrordersettings') ? 'active' : '' }} {{ Request::is('admin/tablelabel') ? 'active' : '' }} {{ Request::is('admin/addtablekey') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
  <span>Settings (Table)</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('admin/qrordersettings') ? 'active' : '' }}"><a href="{{ URL::to('admin/qrordersettings')}}"><i class="fa fa-circle-o"></i> Table Setting</a></li>
            <li class="treeview {{ Request::is('admin/tablelabel') ? 'active' : '' }} {{ Request::is('admin/addtablekey') ? 'active' : '' }}"><a href="{{ URL::to('admin/tablelabel')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.labels') }}</a></li>

          </ul>
        </li>


      <?php
      $route =  DB::table('settings')
                 ->where('name','is_deliverboy_purchased')
                 ->where('value', 1)
                 ->first();

        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->deliveryboy_view == 1 and $route != null){
      ?>
     <li
      class="treeview {{ Request::is('admin/deliveryboys/status/display') ? 'active' : '' }}  {{ Request::is('admin/deliveryboys/status/add') ? 'active' : '' }}  {{ Request::is('admin/deliveryboys/status/edit/*') ? 'active' : '' }} {{ Request::is('admin/deliveryboys/withdraw/display') ? 'active' : '' }} {{ Request::is('admin/deliveryboys/floatingcash/display') ? 'active' : '' }} {{ Request::is('admin/deliveryboys/ratings') ? 'active' : '' }} {{ Request::is('admin/deliveryboys/display') ? 'active' : '' }}  {{ Request::is('admin/deliveryboys/add') ? 'active' : '' }}  {{ Request::is('admin/deliveryboys/edit/*') ? 'active' : '' }} {{ Request::is('admin/deliveryboys/filter') ? 'active' : '' }} {{ Request::is('admin/deliveryboys/finance/sattlement/deliveryboy/*') ? 'active' : '' }} {{ Request::is('admin/deliveryboys/ratings/*') ? 'active' : '' }} {{ Request::is('admin/deliveryboys/pages') ? 'active' : '' }}  {{ Request::is('admin/deliveryboys/addpage') ? 'active' : '' }}  {{ Request::is('admin/deliveryboys/editpage/*') ? 'active' : '' }} {{ Request::is('admin/deliveryboys/setting') ? 'active' : '' }}">
      <a href="#">
          <i class="fa fa-database" aria-hidden="true"></i>
          <span> {{ trans('labels.link_manage_deliveryboy') }}</span> <i
              class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
          <li
              class="{{ Request::is('admin/deliveryboys/display') ? 'active' : '' }}  {{ Request::is('admin/deliveryboys/add') ? 'active' : '' }}  {{ Request::is('admin/deliveryboys/edit/*') ? 'active' : '' }} {{ Request::is('admin/deliveryboys/filter') ? 'active' : '' }} {{ Request::is('admin/deliveryboys/finance/sattlement/deliveryboy/*') ? 'active' : '' }} {{ Request::is('admin/deliveryboys/ratings/*') ? 'active' : '' }}">
              <a href="{{ URL::to('admin/deliveryboys/display')}}"><i
                      class="fa fa-circle-o"></i>{{ trans('labels.link_deliveryboy') }}</a></li>
          <li
              class="{{ Request::is('admin/deliveryboys/floatingcash/display') ? 'active' : '' }}">
              <a href="{{ URL::to('admin/deliveryboys/floatingcash/display')}}"><i class="fa fa-circle-o"></i>
                  {{ trans('labels.Floating Cash') }}</a></li>
          <li
              class="{{ Request::is('admin/deliveryboys/withdraw/display') ? 'active' : '' }}">
              <a href="{{ URL::to('admin/deliveryboys/withdraw/display?sort=payment_withdraw_id&direction=desc')}}"><i class="fa fa-circle-o"></i>
                  {{ trans('labels.Withdraw') }}</a></li>
          <li
              class="{{ Request::is('admin/deliveryboys/pages') ? 'active' : '' }}  {{ Request::is('admin/deliveryboys/addpage') ? 'active' : '' }}  {{ Request::is('admin/deliveryboys/editpage/*') ? 'active' : '' }}">
              <a href="{{ URL::to('admin/deliveryboys/pages')}}"><i class="fa fa-circle-o"></i>
                  {{ trans('labels.content_pages') }}</a></li>
          
          <li
              class="{{ Request::is('admin/deliveryboys/status/display') ? 'active' : '' }}  {{ Request::is('admin/deliveryboys/status/add') ? 'active' : '' }}  {{ Request::is('admin/deliveryboys/status/edit/*') ? 'active' : '' }}">
              <a href="{{ URL::to('admin/deliveryboys/status/display')}}"><i class="fa fa-circle-o"></i>
                  {{ trans('labels.Status') }}</a></li>     
                  
            <li
              class="{{ Request::is('admin/deliveryboys/setting') ? 'active' : '' }} ">
              <a href="{{ URL::to('admin/deliveryboys/setting')}}"><i class="fa fa-circle-o"></i>
                  {{ trans('labels.Setting') }}</a></li>     

        </ul>
      </li>
      

      <?php
      }

        if($result['commonContent']['roles']!= null and ($result['commonContent']['roles']->manage_admins_view == 1 or $result['commonContent']['roles']->manage_admins_role == 1)){
      ?>

         <li class="treeview {{ Request::is('admin/admins') ? 'active' : '' }} {{ Request::is('admin/addadmins') ? 'active' : '' }} {{ Request::is('admin/editadmin/*') ? 'active' : '' }} {{ Request::is('admin/manageroles') ? 'active' : '' }} {{ Request::is('admin/addadmintype') ? 'active' : '' }} {{ Request::is('admin/editadminType/*') ? 'active' : '' }} {{ Request::is('admin/addrole/*') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-users" aria-hidden="true"></i>
  <span> {{ trans('labels.Manage Admins') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>

          <ul class="treeview-menu">
          <?php
    

        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->manage_admins_view == 1){
      ?>
            <li class="{{ Request::is('admin/admins') ? 'active' : '' }} {{ Request::is('admin/addadmins') ? 'active' : '' }} {{ Request::is('admin/editadmin/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/admins')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_admins') }}</a></li>
            <?php } ?>

            <?php
    

    if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->manage_admins_role == 1){
  ?>

            <li class="{{ Request::is('admin/manageroles') ? 'active' : '' }} {{ Request::is('admin/addadmintype') ? 'active' : '' }} {{ Request::is('admin/editadminType/*') ? 'active' : '' }} {{ Request::is('admin/addrole/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/manageroles')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_manage_roles') }}</a></li>
            <?php } ?>
          </ul>
        </li>
        <?php 
        }
        ?>
        <?php
          //if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->edit_management == 1){
        ?>

          <!--------create middlewares -------->
        <!-- <li class="treeview {{ Request::is('admin/managements/merge') ? 'active' : '' }} {{ Request::is('admin/managements/updater') ? 'active' : '' }} {{ Request::is('admin/managements/restore') ? 'active' : '' }} {{ Request::is('admin/managements/backup') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
  <span> {{ trans('labels.Code Manager') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>

          <ul class="treeview-menu">
            @if($result['commonContent']['setting']['is_deliverboy_purchased'] == '0')
              <li class="{{ Request::is('admin/managements/merge') ? 'active' : '' }}"><a href="{{ URL::to('admin/managements/merge')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_merge') }}</a></li>
            @endif
              <li class="{{ Request::is('admin/managements/updater') ? 'active' : '' }}"><a href="{{ URL::to('admin/managements/updater')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_updater') }}</a></li>
          </ul>
        </li>
        <?php //} ?> -->

        <?php
          //if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->edit_management == 1){
        ?>

          <!--------create middlewares -------->
        <!-- <li class="treeview  {{ Request::is('admin/managements/restore') ? 'active' : '' }} {{ Request::is('admin/managements/backup') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
  <span> {{ trans('labels.Backup / Restore') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>

          <ul class="treeview-menu">
            <li class="{{ Request::is('admin/managements/updater') ? 'active' : '' }}"><a href="{{ URL::to('admin/managements/backup')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.backup') }}</a></li>
            <li class="{{ Request::is('admin/managements/updater') ? 'active' : '' }}"><a href="{{ URL::to('admin/managements/import')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.restore') }}</a></li>
            <li class="{{ Request::is('admin/managements/updater') ? 'active' : '' }}"><a href="{{ URL::to('admin/managements/factory_reset')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.factory_reset') }}</a></li> 
          </ul>
        </li>
        <?php //} ?> -->

        <!-- cache clear -->
        <li class="treeview {{ Request::is('admin/dashboard') ? 'active' : '' }} ">
          <a href="javascript:void(0)" class="clear-cache">
          <i class="fa fa-eraser" aria-hidden="true"></i> <span>{{ trans('labels.Clear Cache') }}</span>
          </a>
        </li>

        <li class="treeview {{ Request::is('admin/ticket') ? 'active' : '' }}">
          <a target="_blank" href="{{url('admin/support/tickets')}}"><i class="fa fa-life-ring" aria-hidden="true"></i> <span>Support</span></a>
        </li>

      

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
