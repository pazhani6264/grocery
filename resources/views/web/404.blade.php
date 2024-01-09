<?php 

        $result['setting'] = DB::table('settings')->orderby('id', 'ASC')->get();
        $settings = array();
        foreach($result['setting'] as $key=>$value){
          $settings[$value->name]=$value->value;
        }

        $result['settings'] = $settings;
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />

@if(!empty($result['setting'][72]->value))
<title><?=stripslashes($result['setting'][72]->value)?></title>
@else
<title><?=stripslashes($result['setting'][18]->value)?></title>
@endif



@if(!empty($result['setting'][86]->value))
<link rel="icon" type="image/png" href="{{asset('').$result['setting'][86]->value}}">
@endif
<meta name="DC.title"  content="<?=stripslashes($result['setting'][73]->value)?>"/>
<meta name="description" content="<?=stripslashes($result['setting'][75]->value)?>"/>
<meta name="keywords" content="<?=stripslashes($result['setting'][74]->value)?>"/>

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- Core CSS Files -->
<link rel="stylesheet" type="text/css" href="{{asset('web/css').'/'.$result['setting'][81]->value}}.css">
<script src="{!! asset('web/js/app.js') !!}"></script>

<!-- <div class="container-fuild">
  <nav aria-label="breadcrumb">
      <div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
            <li class="breadcrumb-item active" aria-current="page">Page 404</li>
          </ol>
      </div>
    </nav>
</div>  -->

<section class="pro-content">
        
  <div class="container">
    <div class="page-heading-title">
	
</div>


</section>

<section class="page_404">
	<div class="container">
		<div class="row">	
		<div class="col-sm-12 ">
		<div class="col-sm-12  text-center">
		<div class="four_zero_four_bg">
			<h1 class="text-center">404</h1>
		
		
		</div>
		
		<div class="contant_box_404">
		<h3 class="h2">
		Look like you're lost
		</h3>
		
		<p>the page you are looking for not avaible!</p>
		<a href="{{ URL::to('/')}}" class="btn btn-secondary">Go Back</a>
	
	</div>
		</div>
		</div>
		</div>
	</div>
</section>


<style>
	.page_404{ padding:40px 0; background:#fff; font-family: 'Arvo', serif;
}

.page_404  img{ width:100%;}

.four_zero_four_bg{
 
 background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
    height: 400px;
    background-position: center;
 }
 
 
 .four_zero_four_bg h1{
 font-size:80px;
 }
 
  .four_zero_four_bg h3{
			 font-size:80px;
			 }
			 
			 .link_404{			 
	color: #fff!important;
    padding: 10px 20px;
    background: #39ac31;
    margin: 20px 0;
    display: inline-block;}
	.contant_box_404{ margin-top:-50px; text-align:center}

</style>