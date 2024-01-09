<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />

@if(!empty($result['commonContent']['setting'][72]->value))
<title><?=stripslashes($result['commonContent']['setting'][72]->value)?></title>
@else
<title><?=stripslashes($result['commonContent']['setting'][18]->value)?></title>
@endif

@if(!empty($result['commonContent']['setting'][86]->value))
<link rel="icon" type="image/png" href="{{asset('').$result['commonContent']['setting'][86]->value}}">
@endif
<meta name="DC.title"  content="<?=stripslashes($result['commonContent']['setting'][73]->value)?>"/>
<meta name="description" content="<?=stripslashes($result['commonContent']['setting'][75]->value)?>"/>
<meta name="keywords" content="<?=stripslashes($result['commonContent']['setting'][74]->value)?>"/>

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- Vendor CSS -->
<link href="{{asset('web/css/vendor/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('web/css/vendor/vendor.min.css')}}" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="{{asset('web/css/style-lingeries.css')}}" rel="stylesheet">
	<!-- Custom font -->
	<link href="{{asset('web/fonts/icomoon/icons.css')}}" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+TC:wght@300;400;500;600;700&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>


	<div class="container"> 
 <!--  <header>
    <div class="logo">
      <img src="https://www.streamlineicons.com/ux/img/img-1.svg">
      <h1>Mqandeel</h1>
    </div>
    <ul>
      <li>About</li>
      <li>Contact</li>
    </ul>
  </header> -->
  <section>
   <!--  <img src="https://www.streamlineicons.com/ux/img/img-1.svg"> -->
    <p style="margin-top: 150px;">WE'RE COMING SOON</p>
    <p>Under Construction basically lets you take your website offline while you work on it.</p>
    <form onsubmit="return false">
      <input type="submit" value="Notify me">
      <input type="email" placeholder="Your Email">
    </form>
    <div class="clear-fix"></div>
    <!-- <img src="https://www.streamlineicons.com/ux/img/style-8.svg">
    <img src="https://www.streamlineicons.com/ux/img/style-8.svg"> -->
  </section>
</div>

<style>
	
.container header{
  overflow:hidden;
  padding:15px;
}
.container header .logo{
  float:left;
  cursor:pointer;
}
.container header .logo img{
  width:50px;
}
.container header h1{
  float:right;
  margin-left:15px;
  font-weight:356
}
.container header ul{
  padding:0;
  list-style:none;
}
.container header ul li{
  float:right;
  margin-left:25px;
  cursor:pointer;
}
.container section{
  text-align:center;
}
.container section img{
  width:150px;
}
.container section p{
  letter-spacing:8px;
  font-weight:100;

}
.container section p:nth-of-type(1){
  font-size:70px;
  margin:0;
}
.container section p:nth-of-type(2){
}
.container section form{
  display:inline-block;
  margin:150px auto 80px;
}
.container section form input[type="submit"]{
  float:right;
  padding:10px;
  background:#678aca;
  color:#fff;
  border:2px solid #678aca;
  cursor:pointer;
}
.container section form input[type="email"]{
  padding:10px;
  border:2px solid #678aca;
  width:250px;
}
.container section img{
  opacity:.6;
}
.container section img:nth-of-type(2){
  width: 160px;
  position: absolute;
  top: 60%;
  left: 10%;
}
.container section img:nth-of-type(3){
  width: 160px;
  position: absolute;
  top: 60%;
  right: 10%;
}

</style>


	<script src="{!! asset('web/js/vendor-special/lazysizes.min.js') !!}"></script>
<script src="{!! asset('web/js/vendor-special/ls.bgset.min.js') !!}"></script>
<script src="{!! asset('web/js/vendor-special/ls.aspectratio.min.js') !!}"></script>
<script src="{!! asset('web/js/vendor-special/jquery.min.js') !!}"></script>
<script src="{!! asset('web/js/vendor-special/isotope.pkgd.min.js') !!}"></script>
<script src="{!! asset('web/js/vendor-special/jquery.ez-plus.js') !!}"></script>
<script src="{!! asset('web/js/vendor-special/instafeed.min.js') !!}"></script>
<script src="{!! asset('web/js/vendor/vendor.min.js') !!}"></script>
<script src="{!! asset('web/js/app-html.js') !!}"></script>
</body>
</html>