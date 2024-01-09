<style>
	#viewrewardModal .modal-body {
 text-align:center;
 padding:0;
}

#viewrewardModal .card-body {
 padding:0;
}
#viewrewardModal .card {
    border: none;
}

#viewrewardModal .close {
  font-size: 33px;
    line-height: 45px;
    width: 45px;
    height: 45px;
    text-align: center;
    cursor: pointer;
    position: absolute;
    top: 5;
    right: 15;
    color: #000;
    opacity: 1;
}

#viewrewardModal .modal-header {
    background-color: #f9f9f9;
    border-bottom: 1px solid #eee;
    border-radius: 3px 3px 0 0;
    display: flex;
    cursor: default;
    position: relative;
}
#viewrewardModal .modal-title {
  flex-grow: 1;
    padding: 10px;
    font-size: 1.6em;
    margin: 0;
}
#viewrewardModal .view-btn-outer {
    position: absolute;
    right: 15px;
    transform: translate(0%, -50%) !important;
    top: 50%;

}

</style>
  <div class="modal-content">
 		@if(count($result)>0)
		  @foreach ($result as $key=>$jesresult)
        <div class="modal-header">
          <h4 class="modal-title">{{ $jesresult->redeem_points_title}}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="col-md-12" >
            <div class="get-redeem-vocher">
              <div class="row">
                <div class="col-md-12" style="padding: 10px 15px;">
                  <div class="card" style="width:100%">
                    <div class="card-body" style="padding:0">
                      <h5 class="card-title" style="text-align: left;padding: 15px 0 10px 0;" ><i class="fa fa-star" aria-hidden="true" style="margin-right: 2px;"></i> 
                        @if($jesresult->no_rm =='0')
                          {{$jesresult->points}} points
                        @else
                          {{$jesresult->points}} points per @if($jesresult->discount_type=='fixed_cart')
                            @if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif {{ $jesresult->no_rm }} @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif
                              @else
                                {{$jesresult->no_rm}}%
                              @endif
                        @endif
                      </h5>
                      <?php  
                        $date1 = $jesresult->voucher_date;
                        $date2 = date("Y-m-d H:i:s");
                        $from = date("Y-M-d H:i:s",strtotime($date1));
                        $to = date("Y-m-d H:i:s",strtotime($date2));

                        $diff = abs(strtotime($to) - strtotime($from));
                        $years = floor($diff / (365*60*60*24)); 

                        $months = floor(($diff - $years * 365*60*60*24)
                                                        / (30*60*60*24)); 
                      
                        $days = floor(($diff - $years * 365*60*60*24 - 
                                      $months*30*60*60*24)/ (60*60*24));
                        
                        $hours = floor(($diff - $years * 365*60*60*24 
                                - $months*30*60*60*24 - $days*60*60*24)
                                                            / (60*60)); 
                        
                        $minutes = floor(($diff - $years * 365*60*60*24 
                                  - $months*30*60*60*24 - $days*60*60*24 
                                                  - $hours*60*60)/ 60); 
                        
                        $seconds = floor(($diff - $years * 365*60*60*24 
                                  - $months*30*60*60*24 - $days*60*60*24
                                        - $hours*60*60 - $minutes*60)); 

                                      $hour = $hours.' hour '.$minutes." min ".$seconds." sec";
                                      $min = $minutes." min ".$seconds." sec";
                                      $sec = $seconds." sec";

                      ?>
                      <?php                    
                        $dt = $jesresult->voucher_date;
                        $date1 = date("Y-m-d",strtotime($dt));
                        $date2 = date("Y-m-d");

                        $diff = abs(strtotime($date2) - strtotime($date1));
                        $days = round($diff / (60*60*24));
                        if($days == 0)
                        {
                          if($hours != 0)
                          {
                            $count_date = $hour;
                          }
                          else
                          {
                            if($minutes != 0)
                          {
                            $count_date = $min;
                          }
                          else
                          {
                            $count_date = $sec;
                          }

                          }
                        }
                        else
                        {
                          $count_date = $days." days";
                        }
                      ?>
                      <p class="card-text" style="text-align: left;padding-top:0;"><i class="fa fa-clock-o" aria-hidden="true" style="margin-right:2px"></i> {{$count_date}} ago 
                      <div class="view-btn-outer">
                        <a class="btn btn-secondary btn-sm buttonsize" style="color:#fff;">Approved
                        </a>
                      </div>
                    </div>
                  </div>   
                </div>
              </div>
            </div>
          </div>                
        </div>
	 	    <div class="modal-footer">
          <input type="text" class="input_code" value="{{$jesresult->voucher_code}}" id="myInput" readonly>
          <button onclick="get_redeem_code()" class="clipboard_button"><i class="fa fa-clipboard" aria-hidden="true"></i></button>
        </div> -
		  @endforeach
    @endif
  </div>
     

<style>
.input_code{
background-color: #ffecb3;
    border: 3px dashed #ffdf80;
    border-radius: 5px;
    color: #444;
    font-size: 1.5em;
    padding: 3px 10px;
    text-align: center;
    display: inline-block;
    width: 50%;
}

.clipboard_button {
    cursor: pointer;
    border-radius: 3px;
    border: 1px solid #ccc;
    background-color: #ddd;
    outline: none;
    display: inline-block;
    position: relative;
    padding: 2px 7px;
}

        </style>