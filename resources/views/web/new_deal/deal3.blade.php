<style>
  .container-deal {
    width: 1180px !important;
    max-width: 100%;
    padding-left: 10px !important;
    padding-right: 10px !important;
    margin-top:3.3rem;
  }
  .fill-color-long
  {
    fill:#445f84;
  }
  .fill-color-long:hover
  {
    fill:#fff;
  }

  .container-deal .cta-horizontal {
    padding: 3.3rem 5.2rem;
}
.bg-image
{
background-size: cover;
    background-position: 50%;
    background-repeat: no-repeat;
}

  .container-deal .cta-horizontal .cta-title {
    font-size: 1.6rem;
    margin-bottom: 0.8rem;
    letter-spacing: -.01em;
    font-weight: 600;
  }

.container-deal .cta-horizontal .cta-desc {
    color: #666;
    font-size: 1rem;
    font-weight: 400;
    margin-bottom:0;
}

.container-deal .cta-horizontal .btn:not(.btn-block) {
    min-width: 270px;
}
.container-deal .cta .btn:not(.btn-block) {
    min-width: 160px;
    text-transform: uppercase;
    font-weight: 400;
    font-size: 1rem;
}
.cta .btn {
    padding-top: 1.15rem;
    padding-bottom: 1.15rem;
}
.container-deal .btn-white-primary {
    color: #445f84;
    background-color: #fff;
    border-color: #fff;
    -webkit-box-shadow: none;
    box-shadow: none;
}
.container-deal .btn-round {
    border-radius: 3rem !important;
}

.cta .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 0.85rem 1.5rem;
    font-weight: 400;
    font-size: 1.4rem;
    line-height: 1.5;
    letter-spacing: -.01em;
    min-width: 170px;
    border-radius: 0;
    white-space: normal;
    -webkit-transition: all .3s;
    transition: all .3s;
}
.container-deal .cta .btn span {
    line-height: 1.2;
}





  @media screen and (min-width: 992px){
    .cta-border .cta-content {
      flex-direction: row;
      padding-left: 1.5rem;
    }
    .cta-border .cta-text {
      margin-right: 2rem;
      padding-left: 3rem;
      margin-bottom: 0;
    }
    
  }

  @media screen and (min-width: 768px){

  .cta-border .cta-text p {
    font-size: 1.5rem;
    line-height: 1.3;
    letter-spacing: -.01em;
    color: #fff;
    font-weight:600 !important;
  } 
}

@media screen and (max-width: 992px){

  .container-deal .cta-horizontal {
      padding: 3.3rem 2rem;
    }
    .container-deal .cta-horizontal .cta-desc {
      color: #666;
      font-size: 1rem;
      font-weight: 400;
      margin-bottom: 1rem;
    }
  }

</style>

<?php
  $newdeal_data = DB::table('new_deal')
  ->leftJoin('image_categories', 'new_deal.new_deal_image_id', 'image_categories.image_id')
  ->select('new_deal.*', 'image_categories.path_type as image_path_type', 'image_categories.path as image_path')
  ->first();
?>

<div class="container container-deal">
  <div class="cta cta-horizontal cta-horizontal-box bg-image mb-4 mb-lg-6" style="background-image: url('{{asset($newdeal_data->image_path)}}');height:167px">
    <div class="row flex-column flex-lg-row align-items-lg-center">
      <div class="col">
        <h3 class="cta-title common-text">{{ $newdeal_data->new_deal_title }}</h3>
        <p class="cta-desc">{{ $newdeal_data->new_deal_description }}</p>
      </div>
      @if($newdeal_data->new_deal_button_name !='')
        <div class="col-auto"><a class="btn btn-white-primary btn-round fill-color-long" href="#"><span class="text-left">{{ $newdeal_data->new_deal_button_name }}</span><svg xmlns="http://www.w3.org/2000/svg" width="11" height="17" viewBox="0 0 33.908 19.619" style="margin-left: 10px;">
             <path id="arrow_right" d="M28.861,11.627a1.335,1.335,0,0,0-.01,1.88l6.212,6.223L6.928,19.342a1.328,1.328,0,0,0,0,2.657l28.125.388-6.212,6.223a1.345,1.345,0,0,0,.01,1.88,1.323,1.323,0,0,0,1.87-.01L39.14,22h0a1.492,1.492,0,0,0,.276-.419,1.268,1.268,0,0,0,.1-.511,1.332,1.332,0,0,0-.378-.93l-8.42-8.481A1.3,1.3,0,0,0,28.861,11.627Z" transform="translate(-5.61 -11.252)"/>
           </svg></a></div>
          @endif
    </div>
  </div>
</div>