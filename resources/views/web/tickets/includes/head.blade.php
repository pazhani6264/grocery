    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <meta name="description" content="{{$info->description}}">
    <meta name="keywords" content="{{$info->keywords}}">
    <meta name="author" content="{{$info->site_name}}"> --}}

   @if(!empty($result['commonContent']['setting'][72]->value))
<title><?=stripslashes($result['commonContent']['setting'][72]->value)?></title>
@else
<title><?=stripslashes($result['commonContent']['setting'][18]->value)?></title>
@endif
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;1,300;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;1,100;1,300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('static/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/customize/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('static/css').'/'.$result['commonContent']['setting'][81]->value}}.css">

    <link rel="stylesheet" href="{{ asset('static/fontawesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/fontawesome/font-awesome-animation.min.css') }}">

