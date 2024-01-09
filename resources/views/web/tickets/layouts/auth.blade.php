<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
    </head>
    <body>
        <section class="fowtickets__outPages mb-4">
            <div class="container">
                <div class="row">
                    <div class="@if ($__env->getSections()['title'] == 'Register') col-lg-6 
                        @elseif($__env->getSections()['title'] == 'Privacy policy' 
                        or $__env->getSections()['title'] == 'Terms of use') col-lg-10 @else col-lg-4 @endif m-auto">
                        <div class="brand">
                            <a href="{{url('/')}}"><img src="{{ asset('images/logo.png') }}" alt="logo"></a>
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('includes.footer')
</body>
</html>