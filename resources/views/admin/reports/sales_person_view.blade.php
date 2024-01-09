<div class="row">
	<div class="col-xs-12">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>{{ trans('labels.ID') }}</th>
					<th>Name</th>
					<th>Commission</th>
				</tr>
			</thead>
			<tbody>
				@if($result)
				@php
					$salesid=explode(",",$result->salesperson_id);
				@endphp
					@foreach ($salesid as $key=>$jesdata)
					@php
						$user = DB::table('users')->where('id', '=', $jesdata)->select('first_name','last_name')->first();
					@endphp
					<tr>
						<td>{{++$key}}</td>
						<td>{{$user->first_name}} {{$user->last_name}}</td>
						<td>{{$result->single_amount}}</td>
					</tr>
					@endforeach
				@else
				<tr>
                   <td colspan="3"><strong>{{ trans('labels.NoRecordFound') }}</strong></td>
                </tr>
                @endif
			</tbody>
		</table>
	</div>
</div>