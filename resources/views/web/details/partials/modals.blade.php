<style>
@media only screen and (max-width: 600px)
{
  h2.text-01.text-center.notify-title-fs {
    font-size: 18px;
}
.notify-outer-pad {
    padding: 20px 0 !important;
}
.notify-mobile-btn {
    padding: 0 !important;
    font-size: 12px;
}
}

</style>
<div class="modal fade" id="notifyModal" tabindex="-1" role="dialog" aria-hidden="false"> 
  <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="container">
          <div class="row align-items-center">                   
            <div class="col-12 col-md-12" >
              <div class="promo-box">
                <h2 class="text-01 text-center notify-title-fs" style="padding: 10px 0;">                            
                    Notify me when the product is available
                </h2>
               
                <div class="notify-outer-pad">
                  <form class="notify-form" id="my_captcha_notify_form" action="{{url('notifyme')}}" >
                    <input type="hidden" name="products_id" value="{{$result['detail']['product_data'][0]->products_id}}"> 
                    <div class="row">
                      <div class="col-8 col-md-12" >
                        <div class="form-group">
                          <input type="email" value="" name="email" class="required email form-control notify-input-height" required placeholder="@lang('website.Enter Your Email Address')..." >
                        </div>
                        </div>
                        <div class="col-8 col-md-8" >
                        <div class="g-recaptcha" style="margin-bottom:5px;" data-sitekey="6LcgaOIlAAAAANQ9-qy97ERNTHeRVjnFgiwRiK90"></div> 
                      <div class="captca" style="margin-bottom:30px;">please verify you are human! </div>
</div>

                        <div class="col-4 col-md-4">
                        <button type="submit" value="notify" name="notify" id="" class="btn btn-secondary notify-input-height notify-mobile-btn notify-btn-fs" style="width: 100%;">@lang('website.notify')</button>  
                      </div>  
                    </div>
                  </form>
                </div>

              </div>
            </div>
          </div>
          <button type="button" class="close notify-close-fs" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .g-recaptcha div
{
  margin: unset !important;
}
  .notify-outer-pad
  {
    padding: 50px 0;
  }
  .notify-input-height
  {
    height: 40px;
  }

  @media only screen and (max-width: 320px)
{
  .notify-outer-pad
  {
    padding: 20px 0;
  }
  .notify-input-height
  {
    height: 30px;
  
  }
  .notify-btn-fs
  {
    font-size: 0.6rem;
  }
  .notify-close-fs
  {
    font-size: 30px !important;
  }
  .notify-title-fs
  {
    font-size: 1rem;
  }
}

</style>

<script>



</script>