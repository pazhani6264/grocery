<style>

.select2-container {
min-width: 400px;
}

.select2-results__option {
padding-right: 20px;
vertical-align: middle;
}
.select2-results__option:before {
content: "";
display: inline-block;
position: relative;
height: 20px;
width: 20px;
border: 1px solid #495057;
border-radius: 4px;
background-color: #fff;
margin-right: 20px;
vertical-align: middle;
}
span.select2.select2-container.select2-container--default {
width: auto !important;
min-width: 131px;
max-width: 400px; 
}
.detail-8-select-control1.select-control::before {
font-family: "Font Awesome 5 Free";
font-weight: 900;
content: "\F107";
position: absolute;
color: #6c757d;
bottom: 36%;
right: 10px;
z-index: 1;
font-size: 12px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
display: none !important;
}
.select2-results__option[aria-selected=true]:before {
font-family:fontAwesome;
content: "\2713";
color: #fff;
background-color: #f77750;
border: 0;
display: inline-block;
padding-left: 5px;
}
.select2-container--default .select2-results__option[aria-selected=true] {
background-color: #fff;
}
.select2-container--default .select2-results__option--highlighted[aria-selected] {
background-color: #eaeaeb;
color: #272727;
}
.select2-container--default .select2-selection--multiple .select2-selection__clear {
display: none !important;
}
.select2-container--default .select2-selection--multiple {
margin-bottom: 10px;
}
.select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
border-radius: 4px;
}
.select2-container--default.select2-container--focus .select2-selection--multiple {
border-color: #f77750;
border-width: 1px;
}
.select2-container--default .select2-selection--multiple {
border-width: 1px;
}
.select2-container--open .select2-dropdown--below {

border-radius: 6px;
box-shadow: 0 0 10px rgba(0,0,0,0.5);

}
.select2-selection .select2-selection--multiple:after {
content: 'hhghgh';
}
/* select with icons badges single*/
.select-icon .select2-selection__placeholder .badge {
display: none;
}
.select-icon .placeholder {
/* 	display: none; */
}
.select-icon .select2-results__option:before,
.select-icon .select2-results__option[aria-selected=true]:before {
display: none !important;
/* content: "" !important; */
}
.select-icon  .select2-search--dropdown {
display: none;
}



.btn-group .select {
position: relative;
}
/* .btn-group .select input:checked + label {
background-color: #ffc107;
} */
.btn-group .select input:checked + label:hover, .btn-group .select input:checked + label:focus, .btn-group .select input:checked + label:active {
background-color: #ffc107;
}


.btn-group .select input:checked + label .tick-active{
color: #000;
background: none;
position: absolute;
right: 10px;
bottom: 10px;
width: 20px;
border-bottom: 20px solid #ffc107;
border-left: 20px solid transparent;
border-right: 0px solid transparent;
}

.btn-group .select input:checked + label .tick-active:before {
content: "\2713";
position: absolute;
right: 1px;
top: 4.5px;
color: #000;
font-family: 'Font Awesome 5 Brands';
font-weight: 900;
transform: rotate(5deg);
}


.btn-group .select input {
opacity: 0;
position: absolute;
}
.btn-group .select .button_select {
margin: 0 10px 10px 0;
display: flex;
background-color: transparent;
}
.btn-group .select .button_select:hover, .btn-group .select .button_select:focus, .btn-group .select .button_select:active {
background-color: transparent;
}

.option {
position: relative;
}
.option input {
opacity: 0;
position: absolute;
}
/* .option input:checked + span {
background-color: #ffc107;
} */
.option input:checked + span:hover, .option input:checked + span:focus, .option input:checked + span:active {
background-color: #ffc107;
}
.option .btn-option {
margin: 0 10px 10px 0;
display: flex;
background-color: transparent;
}
.option .btn-option:hover, .option .btn-option:focus, .option .btn-option:active {
background-color: transparent;
}


