<head>
  <meta charset="UTF-8">
  <meta name="description" content="Platinum24">
  <meta name="keywords" content="Platinum24">
  <meta name="author" content="Platinum24">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=stripslashes($result['commonContent']['settings']['website_name'])?></title>
</head>
<style type="text/css">
	* { 
	font-family: 'Lato', sans-serif;
	font-weight: 300;
	transition: all .1s ease; 
}

html, body {
		height: 100%;
}

.headercss { 
	font-size: 25px;
	color: #000; 
	font-weight: 600;
}

.page-section {
		/*height: 480px;*/
		width: 80%;
		margin-left: 12%;
		/* margin-top: 11%; */
		padding: 0.5em;
    /*background: linear-gradient(45deg, #43cea2 10%, #185a9d 90%);*/
		color: white;
		/*box-shadow: 0px 3px 10px 0px rgba(0,0,0,0.5);*/
}

.navigation {
  	position: fixed; 
		width: 9%;
		margin-left: 2%;
  	/*background-color: #999;*/
  	color: #fff;
  	text-align: center;
  }
	
  	.navigation__link {
			display: block;
    	color: #000; 
    	text-decoration: none;
    	padding: 1em;
			font-weight: 400;
	}
			
			.navigation__link:hover {
				background-color: #aaa;
			}
		
		   .navigation__link.active {
		   	color: black;
				 background-color: rgba(0,0,0,0.1);
		   }
 .imagecss{
 	    width: 30px;
    	height: 30px;
    	margin: auto;
 		}
 .fontcss{
 	font-size: 12px;
 	font-weight: 600;
 }
 .roundcss{
 	/*border: 1px solid #000;*/
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background-color: #e5e5e5;
    margin: auto;
    /*position: relative;*/
 }
 .imground{
 	width: 100%;
    height: 100%;
    object-fit: contain;
 }
 .cartc{
 	 background-color: #fff;
    position: fixed;
    bottom: 0px;
    left: 0;
    right: 0;
    border-top: 1px solid #f5f5;
 }

 @media only screen and (max-width: 600px){
 	.col-sm-6 {
    width:49%;
    display: inline-block;
	}

	.page-section {
		margin-left: 19%;
	}

	.navigation {
		width: 15%;
	}
	.fontcss {
		font-size: 8px;
	}
	.vmoblie{
		margin: 15px 0px;
	}

	.col-md-6{
		width:49%;
		display: inline-block;
	}
	.img-mobile {
		height: 100%;
		width: 100%;
		object-fit: contain;
	}
 }
 .navba {
  overflow: hidden;
  background-color: #333;
  position: fixed;
  top: 0;
  width: 100%;
}

.navba a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.navba a:hover {
  background: #ddd;
  color: black;
}
</style>

<link href='https://fonts.googleapis.com/css?family=Lato:100,400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="navba">
  <a href="{{ URL::to('/qrcodeorder')}}" style="width: 85px;height: 50px;">
  @if($result['commonContent']['settings']['sitename_logo']=='logo')
  <?php 
              $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['website_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 

              ?>
              @if($imagepath->path_type == 'aws')
                <img class="img-mobile" src="{{$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
              @else
                <img class="img-mobile" src="{{asset('').$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
              @endif
  @endif
  </a>
  <a style="float: right;" href="{{url('/orderhistory')}}"><i class="fa fa-history" style="font-size: 4.8rem;" aria-hidden="true"></i></a>
</div>
<br><br><br><br><br>
<nav class="navigation" id="mainNav">
	@if($result)
	@foreach($result['categories'] as $jescate)
		@php
			if($jescate->image_path_type=='aws'){
				$image=$jescate->image_path;
			}else{
				$image=asset('').$jescate->image_path;
			}
		@endphp
			<a class="navigation__link" href="#{{$jescate->categories_id}}"><img class="imagecss" src="{{$image}}"><div class="fontcss">{{$jescate->categories_name}}</div></a>
	@endforeach
	@endif
</nav>

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
<div class="page-section hero" id="{{$jescate->categories_id}}">
	<h1 class="headercss">{{$jescate->categories_name}}</h1>
		<div class="row">
			<div class="col-md-12">
				@if(!$product->isEmpty())
				@foreach($product as $jesproduct)

				@php
					if($jesproduct->image_path_type=='aws'){
						$proimage=$jesproduct->image_path;
					}else{
						$proimage=asset('').$jesproduct->image_path;
					}
				@endphp
				<a href="{{ URL::to('/qrcodedetail')}}/{{$jesproduct->products_slug}}"><div class="col-md-2 col-sm-6 vmoblie">
				<div class="roundcss">
					<img class="imground" src="{{ $proimage }}">	
				</div>
				<h5 style="color: #e58844; text-align:center; font-weight: 600;">{{$jesproduct->products_name}}</h5>
				{{-- <h5 style="color: #000; text-align:center; font-weight: 800;">{{$jesproduct->products_description}}</h5> --}}
				<h4 style="color: #000; text-align:center; font-weight: 800;">RM {{$jesproduct->products_price}}</h4>
			</div></a>
			@endforeach
			@endif
		</div>
	</div>
</div>
@endforeach
@endif

@php
  $total_amount=0;
  $qunatity=0;
@endphp
 @foreach($result['commonContent']['cart'] as $cart_data)
    @php
      $total_amount += $cart_data->final_price*$cart_data->customers_basket_quantity;
      $qunatity     += $cart_data->customers_basket_quantity;
    @endphp
 @endforeach
<div class="cartc">
<div class="row">
	<div class="col-md-12">
		<div class="col-md-6" style="margin-top: 10px;">
			<div style="font-size: 10px; font-weight: 600;">Price Estimation</div>
			<div style="font-size: 16px;font-weight: 600;">{{Session::get('symbol_left')}} {{ $total_amount*session('currency_value') }} {{Session::get('symbol_right')}}</div>
		</div>
		<div class="col-md-6" style="margin-top: 10px;">
			<a href="{{ URL::to('/qrcodecart')}}"><button style="float: right;" type="button" class="btn btn-primary">Order Now</button></a>
		</div>
	</div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('a[href*=#]').bind('click', function(e) {
				e.preventDefault(); // prevent hard jump, the default behavior

				var target = $(this).attr("href"); // Set the target as variable

				// perform animated scrolling by getting top-position of target-element and set it as scroll target
				$('html, body').stop().animate({
						scrollTop: $(target).offset().top
				}, 600, function() {
						location.hash = target; //attach the hash (#jumptarget) to the pageurl
				});

				return false;
		});
});

$(window).scroll(function() {
		var scrollDistance = $(window).scrollTop();

		// Show/hide menu on scroll
		//if (scrollDistance >= 850) {
		//		$('nav').fadeIn("fast");
		//} else {
		//		$('nav').fadeOut("fast");
		//}
	
		// Assign active class to nav links while scolling
		$('.page-section').each(function(i) {
				if ($(this).position().top <= scrollDistance) {
						$('.navigation a.active').removeClass('active');
						$('.navigation a').eq(i).addClass('active');
				}
		});
}).scroll();
</script>