<style>
  .cus_menu
  {
    overflow-y: scroll !important;
  }
  .slimScrollBar
  {
    display: none !important;
  }
  .navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a>h4 {
    padding: 0;
    margin: 0 0 0 0px;
    color: #444444;
    font-size: 15px;
    position: relative;
}
.navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a>p {
  margin: 0 0 0 0px;
    font-size: 12px;
    color: #888888;
}
</style>
<header class="main-header">


    <!-- Logo -->
    <a href="{{ URL::to('admin/dashboard/this_month')}}" class="logo">

    <?php    $role = DB::table('user_types')
            ->where('user_types_id','=', auth()->user()->role_id)
            ->first();?>
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini" style="font-size:12px"><b>{{ $role->user_types_name }}</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>{{ $role->user_types_name }}</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" id="linkid" data-toggle="offcanvas" role="button">
        <span class="sr-only">{{ trans('labels.toggle_navigation') }}</span>
      </a>
		<div id="countdown" style="
    width: 350px;
    margin-top: 13px !important;
    position: absolute;
    font-size: 16px;
    color: #ffffff;
    display: inline-block;
    margin-left: -175px;
    left: 50%;
"></div>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-list-ul"></i>

              <?php  
              $result1 = array();
            $orders = DB::table('orders')
            ->leftJoin('customers','customers.customers_id','=','orders.customers_id')
            ->where('orders.is_seen','=', 0)
            ->orderBy('orders_id','desc')
            ->get();

            $index = 0;
            foreach($orders as $orders_data){

              array_push($result1,$orders_data);
              $orders_products = DB::table('orders_products')
                ->where('orders_id', '=' ,$orders_data->orders_id)
                ->get();

              $result1[$index]->price = $orders_products;
              $result1[$index]->total_products = count($orders_products);
              $index++;
            }

          
 ?>
              <span class="label label-success">{{ count($result1) }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">{{ trans('labels.you_have') }} {{ count($result1) }} {{ trans('labels.new_orders') }}</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu cus_menu">
                @foreach($result1 as $unseenOrder)
                  <li><!-- start message -->
                    <a href="{{ URL::to("admin/orders/vieworder")}}/{{ $unseenOrder->orders_id}}">
                      <h4>
                        <?php if (strlen($unseenOrder->customers_name) > 17){
                        $customers_name_str = substr($unseenOrder->customers_name, 0, 17) . '...'; }
                        else{ $customers_name_str = $unseenOrder->customers_name; }?>
                      <span>{{ $customers_name_str }}</span>
                        <small><i class="fa fa-clock-o"></i> {{  date('d/m/Y', strtotime($unseenOrder->date_purchased))  }}</small>
                      </h4>
                      <p>Ordered Products ({{ $unseenOrder->total_products}})</p>
                    </a>
                  </li>
                @endforeach
                  <!-- end message -->
                </ul>
              </li>
              <!--<li class="footer"><a href="#">See All Messages</a></li>-->
            </ul>
          </li>

          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-users"></i>
           <?php   $newCustomers1 = DB::table('users')
                ->where('is_seen','=', 0)
                ->where('role_id','=', 2)
                ->orderBy('id','desc')
                ->get(); ?>

              <span class="label label-warning customer_new_count">{{ count($newCustomers1) }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">{{ count($newCustomers1) }} {{ trans('labels.new_users') }}</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu cus_menu">
                @foreach($newCustomers1 as $newCustomer)

                  <li><!-- start message -->
                    <a href="{{ URL::to("admin/customers/edit")}}/{{ $newCustomer->id}}">
                      <div class="pull-left">

                      </div>
                      <h4>
                        {{--{{ date('d/m/Y', $newCustomer->created_at) }}--}}
                        <span style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;width: 50%;">{{ $newCustomer->first_name }}</span> {{ $newCustomer->last_name }}
                        <small><i class="fa fa-clock-o"></i> </small>
                      </h4>
                      <p></p>
                    </a>
                  </li>
                @endforeach
                  <!-- end message -->
                </ul>
              </li>
              <!--<li class="footer"><a href="#">See All Messages</a></li>-->
            </ul>
          </li>
          @if($result['commonContent']['setting']['Inventory'] == '1')
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-th"></i>

              <?php 
             
              $lowInQunatity1 = DB::select(DB::raw('SELECT image_categories.path as image,products_description.products_name,inventory.products_id , inventory.stock , manage_min_max.min_level FROM `inventory` 
            LEFT JOIN products on products.products_id = inventory.products_id
            LEFT JOIN images on products.products_image = images.id
            LEFT JOIN image_categories on image_categories.image_id = images.id
            INNER JOIN manage_min_max on inventory.products_id = manage_min_max.products_id 
            LEFT JOIN products_description ON products_description.products_id = inventory.products_id 
            WHERE  products_description.language_id = 1 
            GROUP BY inventory.products_id ORDER BY manage_min_max.min_max_id DESC'));  
            $maxmincount = 0; ?>


              <span class="label label-warning maxmin_count" >{{ $maxmincount }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"><span class="maxmin_count">{{ $maxmincount  }} </span> {{ trans('labels.products_are_in_low_quantity') }}</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu cus_menu">
            
                @foreach($lowInQunatity1 as $lowInQunatity)
                

                 <?php    $stocksin = DB::table('inventory')->where('products_id', $lowInQunatity->products_id)->where('stock_type', 'in')->sum('stock');
                
                  $stockOut = DB::table('inventory')->where('products_id', $lowInQunatity->products_id)->where('stock_type', 'out')->sum('stock');
                  $stocks = $stocksin - $stockOut;
                  $manageLevel = DB::table('manage_min_max')->where('products_id', $lowInQunatity->products_id)->get();
                  $minmaxid = DB::table('manage_min_max')->where('products_id', $lowInQunatity->products_id)->first();
        
           

         if(count($manageLevel)>0){

        
             $min_level = $manageLevel[0]->min_level;
             $max_level = $manageLevel[0]->max_level;

         } ?> 
                @if((int)$stocks <= (int)$max_level)
                <?php $maxmincount++; ?>
                  <li><!-- start message -->
                  <a href="{{ URL::to("admin/products/inventory/display")}}">
                      <div class="pull-left">
                         <img src="{{asset($lowInQunatity->image)}}" class="img-circle" >
                      </div>
                      <h4 style="white-space: normal;">
                        {{ $lowInQunatity->products_name }}
                      </h4>
                      <p></p>
                    </a>
                  </li>
                  @endif
                @endforeach

                <input type="hidden" value="{{ $maxmincount }}" id="maxmincount" >

              
                  <!-- end message -->
                </ul>
              </li>
              
              <!--<li class="footer"><a href="#">See All Messages</a></li>-->
            </ul>
          </li>
          @endif
          <li class="dropdown user user-menu">
          <a href="javascript:void(0)"  class="clear-cache small-box-footer btn" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ trans('labels.Clear Cache') }}">
            <i class="fa fa-eraser" aria-hidden="true"></i>
          </a>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }} </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">

                <p>
                  {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                  <?php    $role = DB::table('user_types')
            ->where('user_types_id','=', auth()->user()->role_id)
            ->first();?>
                  <small>{{ $role->user_types_name}}</small>
                </p>
              </li>
              

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->profile_view == 1){
      ?>
                  <a href="{{ URL::to('admin/admin/profile')}}" class="btn btn-default btn-flat">{{ trans('labels.profile_link')}}</a>
                </div>
                <?php } ?>
                <div class="pull-right">
                  <a href="{{ URL::to('admin/logout')}}" class="btn btn-default btn-flat">{{ trans('labels.sign_out') }}</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!--<li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>-->
        </ul>
      </div>
    </nav>
  </header>

  <script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>

<script type="text/javascript">
var minmax = $("#maxmincount").val();
$(".maxmin_count").html(minmax);
</script>
