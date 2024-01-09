
<style>
  thead{
    background:#F8F8F8;
    color:#333;
  }
  
</style>

    

        <h1 style="font-size:2rem;font-weight:600;margin-bottom:20px">Appointment</h1>
          
                <!-- <table id="example" class="table" style="width:100%"> -->
                <table id="example" class="table order-table" style="width:100%">

                        <thead style="background:#f8f8f8;color:#000">
                          <tr class="" style="border:none !important">
                            <th style="text-align:left;padding:5px" class="">@lang('website.Order ID')</th>
                            <th style="text-align:left;padding:5px">@lang('website.Order Date')</th>
                            <th style="text-align:left;padding:5px">@lang('website.Price') ( RM )</th>
                            <th style="text-align:left;padding:5px">@lang('website.Status')</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(count($result['appointment']) > 0)
                          @foreach( $result['appointment'] as $resappointment)
                      
                          <tr class="">
                            <td style="display:table-cell;" class="">{{ $result['commonContent']['settings']['invoice_prefix'] }}{{$resappointment->appID}}</td>
                            <td class="">
                              {{ date('d/m/Y', strtotime($resappointment->createdDate))}}
                            </td>
                            <td style="display:table-cell;" class="">
                             
                                {{ $resappointment->amount  }}
                          </td>
                          <td>{{$resappointment->status_name}}</td>
                          </tr>
                          @endforeach
                          @else
                              <tr>
                                  <td style="display:table-cell;" colspan="6">@lang('website.No order is placed yet')</td>
                              </tr>
                          @endif
                        </tbody>
                      </table>
          