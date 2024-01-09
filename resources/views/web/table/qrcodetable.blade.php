<!DOCTYPE html>
<html>
    <head>
        <title>QR CODE</title>
        <meta charset="utf-8">
        <meta name="description" content="QRCODE Scanning">
        <meta name="keywords" content="QRCODE Scanning">
        <meta name="author" content="Platinum Code">
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
        $label1 = DB::table('table_label_value')->where('label_id',9)->where('language_id', '=', $language_id)->first();
        $label2 = DB::table('table_label_value')->where('label_id',10)->where('language_id', '=', $language_id)->first();

        @endphp

        <meta name = "viewport" content = "width=device-width, minimum-scale=1.0, maximum-scale = 1.0, user-scalable = no">
        <link rel="stylesheet" type="text/css" href="{{asset('web/table').'/'.$color_style->value}}.css">
        <link rel="stylesheet" href="{{asset('web/table/font-awesome/css/all.min.css')}}">
    </head>
    <body>
        <style>
.pc-in-button-main {
    border: 0px solid;
    max-width: 100%;
    margin: auto;
    text-align: center;
    position: fixed;
    left: 20px;
    right: 20px;
    bottom: 1%;
}

.center {
                    margin: 0;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    -ms-transform: translate(-50%, -50%);
                    transform: translate(-50%, -50%);
                    width:100%;
                }

                .pc-in-logo {
                    border: 0px solid;
                    width: 200px;
                    margin: auto;
                }           

.lang_img_outer {
    width: 35px;
    height: 35px;
    border-radius: 50% !important;
}
.lang_change
{
	width: 100%;
	height: 100%;
	border-radius: 50% !important;
	object-fit: cover;
}
.animate-top{
    position:fixed;
    animation:animatetop 0.4s;
    bottom:0;
}
@keyframes animatetop{
    from{bottom:-300px;opacity:0} 
    to{bottom:0;opacity:1}
}
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: unset;
  bottom: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  visibility: unset;
  background-color: rgba(0, 0, 0, 0.275);
}

.modal-content {
    margin: 0;
    max-width: 100%;
    border: 1px solid rgba(0, 0, 0, 0.175);
    outline: 0;
    padding: 0;
    left: 0;
    right: 0;
    background: #fff;
    border-top-left-radius: 1rem;
    border-top-right-radius: 1rem;
}
.modal-header {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: start;
    -ms-flex-align: start;
    align-items: flex-start;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 1rem;
    border-bottom: 1px solid #e9ecef;
    border-top-left-radius: .3rem;
    border-top-right-radius: .3rem;
}
.modal-title {
    margin-bottom: 0;
    line-height: 1.5;
    margin-top: 0;
    font-size: 1.25rem;
}
.modal-header .close {
    float: right;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: .5;
    padding: 1rem;
    margin: -1rem -1rem -1rem auto;
    background-color: transparent;
    border: 0;
}
.close:not(:disabled):not(.disabled) {
    cursor: pointer;
}

.modal-body {
    flex: 1 1 auto;
    padding: 1rem;
}
.modal-body p {
    margin-top: 0;
    margin-bottom: 1rem;
}
.modal-footer {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: end;
    -ms-flex-pack: end;
    justify-content: flex-end;
    padding: 1rem;
    border-top: 1px solid #e9ecef;
}
.modal-footer>*{
    margin: 5px;
}

/* buttons */
.btn {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    cursor: pointer;
}
.btn:focus, .btn:hover {
    text-decoration: none;
}
.btn-primary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}
.btn-primary:hover {
    color: #fff;
    background-color: #0069d9;
    border-color: #0062cc;
}
.btn-secondary {
    color: #fff;
    background-color: #7c8287;
    border-color: #7c8287;
}
.btn-secondary:hover {
    color: #fff;
    background-color: #6c757d;
    border-color: #6c757d;
}

            @media only screen and (min-width: 801px) and (max-width: 1024px){

                .pc-in-logo {
                    border: 0px solid;
                    width: 200px;
                    margin: auto;
                }

            }

            @media only screen and (min-width: 700px) and (max-width: 800px){
                .pc-in-logo {
                    border: 0px solid;
                    width: 200px;
                    margin: auto;
                }

               


            }
            
            @media only screen and (max-width: 600px){
              

                

                .btn-secondary:hover {
    background-color: #39f;
    border-color: #39f;
}

             }

        </style>

        <h1 class="pc-title mobile-none">This Site Only View on Mobile And Tab</h1>
        <div class="pc-mobile-tab in-main">