.option input:checked + span .tick-active{
color: #000;
background: none;
position: absolute;
right: 10px;
bottom: 10px;
width: 20px;
border-bottom: 20px solid #ffc107;
border-left: 20px solid transparent;
border-right: 0px solid transparent;
}

.option input:checked + span .tick-active:before {
content: "\2713";
position: absolute;
right: 1px;
top: 4.5px;
color: #000;
font-family: 'Font Awesome 5 Brands';
font-weight: 900;
transform: rotate(5deg);
}

.tick-active-new:before {
content: "\2713";
position: absolute;
right: 1px;
top: 4.5px;
color: #000;
font-family: 'Font Awesome 5 Brands';
font-weight: 900;
transform: rotate(5deg);
}
.tick-active-new {
right:0;bottom:0;height: 20px;background: none;position: absolute;width: 20px;border-bottom: 20px solid;border-left: 20px solid transparent;border-right: 0px solid transparent;
}

</style>



<style>

/* .modal-5-pro-title-outer {
padding-bottom: 30px !important;
margin-bottom:30px;
height: 100px;
overflow-y: auto;
overflow-x: hidden;
} */
.container{
  width:100% !important;
}

.modal .modal-dialog .modal-body .close {
outline: none;
font-size: 40px;
font-weight: normal;
position: absolute;
top: 5px;
right: 12px;
}

  .stmodal{
  fill:#777;
}


  .modalwh{
    width:50% !important;
    height:40px !important;
  }
.product-img--main {
   position: relative;
  overflow: hidden;
  /* margin-bottom: 30px; */
  width: 400px;
  height: 400px;
  float: left;
  margin: 10px;
  cursor: all-scroll;
}
.hover-model-add:hover
{
  fill: #fff !important;
  color: #fff !important;
}
.hover-underline:hover
{
   border-bottom:solid 1px;
}
.btn-new-underline-unset.btn-39-wishlist:hover {
    text-decoration: unset !important;
}
.product-img--main__image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-position: center;
    background-size: contain;
    background-repeat: no-repeat;
    -webkit-transition: -webkit-transform .5s ease-out;
    transition: -webkit-transform .5s ease-out;
    transition: transform .5s ease-out;
    transition: transform .5s ease-out,-webkit-transform .5s ease-out;
    cursor: all-scroll;
}

#myModal_molla .modal-content {
  height: 650px;
  overflow-y: hidden;
  border-radius:.3rem;
}

#myModal_molla .modal-body {
position: relative;
flex: 1 1 auto;
padding: 2rem;
}
.footer-darks .social-icon {
    justify-content: center;
    font-size: 1rem;
    width: 2.5rem;
    height: 2.5rem;
    color: #777 ;
    margin-right: 10px;
    background-color: transparent;
    border: 0.1rem solid #e1e2e6;
    border-radius: 50%;
    text-decoration: none;
    opacity: 1;
    -webkit-transition: all .35s ease;
    transition: all .35s ease;
}

.demo-image-zoom{
  cursor: all-scroll;
}
.demo-image-zoom:hover
{
    transform: scale(1.5);
}

  .quick-view-height {
    max-height: 150px;
    min-height: 30px;
    overflow-y: auto !important;
    margin-bottom:10px;
  }
  .row-scroll  .modal-body {
      position: relative;
      flex: 1 1 auto;
      padding: 2rem;
    }

    .slider-nav-detail .slick-slide {
outline: none;
padding: 0px !important;
opacity: 0.5;
}
.slider-nav-detail .slick-slide:hover {
outline: none;
padding: 0px !important;
opacity: 1;
}
/* .slider-nav .slick-current {
opacity: 1;
border:1px solid green;
} */
   .row-scroll .slider-wrapper .slider-for-detail {
      margin-bottom: 0px;
      height: 465px !important;
      width: 100%;
    }
   .row-scroll .slider-wrapper .slider-for-detail .slider-for__item img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .row-scroll .slick-track {
      position: relative;
      top: 0;
      left: 0;
      display: block;
      margin-left: initial;
      margin-right: auto;
    }
    .cart-button{
      width:49.5%;
    }
    .cart-button-width{
         width:100%;
      }

      .pop-height{
      height:115px !important;
      margin: 10px;
    }

    .row-scroll .slider-wrapper .slider-for-detail .slider-for__item img {
        width: 100%;
        height: 465px !important;
}

