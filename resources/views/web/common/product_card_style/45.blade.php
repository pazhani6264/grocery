<div  class="product-molla product ajax_product_45 product-molla-19  product4" >
  <article>
    @if($result['commonContent']['settings']['product_column'] == 1)
      <div class="thumb">   
    @else
      <div class="thumb thumb-size pbc-2-thumb-new">
    @endif
      <div class="badges">
    <?php 
     $detail_url = url('/product-detail/'.$products->products_slug);
     $symbol_left = session('symbol_left');
     $symbol_right = session('symbol_right');

    $currency = \App\Models\Core\Currency::where('id',session('currency_id'))->pluck('decimal_places');
    $decimal_places = count($currency) > 0 ? $currency[0] : 2;
    $current_date = date("Y-m-d", strtotime("now"));
    $created_date = DB::table('products')->select('products.created_at')->where('products_id', $products->products_id)->first();       
    $string = substr($created_date->created_at, 0, strpos($created_date->created_at, ' '));
    $date=date_create($string);
    date_add($date,date_interval_create_from_date_string($result['commonContent']['settings']['new_product_duration']." days")); 
    $after_date = date_format($date,"Y-m-d");
      if(!empty($products->discount_price))
      {
        $discount_price = $products->discount_price * session('currency_value');
      }
        $orignal_price = $products->products_price * session('currency_value');
       if(!empty($products->discount_price))
       {
         if(($orignal_price+0)>0)
         {
           $discounted_price = $orignal_price-$discount_price;
           $discount_percentage = $discounted_price/$orignal_price*100;
           if($products->products_type==0)
           {
               if(!in_array($products->products_id,$result['cartArray']))
               {
                   if($result['commonContent']['settings']['Inventory'])
                   {
                       if($products->defaultStock<=0)
                       { 
                        ?>
                           <span>Sold Out</span>
                           <?php
                       }
                       else
                       {
                        ?>
                        <span class="badge badge-success pbc-2-badge">Sale</span>
                        <?php
                       }
                   }
                   else
                       {
                        ?>
                        <span class="badge badge-success pbc-2-badge">Sale</span>
                        <?php
                       }
               }
               else
                       {
                        ?>
                        <span class="badge badge-success pbc-2-badge">Sale</span>
                        <?php
                       }
           }
           else
                       {
                        ?>
                        <span class="badge badge-success pbc-2-badge">Sale</span>
                        <?php
                       }
            
          }
          else
          {
            if($products->products_type==0)
                {
                    if(!in_array($products->products_id,$result['cartArray']))
                    {
                        if($result['commonContent']['settings']['Inventory'])
                        {
                            if($products->defaultStock<=0)
                            { 
                              ?>
                                <span>Sold Out</span>
                                <?php
                            }
                        }
                    }
                }
            $discount_percentage = 0;
            $discounted_price = 0;
           }
        }
           if($products->products_ordered > 0)
           {
               /*  <span class="badge badge-success  bage-19-top">Top</span> */
           }
           if($products->products_liked > 0)
           {
                 
           }

        if($products->button_type == 1 || $products->button_type == 3){ 

           if($products->products_type==0)
           {
                if($products->defaultStock<=0)
                {
                   /*  <span class="badge badge-success  bage-19-out">Out of stock</span> */
                }
           }
        }
        ?>
       </div>

       <div class="product-action-vertical">
       <div class="pbc-2-quickview modal_show5"  products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="Quick View"><i class="fas fa-search font-size-1-1rem"></i></div>

       <?php
              if($result['commonContent']['setting'][226]->value == 2){
                  $res = $result['commonContent']['setting']['227']->value;
                  $time = explode('-',$res);
                  $startTime = strtotime($time[0]);
                  $endTime = strtotime($time[1]);
                  $currentTime = time();
                      if($currentTime >= $startTime && $currentTime <= $endTime){
                          $ck = 0;
                      } else {
                          $ck = 1;
                      }
              } else {
                  $ck = 0;
              } 
        
              if($ck == 0){
            ?>
        <?php
       if($products->button_type == 1 || $products->button_type == 3){ 

        if($products->products_type==0)
        {
            if(!in_array($products->products_id,$result['cartArray']))
            {
                if($result['commonContent']['settings']['Inventory'])
                {
                    if($products->defaultStock<=0)
                    { 
                      ?>
                        </div>
                      <?php
                    }
                    else
                    {
                      ?>
                        <div class="pbc-2-quickview cart-icon-sb add-to-cart-d-hide add-to-cart-d-hide{{$products->products_id}}" id="add-to-cart-d-hide{{$products->products_id}}" products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="Add to cart"><i class="fas fa-plus font-size-1-1rem"></i></div>

                        <div class="pbc-2-quickview  added-to-cart-d-hide added-to-cart-d-hide{{$products->products_id}}" 
                        id="added-to-cart-d-hide{{$products->products_id}}"   data-toggle="tooltip" data-placement="bottom" title="Added"><i class="fas fa-plus font-size-1-1rem"></i></div></div>
                        <?php
                    }
                }
                else
                {
                  ?>
                    <div class="pbc-2-quickview cart-icon-sb  add-to-cart-d-hide add-to-cart-d-hide{{$products->products_id}}" id="add-to-cart-d-hide{{$products->products_id}}" products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="Add to cart"><i class="fas fa-plus font-size-1-1rem"></i></div>

                    

                    <div class="pbc-2-quickview  added-to-cart-d-hide added-to-cart-d-hide{{$products->products_id}}" id="added-to-cart-d-hide{{$products->products_id}}"  products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="Added"><i class="fas fa-plus font-size-1-1rem"></i></div></div>
                    <?php

                }
 
            }
            else
            {
              ?>
                <div class="pbc-2-quickview"  products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="Added"><i class="fas fa-plus font-size-1-1rem"></i></div></div>

              <?php 
            }
        }
        elseif($products->products_type==1)
        {
          ?>

            <a class="pbc-2-quickview "  href="{{ URL::to('/product-detail/'.$products->products_slug)}}"  data-toggle="tooltip" data-placement="bottom" title="View Detail"><i class="fas fa-plus font-size-1-1rem"></i></a></div>
            
          <?php  
        }
        elseif($products->products_type==2)
        {
          ?>
            <a class="pbc-2-quickview " href="{{$products->products_url}}" target="_blank"   data-toggle="tooltip" data-placement="bottom" title="External Link"><i class="fas fa-plus font-size-1-1rem"></i></a></div>
         <?php   

        } elseif($products->products_type==3)
        {
          $stocks = 0;
          $stockarray = [];

          $comboPro = DB::table('product_combo')->where('pro_id', $products->products_id)->get();

          foreach($comboPro as $key=>$comboProd){

              $stocksin = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'in')->sum('stock');
              $stockOut = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'out')->sum('stock');
              $stocks = $stocksin - $stockOut;
              $stockarray[$key] = $stocks;
              //print_r($stockarray);

          }
      if(!in_array($products->products_id,$result['cartArray'])){
        if($result['commonContent']['settings']['Inventory']){
          if(in_array('0',$stockarray)){
                      ?>
                        </div>
                      <?php
                    }
                    else
                    {
                      ?>
                        <div class="pbc-2-quickview cart-icon-sb add-to-cart-d-hide add-to-cart-d-hide{{$products->products_id}}" id="add-to-cart-d-hide{{$products->products_id}}" products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="Add to cart"><i class="fas fa-plus font-size-1-1rem"></i></div>

                        <div class="pbc-2-quickview  added-to-cart-d-hide added-to-cart-d-hide{{$products->products_id}}" 
                        id="added-to-cart-d-hide{{$products->products_id}}"   data-toggle="tooltip" data-placement="bottom" title="Added"><i class="fas fa-plus font-size-1-1rem"></i></div></div>
                        <?php
                    }
                }
                else
                {
                  ?>
                    <div class="pbc-2-quickview cart-icon-sb  add-to-cart-d-hide add-to-cart-d-hide{{$products->products_id}}" id="add-to-cart-d-hide{{$products->products_id}}" products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="Add to cart"><i class="fas fa-plus font-size-1-1rem"></i></div>

                    

                    <div class="pbc-2-quickview  added-to-cart-d-hide added-to-cart-d-hide{{$products->products_id}}" id="added-to-cart-d-hide{{$products->products_id}}"  products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="Added"><i class="fas fa-plus font-size-1-1rem"></i></div></div>
                    <?php

                }
 
            }
            else
            {
              ?>
                <div class="pbc-2-quickview"  products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="Added"><i class="fas fa-plus font-size-1-1rem"></i></div></div>

              <?php 
            }
          }

            elseif($products->products_type==4)
        {
          $stocks = 0;
          $stockarray = [];

          $comboPro = DB::table('product_buy_x')->where('pro_id', $products->products_id)->get();

          foreach($comboPro as $key=>$comboProd){

              $stocksin = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'in')->sum('stock');
              $stockOut = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'out')->sum('stock');
              $stocks = $stocksin - $stockOut;
              $stockarray[$key] = $stocks;
              //print_r($stockarray);

          }

          $stocksgetx = 0;
                        $stockarraygetx = [];
        
                        $comboProgetx = DB::table('product_get_x')->where('pro_id', $products->products_id)->get();
        
                        foreach($comboProgetx as $key=>$comboProdgetx){
        
                            $stocksin = DB::table('inventory')->where('products_id', $comboProdgetx->product_id)->where('stock_type', 'in')->sum('stock');
                            $stockOut = DB::table('inventory')->where('products_id', $comboProdgetx->product_id)->where('stock_type', 'out')->sum('stock');
                            $stocksgetx = $stocksin - $stockOut;
                            $stockarraygetx[$key] = $stocksgetx;
                            //print_r($stockarraygetx);
                        }

      if(!in_array($products->products_id,$result['cartArray'])){
        if($result['commonContent']['settings']['Inventory']){
          if((in_array('0',$stockarray)) || (in_array('0',$stockarraygetx))){
                      ?>
                        </div>
                      <?php
                    }
                    else
                    {
                      ?>
                        <div class="pbc-2-quickview cart-icon-sb add-to-cart-d-hide add-to-cart-d-hide{{$products->products_id}}" id="add-to-cart-d-hide{{$products->products_id}}" products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="Add to cart"><i class="fas fa-plus font-size-1-1rem"></i></div>

                        <div class="pbc-2-quickview  added-to-cart-d-hide added-to-cart-d-hide{{$products->products_id}}" 
                        id="added-to-cart-d-hide{{$products->products_id}}"   data-toggle="tooltip" data-placement="bottom" title="Added"><i class="fas fa-plus font-size-1-1rem"></i></div></div>
                        <?php
                    }
                }
                else
                {
                  ?>
                    <div class="pbc-2-quickview cart-icon-sb  add-to-cart-d-hide add-to-cart-d-hide{{$products->products_id}}" id="add-to-cart-d-hide{{$products->products_id}}" products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="Add to cart"><i class="fas fa-plus font-size-1-1rem"></i></div>

                    

                    <div class="pbc-2-quickview  added-to-cart-d-hide added-to-cart-d-hide{{$products->products_id}}" id="added-to-cart-d-hide{{$products->products_id}}"  products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="Added"><i class="fas fa-plus font-size-1-1rem"></i></div></div>
                    <?php

                }
 
            }
            else
            {
              ?>
                <div class="pbc-2-quickview"  products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="Added"><i class="fas fa-plus font-size-1-1rem"></i></div></div>

              <?php 
            }

        }

    } else if($products->button_type == 2){
      ?>
        <div class="pbc-2-quickview modal_show3"  products_id="{[$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="Book"><i class="fas fa-plus font-size-1-1rem"></i></div></div>
<?php
       
    } else if($products->button_type == 4){
      ?>
        <a class="pbc-2-quickview " href="{{$detail_url}}"  products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="View Detail"><i class="fas fa-plus font-size-1-1rem"></i></a></div>

    <?php  
    } 
  else
  {
    ?>
    </div>

    <?php  
    } }
    
       $products_images = DB::table('products_images')->LeftJoin('image_categories', 'products_images.image', '=', 'image_categories.image_id')->select('image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'image_categories.image_type')->where('products_id', '=', $products->products_id)->where('image_categories.image_type', 'ACTUAL')->first();
       if(!empty($products_images))
       {
        ?>
            <div class="card-style-first">
            <a href="{{$detail_url}}">
            <img class="img-fluid" src="{{asset($products->image_path)}}" alt="{{$products->products_name}}">
            </a>
            </div>
            <div class="card-style-second">
            <a href="{{$detail_url}}">
            <img class="img-fluid" src="{{asset($products_images->image_path)}}" alt="{{$products->products_name}}">
            </a>
            </div>
            <?php
       }
       else
       {
        ?>
          <div class="card-style-first">
            <a href="{{$detail_url}}">
            <img class="img-fluid" src="{{asset($products->image_path)}}" alt="{{$products->products_name}}">
            </a>
            </div>
            <div class="card-style-second">
            <a href="{{$detail_url}}">
            <img class="img-fluid" src="{{asset($products->image_path)}}" alt="{{$products->products_name}}">
            </a>
            </div>
            <?php
       }
       ?>
       </div>

    
       <div class="content">
    
        
     

        <h5 class="pbc-2-pr-title"><a href="{{$detail_url}}">{{$products->products_name}}</a></h5>
       <?php
       if($products->rating !=0)
       {
        ?>
       <fieldset class="disabled-ratings-19">
        <?php
       $new_active_class1 ='';
       $new_active_class2 ='';
       $new_active_class3 ='';
       $new_active_class4 ='';
       $new_active_class5 ='';
       if($products->rating >= 1)
       {
           $new_active_class1 = 'active';
       }
       if($products->rating >= 2)
       {
           $new_active_class2 = 'active';
       }
       if($products->rating >= 3)
       {
           $new_active_class3 = 'active';
       }
       if($products->rating >= 4)
       {
           $new_active_class4 = 'active';
       }
       if($products->rating >= 5)
       {
           $new_active_class5 = 'active';
       }
       ?>
       <label class = "full fa {{$new_active_class1}}" for="star1" title="bad_1_stars"></label>
       <label class = "full fa {{$new_active_class2}}" for="star_2" title="average_2_stars"></label>
       <label class = "full fa {{$new_active_class3}}" for="star_3" title="good_3_stars"></label> 
       <label class = "full fa {{$new_active_class4}}" for="star_4" title="pretty_good_4_stars"></label> 
       <label class = "full fa {{$new_active_class5}}" for="star_5" title="awesome_5_stars"></label>    
        <a style="font-size:0.9rem" href="#review" id="review-tabs" data-toggle="pill" role="tab" class="btn-link mobile-review-center">( {{$products->total_user_rated}} Reviews)</a>
       </fieldset>
       <?php
    }
    ?>
     
        <div class="price">
         
          <?php
           if(!empty($products->discount_price))
           {
               $discount_newp = $discount_price+0; 
               ?>
               {{$symbol_left}}&nbsp;{{$discount_newp}}&nbsp; {{$symbol_right}}
               <span> {{$symbol_left}}&nbsp;{{number_format($orignal_price+0 , $decimal_places )}}&nbsp;{{$symbol_right}}</span>
               <?php
           }
           else
           {
            ?>
               {{$symbol_left}}&nbsp;{{number_format($orignal_price+0 , $decimal_places )}}&nbsp;{{$symbol_right}}
               <?php
               DB::table('products')->where('products_id', '=', $products->products_id)->update([
                   'products_filter_price' => $orignal_price,
               ]);
           }
          ?>
           
           </div>
           <?php
           if(!empty($products->discount_price))
           {
            ?>
           <div style="color: #e2183d;">Save {{$symbol_left}}&nbsp;{{$discounted_price}}&nbsp;{{$symbol_right}}</div>
           <?php
           }
           ?>

           
        </div>


      
    </article>                
    </div>      