<style>
  .container-deal {
    width: 1195px !important;
    max-width: 100%;
    padding-left: 10px !important;
    padding-right: 10px !important;
  }
  .cta-border {
    position: relative;
    border: none;
    background-color: #666;
    background-size: cover;
    font-size: 2rem;
    margin-left: 5px;
    padding-top: 50px;
    padding-bottom: 50px;
    margin-bottom: 20px;
    margin-top: 10px;
}
  .justify-content-center {
    -ms-flex-pack: center!important;
    justify-content: center!important;
  }
  .cta-border .cta-content {
    display: flex;
    align-items: center;
    flex-direction: column;
  }
  .cta-border .cta-text {
margin-right: 0;
}

.cta-border .cta-text {
position: relative;
padding: 0;
flex-grow: 1;
margin-bottom: 2rem;
}
.text-white {
color: #fff!important;
}
.text-right {
text-align: right!important;
}
.cta-border .cta-text p {
font-size: 2rem;
line-height: 1.3;
letter-spacing: -.01em;
color: #fff;
}
.cta-border p {
max-width: none;
}

.cta .btn:not(.btn-block) {
min-width: 200px;
}
.cta-border .btn {
margin-right: 70px;
margin-left: 70px;
}

.cta .btn {
padding-top: 1.15rem;
padding-bottom: 1.15rem;
}
.btn-round {
border-radius: 3rem;
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

</style>

<?php
  $newdeal_data = DB::table('new_deal')
  ->leftJoin('image_categories', 'new_deal.new_deal_image_id', 'image_categories.image_id')
  ->select('new_deal.*', 'image_categories.path_type as image_path_type', 'image_categories.path as image_path')
  ->first();
?>

<div class="container container-deal">

  <div class="cta cta-border mb-5" style="background-image: url('{{asset($newdeal_data->image_path)}}');height:167px">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="cta-content d-flex">
          <div class="cta-text text-right text-white">
            <p>{{ $newdeal_data->new_deal_title }} <br><strong>{{ $newdeal_data->new_deal_description }}</strong></p>
          </div>
          @if($newdeal_data->new_deal_button_name !='')
            <a class="btn btn-secondary btn-round" href="#">
              <span>{{ $newdeal_data->new_deal_button_name }}</span><i  style="margin-left: 15px;" class="fa fa-arrow-right"></i>
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>

</div>