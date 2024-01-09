<style>
  .container-deal {
    width: 1195px !important;
    max-width: 100%;
    padding-left: 10px !important;
    padding-right: 10px !important;
  }
  .cta-border-image {
    background-size: cover;
    background-repeat: no-repeat;
    border: none;
    padding: 0.75rem;
}
.cta-border-image.cta-border .cta-border-wrapper {
    padding-top: 2.98rem;
    padding-bottom: 2.98rem;
}
.cta-border .cta-content {
    flex-direction: row;
    padding-left: 1.5rem;
}
.cta-border .cta-heading {
    flex: 0 0 26.5%;
    max-width: 26.5%;
    display:inline-block;
    padding-right: 2rem;
}

.cta-title, .cta-title span {
    font-weight: 600;
    letter-spacing: -.01em;
}
.cta-border .cta-text {
    flex-grow: .5;
    margin-right: 0;
    padding-left: 2rem !important;
    position: relative;
    padding: 0;
    display:inline-block;
}

@media screen and (min-width: 993px){
  .cta-border .cta-text:before {
      content: "";
      background-color: #f5f5f5;
      width: 0.35rem;
      height: 6rem;
      position: absolute;
      left: -3px;
      top: 50%;
      margin-top: -3rem;
      display: block;
  }
}
.cta-border .cta-text p {
    font-size: 1.15rem;
    letter-spacing: 0;
    font-weight: 400;
    max-width: 460px;
    margin-bottom: 0;
    color:#777;
}
.cta .btn:not(.btn-block) {
    min-width: 265px;
    padding: 11px 30px!important;
    vertical-align: text-bottom;
    text-transform: initial;
    font-size: 14px;
}
.btn-round {
    border-radius: 3rem;
}

.cta-heading h3{
  font-size:1.45rem !important;
}

.mr-20s {
    margin-right: 20px;
    font-size: 1rem;
    font-weight:400 !important;
    letter-spacing: -.01em;
}
.mt-5s {
    margin-top: 5rem !important;
}

@media screen and (max-width: 992px){
  .cta-border .cta-heading {
      width: 100%;
      flex: 0 0 100%;
      max-width: 100%;
      margin: 0;
      padding-top: 0;
      padding-right: 0;
  }
  .cta-border .cta-title, .cta-border .cta-title.text-right {
    text-align: center!important;
  }
  .cta-border .cta-title {
    margin: 0 0 2rem;
  }
  .cta-title, .cta-title span {
    font-weight: 600;
    letter-spacing: -.01em;
  }
  .cta-border p {
    margin-left: auto;
    margin-right: auto;
  }
  .cta-border .cta-text {
    width:100%;
    text-align:center;
    margin-bottom: 2rem;
  }
  .cta-border .cta-content {
    flex-direction: row;
    padding-left: 0rem;
  }
  .cta-border .cta-content {
    display: block;
  }
  .cta .btn:not(.btn-block) {
    max-width: 300px;
    padding: 0.8rem 2.3rem;
    vertical-align: text-bottom;
    text-transform: initial;
    display: block;
    margin: auto;
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
  <div class="cta cta-border cta-border-image mb-5" style="background-image: url('{{asset($newdeal_data->image_path)}}');margin-top:37px;height:167px">
    <div class="cta-border-wrapper bg-white">
      <div class="row justify-content-center">
        <div class="col-md-11 col-xl-11">
          <div class="cta-content">
            <div class="cta-heading">
              <h3 class="cta-title text-right">
                <span class="common-text">New Deals</span>
                <br>{{ $newdeal_data->new_deal_title }}</h3>
            </div>
            <div class="cta-text">
              <p>{{ $newdeal_data->new_deal_description }}</p>
            </div>
            @if($newdeal_data->new_deal_button_name !='')
              <a class="btn btn-secondary btn-round" href="/react/molla/demo-3#">
                <span class="mr-20s">{{ $newdeal_data->new_deal_button_name }}</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="17" viewBox="0 0 33.908 19.619" style="margin-left: 15px;">
                <path id="arrow_right" d="M28.861,11.627a1.335,1.335,0,0,0-.01,1.88l6.212,6.223L6.928,19.342a1.328,1.328,0,0,0,0,2.657l28.125.388-6.212,6.223a1.345,1.345,0,0,0,.01,1.88,1.323,1.323,0,0,0,1.87-.01L39.14,22h0a1.492,1.492,0,0,0,.276-.419,1.268,1.268,0,0,0,.1-.511,1.332,1.332,0,0,0-.378-.93l-8.42-8.481A1.3,1.3,0,0,0,28.861,11.627Z" transform="translate(-5.61 -11.252)" fill="#fff"/>
                </svg>
              </a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>