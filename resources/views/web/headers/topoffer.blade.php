<style>
 
#announcement-bar-style5{
    width: 100%;
    max-width: 100%;
    overflow: hidden;
    display: block;
    position: relative;
    width: 100%;
    height: auto;
    transition: all 0.5s ease 0s;
    top: 0px;
    overflow: hidden;
}
.display_s5_none
{
  display:none !important;
}

.ab-style5 .ab-style5-content .ab-style5-text {
    display: inline;
    text-align: center;
    vertical-align: middle;
    font-size: initial;
}

.ab-style5 a
{
  font-size:15px !important;
}
.ab-style5 .ab-style5.active {
    left: 0%;
}

.ab-style5 .ab-style5 {
    position: absolute;
    width: 100%;
    z-index: 0;
    left: -100%;
    height: 100%;
}
.ab-style5 .ab-style5-remove {
    cursor: pointer;
    top: 50%;
    right: 5px;
    position: absolute;
    z-index: 1;
    font-size: 50px;
    line-height: 0 !important;
}
.ab-style5 .ab-style5-remove span {
    cursor: pointer;
    top: 50%;
    right: 0px;
    position: absolute;
    z-index: 1;
    font-size: 40px;
    line-height: 0 !important;
}
#announcement-bar-style5 {
    line-height: 1.3;
    -webkit-font-smoothing: auto;
}
.ab-style5 .ab-style5-remove .close{
    font-size: 50px;
    line-height: 0 !important;
    font-weight:normal !important;
    opacity: 0.8;
}
.ab-style5 {
    transition: background 0.5s;
    flex-wrap: wrap !important;
    width: 100% !important;
    box-sizing: border-box;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    text-align: center;
    padding: 8px;
   
}
.header-area .alert .pro-description .close {
    font-size: 40px;
    color: #212529;
    font-weight: normal;
    line-height: 24px;
    padding: 0;
    right: -5px;
    text-shadow: none;
    top: -3px;
}
.ab-style5-content
{
  padding: 0px 25px !important;
}
#announcement-bar-style5 h2, #announcement-bar-style5 h3, #announcement-bar-style5 h4, #announcement-bar-style5 h5 {
    font-weight: normal;
    padding: 0;
    margin: 0;
}

#announcement-bar-style5 p{
    font-weight: normal;
    padding: 0;
    margin: 0;
    color: unset !important;
    display: inline-block !important;
}

.ab-style5 .ab-style5-btn {
    vertical-align: middle;
    outline: none;
    display: inline-block;
    margin-left: 7px;
}

@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : landscape) {

  #announcement-bar-style5{
    height: 87px;
}
.ab-style5 {
    padding: 8px;
}
  
}

@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : portrait) {
  
  #announcement-bar-style5{
    height: 87px;
}
.ab-style5 {
    padding: 8px;
}
  
  }

  @media only screen and (max-width: 1024px)
{
  #announcement-bar-style5{
    height: 87px;
}
.ab-style5 {
    padding: 8px;
}
  
}


@media only screen and (max-width: 768px)
{
  #announcement-bar-style5{
    height: auto;
}
.ab-style5 {
    padding: 15px 10px;
}
.ab-style5 .ab-style5-remove {
    cursor: pointer;
    top: 50%;
    right: 2px;
    position: absolute;
    z-index: 1;
    line-height: 0 !important;
}
.ab-style5 .ab-style5-remove span {
    cursor: pointer;
    top: 50%;
    right: 0px;
    position: absolute;
    z-index: 1;
    font-size: 30px;
    line-height: 0 !important;
}
.ab-style5-content {
    padding: 0px !important;
}

.header-area .alert .pro-description .pro-info {
padding: 0px 18px;
display: block;
height: 36px;
font-size: 10px;

}

}

</style>
@if($result['commonContent']['top_offers'])
  @if($result['commonContent']['top_offers']->top_offers_text)
    @if($result['commonContent']['top_offers']->style != '5')
      <div class="alert alert-warning alert-dismissible fade show" role="alert" @if($result['commonContent']['top_offers']->style == '3' || $result['commonContent']['top_offers']->style == '4') style="background-image: @if($result['commonContent']['top_offers']->image_path_type == 'aws') url({{$result['commonContent']['top_offers']->path}});
      @else url({{asset($result['commonContent']['top_offers']->path)}}); @endif
      width:100%;background-size: cover;margin-top: 0;padding: 6px !important;" @else style="background-color:{{ $result['commonContent']['top_offers']->type_value}}" @endif>
        <div class="container">
            <div class="pro-description" @if($result['commonContent']['top_offers']->style == '2') style="text-align:left" @endif>
              <div class="pro-info" style="color:{{ $result['commonContent']['top_offers']->text_color }} !important">
                @php echo stripslashes($result['commonContent']['top_offers']->top_offers_text); @endphp
              </div>
              @if($result['commonContent']['top_offers']->style == 1 || $result['commonContent']['top_offers']->style == 3)
                <button type="button" id="top-close" class="close" data-dismiss="alert" aria-label="Close" style="color:{{ $result['commonContent']['top_offers']->text_color }} !important;outline:none !important">
                  <span aria-hidden="true">×</span>
                </button>
              @endif
            </div>

        </div>
      </div>
    @else


    <div id="announcement-bar-style5" class="" style="background-color:{{ $result['commonContent']['top_offers']->type_value}}">
      <div class="ab-style5 active" style="background-color:{{ $result['commonContent']['top_offers']->type_value}}">
        <div class="ab-style5-content">
          <div class="ab-style5-text" style="color:{{ $result['commonContent']['top_offers']->text_color }} !important;font-size:15px !important;font-weight:normal;text-overflow: ellipsis;overflow: hidden;">
             @php echo stripslashes($result['commonContent']['top_offers']->top_offers_text); @endphp
          </div>
        </div>
        <div class="ab-style5-remove"> <button type="button" id="top-close" class="close" data-dismiss="alert" aria-label="Close" style="color:{{ $result['commonContent']['top_offers']->text_color }} !important;outline:none !important">
                  <span aria-hidden="true">×</span>
                </button></div>
      </div>
    </div>

    @endif









  @endif
@endif

<script>
  $(document).ready(function(){
      $("#top-close").click(function(){
          $(".img-header").removeClass("header-overlap");
          //$(".img-header35").removeClass("header-overlap-35");
          $(".img-header").addClass("closed-header-overlap");
          //$(".img-header35").addClass("closed-header-overlap-35");

          $(".img-header-mobile").removeClass("mobile-overlap");
          $(".img-header-mobile35").removeClass("mobile-overlap-35");
          $(".img-header-mobile").addClass("close-mobile-overlap");
          $(".img-header-mobile35").addClass("close-mobile-overlap-35");
          $(".img-header-mobile30").addClass("close-mobile-overlap-30");

          $("#announcement-bar-style5").addClass("display_s5_none");

      });
      
  });
</script>