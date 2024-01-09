<style>

  .bannerad {
    padding-top: 2rem;
    background-color: rgb(250, 250, 250);

}
  .bannerad .banner-lg {
    display: block;
    align-items: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-color: #321f11;
    border-radius:3px;
}

.bannerad .content {
    padding: 3.3rem 0;
    text-align:center;
    max-width: 50%;
    margin: auto;
}

.bannerad .content h4 {
    font-size: 0.9rem;
    margin: 0;
}
.banner-lg .content h4 {
    letter-spacing: -.01rem;
    font-weight: 700;
    color: #fff;
    margin-bottom:0.5rem;
}
.bannerad .content h3 {
    font-size: 2.4rem;
    letter-spacing: -.01rem;
    margin-top: 0.2rem;
}
.banner-lg .content h3 {
    font-size: 1.45rem;
    letter-spacing: -.025rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 0;
}

.bannerad .action a {
    border: none;
    padding: 0;
    letter-spacing: -.01rem;
}

.banner-lg .action a {
    font-size: 2.8rem;
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
    padding-top: 1rem;
}
}
</style>

<?php
  $newdeal_data = DB::table('new_deal')
  ->leftJoin('image_categories', 'new_deal.new_deal_image_id', 'image_categories.image_id')
  ->select('new_deal.*', 'image_categories.path_type as image_path_type', 'image_categories.path as image_path')
  ->first();
?>

<div class="container-fluid bannerad">
  
  <div class="banner-lg" style="background-image: url('{{asset($newdeal_data->image_path)}}');height:167px">

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