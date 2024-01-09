<!DOCTYPE html>
<html>
    <head>
        <title>REVIEW ORDER</title>
        <meta charset="utf-8">
        <meta name="description" content="QRCODE Scanning">
        <meta name="keywords" content="QRCODE Scanning">
        <meta name="author" content="Platinum Code">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name = "viewport" content = "width=device-width, minimum-scale=1.0, maximum-scale = 1.0, user-scalable = no">
        @php
        $color_style = DB::table('settings')->where('id',236)->first();
        $color = DB::table('settings')->where('id',237)->first();
        $country_id = DB::table('settings')->where('id',235)->first();
        $tax_class = DB::table('settings')->where('id',234)->first();
		$inv = DB::table('settings')->where('id',145)->first();

        if(session('language_id') == '')
		{
			$language_id = 1;
		}
		else
		{
			$language_id = session('language_id');
		}
        $label1 = DB::table('table_label_value')->where('label_id',11)->where('language_id', '=', $language_id)->first();
        $label2 = DB::table('table_label_value')->where('label_id',20)->where('language_id', '=', $language_id)->first();
        $label3 = DB::table('table_label_value')->where('label_id',21)->where('language_id', '=', $language_id)->first();
        $label4 = DB::table('table_label_value')->where('label_id',22)->where('language_id', '=', $language_id)->first();
      
    @endphp
       
       <link rel="stylesheet" type="text/css" href="{{asset('web/table').'/'.$color_style->value}}.css">
        <link rel="stylesheet" href="{{asset('web/table/font-awesome/css/all.min.css')}}">
        <script src="https://js.stripe.com/v3/"></script>

<link rel="stylesheet" type="text/css" href="{{asset('web/css/stripe.css') }}" data-rel-css="" />
    </head>
    <body>

    <style>
        main > .container-lg .example {
    -ms-flex-align: center;
    -webkit-box-align: center;
    align-items: center;
    border-radius: unset;
    box-shadow: unset;
    padding: 20px 10px;
    margin-left: 0;
    margin-right: 0;
}
.pc-review-order-button {
   
    height: 100%;
}
.modal-bank-width {
   
    position: fixed;
   top: unset !important;
   left: 0;
   transform: unset !important;
   z-index: 9999;
   background-color: #fff;
   margin: auto;
   width: 100% !important;
   box-shadow: 0 0 1.5em hsla(0, 0%, 0%, 0.35);
   text-align: center;
   border-radius: unset;
   bottom: 0 !important;
   right: 0 !important;
   border-top-left-radius: 2.5rem;
    border-top-right-radius: 2.5rem;
   
}

.bottom-sheet-btn
{
    min-width: 100% !important; max-width: 100% !important; border: none; border-radius: unset !important;
    display: flex;
    align-items: center;
    justify-content: center;

}

        .pc-in-button-main {
            display: flex;
            align-items: center;
            justify-content: space-around;
        }
        .pc-review-order-button {
            min-width: 48%;
            max-width: 50%;
        }

        .modal-content {
    padding: 2em 1em 0 1em;
    text-align: center;
}
.button.mobile-align-check-btn {
    margin: 20px;
    color: #fff;
    cursor: pointer;
}
.button.mobile-align-check-btn a{
    color: #fff;
    cursor: pointer;
}

.payonline-content {
    display: block;
    text-align: left;
}
.modal-width-online
{
   
   
   
   position: fixed;
   top: unset !important;
   left: 0;
   transform: unset !important;
   z-index: 9999;
   background-color: #fff;
   margin: auto;
   width: 100% !important;
   box-shadow: 0 0 1.5em hsla(0, 0%, 0%, 0.35);
   text-align: center;
   border-radius: unset;
   bottom: 0 !important;
   right: 0 !important;
   border-top-left-radius: 2.5rem;
    border-top-right-radius: 2.5rem;
  

}
        .modal.is-visible {
    visibility: visible;
    display: block;
}
    
    </style>
        <h1 class="pc-title mobile-none">This Site Only View on Mobile And Tab</h1>
        <div class="pc-mobile-tab">
            <div class="pc-in-main1">
                <div class="pc-review-order-header">
                    <div class="pc-review-order-header-main">
                        <div class="pc-review-order-header-left-main">
                        <a href="javascript:history.back()"><svg class="" style="margin-top:4px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g id="evaArrowIosBackOutline0"><g id="evaArrowIosBackOutline1"><path id="evaArrowIosBackOutline2" fill="currentColor" d="M13.83 19a1 1 0 0 1-.78-.37l-4.83-6a1 1 0 0 1 0-1.27l5-6a1 1 0 0 1 1.54 1.28L10.29 12l4.32 5.36a1 1 0 0 1-.78 1.64Z"/></g></g></svg></a>
                          <!-- <img src="{{asset('web/table/img/eng.png')}}" alt="Language"> -->
                        </div>
                        <div class="pc-review-order-header-right-main common-text">{{$label2->label_value}}</div>
                        <div class="pc-review-order-header-right-main1">
                            <!-- <a href="javascript:history.back()">
                                <img src="{{asset('web/table/img/close.png')}}" alt="Close">
                            </a> -->
                        </div>
                    </div>
                </div>
                @php
                  $symbol_left = DB::table('currencies')->where('symbol_left', '=', $data['orders_data'][0]->currency)->first();
                @endphp
                <div class="cart-pages">
                  <table>
                      <tbody>

                      @php   $pro_ba_tax = 0; @endphp
                        @foreach($data['orders_data'][0]->data as $products)
                          <tr>
                            <td style="width:45%">
                              <div class="head">{{  $products->products_name }} </div>

                              <?php
  $uniqueOptions = [];


