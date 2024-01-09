@extends('web.tablelayout')
@section('content')
 @php $r =   'web.table.tableshop';@endphp
 @include($r)
 @include('web.common.scripts.addToCompare')
@endsection
