<table class="table" id="account_table">
                    <thead>
                      <tr>
                        <th>@lang('website.Date')</th>
                        <th>@lang('website.type')</th>
                        <th>@lang('website.Action')</th>
                        <th>@lang('website.point')</th>
                        <th>@lang('website.Status')</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $history = DB::table('transaction_points')->orderBy('id', 'DESC')->where('user_id', '=', Session::get('customers_id'))->get();
                      @endphp
                      @if(count($history)>0)
                      @foreach ($history as $key=>$jeshistory)
                      <tr>
                        <td>{{date('d/m/Y', strtotime($jeshistory->created_at)) }}</td>
                        <td>Activity</td>
                        <td>{{$jeshistory->description}}</td>
                        <td>{{$jeshistory->points}}</td>
                        <td><span class="history-approved common-bg">APPROVED</span></td>
                      </tr>
                      @endforeach
                      @endif
                    </tbody>
                  </table>