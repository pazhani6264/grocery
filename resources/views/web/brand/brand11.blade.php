<style>

#brand-11-main-outer {
    border-top: 1px solid;
    border-top-color: #e8e8e1;
    padding-top: 60px;
    margin-top:30px;
}
#brand-11-main-outer .brand-11-outer-pad {
    padding: 0 40px;
}
#brand-11-main-outer .brand-11-header
{
  margin-bottom:40px;
}
#brand-11-main-outer .brand-11-title {
    margin-bottom: 0;
}
#brand-11-main-outer .brand-11-logo-outer {
    text-align: center;
}
#brand-11-main-outer .brand-11-logo-width {
    display: flex;
    flex-wrap: wrap;
    margin-left: -10px;
    margin-right: -10px;
    word-break: break-word;
}
#brand-11-main-outer .brand-11-product {
    position: relative;
    flex: 0 0 16.66667%;
    align-items: stretch;
    display: flex;
    margin-bottom: 10px;
    padding-left: 10px;
    padding-right: 10px;
}
#brand-11-main-outer .brand-11-image-outer {
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 100%;
    padding: 25px 30px;
    background-color: #fff;

}
#brand-11-main-outer .brand-11-product:after {
    border-radius: 10px;
    content: "";
    display: block;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 6px;
    right: 6px;
    pointer-events: none;
    background-color: #00000007;
}


.brand-11-image {
    opacity: 1;
    animation: none;
    display: block;
    margin: 0 auto;
    width: 100%;
}

@media only screen and (max-width: 768px)
{
  #brand-11-main-outer .brand-11-product {
    flex: 0 0 50%;
}
#brand-11-main-outer .brand-11-outer-pad {
    padding: 0 15px;
}
#brand-11-main-outer .brand-11-header
{
  margin-bottom:30px;
}
#brand-11-main-outer {
    padding-top: 40px;
    margin-top: 10px;
}
#brand-11-main-outer .brand-11-title {
    text-align: center;
    font-size: 18px;
}
}
</style>

<?php  $result = DB::table('manufacturers')
        ->LeftJoin('image_categories', 'manufacturers.manufacturer_image', '=', 'image_categories.image_id')
        ->select('image_categories.path_type as image_path_type','image_categories.path','manufacturers.manufacturer_name')->where('image_categories.image_type', 'ACTUAL')->orderBy('manufacturers.manufacturers_id', 'ASC')->take(11)
       ->get(); 
        ?>

<div id="brand-11-main-outer">
  <div class="brand-11-outer-pad">
    <div class="brand-11-header">
      <h2 class="brand-11-title title_change_tbm">Popular Brands</h2>
    </div>
    <div class="brand-11-logo-outer">
     
      <div class="brand-11-logo-width" data-view="6-2">
      <?php foreach($result as $brand)
        { ?>
        <div class="brand-11-product">
          <div class="brand-11-image-outer">
          <a href="{{ URL::to('/shop?brand='.$brand->manufacturer_name)}}" class="logo-bar__link" >
              <img class="brand-11-image" data-sizes="auto" alt="" src="{{asset($brand->path)}}">
            </a>
          </div>
        </div>
        <?php } $count = count($result); if($count >= 11) { ?>
         <div class="brand-11-product">
          <div class="brand-11-image-outer">
          <a href="{{ URL::to('/productbrand')}}" class="logo-bar__link" >
              <img class="brand-11-image" data-sizes="auto" alt="" src="{{asset('web/images/miscellaneous/see_all.png')}}">
            </a>
          </div>
        </div>
        <?php } ?>
        
      </div>
      
    </div>
  </div>
</div>