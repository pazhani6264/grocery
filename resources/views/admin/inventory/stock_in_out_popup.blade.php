<div class="row">
	<div class="col-xs-12">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
                    <th>S.NO.</th>
                    <th>NAME</th>
                    <th>QTY</th>
                    <th>PRICE</th>
                    <th>DISCOUNT</th>
                    <th>TOTAL</th>
               </tr>
			</thead>
			<tbody>
				 @if(count($result)>0)
				 	@foreach ($result as $key=> $jesresult)
				 	<?php
				 		$symbol = DB::table('currencies')->where('is_default', '=', '1')->first(); 
				 		$total=(($jesresult->stock*$jesresult->purchase_price)-$jesresult->discount_unit);
				 	?>

				<tr>
					<td>{{++$key}}</td>
					<td>{{$jesresult->products_name}}</td>
					<td>{{$jesresult->stock}}</td>
					<td>
						@if($symbol->symbol_left != '')  {{ $symbol->symbol_left }}  {{ number_format($jesresult->purchase_price *  $symbol->value,2) }} @else  {{ number_format($jesresult->purchase_price *  $symbol->value,2) }}  {{ $symbol->symbol_right }} @endif
					</td>
					<td>
						@if($symbol->symbol_left != '')  {{ $symbol->symbol_left }}  {{ number_format($jesresult->discount_unit *  $symbol->value,2) }} @else  {{ number_format($jesresult->discount_unit *  $symbol->value,2) }}  {{ $symbol->symbol_right }} @endif
					</td>
					<td>
						@if($symbol->symbol_left != '')  {{ $symbol->symbol_left }}  {{ number_format($total *  $symbol->value,2) }} @else  {{ number_format($total *  $symbol->value,2) }}  {{ $symbol->symbol_right }} @endif
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