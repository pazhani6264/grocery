<div class="row">
@if(count($result)>0)
@foreach ($result as $key=>$jesresult)
<div class="col-md-12" style="padding: 10px 15px;">
                             <div class="card" style="width:100%">
                              <div class="card-body" style="padding:0">
                                <h5 class="card-title" style="text-align: left;padding: 15px 15px 10px 15px;" >{{ $jesresult->redeem_points_title}}</h5>
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
                                  <a href="javascript:;" id="get-reward-value"  redeem_id="{{$jesresult->voucher_id}}" class="btn btn-secondary btn-sm buttonsize">View reward                        
                                  </a>
                                  </div>
                                
                              </div>
                             </div>   
                           </div>
@endforeach
@endif
 </div>