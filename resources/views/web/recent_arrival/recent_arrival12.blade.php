<style>

ul { list-style-type: none; }
.stroke-color
{
  stroke: #111;
}
.ra12 .row{
  margin-left:-10px;
  margin-right:-10px;
}
.quick-fill:hover
{
  fill: #fff !important;
}
.ra12 .product-molla {
    margin-top: 0px;
    margin-bottom:20px;
}
.ra12 .products-area .col-lg-3 {
    padding-right: 10px !important;
    padding-left: 10px !important;
}
.rarrival12 .irs-bar {
    height: 2px;
    top: 18px !important;
    border-top: 1px solid #333 !important;
    border-bottom: 1px solid #333 !important;
    background: #333;
}
.rarrival12 .irs-line {
    height: 2px;
    top: 18px !important;
    background: none; 
    background: none;
    border: 1px solid #CCC;
    border-radius: 16px;
    -moz-border-radius: 16px;
}


.rarrival12 .irs-slider:focus {
    -webkit-box-shadow: 0 0 0 5px rgb(63 81 181 / 20%);
    box-shadow: 0 0 0 5px rgb(63 81 181 / 20%);
}

.rarrival12 .irs-slider:active {
    -webkit-transform: scale(1.3);
    transform: scale(1.3);
}
.rarrival12 .irs-slider {
   
    border: 1px solid #333;
   
    box-shadow: unset;
    cursor: pointer;
}
.rarrival12 .col-lg-3 {
    flex: 0 0 25%;
    max-width: 24.5%;
    display:inline-block;
    vertical-align:top;
}
.product-molla-28 article .thumb {
    height: 278px;
    overflow: hidden;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0;
    position: relative;
    background: #e3e3e3;
}
.prora12{
  padding-top: 20px !important;
}

.pbc-2-title{
  font-size:16px;
  font-weight:400 !important;
  display:inline-block;
}

.page-heading-title {
    margin-top: -7px;
    padding-bottom: 15px;
}

.btntab12 {
  color: #777;
  padding: 0px 10px;
  text-decoration: none;
  margin: 5px;
  display:inline-block;
  cursor:pointer;
  font-size:1rem;
  text-transform:uppercase;
}
.dd-none{
    display:none;
  }

  .menucate{
    display:inline-block;
    width:93%;
    text-align:right;
  }
  .hitter{
    display:none;
  }
  .filter-hide{
    display:none;
  }
  .contentdata{
    display:none;
  }

  .prora12 .col-lg-12{
    padding-left:5px;
    padding-right:5px;
  }

  .right-menu .color-range-main {
    border-top: 1px solid #dee2e6 !important;
    border: none;
    }

  .range-slider-main {
    border-top: 1px solid #dee2e6 !important;
    border: none;
  }

  .demo-11-recent-btn
  {
    padding: 12px 20px;
    border: 0.1rem solid #d7d7d7;
    letter-spacing: 0px;
    font-weight: 400 !important;
  }

  .demo-11-recent-btn:hover
  {
    border: 0.1rem solid;
  }

@media screen and (max-width:992px){

  .rarrival12 .col-lg-3 {
      flex: 0 0 100%;
      max-width: 100%;
      display: inline-block;
      vertical-align: top;
      padding-right: 0px !important;
    padding-left: 0px !important;
  }
  .ra12 .products-area .col-lg-3 {
    padding-right: 5px !important;
    padding-left: 5px !important;
  }
  .rarrival12 .right-menu .btn-fixed-inner {
    width: 100%;
    padding: 0.5rem 1.8rem !important;
  }
  .filter-container .col-lg-3 {
      flex: 0 0 50%;
      max-width: 50%;
      display: inline-block;
      vertical-align: top;
  }

  .menucate {
    display: inline-block;
    width: 85%;
    text-align: right;
}



.dd-none{
    display:block;
    border:none;
  }
 
  .prora12 .col-lg-12 {
    padding-left: 15px;
    padding-right: 15px;
}

}

@media screen and (max-width:700px){

  .md-none{
    display:none;
  }
  .dd-none{
    display:block;
    border:none;
  }
  .menu-icons {
    position: fixed !important;
    left: 0;
    right:auto !important;
    top: 50% !important;
    font-size: 16px;
    display: none;
    background: rgba(0,0,0,.2);
    padding: 4px 8px;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
    z-index: 99;
  }
  
  hr {
    margin-top: 0rem;
    margin-bottom: 0rem;
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
  }
 
  .page-heading-title {
    margin-top: -7px;
    padding-bottom: 10px;
  }
  .menucate {
    display: inline-block;
    width: 100%;
    text-align: center;
  }

}

