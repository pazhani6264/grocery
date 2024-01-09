@extends('web.tablelayout')
@section('content')
<!-- cart Content -->
@php $r =   'web.carts.webordercart'; @endphp
@include($r)
@endsection
