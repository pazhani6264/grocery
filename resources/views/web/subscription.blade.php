@extends('web.layout')
@section('content')

<section class="pro-content empty-content">
  <div class="container">
    <div class="row">
        <div class="col-12">
			<div style="width:60%;margin:auto;">
				<div style="text-align: center;padding: 50px 0;">
					<h1 style="font-size: 2.5rem;">Sorry to see you go.</h1>
					<p style="font-size: 1.5rem;padding: 5px;">You have successfully unsubscribed from our newsletter.<p>
					<p>Your email address has also been removed from our mailing list. You will receive no more emails from us. If you have unsubscribed by mistake or you have typed in the wrong email address, please feel free to subscribe again at any time.<p>
				</div>
				<div style="text-align: center;margin-bottom: 50px;">
					<a href="{{ URL::to('/')}}" class="btn btn-secondary">Go Back</a>
				</div>
			</div>
        </div>

    </div>  
  </div>   
</section> 

@endsection
