<!DOCTYPE html>
<html>
    <head>
        <title>CATEGORY</title>
        <meta charset="utf-8">
        <meta name="description" content="QRCODE Scanning">
        <meta name="keywords" content="QRCODE Scanning">
        <meta name="author" content="Platinum Code">
        <meta name = "viewport" content = "width=device-width, minimum-scale=1.0, maximum-scale = 1.0, user-scalable = no">
		<link rel="stylesheet" type="text/css" href="{{asset('web/table').'/'.$result['commonContent']['settings']['qr_color_style']}}.css">
        <link rel="stylesheet" href="{{asset('web/table/font-awesome/css/all.min.css')}}">
    </head>

	<style>
	.search-input {
		border: 0.1rem solid #ebebeb;
		border-radius: 20px;
		padding: 0.9rem;
		height: 38px;
		width: 100%;
		outline: none;
		font-size: 1rem;
	}
	.header-28-search-input {
		position: relative;
		right: -2px;
	}
	.search-button-main {
		position: absolute;
		top: 5px;
		right: 0px;
		padding: 0;
		background: #fff;
		width: 40px;
	}

	.col-md-4 {
    flex: 0 0 33.3333333333%;
    max-width: 33.3333333333%;
	display:inline-block;
	vertical-align:middle;
}
.col-md-8 {
    flex: 0 0 66.6666666667%;
    max-width: 66.6666666667%;
	display:inline-block;
	vertical-align:middle;
}
.searchdropdown{
	border-bottom:.1rem solid #ebebeb;
	padding:20px 10px;
}

.search_outer_con {
    position: absolute;
    z-index: 100;
    background: #fff;
    top: 37px;
    width: 100%;
    border: 1px solid rgba(0, 0, 0, 0.15);
    min-width: 10rem;
    padding: 0.5rem 0.5rem;
    margin: 0.125rem 0 0;
    font-size: 0.875rem;
    color: #111;
    display: none;
    max-height: 100vh;
    overflow-y: auto;
    overflow-x: hidden;
}

.enable_search {
    display: block;
}

</style>

	<body>
        <h1 class="pc-title mobile-none">This Site Only View on Mobile And Tab</h1>
        <div class="pc-mobile-tab">
            <div class="pc-in-main1">
                <div class="pc-cat-header">
                    <div class="pc-cat-header-left">
                        <div class="pc-cat-header-left-main">
                            <img src="{{asset('web/table/img/eng.png')}}" alt="Language">
                        </div>
                    </div>
                    <div class="pc-in-header-right">
						<form class="form-inline-search header-28-form" action="#" method="get">
							<div class="input-main" id="searchbuttons">
								<div  class="search-inputs"></div>
							</div>
							<input type="hidden" class="category-value" name="categories_id" value="" /> 
							<div class="input-main" id="searchbutton" style="display:none;position:absolute;top:0;right:0;left:0">
								<input autocomplete="off" name="search" type="text" class="search-input typeheads1 header-28-search-input" value="{{ app('request')->input('search') }}" placeholder="Search Product ..... ">
								<div class="search_outer_con">
									<div id="viewsearchproduct"></div>
								</div>
							</div>
							<button id="dropdownCartButton" class="btn search-button-main header-28-search-button" type="button"> 
								<img class="cus-style-search" onclick="myFunction()" src="{{asset('web/table/img/search.png')}}" alt="Search">
							</button>
                  		</form>

                        <div class="pc-cat-header-right-main">
                            <!-- <img src="{{asset('web/table/img/search.png')}}" alt="Search"> -->
                        </div>
                        <div class="pc-cat-header-right-main1">
                            <a href="{{url('/orderhistory')}}">
                                <img src="{{asset('web/table/img/notes.png')}}" alt="Notes">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="cat-banner-main">
                    <img src="{{asset('web/table/img/banner.jpg')}}" alt="Banner">
                </div>
                <div class="cat-main">
                    <div class="cat-main-left">
						@if($result)
							@foreach($result['categories'] as $jescate)
								@php
									if($jescate->image_path_type=='aws'){
										$image=$jescate->image_path;
									}else{
										$image=asset('').$jescate->image_path;
									}
								@endphp
								<div class="cat-main-left-item" onclick="city(event, '{{$jescate->categories_id}}')">
									<div class="cat-img-left-item-img-main">
										<img src="{{$image}}" alt="Category Name">
									</div>
									<div class="cat-main-left-title">{{$jescate->categories_name}}</div>
								</div>
							@endforeach
						@endif
                    </div>

					@if($result)
						@foreach($result['categories'] as $jescate)
							@php
								$product = DB::table('products')
									->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
									->LeftJoin('image_categories', 'products.products_image', '=', 'image_categories.image_id')
									->LeftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
									->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*')
									->where('products_to_categories.categories_id', '=', $jescate->categories_id)
									->groupBy('products_description.products_id')
									->orderBy('products.products_id', 'desc')
									->get();
								//print_r($product);die();
							@endphp
							<div class="cat-main-right" id="{{$jescate->categories_id}}">
								<div class="cat-main-right-title">{{$jescate->categories_name}}</div>
								@if(!$product->isEmpty())
									@foreach($product as $jesproduct)
										@php
											if($jesproduct->image_path_type=='aws'){
												$proimage=$jesproduct->image_path;
											}else{
												$proimage=asset('').$jesproduct->image_path;
											}
										@endphp
										<a href="{{ URL::to('/qrcodedetail')}}/{{$jesproduct->products_slug}}">
											<div class="cat-main-right-item">
												<div class="cat-main-right-item-img-main">
													<img src="{{ $proimage }}" alt="Product Name">
												</div>
												<div class="cat-main-right-item-title">{{$jesproduct->products_name}}</div>
												<div class="cat-main-right-item-price">{{$jesproduct->products_filter_price}}</div>
											</div>
										</a>
									@endforeach
								@endif
							</div>
						@endforeach
					@endif
                    
					@php
						$total_amount=0;
						$qunatity=0;
					@endphp
					@foreach($result['commonContent']['cart'] as $cart_data)
						@php
						$total_amount += $cart_data->customers_basket_quantity * $cart_data->original_price;
						$qunatity     += $cart_data->customers_basket_quantity;
						@endphp
					@endforeach

                    <div class="pc-category-order-bottom">
                        <div class="pc-category-order-bottom-main">
                            <a href="{{url('/qrcodeorder')}}">
                                <div class="pc-category-left-arrow"><img style="width:20px;height:20px" src="{{asset('web/table/img/arrow.png')}}"/></div>
                            </a>
                            <div class="pc-category-order-bottom-price">Total : {{Session::get('symbol_left')}} {{ $total_amount*session('currency_value') }} {{Session::get('symbol_right')}}</div>
                            <div class="pc-category-button-main">
                                <a href="{{url('/qrcodecart')}}">
                                    <button type="submit" class="pc-category-order-button modal-toggle">ORDER</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script>
    var button = document.getElementsByClassName('cat-main-left-item'),
    tabContent = document.getElementsByClassName('cat-main-right');
    button[0].classList.add('active');
    tabContent[0].style.display = 'block';


    function city(e, city) {
        var i;
        for (i = 0; i < button.length; i++) {
            tabContent[i].style.display = 'none';
            button[i].classList.remove('active');
        }
        document.getElementById(city).style.display = 'block';
        e.currentTarget.classList.add('active');
    }
