<!DOCTYPE html>
<html>
    <head>
        <title>CONFIRM ORDER</title>
        <meta charset="utf-8">
        <meta name="description" content="QRCODE Scanning">
        <meta name="keywords" content="QRCODE Scanning">
        <meta name="author" content="Platinum Code">
        @php
        $setting = DB::table('settings')->where('id',236)->first();

        if(session('language_id') == '')
		{
			$language_id = 1;
		}
		else
		{
			$language_id = session('language_id');
		}
        $label1 = DB::table('table_label_value')->where('label_id',13)->where('language_id', '=', $language_id)->first();
        $label2 = DB::table('table_label_value')->where('label_id',14)->where('language_id', '=', $language_id)->first();
        $label3 = DB::table('table_label_value')->where('label_id',15)->where('language_id', '=', $language_id)->first();
        $label4 = DB::table('table_label_value')->where('label_id',16)->where('language_id', '=', $language_id)->first();
        $label5 = DB::table('table_label_value')->where('label_id',17)->where('language_id', '=', $language_id)->first();
        $label6 = DB::table('table_label_value')->where('label_id',18)->where('language_id', '=', $language_id)->first();
        $label7 = DB::table('table_label_value')->where('label_id',19)->where('language_id', '=', $language_id)->first();
        $label8 = DB::table('table_label_value')->where('label_id',11)->where('language_id', '=', $language_id)->first();
       
        
    @endphp
        <meta name = "viewport" content = "width=device-width, minimum-scale=1.0, maximum-scale = 1.0, user-scalable = no">
        <link rel="stylesheet" type="text/css" href="{{asset('web/table').'/'.$setting->value}}.css">
        <link rel="stylesheet" href="{{asset('web/table/font-awesome/css/all.min.css')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <?php $new = 1; ?>
    <body>
        <style>
            .pc-edit-button {
   
   margin-top: 0px;
  
}
        </style>
        <h1 class="pc-title mobile-none">This Site Only View on Mobile And Tab</h1>
        <div class="pc-mobile-tab">
            <div class="pc-in-main1">
                <div class="pc-review-order-header">
                    <div class="pc-review-order-header-main">
                        <div class="pc-review-order-header-left-main">
                             <a href="javascript:history.back()"><svg class="" style="margin-top:4px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g id="evaArrowIosBackOutline0"><g id="evaArrowIosBackOutline1"><path id="evaArrowIosBackOutline2" fill="currentColor" d="M13.83 19a1 1 0 0 1-.78-.37l-4.83-6a1 1 0 0 1 0-1.27l5-6a1 1 0 0 1 1.54 1.28L10.29 12l4.32 5.36a1 1 0 0 1-.78 1.64Z"/></g></g></svg></a> 
                        </div>
                        <div class="pc-review-order-header-right-main common-text">{{$label1->label_value}}</div>
                            <div class="pc-review-order-header-right-main1">
                            <!-- <a href="javascript:history.back()"><img src="{{asset('web/table/img/close.png')}}" alt="Close"></a> -->
                            </div>
                        </div>
                    </div>
                </div>
              
                
                @php
                    $total_amounts=0;
                  $total_amount=0;
                  $qunatity=0;
                @endphp
                <div class="cart-pages">
                    <table>
                        <tbody>
                         
                            @foreach($result['commonContent'] as $cart_data)
                                @php
                                    $total_amounts += $cart_data->original_price*$cart_data->customers_basket_quantity;
                                @endphp
                            @endforeach
                            @if($total_amounts == 0)
                                <tr>
                                    <td class="">{{$label2->label_value}}</td>
                                    <td class="" style="text-align: right;"><i class="fa  fa-trash-alt"></i> {{$label4->label_value}}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="selectdata">{{$label2->label_value}}</td>
                                    <td class="unselectdata">{{$label3->label_value}}</td>
                                    <td class="modal-toggle-delete clearhide" style="text-align: right;"><i class="fa  fa-trash-alt"></i> {{$label4->label_value}}</td>
                                    <td class="modal-toggle-deleteid delhide" style="text-align: right;"><i class="fa  fa-trash-alt"></i> {{$label5->label_value}}</td>
                                </tr>
                            @endif
                            @foreach($result['commonContent'] as $cart_data)
                                @php
                                $total_amount += $cart_data->original_price*$cart_data->customers_basket_quantity;
                                $qunatity     += $cart_data->customers_basket_quantity;
                                @endphp
                                <tr style="border:0px solid">
                                <td>
                                    <div class="ckboxhide" style="display:inline-block">
                                        <input name="ckdata[]" id="ckkbox" type="checkbox" value="{{ $cart_data->customers_basket_id }}"></input>
                                    </div>
                                    <div style="display:inline-block" class="head"> {{$cart_data->products_name}} </div>
                                    <?php 
                                        $data = DB::table('customers_basket_attributes')
                                            ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'customers_basket_attributes.products_options_id')
                                            ->join('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
                                            ->select('customers_basket_attributes.*', 'products_options_descriptions.*', 'products_options_values_descriptions.options_values_name')
                                            ->where('customers_basket_attributes.customers_basket_id', $cart_data->customers_basket_id)
                                            ->where('products_options_descriptions.language_id', 1)
                                            ->where('customers_basket_attributes.session_id', session('table_qrcode'))->distinct()
                                            ->get();

                                        $optionValues = [];

                                        foreach ($data as $result) {
                                            $optionName = $result->options_name;
                                            $optionValue = $result->options_values_name;
                                            
                                            if (!isset($optionValues[$optionName])) {
                                                $optionValues[$optionName] = [];
                                            }
                                            
                                            $optionValues[$optionName][] = $optionValue;
                                        }

                                        foreach ($optionValues as $optionName => $values) {
                                            ?>
                                            <div style="width:260px;" class="item">- <?php echo $optionName; ?>(<?php echo implode(', ', $values); ?>)</div>
                                            <?php
                                        } 
                                        ?>
                  

                                        <?php 
                                            $prod = DB::table('products')->where('products_id',$cart_data->products_id)->where('products_status',1)->first();
                                        ?>
                                        @if($prod->products_type == 3)
                                            <?php
                                            $comboPro = DB::table('product_combo')
                                            ->leftjoin('products_description','products_description.products_id','=','product_combo.product_id')
                                            ->leftjoin('categories_description','categories_description.categories_id','=','product_combo.cate_id')
                                            ->where('products_description.language_id', 1)
                                            ->where('categories_description.language_id', 1)
                                            ->where('product_combo.pro_id', $cart_data->products_id)
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
                                            ->where('product_buy_x.pro_id', $cart_data->products_id)
                                            ->get();

                                            $comboProgetx = DB::table('product_get_x')
                                            ->leftjoin('products_description','products_description.products_id','=','product_get_x.product_id')
                                            ->leftjoin('categories_description','categories_description.categories_id','=','product_get_x.cate_id')
                                            ->where('products_description.language_id', 1)
                                            ->where('categories_description.language_id', 1)
                                            ->where('product_get_x.pro_id', $cart_data->products_id)
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
                                <?php 
                        $final_price =  $cart_data->original_price*session('currency_value');
                        $cart_total_amount_new = number_format($final_price, 2);?>
                                <td style="text-align: right;">{{Session::get('symbol_left')}} <span id="<?php echo $cart_data->customers_basket_id; ?>"> {{$cart_total_amount_new}} </span> {{Session::get('symbol_right')}}</td>
                                </tr>
                                <tr>
                                <td>
                                    <?php $datas = DB::table('customers_basket_attributes')->where('customers_basket_id', $cart_data->customers_basket_id)->groupBy('customers_basket_id')->get();?>
                                    @foreach($datas as $results)
                                        @if($results->customers_basket_id !='')
                                            <a href="{{ URL::to('/edit_qrcodedetail')}}/{{$cart_data->customers_basket_id}}"><div class="pc-edit-button common-text">{{$label6->label_value}}</div></a>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <div class="quantity" style="margin-top:0px">
                                        <button type="button" onClick="decrement_quantity('<?php echo $cart_data->customers_basket_id; ?>')" class="quantity__minus"><span class="qty_title_minus">-</span></button>


                                        <?php

                                            $inventory_ref_id = '';
                                            $products_id = $cart_data->products_id;
                                            $productsType = DB::table('products')->join('product_combo','product_combo.product_id','=','products.products_id')->where('product_combo.pro_id', $products_id)->get();

                                            $resattributes = array();
                                            foreach($productsType as $proCType){
                                            if($proCType->attractive_id !=0){
                                                $resattributes[] = $proCType->attractive_id;
                                            }
                                            }


                                            // Normal Product stocks

                                            $norstocks = array();
                                            foreach($productsType as $proCType){
                                            if($proCType->products_type == 0) { 

                                                $stocksin = DB::table('inventory')->where('products_id', $proCType->product_id)->where('stock_type', 'in')->sum('stock');
                                                $stockOut = DB::table('inventory')->where('products_id', $proCType->product_id)->where('stock_type', 'out')->sum('stock');
                                                $norstocks[] = $stocksin - $stockOut;

                                            }
                                            }
                                            $workArray = implode(",", $norstocks);
                                            $array = explode(',', $workArray);
                                            $NorStock = min($array);

                                            // Variable Product stocks

                                            $stocks = array();
                                            $VarStock = '';
                                            foreach($productsType as $proCType){
                                            $attrcount = DB::table('products_attributes')->where('products_id', $proCType->product_id)->get();
                                            $acount = count($attrcount);

                                            if ($proCType->products_type == 1 && $acount > 0) {

                                                $attributes = array_filter($resattributes);
                                                $attributeid = implode(',', $attributes);

                                                $postAttributes = count($attributes);

                                                $inventories = DB::table('inventory')->where('products_id', $proCType->product_id)->get();
                                                $reference_ids = array();
                                                
                                                $stockIn = 0;
                                                foreach ($inventories as $inventory) {

                                                    $totalAttribute = DB::table('inventory_detail')->where('inventory_detail.inventory_ref_id', '=', $inventory->inventory_ref_id)->get();
                                                    $totalAttributes = count($totalAttribute);

                                                    if ($postAttributes > $totalAttributes) {
                                                        $count = $postAttributes;
                                                    } elseif ($postAttributes < $totalAttributes or $postAttributes == $totalAttributes) {
                                                        $count = $totalAttributes;
                                                    }


                                                    $individualStock = DB::table('inventory')->leftjoin('inventory_detail', 'inventory_detail.inventory_ref_id', '=', 'inventory.inventory_ref_id')
                                                        ->selectRaw('inventory.*')
                                                        ->whereIn('inventory_detail.attribute_id', [$attributeid])
                                                        ->where(DB::raw('(select count(*) from `inventory_detail` where `inventory_detail`.`attribute_id` in (' . $attributeid . ') and `inventory_ref_id`= "' . $inventory->inventory_ref_id . '")'), '=', $count)
                                                        ->where('inventory.inventory_ref_id', '=', $inventory->inventory_ref_id)
                                                        ->groupBy('inventory_detail.inventory_ref_id')
                                                        ->get();

                                                    if (count($individualStock) > 0) {
                                                        $inventory_ref_id = $individualStock[0]->inventory_ref_id;
                                                        $stockIn += $individualStock[0]->stock;
                                                    }
                                                    
                                                }

                                                $options_names = array();
                                                $options_values = array();
                                                foreach ($resattributes as $attribute) {
                                                    $productsAttributes = DB::table('products_attributes')
                                                        ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                                                        ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
                                                        ->select('products_attributes.*', 'products_options.products_options_name as options_name', 'products_options_values.products_options_values_name as options_values')
                                                        ->where('products_attributes_id', $attribute)->get();

                                                    $options_names[] = $productsAttributes[0]->options_name;
                                                    $options_values[] = $productsAttributes[0]->options_values;
                                                }

                                                $options_names_count = count($options_names);
                                                $options_names = implode("','", $options_names);
                                                $options_names = "'" . $options_names . "'";
                                                $options_values = "'" . implode("','", $options_values) . "'";
                                                

                                                //orders products
                                                $orders_products = DB::table('orders_products')->where('products_id', $proCType->product_id)->get();
                                                $stockOut = 0;
                                                foreach ($orders_products as $orders_product) {
                                                    $totalAttribute = DB::table('orders_products_attributes')->where('orders_products_id', '=', $orders_product->orders_products_id)->get();
                                                    $totalAttributes = count($totalAttribute);

                                                    if ($postAttributes > $totalAttributes) {
                                                        $count = $postAttributes;
                                                    } elseif ($postAttributes < $totalAttributes or $postAttributes == $totalAttributes) {
                                                        $count = $totalAttributes;
                                                    }

                                                    $products = DB::select("select orders_products.* from `orders_products` left join `orders_products_attributes` on `orders_products_attributes`.`orders_products_id` = `orders_products`.`orders_products_id` where `orders_products`.`products_id`='" . $proCType->product_id . "' and `orders_products_attributes`.`products_options` in (" . $options_names . ") and `orders_products_attributes`.`products_options_values` in (" . $options_values . ") and (select count(*) from `orders_products_attributes` where `orders_products_attributes`.`products_id` = '" . $proCType->product_id . "' and `orders_products_attributes`.`products_options` in (" . $options_names . ") and `orders_products_attributes`.`products_options_values` in (" . $options_values . ") and `orders_products_attributes`.`orders_products_id`= '" . $orders_product->orders_products_id . "') = " . $count . " and `orders_products`.`orders_products_id` = '" . $orders_product->orders_products_id . "' group by `orders_products_attributes`.`orders_products_id`");

                                                    if (count($products) > 0) {
                                                        $stockOut += $products[0]->products_quantity;
                                                    }
                                                }
                                                $stocks[] = $stockIn - $stockOut;
                                            } 
                                            }

                                            $VarworkArray = implode(",", $stocks);
                                            $Vararray = explode(',', $VarworkArray);
                                            $VarStock = min($Vararray);


                                            if($NorStock >= $VarStock ){
                                            $totalStock = $VarStock;
                                            } else if($NorStock <= $VarStock){
                                            $totalStock = $NorStock;
                                            } else {
                                            $totalStock = 1;
                                            }
                                            ?>

                                        <?php
                                            $stocks = 0;
                                               $currentStocks = DB::table('inventory')->where('products_id', $cart_data->products_id)->get();
                                               if (count($currentStocks) > 0) {
                                                   foreach ($currentStocks as $currentStock) {
                                                       $stocks += $currentStock->stock;
                                                   }
                                               }
                            
                                                   if ($stocks !=0) { 
                                            ?>
                                                    <input class="quantity__input" readonly type="text" name="qty"  id="input-quantity-<?php echo $cart_data->customers_basket_id; ?>" value="{{$cart_data->customers_basket_quantity}}" min="1" max="9999" />
                                            <?php  
                                                } else if($prod->products_type == 3 || $prod->products_type == 4) { ?>
                                                <input class="quantity__input" readonly type="text" name="qty"  id="input-quantity-<?php echo $cart_data->customers_basket_id; ?>" value="{{$cart_data->customers_basket_quantity}}" min="1" max="9999" />
                                            <?php } else { ?>
                                                <input class="quantity__input" readonly type="text" name="qty"  id="input-quantity-<?php echo $cart_data->customers_basket_id; ?>" value="{{$cart_data->customers_basket_quantity}}"   min="1" max="9999"/>
                                                <?php }
                                        ?>


                                         <button type="button" onClick="increment_quantity('<?php echo $cart_data->customers_basket_id; ?>')" class="quantity__plus"><span class="qty_title_plus">+</span></button> 
                                    </div>
                                </td>
                                </tr>
                            @endforeach
                        
                        </tbody>
                    </table>
                </div>

                <div class="pc-review-order-bottom">
                    <div class="pc-review-order-bottom-main">
                    <!-- <a href="javascript:history.back()">
                            <div class="pc-left-arrow"><img style="width:20px;height:20px" src="{{asset('web/table/img/arrow.png')}}"/></div>
                        </a> -->
                        <?php 
                        $final_price =  $total_amount*session('currency_value');
                        $total_amount_new = number_format($final_price, 2);?>

                        <div class="pc-review-order-bottom-price">{{$label8->label_value}} : {{Session::get('symbol_left')}}  <span id="totalQty">{{ $total_amount_new }} </span>{{Session::get('symbol_right')}}</div>
                        @if($total_amount == 0)
                            <div class="pc-in-button-main">
                                <button  class="pc-review-order-button">{{$label7->label_value}}</button>
                            </div>
                        @else
                            <div class="pc-in-button-main">
                                <button type="submit" class="pc-review-order-button modal-toggle">{{$label7->label_value}}</button>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="modal">
                    <div class="modal-overlay modal-toggle"></div>
                    <div class="modal-wrapper modal-transition">
                    {!! Form::open(array('url' =>'addtableorder', 'name'=>'deleteOrder', 'id'=>'confirm_form_submit', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                   
                        <div class="modal-body confirm-hide-1" >
                            <div class="modal-content" >
                                <h2 class="modal-heading">Note</h2>
                                <p>Order cannot be cancelled once Confirmed</p>
                            </div>
                            <div class="modal-footer">
                                <div class="modal-footer-main">
                                    <div class="modal-toggle">Cancel</div>
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


                <!-- Delete all start -->

                    <div class="modal-delete">
                        <div class="modal-overlay modal-toggle-delete"></div>
                        <div class="modal-wrapper modal-transition">
                        <div class="modal-body">
                            <div class="modal-content">
                                <p>Are you sure you want to delete All?</p>
                            </div>
                            <div class="modal-footer">
                                <div class="modal-footer-main">
                                    <div class="modal-toggle-delete">No</div>
                                </div>
                                <div class="modal-footer-main1">
                                <button  type="submit"  onclick="DeleteAll('<?php echo session('table_qrcode');?>')" class="modal-confirm">Yes</button>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                <!-- Delete all end -->


                <!-- Delete by id start -->

                <div class="modal-deleteid">
                        <div class="modal-overlay modal-toggle-deleteid"></div>
                        <div class="modal-wrapper modal-transition">
                        <div class="modal-body">
                            <div class="modal-content">
                                <p class="hide_undelete">Are you sure you want to delete it?</p>
                                <p class="hide_delete">Please Select any one product to Delete!</p>
                            </div>
                            <div class="modal-footer hide_undelete">
                                <div class="modal-footer-main">
                                    <div class="modal-toggle-deleteid">No</div>
                                </div>
                                <div class="modal-footer-main1">
                                <button  type="submit"  onclick="DeleteByID('<?php echo session('table_qrcode');?>')" class="modal-confirm">Yes</button>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                <!-- Delete by id end -->

            </div>
        </div>
    </body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script>
    // Quick & dirty toggle to demonstrate modal toggle behavior
    $('.modal-toggle').on('click', function(e) {
        e.preventDefault();
        $('.modal').toggleClass('is-visible');
    });

    $('.modal-toggle-delete').on('click', function(e) {
        e.preventDefault();
        $('.modal-delete').toggleClass('is-visible');
    });

    $('.modal-toggle-deleteid').on('click', function(e) {
        var deleteId = $.map($(':checkbox[name=ckdata\\[\\]]:checked'), function(n, i){
            return n.value;
        }).join(',');
        e.preventDefault();
        if(deleteId =='')
        {
            $('.hide_undelete').hide();
            $('.hide_delete').show();
        }
        else
        {
            $('.hide_undelete').show();
            $('.hide_delete').hide();
        }
        $('.modal-deleteid').toggleClass('is-visible');
    });

    $('#deleteOrder').on('click', function() {
        
        $('.confirm-hide-1').hide();
        $('.confirm-hide-2').show();
        $( "#confirm_form_submit" ).submit();
       
    });



    $('.delhide').hide()
    $('.unselectdata').hide()
    jQuery('.ckboxhide').hide();
    
    $(".selectdata").click(function(){
        jQuery('.delhide').show();
        jQuery('.clearhide').hide();
        jQuery('.unselectdata').show();
        jQuery('.selectdata').hide();
        jQuery('.ckboxhide').show();
    });

    $(".unselectdata").click(function(){
        jQuery('.delhide').hide();
        jQuery('.clearhide').show();
        jQuery('.selectdata').show();
        jQuery('.unselectdata').hide();
        jQuery('.ckboxhide').hide();
    });


    function DeleteAll(x)
    {
        var deleteId=x; //alert(schoolid);
        $.ajax({
            headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
            url: '{{ URL::to("/deleteAll")}}',
            type: "POST",
            data: 'deleteId='+deleteId,
            success: function(response){ 
                location="/qrcodeorder";
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {              
            } 
        });
    } 


    function DeleteByID(token)
    {
        var deleteId = $.map($(':checkbox[name=ckdata\\[\\]]:checked'), function(n, i){
            return n.value;
        }).join(',');

        $.ajax({
            headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
            url: '{{ URL::to("/deleteByID")}}',
            type: "POST",
            data: 'deleteId='+deleteId+'&token='+token,
            success: function(response){ 
                location="/qrcodeorder";
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {              
            } 
        });
    } 



function increment_quantity(cart_id) {
    
    var inputQuantityElement = $("#input-quantity-"+cart_id);
    var currentVal = parseInt($(inputQuantityElement).val());
    var maximumVal = $("#input-quantity-"+cart_id).attr('max');

 

    if (!isNaN(currentVal)) {
        if(maximumVal!=0){
            if(currentVal < maximumVal ){
                var newQuantity = parseInt($(inputQuantityElement).val())+1;
                save_to_db(cart_id, newQuantity);
            }
        }

    } else {
        var newQuantity = parseInt($(inputQuantityElement).val(maximumVal));
    }

}

function decrement_quantity(cart_id) {
    var inputQuantityElement = $("#input-quantity-"+cart_id);
    var currentVal = parseInt($(inputQuantityElement).val());
    var minimumVal =  $("#input-quantity-"+cart_id).attr('min');

    if (!isNaN(currentVal) && currentVal > minimumVal) {
        var newQuantity = parseInt($(inputQuantityElement).val()) - 1;
    } else {
        var newQuantity = parseInt($(inputQuantityElement).val(minimumVal));
    }

    if($(inputQuantityElement).val() > 1) 
    {
        save_to_db(cart_id, newQuantity);
    }
}

function save_to_db(cart_id, new_quantity) {
	var inputQuantityElement = $("#input-quantity-"+cart_id);
    $.ajax({
        url: "{{url('/plusMinus')}}",
        type : 'post',
		data : {
            "cart_id" : cart_id,
            "new_quantity" : new_quantity,
            "_token" : "{{ csrf_token() }}",
        },
		success : function(response) {
		 $(inputQuantityElement).val(new_quantity);
         $('#proQty'+cart_id).html(response.proQty);
         $('#totalQty').html(response.TotalQty);
		}
	});
}

</script>

