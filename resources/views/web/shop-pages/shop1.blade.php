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

ul { list-style-type: none; }


/** =======================
 * Contenedor Principal
 ===========================*/


.accordion {
  width: 100%;
  max-width: 360px;
  background: #f2f2f2;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
}
.pagination {
    margin-bottom: 30px !important;
}
.accordion .link {
  cursor: pointer;
  display: block;
  padding: 10px;
  color: #4D4D4D;
  font-size: 0.875rem;
  border: 1px solid #dee2e6;
  position: relative;
  -webkit-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  transition: all 0.4s ease;
}

.accordion li:last-child .link { border-bottom: 0; }

.accordion li i {
  position: absolute;
  top: 12px;
  left: 12px;
  font-size: 0.875rem;
  color: #595959;
  -webkit-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  transition: all 0.4s ease;
}

.accordion li i.fa-chevron-down {
  right: 12px;
  left: auto;
  font-size: 0.875rem;
}

.accordion li.open .link { color: #333; }

.accordion li.open i { color: #333; }

.accordion li.open i.fa-chevron-down {
  -webkit-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg);
}

/**
 * Submenu
 -----------------------------*/


.submenu {
  display: none;
  background: #f2f2f2;
  font-size: 0.875rem;
}

.submenu li { border-bottom: 0px solid #4b4a5e; }

.submenu a {
  display: block;
  text-decoration: none;
  color: #333;
  padding: 12px;
  padding-left: 42px;
  -webkit-transition: all 0.25s ease;
  -o-transition: all 0.25s ease;
  transition: all 0.25s ease;
}

/* .submenu a:hover {
  background: #b63b4d;
  color: #FFF;
} */

@media only screen and (max-width: 768px)
{
    .mobile-pad-15
    {
      padding-left:15px;
    }
    .mobile-pad-25
    {
      padding-left:25px;
    }
}
  </style>

  <script>
    $(function() {
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.link');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();

		$next.slideToggle();
		$this.parent().toggleClass('open');

		if (!e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		};
	}	

	var accordion = new Accordion($('#accordion'), false);
});


$(function() {
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.link');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();

		$next.slideToggle();
		$this.parent().toggleClass('open');

		if (!e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		};
	}	

	var accordion = new Accordion($('#accordionbrand'), false);
});

</script>

<!-- Shop Page One content -->
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
                  <h2 class="h2-filter"> @lang('website.Shop')  
                  

                  <div class="menu-icons common-color"><i class="fa fa-filter common-color" aria-hidden="true"></i> Filter</div> </h2>
              
                  </div>
          </div>
          
          <section class="shop-content shop-two">
                  
            <div class="container">
                <div class="row">
                  <div class="col-12 col-lg-3  d-lg-block d-xl-block right-menu"> 
                <div class="filter-background">  </div>
                  <div class="menu-wrapper show">
            <div class="menu-icon-wrapper">
               <a href="" class="menu-icon"></a>
            </div>
            <div class="shop-side-scroll">
              <h2 class="filter-hide-m common-color">Search Filter</h2>
            <div id="profile-description" class="right-menu-categories">
                    <div class="text show-more-height">
                    <h2 style="padding: 10px 0;font-size: 1.2rem;">Category </h2>
                    <ul id="accordion" class="accordion">

                       @include('web.common.shopCategories')
                       @php    shopCategories(); @endphp 