foreach($products->attribute as $attributes){

    $options = $attributes->products_options;
    $values = $attributes->products_options_values;

    if (!isset($uniqueOptions[$options])) {
      $uniqueOptions[$options] = [];
    }

    $uniqueOptions[$options][] = $values;

}

  ?>



@foreach($uniqueOptions as $option => $values)
  <div class="item">- {{ $option }} ({{ implode(', ', $values) }})</div>
@endforeach


                              <?php 
                                    $prod = DB::table('products')->where('products_id',$products->products_id)->where('products_status',1)->first();
                                ?>
                              @if($prod->products_type == 3)
                                <?php
                                  $comboPro = DB::table('product_combo')
                                  ->leftjoin('products_description','products_description.products_id','=','product_combo.product_id')
                                  ->leftjoin('categories_description','categories_description.categories_id','=','product_combo.cate_id')
                                  ->where('products_description.language_id', 1)
                                  ->where('categories_description.language_id', 1)
                                  ->where('product_combo.pro_id', $products->products_id)
                                  ->get();
                                ?>
                                  @foreach($comboPro as $comboProd)
                                      <div style="width:260px;" class="item">
                                          <small><b>Product Name :</b> {{$comboProd->products_name}}</small><br>
                                          <small><b>Category Name :</b> {{$comboProd->categories_name}}</small><br>
                                          <small><b>Qty :</b> {{$comboProd->qty}}</small><br>
                                      </div>
                                  @endforeach
                              @endif

                              @if($prod->products_type == 4)
                                <?php
                                $comboProbuyx = DB::table('product_buy_x')
                                ->leftjoin('products_description','products_description.products_id','=','product_buy_x.product_id')
                                ->leftjoin('categories_description','categories_description.categories_id','=','product_buy_x.cate_id')
                                ->where('products_description.language_id', 1)
                                ->where('categories_description.language_id', 1)
                                ->where('product_buy_x.pro_id', $products->products_id)
                                ->get();

                                $comboProgetx = DB::table('product_get_x')
                                ->leftjoin('products_description','products_description.products_id','=','product_get_x.product_id')
                                ->leftjoin('categories_description','categories_description.categories_id','=','product_get_x.cate_id')
                                ->where('products_description.language_id', 1)
                                ->where('categories_description.language_id', 1)
                                ->where('product_get_x.pro_id', $products->products_id)
                                ->get();

                                ?>
                                <h5>Buy X </h5>
                                @foreach($comboProbuyx as $comboProdbuyx)
                                    <div style="width:260px;" class="item">
                                        <small><b>Product Name :</b> {{$comboProdbuyx->products_name}}</small><br>
                                        <small><b>Category Name :</b> {{$comboProdbuyx->categories_name}}</small><br>
                                        <small><b>Qty :</b> {{$comboProdbuyx->qty}}</small><br>
                                    </div>
                                @endforeach

                                <h5>Get X </h5>
                                @foreach($comboProgetx as $comboProdgetx)
                                    <div style="width:260px;" class="item">
                                        <small><b>Product Name :</b> {{$comboProdgetx->products_name}}</small><br>
                                        <small><b>Category Name :</b> {{$comboProdgetx->categories_name}}</small><br>
                                        <small><b>Qty :</b> {{$comboProdgetx->qty}}</small><br>
                                    </div>
                                @endforeach
                            @endif

                            </td>
                            @php $pprice = $products->original_price*session('currency_value') @endphp
                            <td style="width:25%">{{intval($pprice)}} X {{ $products->customers_basket_quantity }} </td>
                            <td style="text-align: right;">
                          
                            <?php 
                        $final_price_new =  $products->original_price * $products->customers_basket_quantity *session('currency_value');
                        $sub_total_amount_new = number_format($final_price_new, 2);
                      
                        if($tax_class->value == 2)
                        {
                          $pro_tax = DB::table('products')->where('products_id', $products->products_id)
                          ->first();

                         if($pro_tax->products_tax_class_id != 0){

                          $pro_tax_va = DB::table('tax_class')
                          ->LeftJoin('tax_rates', 'tax_rates.tax_class_id', '=', 'tax_class.tax_class_id')
                          ->where('tax_class.tax_class_id', $pro_tax->products_tax_class_id)->first();


                          $sub_total_amount_new = floatval(str_replace(',', '', $sub_total_amount_new));


                            $view_pro_tax = $pro_tax_va->tax_rate / 100 * $sub_total_amount_new * session('currency_value');
                          
                            $view_pro_tax = number_format($view_pro_tax, 2);
                            $view_pro_tax_new = floatval(str_replace(',', '', $view_pro_tax));
                           
                            $pro_ba_tax += $view_pro_tax_new;
                         }


                        }
                        
                        ?>
                        {{Session::get('symbol_left')}}  {{ $sub_total_amount_new}} {{Session::get('symbol_right')}}

                              
                            </td>
                          </tr>
                        @endforeach
                       
                      </tbody>
                  </table>
                </div>

                @php $final_tax_amount = 0; $total_amount_new = 0; @endphp
             

                @if(!empty($data['orders_data'][0]->data))
                <div class="pc-review-order-bottom">
                  <div class="pc-review-order-bottom-main">
                    <?php 
                      $final_price =  $data['subtotal'] * session('currency_value');
                      $total_amount_new = number_format($final_price, 2);

                      $taxdata = DB::table('tax_class')
                      ->LeftJoin('tax_rates', 'tax_rates.tax_class_id', '=', 'tax_class.tax_class_id')
                      ->where('tax_rates.tax_zone_id', $country_id->value)
                      ->where('tax_class.tax_type', 1)->get();

                   
                        
                    ?>



                    @if($tax_class->value == 0)

                    @php
                        $final_tax_amount = number_format($total_amount_new, 2);
                        @endphp
                        
                        <input type="hidden" class="total_qr_price" value="{{$final_tax_amount}}">
                        <div class="pc-review-order-bottom-price">{{$label1->label_value}} : {{Session::get('symbol_left')}}  {{ $final_tax_amount}} {{Session::get('symbol_right')}} </div>

                        @endif

                       

                        @php   $taxsum = 0; @endphp

                    @if($tax_class->value == 1)
                   
                      
                        <div class="pc-review-order-bottom-price">SubTotal : {{Session::get('symbol_left')}}  {{ $total_amount_new}} {{Session::get('symbol_right')}} </div>

                    
                       
                       
                        @if(count($taxdata)>0)
                          @foreach ($taxdata as $jescomtax)
                            @php
                          
                            $final_pricenn = floatval(str_replace(',', '', $final_price));

                           

                              $view_tax=$jescomtax->tax_rate / 100 * $final_pricenn;
                             
                              $view_tax_new = number_format($view_tax, 2);

                              $tax_new_amount = floatval(str_replace(',', '', $view_tax_new));

                           
                             
                              $taxsum += $tax_new_amount;

                           
                              
                              
                            @endphp
                        
                          
                            <div class="pc-review-order-bottom-price">{{$jescomtax->tax_class_title}} ({{$jescomtax->tax_rate}} %) : {{Session::get('symbol_left')}}  {{ $view_tax}} {{Session::get('symbol_right')}} </div>
                          @endforeach

                        @else
               
                        @endif

                        
                        @php

                    
                        $total_amount_new = floatval(str_replace(',', '', $total_amount_new));
                          $taxsum = floatval(str_replace(',', '', $taxsum)); 
                          $to = $total_amount_new + $taxsum;

                      
                        $final_tax_amount = number_format($to, 2);
                        @endphp
                     
                        <input type="hidden" class="total_qr_price" value="{{$final_tax_amount}}">
                        <div class="pc-review-order-bottom-price">{{$label1->label_value}} : {{Session::get('symbol_left')}}  {{ $final_tax_amount}} {{Session::get('symbol_right')}} </div>

                        @endif

                        @endif

                      

                        @if($tax_class->value == 2)

                        <div class="pc-review-order-bottom-price">SubTotal : {{Session::get('symbol_left')}}  {{ $total_amount_new}} {{Session::get('symbol_right')}} </div>
