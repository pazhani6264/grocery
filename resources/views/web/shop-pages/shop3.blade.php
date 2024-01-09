<style>

.pro-content {
overflow: hidden;
padding-top: 40px;
background: #fff;
}

.right-menu .img-main {
margin-top: 10px;
padding-bottom: 10px;
}

.range-slider-main1 {
padding: 5px 0px 10px 0px !important;
margin-top: 0px !important;
margin-bottom: 15px;
border-bottom: 1px solid #dee2e6 !important;
}

.range-slider-main1 #accordionbrand {
  margin: 0 0 0.5rem;
}

.page-heading-title {
margin-top: -7px;
padding-bottom: 20px;
}

.top-bar {
border: 1px solid #c1c9d0;
padding: 0px 10px;
margin-bottom: 0px;
}

</style>

<div class="container-fuild">
  <nav aria-label="breadcrumb">
      <div class="container">
      <ol class="breadcrumb">
              @if(!empty($result['category_name']) and !empty($result['sub_category_name']))
              <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
              <li  class="breadcrumb-item"><a href="{{ URL::to('/shop')}}">@lang('website.Shop')</a></li>
             <li  class="breadcrumb-item"><a href="{{ URL::to('/shop?category='.$result['category_slug'])}}">{{$result['category_name']}}</a></li>
             <li  class="breadcrumb-item active">{{$result['sub_category_name']}}</li>
             @elseif(!empty($result['category_name']) and empty($result['sub_category_name']))
             <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
             <li  class="breadcrumb-item active"><a href="{{ URL::to('/shop')}}">@lang('website.Shop')</a></li>

             <li class="breadcrumb-item active">{{$result['category_name']}}</li>
             @else
             <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
             <li class="breadcrumb-item active">@lang('website.Shop')</li>
             @endif
            </ol>
      </div>
    </nav>
</div>