</script>

<script>


  function myFunction() {
  var x = document.getElementById("searchbutton");
  var y = document.getElementById("searchbuttons");

  var a = document.getElementById("searchbuttonfixed");
  var b = document.getElementById("searchbuttonsfixed");



  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
    a.style.display = "block";
    b.style.display = "none";
    $('.fa-search').addClass('active-30-button');
  } else {
    x.style.display = "none";
    y.style.display = "block";
    a.style.display = "none";
    b.style.display = "block";
    $('.fa-search').removeClass('active-30-button');
  }
}


</script>


<script>
$(".typeheads1").keyup(function(){

var search = $(".typeheads1").val();
var cat = $(".category-value").val();
$('.btn-close-search-40').show();
$("#search-width-hide").removeClass("search-field-module-width-show");
$("#search-width-hide").addClass("search-field-module-width-hide");
var pro = "{{ URL::to('/qrcodedetail')}}";


if(search != "")
{
	var content ='';
  jQuery.ajax({
		 url: '{{ URL::to("/autocomplete")}}',
		 headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
		 type: "GET",
		  data: 'search='+search+'&cat='+cat,
		  dataType: 'JSON',
		  success: function (data) { 
			if(data !="")
				{
			$.each(data, function(index, item) 
			{
				content += '<a href="'+pro+'/'+item.slug+'"><div class="searchdropdown">';
				content += '<div class="row">';
				content += '<div class="col-4 col-md-4">';
				if(item.image_path_type == 'aws')
	  {
		content += '<img src="'+item.img+'"/ style="height:44px;width:65px;">';
	  }
	  else
	  {
		content += '<img src="'+imagep+item.img+'"/ style="height:44px;width:65px;">';
	  }
				content += '</div>';
				content += '<div class="col-8 col-md-8">';
				content += '<span style="white-space: normal;">'+item.name+'</span>';
				content += '</div>';
				content += '</div>';
				content += '</div></a>';
			
			});
		  }
		  else
		  {
			content += '<div class="row">';
			content += '<div class="col-12"><p style="text-align: center;padding: 10px;margin: 0;">No Product Available</p>';
			content += '</div>';
			content += '</div>';
		  }

			jQuery('.search_outer_con').addClass('enable_search');
			$('#viewsearchproduct').html(content);
		
		   
	},
	});

}
else
{
	jQuery('.search_outer_con').removeClass('enable_search');
$('.btn-close-search-40').hide();
$("#search-width-hide").addClass("search-field-module-width-show");
$("#search-width-hide").removeClass("search-field-module-width-hide");
}


});
</script>