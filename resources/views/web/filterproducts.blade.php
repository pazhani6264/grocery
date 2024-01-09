@if($result['products']['success']==1)
	@foreach($result['products']['product_data'] as $key=>$products)
	
        @if($result['commonContent']['settings']['product_column'] == 1)
            <div class="col-12 griding" >
                @include('web.common.product')
            </div>
        @else
            <div class="col-6 griding" >
                @include('web.common.product')
            </div>
        @endif

    @endforeach
    <input id="filter_total_record" type="hidden" value="{{$result['products']['total_record']}}">

    @if(count($result['products']['product_data'])> 0 and $result['limit'] > $result['products']['total_record'])
		<style>
			#load_products{
				display: none;
			}
			#loaded_content{
				display: block !important;
			}
			#loaded_content_empty{
				display: none !important;
			}
        </style>
    @endif
    @elseif(count($result['products']['product_data'])==0 or $result['products']['success']==0)
		<style>
            #load_products{
                display: none;
            }
            #loaded_content{
                display: none !important;
            }
            #loaded_content_empty{
                display: block !important;
            }
        </style>
    @endif
    <script type="text/javascript" src="{!! asset('web/js/lazy/jquery.lazy.min.js') !!}"></script>
  <script type="text/javascript" src="{!! asset('web/js/lazy/jquery.lazy.plugins.min.js') !!}"></script> 
  <script>
     var imgEl = document.getElementsByTagName('img');
for (var i=0; i<imgEl.length; i++) {
    if(imgEl[i].getAttribute('data-src')) {
       imgEl[i].setAttribute('src',imgEl[i].getAttribute('data-src'));
       imgEl[i].removeAttribute('data-src'); //use only if you need to remove data-src attribute after setting src
    }
}

  </script>

    <script>
        	jQuery('.add-to-cart-d-hide').show();
jQuery('.added-to-cart-d-hide').hide();

jQuery(function () {
  jQuery('[data-toggle="tooltip"]').tooltip()
});

    </script>

