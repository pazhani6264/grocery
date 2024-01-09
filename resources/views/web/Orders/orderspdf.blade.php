
<style>
  thead{
    background:#F8F8F8;
    color:#333;
  }
  
</style>

    
            <h1 style="font-size:2rem;font-weight:600;margin-bottom:20px">Orders</h1>
                <table id="example" class="table order-table" style="width:100%">

                  <thead>
                    <tr>
                      <th style="padding:0.75rem 0px" style="text-align:left;padding:5px">@lang('website.Order ID')</th>
                      <th style="text-align:left;padding:5px">@lang('website.Order Date')</th>
                      <th style="text-align:left;padding:5px">Items Count</th>
                      <th style="text-align:left;padding:5px">@lang('website.Price')</th>
                      <th style="text-align:left;padding:5px">@lang('website.Status')</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($result['orders']) > 0)
                    @foreach( $result['orders'] as $orders)
                     

                    <tr style="border-bottom: 1px solid #eaebed !important;">
                      <td style="display:table-cell;font-weight:900;padding:0.75rem 0px !important" class="">{{ $result['commonContent']['settings']['invoice_prefix'] }}{{$orders->orders_id}}</td>
                      <td style="display:table-cell;">
                        {{ date('d M Y', strtotime($orders->date_purchased))}}<br>
                        {{ date('H:i', strtotime($orders->date_purchased))}}
                      </td>
                      <td style="display:table-cell;" class="">
                        {{ $orders->productQty }}
                      </td>
                      <td style="display:table-cell;" class="">
                       
                          {{ $orders->total_price }}
                       
                      </td>
                      <td>{{$orders->orders_status}}</td>
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td style="display:table-cell;" colspan="7">@lang('website.No order is placed yet')</td>
                        </tr>
                    @endif
                  </tbody>
                </table>
            
          
