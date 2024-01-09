<div class="row">
	<div class="col-xs-12">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
                    <th>S.NO.</th>
                    <th>Email</th>
               </tr>
			</thead>
			<tbody>
				
				 @if(count($data)>0)
				 	@foreach ($data as $key=> $news)
				 	
				<tr>
					<td>{{++$key}}</td>
					<td>{{$news->email}}</td>
				</tr>
				  @endforeach
				 @else
				 <tr>
                    <td colspan="2">{{ trans('labels.NoRecordFound') }}</td>
                 </tr>
                @endif
			</tbody>
		</table>
	</div>
</div>