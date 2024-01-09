<header class="footickets__main__header">
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}">
         @if($result['commonContent']['settings']['sitename_logo']=='logo')
        <img src="{{ asset($result['commonContent']['settings']['website_logo']) }}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>" width="80px" height="80px" style="object-fit:contain">
         @endif
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="fa fa-bars"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto edit-nav">
          <li class="nav-item">
            <a class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Dashboard" href="{{url('/tickets')}}">
            <img src="{{ asset('images/tickets/dashboard.svg') }}" width="40" height="40"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tooltip" data-placement="bottom" title="My tickets" href="{{url('/view_tickets')}}">
            <img src="{{ asset('images/tickets/tickets.svg') }}" width="40" height="40"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tooltip" data-placement="bottom" title="New ticket" href="{{url('/open-ticket')}}">
            <img src="{{ asset('images/tickets/new.svg') }}" width="40" height="40"></a>
          </li>

          @php
             $notice = DB::table('tickets')
                ->where('user_id', auth()->guard('customer')->user()->id)
                ->where('notice', 2)
                ->get();
          @endphp

         <li class="nav-item notice">
            <a class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Notifications" href="{{url('/notifications')}}">
            <img src="{{ asset('images/tickets/bell.svg') }}" width="40" height="40"></a>
            @if($notice->count() > 0)
            <i class="faa-flash animated fa fa-circle"></i>
            @endif
          </li>
         {{--  <li class="nav-item">
            <a class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Edit profile" href="{{url('/edit-profile')}}">
            <img src="{{ asset('images/tickets/user.svg') }}" width="40" height="40"></a>
          </li> --}}
          {{-- @if(Auth::user()->permission == 0)
          <li class="nav-item">
            <a class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Admin panel" href="{{url('/admin')}}">
            <img src="{{ asset('images/tickets/admin.svg') }}" width="40" height="40"></a>
          </li>
          @endif --}}
        </ul>
        <ul class="navbar-nav navbar-nav-edit">
          <li class="nav-item dropdown user-dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{ asset('images/tickets/user.svg') }}" width="40" height="40" class="rounded-circle">
              <span>{{ auth()->guard('customer')->user()->first_name }} {{ auth()->guard('customer')->user()->last_name }}</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
             {{--  @if(Auth::user()->permission == 0)
              <a class="dropdown-item" href="{{url('/admin')}}"><i class="fa fa-user"></i> {{ __('Admin panel')}}</a>
              @endif --}}
             {{--  <a class="dropdown-item" href="{{url('/edit-profile')}}"><i class="fa fa-edit"></i> {{ __('Edit profile')}}</a> --}}
              <a class="dropdown-item" href="{{url('logout')}}"><i class="fa fa-sign-out"></i> {{ __('Logout') }}</a>
              
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<style>


@media screen and (max-width: 768px)
{
	.navbar .navbar-nav-edit {
    border: 1px solid #f0f0f0;
    text-align: center;
    margin-top: 10px;
}
.width-50
{
  width:50%;
}

.edit-nav .nav-link {
    box-shadow: none;
    text-align: center;
    border: 1px solid #d2d2d2;
    margin-right: 0;
    margin: 9px;
}
}

@media only screen and (max-width: 320px)
{
  .agree-fs {
    font-size: 11px;
  }
  .page__title h1 {
    font-size: 20px !important;
}
.edit-card .card-header {
    font-size: 14px !important;
}
.edit-card .card-header a {
    font-size: 11px !important;
}
}
@media only screen and (max-width: 280px)
{
  .agree-fs {
    font-size: 9px;
  }
}
</style>