.shop-content .slider-wrapper .slider-for-detail .slider-for__item img {
        width: 100%;
        height: 400px !important;
}

    @media only screen and (min-width: 700px) and (max-width: 800px){

      #myModal_molla .modal-content {
        height: 96vh !important;
        border-radius:.3rem;
      }
      .modal-dialog {
max-width: 600px;
margin: 1.75rem auto;
}
.cart-button {
width: 45.5%;
}
      .cart-button-width{
         width:100%;
      }
      .row-scroll
      {
        overflow-y: auto;
        max-height: 87vh !important;
      }
      .new-width {
    max-width: 100% !important;
    flex: 0 0 100% !important;
}
.row-scroll  .modal .modal-dialog {
    width: 75%;
}
.row-scroll .slider-wrapper .slider-for-detail {
    margin-bottom: 20px;
    height: 400px;
    width: 100%;
}

.btn-39-wishlist{
      padding: 1rem 0rem !important;
      text-align: center;

    }
    .modal .modal-dialog .modal-body .pro-description .pro-counter {
margin-bottom: 0px;
}

    }
  @media (min-width: 992px){
    #myModal_molla .modal-lg, #myModal_molla .modal-xl {
      max-width: 1000px;
    }
  }

  @media only screen and (min-width: 300px) and (max-width: 600px){

    /* .slider-wrapper .slider-for {
      margin-bottom: 20px;
      height: 100% !important;
      width: 100%;
    } */

    .modalwh{
    width:100% !important;
    height:40px !important;
  }

  .cart-button {
    width: 100% !important;
}

    #myModal_molla .modal-content {
        height: 96vh !important;
        border-radius:.3rem;
      }

    .pop-height {
height: 100px !important;
}

.cart-button{
      width:67%;
    }
    .btn-39-wishlist{
      padding: 1rem 0rem !important;
      text-align: -webkit-left;

    }

    .modal .modal-dialog .modal-body .pro-description .pro-counter {
margin-bottom: 0px !important;
}

.row-scroll  .modal-content {
      height: 100% !important;
    }
      .row-scroll
      {
        overflow-y: auto;max-height: 100%;margin-top: 50px;min-height: 450px;height: 600px;
      }
      .row-scroll  .modal-open .modal {
    overflow-x: hidden;
    overflow-y: hidden;
    height: 97vh !important;
    margin-top: 10px;
}
.row-scroll .modal .modal-dialog .modal-body .close {
    margin: 20px 0;
    position: fixed;
    top: -2px;
}
.qtynewpad
{
  padding:10px !important;
}
 
      .new-width {
    max-width: 100% !important;
    flex: 0 0 100% !important;
}
.row-scroll .modal .modal-dialog {
    width:95%;

}
.row-scroll .modal-body {
    padding: 5px;
}
.row-scroll .slider-wrapper .slider-for {
    margin-bottom: 20px;
    height: 280px;
    width: 100%;
}

    }


    @media only screen and (max-width: 600px)
{
  .row-scroll .slider-wrapper .slider-for-detail {
    margin-bottom: 0px;
    height: 250px !important;
    width: 100%;
}
.footer-darks {
    margin-bottom: 100px;
}
.product-img--main {
    position: relative;
    overflow: hidden;
    /* margin-bottom: 30px; */
    width: 100%;
    height: 200px;
    float: left;
    margin: 10px;
    cursor: all-scroll;
}

}

   

.row-scroll .btn-secondary:hover{
  color:#fff !important;
}
</style>