</ul>
                     </div>
                     <div class="show-more common-hover" style="width:90%; margin:auto;">(Show More)</div>
                     </div>

                     {{-- Hide filters if record does not exist --}}

  
                    @if(!empty($result['categories']))
                    <form enctype="multipart/form-data" name="filters" id="side-filter-test" method="get">
                    <input type="hidden" name="min_price" id="min_price" value="{{$result['min_price']}}">
                    <input type="hidden" name="max_price" id="max_price" value="{{$result['max_price']}}">
                    @if(app('request')->input('category'))
                      <input type="hidden" name="category" value="{{app('request')->input('category')}}">
                    @endif
                    @if(app('request')->input('filters_applied')==1)
                    <input type="hidden" name="filters_applied" id="filters_applied" value="1">
                    <input type="hidden" name="options" id="options" value="<?php echo implode(',',$result['filter_attribute']['options'])?>">
                    <input type="hidden" name="options_value" id="options_value" value="<?php echo implode(',' , $result['filter_attribute']['option_values'])?>">
                    @else
                    <input type="hidden" name="filters_applied" id="filters_applied" value="0">
                    @endif

                          
               <div class="range-slider-main" >
                 <h2>@lang('website.Price Range') </h2>
                 <div class="wrapper">
                     <div class="range-slider">
                         <input onChange="getComboA(this)" name="price" type="text" class="js-range-slider" value="" />
                     </div>
                     <div class="extra-controls form-inline">
                       <div class="form-group">
                           <span>
                             @if(session('symbol_left') != null)
                             <font>{{session('symbol_left')}}</font>
                             @else
                             <font>{{session('symbol_right')}}</font>
                             @endif
                                 <input type="text"  class="js-input-from form-control" value="0" />
                           </span>
                               <font>-</font>
                               <span>
                                 @if(session('symbol_left') != null)
                                 <font>{{session('symbol_left')}}</font>
                                 @else
                                 <font>{{session('symbol_right')}}</font>
                                 @endif
                                   <input  type="text" class="js-input-to form-control" value="0" />
                                   <input  type="hidden" class="maximum_price" value="{{$result['filters']['maxPrice']}}">
                                   </span>
                     </div>
                       </div>
                 </div>
               </div>   
               
               
               
               @include('web.common.scripts.slider')
                     @if(count($result['filters']['attr_data'])>0)
                     @foreach($result['filters']['attr_data'] as $key=>$attr_data)
                     <?php $str = $attr_data['option']['name'];
                              $new_str = str_replace(' ', '', $str);?>

                     <div class="option-outer-tg color-range-main">
                     <div class="option-text option-text{{$new_str}}  option-show-more-height{{$new_str}} option-show-more-height">
                       <h1 @if(count($result['filters']['attr_data'])==$key+1) last @endif>{{$attr_data['option']['name']}}</h1>
                         <div class="block">
                                <div class="card-body">
                                 <ul class="list" style="list-style:none; padding: 0px;">
                                     @foreach($attr_data['values'] as $key=>$values)
                                     <li >
                                         <div class="form-check">
                                           <label class="form-check-label">
                                             <input class="form-check-input filters_box" name="{{$attr_data['option']['name']}}[]" type="checkbox" value="{{$values['value']}}" 								 									<?php
                                             if(!empty($result['filter_attribute']['option_values']) and in_array($values['value_id'],$result['filter_attribute']['option_values'])) print 'checked';
                                             ?>>
                                             {{$values['value']}}
                                           </label>
                                         </div>
                                     </li>
                                     @endforeach
                                 </ul>
                             </div>
                         </div>
  
                       </div>
                      
                       @if(count($attr_data['values'])>5)
                      
                     
                       <div id="{{$new_str}}" class="common-hover option-show-more option-show-more{{$new_str}}">(Show More)</div>
                       @endif
                       </div>
                     @endforeach
                     @endif
                     <div class="color-range-main btn-fixed-bottom-outer">
  
                     <div class="alret alert-danger" id="filter_required">
                     </div>
  
                     <div class="button">
                     <?php
                 $url = '';
                       if(isset($_REQUEST['category'])){
                   $url = "?category=".$_REQUEST['category'];
                   $sign = '&';
                 }else{
                   $sign = '?';
                 }
                 if(isset($_REQUEST['search'])){
                   $url.= $sign."search=".$_REQUEST['search'];
                 }
               ?>
                   <a href="{{ URL::to('/shop')}}" class="btn btn-dark btn-fixed-inner" id="apply_options"> @lang('website.Reset') </a>
                      @if(app('request')->input('filters_applied')==1)
                        <button type="button" class="btn btn-secondary btn-fixed-inner" id="apply_options_btn"> @lang('website.Apply')</button>
                     @else
                   <!--<button type="button" class="btn btn-secondary" id="apply_options_btn" disabled> @lang('website.Apply')</button>-->
                     <button type="button" class="btn btn-secondary btn-fixed-inner" id="apply_options_btn" > @lang('website.Apply')</button>
                     @endif
                 </div>
               </div>
                     @if(count($result['commonContent']['homeBanners'])>0)
                      @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                         @if($homeBanners->type==127)
                         <div class="img-main">
                             <a href="{{ $homeBanners->banners_url}}" >
                             @if($homeBanners->image_path_type == 'aws')
                               <img class="img-fluid" src="{{$homeBanners->path}}">
                               @else
                               <img class="img-fluid" src="{{asset('').$homeBanners->path}}">
                               @endif
                              </a>
                         </div>
                       @endif
                      @endforeach
                     @endif
               </form>
               @endif
                    
  
              @if(!empty($result['commonContent']['manufacturers']) and count($result['commonContent']['manufacturers'])>0)
                <div class="range-slider-main">
                  <ul id="accordionbrand" class="accordion">
                    <li>
                      <div class="link">@lang('website.Brands')<i class="fa fa-chevron-down"></i></div>
                      <ul class="submenu">
                        @foreach ($result['commonContent']['manufacturers'] as $item)
                          <li><a class="common-hover" href="{{ URL::to('/shop?brand='.$item->manufacturer_name)}}"><span  class="fa">&#xf105;</span> {{$item->manufacturer_name}}</a></li>
                        @endforeach
                      </ul>
                    </li>
                  </ul>
                </div>
              @endif 
              
                </div>
              
               
  <!--           <ul class="menu">
                <li><a href=""><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href=""><i class="fab fa-html5"></i> HTML</a></li>
                <li><a>
                    <i class="fab fa-css3-alt"></i> CSS <span class='cavet'><i class="fas fa-caret-right"></i></span></a>
                    <ul>
                        <li><a href=""><i class="fas fa-mobile"></i> Bootstrap</a></li>
                        <li><a href=""><i class="fas fa-glasses"></i> Semantic UI</a></li>
                    </ul>
                </li>
                <li><a href=""><i class="fab fa-php"></i> PHP</a></li>
                <li><a href=""><i class="fas fa-database"></i> Mysql</a></li>
                <li>
                    <a><i class="fab fa-js"></i> Javascript <span class='cavet'><i class="fas fa-caret-right"></i></span></a>
                    <ul>
                        <li><a href=""><i class="fab fa-vuejs"></i> Vue</a></li>
                        <li>
                            <a><i class="fab fa-react"></i> React <span class='cavet'><i class="fas fa-caret-right"></i></span></a>
                            <ul>
                                <li><a href=""><i class="fas fa-mobile"></i> React Native</a></li>
                                <li><a href=""><i class="fas fa-glasses"></i> React Augmented</a></li>
                            </ul>
                        </li>
                        <li><a href=""><i class="fab fa-angular"></i> Angular</a></li>
                    </ul>
                </li>
            </ul> -->
        </div>


  
              </div>
                  <div class="col-12 col-lg-9">
                    @if($result['products']['success']==1)
                      <div class="products-area">
                        <div class="top-bar">
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-lg-6">
                                          <div class="block">
                                              <label>@lang('website.Display')</label>
                                              <div class="buttons">
                                                <a href="javascript:void(0);" id="grid"><i class="fas fa-th-large"></i></a>
                                                <a href="javascript:void(0);" id="grid4"><i class="fas fa-th"></i></a>
                                                <a href="javascript:void(0);" id="list"><i class="fas fa-list"></i></a>
                                                </div>
                                          </div>
                                        </div> 
                                        <div class="col-12 col-lg-6">
                                          
  
                                          <form class="form-inline justify-content-end" id="load_products_form">
                                          <input type="hidden" name="min_price"  value="{{$result['min_price']}}">
                                          <input type="hidden" name="max_price"  value="{{$result['max_price']}}">
                                          @if(isset($_GET['price']))
                                          <input type="hidden" name="price"  value="{{ $_GET['price'] }}">
                                          @endif
                                            <input type="hidden" value="1" name="page_number" id="page_number">
                                            @if(!empty(app('request')->input('search')))
                                             <input type="hidden"  name="search" value="{{ app('request')->input('search') }}">
                                            @endif
                                            @if(!empty(app('request')->input('category')))
                                             <input type="hidden"  name="category" value="@if(app('request')->input('category')!='all'){{ app('request')->input('category') }} @endif">
                                            @endif
                                             <input type="hidden"  name="load_products" value="1">
  
                                             <input type="hidden"  name="products_style" id="products_style" value="grid">

                                            
                                            <div class="form-group">
                                                <label class="mobile-pad-25">@lang('website.Sort')</label>
                                                <div class="select-control">
                                                <select name="type" id="sortbytype" class="form-control">
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
                                              </div>
  
               
                                              
                                              <div class="form-group">
                                                <label class="mobile-pad-15">@lang('website.Limit')</label>
                                                <div class="select-control">
                                                  <select class="form-control"name="limit"id="sortbylimit">
                                                    <option value="15" @if(app('request')->input('limit')=='15') selected @endif>15</option>
                                                    <option value="30" @if(app('request')->input('limit')=='30') selected @endif>30</option>
                                                    <option value="60" @if(app('request')->input('limit')=='60') selected @endif>60</option>
                                                  </select>
                                                  </div>
                                                </div>
                      
                                                 
                                              </div>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                       
                        <section id="swap" class="shop-content" >
                              <div class="products-area">
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
                                          <div class="col-12 col-lg-4 col-md-4 col-sm-6 griding">
                                        @else
                                          <div class="col-6 col-lg-4 col-md-4  col-sm-6 griding">
                                        @endif
                                   
                                      
                                        @include('web.common.product')
                                      </div>
                                        <?php }?>
                                        @endif

                                      @endforeach
                                      
                                    @else
                                    @if($result['commonContent']['settings']['product_column'] == 1)
                                          <div class="col-12 col-lg-4 col-md-4  col-sm-6 griding">
                                        @else
                                          <div class="col-6 col-lg-4 col-md-4  col-sm-6 griding">
                                        @endif
                                    <br>
                                    <h3 style="text-align:center" class="mobile-mt-10">@lang('website.No Record Found!')</h3></div>
                                    @endif
                                    @include('web.common.scripts.addToCompare')
                                      
                                  </div>
                              </div> 
                        </section>  
                      </div>
                      
                      @if($result['categories_status'] == 1)
                        <div class="pagination justify-content-between ">
                              <input id="record_limit" type="hidden" value="{{$result['limit']}}">
                              <input id="total_record" type="hidden" value="{{$result['products']['total_record']}}">
                              <label for="staticEmail" class="col-form-label"> @lang('website.Showing')&nbsp;<span class="showing_record">{{$result['limit']}}</span>&nbsp;@lang('website.of')&nbsp;<span class="showing_total_record">{{$result['products']['total_record']}}</span> &nbsp;@lang('website.results')</label>
                              
                            <div class=" justify-content-end load_more_outer_mobile col-6">
                              
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
                      @endif
                    @else
                    <h3 style="text-align:center" class="mobile-mt-10">@lang('website.No Record Found!')</h3>
                    @endif
                  </form>
  
                  </div>
              
                                
  
                  </div>
                </div>
              
            </div>
            @include('web.common.scripts.shop_page_load_products')
        </section> 
     
    </section>
    
   </section>
  
  
