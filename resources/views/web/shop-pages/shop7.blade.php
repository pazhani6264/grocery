<style>

ul { list-style-type: none; }

.right-menu .p24-angle-down a[aria-expanded=true]:after {
    content: none;
   
}
.top-bar .col-form-label {
    font-weight: 700;
    margin: 0px;
    display: block;
    width: 100%;
    align-items: center;
    justify-content: center;
}
.fa-angle-right:before {
    content: "/";
}

.shop-content .product-molla {
    margin-top: 0px;
}

 .listing {
    margin-top: 30px;
}
.listing:first-child {
  margin-top: 0px;
}

.p24-price-filter-outer .wrapper {
    box-shadow: unset;
}
.top-bar .form-group .form-control {
  border: 1px solid #d7d7d7;
}

.selectdiv {
  position: relative;
  /*Don't really need this just for demo styling*/
  float: left;
  
}
.collection-filter__btn
{
  display: none;
}

.selectdiv:after {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: "\F107";
    color: #979696;
    right: 11px;
    top: 6px;
    position: absolute;
    pointer-events: none;
}



.form-check {
    position: relative;
    display: block;
    padding-left: 1.25rem;
    padding-top: 4px;
    padding-bottom: 4px;
}
.top-bar label {
    font-weight: 400;
    margin-right: 10px;
    font-size: 12px;
    color: #333;
}
.page-link:hover {
    z-index: 2;
    text-decoration: none;
    border: solid 1px #ebebeb;
    background-color: transparent;
}
.page-item.active .page-link {
    z-index: 1;
    background-color: transparent;
    border: solid 1px #ebebeb;
}
.page-link {
    position: relative;
    display: block;
    padding: 0.9rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #212529;
    background-color: #fff;
    border: none;
    border-radius: 3px;
    margin: 2px;
    border: solid 1px transparent;
}

.right-menu .p24-color-range-main {
    margin: 0 15px !important;
}
.p24-price-filter-bar .irs-bar {
    height: 2px;
    top: 18px !important;
    border-top: 1px solid #333 !important;
    border-bottom: 1px solid #333 !important;
    background: #333;
}
.p24-price-filter-bar .irs-line {
    height: 2px;
    top: 18px !important;
    background: none; 
    background: none;
    border: 1px solid #CCC;
    border-radius: 16px;
    -moz-border-radius: 16px;
}


.p24-price-filter-bar .irs-slider:focus {
    -webkit-box-shadow: 0 0 0 5px rgb(63 81 181 / 20%);
    box-shadow: 0 0 0 5px rgb(63 81 181 / 20%);
}

.p24-price-filter-bar .irs-slider:active {
    -webkit-transform: scale(1.3);
    transform: scale(1.3);
}
.p24-price-filter-bar .irs-slider {
   
    border: 1px solid #333;
   
    box-shadow: unset;
    cursor: pointer;
}

.p24-cat-border {
    padding: 5px 10px 5px 0;
}

.right-menu .p24-angle-down a[aria-expanded=false]:after {
    content: none;
   
}
.right-menu .p24-angle-down a[aria-expanded=false] svg
{
transform: rotate(0deg);
}
.right-menu .p24-angle-down a[aria-expanded=true] svg
{
transform: rotate(180deg);
}
.sidebar-shop-title-p24 {
    color: #333 !important;
    font-weight: 600 !important;
    font-size: 18px;
    line-height: 1.15;
    letter-spacing: 1px;
    margin-bottom: 7px;
}
.p24-count-span {
    font-weight: 300;
    font-size: 12px;
    border-radius: 0.6rem;
    color: #777;
    background-color: #f8f8f8;
    position: absolute;
    right: 0;
    min-width: 25px;
    height: 20px;
    text-align: center;
}
.p24-display-flex-s
{
  display: flex;
  justify-content: space-between;
}
/** =======================
 * Contenedor Principal
 ===========================*/
 .breadcrumb-item{
  font-size:1rem;
  font-weight:300 !important;
}
.top-bar .block .buttons a {
    padding: 5px;
    color: #ccc;
}