/** =======================
 * Contenedor Principal
 ===========================*/


.accordion {
  width: 100%;
  max-width: 360px;

}

.accordion .link {
  cursor: pointer;
  display: block;
  padding: 10px;
  color: #4D4D4D;
  font-size: 0.875rem;
  border: 0px solid #dee2e6;
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


   
      
    <section class="pro-content prora12" id="allsec">
          <div class="container">
              <div class="page-heading-title">
                <div class="pbc-2-header">
                  <h2 class="pbc-2-title filter-show md-none filter-ipad-show common-text" style="margin-left:5px;text-align:left;text-transform:initial;cursor:pointer"><i class="fa fa-bars"></i> &nbsp;Filters</h2>
                  <h2 class="pbc-2-title filter-hide md-none filter-ipad-show common-text" style="margin-left:5px;text-align:left;text-transform:initial;cursor:pointer"><i class="fa fa-close"></i> &nbsp;Filters</h2>

                  <div class="menu-icons common-color"><i class="fa fa-cog" style="color:#fff" aria-hidden="true"></i></div>
                  <div class="hitter btntab12 common-text md-none" style="text-transform:initial;float:right"><a href="{{ URL::to('/')}}" class="common-text" id="apply_options"> Clean All </a></div>
                    <div class="menucate">
                      <div class="cateactive btntab12" id="all">All</div>
                      <?php 
                        foreach ($result1['category_section'] as $item)
                        {
                            if($item->products['success']==1)
                            {
                              ?>
                               <a href="filter_index?category={{ $item->categories_slug }}"><div class="btntab12" id="{{ $item->categories_name }}"> {{ $item->categories_name }}</div></a>
                           <?php }
                        }
                      ?>
                      </div>
                  </div>
              </div>
          </div>
          
          <section class="shop-content shop-two rarrival12">
                  
            <div class="container">
              <div class="row">
                <div class="col-12 col-lg-12  right-menu contentdata"> 
                  <div class="menu-wrapper show">
                    <div class="shop-side-scroll">

                     
                    <div class="btntab12 common-text dd-none" style="text-transform:initial;font-size:16px">
                      <a href="{{ URL::to('/')}}" class="common-text" id="apply_options"> Clean All </a>
                      <i class="fa fa-close hidefilter" style="float:right;margin-top:8px"></i>
                    </div>
                    <hr class="dd-none">
  
                    @if(!empty($result1['categories']))
                    <form enctype="multipart/form-data" name="filters" id="side-filter-test" method="get">
                      <input type="hidden" name="min_price" id="min_price" value="{{$result1['min_price']}}">
                      <input type="hidden" name="max_price" id="max_price" value="{{$result1['max_price']}}">
                        @if(app('request')->input('category'))
                          <input type="hidden" name="category" value="{{app('request')->input('category')}}">
                        @endif
                        @if(app('request')->input('filters_applied')==1)
                          <input type="hidden" name="filters_applied" id="filters_applied" value="1">
                          <input type="hidden" name="options" id="options" value="<?php echo implode(',',$result1['filter_attribute']['options']); ?>">
                          <input type="hidden" name="options_value" id="options_value" value="<?php echo implode(',',$result1['filter_attribute']['option_values']); ?>">
                        @else
                          <input type="hidden" name="filters_applied" id="filters_applied" value="0">
                        @endif

                        <div class="col-lg-3">
                        <div id="profile-description" class="right-menu-categories">
                          <div class="text show-more-height">
                            <h2 style="padding: 10px;font-size: 1.15rem;font-weight:600 !important">Category :</h2>
                            <ul id="accordion" class="accordion">
                              @include('web.common.indexfilterCategories')
                              @php    recentCategories(); @endphp 
                            </ul>
                          </div>
                          <div class="show-more common-hover" style="width:90%; margin:auto;">(Show More)</div>
                        </div>
                      </div>

                      <div class="col-lg-3">      
                        <div class="range-slider-main" style="border-bottom:0px solid !important">
                          <h2 style="padding: 10px 0;font-size: 1.15rem;font-weight:600 !important">@lang('website.Price Range') : </h2>
                            <div class="wrapper">
                              <div class="range-slider">
                                  <input onChange="getComboA(this)" name="price" type="text" class="js-range-slider1" value="" />
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
                                        <span>@if(session('symbol_left') != null)
                                          <font>{{session('symbol_left')}}</font>
                                          @else
                                          <font>{{session('symbol_right')}}</font>
                                          @endif
                                            <input  type="text" class="js-input-to form-control" value="0" />
                                            <input  type="hidden" class="maximum_price" value="{{$result1['filters']['maxPrice']}}">
                                            </span>
                              </div>
                            </div>
                          </div>
                        </div>   
                      </div>   
                     
               
                    @if(count($result1['filters']['attr_data'])>0)
                      @foreach($result1['filters']['attr_data'] as $key=>$attr_data)
                      <?php
                        $str = $attr_data['option']['name'];
                        $new_str = str_replace(' ', '', $str);
                      ?>
                      <div class="col-lg-3">
                        <div class="option-outer-tg color-range-main" style="border-bottom:0px solid !important">
                          <div class="option-text option-text{{$new_str}}  option-show-more-height{{$new_str}} option-show-more-height">
                              <h1 style="padding: 10px 0;font-size: 1.15rem;font-weight:300 !important" @if(count($result1['filters']['attr_data'])==$key+1) last @endif>{{$attr_data['option']['name']}} : </h1>
                                <div class="block">
                                  <div class="card-body">
                                    <ul class="list" style="list-style:none; padding: 0px;">
                                     @foreach($attr_data['values'] as $key=>$values)
                                     <li >
                                         <div class="form-check">
                                           <label class="form-check-label">
                                             <input class="form-check-input filters_box" name="{{$attr_data['option']['name']}}[]" type="checkbox" value="{{$values['value']}}" 								 									<?php if (
                                                 !empty(
                                                     $result1[
                                                         'filter_attribute'
                                                     ]['option_values']
                                                 ) and
                                                 in_array(
                                                     $values['value_id'],
                                                     $result1[
                                                         'filter_attribute'
                                                     ]['option_values']
                                                 )
                                             ) {
                                                 print 'checked';
                                             } ?>>
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
                      </div>
                     @endforeach
                    @endif
                     <div class="color-range-main btn-fixed-bottom-outer">
                      <div class="alret alert-danger" id="filter_required">
                     </div>
  
                     <div class="button">
                     <?php
                      $url = '';
                      if (isset($_REQUEST['category'])) {
                          $url = '?category=' . $_REQUEST['category'];
                          $sign = '&';
                      } else {
                          $sign = '?';
                      }
                      if (isset($_REQUEST['search'])) {
                          $url .= $sign . 'search=' . $_REQUEST['search'];
                      }
                     ?>
                      @if(app('request')->input('filters_applied')==1)
                        <button type="button" class="btn btn-secondary btn-fixed-inner" id="apply_options_btn"> @lang('website.Apply')</button>
                     @else
                   <!--<button type="button" class="btn btn-secondary" id="apply_options_btn" disabled> @lang('website.Apply')</button>-->
                     <button type="button" class="btn btn-secondary btn-fixed-inner" id="apply_options_btn" > @lang('website.Apply')</button>
                     @endif
                 </div>
               </div>
                    
               </form>
               @endif
                    
  
            
              
                </div>
              
       
        </div>


  
              </div>
                  <div class="col-12 col-lg-12 filter-container">
                    @if($result1['products']['success']==1)
                      <div class="products-area">
                        <div class="top-bar" style="display:none">
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="row align-items-center">
                                        <!-- <div class="col-12 col-lg-6">
                                          <div class="block">
                                              <label>@lang('website.Display')</label>
                                              <div class="buttons">
                                                <a href="javascript:void(0);" id="grid"><i class="fas fa-th-large"></i></a>
                                                <a href="javascript:void(0);" id="grid4"><i class="fas fa-th"></i></a>
                                                <a href="javascript:void(0);" id="list"><i class="fas fa-list"></i></a>
                                                </div>
                                          </div>
                                        </div>  -->
                                        <div class="col-12 col-lg-6">
                                          
  
                                          <form class="form-inline justify-content-end" id="load_products_form">
                                          <input type="hidden" name="min_price"  value="{{$result1['min_price']}}">
                                          <input type="hidden" name="max_price"  value="{{$result1['max_price']}}">
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

                                            
                                            <div class="form-group" >
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
                                                    <option value="8" @if(app('request')->input('limit')=='8') selected @endif>8</option>
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
                       
                        <section id="swap" class="shop-content ra12">
                              <div class="products-area">
                                <div id="parent" class="row justify-content-center">  
                                  
                                      @if($result1['categories_status'] == 1)
                                        @foreach($result1['products']['product_data'] as $key=>$products)    

                                          <?php
                                          $is_status = false;
                                          if (!empty($products->categories)) {
                                              foreach (
                                                  $products->categories
                                                  as $key => $category
                                              ) {
                                                  if (
                                                      $category->categories_status ==
                                                      1
                                                  ) {
                                                      $is_status = true;
                                                  }
                                              }
                                          }

                                          if ($is_status == true) { ?>

                                            @if($result1['commonContent']['settings']['product_column'] == 1)
                                              <div class="Cate {{ $category->categories_id }} col-12 col-lg-3 col-md-4 col-sm-6 griding">
                                            @else
                                              <div class="Cate {{ $category->categories_id }} col-6 col-lg-3 col-md-4  col-sm-6 griding">
                                            @endif
                                    
                                        
                                          @include('web.common.product')
                                  </div>
                                        <?php }
                                      ?>

                                      @endforeach
                                    @else
                                    @if($result1['commonContent']['settings']['product_column'] == 1)
                                          <div class="Cate {{ $category->categories_id }} col-12 col-lg-3 col-md-4  col-sm-6 griding">
                                        @else
                                          <div class="Cate {{ $category->categories_id }} col-6 col-lg-3 col-md-4  col-sm-6 griding">
                                        @endif
                                    <br>
                                    <h3 style="text-align:center" class="mobile-mt-10">@lang('website.No Record Found!')</h3></div>
                                    @endif
                           
                                    @include('web.common.scripts.addToCompare')
                                      
                                  </div>
                              </div> 
                        </section>  
                      </div>
                      
                      @if($result1['categories_status'] == 1)
                        <div class="pagination justify-content-between ">
                              <input id="record_limit" type="hidden" value="{{$result1['limit']}}">
                              <input id="total_record" type="hidden" value="{{$result1['products']['total_record']}}">
                              <!-- <label for="staticEmail" class="col-form-label"> @lang('website.Showing')&nbsp;<span class="showing_record">{{$result1['limit']}}</span>&nbsp;@lang('website.of')&nbsp;<span class="showing_total_record">{{$result1['products']['total_record']}}</span> &nbsp;@lang('website.results')</label> -->
                              
                            <div class=" justify-content-end load_more_outer_mobile col-12">
                              
                           <?php if (!empty(app('request')->input('limit'))) {
                               $record = app('request')->input('limit');
                           } else {
                               $record = '8';
                           } ?>

                            <div id="load_products"
                            @if(count($result1['products']['product_data']) < $record )
                                style="display:none"
                            @endif class="text-center" style="margin:3.2rem 0px 5rem 0px;font-size:1rem;width:100%;cursor:pointer"><span><a class=" demo-11-recent-btn common-hover common-stroke-hover stroke-color" >MORE PRODUCTS     <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" transform="rotate(-45)matrix(1, 0, 0, 1, 0, 0)" ><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.44593 10.5118C6.15159 11.6103 6.1896 12.7714 6.55515 13.8483C6.92071 14.9252 7.59739 15.8695 8.49962 16.5618C9.40186 17.2541 10.4891 17.6633 11.6239 17.7377C12.7587 17.8121 13.8901 17.5483 14.875 16.9796" stroke-linecap="round"></path> <path d="M17.5541 13.4882C17.8484 12.3897 17.8104 11.2286 17.4448 10.1517C17.0793 9.07483 16.4026 8.13053 15.5004 7.43822C14.5981 6.74591 13.5109 6.33669 12.3761 6.26231C11.2413 6.18793 10.1099 6.45173 9.125 7.02035"  stroke-linecap="round"></path> <path d="M3.75 12.5L6.25 10L8.75 12.5"  stroke-linecap="round" stroke-linejoin="round"></path> <path d="M15.25 11.5L17.75 14L20.25 11.5"  stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></a></span></div>

                
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
            @include('web.common.scripts.recent_arrival12_load_products')
        </section> 
     
    </section>

    <!-- <div style="display:none;" id="new_sec">hrllo</div> -->

    
   </section>
  
  
<script>


jQuery(function () {

var $range = jQuery(".js-range-slider1"),
    $inputFrom = jQuery(".js-input-from"),
    $inputTo = jQuery(".js-input-to"),
    instance,
    min = 0,
    max = {{$result1['filters']['maxPrice']}},
    from = 0,
    to = 0;
$range.ionRangeSlider({
    type: "double",
    min: min,
    max: max,
    from: <?php if($result1['min_price'] == ''){echo 0;}else{echo $result1['min_price'];} ?>,
    to: <?php if($result1['max_price'] == ''){echo $result1['filters']['maxPrice'];}else{echo $result1['max_price'];} ?>,
  prefix: 'Rp. ',
    onStart: updateInputs,
    onChange: updateInputs,
    step: 1,
    prettify_enabled: true,
    prettify_separator: ".",
  values_separator: " - ",
  force_edges: true


});

instance = $range.data("ionRangeSlider");

function updateInputs (data) {
    from = data.from;
    to = data.to;

    $inputFrom.prop("value", from);
    $inputTo.prop("value", to);
}

    $inputFrom.on("input", function () {
        var val = $(this).prop("value");

        // validate
        if (val < min) {
            val = min;
        } else if (val > to) {
            val = to;
        }

        instance.update({
            from: val
        });
    });

    $inputTo.on("input", function () {
        var val = $(this).prop("value");

        // validate
        if (val < from) {
            val = from;
        } else if (val > max) {
            val = max;
        }

        instance.update({
            to: val

        });
    });

  });

  function getComboA(selectObject) {
    var value = selectObject.value;
  console.log(value);
}

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
  margin-top:20px;
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
    margin-top: 0px;
    padding-bottom: 5px;
}

