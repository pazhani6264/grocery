 @php
    $user = DB::table('users')->where('id', $wallet->user_id)->first(); 
 @endphp
<div class="row">
<div class="col-md-6">
<table class="table table-bordered">
    <thead>
      <tr>
        <th>Customer Name</th>
        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
      </tr>
      <tr>
        <th>Description</th>
        <td>{{ $wallet->description }}</td>
      </tr>
      <tr>
        <th>Payment ID</th>
        <td>{{ $wallet->payment_id }}</td>
      </tr>
       <tr>
        <th>Status</th>
        <td>{{ $wallet->pay_status }}</td>
      </tr>
    </thead>
  </table>
</div>

<div class="col-md-6">
<table class="table table-bordered">
    <thead>
      <tr>
        <th>Type</th>
        <td>
          @if($wallet->wallet_type == 'deposit')
                Deposit
          @else
                Withdrawal
          @endif
        </td>
      </tr>
      <tr>
        <th>Payment Method</th>
        <td>{{ $wallet->payment_method }}</td>
      </tr>
       <tr>
        <th>Amount</th>
        <td>{{ $wallet->amount }}</td>
      </tr>
      <tr>
        <th>Transaction ID</th>
        <td>{{ $wallet->transaction_id }}</td>
      </tr>
    </thead>
  </table>
</div>
</div>
<h4 class="modal-title">Payment Details</h4>
<br>
@if($wallet->payment_method=='banktransfer' && $wallet->wallet_type=='deposit')
  <h4 class="modal-title">Bank Receipt</h4>
  <img src="{{ asset('').$wallet->payment_response }}" style="width:45%">
@elseif($wallet->wallet_type=='deposit')
  <table class="table table-bordered">
    <thead>
      @foreach( json_decode($wallet->payment_response) as $key=>$data)
       <tr>
          <th>{{ $key }}</th>
          <td>{{ $data }}</td>
      </tr>
       @endforeach
    </thead>
  </table>
@endif