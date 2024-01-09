
<section class="boxes-content">
  
    <div class="container">
      <div class="info-boxes-content">         
        <div class="row">


     
            @foreach(($result['shoppinginfo']) as $info)
             @if($info->type==1)
            <div class="col-12 col-md-6 col-lg-3 pl-xl-0">
                <div class="info-box first">
                    <div class="panel">
                        <h3 class="fas fa-truck"></h3>
                        <div class="block">
                            <h4 class="title">{{$info->shopping_info_name}}</h4>
                            <p>{{$info->shopping_info_description}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
           
            @foreach(($result['shoppinginfo']) as $info)
             @if($info->type==2)
            <div class="col-12 col-md-6 col-lg-3 pl-xl-0">
                <div class="info-box">
                    <div class="panel">
                        <h3 class="fas fa-money-bill-alt"></h3>
                        <div class="block">
                            <h4 class="title">{{$info->shopping_info_name}}</h4>
                            <p>{{$info->shopping_info_description}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
           
            @foreach(($result['shoppinginfo']) as $info)
             @if($info->type==3)
            <div class="col-12 col-md-6 col-lg-3 pl-xl-0">
              <div class="info-box">
                  <div class="panel">
                      <h3 class="fas fa-life-ring"></h3>
                      <div class="block">
                            <h4 class="title">{{$info->shopping_info_name}}</h4>
                            <p>{{$info->shopping_info_description}}</p>
                      </div>
                  </div>
              </div>
            </div>
            @endif
            @endforeach
           
            @foreach(($result['shoppinginfo']) as $info)
             @if($info->type==4)
            <div class="col-12 col-md-6 col-lg-3 pl-xl-0">
                <div class="info-box last">
                    <div class="panel">
                        <h3 class="fas fa-credit-card"></h3>
                        <div class="block">
                            <h4 class="title">{{$info->shopping_info_name}}</h4>
                            <p>{{$info->shopping_info_description}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            
          </div>
        </div>
    </div>
</section>