.top-bar {
    border: none;
    padding: 0px 10px;
    margin-bottom: 20px;
}
.p24-s-shop-clearall {
    display: inline-block;
    margin-left: auto;
}
.p24-s-shop-widget {
    color: #333;
    border-bottom: 1px solid #ebebeb;
    display: flex;
    align-items: center;
    padding-top: 5px;
    padding-bottom: 23px;
    margin: 0 15px;
}
.mb-4s{
  margin-bottom:20px;
}
nav[aria-label=breadcrumb] .breadcrumb .active::before {
    content: none !important;
}
.page-heading-title {
    margin-top: -7px;
    padding-bottom: 0px;
}
nav[aria-label=breadcrumb] .breadcrumb .breadcrumb-item a {
    font-size: 0.875rem;
    color: #777;
}
.accordion {
  width: 100%;
  max-width: 360px;
  background: transparent;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
}
.p24-hover-underline:hover
{
  border-bottom:solid 1px;
  color: #000 !important;
}
.p24-hover-underline
{
  color: #000 !important;
}
.pagination {
    margin-bottom: 30px !important;
}
.accordion .link {
  cursor: pointer;
  display: block;
  padding: 4px 0;
  color: #4D4D4D;
  font-size: 14px; 
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

.accordion li svg {
  right: 0px;
  left: auto;
  font-size: 0.875rem;
  position: absolute;
}

.accordion li.open svg
{
transform: rotate(180deg);
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
  background: transparent;
  font-size: 0.875rem;
}

.submenu li { border-bottom: 0px solid #4b4a5e; }

.submenu a {
  display: block;
  text-decoration: none;
  color: #333;
  padding: 6px;
  padding-left: 15px;
  -webkit-transition: all 0.25s ease;
  -o-transition: all 0.25s ease;
  transition: all 0.25s ease;
  position: relative;
}

/* .submenu a:hover {
  background: #b63b4d;
  color: #FFF;
} */

@media only screen and (max-width: 768px)
{
  .top-bar .block {
    display: block !important;
}
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

  
<style>
        .flex-grid--template--15597293207773__promo-grid .flex-grid__item {
    padding-top: 20px;
    padding-left: 20px;
}
#p24-shop-banner-1 .type-banner {
    flex: 1 0 100%;
}
#p24-shop-banner-1 {
    margin-top: 60px;
    margin-bottom: 30px;
}
#p24-shop-banner-1 .promo-grid__container {
    display: flex;
    align-items: flex-start;
    position: relative;
    background-repeat: no-repeat;
    border-radius: var(--roundness);
    overflow: hidden;
}
#p24-shop-banner-1 .color-scheme-1 {
    color: #fff;
    background-color: #e2183d;
    border-radius: 15px;
}

