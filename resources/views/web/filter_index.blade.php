@extends('web.layout')
@section('content')
 @php $r =   'web.filterindex'; @endphp
 @include($r)
 @include('web.common.scripts.addToCompare')
@endsection
