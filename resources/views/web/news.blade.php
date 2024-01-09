@extends('web.layout')
@section('content')
<!-- Site Content -->
@php $r =   'web.news.news' . $final_theme['blog_news']; @endphp
@include($r)
@endsection