#p24-shop-banner-1 .promo-grid__container .scheme-image {
    border-radius: calc(var(--roundness) + 2px);
}
img[data-sizes=auto] {
    display: block;
    width: 100%;
}
#p24-shop-banner-1 .scheme-image {
    -o-object-fit: cover;
    object-fit: cover;
    pointer-events: none;
    mix-blend-mode: multiply;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: -1;
    opacity: 0;
    animation: fade-in .5s cubic-bezier(.29,.65,.58,1) forwards;
}
#p24-shop-banner-1 .type-banner__content {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 10px;
}
#p24-shop-banner-1 .type-banner__text {
    padding: 20px;
    flex: 0 1 auto;
}
.type-banner p {
    margin: 10px;
    display: inline-block;
    vertical-align: middle;
    line-height: 1.2;
}
.flex-grid__item--banner .btn {
    border: none !important;
}
#p24-shop-banner-1 .p24-shop-p
{
  font-size:13px;
}
#p24-shop-banner-1 .p24-shop-h3
{
  font-size:22px;
}
#p24-shop-banner-1 .color-scheme-1 .btn {
    color: #e2183d;
    background-color: #fff;
    font-size: 12px;
    text-transform: capitalize;
}
.right-menu .color-range-main {
border: 1px solid #dee2e6;
padding: 20px 0px;
margin-top: 30px;
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
<section class="pro-content" style="padding-top:0px;border-bottom: solid 1px #e8e8e1;">
  <div class="container-fuild mb-4s">
    <nav aria-label="breadcrumb" style="background:#fff;">
      <?php 
        $headerID = DB::table('current_theme')->first();
        if($headerID->header == 23 || $headerID->header == 44 || $headerID->header == 28 || $headerID->header == 47 || $headerID->header == 32 || $headerID->header == 33 || $headerID->header == 35 || $headerID->header == 36 || $headerID->header == 37 || $headerID->header == 38 || $headerID->header == 39) {
      ?>
      <div class="container-fluid">
      <?php } else { ?>
      <div class="container">
      <?php } ?>
        <ol class="breadcrumb">
          @if(!empty($result['category_name']) and !empty($result['sub_category_name']))
          <li class="breadcrumb-item">
            <a style="font-weight: 300 !important;color: #000;font-size: 0.875rem;" href="{{ URL::to('/')}}">@lang('website.Home')</a>
            <span style="color: #000;opacity:0.2;padding: 0 5px;">/</span>
            <a style="font-weight: 300 !important;color: #000;font-size: 0.875rem;" href="{{ URL::to('/shop')}}">@lang('website.Shop')</a>
            <span style="color: #000;opacity:0.2;padding: 0 5px;">/</span>
            <a style="font-weight: 300 !important;color: #000;font-size: 0.875rem;" href="{{ URL::to('/shop?category='.$result['category_slug'])}}">{{$result['category_name']}}</a>
            <span style="color: #000;opacity:0.2;padding: 0 5px;">/</span>
            <h1 style="margin: 10px 0 0 0;font-weight: 600;">{{$result['sub_category_name']}}</h1>
          </li>
          @elseif(!empty($result['category_name']) and empty($result['sub_category_name']))
          <li class="breadcrumb-item">
            <a style="font-weight: 300 !important;color: #000;font-size: 0.875rem;" href="{{ URL::to('/')}}">@lang('website.Home')</a>
            <span style="color: #000;opacity:0.2;padding: 0 5px;">/</span>
            <a style="font-weight: 300 !important;color: #000;font-size: 0.875rem;" href="{{ URL::to('/shop')}}">@lang('website.Shop')</a>
            <span style="color: #000;opacity:0.2;padding: 0 5px;">/</span>
            <h1 style="margin: 10px 0 0 0;font-weight: 600;">{{$result['category_name']}}</h1>
          </li>
          @else
          <li class="breadcrumb-item">
            <a style="font-weight: 300 !important;color: #000;font-size: 0.875rem;" href="{{ URL::to('/')}}">@lang('website.Home')</a>
            <span style="color: #000;opacity:0.2;padding: 0 5px;">/</span>
            <a style="font-weight: 300 !important;color: #000;font-size: 0.875rem;" href="{{ URL::to('/shop')}}">@lang('website.Shop')</a>
            <span style="color: #000;opacity:0.2;padding: 0 5px;">/</span>
            <h1 style="margin: 10px 0 0 0;font-weight: 600;">All</h1>
          </li>
          @endif
        </ol>
        <div id="p24-shop-banner-1" class="flex-grid__item flex-grid__item-- flex-grid__item--banner type-banner">
          <a href="/products/tbm-membership-registration" class="type-banner__link" data-samitapbl-handle="tbm-membership-registration">
            <div class="promo-grid__container color-scheme-1">
              <img class="scheme-image lazyautosizes lazyloaded" aria-hidden="true" data-texture="paper.jpg" data-widths="[360, 540, 720, 900, 1080]" data-sizes="auto" data-srcset="//cdn.shopify.com/s/files/1/0424/8322/0646/t/49/assets/paper_360x.jpg?v=56776081759779364771649043295 360w, //cdn.shopify.com/s/files/1/0424/8322/0646/t/49/assets/paper_540x.jpg?v=56776081759779364771649043295 540w, //cdn.shopify.com/s/files/1/0424/8322/0646/t/49/assets/paper_720x.jpg?v=56776081759779364771649043295 720w, //cdn.shopify.com/s/files/1/0424/8322/0646/t/49/assets/paper_900x.jpg?v=56776081759779364771649043295 900w, //cdn.shopify.com/s/files/1/0424/8322/0646/t/49/assets/paper_1080x.jpg?v=56776081759779364771649043295 1080w" sizes="1269px" srcset="//cdn.shopify.com/s/files/1/0424/8322/0646/t/49/assets/paper_360x.jpg?v=56776081759779364771649043295 360w, //cdn.shopify.com/s/files/1/0424/8322/0646/t/49/assets/paper_540x.jpg?v=56776081759779364771649043295 540w, //cdn.shopify.com/s/files/1/0424/8322/0646/t/49/assets/paper_720x.jpg?v=56776081759779364771649043295 720w, //cdn.shopify.com/s/files/1/0424/8322/0646/t/49/assets/paper_900x.jpg?v=56776081759779364771649043295 900w, //cdn.shopify.com/s/files/1/0424/8322/0646/t/49/assets/paper_1080x.jpg?v=56776081759779364771649043295 1080w">
              <div class="type-banner__content text-center">
                <div class="type-banner__text">
                  <p class="p24-shop-h3">Axtra Rewards</p>
                  <p class="p24-shop-p">Join TBM's membership now and earn 5,000 sign up points as well as other exclusive benefits!</p>
                  <p class="btn btn--secondary btn--small">Learn More</p>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </nav>
  </div>
</section>
 

  
  
   
      
<!--     <section class="pro-content"> -->
        <!--  <div class="container">
              <div class="page-heading-title">
                  <h2 class="h2-filter"> @lang('website.Shop')  
                  

                  <div class="menu-icons common-color"><i class="fa fa-filter common-color" aria-hidden="true"></i> Filter</div> </h2>
              
                  </div>
          </div> 
 -->

<!--  <div class="menu-icons common-color"><i class="fa fa-filter common-color" aria-hidden="true"></i> Filter</div> -->

<!--  <div class="menu-icons common-color"><i class="fa fa-cog" style="color:#fff" aria-hidden="true"></i></div> -->
          
          
          <section class="shop-content shop-two shop-7" style="background-color:#fff;padding-top: 25px;">
                  
          <?php 
        $headerID = DB::table('current_theme')->first();
        if($headerID->header == 23 || $headerID->header == 44 || $headerID->header == 28 || $headerID->header == 47 || $headerID->header == 32 || $headerID->header == 33 || $headerID->header == 35 || $headerID->header == 36 || $headerID->header == 37 || $headerID->header == 38 || $headerID->header == 39) {
      ?>
      <div class="container-fluid">
      <?php } else { ?>
        <div class="container">
      <?php } ?>
                <div class="row">
                  <div class="col-12 col-lg-3  d-lg-block d-xl-block right-menu p-0"> 
                    
                <!--   <div class="filter-hide-desktop p24-s-shop-widget"><label>Filters:</label><a class="p24-s-shop-clearall common-text" href="{{ URL::to('/shop')}}">Clean All</a></div> -->
              
                <div class="products-area">
                  <div class="top-bar">
                    <div class="row">
                      <div class="col-12 col-lg-12">
                        <div class="row align-items-center">
                          <div class="col-12 col-md-6 col-lg-6">
                            <label for="staticEmail" class="col-form-label" style="color:#000;font-size: 14px;"><span class="showing_total_record">{{$result['products']['total_record']}}</span> &nbsp; <span style="color:#000;font-size: 14px;">Products</span></label>
                            <button type="button" onclick="mobilefilter()" class="collection-filter__btn collection-filter__btn_new mobile_filter_button text-link">
                              <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-filter" viewBox="0 0 64 64"><path d="M48 42h10">.</path><path d="M48 42a5 5 0 1 1-5-5 5 5 0 0 1 5 5z"></path><path d="M7 42h31">.</path><path d="M16 22H6">.</path><path d="M16 22a5 5 0 1 1 5 5 5 5 0 0 1-5-5z"></path><path d="M57 22H26">.</path></svg> Filter
                            </button>      
                            <button type="button" onclick="mobilefilter_close()" style="display:none;" class="collection-filter__btn collection-filter__btn_close text-link mobile_filter_button_close">
                            <svg xmlns="http://www.w3.org/2000/svg" class="menu-23-fontsize" width="16" height="15" viewBox="0 0 27.001 27"><path id="close" d="M101.218,98.832l10.619-10.619a1.688,1.688,0,1,0-2.387-2.387L98.832,96.445,88.212,85.826a1.688,1.688,0,0,0-2.387,2.387L96.445,98.832,85.826,109.451a1.688,1.688,0,1,0,2.387,2.387l10.619-10.619,10.619,10.619a1.688,1.688,0,0,0,2.387-2.387Z" transform="translate(-85.332 -85.332)" fill="#fff"></path></svg>Filter
                            </button>         
                          </div> 
                          <div class="col-12 col-md-6 col-lg-6">
                           
                              
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                                  

                <div class="filter-background">  </div>
                  <div id="filter_add_class" class="menu-wrapper show">
            <div class="menu-icon-wrapper">
               <a href="" class="menu-icon"></a>
            </div>
            <div class="shop-side-scroll">
             <!--  <div class="filter-hide-m"><div class="p24-s-shop-widget"><label>Filters:</label><a class="p24-s-shop-clearall common-text" href="{{ URL::to('/shop')}}">Clean All</a></div></div> -->
            <div id="profile-description" class="right-menu-categories">
                    <div class="text ">
                  <!--   <h2 style="padding: 10px 0;font-size: 1.2rem;">Category </h2> -->
                

                    <div class="panel-group p24-angle-down p24-cat-border" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                          <h4 class="panel-title sidebar-shop-title-p24">
                            <a role="button" data-toggle="collapse" class="p24-display-flex-s sidebar-shop-title-p24" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Category 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg></a>
                          </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body" style="padding:15px 0;">
                            <ul id="accordion" class="accordion">
                              @include('web.common.shopCategoriesTbm')
                              @php    shopCategories(); @endphp 
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                     </div>
                    <!--  <div class="show-more common-hover" style="width:90%; margin:auto;">(Show More)</div> -->
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



                          
             
               
               
               
               @include('web.common.scripts.slider')
                     @if(count($result['filters']['attr_data'])>0)
                     @foreach($result['filters']['attr_data'] as $key=>$attr_data)
                     <?php $str = $attr_data['option']['name'];
                              $new_str = str_replace(' ', '', $str);?>


                      <div class="panel-group p24-angle-down p24-cat-border" style="margin: 0 15px;" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default" >
                          <div class="panel-heading" role="tab" id="heading{{$new_str}}">
                            <h4 class="panel-title sidebar-shop-title-p24">
                              <a role="button" data-toggle="collapse" class="p24-display-flex-s sidebar-shop-title-p24" data-parent="#accordion" href="#collapse{{$new_str}}" aria-expanded="false" aria-controls="collapse{{$new_str}}">{{$attr_data['option']['name']}} <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg></a>
                            </h4>
                          </div>
                          <div id="collapse{{$new_str}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$new_str}}">
                            <div class="panel-body">

                              <div class="option-outer-tg color-range-main">
                                <div class="option-text option-text{{$new_str}} {{$new_str}}">
                                 <!--  <h1 @if(count($result['filters']['attr_data'])==$key+1) last @endif>{{$attr_data['option']['name']}}</h1> -->
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
                      
                          
                              </div>
        
                            </div>
                          </div>
                        </div>
                      </div>


                     
                     @endforeach
                     @endif

                     
                    <div class="panel-group p24-angle-down p24-cat-border p24-price-filter-outer" id="accordion" style="margin: 0 15px;" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="headingprice">
                            <h4 class="panel-title sidebar-shop-title-p24">
                              <a role="button" data-toggle="collapse" class="p24-display-flex-s sidebar-shop-title-p24" data-parent="#accordion" href="#collapseprice" aria-expanded="false" aria-controls="collapseprice">Price <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg></a>
                            </h4>
                          </div>
                          <div id="collapseprice" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingprice">
                            <div class="panel-body" style="padding:15px 0;">
                              <div class="range-slider-main p24-price-filter-bar" >
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

                             
        
                            </div>
                          </div>
                        </div>
                      </div>


                     <div class="p24-color-range-main color-range-main btn-fixed-bottom-outer">
  
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
                  <!--  <a href="{{ URL::to('/shop')}}" class="btn btn-dark btn-fixed-inner" id="apply_options"> @lang('website.Reset') </a> -->
                      @if(app('request')->input('filters_applied')==1)
                        <button type="button" style="width:100%;" class="btn btn-secondary btn-fixed-inner" id="apply_options_btn"> @lang('website.Apply')</button>
                     @else
                   <!--<button type="button" class="btn btn-secondary" id="apply_options_btn" disabled> @lang('website.Apply')</button>-->
                     <button type="button" style="width:100%;" class="btn btn-secondary btn-fixed-inner" id="apply_options_btn" > @lang('website.Apply')</button>
                     @endif
                 </div>
               </div>
                    
               </form>
               @endif
                    
  
              @if(!empty($result['commonContent']['manufacturers']) and count($result['commonContent']['manufacturers'])>0)

              <div class="panel-group p24-angle-down p24-cat-border p24-brand-side-outer" id="accordion" style="margin: 0 15px;margin-bottom: 65px !important;" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="headingbrand">
                            <h4 class="panel-title sidebar-shop-title-p24">
                              <a role="button" data-toggle="collapse" class="p24-display-flex-s sidebar-shop-title-p24" data-parent="#accordion" href="#collapsebrand" aria-expanded="false" aria-controls="collapsebrand">Brands <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg></a>
                            </h4>
                          </div>
                          <div id="collapsebrand" class="panel-collapse collapse in " role="tabpanel" aria-labelledby="headingbrand">
                            <div class="panel-body" style="padding:15px 0;">



                          


                <div class="range-slider-main">
                  <ul id="accordionbrand" class="accordion">
                  
                        @foreach ($result['commonContent']['manufacturers'] as $item)
                          <li><a class="common-hover" href="{{ URL::to('/shop?brand='.$item->manufacturer_name)}}"><span  class="fa">&#xf105;</span> {{$item->manufacturer_name}}</a></li>
                        @endforeach
                      </ul>
                   
                </div>


                
                </div>
                          </div>
                        </div>
                      </div>
              @endif 
              
                </div>
              

        </div>


  
              </div>
                  <div class="col-12 col-lg-9">
                    @if($result['products']['success']==1)
                      <div class="products-area">
                        <div class="top-bar">
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-md-6 col-lg-6">
                                        <label for="staticEmail" class="col-form-label" style="color:#000;font-size: 14px;"><span class="showing_total_record">{{$result['products']['total_record']}}</span> &nbsp; <span style="color:#000;font-size: 14px;">Products</span></label>

                                        <style>

.collection-filter__btn {
    padding: 12px 0;
    font-weight: 700;
    font-size: 13px;
}
.text-link {
    display: none;
    border: 0 none;
    background: none;
    padding: 0;
    margin: 0;
    color: currentColor;
    background: transparent;
}
.collection-filter__btn .icon {
    width: 25px;
    height: 25px;
    margin-top: -1px;
    margin-right: 5px;
}
svg:not(:root) {
    overflow: hidden;
}

.icon {
    display: inline-block;
    width: 20px;
    height: 20px;
    vertical-align: middle;
    fill: currentColor;
}
.collection-filter__btn_new path {
  transition: all .3s cubic-bezier(.18,.77,.58,1);
    fill: none!important;
    stroke-width: 5px;
    stroke: currentColor!important;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.collection-filter__btn_close path {
 fill: #000;
}
                                        </style>


                                        <!-- <button type="button" class="collection-filter__btn text-link">
                                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-filter" viewBox="0 0 64 64"><path d="M48 42h10">.</path><path d="M48 42a5 5 0 1 1-5-5 5 5 0 0 1 5 5z"></path><path d="M7 42h31">.</path><path d="M16 22H6">.</path><path d="M16 22a5 5 0 1 1 5 5 5 5 0 0 1-5-5z"></path><path d="M57 22H26">.</path></svg>
                                          Filter
                                        </button> -->
                                        
                                        </div> 
                                        <div class="col-12 col-md-6 col-lg-6">
                                          
  
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
                                           
                                             
                                            
                                            <div class="form-group mobile_display_none" style="border-right: solid 1px #e8e8e1;padding-right: 15px;margin-right: 15px;">
                                               <!--  <label class="mobile-pad-25">Sort by:</label> -->
                                                
                                                <div class="selectdiv">
                                                <select name="type" id="sortbytype" class="form-control" style="border: none;cursor: pointer;color: #000;font-size: 14px;">
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

                                              
                                              <div class="block">
                                              
                                                <div class="buttons">
                                                  <a href="javascript:void(0);" id="grid" class="active"><i class="fas fa-th-large" style="font-size:20px"></i></a>
                                                  <a href="javascript:void(0);" id="grid4"><i class="fas fa-th" style="font-size:20px"></i></a>
                                                  <a href="javascript:void(0);" id="list"><i class="fas fa-list" style="font-size:20px"></i></a>
                                                </div>
                                              </div>
  
                                        
                                              
                                               <div class="form-group" style="display:none;">
                                                
                                                <label class="mobile-pad-15">@lang('website.Limit')</label>
                                                <div class="select-control">
                                                  <select class="form-control" name="limit" id="sortbylimit">
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
                        <div class="pagination justify-content-center">
                              <input id="record_limit" type="hidden" value="{{$result['limit']}}">
                              <input id="total_record" type="hidden" value="{{$result['products']['total_record']}}">
                           <!--    <label for="staticEmail" class="col-form-label"> @lang('website.Showing')&nbsp;<span class="showing_record">{{$result['limit']}}</span>&nbsp;@lang('website.of')&nbsp;<span class="showing_total_record">{{$result['products']['total_record']}}</span> &nbsp;@lang('website.results')</label> -->
                              
                            <div class=" justify-content-end load_more_outer_mobile  p24-shop-paginate">
                              
                           <?php
                                if(!empty(app('request')->input('limit'))){
                                    $record = app('request')->input('limit');
                                }else{
                                    $record = '15';
                                }
                            ?>

                        

                            {!! $result['products']['product_data_new']->appends(Request::except('page'))->links() !!}
                           
                           <!--  <button class="btn btn-secondary" type="button" id="load_products"
                            @if(count($result['products']['product_data']) < $record )
                                style="display:none"
                            @endif
                            >@lang('website.Load More')</button> -->
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

            <div style="margin-bottom:60px;border:solid 1px #e8e8e1;"></div>
            @include('web.multibannerstwo.banner38') 
            <div style="padding-bottom:60px;"></div>



        </section> 

       
     
    </section>
    
   <!-- </section> -->
  
  
<script>
  $('.menu-active-shop > a').addClass('menu-active');
</script>


<style>

 .menu-wrapper.show {
    display: block;
  }

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
.shop-7 .right-menu .color-range-main {
   
    border: none !important;
    
}
.right-menu .p24-cat-border .range-slider-main {
    border-bottom: none !important;
    border: none !important;
   
}
.p24-brand-side-outer .range-slider-main
{
  padding:0 !important;
  margin:0 !important;
}
.p24-brand-side-outer .range-slider-main li
{
  padding : 4px 0;
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





.filter-hide-m {
    display: none;
    font-size: 14px;
    padding-top: 20px;
    margin-top: 0;
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
    left: -100%;
    bottom: 0;
    z-index: 1;
     /* overflow-y: auto;  */
}


.closeNavIcon-responsive {
    display: inline-block;
}

@keyframes move-sidebar {
    from {
        transform: translateX(-100%);
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
        transform: translateX(-100%);
    }
}



.menu {
   
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
    transition: transform 0.2s;
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
    transition: transform 0.2s cubic-bezier(.01,.87,.36,.99);
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
    animation: fadeOut 0.2s cubic-bezier(.01,.87,.36,.99) 0s 1 normal forwards;
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
    left: 0;
  
}

.menu-wrapper.hide {
    left: 0;
    
}

@media only screen and (max-width: 768px)
{
  #profile-description {
    max-width: 100%;
    margin-top: 50px;
    position: relative;
}
  .filter_menu_show
  {
    display: contents !important;
  }
  .mobile_display_none
  {
    display: none !important;
  }
  .text-link {
    display: inline;
    border: 0 none;
    background: none;
    padding: 0;
    margin: 0;
    color: currentColor;
    background: transparent;
}


  #p24-shop-banner-1 .p24-shop-p {
    font-size: 11px;
}
#p24-shop-banner-1 .p24-shop-h3 {
    font-size: 18px;
}
.type-banner p {
    margin: 7px;
    display: inline-block;
    vertical-align: middle;
    line-height: 1.2;
}
#p24-shop-banner-1 .color-scheme-1 .btn {
    color: #e2183d;
    background-color: #fff;
    font-size: 10px;
    text-transform: capitalize;
    border-radius: 3px;
    padding: 8px 14px;
}
#p24-shop-banner-1 {
    margin-top: 30px;
    margin-bottom: 0px; 
}
.mb-4s {
    margin-bottom: 0px;
}
.pro-content {
    border-bottom: none !important;
}
.shop-7
{
  padding-top:10px !important;
}
  .menu-wrapper.show {
    display: none;
  }
  a#grid4 {
    display: none;
}
  .filter-hide-m
{
  display: block;
}
.right-menu {
    margin-top: 0px;
}
.p24-price-filter-outer .range-slider-main {
    padding: 0;
}
.top-bar .col-form-label {
    font-weight: 700;
    margin: 0px;
    display: none;
    width: 100%;
    align-items: center;
    justify-content: start;
}
.top-bar .justify-content-center, .top-bar .justify-content-end {
    justify-content: flex-end !important;
}

