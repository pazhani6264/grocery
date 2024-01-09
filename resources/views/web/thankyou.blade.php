@extends('web.layout')
@section('content')
@if(!empty(count($bankdetail)) and count($bankdetail)>0)
<section class="pro-content empty-content" style="padding-top:50px;">
  @else
  <section class="pro-content empty-content">
  @endif
  <div class="container">
      
      <div class="row">
        <div class="col-12">
            @if(session('premierpaystatus') == 2 && session('premierpaymethod') == 'PremierPay')

            <div class="pro-empty-page">
              <h2 style="font-size: 150px;"><i class="far fa-check-circle"></i></h2>
              <h1 >@lang('website.Thank You')</h1>
              <p>

                @if($result['commonContent']['settings']['thank_you'] !='')
                  <?php
                      $sevalue = DB::table('settings')
                      ->where('id', 229)
                      ->first();
                  ?>
                      <p>{{ $sevalue->value }} </p>
                @endif

                <a href="{{url('/view-order/'.session('orders_id'))}}" class="btn-link"><b>@lang('website.Order Detail')</b></a>
              </p>
            </div>
           
        
           

            @elseif(session('premierpaystatus') == 1 && session('premierpaymethod') == 'PayTm')

            <div class="pro-empty-page">
              <h2 style="font-size: 150px;"><i class="far fa-check-circle"></i></h2>
              <h1 >@lang('website.Thank You')</h1>
              <p>
              
              @if($result['commonContent']['settings']['thank_you'] !='')
                  <?php
                      $sevalue = DB::table('settings')
                      ->where('id', 229)
                      ->first();
                  ?>
                      <p>{{ $sevalue->value }} </p>
                @endif
                
                <a href="{{url('/view-order/'.session('orders_id'))}}" class="btn-link"><b>@lang('website.Order Detail')</b></a>
              </p>
            </div>
           
          

            @elseif(session('premierpaystatus') == 2 && session('premierpaymethod') == 'ipay88')

              <div class="pro-empty-page">
                <h2 style="font-size: 150px;"><i class="far fa-check-circle"></i></h2>
                <h1 >@lang('website.Thank You')</h1>
                <p>
                
              @if($result['commonContent']['settings']['thank_you'] !='')
                  <?php
                      $sevalue = DB::table('settings')
                      ->where('id', 229)
                      ->first();
                  ?>
                      <p>{{ $sevalue->value }} </p>
                @endif
                
                  <a href="{{url('/view-order/'.session('orders_id'))}}" class="btn-link"><b>@lang('website.Order Detail')</b></a>
                </p>
              </div>

             
           
         
            @elseif(session('premierpaystatus') == 2 && session('premierpaymethod') == 'Cash on Delivery')

            <div class="pro-empty-page">
              <h2 style="font-size: 150px;"><i class="far fa-check-circle"></i></h2>
              <h1 >@lang('website.Thank You')</h1>
              <p>

              @if($result['commonContent']['settings']['thank_you'] !='')
                  <?php
                      $sevalue = DB::table('settings')
                      ->where('id', 229)
                      ->first();
                  ?>
                      <p>{{ $sevalue->value }} </p>
                @endif
                
                <a href="{{url('/view-order/'.session('orders_id'))}}" class="btn-link"><b>@lang('website.Order Detail')</b></a>
              </p>
            </div>

           
           
        
          @elseif(session('premierpaystatus') == 2 && session('premierpaymethod') == 'wallet')

          <div class="pro-empty-page">
            <h2 style="font-size: 150px;"><i class="far fa-check-circle"></i></h2>
            <h1 >@lang('website.Thank You')</h1>
            <p>
            
            @if($result['commonContent']['settings']['thank_you'] !='')
                  <?php
                      $sevalue = DB::table('settings')
                      ->where('id', 229)
                      ->first();
                  ?>
                      <p>{{ $sevalue->value }} </p>
                @endif
                
              <a href="{{url('/view-order/'.session('orders_id'))}}" class="btn-link"><b>@lang('website.Order Detail')</b></a>
            </p>
          </div>


          @elseif(session('premierpaystatus') == 1 && session('premierpaymethod') == 'senangpay')

          <div class="pro-empty-page">
            <h2 style="font-size: 150px;"><i class="far fa-check-circle"></i></h2>
            <h1 >@lang('website.Thank You')</h1>
            <p>
            
            @if($result['commonContent']['settings']['thank_you'] !='')
                  <?php
                      $sevalue = DB::table('settings')
                      ->where('id', 229)
                      ->first();
                  ?>
                      <p>{{ $sevalue->value }} </p>
                @endif
                
              <a href="{{url('/view-order/'.session('orders_id'))}}" class="btn-link"><b>@lang('website.Order Detail')</b></a>
            </p>
          </div>

         
          @elseif(session('premierpaystatus') == 1 && session('premierpaymethod') == 'banktransfer')

         

          <div class="pro-empty-page" style="padding:20px;">
              <h2 style="font-size: 100px;"><i class="far fa-check-circle"></i></h2>
              <h1 >@lang('website.Thank You')</h1>
              <p>
              
              @if($result['commonContent']['settings']['thank_you'] !='')
                  <?php
                      $sevalue = DB::table('settings')
                      ->where('id', 229)
                      ->first();
                  ?>
                      <p>{{ $sevalue->value }} </p>
                @endif
                
              <br>
                To confirm order, upload your invoice here
                <a href="{{url('/view-order/'.session('orders_id'))}}" class="btn-link" style="color:blue"><b>@lang('website.Order Detail')</b></a>
              </p>
            </div>

            @else
            <div class="pro-empty-page">
              <h2 style="font-size: 150px;"><i class="far fa fa-ban"></i></h2>
              <h1 >@lang('website.Sorry')</h1>
              <p>
              @lang('website.Your online payment failed')
                <a href="{{url('/view-order/'.session('orders_id'))}}" class="btn-link"><b>@lang('website.Order Detail')</b></a>
              </p>
            </div>

          @endif

          

          </p>
        </div>

       
        @if(!empty(count($bankdetail)) and count($bankdetail)>0)
        <div class="col-12 col-lg-12 " style="background: #fff;padding: 30px;">
      
          <div class="heading">
            <h2>                    
                  @lang('website.Bank Detail')                     
            </h2>
            <hr style="
            margin-bottom: 0;
        ">
          </div>

          <div class="row">
            <div class="col-12 col-md-4">
                
  
                <table class="table order-id">
                    <tbody>
                        <tr class="d-flex">
                          <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">@lang('website.orderID')</td>
                            <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">
                            <span class="badge badge-primary"><a href="{{url('/view-order/'.session('orders_id'))}}" class="btn-link">{{$result['commonContent']['setting'][150]->value}}{{session('orders_id')}}</a></span>
                            </td>
                          </tr>
                          <tr class="d-flex">
                            <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">@lang('website.Bank')</td>
                            <td class="underline col-6 col-md-6" align="left" style="border-top: 0; border-bottom: 1px solid #dee2e6;">{{@$bankdetail['bank_name'] ?: '---' }}</td>
                          </tr>
                      </tbody>
                </table>
            </div>
            <div class="col-12 col-md-4">

                <table class="table order-id">
                  <tbody>
                      <tr class="d-flex">
                        <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">@lang('website.account_name')</td>
                          <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">
                          {{@$bankdetail['account_name'] ?: '---' }}
                          </td>
                        </tr>
                        <tr class="d-flex">
                          <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">@lang('website.account_number')</td>
                          <td class="underline col-6 col-md-6" align="left" style="border-top: 0; border-bottom: 1px solid #dee2e6;">{{@$bankdetail['account_number'] ?: '---' }}</td>
                        </tr>
                    </tbody>
              </table>
            </div>
            <div class="col-12 col-md-4">

              <table class="table order-id">
                <tbody>
                    <tr class="d-flex">
                      <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">@lang('website.short_code')</td>
                        <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">
                        {{@$bankdetail['short_code'] ?: '---' }}
                        </td>
                      </tr>
                      <tr class="d-flex">
                        <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">@lang('website.iban')</td>
                          <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">
                          {{@$bankdetail['iban'] ?: '---' }}
                          </td>
                        </tr>
                      <tr class="d-flex">
                        <td class="col-6 col-md-6" style="border-top: 0; border-bottom: 1px solid #dee2e6;">@lang('website.swift')</td>
                        <td class="underline col-6 col-md-6" align="left" style="border-top: 0; border-bottom: 1px solid #dee2e6;">{{@$bankdetail['swift'] ?: '---' }}</td>
                      </tr>
                  </tbody>
            </table>
  
            </div>
            
          </div>
  
          
  
  
        <!-- ............the end..... -->
      </div>
      @endif
      </div>
    
  </div>  
  
  
</section> 

@endsection