@php  $pro_ba_tax_new = number_format($pro_ba_tax, 2); @endphp



                        <div class="pc-review-order-bottom-price">Tax  : {{Session::get('symbol_left')}}  {{ $pro_ba_tax_new}} {{Session::get('symbol_right')}} </div>

                      

                          @php

                          $total_amount_new = floatval(str_replace(',', '', $total_amount_new));
                          $pro_ba_tax = floatval(str_replace(',', '', $pro_ba_tax)); 
                          $to = $total_amount_new + $pro_ba_tax;
                         
                        $final_tax_amount = number_format($to, 2);


                              @endphp

                              
                      
                              
                              <input type="hidden" class="total_qr_price" value="{{$final_tax_amount}}">
                              <div class="pc-review-order-bottom-price">{{$label1->label_value}} : {{Session::get('symbol_left')}}  {{ $final_tax_amount}} {{Session::get('symbol_right')}}</div>
                          @endif


                        <?php
				                  $hold = DB::table('hold')->where('session_id', session('table_qrcode'))->first();
			                  ?>
			                  @if($hold->hold_status != 2)
                          <div class="pc-in-button-main">
                              <button type="submit" style="margin-right:10px;" class="pc-review-order-button modal-toggle-cash">{{$label3->label_value}}</button>
                              <button type="submit" class="pc-review-order-button modal-toggle-payonline">{{$label4->label_value}}</button>
                          </div>
                        @endif
                    </div>
                </div>

              

             
              
            </div>
        </div>
     
     
        <div class="modal modal-cash">
            <div class="modal-overlay modal-toggle-cash"></div>
            <div class="modal-wrapper modal-transition">
            {!! Form::open(array('url' =>'placeatcounter', 'name'=>'deleteOrder', 'id'=>'confirm_form_submit', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
            
                <div class="modal-body confirm-hide-1" >
                    <div class="modal-content" >
                        <h2 class="modal-heading">Note</h2>
                        <p>Order cannot be Done once Confirmed</p>
                    </div>
                    <div class="modal-footer">
                        <div class="modal-footer-main">
                            <div class="modal-toggle-cash">Cancel</div>
                        </div>
                        <div class="modal-footer-main1">
                        
                        <button type="button" class="modal-confirm" id="deleteOrder">Confirm</button>
                        </div>
                    </div>
                </div>
                <div class="modal-body confirm-hide-2" style="display:none">
                    <div class="modal-content">
                        <h2 class="modal-heading" style="margin:10px 0;">... Loading</h2>
                        
                    </div>
                    
                </div>
            {!! Form::close() !!}
            </div>
        </div>
      
        <div class="modal modal-payonline">
            <div class="modal-overlay modal-toggle-payonline"></div>
            <div class="modal-wrapper modal-transition modal-width-online">
            {!! Form::open(array('url' =>'qrpayonline', 'name'=>'payonline', 'id'=>'confirm_form_submit', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
            
                <div class="modal-body confirm-hide-1" >
                    <div class="modal-content" style="padding:2rem 1rem 1.5rem 1.5rem;">
                        <!-- <h2 class="modal-heading"> @lang('website.Please select your payment method')</h2> -->

                        <input id="payment_currency" type="hidden" name="payment_currency" value="{{session('currency_code')}}">
                        <div class="payonline-content">
                        @foreach($result['payment_methods'] as $payment_methods)
                            @if($payment_methods['active']==1)
                                <input id="{{$payment_methods['payment_method']}}_public_key" type="hidden" name="public_key" value="{{$payment_methods['public_key']}}">
                                <input id="{{$payment_methods['payment_method']}}_environment" type="hidden" name="{{$payment_methods['payment_method']}}_environment" value="{{$payment_methods['environment']}}">

                                <?php

                                $payment_methods_new = DB::table('payment_methods')->where([['payment_method', '=', $payment_methods['payment_method']],])->first(); 

                                $payment_id = $payment_methods_new->payment_methods_id;
        
                                $check_cc_new = 0;
                                $key = $payment_methods['payment_method'].'_ccode';

                                if($payment_id !=4)
                                {
                                    if($payment_id !=9)
                                    {
                                      
                                      $payment_ccode = DB::table('payment_methods_detail')->where([
                                            ['payment_methods_id', '=', $payment_id],
                                            ['key', '=', $key],
                                        ])->first(); 
                        
                                        $ccode = json_decode($payment_ccode->value);
                        
                                        if($ccode != '')
                                        {
                        
                                            if (in_array(session('currency_code'), $ccode)) {
                                              $check_cc_new = 1;
                                            }
                                            else{
                                              $check_cc_new = 0;
                                            }
                                        }
                                        else{
                                          $check_cc_new = 1;
                                        } 
                                    }
                                    else{
                                      $check_cc_new = 1;
                                    }
                                }
                                else{
                                  $check_cc_new = 1;
                                }
                                

                               ?>
                              
                                    
                                   
                                    @if(auth()->guard('customer')->check())
                                    @if($payment_methods['name'] != 'Direct Bank Transfer')
                                    <div class="" style="height:100%;display:flex;align-items: center;margin: 2.5% 0;">
                                      @php 
                                        $id = auth()->guard('customer')->user()->id;
                                        $wallet  = DB::table('users')->where('id',$id)->first();
                                      @endphp 

                                   
                                      @if($final_tax_amount <= $wallet->wallet_amount)

                                        @if($check_cc_new == 1)
                                          <input onClick="paymentTable();" id="{{$payment_methods['payment_method']}}_label" type="radio" name="payment_method" class="form-check-input payment_method" style="margin:0 5% 0 5%" value="{{$payment_methods['payment_method']}}">  
                                        @else
                                          <input id="{{$payment_methods['payment_method']}}_label" type="radio" name="payment_method" class="form-check-input payment_method" style="margin:0 5% 0 5%" value="{{$payment_methods['payment_method']}}" disabled>  
                                        @endif
                                      @else
                                        @if($payment_methods['payment_method'] == 'wallet')
                                          <input id="{{$payment_methods['payment_method']}}_label" type="radio" name="payment_method" class="form-check-input payment_method" style="margin:0 5% 0 5%" value="{{$payment_methods['payment_method']}}" disabled>  
                                          
                                        @else
                                         
                                          @if($check_cc_new == 1)
                                          <input onClick="paymentTable();" id="{{$payment_methods['payment_method']}}_label" type="radio" name="payment_method" class="form-check-input payment_method" style="margin:0 5% 0 5%" value="{{$payment_methods['payment_method']}}">  
                                        @else
                                          <input id="{{$payment_methods['payment_method']}}_label" type="radio" name="payment_method" class="form-check-input payment_method" style="margin:0 5% 0 5%" value="{{$payment_methods['payment_method']}}" disabled>  
                                        @endif
                                        @endif
                                      @endif 
                                        <label class="form-check-label" style="line-height:2" for="{{$payment_methods['payment_method']}}_label">
                                       
                                          @if($payment_methods['name'] != 'Wallet')
                                            {{$payment_methods['name']}}
                                          @else
                                            {{$payment_methods['name']}} <span class="common-text">({{Session::get('symbol_left')}}  {{ $wallet->wallet_amount}} {{Session::get('symbol_right')}}) </span>
                                          @endif
                                        </label>  
                                    </div>
                                    @endif
                                    @else 
                                        @if($payment_methods['name'] != 'Wallet' && $payment_methods['name'] != 'Direct Bank Transfer')
                                        <div class="" style="height:100%;display:flex;align-items: center;margin: 2.5% 0;">
                                        @if($check_cc_new == 1)
                                          <input onClick="paymentTable();" id="{{$payment_methods['payment_method']}}_label" type="radio" name="payment_method" class="form-check-input payment_method" style="margin:0 5% 0 5%" value="{{$payment_methods['payment_method']}}">  
                                        @else
                                          <input id="{{$payment_methods['payment_method']}}_label" type="radio" name="payment_method" class="form-check-input payment_method" style="margin:0 5% 0 5%" value="{{$payment_methods['payment_method']}}" disabled>  
                                        @endif
                                          
                                            <label class="form-check-label" style="line-height:2" for="{{$payment_methods['payment_method']}}_label">
                                                {{$payment_methods['name']}}
                                            </label>
                                        </div>
                                        @endif
                                    @endif
                                    
                                        
                              
                            @endif
                        @endforeach 
                        </div>
                    </div>

                 

                    <div class="button pay_btn_con_show mobile-align-check-btn common-bg" style="margin:0;height:40px;display: none;"><span class="span_hide_new" style="padding: 0.6rem 1rem;font-size: 1rem;display:block;s">Order Now </span>
       
            <button id="braintree_button" style="display: none;" class="pc-review-order-button btn btn-dark payment_btns" data-toggle="modal" data-target="#braintreeModel" >@lang('website.Order Now')</button>

            <input type="hidden" id="hide_pay_btn_new" value="0">

            <button id="stripe_button" class="pc-review-order-button bottom-sheet-btn btn btn-dark payment_btns modal-toggle-stripe" style="display: none" data-toggle="modal" data-target="#stripeModel" >@lang('website.Order Now')</button>

           
          

            <a href="{{ URL::to('/wallet_table_response')}}" id="wallet_button" class=" btn btn-dark pc-review-order-button bottom-sheet-btn payment_btns btn_disable"  style="display: none"  type="button">@lang('website.Order Now')</a>
            
           

            <button id="razor_pay_button" class="pc-review-order-button bottom-sheet-btn razorpay-payment-button checkout-2-w-100 btn btn-dark payment_btns"  style="display: none;"  type="button">@lang('website.Order Now')</button>

            <a href="{{ URL::to('/qrcode_paytm')}}" id="pay_tm_button" class=" btn btn-dark pc-review-order-button bottom-sheet-btn payment_btns btn_disable"  style="display: none"  type="button">@lang('website.Order Now')</a>

            <button id="instamojo_button" class="pc-review-order-button bottom-sheet-btn btn btn-dark checkout-2-w-100 payment_btns" style="display: none;" data-toggle="modal" data-target="#instamojoModel">@lang('website.Order Now')</button>

            <a href="{{ URL::to('/checkout/hyperpay')}}" id="hyperpay_button" class="pc-review-order-button bottom-sheet-btn btn btn-dark payment_btns" style="display: none;">@lang('website.Order Now')</a>

            <button id="banktransfer_button" class="pc-review-order-button bottom-sheet-btn btn btn-dark pc-review-order-button payment_btns modal-toggle-banktransfer " style="display: none">@lang('website.Order Now')</button>

            <button id="paystack_button" class="pc-review-order-button bottom-sheet-btn btn btn-dark payment_btns" style="display: none;">@lang('website.Order Now')</button>

            <button id="midtrans_button" class="pc-review-order-button bottom-sheet-btn btn btn-dark payment_btns" style="display: none;">@lang('website.Order Now')</button>

            <a  id="ipay88_button" class="pc-review-order-button bottom-sheet-btn btn ipay88_form_submit checkout-2-w-100 btn-dark payment_btns btn_disable" style="display: none;color:#fff;">@lang('website.Order Now')</a>

            <a id="senangpay_button" class="pc-review-order-button bottom-sheet-btn btn btn-dark payment_btns btn_disable checkout-2-w-100 senangpay_form_submit" style="display: none;color:#fff;">@lang('website.Order Now')</a>

            <a href="{{ URL::to('/checkout/paynetfpx')}}" id="paynet_fpx_button" class="pc-review-order-button bottom-sheet-btn btn btn-dark payment_btns" style="display: none;">@lang('website.Order Now')</a>

            <a href="{{ URL::to('/checkout/premierpay')}}" id="PremierPay_button" class="pc-review-order-button bottom-sheet-btn btn btn-dark checkout-2-w-100 payment_btns btn_disable" style="display: none;">@lang('website.Order Now')</a>

            <span id="payment_error-error-text" style="color:#000;"></span>

         </div>

                   <!--  <div class="modal-footer">
                        <div class="modal-footer-main">
                            <div class="modal-toggle-payonline">Cancel</div>
                        </div>
                        <div class="modal-footer-main1">
                        
                        <button type="button" class="modal-confirm" id="deleteOrder">Confirm</button>
                        </div>
                    </div> -->
                </div>
                <div class="modal-body confirm-hide-2" style="display:none">
                    <div class="modal-content">
                        <h2 class="modal-heading" style="margin:10px 0;">... Loading</h2>
                        
                    </div>
                    
                </div>
            {!! Form::close() !!}
            </div>
        </div>


         <!-- The stripe Modal -->
         <div class="modal modal-stripe" id="stripeModel">
         <div class="modal-overlay modal-toggle-stripe"></div>
            <div class="modal-wrapper modal-transition modal-width-online">
                      <div class="modal-content" style="padding: 2em 1em 1em 1em" >

                      <main>
                      <div class="container-lg">
                          <div class="cell example example2" style="padding: 0;min-height: auto;">
                          <form method='POST' id="update_cart_form"  action='{{ URL::to('/stripe_table_payment')}}' enctype="multipart/form-data">
                             {!! csrf_field() !!}
                                <div class="row">
                                  <div class="field">
                                    <div id="example2-card-number" class="input empty"></div>
                                    <label for="example2-card-number" data-tid="elements_examples.form.card_number_label">@lang('website.Card number')</label>
                                    <div class="baseline"></div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="field half-width">
                                    <div id="example2-card-expiry" class="input empty"></div>
                                    <label for="example2-card-expiry" data-tid="elements_examples.form.card_expiry_label">@lang('website.Expiration')</label>
                                    <div class="baseline"></div>
                                  </div>
                                  <div class="field half-width">
                                    <div id="example2-card-cvc" class="input empty"></div>
                                    <label for="example2-card-cvc" data-tid="elements_examples.form.card_cvc_label">@lang('website.CVC')</label>
                                    <div class="baseline"></div>
                                  </div>
                                </div>
                              <button type="submit" class="btn btn-dark common-bg" data-tid="elements_examples.form.pay_button" style="margin: 0;width: 100%;margin-top: 40px;">@lang('website.Pay')  {{ $final_tax_amount }}</button>

                                <div class="error" role="alert"><svg xmlns="https://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                                    <path class="base" fill="#000" d="M8.5,17 C3.80557963,17 0,13.1944204 0,8.5 C0,3.80557963 3.80557963,0 8.5,0 C13.1944204,0 17,3.80557963 17,8.5 C17,13.1944204 13.1944204,17 8.5,17 Z"></path>
                                    <path class="glyph" fill="#FFF" d="M8.5,7.29791847 L6.12604076,4.92395924 C5.79409512,4.59201359 5.25590488,4.59201359 4.92395924,4.92395924 C4.59201359,5.25590488 4.59201359,5.79409512 4.92395924,6.12604076 L7.29791847,8.5 L4.92395924,10.8739592 C4.59201359,11.2059049 4.59201359,11.7440951 4.92395924,12.0760408 C5.25590488,12.4079864 5.79409512,12.4079864 6.12604076,12.0760408 L8.5,9.70208153 L10.8739592,12.0760408 C11.2059049,12.4079864 11.7440951,12.4079864 12.0760408,12.0760408 C12.4079864,11.7440951 12.4079864,11.2059049 12.0760408,10.8739592 L9.70208153,8.5 L12.0760408,6.12604076 C12.4079864,5.79409512 12.4079864,5.25590488 12.0760408,4.92395924 C11.7440951,4.59201359 11.2059049,4.59201359 10.8739592,4.92395924 L8.5,7.29791847 L8.5,7.29791847 Z"></path>
                                  </svg>
                                  <span class="message"></span></div>
                              </form>
                                          <div class="success">
                                            <div class="icon">
                                              <svg width="84px" height="84px" viewBox="0 0 84 84" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
                                                <circle class="border" cx="42" cy="42" r="40" stroke-linecap="round" stroke-width="4" stroke="#000" fill="none"></circle>
                                                <path class="checkmark" stroke-linecap="round" stroke-linejoin="round" d="M23.375 42.5488281 36.8840688 56.0578969 64.891932 28.0500338" stroke-width="4" stroke="#000" fill="none"></path>
                                              </svg>
                                            </div>
                                            <h3 class="title" data-tid="elements_examples.success.title">@lang('website.Payment successful')</h3>
                                            <p class="message"><span data-tid="elements_examples.success.message">@lang('website.Thanks You Your payment has been processed successfully')</p>
                                          </div>

                                      </div>
                                  </div>
                              </main>
                          </div>
                    </div>
                </div>
          </div>

        </div>


        <div class="modal modal-banktransfer">
            <div class="modal-overlay modal-toggle-banktransfer"></div>
            <div class="modal-wrapper modal-transition modal-bank-width">
            <form method='POST' id=""  action='{{ URL::to('/banktransfer_table_payment')}}' enctype="multipart/form-data">

             {!! csrf_field() !!}
                <div class="modal-body confirm-hide-1" >
                    <div class="modal-content" >
                        <h2 class="modal-heading">@lang('website.Bank Detail')</h2>
                        
          <div class="row">
            <div class="col-12 col-md-4">
                
  
                <table class="table order-id">
                    <tbody>
                        <tr class="d-flex">
                          <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">@lang('website.orderID')</td>
                            <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">
                            <span class="badge badge-primary"><a href="{{url('/view-order/'.session('orders_id'))}}" class="btn-link"></a></span>
                            </td>
                          </tr>
                          <tr class="d-flex">
                            <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">@lang('website.Bank')</td>
                            <td class="underline col-6 col-md-6" align="left" style="border-top: 0; border-bottom: 1px solid #dee2e6;">{{@$bankdetail['bank_name'] ?: '---' }}</td>
                          </tr>
                      </tbody>
                </table>
            </div>
            <div class="col-12 col-md-4">

                <table class="table order-id">
                  <tbody>
                      <tr class="d-flex">
                        <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">@lang('website.account_name')</td>
                          <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">
                          {{@$bankdetail['account_name'] ?: '---' }}
                          </td>
                        </tr>
                        <tr class="d-flex">
                          <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">@lang('website.account_number')</td>
                          <td class="underline col-6 col-md-6" align="left" style="border-top: 0; border-bottom: 1px solid #dee2e6;">{{@$bankdetail['account_number'] ?: '---' }}</td>
                        </tr>
                    </tbody>
              </table>
            </div>
            <div class="col-12 col-md-4">

              <table class="table order-id">
                <tbody>
                    <tr class="d-flex">
                      <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">@lang('website.short_code')</td>
                        <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">
                        {{@$bankdetail['short_code'] ?: '---' }}
                        </td>
                      </tr>
                      <tr class="d-flex">
                        <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">@lang('website.iban')</td>
                          <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">
                          {{@$bankdetail['iban'] ?: '---' }}
                          </td>
                        </tr>
                      <tr class="d-flex">
                        <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">@lang('website.swift')</td>
                        <td class="underline col-6 col-md-6" align="left" style="border-top: 0; border-bottom: 1px solid #dee2e6;">{{@$bankdetail['swift'] ?: '---' }}</td>
                      </tr>
                  </tbody>
            </table>


          
           <div style="padding:20px 0;">
           <p style="color:red;text-align:left;margin-bottom:10px;">Please upload your Receipt</P>
            <input type="file" style="display:flex;" accept="image/*" name="bankimage" id="bankimage" required><br>
</div>
           
  
            </div>
            
          </div>
                    </div>
                    <div class="modal-footer">
                        <div class="modal-footer-main">
                            <div class="modal-toggle-banktransfer">Cancel</div>
                        </div>
                        <div class="modal-footer-main1">
                        
                        <button type="submit" class="" id="">Confirm</button>
                        </div>
                    </div>
                </div>
                <div class="modal-body confirm-hide-2" style="display:none">
                    <div class="modal-content">
                        <h2 class="modal-heading" style="margin:10px 0;">... Loading</h2>
                        
                    </div>
                    
                </div>
</form>
            </div>
        </div>




    </body>
</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="{!! asset('web/js/stripe_card.js') !!}" data-rel-js></script>

<script type="application/javascript">
(function() {
  'use strict';

  var elements = stripe.elements({
    fonts: [
      {
        cssSrc: 'https://fonts.googleapis.com/css?family=Source+Code+Pro',
      },
    ],
    // Stripe's examples are localized to specific languages, but if
    // you wish to have Elements automatically detect your user's locale,
    // use `locale: 'auto'` instead.
    locale: window.__exampleLocale
  });

  // Floating labels
  var inputs = document.querySelectorAll('.cell.example.example2 .input');
  Array.prototype.forEach.call(inputs, function(input) {
    input.addEventListener('focus', function() {
      input.classList.add('focused');
    });
    input.addEventListener('blur', function() {
      input.classList.remove('focused');
    });
    input.addEventListener('keyup', function() {
      if (input.value.length === 0) {
        input.classList.add('empty');
      } else {
        input.classList.remove('empty');
      }
    });
  });

  var elementStyles = {
    base: {
      color: '#32325D',
      fontWeight: 500,
      fontFamily: 'Source Code Pro, Consolas, Menlo, monospace',
      fontSize: '16px',
      fontSmoothing: 'antialiased',

      '::placeholder': {
        color: '#CFD7DF',
      },
      ':-webkit-autofill': {
        color: '#e39f48',
      },
    },
    invalid: {
      color: '#E25950',

      '::placeholder': {
        color: '#FFCCA5',
      },
    },
  };

  var elementClasses = {
    focus: 'focused',
    empty: 'empty',
    invalid: 'invalid',
  };

  var cardNumber = elements.create('cardNumber', {
    style: elementStyles,
    classes: elementClasses,
  });
  cardNumber.mount('#example2-card-number');

  var cardExpiry = elements.create('cardExpiry', {
    style: elementStyles,
    classes: elementClasses,
  });
  cardExpiry.mount('#example2-card-expiry');

  var cardCvc = elements.create('cardCvc', {
    style: elementStyles,
    classes: elementClasses,
  });
  cardCvc.mount('#example2-card-cvc');

  registerElements([cardNumber, cardExpiry, cardCvc], 'example2');
})();





//$.noConflict();
	//stripe_ajax
jQuery(document).on('click', '#stripe_ajax', function(e){
	jQuery('#loader').show();
	jQuery.ajax({
		headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
		url: '{{ URL::to("/stripeForm")}}',
		type: "POST",
		success: function (res) {
			if(res.trim() == "already added"){
			}else{
				jQuery('.head-cart-content').html(res);
				jQuery(parent).removeClass('cart');
				jQuery(parent).addClass('active');
			}
			message = "@lang('website.Product is added')";
			notification(message);
			jQuery('#loader').hide();
		},
	});
});


</script>

<script>
    // Quick & dirty toggle to demonstrate modal toggle behavior
    $('.modal-toggle-cash').on('click', function(e) {
        e.preventDefault();
        $('.modal-cash').toggleClass('is-visible');
    });

    $('.modal-toggle-payonline').on('click', function(e) {
        e.preventDefault();
        $('.modal-payonline').toggleClass('is-visible');
    });
    $('.modal-toggle-stripe').on('click', function(e) {
        e.preventDefault();
        $('.modal-stripe').toggleClass('is-visible');
        $('.modal-payonline').removeClass('is-visible');
    });

    $('.modal-toggle-banktransfer').on('click', function(e) {
        e.preventDefault();
        $('.modal-banktransfer').toggleClass('is-visible');
        $('.modal-payonline').removeClass('is-visible');
    });

    $('#deleteOrder').on('click', function() {
        
        $('.confirm-hide-1').hide();
        $('.confirm-hide-2').show();
        $( "#confirm_form_submit" ).submit();
       
    });

    

    jQuery(document).on('click', '.ipay88_form_submit', function(e){

        var amount = $('.total_qr_price').val();
        var product_name = 'All Items';
        var orders_id = '<?php  echo session('table_qrcode'); ?>';
     
        var response_url = '{{ URL::to("/tableipayresponse")}}';

        var url = "https://platinum24.online/request.php?spayid="+orders_id+"&samount="+amount+"&product_name="+product_name+"&response_url="+response_url+"";

        window.location.href = url;
});

jQuery(document).on('click', '.senangpay_form_submit', function(e){
    
        var orders_id = '<?php  echo session('table_qrcode'); ?>';
        var url = '{{ URL::to("/senangpay/table_requests")}}/'+orders_id;
        window.location.href = url;
   
});

    

// paymentMethods();
function paymentTable(){
  jQuery(".span_hide_new").show();
  jQuery("#hide_pay_btn_new").val('0');
	var currency_code = "{{session('currency_code')}}";
	jQuery('#loader').show();
	var payment_method = jQuery(".payment_method:checked").val();
   
  var onlinetype='orderproduct';
	var text = payment_method +' not support ' + currency_code +' Currency.';

	jQuery(".payment_btns").hide();

		jQuery.ajax({
			headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
			url: '{{ URL::to("/paymentcurrencychecktable")}}',
			type: "POST",
			data: '&payment_method='+payment_method+'&currency_code='+currency_code,
			success: function (res) {
               
					if(res == 0)
					{
            jQuery('#payment_error').hide();
            jQuery("#"+payment_method+'_button').show();
            jQuery(".pay_btn_con_show").show();
            jQuery(".span_hide_new").hide();
					}
					else
					{	
						jQuery('#payment_error').hide();
            jQuery("#"+payment_method+'_button').show();
            jQuery(".pay_btn_con_show").show();
            jQuery(".span_hide_new").hide();
            
						jQuery.ajax({
							headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
							url: '{{ URL::to("/paymentComponent")}}',
							type: "POST",
              data: '&payment_method='+payment_method+'&onlinetype='+onlinetype,							success: function (res) {
								jQuery('#loader').hide();
							},
						});

					//midtrans transaction
					//jQuery(document).on('click', '#midtrans_button', function(e){

						if(payment_method == 'banktransfer'){
							jQuery('#payment_description').show();
						}else{
							jQuery('#payment_description').hide();
						}
						
						if(payment_method == 'midtrans'){
							jQuery('#loader').show();
							jQuery.ajax({
								headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
								url: '{{ URL::to("/midtrans/transaction")}}',
								type: "get",
								success: function (res) {
									jQuery('#loader').hide();
									jQuery('#payment_error').hide();
									
									var data = JSON.parse(res);
									var success = data.status;
									var message = data.message;
									var token = data.token;

									if(success==1){
										//var url = data.data.authorization_url;
										//window.location.href = url;
										jQuery('#midtransToken').val(token);
										

									}else{
										jQuery('#payment_error').show();
										jQuery('#payment_error-error-text').html(message);
									}

								},
							});
						}

					}
				
			},
		});
}



</script>