.filter-hide-desktop
{
  display:none;
}
.pagination {
    display: flex !important;
    text-align: center !important;
    margin-bottom: 30px !important;
}
.menu-icons {
    position: fixed !important;
    left: 0;
    right:auto !important;
    top: 40% !important;
    font-size: 16px;
    display: none;
    background: rgba(0,0,0,.2);
    padding: 4px 8px;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
    animation: move-sidebar .2s cubic-bezier(.4,0,.6,1);
    transition: -webkit-transform .2s cubic-bezier(.4,0,.6,1);
    transition: transform .2s cubic-bezier(.4,0,.6,1);
    transition: transform .2s cubic-bezier(.4,0,.6,1),-webkit-transform .2s cubic-bezier(.4,0,.6,1);
    z-index: 99;
  }
.right-menu .p24-color-range-main {
    margin: 0 !important;
}
#profile-description {
    margin-top: 0px; 
}
  .menu-icon-wrapper{
    display: none;
}
.menu-wrapper {
  width: 250px;
   z-index: 999999;
   top:0;
}
.menu-wrapper.show {
    left: 0;
    animation: move-sidebar .2s cubic-bezier(.4,0,.6,1);
    transition: -webkit-transform .2s cubic-bezier(.4,0,.6,1);
    transition: transform .2s cubic-bezier(.4,0,.6,1);
    transition: transform .2s cubic-bezier(.4,0,.6,1),-webkit-transform .2s cubic-bezier(.4,0,.6,1);
}