<section class="pro-content">
  <div class="container">
      <div class="page-heading-title">
          <h2> @lang('website.Shop')  
          </h2>
      
          </div>
  </div>
  <div class="container">
      <div class="top-bar">
          <div class="row">
            <div class="col-12 col-lg-12">
                <div class="row align-items-center">
                    <div class="col-12 col-xl-2 col-md-2 block">
                        <div class="block">
                            <label>@lang('website.Display')</label>
                            <div class="buttons">
                              <a href="javascript:void(0);" id="grid"><i class="fas fa-th-large"></i></a>
                              <a href="javascript:void(0);" id="grid4"><i class="fas fa-th"></i></a>
                              <a href="javascript:void(0);" id="list"><i class="fas fa-list"></i></a>
                            </div>
                        </div>
                    </div> 

                    <div class="col-12 col-xl-7 col-md-5 select-bar">
                        <form class="form-inline justify-content-center">
                          @if(!empty($result['categories']))
                            <div class="form-group ">
                                <label>@lang('website.Categories') </label>
                                <div class="select-control">
                                  <select class="form-control" name="category" onchange="this.form.submit()">
                                      @foreach($result['categories'] as $category)
                                      <option value="{{$category->slug}}" @if(app('request')->input('category') == $category->slug) selected @endif>{{$category->categories_name}}</option>                                      
                                          @if(isset($category->childs)){
                                            @foreach($category->childs as $cat)
                                              <option value="{{$cat->slug}}" @if(app('request')->input('category') == $cat->slug) selected @endif>-{{$cat->categories_name}}</option>
                                            @endforeach
                                          @endif
                                      @endforeach                                      
                                  </select>
                                </div>
                              
                            </div>
                            @endif
                        </form>
                          
                        
                    </div> 
                    @if($result['products']['success']==1)
                    <div class="col-12 col-xl-3 col-md-3">
                      <form class="form-inline justify-content-end" id="load_products_form">
                      <input type="hidden" name="min_price" id="min_price" value="{{$result['min_price']}}">
                      <input type="hidden" name="max_price" id="max_price" value="{{$result['max_price']}}">
                      @if(isset($_GET['price']))
                      <input type="hidden" name="price"  value="{{ $_GET['price'] }}">
                      @endif
                        @if(!empty(app('request')->input('search')))
                         <input type="hidden"  name="search" value="{{ app('request')->input('search') }}">
                        @endif
                        @if(!empty(app('request')->input('category')))
                         <input type="hidden"  name="category" value="@if(app('request')->input('category')!='all'){{ app('request')->input('category') }} @endif">
                        @endif
                         <input type="hidden"  name="load_products" value="1">
                         <input type="hidden"  name="products_style" id="products_style" value="grid">
                         <input type="hidden"  name="products_style" id="pagelayout" value="fullpage">
                          
                          <div class="form-group">
                              <label>@lang('website.Sort')</label> 
                              <div class="select-control">
                                <select name="type" id="sortbytype" class="form-control margin-top-7-mobile" >
                                  <option value="desc" @if(app('request')->input('type')=='desc') selected @endif>@lang('website.Newest')</option>
                                  <option value="atoz" @if(app('request')->input('type')=='atoz') selected @endif>@lang('website.A - Z')</option>
                                  <option value="ztoa" @if(app('request')->input('type')=='ztoa') selected @endif>@lang('website.Z - A')</option>
                                  <option value="hightolow" @if(app('request')->input('type')=='hightolow') selected @endif>@lang('website.Price: High To Low')</option>
                                  <option value="lowtohigh" @if(app('request')->input('type')=='lowtohigh') selected @endif>@lang('website.Price: Low To High')</option>
                                  <option value="topseller" @if(app('request')->input('type')=='topseller') selected @endif>@lang('website.Top Seller')</option>
                                  <option value="special" @if(app('request')->input('type')=='special') selected @endif>@lang('website.Special Products')</option>
                                  <option value="mostliked" @if(app('request')->input('type')=='mostliked') selected @endif>@lang('website.Most Liked')</option>
                                </select>
                          </div>
                          
                          <div class="form-group margin-left-6-mobile">
                              <label>@lang('website.Limit')</label> 
                              <div class="select-control">
                                <select class="form-control"name="limit" id="sortbylimit" >
                                  <option value="15" @if(app('request')->input('limit')=='15') selected @endif>15</option>
                                  <option value="30" @if(app('request')->input('limit')=='30') selected @endif>30</option>
                                  <option value="60" @if(app('request')->input('limit')=='60') selected @endif>60</option>
                                </select>
                              
                          </div>                          
                          
                    </div>  
                    @endif
                </div>
              
            </div>
          </div>
      </div>  
    </div>
  </div>
</div>
  
  <section id="swap2" class="shop-content shop-topbar shop-one" >
    <div class="container">
      <div class="products-area">
      @if($result['products']['success']==1)
      
      <div class="row justify-content-center">                        
        @if($result['categories_status'] == 1)   
            @foreach($result['products']['product_data'] as $key=>$products)   
            @if($products->product_view == 0 || $products->product_view == 1)
            <?php 
              $is_status = false;
              if(!empty($products->categories)){
                foreach($products->categories as $key=>$category){
                    if($category->categories_status == 1)
                      $is_status = true;                                         
                } 
              }

              if($is_status == true){
              ?>   
             @if($result['commonContent']['settings']['product_column'] == 1)
                                          <div class="col-12 col-md-4 col-lg-4 griding">
                                        @else
                                          <div class="col-6 col-md-4 col-lg-4  griding">
                                        @endif
              @include('web.common.product')
            </div>
              <?php }?>
            
              @endif

            @endforeach
            @else
            <div class="col-12">
            <br>
            <h3 style="text-align:center" class="mobile-mt-10">@lang('website.No Record Found!')</h3></div>
            @endif
            @include('web.common.scripts.addToCompare')            
        </div>
      @else
      <br>
      <h3 style="text-align:center" class="mobile-mt-10">@lang('website.No Record Found!')</h3>
      @endif
        
    </div>
    
    </div>  
  </section> 
  @if($result['categories_status'] == 1)
  <div class="container">
    <div class="pagination justify-content-between ">
      <input id="record_limit" type="hidden" value="{{$result['limit']}}">
      <input id="total_record" type="hidden" value="{{$result['products']['total_record']}}">
      <label for="staticEmail" class="col-form-label"> @lang('website.Showing')&nbsp;<span class="showing_record">{{$result['limit']}}</span>&nbsp;@lang('website.of')&nbsp;<span class="showing_total_record">{{$result['products']['total_record']}}</span> &nbsp;@lang('website.results')</label>
      
      <div class=" justify-content-end load_more_outer_mobile col-6">
            <input type="hidden" value="1" name="page_number" id="page_number">
        <?php
            if(!empty(app('request')->input('limit'))){
                $record = app('request')->input('limit');
            }else{
                $record = '15';
            }
        ?>
            <button class="btn btn-secondary" type="button" id="load_products"
            @if(count($result['products']['product_data']) < $record )
                style="display:none"
            @endif
            >@lang('website.Load More')</button>
        </div>
    </div>
  </div>
  @endif
</form>
@include('web.common.scripts.shop_page_load_products')
</section>

<script type="text/javascript" src="{!! asset('web/js/lazy/jquery.lazy.min.js') !!}"></script>
  <script type="text/javascript" src="{!! asset('web/js/lazy/jquery.lazy.plugins.min.js') !!}"></script> 
  <script>
  $(function() {
        $('.lazy_img_load').Lazy();
    });
  </script>

<script>
   $('.menu-active-shop > a').addClass('menu-active');
   $('.menu-actives-shop > a').addClass('menu-actives');
   $('.menu-activess-shop > a').addClass('menu-activess');
  $('.menu-active-11-shop > a').addClass('active-menu-11');
  $('.menu-active-13-shop > a').addClass('active-menu-13');
  $('.menu-active-15-shop > a').addClass('active-menu-15');
  $('.menu-active-16-shop > a').addClass('active-menu-16');
  $('.menu-active-30-shop > a').addClass('active-menu-30');
  $('.menu-active-40-shop > a').addClass('active-menu-40');
</script>