<div class="row row-scroll">
  <div class="col-12 col-lg-12" style="height:90vh;overflow-y:auto;">
    <div class="pro-description">
      <div class="badges">
        <?php 
          $currency = \App\Models\Core\Currency::where('id',session('currency_id'))->pluck('decimal_places'); 
          $decimal_places = count($currency) > 0 ? $currency[0] : 2;
          $current_date = date("Y-m-d", strtotime("now"));

          $string = substr($result['detail']['product_data'][0]->products_date_added, 0, strpos($result['detail']['product_data'][0]->products_date_added, ' '));
          $date=date_create($string);
          date_add($date,date_interval_create_from_date_string($web_setting[20]->value." days"));

          $after_date = date_format($date,"Y-m-d");

          if($after_date>=$current_date){
            print '<span class="badge badge-info">';
            print __('website.New');
            print '</span>';
          }
        ?>

        <?php
          $discount_percentage = 0;
          if(!empty($result['detail']['product_data'][0]->discount_price)){
            $discount_price = $result['detail']['product_data'][0]->discount_price * session('currency_value');
          }
          $orignal_price = $result['detail']['product_data'][0]->products_price * session('currency_value');
          if(!empty($result['detail']['product_data'][0]->discount_price)){
            if(($orignal_price+0)>0){
              $discounted_price = $orignal_price-$discount_price;
              $discount_percentage = $discounted_price/$orignal_price*100;
            }else{
              $discount_percentage = 0;
              $discounted_price = 0;
            }
        ?>             
        <?php } ?>

        @if($discount_percentage>0)
          <span class="badge badge-danger"><?php echo (int)$discount_percentage; ?>%</span>
        @endif
      </div>

      <h4 style="margin: 10px 0px;font-size:24px !important;font-weight:400 !important">{{$result['detail']['product_data'][0]->products_name}}</h4><hr>

      <form name="attributes" id="add-Product-form" method="post" >
        <input type="hidden" name="products_id" value="{{$result['detail']['product_data'][0]->products_id}}">
        <input type="hidden" name="special_discount" id="special_discount" value="no">
        <input type="hidden" name="special_price" id="special_price" value="">
        <input type="hidden" name="org_price" id="org_price" value="">
        <input type="hidden" value="{{ number_format($result['detail']['product_data'][0]->products_filter_price,$decimal_places) }}" id="total_org_price_new">
        <input type="hidden" name="option_name_new" class="option_name_new" value="">
        <input type="hidden" name="option_id_new" class="option_id_new" value="">
        <input type="hidden" name="attributes_id_new" class="attributes_id_new" value="">
        <input type="hidden" name="function_id_new" class="function_id_new" value="">
        <input type="hidden" name="products_id" class="products_id_new" value="{{$result['detail']['product_data'][0]->products_id}}">
        <input type="hidden" name="products_type" class="products_type" value="{{$result['detail']['product_data'][0]->products_type}}">
        <input type="hidden" name="products_price" id="products_price" value="@if(!empty($result['detail']['product_data'][0]->flash_price)) {{$result['detail']['product_data'][0]->flash_price+0}} @elseif(!empty($result['detail']['product_data'][0]->discount_price)){{$result['detail']['product_data'][0]->discount_price+0}}@else{{$result['detail']['product_data'][0]->products_price+0}}@endif">
        <input type="hidden" name="checkout" id="checkout_url" value="@if(!empty(app('request')->input('checkout'))) {{ app('request')->input('checkout') }} @else false @endif" >
        <input type="hidden" id="max_order" value="@if(!empty($result['detail']['product_data'][0]->products_max_stock)) {{ $result['detail']['product_data'][0]->products_max_stock }} @else 0 @endif" >

       @if(!empty($result['cart']))
        <input type="hidden"  name="customers_basket_id" value="{{$result['cart'][0]->customers_basket_id}}" >
       @endif


        @if(count($result['detail']['product_data'][0]->attributes)>0)
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

            <div style="border:none !important" class="box mb-3">
            <label class="detail-8-att-label">{{ $attributes_data['option']['name'] }} @if($attributes_data['option']['options_required'] == 0) * @endif  @if($attributes_data['option']['options_select_type'] == 0) (Pick 1) @endif @if($attributes_data['option']['options_select_type'] == 1) (Pick Multiple) @endif</label>

            @if($attributes_data['option']['options_select_type'] == 0)

              <ul class="size-list js-size-list" data-select-id="SingleOptionSelector-<?=$index?>">
                @foreach($attributes_data['values'] as $values_data)
                  <li class="pc-category-variable-item-main  var-{{$values_data['id']}} common-color new-{{ $attributes_data['option']['id'] }}  @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif" style="display:inline-block;height: 40px !important;border: solid 1px;margin: 0 10px 10px 0;position:relative;">

                    <input type="hidden" value="{{ $values_data['price'] }}" prefix="{{ $values_data['price_prefix'] }}" class="radio_get var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif" >

                    <input type="hidden" value="{{ $attributes_data['option']['name'] }}" class="option_name var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                    <input type="hidden" value="{{ $attributes_data['option']['id'] }}" class="option_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                    
                    <input type="hidden" value="{{ $values_data['products_attributes_id'] }}" class="attributes_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                    <input type="hidden" value="{{$values_data['id']}}" class="function_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">


                    <label>
                      <input type="radio" class="radio-{{$values_data['id']}}" name="{{ $attributes_data['option']['id'] }}" style="display:none;"  @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) checked @endif @endif value="{{ $values_data['id'] }}" @if($attributes_data['option']['options_required'] == 0) onchange="updateActiveClass(event, {{$values_data['id']}}, {{ $attributes_data['option']['id'] }} , 'radio', '{{ $values_data['price_prefix'] }}', '{{ $values_data['price'] }}')" @else onclick="updateActiveClassradio(event, {{$values_data['id']}}, {{ $attributes_data['option']['id'] }} , 'radio', '{{ $values_data['price_prefix'] }}', '{{ $values_data['price'] }}')" @endif>

                      <!-- <div class="pc-category-variable-item-price">{{ $values_data['price_prefix'] }}{{ $values_data['price'] }}</div> -->
                      <div class="pc-category-variable-item cursor-pointer" style="text-align:center !important;width:100%;padding: 0.6rem 1.8rem;color: #212529;text-transform: uppercase;">{{ $values_data['value'] }}</div>
                    </label>
                    <span class="common-color @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) tick-active-new @endif @endif tick-common-{{ $attributes_data['option']['id'] }} tick-{{$values_data['id']}}"></span>
                  </li>
                @endforeach
              </ul>

            @else

              <ul class="size-list js-size-list">
                @foreach($attributes_data['values'] as $values_data)
                  <li class="pc-category-variable-item-main  common-color var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif" style="display:inline-block;height: 40px !important;border: solid 1px;margin: 0 10px 10px 0;position:relative;">
                  <input type="hidden" value="{{ $values_data['price'] }}" prefix="{{ $values_data['price_prefix'] }}" class="check_get var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                  <input type="hidden" value="{{ $attributes_data['option']['name'] }}" class="option_name var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                  <input type="hidden" value="{{ $attributes_data['option']['id'] }}" class="option_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                  <input type="hidden" value="{{ $values_data['products_attributes_id'] }}" class="attributes_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                  <input type="hidden" value="{{$values_data['id']}}" class="function_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                
                    <label>
                      <input type="checkbox" style="display:none;" @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) checked @endif @endif name="{{ $attributes_data['option']['id'] }}" value="{{ $values_data['id'] }}" onchange="updateActiveClass(event, {{$values_data['id']}}, {{ $attributes_data['option']['id'] }} , 'checkbox', '{{ $values_data['price_prefix'] }}', '{{ $values_data['price'] }}')"> 
                    <!--  <div class="pc-category-variable-item-price">{{ $values_data['price_prefix'] }}{{ $values_data['price'] }}</div> -->
                      <div class="pc-category-variable-item cursor-pointer" style="text-align:center !important;width:100%;padding: 0.6rem 1.8rem;color: #212529;text-transform: uppercase;">{{ $values_data['value'] }}</div>
                      <span class="common-color @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) tick-active-new @endif @endif  tick-common-{{ $attributes_data['option']['id'] }} tick-{{$values_data['id']}}"></span>
                    </label>
                  </li>
                @endforeach
              </ul>

            @endif
        </div>  

      @endforeach
    @endif

    <div style="padding-left:0px;padding-right:0px" class="col-md-12">
      <div style="padding-left:0px;padding-right:0px" class="col-md-4">
        <label>Qty</label>
        <input type="number" class="form-control" min="1" name="qty" value="1" placeholder="Qty"><br>
      </div>
    </div>
    

    <button class="btn btn-success btn-lg add-combo-product"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">Submit</button>

    <hr/>

    </form>

  </div>