<script>
  $('.menu-active-shop > a').addClass('menu-active');
</script>


<style>


.option-outer-tg {
  max-width: 400px; 
  margin-top: 50px; 
  position:relative;
}
.option-outer-tg .option-text {
/*   width: 660px;  */
  margin-bottom: 5px; 
  color: #777; 
  padding: 0; 
  position:relative; 
  font-family: Arial; 
  font-size: 14px; 
  display: block;
}
.option-outer-tg .option-show-more {
/*   width: 690px;  */
  color: #777; 
  position:relative; 
  font-size: 12px; 
  padding: 5px; 
 
  text-align: center; 
  background: #f1f1f1; 
  cursor: pointer;
}

.option-outer-tg .option-show-more-height { 
  max-height: 105px; 
  overflow:hidden; 
  padding: 0;
}
.menu-wrapper .card-body
{
  padding: 0;
  padding-top: 5px;
}
.right-menu .menu-wrapper .color-range-main {
    padding: 5px 15px;
    margin-top: 10px;
    padding-bottom: 15px;
}

.range-slider-main {
    padding: 5px 15px 10px 15px;
    margin-top: 15px;
    margin-bottom: 15px;
}
.color-range-main h1 {
    font-size: 0.875rem;
    margin: 0;
    font-weight: 700;
    color: black;
}

