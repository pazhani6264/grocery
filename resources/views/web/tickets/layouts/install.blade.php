<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('install.includes.head')
    </head>
    <body>
        <section class="fowtickets__outPages mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 m-auto">
                    <div class="install text-center mb-3">
                    <img src="{{asset('images/configuration.svg')}}" width="120">
                    </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </section>
    </div>
     @include('install.includes.footer')
</body>
</html>