.range-slider-main {
    padding: 5px 15px 10px 15px;
    margin-top: 0px;
    margin-bottom: 15px;
}
.color-range-main h1 {
    font-size: 0.875rem;
    margin: 0;
    font-weight: 300 !important;
    color: #333;
}

#profile-description {
  border-top:1px solid #dee2e6;
  margin-bottom: 15px;
}
#profile-description .text {
/*   width: 660px;  */
  margin-bottom: 5px; 
  color: #333; 
  padding: 0 0px; 
  position:relative; 
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
    top: 0px;
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
  padding-bottom:50px;
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
    left: 0;
  
}

.menu-wrapper.hide {
    left: 0;
    
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
    left: 0;
    /* animation: move-sidebar .5s cubic-bezier(.4,0,.6,1);
    transition: -webkit-transform .5s cubic-bezier(.4,0,.6,1);
    transition: transform .5s cubic-bezier(.4,0,.6,1);
    transition: transform .5s cubic-bezier(.4,0,.6,1),-webkit-transform .5s cubic-bezier(.4,0,.6,1); */
    transform: translateX(0px);
}

.menu-wrapper.fullhide {
    left: 0;
    display: none;
}

.menu-wrapper.hide {
    left: 0;
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
          $('.contentdata').show(500); 
          $('.menu-icons').css('transform','translateX(250px)');    
        });

        $(".filter-ipad-show").click(function(e){
          $(".menu-wrapper").addClass("show").removeClass("fullhide").removeClass("hide");               
          $(".filter-background").addClass("active");               
        
         
         
        });


        

        $(".filter-background").click(function(e){
          $(".menu-wrapper").addClass("hide").removeClass("show"); 
          $(".filter-background").removeClass("active");   
          $("body").removeClass("body-overflow");                 
        }); 


        $(".hidefilter").click(function(e){
          $(".menu-wrapper").removeClass("show");  
          $(".menu-wrapper").addClass("hide");   
          $(".body-overflow  ").css("overflow",'auto').css('height','100%'); 
          $('.menu-icons').css('transform','translateX(0px)');  
          $('.filter-hide').hide(0);
          $('.filter-show').show(0);
      });


      var $btns = $('.btntab12').click(function() {
      if (this.id == 'all') {
        $('#parent > div').fadeIn(450);
      } else {
        var $el = $('.' + this.id).fadeIn(450);
        $('#parent > div').not($el).hide();
      }
      $btns.removeClass('cateactive');
      $(this).addClass('cateactive');
    })

    $('.filter-show').click(function() {
      $('.contentdata').show(500);
      $('.hitter').show(0);
      $('.menucate').hide(0);
      $('.filter-show').hide(0);
      $('.filter-hide').css('display','inline-block');
    });
    $('.filter-hide').click(function() {
      $('.contentdata').hide(500);
      $('.hitter').hide(0);
      $('.menucate').show(0);
      $('.filter-show').show(0);
      $('.filter-hide').hide(0);
    });


//     jQuery(".btntab12").click(function(e) {


// e.preventDefault(); // avoid to execute the actual submit of the form.
// var category = jQuery(this).attr('id');

// fil24(category);

// });

//     function fil24(category){
//       alert(category);       
//           jQuery.ajax({
//                 headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
//                 type: "POST",
//                 url: "{{url('/filter24')}}",
//                 data: 'category='+category,
//                 success: function(data)
//                 {
//                   jQuery('#new_sec').show();
//                   jQuery('#new_sec').html(data);
//                   jQuery('#allsec').hide();
//                 }
//               });
//     }






</script>