#profile-description {
  max-width: 400px; 
  margin-top: 50px; 
  position:relative;
}
#profile-description .text {
/*   width: 660px;  */
  margin-bottom: 5px; 
  color: #777; 
  padding: 0 15px; 
  position:relative; 
  font-family: Arial; 
  font-size: 14px; 
  display: block;
}
#profile-description .show-more {
/*   width: 690px;  */
  color: #777; 
  position:relative; 
  font-size: 12px; 
  padding: 5px;  
  text-align: center; 
  background: #f1f1f1; 
  cursor: pointer;
}

#profile-description .show-more-height { 
  height: 212px; 
  overflow:hidden; 
}





.filter-hide-m
{
  display: none;
 margin: 15px;
 font-size : 20px;
 padding-top: 85px;
    margin-top: 0;
}
}

.fa-filter {
    font-size: 24px;
   
}
.h2-filter
{
  position: relative;
}
.menu-icons {
    position: absolute;
    right: 0;
    top: 6px;
    font-size: 14px;
  
    display: none;
}



.menu-wrapper {
    background-color: #fff;
    position: relative;
    top: -50px;
    right: -100%;
    bottom: 0;
    z-index: 1;
     /* overflow-y: auto;  */
}


.closeNavIcon-responsive {
    display: inline-block;
}

