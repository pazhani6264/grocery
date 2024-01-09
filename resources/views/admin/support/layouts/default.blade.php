<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		@include('admin.support.includes.head')
	</head>
	<body>
		@include('admin.support.includes.header')
		@yield('content')
		@include('admin.support.includes.in-footer')
	</div>
</body>
</html>