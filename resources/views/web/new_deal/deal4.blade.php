<style>

  .bannerad {
    margin-top: 2rem;
}
  .bannerad .banner-lg {
    display: flex;
    align-items: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-color: #321f11;
}
.bannerad .price {
    display: flex;
    text-transform: uppercase;
    padding: 0 2rem 0 4rem;
    position: relative;
}
.bannerad .price h4 {
    margin-bottom: 0;
    display: flex;
    align-items: center;
    font-size: 1.75rem;
    font-weight: 700;
    font-family: Roboto;
}
.bannerad .price h3 {
    font-size: 3.85rem;
    color: #fff;
    margin-bottom: 2rem;
    margin-left: 1rem;
}
.bannerad .price sup {
    font-size: 1.15rem;
    margin-top: 1rem;
}
.bannerad .price h3, .bannerad .price sup {
    font-family: Roboto;
    font-weight: 700;
    letter-spacing: -.01rem;
}
.bannerad .price:after {
    content: "";
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0.3rem;
    background-color: #666;
    width: 0.1rem;
}
.bannerad .content {
    padding: 2.5rem 0 0 2rem;
}
.banner-lg .content {
    margin-bottom: 2.5rem;
}
.bannerad .content h4 {
    font-size: 1.15rem;
    margin: 0;
}
.banner-lg .content h4 {
    letter-spacing: -.01rem;
    font-weight: 700;
    color: #fff;
}
.bannerad .content h3 {
    font-size: 2.4rem;
    letter-spacing: -.01rem;
    margin-top: 0.2rem;
}
.banner-lg .content h3 {
    font-size: 1.7rem;
    letter-spacing: -.025rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 0;
}
.bannerad .action {
    margin-top: 1.2rem;
}
.bannerad .action a {
    border: none;
    padding: 0;
    letter-spacing: -.01rem;
}

.banner-lg .action a {
    font-size: 1rem;
    font-family: Roboto;   
    text-transform: uppercase;
    border-radius: 0.3rem;
    font-weight: 700;
    -webkit-transition: all .3s;
    transition: all .3s;
}

@media (max-width: 992px){

  .banners-content .container {
      padding-left: 10px;
      padding-right: 10px;
  }
  
}

@media screen and (max-width: 624px){
  .bannerad .price {
    justify-content: center;
  }
  .bannerad .content {
    justify-content: center;
  }
  .bannerad .content, .bannerad .price {
    flex: 0 0 100%;
    max-width: 100%;
    padding: 0;
    text-align:center;
  }
  
  .bannerad .price:after {
      top: unset;
      right: unset;
      bottom: 1.5rem;
      width: 19rem;
      height: 0.1rem;
  }
  .bannerad .banner-lg {
    flex-wrap: wrap;
    padding-top: 5rem;
}
}
</style>

<?php
  $newdeal_data = DB::table('new_deal')
  ->leftJoin('image_categories', 'new_deal.new_deal_image_id', 'image_categories.image_id')
  ->select('new_deal.*', 'image_categories.path_type as image_path_type', 'image_categories.path as image_path')
  ->first();
?>

<div class="container bannerad">
  
  <div class="banner-lg" style="background-image: url('{{asset($newdeal_data->image_path)}}');height:167px">
    <div class="price">
      <h4 class="common-text">from</h4>
      <h3>$39</h3>
      <sup class="common-text">,99</sup>
    </div>
    <div class="content">
      <h4>{{ $newdeal_data->new_deal_title }}</h4>
      <h3>{{ $newdeal_data->new_deal_description }}</h3>
      @if($newdeal_data->new_deal_button_name !='')
        <div class="action">
          <a class="common-text" href="#">{{ $newdeal_data->new_deal_button_name }}</a>
        </div>
      @endif
    </div>
  </div>

</div>