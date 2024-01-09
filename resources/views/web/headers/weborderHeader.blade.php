<style>
  .header-twele .header-navbar nav .navbar-collapse ul li:last-child {
position: relative;
left: 0;
margin-right: 0;
}
</style>


<!-- //header style Twele -->
@include('web.headers.weborderfixedheader') 
<header id="headerTwele" class="header-12-search header-area header-twele  header-desktop d-none d-lg-block d-xl-block">
  <div class="header-mini bg-top-bar-twele">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12">
          
          <nav id="navbar_0_6" class="navbar navbar-expand-md navbar-dark navbar-0 nav-twele">
            <div class="navbar-collapse">
              <ul class="navbar-nav">
                    <li class="nav-item mr-20">
                      <a class="color-16-top" href="tel:{{$result['commonContent']['setting'][11]->value}}">
                        <i class="fa fa-phone"></i>&nbsp;&nbsp;CALL : {{$result['commonContent']['setting'][11]->value}}</li>
                      </a>
                    </li>
              </ul> 
            </div>   
          </nav>
        </div>
      </div>
    </div> 
  </div>


  <div class="header-maxi  bg-header-bar header-maxi-twele">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-md-2 col-lg-2">
          <a class="img-fluid-molla-main" href="{{ URL::to('/ordershop')}}" class="logo" data-toggle="" data-placement="bottom" title="@lang('website.logo')">
            @if($result['commonContent']['settings']['sitename_logo']=='name')
            <?=stripslashes($result['commonContent']['settings']['website_name'])?>
            @endif
        
            @if($result['commonContent']['settings']['sitename_logo']=='logo')
              <?php 
              $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['website_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 

              ?>
              @if($imagepath->path_type == 'aws')
                <img class="img-fluid-molla" src="{{$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
              @else
                <img class="img-fluid-molla" src="{{asset('').$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
              @endif
            @endif
            </a>
        </div>
        
        <div class="col-12 col-sm-6">
          
        </div>

            <div class="col-12 col-sm-4">
              <div class="row">
                <div class="col-md-7">
                  <form class="form-inline-search" action="{{ URL::to('/ordershop')}}" method="get" style="margin-left: 15px;position: relative;right: -15px;">
                    <div class="input-main" id="searchbuttons">
                        <div  class="search-inputs"></div>
                      </div>
                      <input type="hidden" class="category-value" name="categories_id" value="" /> 
                      <div class="input-main" id="searchbutton" style="display:none">
                          <input autocomplete="off" name="search" type="text" value="{{ app('request')->input('search') }}" class="search-input typeheadsweb" placeholder="Search Product ..... ">
                          <div class="search_outer_con">
                            <div id="viewsearchproduct"></div>
                          </div>
                      </div>
                      <button id="dropdownCartButton" class="btn search-button-main" type="button"> 
                        <i class="fa fa-search cus-style-search" onclick="myFunction()"></i>
                  </button>
                  </form>
                </div>

                @if($result['commonContent']['settings']['view_cart_button'] == 1)

                <div class="col-md-3">
                  <ul class="pro-header-right-options head-12-cart header-12-cart-drop">
                    <li class="dropdown head-cart-content">
                      @include('web.headers.cartButtons.webordercartbutton')
                    </li>
                  </ul>
                </div>

                @endif

                <div class="col-md-2" style="padding: 7px;">
                  <a href="{{url('/orderhistory')}}"><i class="fa fa-history" style="font-size: 1.8rem;" aria-hidden="true"></i></a>
                </div>

        </div>
        </div>
      </div>
    </div>
  </div> 
      <div class="header-navbar bg-menu-bar">
          <div class="container">
            <nav id="navbar_header_9" class="navbar navbar-expand-lg  bg-nav-bar">
        
              <div class="navbar-collapse" >
                <ul class="navbar-nav">
                  <!-- {!! $result['commonContent']["menusRecursive"] !!} -->
                  <!-- <li class="nav-item ">
                    <a class="nav-link">
                        <span>@lang('website.Call Us Now')</span>
                        <phone dir="ltr">{{$result['commonContent']['setting'][11]->value}}</phone>
                    </a>
                  </li>      -->
                </ul>
              </div>
            </nav>
          </div>
      </div>
</header>



<script>


  function myFunction() {
  var x = document.getElementById("searchbutton");
  var y = document.getElementById("searchbuttons");

  var a = document.getElementById("searchbuttonfixed");
  var b = document.getElementById("searchbuttonsfixed");



  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
    a.style.display = "block";
    b.style.display = "none";
  } else {
    x.style.display = "none";
    y.style.display = "block";
    a.style.display = "none";
    b.style.display = "block";
  }
}

$(document).ready(function(){
  $(".typeheadsweb").keyup(function(){

    var search = $(".typeheadsweb").val();
    var cat = $(".category-value").val();
    $('.btn-close-search-40').show();
    $("#search-width-hide").removeClass("search-field-module-width-show");
    $("#search-width-hide").addClass("search-field-module-width-hide");
  var pro = "{{ URL::to('/ordershop?category=&search')}}";
  
  
    if(search != "")
    {
    var content ='';
      jQuery.ajax({
         url: '{{ URL::to("/autocomplete")}}',
         headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
         type: "GET",
          data: 'search='+search+'&cat='+cat,
        dataType: 'JSON',
          success: function (data) { 
        if(data !="")
          {
        $.each(data, function(index, item) 
        {
          content += '<a href="'+pro+'='+item.name+'"><div class="searchdropdown">';
          content += '<div class="row">';
          content += '<div class="col-4 col-md-4">';
          if(item.image_path_type == 'aws')
          {
            content += '<img src="'+item.img+'"/ height="44px;" width="65px;">';
          }
          else
          {
            content += '<img src="'+imagep+item.img+'"/ height="44px;" width="65px;">';
          }
          content += '</div>';
          content += '<div class="col-8 col-md-8">';
          content += '<span style="white-space: normal;">'+item.name+'</span>';
          content += '</div>';
          content += '</div>';
          content += '</div></a>';
        
        });
        }
        else
        {
        content += '<div class="row">';
        content += '<div class="col-12"><p style="text-align: center;padding: 10px;margin: 0;">No Product Available</p>';
        content += '</div>';
        content += '</div>';
        }

        jQuery('.search_outer_con').addClass('enable_search');
        $('#viewsearchproduct').html(content);
      
             
        },
      });

    }
  else
  {
    jQuery('.search_outer_con').removeClass('enable_search');
    $('.btn-close-search-40').hide();
    $("#search-width-hide").addClass("search-field-module-width-show");
    $("#search-width-hide").removeClass("search-field-module-width-hide");
  }
   
  
  });
});

</script>