.menu-wrapper.fullhide {
    left: 0;
    display: none;
}

.menu-wrapper.hide {
    left: 0;
    animation: move-sidebar .2s cubic-bezier(.4,0,.6,1);
    transition: -webkit-transform .2s cubic-bezier(.4,0,.6,1);
    transition: transform .2s cubic-bezier(.4,0,.6,1);
    transition: transform .2s cubic-bezier(.4,0,.6,1),-webkit-transform .2s cubic-bezier(.4,0,.6,1);
}
.right-menu .btn-fixed-inner {
    width: 49%;
    padding: 10px !important;
}
.right-menu .btn-fixed-bottom-outer {
    position: relative;
    bottom: 0;
    width: 250px;
    /* padding: 5px 10px; */
    z-index: 200;
    background: #fff;
    margin: auto !important;
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
  .top-bar .block {
    display: flex;
    justify-content: center;
}
.top-bar .form-inline {
    display: block;
}
  .top-bar .form-inline .form-group {
    display: flex;
    justify-content: center;
    margin: 5px 0;
}
  .top-bar .col-form-label {
    font-weight: 700;
    margin: 0px;
    display: none;
    width: 100%;
    align-items: center;
    justify-content: center;
}
.top-bar .justify-content-center, .top-bar .justify-content-end {
    justify-content: flex-start !important;
}


.menu-wrapper {
  width: 250px ;
}
.right-menu .btn-fixed-bottom-outer {
  
    width: 250px ;
    
}
.sidebar-shop-title-p24 {
    font-size: 14px;
   
}
.accordion .link {
   
    font-size: 12px;
   
}
.form-check {
    
    font-size: 12px;
}

.p24-price-filter-outer .range-slider-main .form-inline .form-group span .form-control {
    width: 50px !important;
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

function mobilefilter()
{
  $("#filter_add_class").addClass("filter_menu_show");
  $(".mobile_filter_button_close").show();
  $(".mobile_filter_button").hide();
}
function mobilefilter_close()
{
  $("#filter_add_class").removeClass("filter_menu_show");
  $(".mobile_filter_button_close").hide();
  $(".mobile_filter_button").show();
}


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
                 
               
                     
            } else{
               
              
            }
        }
        
        responsive();
        
       
       

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