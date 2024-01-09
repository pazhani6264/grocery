<div class="row">
	<div class="col-xs-12">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
                    <th>S.NO.</th>
                    <th>Stock-OUT Date</th>
                    <th>RECEIPT NO.</th>
                    <th>STATUS</th>
                    <th>QTY</th>
               </tr>
			</thead>
			<tbody>
				 @if(count($result)>0)
				 	@foreach ($result as $key=> $jesresult)
				<tr>
					<td>{{++$key}}</td>
					<td>{{$jesresult->created_at}}</td>
					<td>00000{{$jesresult->inventory_ref_id}}</td>
					<td>Selling</td>
					<td>-{{$jesresult->stock}}</td>
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