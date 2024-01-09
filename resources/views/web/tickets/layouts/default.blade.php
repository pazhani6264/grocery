<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		@include('web.tickets.includes.head')
	</head>
	<body>
		@include('web.tickets.includes.header')
		@yield('content')
		@include('web.tickets.includes.in-footer')
	</div>
</body>
</html>