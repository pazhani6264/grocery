<input type="hidden" id="fixheadergetvalue" value="12"/>

        <header id="stickyHeader" class="header-12-search-fixed header-fixed header-area header-sticky d-none">
          <div class="header-sticky-inner  bg-sticky-bar">
            <div class="container">
    
                <div class="row align-items-center">
                    <div class="col-12 col-lg-2">
                        <div class="logo">
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
                    </div>
                    <div class="col-12 col-lg-6" style="position: static;">
                    <nav id="navbar_header_9" class="navbar navbar-expand-lg">
                      
                    </nav>
                    </div>
                    <div class="col-12 col-sm-4">
                      <div class="row">
                        <div class="col-md-7">
                          <form class="form-inline-search" action="{{ URL::to('/shop')}}" method="get" style="margin-left: 15px;position: relative;right: -15px;">
                              <div class="input-main" id="searchbuttonsfixed">
                                <div  class="search-inputs"></div>
                              </div>
                              <input type="hidden" class="category-value" name="categories_id" value="" /> 
                              <div class="input-main" id="searchbuttonfixed" style="display:none">
                                  <input autocomplete="off" name="search" value="{{ app('request')->input('search') }}" type="text" class="search-input webtypeheads_fixed" placeholder="Search Product ..... ">
                                  <div class="search_outer_con_fixed">
                                    <div id="viewsearchproduct_fixed"></div>
                                  </div>
                              </div>
                              <button id="dropdownCartButton" class="btn search-button-main" type="button" style="right:0px;padding:0.6rem 1rem !important"> 
                                <i class="fa fa-search cus-style-search" onclick="myFunctionfixed()"></i>
                              </button>
                          </form>
                        </div>

                        @if($result['commonContent']['settings']['view_cart_button'] == 1)

                        <div class="col-md-3">
                          <ul class="pro-header-right-options header-12-fixed-cart-drop" style="margin-top:5px">
                            <li class="dropdown head-cart-content-fixed">
                              @include('web.headers.cartButtons.webordercartbuttonfixed')
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
          </div> 
        </header>

        
<script>
  function myFunctionfixed() {
  var x = document.getElementById("searchbuttonfixed");
  var y = document.getElementById("searchbuttonsfixed");

  var a = document.getElementById("searchbutton");
  var b = document.getElementById("searchbuttons");

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
  $(".webtypeheads_fixed").keyup(function(){

    var search = $(".webtypeheads_fixed").val();
  var cat = '';
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

        jQuery('.search_outer_con_fixed').addClass('enable_search');
        $('#viewsearchproduct_fixed').html(content);
        
             
        },
      });

    }
  else
  {
    jQuery('.search_outer_con_fixed').removeClass('enable_search');
  }
   
  
  });
});
</script>