@keyframes move-sidebar {
    from {
        transform: translateX(100%);
    }
    to {
        transform: translateX(0%);
    }
}

@keyframes move-sidebar-inside {
    from {
        transform: translateX(0%);
    }
    to {
        transform: translateX(100%);
    }
}



.menu {
    font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
    font-size: 16px;
}

.menu li {
    display: block;
    position: relative;
}

.menu li ul {
    background-color: #ec5539;
    box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.1);
    overflow: hidden;
    height: 0;
}

.menu li.active>ul {
    height: initial;
}

.menu a {
    color: #DDD;
    text-decoration: none;
    padding: 10px 5px;
    display: block;
    position: relative;
}

.menu a:hover,
.menu a:hover>i:first-child,
.menu li.active>a,
.menu li.active>a i {
    background-color: gold;
    color: #000;
}

.menu a .cavet {
    position: absolute;
    right: 10px;
    transform: rotate(0deg);
    transition: transform 0.5s;
    display: inline-block;
    width: 20px;
}

.menu li.active>a .cavet {
    transform: rotate(90deg);
}

.menu li+li a {
    border-top: 1px solid #ec5539;
}

.menu a i {
    display: inline-block;
    padding-right: 10px;
    text-align: center;
    width: 20px;
    color: #fff;
}

.menu,
.menu ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

::selection {
    background-color: none;
}

/* menu animated icon */
.menu-icon, .menu-icon:before, .menu-icon:after{
    display: inline-block;
    background-color: rgb(255, 255, 255);
    height: 5px;
    width: 30px;
    transition: transform 0.5s cubic-bezier(.01,.87,.36,.99);
    transform-origin: left;
    border-radius: 2px;
}

.menu-icon:before, .menu-icon:after{
    content: "";
    position: absolute;
    left: 0;
}

.menu-icon{
    position: relative;
    transition: background-color 5;
    animation: fadeIn 1s cubic-bezier(.01,.87,.36,.99) 0s 1 normal forwards;
}

.menu-icon:before{
    top: 210%;
}

.menu-icon:after{
    bottom: 210%;
}

.menu-icon.active{
    animation: fadeOut 0.5s cubic-bezier(.01,.87,.36,.99) 0s 1 normal forwards;
}

@keyframes fadeOut{
    from{background-color: rgb(255, 255, 255);}
    to{background-color: rgba(255, 255, 255, 0);}
}

@keyframes fadeIn{
    from{background-color: rgba(255, 255, 255, 0);}
    to{background-color: rgb(255, 255, 255);}
}

.menu-icon.active:before{
    transform: rotate(-45deg);
}

.menu-icon.active:after{
    transform: rotate(45deg);
}

.menu-wrapper{

}

.menu-icon-wrapper{
    display: none;
    height: 40px;
    position: relative;
    top: 38px;
    width: 50px;
    background: Tomato;
    position: absolute;
    left: 100%;
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px;
}

.menu-icon-wrapper a{
   margin-top: 18px;
   margin-left: 10px;
}
.menu-wrapper.show {
    right: 0;
  
}

.menu-wrapper.hide {
    right: 0;
    
}

@media only screen and (max-width: 768px)
{
  .filter-hide-m
{
  display: block;
}
#profile-description {
    margin-top: 0px; 
}
  .menu-icon-wrapper{
    display: none;
}
.menu-wrapper {
  width: 50% ;
   z-index: 150;
}
.menu-wrapper.show {
    right: 0;
    animation: move-sidebar .5s cubic-bezier(.4,0,.6,1);
    transition: -webkit-transform .5s cubic-bezier(.4,0,.6,1);
    transition: transform .5s cubic-bezier(.4,0,.6,1);
    transition: transform .5s cubic-bezier(.4,0,.6,1),-webkit-transform .5s cubic-bezier(.4,0,.6,1);
}

