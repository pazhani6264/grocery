

<div class="row">
	<div class="col-xs-12">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
                    <th>S.NO.</th>
                    <th>Product Name</th>
                    <th>Qty</th>
                    <th>Options</th>
                    <th>Price</th>
               </tr>
			</thead>
			<tbody>
				 @if(count($data['orders_data'][0]->data)>0)
				 	@foreach ($data['orders_data'][0]->data as $key=> $products)
				 	 <?php 
            			$symbol_left = DB::table('currencies')->where('symbol_left', '=', $data['orders_data'][0]->currency)->first(); 
            		?>
				<tr>
					<td>{{++$key}}</td>
					<td>{{$products->products_name}}</td>
					<td>{{$products->products_quantity}}</td>
					<td>
						@foreach($products->attribute as $attributes)
							<b>{{ trans('labels.Name') }}:</b> {{ $attributes->products_options }}<br>
							<b>{{ trans('labels.Value') }}:</b> <?php echo $attributes->products_options_values ?><br>
							<b>{{ trans('labels.Price') }}:</b> 
							 <?php  
                    			if($symbol_left != '') { echo $data['orders_data'][0]->currency.' '.$attributes->options_values_price * $data['orders_data'][0]->currency_value; } else  { $attributes->options_values_price * $data['orders_data'][0]->currency_value.' '.$data['orders_data'][0]->currency; } ?><br />
						@endforeach
					</td>
					<td>
						<?php  
                    	if($symbol_left != '') { echo $data['orders_data'][0]->currency.' '.$products->final_price * $data['orders_data'][0]->currency_value; } else  { $products->final_price * $data['orders_data'][0]->currency_value.' '.$data['orders_data'][0]->currency; } ?>
					</td>
				</tr>
				  @endforeach
				 @else
				 <tr>
                    <td colspan="5">{{ trans('labels.NoRecordFound') }}</td>
                 </tr>
                @endif
			</tbody>
		</table>
	</div>
</div>