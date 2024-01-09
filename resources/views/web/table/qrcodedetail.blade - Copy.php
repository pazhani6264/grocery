<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title><?=stripslashes($result['commonContent']['settings']['website_name'])?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- Include js plugin -->
       @include('web.common.scripts')

       
</head>
<style type="text/css">
	body{
		width: 100%;
	    overflow-x: hidden;
	}
	.cartc{
 	 background-color: #fff;
    /* position: fixed; */
    bottom: 0px;
    left: 0;
    right: 0;
    border-top: 1px solid #f5f5;
 }
 .ordernow{
 	border: solid 2px;
    border-radius: 20px;
    border-color: #1C0B72;
    width: 100%;
    color: #1C0B72;
    float: left;
 }
 .addtocart{
 	 background: #1C0B72;
    color: #fff;
    width: 100%;
    border-radius: 20px;
    float: right;

 }

 .button_plus_new
{
	height: 23px !important;
	font-size: 10px !important;
}



.button_minus_new
{
	height: 24px !important;
    font-size: 10px !important;
   
}
.notifications {
z-index: 9999 !important;
}

.notifications {
  display: none;
  position: fixed;
  bottom: 20px;
  left: 50%;
  width: 190px;
  background-color: black;
  margin-left: -95px;
  color: white;
  padding: 20px;
  text-align: center;
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
	@media only screen and (max-width: 600px){
		.col-sm-12 {
		    width:100%;
		}
		.col-md-6{
		width:49%;
		display: inline-block;
	}

	.button_plus_new
{
	height: 23px !important;
	font-size: 10px !important;
}



.button_minus_new
{
	height: 24px !important;
    font-size: 10px !important;
   
}
	}
</style>
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
</div><br><br><br><br>
<body>

	<div style="padding: 20px;">
 
   <div class="row">
   	<div class="col-md-12 col-sm-12">
   		 @if($result['detail']['product_data'][0]->default_images_path_type == 'aws')
   			<img src="{{$result['detail']['product_data'][0]->default_images }}" style="width: 100%; border-radius: 0 0 90% 90% / 10em;">
   		@else
   			<img src="{{asset('').$result['detail']['product_data'][0]->default_images }}" style="width: 100%; border-radius: 0 0 90% 90% / 10em;">
   		@endif
   		<h2 style="text-align: center;color: #1C0B72; font-weight: 600;">{{$result['detail']['product_data'][0]->products_name}}</h2>
   		<h4 style="text-align:center; font-weight: 600;">
   			 @foreach($result['detail']['product_data'][0]->categories as $key=>$category)
   			 {{$category->categories_name}}
   			 @endforeach
   		</h4>
   		<p style="text-align:center;font-weight: 600;">{{$result['detail']['product_data'][0]->products_description}}</p>
   		
   	</div>
   </div>

   <?php
  $currency = \App\Models\Core\Currency::where('id',session('currency_id'))->pluck('decimal_places'); 
        $decimal_places = count($currency) > 0 ? $currency[0] : 2;
?>

   <?php

            if(!empty($result['detail']['product_data'][0]->discount_price)){
              $discount_price = $result['detail']['product_data'][0]->discount_price * session('currency_value');
            }
            if(!empty($result['detail']['product_data'][0]->flash_price)){
              $flash_price = $result['detail']['product_data'][0]->flash_price * session('currency_value');
            }
              $orignal_price = $result['detail']['product_data'][0]->products_price * session('currency_value');


             if(!empty($result['detail']['product_data'][0]->discount_price)){

              if(($orignal_price+0)>0){
                $discounted_price = $orignal_price-$discount_price;
                $discount_percentage = $discounted_price/$orignal_price*100;
                $discounted_price = $result['detail']['product_data'][0]->discount_price;

             }else{
               $discount_percentage = 0;
               $discounted_price = 0;
             }
            }
            else{
              $discounted_price = $orignal_price;
            }
            //  dd($result['currency_value']);
  ?>

   <form name="attributes" id="add-Product-form" method="post" >
            <input type="hidden" name="products_id" value="{{$result['detail']['product_data'][0]->products_id}}">
            <input type="hidden" name="special_discount" id="special_discount" value="no">
            <input type="hidden" name="special_price" id="special_price" value="">
            <input type="hidden" name="org_price" id="org_price" value="">

             <input type="hidden" name="products_price" id="products_price" value="@if(!empty($result['detail']['product_data'][0]->flash_price)) {{$result['detail']['product_data'][0]->flash_price+0}} @elseif(!empty($result['detail']['product_data'][0]->discount_price)){{$result['detail']['product_data'][0]->discount_price+0}}@else{{$result['detail']['product_data'][0]->products_price+0}}@endif">

             <input type="hidden" id="max_order" value="@if(!empty($result['detail']['product_data'][0]->products_max_stock)){{ $result['detail']['product_data'][0]->products_max_stock }}@else 0 @endif" >

   @if(count($result['detail']['product_data'][0]->attributes)>0)
          <div class="pro-options row">
          <?php
              $index = 0;
          ?>
            @foreach( $result['detail']['product_data'][0]->attributes as $key=>$attributes_data )
            <?php
                $functionValue = 'function_'.$key++;
            ?>
            <input type="hidden" name="option_name[]" value="{{ $attributes_data['option']['name'] }}" >
            <input type="hidden" name="option_id[]" value="{{ $attributes_data['option']['id'] }}" >
            <input type="hidden" name="{{ $functionValue }}" id="{{ $functionValue }}" value="0" >
            <input id="attributeid_<?=$index?>" type="hidden" value="">
            <input id="attribute_sign_<?=$index?>" type="hidden" value="">
            <input id="attributeids_<?=$index?>" type="hidden" name="attributeid[]" value="" >
            
              <div class="attributes col-12 col-md-4 box">
                  <label class="">{{ $attributes_data['option']['name'] }}</label>
                  <div class="select-control">
                  <select name="{{ $attributes_data['option']['id'] }}" onChange="getQuantity()" class="currentstock form-control attributeid_<?=$index++?>" attributeid = "{{ $attributes_data['option']['id'] }}">
                    @if(!empty($result['cart']))
                      @php
                        $value_ids = array();
                        foreach($result['cart'][0]->attributes as $values){
                            $value_ids[] = $values->options_values_id;
                        }
                      @endphp
                        @foreach($attributes_data['values'] as $values_data)
                          @if(!empty($result['cart']))
                          <option @if(in_array($values_data['id'],$value_ids)) selected @endif attributes_value="{{ $values_data['products_attributes_id'] }}" value="{{ $values_data['id'] }}" prefix = '{{ $values_data['price_prefix'] }}'  value_price ="{{ $values_data['price']+0 }}" >{{ $values_data['value'] }}</option>
                          @endif
                        @endforeach
                      @else
                      
                        @foreach($attributes_data['values'] as $values_data)
                        
                          <option @if($values_data['is_default']) selected @endif attributes_value="{{ $values_data['products_attributes_id'] }}" value="{{ $values_data['id'] }}" prefix = '{{ $values_data['price_prefix'] }}'  value_price ="{{ $values_data['price']+0 }}" >{{ $values_data['value'] }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div> 
                </div>                 
            
            @endforeach
          </div>
          @endif
         </form>
</div>

<div class="notifications" id="notificationWishlist"></div>
<input type="hidden" value="1" id="tooltip-flag">
   <div class="cartc">
<div class="row">
	<div class="col-md-12">
		<div class="col-md-6" style="margin-top: 10px;">
			<div class="total_price" id="total_dis_price" style="font-size: 25px;font-weight: 600;">{{Session::get('symbol_left')}} {{ number_format($orignal_price,$decimal_places) }} {{Session::get('symbol_right')}}</div>
		</div>
		<div class="col-md-6" style="margin-top: 10px;">
			<div style="float: right;">
				<div class="input-group item-quantity">                    
                  {{-- <input type="text" id="quantity1" name="quantity" class="form-control" value="10">                       --}}

                  @if($result['detail']['product_data'][0]->products_type == 0)

                  @if($result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_max_stock && $result['detail']['product_data'][0]->products_max_stock !=0)

                  <input type="text" style="background: #f7f7f8;" readonly name="quantity" class="form-control qty" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">
                    @else

                    <input type="text" style="background: #f7f7f8;" readonly name="quantity" class="form-control qty" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->defaultStock}}">    <span class="input-group-btn">

                    @endif
                    

                  @elseif($result['detail']['product_data'][0]->products_type == 1)

                  <input type="text" style="background: #f7f7f8;" readonly name="quantity" class="form-control qty type_one" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">
                  @else

<input type="text" style="background: #f7f7f8;" readonly name="quantity" class="form-control qty type_one" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">


                  @endif

                  <input type="hidden" id="max_stock_one" value="{{$result['detail']['product_data'][0]->products_max_stock}}">


                  
                      <button type="button" class="quantity-plus1 qtyplus button_plus_new" >
                          <i class="fa fa-plus"></i>
                      </button>
                  
                      <button type="button" class=" quantity-minus1 button_minus_new  qtyminus" >
                          <i class="fa fa-minus"></i>
                      </button>
                  </span>
                </div>
			</div>
		</div>
		<div class="col-md-6">
			<a href="{{ URL::to('/qrcodecart')}}"><button type="button" class="btn btn-light ordernow">Order Now</button></a>
		</div>
		<div class="col-md-6">
			
			<button type="button" class="btn btn-light addtocart add-to-Cart">Add To Cart</button>
		
		</div>
	</div>
</div>
</div>
</body>
</html>