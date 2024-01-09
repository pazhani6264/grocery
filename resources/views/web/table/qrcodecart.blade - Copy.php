<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="description" content="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
  <meta name="keywords" content="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
  <meta name="author" content="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=stripslashes($result['commonContent']['settings']['website_name'])?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
  body{
    width: 100%;
     /* background-color: #9B9B9B;*/
        overflow-x: hidden;
  }
  .imground
  {
    width: 100%;
    height: 100%;
    object-fit: contain;
  }
  .imgdiv
  {
    width: 20%;
    display: inline-block;
    vertical-align: top;
  }
  .namediv
  {
    width: 75%;
    display: inline-block;
    vertical-align: top;
  }
  .editcss{
    float: right;
    font-size: 15px;
    /*font-weight: 800;*/
    text-decoration: underline;
}

.cartc{
   background-color: #fff;
    position: fixed;
    bottom: 0px;
    left: 0;
    right: 0;
    border-top: 1px solid #f5f5;
 }
 .ordernowcss{
    float: right;
    padding: 10px;
    border-radius: 20px;
    /*width: 49%;*/
    background-color: #302D83;
 }
 .linecss{
      border-top: 1px solid #9B9B9B;
    }

    .navba {
  overflow: hidden;
  background-color: #333;
  position: fixed;
  top: 0;
  width: 100%;
}

.navba a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.navba a:hover {
  background: #ddd;
  color: black;
}

  @media only screen and (max-width: 600px){
    .col-sm-9{
      width: 74%;
      display: inline-block;
    }
    .col-sm-3{
      width: 24%;
      display: inline-block;
    }

    .col-md-6{
    width:49%;
    display: inline-block;
  }

  }
</style>

@php
  $total_amount=0;
  $qunatity=0;
@endphp

<div class="navba">
  <a href="{{ URL::to('/qrcodeorder')}}" style="width: 85px;height: 50px;">
  @if($result['commonContent']['settings']['sitename_logo']=='logo')
  <?php 
              $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['website_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 

              ?>
              @if($imagepath->path_type == 'aws')
                <img class="img-mobile" src="{{$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
              @else
                <img class="img-mobile" src="{{asset('').$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
              @endif
  @endif
  </a>
  <a style="float: right;" href="{{url('/orderhistory')}}"><i class="fa fa-history" style="font-size: 4.8rem;" aria-hidden="true"></i></a>
</div><br><br><br><br>

<body>
  <div style="padding: 25px;">   
  <h4>Your Order</h4>
  <hr class="linecss">
  <div class="row">
    @foreach($result['commonContent']['cart'] as $cart_data)
    @php
      $total_amount += $cart_data->final_price*$cart_data->customers_basket_quantity;
      $qunatity     += $cart_data->customers_basket_quantity;
    @endphp
    <div class="col-md-12">
      <div class="col-md-3 col-sm-3" style="vertical-align: top;">
          @if($cart_data->image_path_type == 'aws')
            <img class="imground" src="{{$cart_data->image}}">
          @else
            <img class="imground" src="{{asset('').$cart_data->image}}">
          @endif

        </div>
        <div class="col-md-9 col-sm-9">
        <div class="namediv">
          <div style="font-size: 14px;font-weight: 600;">{{$cart_data->products_name}}</div>
          <h5 style="font-size: 14px;font-weight: 600;"> {{Session::get('symbol_left')}} {{$cart_data->final_price*session('currency_value')}} {{Session::get('symbol_right')}}</h5>
          {{-- <p>Qty 1</p> --}}
        </div>
        <div class="imgdiv">
          <!-- <a href="javascript:;" class="editcss">EDIT</a><br> -->
          {{-- <i class="fa fa-trash" style="float: right;" aria-hidden="true"></i> --}}
        </div>

         <div class="namediv">
          <p>Qty {{$cart_data->customers_basket_quantity}}</p>
        </div>

         <div class="imgdiv">
          <a href="{{ URL::to('/deleteCart?id='.$cart_data->customers_basket_id)}}"><i class="fa fa-trash" style="float: right;font-size: 16px;" aria-hidden="true"></i></a>
        </div>
      </div>

    </div>
     <hr class="linecss">
    @endforeach

  </div>
  </div>
  <div class="cartc">
<div class="row">
  <div class="col-md-12">
    <div class="col-md-6" style="margin-top: 10px;">
      <div style="font-size: 15px; font-weight: 600;color: #9b9b9b;">{{$qunatity}} items</div>
      <div style="font-size: 25px;font-weight: 600;color: #302D83;">{{Session::get('symbol_left')}} {{ $total_amount*session('currency_value') }} {{Session::get('symbol_right')}}</div>
    </div>
    <div class="col-md-6" style="margin-top: 10px;">
     <button  id="addTableOrder" type="button" class="btn btn-primary ordernowcss">PLACE ORDER</button>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="addOrderTable" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            
                            <h4 class="modal-title" id="deleteModalLabel">Notice</h4>
                        </div>
                        {!! Form::open(array('url' =>'addtableorder', 'name'=>'deleteOrder', 'id'=>'deleteOrder', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        <div class="modal-body">
                            <p>Order cannot be cancelled once confirmed</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-secondary" id="deleteOrder">Confirm</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>


<script>
  $(document).on('click', '#addTableOrder', function(){
    $("#addOrderTable").modal('show');
  });
</script>
</body>
</html>



