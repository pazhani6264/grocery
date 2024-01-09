<div class="row">
	<div class="col-xs-12">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>{{ trans('labels.ID') }}</th>
                    <th>{{ trans('labels.Full Name') }}</th>
				</tr>
				<tbody>
					@if (count($result) > 0)
						@foreach ($result as $key=>$jesresult)
						<tr>
							<td>{{++$key}}</td>
							<td>{{$jesresult->first_name}}</td>
						</tr>
						@endforeach
					@else
					<tr>
						<td colspan="2">{{ trans('labels.NoRecordFound') }}</td>
					</tr>
					@endif
				</tbody>
			</thead>
		</table>
	</div>
</div>