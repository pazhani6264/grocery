<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">

	@php
        $color_style = DB::table('settings')->where('id',236)->first();
        $color = DB::table('settings')->where('id',237)->first();
        $sitename = DB::table('settings')->where('id',79)->first();
        $webname = DB::table('settings')->where('id',80)->first();
        $weblogo = DB::table('settings')->where('id',16)->first();

        if(session('language_id') == '')
		{
			$language_id = 1;
		}
		else
		{
			$language_id = session('language_id');
		}
        $label1 = DB::table('table_label_value')->where('label_id',1)->where('language_id', '=', $language_id)->first();
        $label2 = DB::table('table_label_value')->where('label_id',2)->where('language_id', '=', $language_id)->first();
        $label3 = DB::table('table_label_value')->where('label_id',3)->where('language_id', '=', $language_id)->first();
    @endphp


<body>
<?php  $color = $color->value; ?>

 <style>

@media only screen and (min-width: 1680px) {
    .pc-mobile-tab{
        display:none !important;
    }
    .mobile-none{
        display:block !important;
    }
  }

  @media only screen and (max-width: 1680px) {
    .pc-mobile-tab{
        display:block !important;
    }
    .mobile-none{
        display:none !important;
    }
  }




	.btn-secondary {
    color: #fff;
   
}

a {
   
	text-decoration: none;
    letter-spacing: 1px;
	outline: none !important;
}
* {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}
*, *::before, *::after {
    box-sizing: border-box;
}

html, body {
    margin: 0;
  
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #111;
    text-align: left;
   
    overflow-x: hidden !important;
}
html, body {
    padding: 0;
   
}

body {
   
	background-color: #f5f5f5;
}

.btn {
    display: inline-block;

    text-align: center;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  
    border: 1px solid transparent;
   
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 0;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.justify-content-center {
    justify-content: center !important;
}
.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}
.container {
   
    max-width: 100% !important;
}

.btn, a {
    font-weight: 300 !important;
}
.btn {
    padding: 0.6rem 1.8rem;
	text-transform: uppercase;
}

.pc-title {
    text-align: center;
    align-items: center;
    justify-content: center;
    display: flex;
    height: 90vh;
}



@media only screen and (min-width: 801px) and (max-width: 1100px) and (orientation: landscape) {

	.center {
  margin: 0;
  position: relative;
		top: 15%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

}

	.center {
		margin: 0;
		position: relative;
		top: 15%;
		/* left: 0;
		right:0; */
		/* -ms-transform: none;
		transform: none; */
		/* scale:2; */
		width:100%;
	}
	.curved-header {
        height: 45vh;
       
		display: flex;
			align-items: center;
			justify-content: center;
			position: relative;
			z-index: 1;
    }

	.curved-header:before {
		content: '';
		position: absolute;
		background: <?php echo $color; ?>;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		border-radius: 00 50% 50%/0 0 100% 100%;
		transform: scaleX(2);
		z-index: -1;

    }




	

.logo
{
	width: 150px;
	height: 75px;
	display:block;
}
.img-fluid
{
	width: 100%;
	height: 100%;
	object-fit: contain;
}
.header-h2 {
    text-align: center;
    color: #fff;
    letter-spacing: 1px;
	padding-top: 20px;
}
.header-p {
    text-align: center;
    color: #fff;
    letter-spacing: 1px;
	font-size: 20px;
}

.btn-bg-1 {
    margin-top: 0;
    width: 80%;
    background: <?php echo $color; ?> !important;
	border-color: <?php echo $color; ?> !important;
	border-radius: 5px;
    height: auto;
    line-height: 1;
    padding: 1rem;
}
.btn-bg-2 {
    width: 80%;
    background: #fff;
	border-color: <?php echo $color; ?>;
	color: <?php echo $color; ?> !important;
	border-radius: 5px;
    height: auto;
    line-height: 1;
    padding: 1rem;
}

.btn-bg-2:hover {
  
	background-color: <?php echo $color; ?> !important;
	color: #fff !important;
}



@media screen and (max-width:990px){
.btn-secondary:hover {
    background-color: <?php echo $color; ?> !important;
    border-color: <?php echo $color; ?> !important;
}
.btn-secondary:before {
    background-color: <?php echo $color; ?> !important;
}
.btn-light:before {
    background-color: <?php echo $color; ?> !important;
	color: #fff;
}
.btn-light:hover
{
	color: #fff;
}
.btn-light:not(:disabled):not(.disabled):active, .btn-light:not(:disabled):not(.disabled).active, .show > .btn-light.dropdown-toggle {
     color:#fff !important;
     border-color: <?php echo $color; ?> !important;
}
}

</style>


<h1 class="pc-title mobile-none">This Site Only View on Mobile And Tab</h1>
        

<section class="pc-mobile-tab page-area" style="height:100vh">
		<div class="header curved-header">
			<div class="header-top">
				<a class="logo">
					@if($sitename->value =='name')
					<?=stripslashes($webname->value)?>
					@endif
				
					@if($sitename->value =='logo')
				
						<img class="img-fluid" src="{{asset($weblogo->value)}}" alt="<?=stripslashes($webname->value)?>">
					
					@endif
				</a>

				<div class="content">
				<h2 class="header-h2">{{$webname->value}}</h2>
				<p class="header-p">{{$label1->label_value}}</p>

			</div>
			</div>
			

		</div>

	<div class="container center"> 

		
		<div class="row justify-content-center">	
            @if(auth()->guard('customer')->check())  
                <a href="{{url('/qrcodelogintable')}}" class="btn btn-secondary swipe-to-top btn-bg-1">Continue as {{auth()->guard('customer')->user()->first_name}} </a> 
            @else 
		        <a href="{{url('/table_login')}}" class="btn btn-secondary swipe-to-top btn-bg-1">{{$label2->label_value}}</a>
           @endif
		   </div>
		   <br>
		   <!-- <div class="row justify-content-center">
		   <p><strong>OR</strong></p>
		  </div> -->
		  <div class="row justify-content-center">
		   <a href="{{url('/qrcodetable')}}" type="submit" class="btn btn-light swipe-to-top btn-bg-2">{{$label3->label_value}}</a>
		</div>
		
	</div>
  </section>
  
</body>
</html>