.menu-wrapper.fullhide {
    right: 0;
    display: none;
}

.menu-wrapper.hide {
    right: 0;
    animation: move-sidebar-inside .5s cubic-bezier(.4,0,.6,1) 1 normal forwards;
    transition: -webkit-transform .5s cubic-bezier(.4,0,.6,1);
    transition: transform .5s cubic-bezier(.4,0,.6,1);
    transition: transform .5s cubic-bezier(.4,0,.6,1),-webkit-transform .5s cubic-bezier(.4,0,.6,1);
}
.right-menu .btn-fixed-inner {
    width: 49%;
    padding: 1rem 1.8rem !important;
}
.right-menu .btn-fixed-bottom-outer {
    position: fixed;
    bottom: 0;
    width: 50%;
    padding: 5px 10px;
    z-index: 200;
    background: #fff;
}
.range-slider-main {
    margin-bottom: 15px;
}
.filter-background.active{
    display: block;
    z-index: 99;
}

.menu-icons {
    display: block;
}


.filter-background {
    position: fixed;
    background: rgba(0,0,0,.4);
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    display:none;
}
.menu-wrapper {
    position: fixed;
    height: 100%;
    background-color: transparent;
}
.shop-side-scroll
{
  overflow-y: scroll;
  height: 100%;

  background-color: #fff;
}
}

@media only screen and (max-width: 568px)
{

.menu-wrapper {
  width: 250px ;
}
.right-menu .btn-fixed-bottom-outer {
  
    width: 250px ;
    
}
}



</style>
<script type="text/javascript" src="{!! asset('web/js/lazy/jquery.lazy.min.js') !!}"></script>
  <script type="text/javascript" src="{!! asset('web/js/lazy/jquery.lazy.plugins.min.js') !!}"></script> 
  <script>
  $(function() {
        $('.lazy_img_load').Lazy();
    });
  </script>


<script>

$(".option-show-more").click(function () {
  $id= $(this).attr('id');
  
        if($(".option-text"+$id).hasClass("option-show-more-height"+$id)) {
            $(this).text("(Show Less)");
        } else {
            $(this).text("(Show More)");
        }

        $(".option-text"+$id).toggleClass("option-show-more-height");
    });


$(".show-more").click(function () {
        if($(".text").hasClass("show-more-height")) {
            $(this).text("(Show Less)");
        } else {
            $(this).text("(Show More)");
        }

        $(".text").toggleClass("show-more-height");
    });

$(".menu li").click(function(event){
            event.stopPropagation(); //stop trigger parent
            var el = $(this).parents("li").siblings();
            el = el.length == 0 ? $(this).siblings() : el;
            el.find(".active").addBack().removeClass("active");

            if ( $(this).hasClass("active") ){
                $(this).find(".active").addBack().removeClass("active");
            } else{
                $(this).addClass("active");
            }
        });

        // responsive menu for mobile and tablet
        var responsive = function(){
            var s = 768;
           /*  $(window).resize(function(){
                windowSize(s);
            }); */
            windowSize(s);
        }

        var windowSize = function(s){
            var w = $(window).width();
            if ( w <= s ){
                $(".menu-icon").removeClass("active");
                $(".menu-wrapper").addClass("fullhide").removeClass("show");
                $(".filter-background").removeClass("active");            
            } else{
                $(".menu-icon").addClass("active");
                $(".menu-wrapper").addClass("show").removeClass("fullhide");
                $(".filter-background").addClass("active");  
            }
        }
        
        responsive();
        
        $(".menu-icon").click(function(e){
             e.preventDefault();
             $(this).toggleClass("active");

             //set default
            //$(this).parents(".menu-wrapper").addClass("hide").removeClass("show");

            if ( $(this).hasClass("active") ){
                $(this).parents(".menu-wrapper").addClass("show").removeClass("fullhide").removeClass("hide");
                
            } else{
                $(this).parents(".menu-wrapper").addClass("hide").removeClass("show");
            }
        });

        $(".menu-icons").click(function(e){
          $(".menu-wrapper").addClass("show").removeClass("fullhide").removeClass("hide");               
          $(".filter-background").addClass("active");               
          $("body").addClass("body-overflow");               
        });

        $(".filter-background").click(function(e){
          $(".menu-wrapper").addClass("hide").removeClass("show"); 
          $(".filter-background").removeClass("active");   
          $("body").removeClass("body-overflow");                 
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