<!-- Button to trigger modal -->
<?php 
							$languagesall = DB::table('languages')->select('languages.*')->get(); 

                            $languages_new = DB::table('languages')
                            ->leftJoin('image_categories', 'languages.image', 'image_categories.image_id')
                            ->select('languages.*', 'image_categories.path_type as image_path_type', 'image_categories.path as image_path')
                            ->where('languages.is_default', '1')
                            ->first();
						?>
    
<!-- The Modal -->
<div id="modalDialog" class="modal">
    <div class="modal-content animate-top">
        
        <div class="modal-body" style="padding: 0;">
        <div class="dropdown-menu lang_drop_down" style="color: #777;top: 40px;padding: 0 1rem;">

     
        								@foreach($languagesall as $language)

                                <?php if(session('language_image') != '') { ?>
                                    <a onclick="myFunction1({{$language->languages_id}})" class="dropdown-item color-13-top <?php if($language->languages_id == session('language_id')) {?> common-text <?php }?>" style="font-size: 1rem;display:block;padding:1rem 0;border-bottom:solid 0.5px #777;" >                      
								{{$language->name}} 
								</a>   
                                <?php } else { ?>

                                    <a onclick="myFunction1({{$language->languages_id}})" class="dropdown-item color-13-top <?php if($language->languages_id == $languages_new->languages_id) {?> common-text <?php }?>" style="font-size: 1rem;display:block;padding:1rem 0;border-bottom:solid 0.5px #777;" >                      
								{{$language->name}} 
								</a>   

                           

                                <?php } ?>

								          
								@endforeach     
								@include('web.common.scripts.changeLanguage')    
                                
                              
							</div>
        </div>
       
    </div>
</div>

            <div class="pc-in-main">
                <div class="pc-in-header">
                    <div class="pc-in-header-left">
                    <div class="pc-cat-header-left-main" style="position:relative">
                    @if(count($languagesall) > 1)
							<div class="lang_img_outer" id="mbtn">
                                <?php if(session('language_image') != '') { ?>
                            	<img  class="lang_change" src="{{asset(session('language_image'))}}"   alt="{{	session('language_name')}}">
                                <?php } else { ?>

                                <img  class="lang_change" src="{{asset($languages_new->image_path)}}"   alt="{{	session('language_name')}}">

                                <?php } ?>

							</div>
                            @endif

							
                        </div>
                    </div>
                  

                   <!--  <div class="pc-in-header-right">
                        <a href="review-order.html">
                            <div class="pc-in-header-right-main">
                                <img src="{{asset('web/table/img/notes.png')}}" alt="Notes">
                            </div>
                        </a>
                    </div> -->
                </div>
                <div class="pc-in-logo">
                @if($sitename->value =='name')
					<?=stripslashes($webname->value)?>
					@endif
				
					@if($sitename->value =='logo')
				
						<img class="img-fluid" src="{{asset($weblogo->value)}}" alt="<?=stripslashes($webname->value)?>">
					
					@endif
                </div>
                <?php
                    $data=DB::table('booking_table')->where('qrcode', session('table_qrcode'))->whereIn('status', ['reserved', 'checkin'])->first();
                    $hold = DB::table('hold')->where('session_id', session('table_qrcode'))->first();
                ?>
                
                <div class="pc-in-table center">
                    
                    <div class="pc-in-table-main common-bg">
                        <h5 style="line-height: 1;padding-top: 3.2rem;">{{$label2->label_value}} </h5> <p style="line-height: 1.5;">{{ $data->table_name }} </p></div>
                    
                </div>

                

     
                <div class="pc-in-button-main">
                    <a href="{{url('/qrcodeorder')}}">
                        <button type="submit" class="pc-in-button">{{$label1->label_value}}</button>
                    </a>
                </div>
            </div>
        </div>

        
    </body>
</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script>


// Get the modal
var modal = $('#modalDialog');

// Get the button that opens the modal
var btn = $("#mbtn");

// Get the <span> element that closes the modal
var span = $(".close");

$(document).ready(function(){
    // When the user clicks the button, open the modal 
    btn.on('click', function() {
        modal.show();
    });
    
    // When the user clicks on <span> (x), close the modal
    span.on('click', function() {
        modal.fadeOut();
    });
});

// When the user clicks anywhere outside of the modal, close it
$('body').bind('click', function(e){
    if($(e.target).hasClass("modal")){
        modal.fadeOut();
    }
});

$(document).ready(function(){

	

	//$('.lang_change').on('click', function() {
		//$(".lang_drop_down").toggle();
	//})
});
</script> 