<script>

$(".js-select2").select2({
closeOnSelect : false,
placeholder : "Placeholder",
// allowHtml: true,
allowClear: true,
tags: true // создает новые опции на лету
});
</script>

<script>
@if(!empty($result['detail']['product_data'][0]->products_type) and $result['detail']['product_data'][0]->products_type==1)
  //getQuantity();

  //gettotalval();
  cartPrice();
@endif

//reju check
jQuery(document).ready(function() {
  @if(!empty($result['detail']['product_data'][0]->attributes))
    @foreach( $result['detail']['product_data'][0]->attributes as $key=>$attributes_data )
  @php
    $functionValue = 'attributeid_'.$key;
    $attribute_sign = 'attribute_sign_'.$key++;
  @endphp

  //{{ $functionValue }}();
  function {{ $functionValue }}(){
      var value_price = jQuery('option:selected', ".{{$functionValue}}").attr('value_price');
      jQuery("#{{ $functionValue }}").val(value_price);
    }
    //change_options
  jQuery(document).on('change', '.{{ $functionValue }}', function(e){

        var {{ $functionValue }} = jQuery("#{{ $functionValue }}").val();

        var old_sign = jQuery("#{{ $attribute_sign }}").val();

        var value_price = jQuery('option:selected', this).attr('value_price');
        var prefix = jQuery('option:selected', this).attr('prefix');
        var current_price = jQuery('#products_price').val();
        var {{ $attribute_sign }} = jQuery("#{{ $attribute_sign }}").val(prefix);

        if(old_sign.trim()=='+'){
          var current_price = current_price - {{ $functionValue }};
        }

        if(old_sign.trim()=='-'){
          var current_price = parseFloat(current_price) + parseFloat({{ $functionValue }});
        }

        if(prefix.trim() == '+' ){
          var total_price = parseFloat(current_price) + parseFloat(value_price);
        }
        if(prefix.trim() == '-' ){
          total_price = current_price - value_price;
        }

        jQuery("#{{ $functionValue }}").val(value_price);
        jQuery('#products_price').val(total_price);
        var qty = jQuery('.qty').val();
        var products_price = jQuery('#products_price').val();
        var total_price = qty * products_price * <?=session('currency_value')?>;//pro-price
        //jQuery('.total_price').html('<?=Session::get('symbol_left')?>'+total_price.toFixed(2)+'<?=Session::get('symbol_right')?>');
        jQuery('.get_att_amount').html('<?=Session::get('symbol_left')?>'+total_price.toFixed(2)+'<?=Session::get('symbol_right')?>');
        //alert(total_price);
        
  });
  @endforeach
  getQuantity();
  //calculateAttributePrice();
  function calculateAttributePrice(){
    var products_price = jQuery('#products_price').val();
    jQuery(".currentstock").each(function() {
      var value_price  = jQuery('option:selected', this).attr('value_price');
      var prefix = jQuery('option:selected', this).attr('prefix');

      if(prefix.trim()=='+'){
        products_price = products_price - value_price;
      }

      if(prefix.trim()=='-'){
        products_price = products_price - value_price;
      }

    });
    jQuery('#products_price').val(products_price);
    jQuery('.total_price').html('<?=Session::get('symbol_left')?>'+products_price.toFixed(2)+'<?=Session::get('symbol_right')?>');
  }

  @endif

});







</script>
