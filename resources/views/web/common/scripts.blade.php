<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>


@if(Request::path() == 'checkout')
<script src="https://js.braintreegateway.com/js/braintree-2.32.1.min.js"></script>
<script type="text/javascript">


//$.noConflict();
jQuery(document).ready(function(e) {

	braintree.setup(
		// Replace this with a client token from your server
		" <?php print session('braintree_token')?>",
		"dropin", {
		container: "payment-form"
	});


});


</script>

<script src="https://common.platinum24.net/web/js/stripe_card.js" data-rel-js></script>

<script type="application/javascript">
(function() {
  'use strict';

  var elements = stripe.elements({
    fonts: [
      {
        cssSrc: 'https://fonts.googleapis.com/css?family=Source+Code+Pro',
      },
    ],
    // Stripe's examples are localized to specific languages, but if
    // you wish to have Elements automatically detect your user's locale,
    // use `locale: 'auto'` instead.
    locale: window.__exampleLocale
  });

  // Floating labels
  var inputs = document.querySelectorAll('.cell.example.example2 .input');
  Array.prototype.forEach.call(inputs, function(input) {
    input.addEventListener('focus', function() {
      input.classList.add('focused');
    });
    input.addEventListener('blur', function() {
      input.classList.remove('focused');
    });
    input.addEventListener('keyup', function() {
      if (input.value.length === 0) {
        input.classList.add('empty');
      } else {
        input.classList.remove('empty');
      }
    });
  });

  var elementStyles = {
    base: {
      color: '#32325D',
      fontWeight: 500,
      fontFamily: 'Source Code Pro, Consolas, Menlo, monospace',
      fontSize: '16px',
      fontSmoothing: 'antialiased',

      '::placeholder': {
        color: '#CFD7DF',
      },
      ':-webkit-autofill': {
        color: '#e39f48',
      },
    },
    invalid: {
      color: '#E25950',

      '::placeholder': {
        color: '#FFCCA5',
      },
    },
  };

  var elementClasses = {
    focus: 'focused',
    empty: 'empty',
    invalid: 'invalid',
  };

  var cardNumber = elements.create('cardNumber', {
    style: elementStyles,
    classes: elementClasses,
  });
  cardNumber.mount('#example2-card-number');

  var cardExpiry = elements.create('cardExpiry', {
    style: elementStyles,
    classes: elementClasses,
  });
  cardExpiry.mount('#example2-card-expiry');

  var cardCvc = elements.create('cardCvc', {
    style: elementStyles,
    classes: elementClasses,
  });
  cardCvc.mount('#example2-card-cvc');

  registerElements([cardNumber, cardExpiry, cardCvc], 'example2');
})();
</script>
  
@endif
<script src="{!! asset('web/js/scripts.js') !!}"></script>
<script>
/////////////////// default code ///////////////////


///////////////// old code ///////////////////

//insta feeds

jQuery(document).ready(function($){
	$('#delivery_phone,#billing_phone').on('input', function() {
		var c = this.selectionStart,
			r = /[^0-9]/gi,
			v = $(this).val();
		if(r.test(v)) {
			$(this).val(v.replace(r, ''));
			c--;
		}
		this.setSelectionRange(c, c);
	});
	//  jQuery.instagramFeed({
	// 	'username': "{{ $result['commonContent']['settings']['instauserid']}}",
	// 	'container': "#instagram-feed",
	// 	'display_profile': false,
	// 	'display_biography': true,
	// 	'display_gallery': true,
	// 	'callback': true,
	// 	'styling': true,
	// 	'items': 8,
	// 	'items_per_row': 4,
	// 	'margin': 1
	// });  
}); 

// jQuery(document).ready(function($){

// jQuery(document).on('click', '.btnrating', function(){
// 	var previous_value = jQuery("#selected_rating").val();
	
// 	var selected_value = jQuery(this).attr("data-attr");
// 	jQuery"#selected_rating").val(selected_value);
	
// 	jQuery(".selected-rating").empty();
// 	jQuery(".selected-rating").html(selected_value);
	
// 	for (i = 1; i <= selected_value; ++i) {
// 		jQuery("#rating-star-"+i).toggleClass('btn-warning');
// 		jQuery("#rating-star-"+i).toggleClass('btn-default');
// 	}
	
// 	for (ix = 1; ix <= previous_value; ++ix) {
// 		jQuery("#rating-star-"+ix).toggleClass('btn-warning');
// 		jQuery("#rating-star-"+ix).toggleClass('btn-default');
// 	}
// })




// }); 






//review ajax
jQuery(".mailchimp-form").submit(function(e) {

  var response = grecaptcha.getResponse();
if(response.length == 0) 
{ 
  //reCaptcha not verified
  $(".captca").addClass("captca-error");
  event.preventDefault();
  return false;
}
else
{

e.preventDefault(); // avoid to execute the actual submit of the form.

var form = jQuery(this);
var url = form.attr('action');
  jQuery.ajax({
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        type: "GET",
        url: "{{url('/subscribeMail')}}",
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
			  jQuery('#newsletterModal').modal('hide');
        grecaptcha.reset();
			
          if(data == '1'){
              jQuery('.email').val('');
              notificationWishlist("@lang('website.mailchimp_subscribe')");
          }else if(data == '2'){
              notificationWishlist("@lang('website.mailchimp_already_subscribe')");
          }
          else if(data == '3'){
            notificationWishlist("Can't able to send mail, try again later");
        }
        else if(data == '4'){
            notificationWishlist("please verify you are human!");
        }
          else{
              notificationWishlist("@lang('website.mailchimp_error')");
          }
        }
      });

    }


});




jQuery(".notify-form").submit(function(e) {

  var response = grecaptcha.getResponse();
  if(response.length == 0) 
  { 
    //reCaptcha not verified
    $(".captca").addClass("captca-error");
    event.preventDefault();
    return false;
  }
  else
  {

e.preventDefault(); // avoid to execute the actual submit of the form.

var form = jQuery(this);
var url = form.attr('action');
  jQuery.ajax({
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        type: "GET",
        url: "{{url('/notifyme')}}",
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
      
			  jQuery('#notifyModal').modal('hide');
        grecaptcha.reset();
			
          if(data == '1'){
              jQuery('.email').val('');
              notificationWishlist("@lang('website.mailchimp_subscribe')");
          }else if(data == '2'){
              notificationWishlist("@lang('website.mailchimp_already_subscribe')");
          }
          else if(data == '3'){
              notificationWishlist("Can't able to send mail, try again later");
          }
          else if(data == '4'){
              notificationWishlist("please verify you are human!");
          }
          else{
              notificationWishlist("@lang('website.mailchimp_error')");
          }
        }
    


});
  }
});



jQuery(document).on('click', '.shipping_data', function(e){
    getZonesBilling();
  });
  
  function getZonesBilling() {
    var field_name = jQuery('.shipping_data:checked');
    var mehtod_name = jQuery(field_name).attr('method_name');
	var shipping_price = jQuery(field_name).attr('shipping_price');
    jQuery("#mehtod_name").val(mehtod_name);
    jQuery("#shipping_price").val(shipping_price);
  }
  

function notificationWishlist(param){
    jQuery('#notificationWishlist').html(param);
    jQuery('#notificationWishlist').show();
    setTimeout(function(){
        jQuery('#notificationWishlist').hide('slow');
      }, 2000);
}


jQuery(document).ready(function() {
	jQuery('#loader').hide();
});

jQuery(document).on('click','#allow-cookies', function(e){
	jQuery.ajax({
		headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
		url: '{{ URL::to("/setcookie")}}',
		type: "get",
		success: function (res) {
			jQuery('.alert-cookie').removeClass('show');
			jQuery('.alert-cookie').addClass('hide');
			$("div").removeClass("alert-cookie");
		},
	});
});

	//default product cart
  jQuery(document).on('click', '.cart', function(e){
	var parent = jQuery(this);
	var products_id = jQuery(this).attr('products_id');
	var quantity = jQuery(this).prev('.item-quantity').children('.products_'+products_id).val();
	
	if(quantity==undefined){
		quantity = 1;
	}


	var message ;
  var fhid = $('#fixheadergetvalue').val();
  var mhid = $('#mobheadergetvalue').val();
  jQuery(function ($) {
	jQuery.ajax({

		url: '{{ URL::to("/addToCart")}}',
    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

		type: "POST",
		data: '&products_id='+products_id+'&quantity='+quantity,
		success: function (res) {
			if(res.status == 'exceed'){
				notificationWishlist("@lang('website.Ops! Product is available in stock But Not Active For Sale. Please contact to the admin')");
			}
			else{
				jQuery('.head-cart-content').html(res);
				jQuery(parent).removeClass('cart');
				jQuery(parent).addClass('active');
				jQuery(parent).html("@lang('website.Added')");
        $(".header-40-cart-close").click(function(){
             
                $('.cart-click-hide').show();
                $('.cart-click-show').hide();
              });

              $(".header-40-close-cart").click(function(){
                $('.cart-click-hide').hide();
                $('.cart-click-show').show();
              });

				jQuery.ajax({

					url: '{{ URL::to("/addToCartFixed")}}',
					headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

					type: "POST",
					data: '&products_id='+products_id+'&fixedheader_id='+fhid,
					success: function (res) {            
						jQuery('.head-cart-content-fixed').html(res);
            $(".header-40-cart-close").click(function(){
                $('.cart-click-hide').show();
                $('.cart-click-show').hide();
              });

              $(".header-40-close-cart").click(function(){
                $('.cart-click-hide').hide();
                $('.cart-click-show').show();
              });
					},
				});


				jQuery.ajax({

					url: '{{ URL::to("/addToCartResponsive")}}',
					headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

					type: "POST",
					data: '&products_id='+products_id+'&mobileheader_id='+mhid,
					success: function (res) {            
						jQuery('#resposive-header-cart').html(res);
            $(".header-40-cart-close").click(function(){
                $('.cart-click-hide').show();
                $('.cart-click-show').hide();
              });

              $(".header-40-close-cart").click(function(){
                $('.cart-click-hide').hide();
                $('.cart-click-show').show();
              });
					},
				});

				notificationWishlist("@lang('website.Product Added Successfully')");

				

			}

		},
	});
 });

 


});


jQuery('.add-to-cart-d-hide').show();
jQuery('.added-to-cart-d-hide').hide();
				

	//default product cart
  jQuery(document).on('click', '.cart-icon-sb', function(e){
	var parent = jQuery(this);
	var products_id = jQuery(this).attr('products_id');
	var quantity = jQuery(this).prev('.item-quantity').children('.products_'+products_id).val();


	
	if(quantity==undefined){
		quantity = 1;
	}

//alert('ok');
	var message ;
  var fhid = $('#fixheadergetvalue').val();
  var mhid = $('#mobheadergetvalue').val();

  


  jQuery(function ($) {
	jQuery.ajax({

		url: '{{ URL::to("/addToCart")}}',
    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

		type: "POST",
		data: '&products_id='+products_id+'&quantity='+quantity,
		success: function (res) {
			if(res.status == 'exceed'){
				notificationWishlist("@lang('website.Ops! Product is available in stock But Not Active For Sale. Please contact to the admin')");
			}
			else{
        		jQuery('.head-cart-content').html(res);
				jQuery('.add-to-cart-d-hide'+products_id).hide();
				jQuery('.added-to-cart-d-hide'+products_id).show();

        $(".header-40-cart-close").click(function(){
    $('.cart-click-hide').show();
    $('.cart-click-show').hide();
   
  });

  $(".header-40-close-cart").click(function(){
    $('.cart-click-hide').hide();
    $('.cart-click-show').show();
   
  });
      
				jQuery('.tooltip-inner').html('Added!');
       

       
				jQuery.ajax({

					url: '{{ URL::to("/addToCartFixed")}}',
					headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

					type: "POST",
					data: '&products_id='+products_id+'&fixedheader_id='+fhid,
					success: function (res) {            
						jQuery('.head-cart-content-fixed').html(res);
					},
				});


				jQuery.ajax({

					url: '{{ URL::to("/addToCartResponsive")}}',
					headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

					type: "POST",
					data: '&products_id='+products_id+'&mobileheader_id='+mhid,
					success: function (res) {            
						jQuery('#resposive-header-cart').html(res);
					},
				});

				notificationWishlist("@lang('website.Product Added Successfully')");

				

			}

		},
	});
 });

 


});



jQuery(document).on('click', '#review-tabs', function(e){
	jQuery('#description-tab').removeClass('active');
	jQuery('#review-tab').addClass('active');
	jQuery('#description').removeClass('active show');
	jQuery('#review').addClass('active show');
});


  @if(!empty($result['detail']['product_data'][0]->products_type) and $result['detail']['product_data'][0]->products_type==1)
		getQuantity();
		cartPrice();
  @endif

  function cartPrice(){
    var i = 0;
    jQuery(".currentstock").each(function() {
      var value_price = jQuery('option:selected', this).attr('value_price');
      var attributes_value = jQuery('option:selected', this).attr('attributes_value');
      var prefix = jQuery('option:selected', this).attr('prefix');
      jQuery('#attributeid_' + i).val(value_price);
      jQuery('#attribute_sign_' + i++).val(prefix);

    });
  }

//ajax call for add option value
function getQuantity(){
	

	

	
}





function updateActiveClassradio(event, id, attrid, type, prefix, prefix_price) {
  var total_price = parseFloat($('#total_dis_price').html());
  var radio_total = 0;
  var check_total = 0;
  if (type === 'radio') 
  {
    $('.new-' + attrid).removeClass('active');
    $('.tick-common-' + attrid).removeClass('tick-active-new');
    if ($(event.target).is(':checked')) {
      $('.var-' + id).addClass('active');
      $('.tick-' + id).addClass('tick-active-new');
     
    }
   

    if($('.radio-' + id).val() == id) {

      
      $('.radio-' + id).prop('checked', true);
            checked = $('.radio-' + id).val();
            $('.radio-' + id).val('');

        } 
        else {

          $('.radio-' + id).prop('checked', false);
            $('.var-' + id).removeClass('active');
            $('.tick-common-' + attrid).removeClass('tick-active-new');
            $('.radio-' + id).val(id);
            
        }


   
  } 
 
  gettotalval();
}


function updateActiveClass(event, id, attrid, type, prefix, prefix_price) {
  var total_price = parseFloat($('#total_dis_price').html());
  var radio_total = 0;
  var check_total = 0;
  if (type === 'radio') 
  {
    $('.new-' + attrid).removeClass('active');
    $('.tick-common-' + attrid).removeClass('tick-active-new');
    if ($(event.target).is(':checked')) {
      $('.var-' + id).addClass('active');
      $('.tick-' + id).addClass('tick-active-new');
    }
  } 
  if (type === 'checkbox') {
    var checkbox = $(event.target);
    var liElement = $('.var-' + id);
    liElement.toggleClass('active', checkbox.is(':checked'));
    var liElement = $('.tick-' + id);
    liElement.toggleClass('tick-active-new', checkbox.is(':checked'));
    var checkbox_price = parseFloat(prefix_price);
  }
  gettotalval();
}


  
	// This button will increment the value
  jQuery(document).on('click', '.qtyplus', function(e){
	  
		// Stop acting like a button
		e.preventDefault();
		// Get its current value
    var currentVal = parseInt(jQuery('.qty').val());
		var maximumVal =  jQuery('.qty').attr('max');
		// If is not undefined
		
		if (!isNaN(currentVal)) {
			if(maximumVal!=0){
				
				if(currentVal < maximumVal ){
					// Increment
					
					jQuery('.qty').val(currentVal + 1);
				}
			}

		} else {
      // Otherwise put a 0 there
      		jQuery('.qty').val(0);
		}
    var is_special = jQuery('#special_discount').val();
    if(is_special == 'yes')
    {
		var qty = jQuery('.qty').val();
		var products_price = jQuery('#products_price').val();
		var special_price = jQuery('#special_price').val();
		var org_price = jQuery('#org_price').val();

		var total_price = parseFloat(qty) * parseFloat(special_price) * <?=session('currency_value')?>;
    var orginal_price = parseFloat(qty) * parseFloat(org_price) * <?=session('currency_value')?>;
		jQuery('#total_dis_price').html('<?=Session::get('symbol_left')?> ' +total_price.toFixed(2)+ ' <?=Session::get('symbol_right')?>');
    jQuery('#total_org_price').html('<?=Session::get('symbol_left')?> ' +orginal_price.toFixed(2)+ '<?=Session::get('symbol_right')?>');

		jQuery('.get_att_amount').html('<?=Session::get('symbol_left')?> ' +total_price.toFixed(2)+ ' <?=Session::get('symbol_right')?>');
    }
    else
    {
      var qty = jQuery('.qty').val();
		var products_price = jQuery('#products_price').val();
		var total_price = parseFloat(qty) * parseFloat(products_price) * <?=session('currency_value')?>;
		jQuery('.total_price').html('<?=Session::get('symbol_left')?> '+total_price.toFixed(2)+' <?=Session::get('symbol_right')?>');
		jQuery('.get_att_amount').html('<?=Session::get('symbol_left')?> '+total_price.toFixed(2)+' <?=Session::get('symbol_right')?>');
    }

    gettotalval();
});


// This button will decrement the value till 0
jQuery(document).on('click', '.qtyminus', function(e){

    // Stop acting like a button
    e.preventDefault();

    // Get the field name
    //fieldName = jQuery(this).attr('field');
    var maximumVal =  jQuery('.qty').attr('max');
    var minimumVal =  jQuery('.qty').attr('min');

    // Get its current value
    var currentVal = parseInt(jQuery('.qty').val());
    // If it isn't undefined or its greater than 0
    if (!isNaN(currentVal) && currentVal > minimumVal) {
      // Decrement one
      jQuery('.qty').val(currentVal - 1);

    } else {
      // Otherwise put a 0 there
      jQuery('.qty').val(minimumVal);

    }
    var is_special = jQuery('#special_discount').val();
    if(is_special == 'yes')
    {
		var qty = jQuery('.qty').val();
		var products_price = jQuery('#products_price').val();
		var special_price = jQuery('#special_price').val();
		var org_price = jQuery('#org_price').val();

		var total_price = parseFloat(qty) * parseFloat(special_price) * <?=session('currency_value')?>;
    var orginal_price = parseFloat(qty) * parseFloat(org_price) * <?=session('currency_value')?>;
		jQuery('#total_dis_price').html('<?=Session::get('symbol_left')?> ' +total_price.toFixed(2)+ ' <?=Session::get('symbol_right')?>');
    jQuery('#total_org_price').html('<?=Session::get('symbol_left')?> ' +orginal_price.toFixed(2)+ ' <?=Session::get('symbol_right')?>');

		jQuery('.get_att_amount').html('<?=Session::get('symbol_left')?> ' +total_price.toFixed(2)+ ' <?=Session::get('symbol_right')?>');
    }
    else
    {

    var qty = jQuery('.qty').val();
    var products_price = jQuery('#products_price').val();
    var total_price = parseFloat(qty) * parseFloat(products_price) * <?=session('currency_value')?>;
    jQuery('.total_price').html('<?=Session::get('symbol_left')?> '+total_price.toFixed(2)+' <?=Session::get('symbol_right')?>');
     jQuery('.get_att_amount').html('<?=Session::get('symbol_left')?> '+total_price.toFixed(2)+' <?=Session::get('symbol_right')?>');
    }

    gettotalval();

});

//add-to-Cart with custom options
jQuery(document).on('click', '.add-to-Cart', function(e){
	var formData = jQuery("#add-Product-form").serialize();

   

  var products_type = $('.products_type').val();
    var products_id = $('.products_id_new').val();
    var quantity = $('.detail-8-iput-btn').val();

    if(products_type == 1)
    {

    var option_name = $('.option_name_new').val().split(",");
    var option_id = $('.option_id_new').val().split(",");
    var attributeid = $('.attributes_id_new').val().split(","); 
    var options_values_id = $('.function_id_new').val().split(","); 

    var data = {
      products_id: products_id,
      products_type: products_type,
      attributeid: attributeid,
      option_name: option_name,
      option_id: option_id,
      options_values_id: options_values_id,
      quantity: quantity,
    };

    }

    else
    {

      var data = {
      products_id: products_id,
      products_type: products_type,
      quantity: quantity,
    };

    }
	
  var products_id = jQuery(this).attr('products_id');
 var url = jQuery('#checkout_url').val();
 var fhid = $('#fixheadergetvalue').val();
  var mhid = $('#mobheadergetvalue').val();
 var message;
 jQuery.ajax({
	 url: '{{ URL::to("/addToCart")}}',
	 headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

	 type: "POST",
	 data: data,

	 success: function (res) {
		 if(res['status'] == 'exceed'){
		   notificationWishlist("@lang('website.Ops! Product is available in stock But Not Active For Sale. Please contact to the admin')");
      }
		 else {
			 jQuery('.head-cart-content').html(res);
			 jQuery(parent).addClass('active');



			 jQuery.ajax({

			url: '{{ URL::to("/addToCartFixed")}}',
			headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

				type: "POST",
				data: '&products_id='+products_id+'&fixedheader_id='+fhid,
				success: function (res) {            
					jQuery('.head-cart-content-fixed').html(res);
				},
			});

      jQuery.ajax({

          url: '{{ URL::to("/addToCartResponsive")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

          type: "POST",
          data: '&products_id='+products_id+'&mobileheader_id='+mhid,
          success: function (res) {            
            jQuery('#resposive-header-cart').html(res);
          },
      });


		   	 notificationWishlist("@lang('website.Product Added Successfully Thanks.Continue Shopping')");
			 //alert("Congrates!", "Product Added Successfully Thanks.Continue Shopping", "success",{button: false});

		 }

		 }
 });
});


jQuery(document).ready(function() {
  @if(!empty($result['detail']['product_data'][0]->attributes))
    @foreach( $result['detail']['product_data'][0]->attributes as $key=>$attributes_data )
  @php
    $functionValue = 'attributeid_'.$key;
    $attribute_sign = 'attribute_sign_'.$key++;
  @endphp

  //{{ $functionValue }}();
	function {{ $functionValue }}(){
	    var value_price = jQuery('option:selected', ".{{$functionValue}}").attr('value_price');
	    jQuery("#{{ $functionValue }}").val(value_price);
	  }
	  //change_options
	jQuery(document).on('change', '.{{ $functionValue }}', function(e){

		    var {{ $functionValue }} = jQuery("#{{ $functionValue }}").val();

        console.log(jQuery("#{{ $functionValue }}").val());

		    var old_sign = jQuery("#{{ $attribute_sign }}").val();

        var value_price = 0;

    $(this).find("option:selected").each(function() {
      var valuePrice1 = $(this).attr('value_price');
      value_price = valuePrice1;
    });

    //alert(value_price)

		   // var value_price = jQuery('option:selected', this).attr('value_price');
		    var prefix = jQuery('option:selected', this).attr('prefix');
		    var current_price = jQuery('#products_price').val();

        //alert(prefix);
       // alert(current_price);
		    var {{ $attribute_sign }} = jQuery("#{{ $attribute_sign }}").val(prefix);

		    if(old_sign.trim()=='+'){
		      var current_price = current_price - {{ $functionValue }};
		    }

		    if(old_sign.trim()=='-'){
		      var current_price = parseFloat(current_price) + parseFloat({{ $functionValue }});
		    }

		    if(prefix.trim() == '+' ){
		      var total_price = parseFloat(current_price) + parseFloat(value_price);
          //alert('ok');
          //alert(total_price);
		    }
		    if(prefix.trim() == '-' ){
		      total_price = current_price - value_price;
		    }

        //alert(total_price);

		    jQuery("#{{ $functionValue }}").val(value_price);
		    jQuery('#products_price').val(total_price);

        var is_special = jQuery('#special_discount').val();
        if(is_special == 'yes'){
	
    }
    else
    {
		    var qty = jQuery('.qty').val();
		    var products_price = jQuery('#products_price').val();
		    var total_price = qty * products_price * <?=session('currency_value')?>;//pro-price
		    jQuery('.total_price').html('<?=Session::get('symbol_left')?>'+total_price.toFixed(2)+'<?=Session::get('symbol_right')?>');
		    //jQuery('.get_att_amount').html('<?=Session::get('symbol_left')?>'+total_price.toFixed(2)+'<?=Session::get('symbol_right')?>');
		    //alert(total_price);
    }
		    
	});
	@endforeach
	getQuantity();
	//calculateAttributePrice();
	function calculateAttributePrice(){
	  var products_price = jQuery('#products_price').val();
	  jQuery(".currentstock").each(function() {
	    var value_price  = jQuery('option:selected', this).attr('value_price');
	    var prefix = jQuery('option:selected', this).attr('prefix');

	    if(prefix.trim()=='+'){
	      products_price = products_price - value_price;
	    }

	    if(prefix.trim()=='-'){
	      products_price = products_price - value_price;
	    }

	  });
	  jQuery('#products_price').val(products_price);
	  jQuery('.total_price').html('<?=Session::get('symbol_left')?>'+products_price.toFixed(2)+'<?=Session::get('symbol_right')?>');
	}

	@endif

});

jQuery(".rating").click(function(e) {
  if(jQuery(this).prop('checked') == true){
    jQuery('#review_button').removeAttr('disabled');
  }
})


//review ajax
jQuery("#idForm").submit(function(e) {
  jQuery('#review-error').attr('hidden',true);

e.preventDefault(); // avoid to execute the actual submit of the form.

var form = jQuery(this);
var url = form.attr('action');
var reviews_text = jQuery('#reviews_text').val();
if(reviews_text != ''){
  jQuery('#review_button').attr('disabled', true);
  jQuery.ajax({
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        url: "{{url('/reviews')}}",
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
          if(data == 'done'){
              document.getElementById('idForm').reset();
              notificationWishlist("@lang('website.Thanks For Your Time And Considration For Providing FeedBack For This Product')");
          }else if(data == 'not_login'){
              notificationWishlist("@lang('website.In Order To Give FeedBack You Have Must Login First. Thanks')");

          }
          else{
              notificationWishlist("@lang('website.You Have Already Given The Comment. Thanks')");

          }
          jQuery('#review_button').attr('disabled', false);
        }
      });
}else{
  jQuery('#review-error').removeAttr('hidden');
}

});


//review ajax
jQuery("#deliveryrating_form").submit(function(e) {
  jQuery('#review-error').attr('hidden',true);

e.preventDefault(); // avoid to execute the actual submit of the form.

var form = jQuery(this);
var url = form.attr('action');
var reviews_text = jQuery('#reviews_text').val();
if(reviews_text != ''){
  jQuery('#review_button').attr('disabled', true);
  jQuery.ajax({
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        url: "{{url('/deliveryreviews')}}",
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
          if(data == 'done'){
              document.getElementById('deliveryrating_form').reset();
              window.location.href = '{{ URL::to("/orders")}}';
              notificationWishlist("@lang('website.Thanks For Your Time And Considration For Providing FeedBack For This Product')");
          }else if(data == 'not_login'){
              notificationWishlist("@lang('website.In Order To Give FeedBack You Have Must Login First. Thanks')");

          }
          else{
              notificationWishlist("@lang('website.You Have Already Given The Comment. Thanks')");

          }
          jQuery('#review_button').attr('disabled', false);
        }
      });
}else{
  jQuery('#review-error').removeAttr('hidden');
}

});




//cart item price

jQuery(".qtyminuscart").click(function(e) {

  // Stop acting like a button
  e.preventDefault();

  // Get the field name
  fieldName = jQuery(this).attr('field');

  // Get its current value
  var currentVal = parseInt(jQuery(this).parents('span').prev('.qty').val());
  var minimumVal =  jQuery(this).parents('span').prev('.qty').attr('min');
  // If it isn't undefined or its greater than 0
  if (!isNaN(currentVal) && currentVal > minimumVal) {
    // Decrement one
    jQuery(this).parents('span').prev('.qty').val(currentVal - 1);
  } else {
    // Otherwise put a 0 there
    jQuery(this).parents('span').prev('.qty').val(minimumVal);

  }
});

jQuery('.qtypluscart').click(function(e){
		e.preventDefault();
		// Get the field name
		//fieldName = jQuery(this).attr('field');
		// Get its current value
    var currentVal = parseInt(jQuery(this).parents('span').prev('.qty').val());   
		var maximumVal =  jQuery(this).parents('span').prev('.qty').attr('max');


		//alert(maximum);
		// If is not undefined
		if (!isNaN(currentVal)) {
			if(maximumVal!=0){
				if(currentVal < maximumVal ){
					// Increment
					jQuery(this).parents('span').prev('.qty').val(currentVal + 1);
				}
			}

		} else {
			// Otherwise put a 0 there
			jQuery(this).prev('.qty').val(0);
		}
});





jQuery(".qtyminuscart1").click(function(e) {

  

// Stop acting like a button
e.preventDefault();

// Get the field name
fieldName = jQuery(this).attr('field');

// Get its current value
var currentVal = parseInt(jQuery(this).parents('span').prev('.qty1').val());
var minimumVal =  jQuery(this).parents('span').prev('.qty1').attr('min');
// If it isn't undefined or its greater than 0
if (!isNaN(currentVal) && currentVal > minimumVal) {
  // Decrement one
  jQuery(this).parents('span').prev('.qty1').val(currentVal - 1);
} else {
  // Otherwise put a 0 there
  jQuery(this).parents('span').prev('.qty1').val(minimumVal);

}
});

jQuery('.qtypluscart1').click(function(e){
  e.preventDefault();
  // Get the field name
  //fieldName = jQuery(this).attr('field');
  // Get its current value
  var currentVal = parseInt(jQuery(this).parents('span').prev('.qty1').val());   
  var maximumVal =  jQuery(this).parents('span').prev('.qty1').attr('max');


  //alert(maximum);
  // If is not undefined
  if (!isNaN(currentVal)) {
    if(maximumVal!=0){
      if(currentVal < maximumVal ){
        // Increment
        jQuery(this).parents('span').prev('.qty1').val(currentVal + 1);
      }
    }

  } else {
    // Otherwise put a 0 there
    jQuery(this).prev('.qty1').val(0);
  }
});



	//update_cart
jQuery(document).on('click', '#update_cart', function(e){
	jQuery('#loader').css('display','block');
	jQuery("#update_cart_form").submit();
});


	//apply_coupon_cart
  jQuery(document).on('submit', '#apply_coupon', function(e){
		jQuery('#coupon_code').remove('error');
		jQuery('#coupon_require_error').hide();
		jQuery('#loader').show();

		if(jQuery('#coupon_code').val().length > 0){
			var formData = jQuery(this).serialize();
			jQuery.ajax({
				headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
				url: '{{ URL::to("/apply_coupon")}}',
				type: "POST",
				data: formData,
				success: function (res) {
					var obj = JSON.parse(res);
					var message = obj.message;
					jQuery('#loader').hide();
					if(obj.success==0){
						jQuery("#coupon_error").html(message).show();
						return false;
					}else if(obj.success==2){
						jQuery("#coupon_error").html(message).show();
						return false;
					}else if(obj.success==1){
           
						window.location.reload(true);
            
					}
				},
			});
		}else{
			jQuery('#loader').css('display','none');
			jQuery('#coupon_code').addClass('error');
			jQuery('#coupon_require_error').show();
			return false;
		}
		jQuery('#loader').hide();
		return false;
});
	//coupon_code
jQuery(document).on('keyup', '#coupon_code', function(e){
		jQuery("#coupon_error").hide();
		if(jQuery(this).val().length >0){
			jQuery('#coupon_code').removeClass('error');
			jQuery('#coupon_require_error').hide();
		}else{
			jQuery('#coupon_code').addClass('error');
			jQuery('#coupon_require_error').show();
		}

});


//validate form
jQuery(document).on('submit', '.form-validate-login', function(e){
var error = "";

var check = 0;
jQuery(".password-login").each(function() {
	if(this.value == '') {
		jQuery(this).css('border-color', 'red');
		jQuery(this).parents(".input-group").addClass('has-error');
		jQuery(this).next(".error-content").removeAttr('hidden');
		error = "has error";
	}else{
		jQuery(this).css('border-color', '#dee2e6');
		jQuery(this).parents(".input-group").removeClass('has-error');
		jQuery(this).next(".error-content").attr('hidden', true);
	}

});

jQuery(".email-validate-login").each(function() {
		var validEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
		if(this.value != '' && validEmail.test(this.value)) {
		jQuery(this).css('border-color', '#dee2e6');
			jQuery(this).parents(".input-group").removeClass('has-error');
			jQuery(this).next(".error-content").attr('hidden', true);
		}else{
			jQuery(this).css('border-color', 'red');
			jQuery(this).parents(".input-group").addClass('has-error');
			jQuery(this).next(".error-content").removeAttr('hidden');
			error = "has error";
		}
});
	if(error=="has error"){
		return false;
	}
});





//validate form
jQuery(document).on('submit', '.form-validate', function(e){
var error = "";
jQuery(".field-validate").each(function() {
		if(this.value == '') {
			jQuery(this).css('border-color', 'red');
			jQuery(this).parents(".input-group").addClass('has-error');
			jQuery(this).next(".error-content").removeAttr('hidden');
			error = "has error";
		}else{
			jQuery(this).css('border-color', '#dee2e6');
			jQuery(this).parents(".input-group").removeClass('has-error');
			jQuery(this).next(".error-content").attr('hidden', true);
		}
});
var check = 0;
jQuery(".password").each(function() {
		var regex = "^\\s+$";
		if(this.value.match(regex)) {
			jQuery(this).css('border-color', 'red');
			jQuery(this).parents(".input-group").addClass('has-error');
			jQuery(this).next(".error-content").removeAttr('hidden');
			error = "has error";
		}else{
			if(check == 1){
				 var res = passwordMatch();

					if(res=='matched'){
						jQuery(this).css('border-color', '#dee2e6');
						jQuery('.password').parents(".input-group").removeClass('has-error');
						jQuery('.re-password-content').attr('hidden', true);
						jQuery('.len-password-content').attr('hidden', true);
						jQuery('.cap-password-content').attr('hidden', true);
						jQuery('.num-password-content').attr('hidden', true);
					}else if(res=='error'){
						jQuery(this).css('border-color', 'red');
						jQuery('.password').parents(".input-group").addClass('has-error');
						jQuery('.len-password-content').attr('hidden', true);
						jQuery('.cap-password-content').attr('hidden', true);
						jQuery('.num-password-content').attr('hidden', true);
						jQuery('.re-password-content').removeAttr('hidden');
						error = "has error";
					}else if(res=='lerror'){
					    jQuery(this).css('border-color', 'red');
					    jQuery('.password').parents(".input-group").addClass('has-error');
					    jQuery('.num-password-content').attr('hidden', true);
					    jQuery('.cap-password-content').attr('hidden', true);
					    jQuery('.len-password-content').removeAttr('hidden');
					    error = "has error";
					}else if(res=='cerror'){
						jQuery(this).css('border-color', 'red');
						jQuery('.password').parents(".input-group").addClass('has-error');
						jQuery('.num-password-content').attr('hidden', true);
						jQuery('.cap-password-content').removeAttr('hidden');
						 error = "has error";
					}else if(res=='nuerror'){
						jQuery(this).css('border-color', 'red');
						jQuery('.password').parents(".input-group").addClass('has-error');
						jQuery('.cap-password-content').attr('hidden', true);
						jQuery('.num-password-content').removeAttr('hidden');
						 error = "has error";
					}
				}else{
					jQuery(this).css('border-color', '#dee2e6');
					jQuery(this).parents(".input-group").removeClass('has-error');
					jQuery(this).next(".error-content").attr('hidden', true);
				}
				 check++;
			}

});

jQuery(".number-validate").each(function() {
		if(this.value == '' || isNaN(this.value)) {
		jQuery(this).css('border-color', 'red');
			jQuery(this).parents(".input-group").addClass('has-error');
			jQuery(this).next(".error-content").removeAttr('hidden');
			error = "has error";
		}else{
			jQuery(this).css('border-color', '#dee2e6');
			jQuery(this).parents(".input-group").removeClass('has-error');
			jQuery(this).next(".error-content").attr('hidden', true);
		}
});

	jQuery(".email-validate").each(function() {
		var validEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
		if(this.value != '' && validEmail.test(this.value)) {
			jQuery(this).css('border-color', '#dee2e6');
			jQuery(this).parents(".input-group").removeClass('has-error');
			jQuery(this).next(".error-content").attr('hidden', true);
		}else{
			jQuery(this).css('border-color', 'red');
			jQuery(this).parents(".input-group").addClass('has-error');
			jQuery(this).next(".error-content").removeAttr('hidden');
			error = "has error";
		}
	});

	jQuery(".checkbox-validate").each(function() {

		if(jQuery(this).prop('checked') == true){
			jQuery(this).css('border-color', '#dee2e6');
			jQuery(this).parents(".input-group").removeClass('has-error');
			jQuery(this).closest('.checkbox-parent').children('.error-content').attr('hidden', true);
		}else{
			jQuery(this).css('border-color', 'red');
			jQuery(this).parents(".input-group").addClass('has-error');
			jQuery(this).closest('.checkbox-parent').children('.error-content').removeAttr('hidden');
			error = "has error";
		}

	});

	jQuery(".phone-validate").each(function() {
		if(this.value == '' || isNaN(this.value) || this.value.length < 7) {
			jQuery(this).css('border-color', 'red');
			jQuery(this).parents(".input-group").addClass('has-error');
			jQuery(this).next(".error-content").removeAttr('hidden');
			error = "has error";
		}else{
			jQuery(this).css('border-color', '#dee2e6');
			jQuery(this).parents(".input-group").removeClass('has-error');
			jQuery(this).next(".error-content").attr('hidden', true);
		}

	});

	if(error=="has error"){
		return false;
	}
});



//focus form field
jQuery(document).on('keyup focusout change', '.field-validate', function(e){
	if(this.value == '') {
		jQuery(this).css('border-color', 'red');
		jQuery(this).parents(".input-group").addClass('has-error');
		jQuery(this).next(".error-content").removeAttr('hidden');
	}else{
		jQuery(this).css('border-color', '#dee2e6');
		jQuery(this).parents(".input-group").removeClass('has-error');
		jQuery(this).next(".error-content").attr('hidden', true);
	}
});
//focus form field
jQuery(document).on('keyup', '.number-validate', function(e){
	if(this.value == '' || isNaN(this.value)) {
		jQuery(this).css('border-color', 'red');
		jQuery(this).parents(".input-group").addClass('has-error');
		jQuery(this).next(".error-content").removeAttr('hidden');
	}else{
		jQuery(this).css('border-color', '#dee2e6');
		jQuery(this).parents(".input-group").removeClass('has-error');
		jQuery(this).next(".error-content").attr('hidden', true);
	}
});

//match password
jQuery(document).on('keyup', '.password', function(e){
	var regex = "^\\s+$";
	if(this.value == '') {
		jQuery(this).css('border-color', 'red');
		jQuery(this).parents(".input-group").addClass('has-error');
		jQuery(this).next(".error-content").removeAttr('hidden');
		jQuery(".re-password-content").attr('hidden', true);
	}else{
		jQuery(this).css('border-color', '#dee2e6');
		jQuery(this).parents(".input-group").removeClass('has-error');
		jQuery(this).next(".error-content").attr('hidden', true);
		jQuery(".re-password-content").attr('hidden', true);
	}
});

jQuery(document).on('keyup focusout', '.email-validate', function(e){
	var validEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

	if(this.value != '' && validEmail.test(this.value)) {
		jQuery(this).css('border-color', '#dee2e6');
		jQuery(this).parents(".input-group").removeClass('has-error');
		jQuery(this).next(".error-content").attr('hidden', true);
	}else{
		jQuery(this).css('border-color', 'red');
		jQuery(this).parents(".input-group").addClass('has-error');
		jQuery(this).next(".error-content").removeAttr('hidden');
		error = "has error";
	}

});

//match password
jQuery(document).on('keyup focusout', '.password-login ', function(e){
	var regex = "^\\s+$";
	if(this.value == '' ) {
		jQuery(this).css('border-color', 'red');
		jQuery(this).parents(".input-group").addClass('has-error');
		jQuery(this).next(".error-content").removeAttr('hidden');
	}else{
		jQuery(this).css('border-color', '#dee2e6');
		jQuery(this).parents(".input-group").removeClass('has-error');
		jQuery(this).next(".error-content").attr('hidden', true);
	}
});

jQuery(document).on('keyup focusout', '.email-validate-login', function(e){
	var validEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

	if(this.value != '' && validEmail.test(this.value)) {
		jQuery(this).css('border-color', '#dee2e6');
		jQuery(this).parents(".input-group").removeClass('has-error');
		jQuery(this).next(".error-content").attr('hidden', true);
	}else{
		jQuery(this).css('border-color', 'red');
		jQuery(this).parents(".input-group").addClass('has-error');
		jQuery(this).next(".error-content").removeAttr('hidden');
		error = "has error";
	}

});

jQuery(document).on('keyup focusout', '.phone-login', function(e){

	if(this.value == '' || this.value.length < 7 || isNaN(this.value)) {
		jQuery(this).css('border-color', '#dee2e6');
		jQuery(this).parents(".input-group").removeClass('has-error');
		jQuery(this).next(".error-content").attr('hidden', true);
	}else{
		jQuery(this).css('border-color', 'red');
		jQuery(this).parents(".input-group").addClass('has-error');
		jQuery(this).next(".error-content").removeAttr('hidden');
		error = "has error";
	}

});

jQuery(document).on('keyup focusout', '.phone-validate', function(e){

	if(this.value == '' || isNaN(this.value) || this.value.length < 7) {
		jQuery(this).css('border-color', 'red');
		jQuery(this).parents(".input-group").addClass('has-error');
		jQuery(this).next(".error-content").removeAttr('hidden');
		error = "has error";
	}else{
		jQuery(this).css('border-color', '#dee2e6');
		jQuery(this).parents(".input-group").removeClass('has-error');
		jQuery(this).next(".error-content").attr('hidden', true);
	}
});



$('#customers_dob').datepicker({
	autoclose: true,
	format: 'dd/mm/yyyy',
	endDate: "today"
});


// paymentMethods();
function paymentMethods(){
  var pres = $('#files').val();

  var tamount= parseInt("{{session('total_price')}}");
  var senang_amount=$('#senang_amount').val();
  var senang_check=parseInt(senang_amount);
  var wuseramount = <?php if(auth()->guard('customer')->check()) { echo auth()->guard('customer')->user()->wallet_amount; } else { echo '0';} ?>;
  var wamount= parseInt(wuseramount);

  $('#preresponse').css('display','none');
  if(pres === ''){
    $('#preresponse').html('Please upload prescription');
    $('#preresponse').css('display','block');
  }else{
    jQuery("#hide_pay_btn_new").val('0');
    var currency_code = "{{session('currency_code')}}";
    jQuery('#loader').show();
    var payment_method = jQuery(".payment_method:checked").val();
    var onlinetype='orderproduct';
    var text = payment_method +' not support ' + currency_code +' Currency.';

	jQuery(".payment_btns").hide();

		jQuery.ajax({
			headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
			url: '{{ URL::to("/paymentcurrencycheck")}}',
			type: "POST",
			data: '&payment_method='+payment_method+'&currency_code='+currency_code,
			success: function (res) {
					if(res == 0)
					{
						jQuery('#payment_error').show();
						jQuery('#payment_error-error-text').html(text);
						jQuery('#loader').hide();
					}
					else
					{

						if(payment_method=='wallet'){
            		 if(tamount <= wamount){
            		 	  //alert(wamount);
            		 	 jQuery('#payment_error').hide();
                	 jQuery("#"+payment_method+'_button').show();
            		 }else{
            		 		//alert(tamount);
            		 		//alert(wamount);
            		 		jQuery('#payment_error').show();
              			jQuery('#payment_error-error-text').html('Your wallet balance amount is too low please try again later');
              			jQuery('#loader').hide();
            		 }
            	}else{
            		jQuery('#payment_error').hide();
                jQuery("#"+payment_method+'_button').show();
            	}
            	if(payment_method=='senangpay'){
            		if(senang_check >= '2'){
            			 //alert(senang_check);
            			 jQuery('#payment_error').hide();
                	 jQuery("#"+payment_method+'_button').show();
            		}else{
            				//alert(senang_check);
            			  jQuery('#payment_error').show();
            			  jQuery("#"+payment_method+'_button').hide();
              			jQuery('#payment_error-error-text').html('Minimum amount should be RM 2 and above');
              			jQuery('#loader').hide();
            		}
            	}else{
            		jQuery('#payment_error').hide();
                jQuery("#"+payment_method+'_button').show();
            	}
						jQuery.ajax({
							headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
							url: '{{ URL::to("/paymentComponent")}}',
							type: "POST",
              data: '&payment_method='+payment_method+'&onlinetype='+onlinetype,							success: function (res) {
								jQuery('#loader').hide();
							},
						});

					//midtrans transaction
					//jQuery(document).on('click', '#midtrans_button', function(e){

						if(payment_method == 'banktransfer'){
							jQuery('#payment_description').show();
						}else{
							jQuery('#payment_description').hide();
						}
						
						if(payment_method == 'midtrans'){
							jQuery('#loader').show();
							jQuery.ajax({
								headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
								url: '{{ URL::to("/midtrans/transaction")}}',
								type: "get",
								success: function (res) {
									jQuery('#loader').hide();
									jQuery('#payment_error').hide();
									
									var data = JSON.parse(res);
									var success = data.status;
									var message = data.message;
									var token = data.token;

									if(success==1){
										//var url = data.data.authorization_url;
										//window.location.href = url;
										jQuery('#midtransToken').val(token);
										

									}else{
										jQuery('#payment_error').show();
										jQuery('#payment_error-error-text').html(message);
									}

								},
							});
						}

					}
				
			},
		});
  }
}

function paymentMethodsWallet()
{
	var wamount=jQuery("#wamount").val();
	if(wamount != ''){
	jQuery("#hide_pay_btn_new").val('0');
	var currency_code = "{{session('currency_code')}}";
	jQuery('#loader').show();
	var payment_method = jQuery(".payment_method:checked").val();
	var onlinetype='wallet';

	var text = payment_method +' not support ' + currency_code +' Currency.';

	jQuery(".payment_btns").hide();

		jQuery.ajax({
			headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
			url: '{{ URL::to("/paymentcurrencycheck")}}',
			type: "POST",
			data: '&payment_method='+payment_method+'&currency_code='+currency_code,
			success: function (res) {
					if(res == 0)
					{
						jQuery('#payment_error').show();
						jQuery('#payment_error-error-text').html(text);
						jQuery('#loader').hide();
					}
					else
					{

						jQuery('#payment_error').hide();
						jQuery("#"+payment_method+'_button').show();
						jQuery.ajax({
							headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
							url: '{{ URL::to("/paymentComponentWallet")}}',
							type: "POST",
							data: '&payment_method='+payment_method+'&wamount='+wamount+'&onlinetype='+onlinetype,
							success: function (res) {
								jQuery('#loader').hide();
							},
						});

					//midtrans transaction
					//jQuery(document).on('click', '#midtrans_button', function(e){

						if(payment_method == 'banktransfer'){
							jQuery('#payment_description').show();
						}else{
							jQuery('#payment_description').hide();
						}
						
						if(payment_method == 'midtrans'){
							jQuery('#loader').show();
							jQuery.ajax({
								headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
								url: '{{ URL::to("/midtrans/transaction")}}',
								type: "get",
								success: function (res) {
									jQuery('#loader').hide();
									jQuery('#payment_error').hide();
									
									var data = JSON.parse(res);
									var success = data.status;
									var message = data.message;
									var token = data.token;

									if(success==1){
										//var url = data.data.authorization_url;
										//window.location.href = url;
										jQuery('#midtransToken').val(token);
										

									}else{
										jQuery('#payment_error').show();
										jQuery('#payment_error-error-text').html(message);
									}

								},
							});
						}

					}
				
			},
		});
	}else{
		alert('Please enter amount');
		$(':radio').each(function () {
		$(this).removeAttr('checked');
		$('input[type="radio"]').prop('checked', false);
	})
	}
}


// paymentMethods();
function paymentTable(){
  jQuery("#hide_pay_btn_new").val('0');
	var currency_code = "{{session('currency_code')}}";
	jQuery('#loader').show();
	var payment_method = jQuery(".payment_method:checked").val();
  var onlinetype='orderproduct';
	var text = payment_method +' not support ' + currency_code +' Currency.';

	jQuery(".payment_btns").hide();

		jQuery.ajax({
			headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
			url: '{{ URL::to("/paymentcurrencycheck")}}',
			type: "POST",
			data: '&payment_method='+payment_method+'&currency_code='+currency_code,
			success: function (res) {
					if(res == 0)
					{
						jQuery('#payment_error').show();
						jQuery('#payment_error-error-text').html(text);
						jQuery('#loader').hide();
					}
					else
					{	
						jQuery('#payment_error').hide();
            jQuery("#"+payment_method+'_button').show();
						jQuery.ajax({
							headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
							url: '{{ URL::to("/paymentComponent")}}',
							type: "POST",
              data: '&payment_method='+payment_method+'&onlinetype='+onlinetype,							success: function (res) {
								jQuery('#loader').hide();
							},
						});

					//midtrans transaction
					//jQuery(document).on('click', '#midtrans_button', function(e){

						if(payment_method == 'banktransfer'){
							jQuery('#payment_description').show();
						}else{
							jQuery('#payment_description').hide();
						}
						
						if(payment_method == 'midtrans'){
							jQuery('#loader').show();
							jQuery.ajax({
								headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
								url: '{{ URL::to("/midtrans/transaction")}}',
								type: "get",
								success: function (res) {
									jQuery('#loader').hide();
									jQuery('#payment_error').hide();
									
									var data = JSON.parse(res);
									var success = data.status;
									var message = data.message;
									var token = data.token;

									if(success==1){
										//var url = data.data.authorization_url;
										//window.location.href = url;
										jQuery('#midtransToken').val(token);
										

									}else{
										jQuery('#payment_error').show();
										jQuery('#payment_error-error-text').html(message);
									}

								},
							});
						}

					}
				
			},
		});
}



function paymentSuccess(result){
	jQuery('#payment_error').hide();
	console.log(result);
	console.log(result.status_code);
	result = result.replace(/'/g, "\\'");
	//jQuery('#update_cart_form').prepend('<input type="hidden" name="nonce" value='+JSON.stringify(result)+'>');
	jQuery("#loader").show();
	jQuery("#update_cart_form").submit();
}


//paystack transaction
jQuery(document).on('click', '#paystack_button', function(e){
	jQuery('#loader').show();
	jQuery.ajax({
		headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
		url: '{{ URL::to("/paystack/transaction")}}',
		type: "get",
		success: function (res) {
			jQuery('#loader').hide();
			jQuery('#payment_error').hide();
			
			var data = JSON.parse(res);
			var success = data.status;
			var message = data.message;
			console.log(message);
			if(success==true){
				var url = data.data.authorization_url;
				window.location.href = url;
			}else{
				jQuery('#payment_error').show();
				jQuery('#payment_error-error-text').html(message);
			}

		},
	});

});


var resposne = jQuery('#hyperpayresponse').val();
if(typeof resposne  !== "undefined"){
	if(resposne.trim() =='success'){
		jQuery('#loader').show();
		jQuery("#update_cart_form").submit();
	}else if(resposne.trim() =='error'){
		jQuery.ajax({
			headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
			url: '{{ URL::to("/checkout/payment/changeresponsestatus")}}',
			type: "POST",
			async: false,
			success: function (res) {
			},
		});
		jQuery('#paymentError').css('display','block');
	}
}


//pay_instamojo
jQuery(document).on('click', '#pay_instamojo', function(e){
	var formData = jQuery("#instamojo_form").serialize();
	jQuery.ajax({
		headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
		url: '{{ URL::to("/pay-instamojo")}}',
		type: "POST",
		data: formData,
		success: function (res) {
			var data = JSON.parse(res);

			var success = data.success;
			if(success==false){
				var phone = data.message.phone;
				var email = data.message.email;

				if(phone != null){
					var message = phone;
				}else if(email != null){
					var message = email;
				}else{
					var message = 'Something went wrong!';
				}

				jQuery('#insta_mojo_error').show();
				jQuery('#instamojo-error-text').html(message);

			}else{
				jQuery('#insta_mojo_error').hide();
				jQuery('#instamojoModel').modal('hide');
				jQuery('#update_cart_form').prepend('<input type="hidden" name="nonce" value='+JSON.stringify(data)+'>');
				jQuery("#update_cart_form").submit();
			}

		},
	});

});

function getZones() {
		jQuery(function ($) {
			jQuery('#loader').show();
			var country_id = jQuery('#entry_country_id').val();
			jQuery.ajax({
				beforeSend: function (xhr) { // Add this line
								xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
				 },
				url: '{{ URL::to("/ajaxZones")}}',
				type: "POST",
				//data: '&country_id='+country_id,
				 data: {'country_id': country_id,"_token": "{{ csrf_token() }}"},

				success: function (res) {
					var i;
					var showData = [];
					for (i = 0; i < res.length; ++i) {
						var j = i + 1;
						showData[i] = "<option value='"+res[i].zone_id+"'>"+res[i].zone_name+"</option>";
					}
					showData.push("<option value='-1'>@lang('website.Other')</option>");
					jQuery("#entry_zone_id").html(showData);
					jQuery('#loader').hide();
				},
			});
		});
};

function getBillingZones() {
	jQuery('#loader').show();
	var country_id = jQuery('#billing_countries_id').val();
	jQuery.ajax({
		headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
		url: '{{ URL::to("/ajaxZones")}}',
		type: "POST",
		 data: {'country_id': country_id},

		success: function (res) {
			var i;
			var showData = [];
			for (i = 0; i < res.length; ++i) {
				var j = i + 1;
				showData[i] = "<option value='"+res[i].zone_id+"'>"+res[i].zone_name+"</option>";
			}
			showData.push("<option value='Other'>@lang('website.Other')</option>");
			jQuery("#billing_zone_id").html(showData);
			jQuery('#loader').hide();
		},
	});

};

//change password
jQuery("#updateMyPassword").click(function(){ 
  //passowrd-error
  var confirm_password = jQuery("#confirm_password").val();
  var new_password = jQuery('#new_password').val();
  var current_password = jQuery('#current_password').val();
  jQuery('#passowrd-error').attr('hidden', true);
      
  if(confirm_password !='' && new_password != '' && current_password !=''){
    if(new_password.length < 8){
      message = "Please enter at least 8 characters";
      jQuery('#passowrd-error').text(message);
      jQuery('#passowrd-error').removeAttr('hidden');
      return false;
    }

    if ( new_password.match(/[A-Z]/) ) {
 
    } else {
      message = "Please enter at least 1 Captial Letter";
          jQuery('#passowrd-error').text(message);
          jQuery('#passowrd-error').removeAttr('hidden');
          return false;
    }


    if (new_password.match(/\d/) ) {
     
    } else {
      message = "Please enter at least 1 number";
      jQuery('#passowrd-error').text(message);
      jQuery('#passowrd-error').removeAttr('hidden');
      return false;
    }

    if(current_password == new_password){
      message = "New Password Should not same as Current Password";
      jQuery('#passowrd-error').text(message);
      jQuery('#passowrd-error').removeAttr('hidden');
      return false;
    }
    else{
    if(confirm_password == new_password){

      jQuery(function ($) {
        jQuery.ajax({
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          url: '{{ URL::to("/updateMyPassword")}}',
          type: "POST",
          data: 'current_password='+current_password+'&new_password='+new_password,
          beforeSend: function() {
              $('#passowrd-error').html('loading ...');
              jQuery('#passowrd-error').removeAttr('hidden');
          },
          success: function (res) {
            if(res == '1'){
                message = "Current Password is invalid";
                jQuery('#passowrd-error').text(message);
                jQuery('#passowrd-error').removeAttr('hidden');
                return false;
            }  else{
                location.reload();
            }
          },
        });
      });
     
    }else{
      message = "@lang('website.New and confirm password does not match')";
      jQuery('#passowrd-error').text(message);
      jQuery('#passowrd-error').removeAttr('hidden');
      return false;
    }
  }
    
  }else{
    message = "@lang('website.Please fill all the input fields')";
    jQuery('#passowrd-error').text(message);
    jQuery('#passowrd-error').removeAttr('hidden');
    return false;
  }

});
</script>


<script type="application/javascript">

	OneSignal.push(function() {
		/* These examples are all valid */
		OneSignal.getUserId(function(userId) {
			console.log("OneSignal User ID:", userId);

			//ajax request
			jQuery.ajax({
				headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
				url: '{{ URL::to("/setSession")}}',
				type: "get",
				data: '&device_id='+userId,
				success: function (res) {},
			});

			// (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316    
		});
					
		OneSignal.getUserId().then(function(userId) {
			//console.log("OneSignal User ID:", userId);
			// (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316    
		});
	});

//header categories
jQuery('.categories-list').on('click', function(e){     
    var category = jQuery(this).attr('value');
    var slug = jQuery(this).attr('slug');
    jQuery('.header-selection').text(category);
    jQuery('.category-value').val(slug);
    jQuery('.typeheads_mobile').val('');
    jQuery('.typeheads_mobile_fixed_40').val('');
    jQuery('.typeheads').val('');
	jQuery('.search_outer_con').removeClass('enable_search');
		jQuery('.search_outer_con_mobile').removeClass('enable_search');
		jQuery('.search_outer_con_mobile_fixed_40').removeClass('enable_search');
    jQuery('.dropdown-menu-right').removeClass('show');

});

categoriesLoad();

function categoriesLoad(){  
  var category = jQuery('.selected').attr('value');     
  var slug = jQuery('.selected').attr('slug');
  if ( category !== undefined) {    
      jQuery('.header-selection').text(category);
      jQuery('.category-value').val(slug);
      jQuery('.dropdown-menu-right').removeClass('show');
  }
    
}

@if(Request::path() == 'profile')
  jQuery(function() {
    jQuery('.datepicker').datepicker({
      changeMonth: true,
      changeYear: true,
	    maxDate: '0',
    });
  });
@endif


jQuery( document ).ready( function () {
	jQuery('#loader').hide();
	 OneSignal.push(function () {
	  OneSignal.registerForPushNotifications();
	  OneSignal.on('subscriptionChange', function (isSubscribed) {
	   if (isSubscribed) {
		OneSignal.getUserId(function (userId) {
		 device_id = userId;
		 //ajax request
		 jQuery.ajax({
			 headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
			url: '{{ URL::to("/subscribeNotification")}}',
			type: "POST",
			data: '&device_id='+device_id,
			success: function (res) {},
		});

		 //$scope.oneSignalCookie();
		});
	   }
	  });

	 });

	//load google map
@if(Request::path() == 'contact-us')
	initialize();
@endif

@if(Request::path() == 'checkout')
	getZonesBilling();
	paymentMethods();
@endif

//$.noConflict();
	//stripe_ajax
jQuery(document).on('click', '#stripe_ajax', function(e){
	jQuery('#loader').show();
	jQuery.ajax({
		headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
		url: '{{ URL::to("/stripeForm")}}',
		type: "POST",
		success: function (res) {
			if(res.trim() == "already added"){
			}else{
				jQuery('.head-cart-content').html(res);
				jQuery(parent).removeClass('cart');
				jQuery(parent).addClass('active');
			}
			message = "@lang('website.Product is added')";
			notification(message);
			jQuery('#loader').hide();
		},
	});
});

jQuery(document).on('click', '.modal_show', function(e){
  jQuery("#products-detail").html('');
  jQuery('#myModal').modal('show');
	var parent = jQuery(this);
	var products_id = jQuery(this).attr('products_id');
	var message ;
  jQuery(function ($) {
	jQuery.ajax({
	url: '{{ URL::to("/modal_show")}}',
    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

		type: "POST",
		data: '&products_id='+products_id,
    beforeSend: function() {
        $('#loadermodal').removeClass('hidden')
    },
		success: function (res) {
			jQuery("#products-detail").html(res);
			// jQuery('#myModal').modal('show');

		},
    complete: function(){
        $('#loadermodal').addClass('hidden')
    },
	});
 });
});

jQuery(document).on('click', '.modal_show2', function(e){
  jQuery("#products-detail2").html('');
  jQuery('#myModal_molla').modal('show');
	var parent = jQuery(this);
	var products_id = jQuery(this).attr('products_id');
	var message ;
  jQuery(function ($) {
	jQuery.ajax({
	url: '{{ URL::to("/modal_show2")}}',
    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

		type: "POST",
		data: '&products_id='+products_id,
    beforeSend: function() {
        $('#loadermodal2').removeClass('hidden')
    },
		success: function (res) {
			jQuery("#products-detail2").html(res);

		},
    complete: function(){
        $('#loadermodal2').addClass('hidden')
    },
	});
 });
});


jQuery(document).on('click', '.quickmodal_show3', function(e){
  jQuery("#products-detail3").html('');
  jQuery('#myModal_molla3').modal('show');
	var parent = jQuery(this);
	var products_id = jQuery(this).attr('products_id');
	var message ;
  jQuery(function ($) {
	jQuery.ajax({
	url: '{{ URL::to("/quickmodal_show3")}}',
    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

		type: "POST",
		data: '&products_id='+products_id,
    beforeSend: function() {
        $('#loadermodal3').removeClass('hidden')
    },
		success: function (res) {
			jQuery("#products-detail3").html(res);

		},
    complete: function(){
        $('#loadermodal3').addClass('hidden')
    },
	});
 });
});


jQuery(document).on('click', '.modal_show5', function(e){
  jQuery("#products-detail5").html('');
  jQuery('#myModal_tbm').modal('show');
	var parent = jQuery(this);
	var products_id = jQuery(this).attr('products_id');
	var message ;
  jQuery(function ($) {
	jQuery.ajax({
	url: '{{ URL::to("/modal_show5")}}',
    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

		type: "POST",
		data: '&products_id='+products_id,
    beforeSend: function() {
        $('#loadermodal5').removeClass('hidden')
    },
		success: function (res) {
			jQuery("#products-detail5").html(res);

		},
    complete: function(){
        $('#loadermodal5').addClass('hidden')
    },
	});
 });
});




jQuery(document).on('click', '.login_modal', function(e){
  jQuery("#login-detail").html('');

    jQuery('#myModallogin_molla').modal('show');
 
    jQuery(function ($) {
     jQuery.ajax({
     url: '{{ URL::to("/login_modal")}}',
     type: "GET",
       beforeSend: function() {
           $('#loadermodallogin').removeClass('hidden')
       },
       success: function (res) {
         jQuery("#login-detail").html(res);
       },
       complete: function(){
           $('#loadermodallogin').addClass('hidden')
       },
     });
   });
 
 });


 jQuery(document).on('click', '.login_modal1', function(e){
  jQuery("#login-detail1").html('');
    jQuery('#myModallogin_molla1').modal('show');
 
    jQuery(function ($) {
     jQuery.ajax({
     url: '{{ URL::to("/login_modal1")}}',
     type: "GET",
       beforeSend: function() {
           $('#loadermodallogin').removeClass('hidden')
       },
       success: function (res) {
         jQuery("#login-detail1").html(res);
       },
       complete: function(){
           $('#loadermodallogin').addClass('hidden')
       },
     });
   });
 
 });


 jQuery(document).on('click', '.login_modal2', function(e){
  jQuery("#login-detail2").html('');
    jQuery('#myModallogin_molla2').modal('show');
 
    jQuery(function ($) {
     jQuery.ajax({
     url: '{{ URL::to("/login_modal2")}}',
     type: "GET",
       beforeSend: function() {
           $('#loadermodallogin').removeClass('hidden')
       },
       success: function (res) {
         jQuery("#login-detail2").html(res);
       },
       complete: function(){
           $('#loadermodallogin').addClass('hidden')
       },
     });
   });
 
 });


 jQuery(document).on('click', '.login_modal3', function(e){
  jQuery("#login-detail3").html('');
    jQuery('#myModallogin_molla3').modal('show');
 
    jQuery(function ($) {
     jQuery.ajax({
     url: '{{ URL::to("/login_modal3")}}',
     type: "GET",
       beforeSend: function() {
           $('#loadermodallogin').removeClass('hidden')
       },
       success: function (res) {
         jQuery("#login-detail3").html(res);
       },
       complete: function(){
           $('#loadermodallogin').addClass('hidden')
       },
     });
   });
 
 });
 


 
jQuery(document).on('click', '#closeNavlogin', function(e){

jQuery("#myModallogin_molla4").css('width','0');
jQuery("html").css('overflow','auto');
jQuery("html").css('height','auto');
jQuery("body").css('overflow','auto');
jQuery("body").css('height','auto');
jQuery("#overlaylogin").css('display','none');


});



jQuery(document).on('click', '.login_modal4', function(e){
jQuery("#myModallogin_molla4").css('width','500px');
jQuery("html").css('overflow','hidden');
jQuery("html").css('position','relative');
jQuery("html").css('height','100%');
jQuery("html").css('-webkit-overflow-scrolling','touch');
jQuery("body").css('overflow','hidden');
jQuery("body").css('position','relative');
jQuery("body").css('height','100%');
jQuery("body").css('-webkit-overflow-scrolling','touch');
jQuery("#overlaylogin").css('display','block');

});



	//commeents
jQuery(document).on('focusout','#order_comments', function(e){
	jQuery('#loader').show();
	var comments = jQuery('#order_comments').val();
	jQuery.ajax({
		headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
		url: '{{ URL::to("/commentsOrder")}}',
		type: "POST",
		data: '&comments='+comments,
		async: false,
		success: function (res) {
			jQuery('#loader').hide();
		},
	});
});
		//hyperpayresponse
/* var resposne = jQuery('#hyperpayresponse').val();
console.log(resposne);
if(typeof resposne  !== "undefined"){
	if(resposne.trim() =='success'){
		jQuery('#loader').show();
		jQuery("#update_cart_form").submit();
	}else if(resposne.trim() =='error'){
		jQuery.ajax({
			headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
			url: '{{ URL::to("/checkout/payment/changeresponsestatus")}}',
			type: "POST",
			async: false,
			success: function (res) {
			},
		});
		jQuery('#paymentError').css('display','block');
	}
} */

	//shipping_mehtods_form
jQuery(document).on('submit', '#shipping_mehtods_form', function(e){
	jQuery('.error_shipping').hide();
	var checked = jQuery(".shipping_data:checked").length > 0;
	if (!checked){
		jQuery('.error_shipping').show();
		return false;
	}
});

	//shipping_data




	//billling method
jQuery(document).on('click', '#same_billing_address', function(e){
		if(jQuery(this).prop('checked') == true){
			jQuery("#billing_firstname").val(jQuery("#firstname").val());
			jQuery("#billing_lastname").val(jQuery("#lastname").val());
			jQuery("#billing_company").val(jQuery("#company").val());
			jQuery("#billing_street").val(jQuery("#street").val());
			jQuery("#billing_city").val(jQuery("#city").val());
			jQuery("#billing_zip").val(jQuery("#postcode").val());
      jQuery("#billing_phone").val(jQuery("#delivery_phone").val());
			jQuery("#billing_countries_id").val(jQuery("#entry_country_id").val());
			jQuery("#billing_zone_id").val(jQuery("#entry_zone_id").val());

		  jQuery(".same_address").attr('readonly','readonly');
    /* jQuery(".same_address_select").attr('disabled','disabled');  */
			
		}else{
      jQuery(".same_address").removeAttr('readonly');
    jQuery(".same_address_select").removeAttr('disabled');
			
		}
});


//wishlit
$('.wishlist-top-enable').show();
$('.wishlist-top-hidden').hide();
$('.wishlist-new-enable').show();
$('.wishlist-new-hidden').hide();
$('.wishlist-most-enable').show();
$('.wishlist-most-hidden').hide();
$('.wishlist-fea-enable').show();
$('.wishlist-fea-hidden').hide();
$('.wishlist-shop-enable').show();
$('.wishlist-shop-hidden').hide();
$('.wishlist-rel-enable').show();
$('.wishlist-rel-hidden').hide();
jQuery(document).on('click', '.is_liked', function(e){

var products_id = jQuery(this).attr('products_id');
var selector = jQuery(this);
var user_count = jQuery('#wishlist-count').html();
jQuery.ajax({
beforeSend: function (xhr) { // Add this line
    xhr.setRequestHeader('X-CSRF-Token', jQuery('[name="_csrfToken"]').val());
},
  url: '{{ URL::to("/likeMyProduct")}}',
  type: "POST",
  data: {"products_id":products_id,"_token": "{{ csrf_token() }}"},

  success: function (res) {
    var obj = JSON.parse(res);
    var message = obj.message;

    if(obj.success==0){
    }else if(obj.success==2){
      jQuery(selector).children('span').html(obj.total_likes);
	  jQuery('.total_wishlist').html(""+obj.total_wishlist+"");

	  $('#wishlist-top-enable'+products_id).hide();
				$('#wishlist-top-hidden'+products_id).show();
				$('#wishlist-new-enable'+products_id).hide();
				$('#wishlist-new-hidden'+products_id).show();
				$('#wishlist-most-enable'+products_id).hide();
				$('#wishlist-most-hidden'+products_id).show();
				$('#wishlist-fea-enable'+products_id).hide();
				$('#wishlist-fea-hidden'+products_id).show();
				$('#wishlist-shop-enable'+products_id).hide();
				$('#wishlist-shop-hidden'+products_id).show();
	            $('#wishlist-rel-enable'+products_id).hide();
				$('#wishlist-rel-hidden'+products_id).show();
      
    }else if(obj.success==1){
      jQuery(selector).children('span').html(obj.total_likes);
      jQuery('.total_wishlist').html(""+obj.total_wishlist+"");

	  $('#wishlist-top-enable'+products_id).show();
				$('#wishlist-top-hidden'+products_id).hide();
				$('#wishlist-new-enable'+products_id).show();
				$('#wishlist-new-hidden'+products_id).hide();
				$('#wishlist-most-enable'+products_id).show();
				$('#wishlist-most-hidden'+products_id).hide();
				$('#wishlist-fea-enable'+products_id).show();
				$('#wishlist-fea-hidden'+products_id).hide();
				$('#wishlist-shop-enable'+products_id).show();
				$('#wishlist-shop-hidden'+products_id).hide();
                $('#wishlist-rel-enable'+products_id).show();
				$('#wishlist-rel-hidden'+products_id).hide();
    }
    
    notificationWishlist(message);


  },
});
});



jQuery(document).on('click', '.is_liked_molla_1', function(e){

var products_id = jQuery(this).attr('products_id');
var selector = jQuery(this);
var user_count = jQuery('#wishlist-count').html();
jQuery.ajax({
beforeSend: function (xhr) { // Add this line
    xhr.setRequestHeader('X-CSRF-Token', jQuery('[name="_csrfToken"]').val());
},
  url: '{{ URL::to("/likeMyProduct")}}',
  type: "POST",
  data: {"products_id":products_id,"_token": "{{ csrf_token() }}"},

  success: function (res) {
    var obj = JSON.parse(res);
    var message = obj.message;

    if(obj.success==0){
    }else if(obj.success==2){
      jQuery(selector).children('span').html(obj.total_likes);
	  jQuery('.total_wishlist').html(""+obj.total_wishlist+"");

	      $('#wish_molla_show_'+products_id).hide();
				$('#wish_molla_hide_'+products_id).show();

        $('#quick_wish_molla_show_'+products_id).hide();
				$('#quick_wish_molla_hide_'+products_id).show();

        $('#detail_wish_molla_show_'+products_id).hide();
				$('#detail_wish_molla_hide_'+products_id).show();

        $('#detail_sticky_wish_molla_show_'+products_id).hide();
				$('#detail_sticky_wish_molla_hide_'+products_id).show();
      
    }else if(obj.success==1){
      jQuery(selector).children('span').html(obj.total_likes);
      jQuery('.total_wishlist').html(""+obj.total_wishlist+"");

        $('#wish_molla_show_'+products_id).hide();
				$('#wish_molla_hide_'+products_id).show();

        $('#quick_wish_molla_show_'+products_id).hide();
				$('#quick_wish_molla_hide_'+products_id).show();

        $('#detail_wish_molla_show_'+products_id).hide();
				$('#detail_wish_molla_hide_'+products_id).show();

        $('#detail_sticky_wish_molla_show_'+products_id).hide();
				$('#detail_sticky_wish_molla_hide_'+products_id).show();
    }
    
    notificationWishlist(message);


  },
});

});




//sortby
jQuery(document).on('change', '.sortby', function(e){
	jQuery('#loader').show();
	jQuery("#load_products_form").submit();
});

function validd() {
	var max = parseInt(document.detailform.quantity.max);
	var value = parseInt(document.detailform.quantity.value);

  if (value > max || value < 1) {

    jQuery('#alert-exceed').show();
     setTimeout(function() {
       jQuery('#alert-exceed').hide();
     }, 6000);
     document.detailform.quantity.focus();
     return false;
   }else{
		 var formData = jQuery("#add-Product-form").serialize();
	 	var url = jQuery('#checkout_url').val();
	 	var message;
	 	jQuery.ajax({
	 		url: '{{ URL::to("/addToCart")}}',
	 		headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

	 		type: "POST",
	 		data: formData,

	 		success: function (res) {
	 			if(res.trim() == "already added"){
	 				//notification
	 				message = 'Product is added!';
	 			}else{
	 				jQuery('.head-cart-content').html(res);
	 				message = 'Product is added!';
	 				jQuery(parent).addClass('active');
	 			}
	 				if(url.trim()=='true'){
	 					window.location.href = '{{ URL::to("/checkout")}}';
	 				}else{
	 					if(res == 'exceed'){
							swal("Something Happened To Stock", "@lang('website.Ops! Product is available in stock But Not Active For Sale. Please contact to the admin')", "error");
	 					}
	 					else {
							swal("Congrates!", "Product Added Successfully Thanks.Continue Shopping", "success");

	 					}
	 				}
	 		},
	 	});
	 }
}

jQuery(document).on('click', '.add-to-Cart-from-detail', function(e){
	e.preventDefault();
			if(!validd()){ return false;}

});
//update-single-Cart with
jQuery(document).on('click', '.update-single-Cart', function(e){
	jQuery('#loader').show();
	var formData = jQuery("#add-Product-form").serialize();
	var url = jQuery('#checkout_url').val();
	var message;
	jQuery.ajax({
		headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
		url: '{{ URL::to("/updatesinglecart")}}',
		type: "POST",
		data: formData,

		success: function (res) {
			if(res.trim() == "already added"){
				//notification
				message = 'Product is added!';
			}else{
				jQuery('.head-cart-content').html(res);
				message = 'Product is added!';
				jQuery(parent).addClass('active');
			}
				if(url.trim()=='true'){
					window.location.href = '{{ URL::to("/checkout")}}';
				}else{
					jQuery('#loader').css('display','none');
					//window.location.href = '{{ URL::to("/viewcart")}}';
					//message = "@lang('website.Product is added')";
					//notification(message);
				}
				jQuery('#loader').hide();
		},
	});
});

	
	// This button will increment the value




function cart_item_price(){

		var subtotal = 0;
		jQuery(".cart_item_price").each(function() {
			subtotal= parseFloat(subtotal) + parseFloat(jQuery(this).val()) * <?=session('currency_value')?>;
		});
		jQuery('#subtotal').html('<?=Session::get('symbol_left')?>'+subtotal+'<?=Session::get('symbol_right')?>');

		var discount = 0;
		jQuery(".discount_price_hidden").each(function() {
			discount =  parseFloat(discount) - parseFloat(jQuery(this).val());
		});

		jQuery('.discount_price').val(Math.abs(discount));

		jQuery('#discount').html('<?=Session::get('symbol_left')?>'+Math.abs(discount) * <?=session('currency_value')?>+'<?=Session::get('symbol_right')?>');

		//total value
		var total_price = parseFloat(subtotal) - parseFloat(discount) * <?=session('currency_value')?>;
		jQuery('#total_price').html('<?=Session::get('symbol_left')?>'+total_price+'<?=Session::get('symbol_right')?>');
};
	//default_address
jQuery(document).on('click', '.default_address', function(e){
		var address_id = jQuery(this).attr('address_id');
		jQuery.ajax({
			headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
			url: '{{ URL::to("/myDefaultAddress")}}',
			type: "POST",
			data: '&address_id='+address_id,

			success: function (res) {
				 window.location = 'shipping-address?action=default';
			},

		});

});
	//deleteMyAddress
jQuery('.slide-toggle').on('click', function(event){
 jQuery('.color-panel').toggleClass('active');
});

// jQuery( function() {
// 	  var maximum_price = jQuery( ".maximum_price" ).val();
// 	  jQuery( "#slider-range" ).slider({
// 		range: true,
// 		min: 0,
// 		max: maximum_price,
// 		values: [ 0, maximum_price ],
// 		slide: function( event, ui ) {
// 			jQuery('#min_price').val(ui.values[ 0 ] );
// 			jQuery('#max_price').val(ui.values[ 1 ] );

// 			jQuery('#min_price_show').val( ui.values[ 0 ] );
// 			jQuery('#max_price_show').val( ui.values[ 1 ] );
// 		},
// 		create: function(event, ui){
// 			jQuery(this).slider('value',20);
// 		}
// 	   });
// 	   jQuery( "#min_price_show" ).val( jQuery( "#slider-range" ).slider( "values", 0 ) );
// 	   jQuery( "#max_price_show" ).val(jQuery( "#slider-range" ).slider( "values", 1 ) );
// 	   //jQuery( "#slider-range" ).slider( "option", "max", 50 );
// });
//tooltip enable
jQuery(function () {
  jQuery('[data-toggle="tooltip"]').tooltip()
});

function initialize(location){

		@if(!empty($result['commonContent']['setting'][9]->value) or $result['commonContent']['setting'][10]->value)
			var address = '{{$result['commonContent']['setting'][9]->value}}, {{$result['commonContent']['setting'][10]->value}}';
		@else
			var address = '';
		@endif

		var map = new google.maps.Map(document.getElementById('googleMap'), {
			mapTypeId: google.maps.MapTypeId.TERRAIN,
			zoom: 13
		});
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({
			'address': address
		},
		function(results, status) {
			if(status == google.maps.GeocoderStatus.OK) {
			 new google.maps.Marker({
				position: results[0].geometry.location,
				map: map
			 });
			 map.setCenter(results[0].geometry.location);
			}
		});
	   }
	//default product cart

});


//ready doument end

jQuery('.dropdown-menu').on('click', function(event){
	// The event won't be propagated up to the document NODE and
	// therefore delegated events won't be fired
			//event.stopPropagation();
});

	function delete_cart_product(cart_id){
		jQuery('#loader').show();
		var id = cart_id;
		jQuery.ajax({
			headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
			url: '{{ URL::to("/deleteCart")}}',
			type: "GET",
			data: '&id='+id+'&type=header cart',
			success: function (res) {
				// window.location.reload(true);
			},
		});
		jQuery('#loader').hide();
};



function passwordMatch(){

	var password = jQuery('#password').val();
	var re_password = jQuery('#re_password').val();

	if(password == re_password){
		if(password.length >= 8){
			if(/[A-Z]+/.test(password)){
				//alert(password);
				if(password.match(/[0-9]/)){
					return 'matched';
				}else{
				    return 'nuerror';
				}
			}else{
			  return 'cerror';
			}
		}else{
			return 'lerror';
		}
	}else{
		return 'error';
	}
}




'use strict';
function showPreview(objFileInput) {
	if (objFileInput.files[0]) {
		var fileReader = new FileReader();
		fileReader.onload = function (e) {
			jQuery("#uploaded_image").html('<img src="'+e.target.result+'" width="150px" height="150px" class="upload-preview" />');
			jQuery("#uploaded_image").css('opacity','1.0');
			jQuery(".upload-choose-icon").css('opacity','0.8');
		}
		fileReader.readAsDataURL(objFileInput.files[0]);
	}
}

jQuery(document).ready(function() {
  /******************************
      BOTTOM SCROLL TOP BUTTON
   ******************************/
  $('#delivery_phone,#billing_phone').on('input', function() {
		var c = this.selectionStart,
			r = /[^0-9]/gi,
			v = $(this).val();
		if(r.test(v)) {
			$(this).val(v.replace(r, ''));
			c--;
		}
		this.setSelectionRange(c, c);
	});
  // declare variable
  var scrollTop = jQuery(".floating-top");
  var scrollTopheader22 = jQuery(".dropdown-menu-22");
  var scrollTopheader11normal = jQuery(".dropdown-menu-11-normal");
  var scrollTopheader11 = jQuery(".dropdown-menu-11");
  var scrollserachcate = jQuery(".header-39-cateh");
  
  var scrollTopsearchall = jQuery("#viewsearchproduct");

  var tooltipflag = jQuery("#tooltip-flag").val();

  


  jQuery(window).scroll(function() {
    // declare variable
    var topPos = jQuery(this).scrollTop();
	

	if(tooltipflag == 1)
  {
	if (topPos > 10) {
      jQuery('.tooltip').hide();
	  jQuery("#tooltip-flag").val(0);
	 
    }
  }

    // if user scrolls down - show scroll to top button
    if (topPos > 150) {
      jQuery(scrollTop).css("opacity", "1");

    } else {
      jQuery(scrollTop).css("opacity", "0");
    }

	if (topPos > 300) {
	  jQuery(scrollTopheader22).css("display", "none");

    } else {
	  jQuery(scrollTopheader22).css("display", "block");
    }


    // if (topPos > 300) {
	  // jQuery(scrollserachcate).css("display", "none");

    // } else {
	  // jQuery(scrollserachcate).css("display", "block");
    // }

    // if (topPos > 300) {
	  // jQuery(scrollTopheader11normal).css("display", "none");

    // } else {
	  // jQuery(scrollTopheader11normal).css("display", "block");
    // }

    // if (topPos > 300) {
	  // jQuery(scrollTopheader11).css("display", "none");

    // } else {
	  // jQuery(scrollTopheader11).css("display", "block");
    // }

	if (topPos > 250) {
	  jQuery(scrollTopsearchall).css("display", "none");

    } else {
	  jQuery(scrollTopsearchall).css("display", "block");
    }

});

// jQuery('body').click(function() {
// 	jQuery(".search_outer_con").css("display", "none");
// });


  //Click event to scroll to top
jQuery(scrollTop).click(function() {
    jQuery('html, body').animate({
      scrollTop: 0
    }, 800);
    return false;

  });
});

jQuery('body').on('mouseenter mouseleave','.dropdown.open',function(e){
  var _d=jQuery(e.target).closest('.dropdown');
  _d.addClass('show');
  setTimeout(function(){
    _d[_d.is(':hover')?'addClass':'removeClass']('show');

  },300);
  jQuery('.dropdown-menu', _d).attr('aria-expanded',_d.is(':hover'));
});

jQuery('.nav-index').on('show.bs.tab', function (e) {
	  e.target // newly activated tab
	  e.relatedTarget // previous active tab
	  jQuery('.overlay').show();
})

jQuery('.nav-index').on('hidden.bs.tab', function (e) {
	  e.target // newly activated tab
	  e.relatedTarget // previous active tab
	  jQuery('.overlay').hide();
})

function cancelOrder() {
	if (confirm("@lang('website.Are you sure you want to cancel this order?')")) {
		return true;
	} else {
		return false;
	}
}

function returnOrder() {
	if (confirm("@lang('website.Are you sure you want to return this order?')")) {
		return true;
	} else {
		return false;
	}
}



	@if(!empty($result['detail']['product_data'][0]->products_type) and $result['detail']['product_data'][0]->products_type==1)
		getQuantity();
    gettotalval();
		cartPrice();
	@endif

function cartPrice(){
	var i = 0;
	jQuery(".currentstock").each(function() {
		var value_price = jQuery('option:selected', this).attr('value_price');
		var attributes_value = jQuery('option:selected', this).attr('attributes_value');
		var prefix = jQuery('option:selected', this).attr('prefix');
		jQuery('#attributeid_' + i).val(value_price);
		jQuery('#attribute_sign_' + i++).val(prefix);

	});
}

function gettotalval()
{


  var radioSum = 0;
  var checkSum = 0;
  var total_price = $('#total_org_price_new').val();
  var qty = $('.detail-8-iput-btn').val();

  $('.check_get.active').each(function() {
    var value = parseFloat($(this).val());
    var prefix = $(this).attr('prefix');

    if (prefix === '+') {
      checkSum += value;
    } else if (prefix === '-') {
      checkSum -= value;
    }
  });


  $('.radio_get.active').each(function() {
    var value = parseFloat($(this).val());
    var prefix = $(this).attr('prefix');

    if (prefix === '+') {
      radioSum += value;
    } else if (prefix === '-') {
      radioSum -= value;
    }
});



//$('#total_dis_price').html(final_price.toFixed(2));

var activeOptionName = $('.option_name.active').map(function() {
  return $(this).val();
}).get();


var activeOptionID = $('.option_id.active').map(function() {
  return $(this).val();
}).get();

var activeAttributesID = $('.attributes_id.active').map(function() {
  return $(this).val();
}).get();

var activeFunctionID = $('.function_id.active').map(function() {
  return $(this).val();
}).get();

$('.option_name_new').val(activeOptionName);
$('.option_id_new').val(activeOptionID);
$('.attributes_id_new').val(activeAttributesID);
$('.function_id_new').val(activeFunctionID);

jQuery('.stock-cart').attr('hidden', true);

var attributeid = $('.attributes_id_new').val().split(","); 

var products_id = $('.products_id_new').val();
    var data = {
      products_id: products_id,
      attributeid: attributeid,
    };

var formData = jQuery('#add-Product-form').serialize();
	jQuery.ajax({
		headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
		url: '{{ URL::to("getquantity")}}',
		type: "POST",
		data: data,
		dataType: "json",
		success: function (res) {
   
			
			var products_price = jQuery('#products_price').val();
			
			var products_qty = jQuery('.qty').val();
			var final_pri = products_price * products_qty;

      var max_stock = jQuery('#max_stock_one').val();

      if(res.remainingStock > max_stock && max_stock !=0)
      {
        $(".type_one").attr({
       "max" : max_stock,        // substitute your own
    });
      }
      else
      {
      $(".type_one").attr({
       "max" : res.remainingStock,        // substitute your own
    });
  }


  if(res.is_special == 'yes')
      {
        var special_price = parseFloat(res.special_price) * parseFloat(products_qty)  * parseFloat(<?=session('currency_value')?>); 
        var orginal_price = parseFloat(res.orginal_price) * parseFloat(products_qty)  * parseFloat(<?=session('currency_value')?>); 
       
      jQuery('#total_dis_price').html('<?=Session::get('symbol_left')?> ' +special_price.toFixed(2)+ ' <?=Session::get('symbol_right')?>');

      jQuery('#total_org_price').html('<?=Session::get('symbol_left')?> ' +orginal_price.toFixed(2)+ ' <?=Session::get('symbol_right')?>');
      jQuery('#products_price').val(special_price.toFixed(2));
      jQuery('#dis_special').html(res.discount+'%');
      jQuery('#special_discount').val(res.is_special);
      jQuery('#special_price').val(special_price.toFixed(2));
      jQuery('#org_price').val(orginal_price.toFixed(2));
      }
      else
      {
        
        var cqty = jQuery('.qty').val();
        if(cqty == null) {
          var qty = '1';
        }else{
          var qty = jQuery('.qty').val();
        }
    var products_price = jQuery('#products_price').val();

    var numericString = total_price.replace(/[^0-9.-]+/g, ''); // Remove non-numeric characters
   // var total_price = parseFloat(qty) * parseFloat(products_price) * <?=session('currency_value')?>;
    var final_price = (parseFloat(numericString) + parseFloat(checkSum) + parseFloat(radioSum)) * qty * <?=session('currency_value')?>;

jQuery('#total_dis_price').html('<?=Session::get('symbol_left')?> ' +final_price.toFixed(2)+ ' <?=Session::get('symbol_right')?>');
    
     jQuery('.get_att_amount').html('<?=Session::get('symbol_left')?>'+final_price.toFixed(2)+'<?=Session::get('symbol_right')?>');
      }
      if(<?php echo $result['commonContent']['settings']['stock_availability']; ?>  == 1)
      {
       
        jQuery('#variable-count').html(res.remainingStock);
      }
      else
      {
        if(res.remainingStock>0){
          jQuery('#variable-status').html('In stock');
        }
        else
        {
          jQuery('#variable-status').html('Out of stock');
        }
      }
    
			if(res.remainingStock>0){
				jQuery('.stock-cart').removeAttr('hidden');
				jQuery('.stock-out-cart').attr('hidden',true);
				var max_order = jQuery('#max_order').val();
     
				if(max_order.trim()!=0){
					if(max_order.trim()>=res.remainingStock){
						//jQuery('.qty').attr('max',res.remainingStock);
					}else{
						//jQuery('.qty').attr('max',max_order);
					}
				}else{
					//jQuery('.qty').attr('max',res.remainingStock);
				}

        		jQuery('.variable-stock').text("@lang('website.In stock')");
			}else if (1=={{$result['commonContent']['settings']['Inventory']}}){
				jQuery('.stock-out-cart').removeAttr('hidden');
				jQuery('.stock-cart').attr('hidden',true);
				
        		jQuery('.variable-stock').text("@lang('website.Out of Stock')");
				
			} else {
				jQuery('.variable-stock').text("@lang('website.In stock')");
			}

		},
	});






/* console.log(checkSum);
console.log(radioSum);
console.log(total_price);
console.log(qty);
console.log(final_price);  */

}


//ajax call for add option value
//  function getQuantity(){

//   jQuery('.qty').val(1);
// 	var attributeid = [];
// 	var i = 0;
	
// 	jQuery('.stock-cart').attr('hidden', true);
//   var value_price = '';
//     var attributes_value = '';
//   jQuery(".currentstock").each(function() {
// 		// var value_price = jQuery('option:selected', this).attr('value_price');
// 		// var attributes_value = jQuery('option:selected', this).attr('attributes_value');

//     var value_price1 = jQuery('input:radio:checked').attr('value_price');
//     var value_price2 = jQuery('input:checkbox:checked').attr('value_price');

//     if (value_price1 !== 0) {
//       var value_price = value_price1;
//     }  else {
//       var value_price = 0;
//     }

//     if (value_price2 !== 0) {
//       var value_price = value_price2;
//     } else {
//       var value_price = 0;
//     }
    
//     console.log(value_price);
//     //   return $(this).attr('value_price');
//     // }).get();

//     var array1 = jQuery('input:checkbox:checked').map( function () {
//       return $(this).attr('attributes_value');
//     }).get();

//     var array2 = jQuery('input:radio:checked').map( function () {
//       return $(this).attr('attributes_value');
//     }).get();


//     var mergedArray = array1.concat(array2);
//     var attributes_value = mergedArray.join(',');

// 		jQuery('#function_' + i).val(value_price);
// 		jQuery('#attributeids_' + i++).val(attributes_value);
// 	});


// 	var formData = jQuery('#add-Product-form').serialize();
// 	jQuery.ajax({
// 		headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
// 		url: '{{ URL::to("getquantity")}}',
// 		type: "POST",
// 		data: formData,
// 		dataType: "json",
// 		success: function (res) {
   
			
// 			var products_price = jQuery('#products_price').val();
			
// 			var products_qty = jQuery('.qty').val();
// 			var final_pri = products_price * products_qty;

//       var max_stock = jQuery('#max_stock_one').val();

//       if(res.remainingStock > max_stock && max_stock !=0)
//       {
//         $(".type_one").attr({
//        "max" : max_stock,        // substitute your own
//     });
//       }
//       else
//       {
//       $(".type_one").attr({
//        "max" : res.remainingStock,        // substitute your own
//     });
//   }


//   if(res.is_special == 'yes')
//       {
//         var special_price = parseFloat(res.special_price) * parseFloat(products_qty)  * parseFloat(<?=session('currency_value')?>); 
//         var orginal_price = parseFloat(res.orginal_price) * parseFloat(products_qty)  * parseFloat(<?=session('currency_value')?>); 
       
//       jQuery('#total_dis_price').html('<?=Session::get('symbol_left')?> ' +special_price.toFixed(2)+ ' <?=Session::get('symbol_right')?>');

//       jQuery('#total_org_price').html('<?=Session::get('symbol_left')?> ' +orginal_price.toFixed(2)+ ' <?=Session::get('symbol_right')?>');
//       jQuery('#products_price').val(special_price.toFixed(2));
//       jQuery('#dis_special').html(res.discount+'%');
//       jQuery('#special_discount').val(res.is_special);
//       jQuery('#special_price').val(special_price.toFixed(2));
//       jQuery('#org_price').val(orginal_price.toFixed(2));
//       }
//       else
//       {
        
//         var cqty = jQuery('.qty').val();
//         if(cqty == null) {
//           var qty = '1';
//         }else{
//           var qty = jQuery('.qty').val();
//         }
//     var products_price = jQuery('#products_price').val();
//     var total_price = parseFloat(qty) * parseFloat(products_price) * <?=session('currency_value')?>;
//     jQuery('.total_price').html('<?=Session::get('symbol_left')?>'+total_price.toFixed(2)+'<?=Session::get('symbol_right')?>');
//      jQuery('.get_att_amount').html('<?=Session::get('symbol_left')?>'+total_price.toFixed(2)+'<?=Session::get('symbol_right')?>');
//       }
//       if(<?php echo $result['commonContent']['settings']['stock_availability']; ?>  == 1)
//       {
       
//         jQuery('#variable-count').html(res.remainingStock);
//       }
//       else
//       {
//         if(res.remainingStock>0){
//           jQuery('#variable-status').html('In stock');
//         }
//         else
//         {
//           jQuery('#variable-status').html('Out of stock');
//         }
//       }
    
// 			if(res.remainingStock>0){
// 				jQuery('.stock-cart').removeAttr('hidden');
// 				jQuery('.stock-out-cart').attr('hidden',true);
// 				var max_order = jQuery('#max_order').val();
     
// 				if(max_order.trim()!=0){
// 					if(max_order.trim()>=res.remainingStock){
// 						//jQuery('.qty').attr('max',res.remainingStock);
// 					}else{
// 						//jQuery('.qty').attr('max',max_order);
// 					}
// 				}else{
// 					//jQuery('.qty').attr('max',res.remainingStock);
// 				}

//         		jQuery('.variable-stock').text("@lang('website.In stock')");
// 			}else if (1=={{$result['commonContent']['settings']['Inventory']}}){
// 				jQuery('.stock-out-cart').removeAttr('hidden');
// 				jQuery('.stock-cart').attr('hidden',true);
				
//         		jQuery('.variable-stock').text("@lang('website.Out of Stock')");
				
// 			} else {
// 				jQuery('.variable-stock').text("@lang('website.In stock')");
// 			}

// 		},
// 	});
// } 

// multiple
/* function getQuantity(){
	var attributeid = [];
	var value_price = [];
	var attributes_value = [];
	var i = 0;

  var sum = 0;


	
	jQuery('.stock-cart').attr('hidden', true);

  var totalValuePrice = 0;
  

   jQuery(".currentstock").each(function() {
    $(this).find("option:selected").each(function() {
      var valuePrice = $(this).attr('value_price');
      totalValuePrice = valuePrice;
    });
		attributes_value = jQuery(this).val();
		jQuery('#function_' + i).val(totalValuePrice);
		jQuery('#attributeids_' + i++).val(attributes_value);
   
	}); 



	var formData = jQuery('#add-Product-form').serialize();
	jQuery.ajax({
		headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
		url: '{{ URL::to("getquantity")}}',
		type: "POST",
		data: formData,
		dataType: "json",
		success: function (res) {
   
			
			var products_price = jQuery('#products_price').val();
			
			var products_qty = jQuery('.qty').val();
			var final_pri = products_price * products_qty;

      var max_stock = jQuery('#max_stock_one').val();

      if(res.remainingStock > max_stock && max_stock !=0)
      {
        $(".type_one").attr({
       "max" : max_stock,        // substitute your own
    });
      }
      else
      {
      $(".type_one").attr({
       "max" : res.remainingStock,        // substitute your own
    });
  }


  if(res.is_special == 'yes')
      {
        var special_price = parseFloat(res.special_price) * parseFloat(products_qty)  * parseFloat(<?=session('currency_value')?>); 
        var orginal_price = parseFloat(res.orginal_price) * parseFloat(products_qty)  * parseFloat(<?=session('currency_value')?>); 
       
      jQuery('#total_dis_price').html('<?=Session::get('symbol_left')?> ' +special_price.toFixed(2)+ ' <?=Session::get('symbol_right')?>');

      jQuery('#total_org_price').html('<?=Session::get('symbol_left')?> ' +orginal_price.toFixed(2)+ ' <?=Session::get('symbol_right')?>');
      jQuery('#products_price').val(special_price.toFixed(2));
      jQuery('#dis_special').html(res.discount+'%');
      jQuery('#special_discount').val(res.is_special);
      jQuery('#special_price').val(special_price.toFixed(2));
      jQuery('#org_price').val(orginal_price.toFixed(2));
      }
      else
      {
        
        var cqty = jQuery('.qty').val();
        if(cqty == null) {
          var qty = '1';
        }else{
          var qty = jQuery('.qty').val();
        }
    var products_price = jQuery('#products_price').val();

    
    var total_price = parseFloat(qty) * parseFloat(products_price) * <?=session('currency_value')?>;
    jQuery('.total_price').html('<?=Session::get('symbol_left')?>'+total_price.toFixed(2)+'<?=Session::get('symbol_right')?>');
     jQuery('.get_att_amount').html('<?=Session::get('symbol_left')?>'+total_price.toFixed(2)+'<?=Session::get('symbol_right')?>');
      }
      if(<?php echo $result['commonContent']['settings']['stock_availability']; ?>  == 1)
      {
       
        jQuery('#variable-count').html(res.remainingStock);
      }
      else
      {
        if(res.remainingStock>0){
          jQuery('#variable-status').html('In stock');
        }
        else
        {
          jQuery('#variable-status').html('Out of stock');
        }
      }
    
			if(res.remainingStock>0){
				jQuery('.stock-cart').removeAttr('hidden');
				jQuery('.stock-out-cart').attr('hidden',true);
				var max_order = jQuery('#max_order').val();
     
				if(max_order.trim()!=0){
					if(max_order.trim()>=res.remainingStock){
						//jQuery('.qty').attr('max',res.remainingStock);
					}else{
						//jQuery('.qty').attr('max',max_order);
					}
				}else{
					//jQuery('.qty').attr('max',res.remainingStock);
				}

        		jQuery('.variable-stock').text("@lang('website.In stock')");
			}else if (1=={{$result['commonContent']['settings']['Inventory']}}){
				jQuery('.stock-out-cart').removeAttr('hidden');
				jQuery('.stock-cart').attr('hidden',true);
				
        		jQuery('.variable-stock').text("@lang('website.Out of Stock')");
				
			} else {
				jQuery('.variable-stock').text("@lang('website.In stock')");
			}

		},
	});
}
 */


jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.categories-carousel-js');
	var mobile_count = '';

	if({{$result['commonContent']['settings']['product_column']}} == 1)
	{
		mobile_count = 1;
	}
	else
	{
		mobile_count = 2;
	}

  var desktop_count = '';
  var tab_count = '';

	if({{$result['commonContent']['settings']['desktop_product_column']}} == 3)
	{
		desktop_count = 3;
    tab_count = 3;
	}
	else if({{$result['commonContent']['settings']['desktop_product_column']}} == 4)
	{
		desktop_count = 4;
    tab_count = 4;
	}else if({{$result['commonContent']['settings']['desktop_product_column']}} == 5)
  {
    desktop_count = 5;
    tab_count = 4;
  }


    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this),
            item = jQuery(this).data('item'),
            itemmobile = jQuery(this).data('itemmobile');
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: true,
          infinite: false,
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow: item || desktop_count,
          slidesToScroll: item || desktop_count,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: tab_count,
              slidesToScroll: tab_count
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3
            }
          }, {
            breakpoint: 768,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
            }
            },{
            breakpoint: 600,
            settings: {
              slidesToShow: mobile_count,
              slidesToScroll: mobile_count,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


  (function (jQuery) {
    var tabCarousel = jQuery('.categories-carousel-js-top2');
	var mobile_count = '';

	if({{$result['commonContent']['settings']['product_column']}} == 1)
	{
		mobile_count = 1;
	}
	else
	{
		mobile_count = 2;
	}

  var desktop_count = '';
  var tab_count = '';

	if({{$result['commonContent']['settings']['desktop_product_column']}} == 3)
	{
		desktop_count = 3;
    tab_count = 3;
	}
	else if({{$result['commonContent']['settings']['desktop_product_column']}} == 4)
	{
		desktop_count = 4;
    tab_count = 4;
	}else if({{$result['commonContent']['settings']['desktop_product_column']}} == 5)
  {
    desktop_count = 5;
    tab_count = 4;
  }


    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this),
            item = jQuery(this).data('item'),
            itemmobile = jQuery(this).data('itemmobile');
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: true,
          infinite: false,
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow: item || desktop_count,
          slidesToScroll: item || desktop_count,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: tab_count,
              slidesToScroll: tab_count
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3
            }
          }, {
            breakpoint: 768,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
            }
            },{
            breakpoint: 600,
            settings: {
              slidesToShow: mobile_count,
              slidesToScroll: mobile_count,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);



  (function (jQuery) {
  var tabCarousel = jQuery('.brand-carousel-js');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: false,
          infinite: false,
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  7,
          slidesToScroll:  7,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 6,
              slidesToScroll: 6,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }]
        });
      });
    }

    ;
  })(jQuery);

  (function (jQuery) {
  var tabCarousel = jQuery('.brand-carousel-js-3');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: false,
          infinite: false,
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  6,
          slidesToScroll:  6,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 5,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


  (function (jQuery) {
  var tabCarousel = jQuery('.brand-carousel-js-5');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          //arrows: true,
          infinite: false,

		  prevArrow: '<div class="slider-arrow slider-prev fa fa-angle-left"></div>',
    	  nextArrow: '<div class="slider-arrow slider-next fa fa-angle-right"></div>',

          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  6,
          slidesToScroll:  6,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 5,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
			  dots: true
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
			  dots: true
            }
          }]
        });
      });
    }

    ;
  })(jQuery);




  (function (jQuery) {
  var tabCarousel = jQuery('.brand-carousel-js-7');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          //arrows: true,
          infinite: false,

		  prevArrow: '<div class="slider-7-arrow slider-7-prev fa fa-angle-left"></div>',
    	  nextArrow: '<div class="slider-7-arrow slider-7-next fa fa-angle-right"></div>',

          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  6,
          slidesToScroll:  6,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 5,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
			  dots: false
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
			  dots: false
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


  (function (jQuery) {
  var tabCarousel = jQuery('.brand-carousel-js-8');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          //arrows: true,
          infinite: false,

		  prevArrow: '<div class="slider-arrow slider-prev fa fa-angle-left"></div>',
    	  nextArrow: '<div class="slider-arrow slider-next fa fa-angle-right"></div>',

          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  6,
          slidesToScroll:  6,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 5,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
			  dots: false
            }
          }]
        });
      });
    }

    ;
  })(jQuery);




  (function (jQuery) {
  var tabCarousel = jQuery('.brand-carousel-js-6');
	
    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: false,
          infinite: false,
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  7,
          slidesToScroll:  7,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 5
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


  (function (jQuery) {
  var tabCarousel = jQuery('.brand-carousel-js-10');
	
    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: true,
          arrows: false,
          infinite: false,
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  6,
          slidesToScroll:  6,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 5
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


  (function (jQuery) {
  var tabCarousel = jQuery('.brand-carousel-js-9');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: false,
          infinite: false,
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  6,
          slidesToScroll:  6,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 5,
			  dots: true
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
			  dots: true
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
			  dots: true
            }
          }]
        });
      });
    }

    ;
  })(jQuery);



  (function (jQuery) {
  var tabCarousel = jQuery('.flash-carousel-js-1');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: false,
          infinite: false,

		//   prevArrow: '<div class="slider-arrow slider-prev fa fa-angle-left"></div>',
    	//   nextArrow: '<div class="slider-arrow slider-next fa fa-angle-right"></div>',

          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  1.5,
          slidesToScroll:  1.5,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 1.5,
              slidesToScroll: 1.5,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);



  (function (jQuery) {
  var tabCarousel = jQuery('.flash-carousel-js-4');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: false,
          infinite: false,

		//   prevArrow: '<div class="slider-arrow slider-prev fa fa-angle-left"></div>',
    	//   nextArrow: '<div class="slider-arrow slider-next fa fa-angle-right"></div>',

          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  2,
          slidesToScroll:  2,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


  (function (jQuery) {
  var tabCarousel = jQuery('.flash-carousel-js-5');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          //arrows: true,
          infinite: false,

		//   prevArrow: '<div class="slider-arrow slider-prev fa fa-angle-left"></div>',
    	//   nextArrow: '<div class="slider-arrow slider-next fa fa-angle-right"></div>',

          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  5,
          slidesToScroll:  5,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


 
  (function (jQuery) {
    var tabCarousel = jQuery('.cat1-carousel-js');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this),
            item = jQuery(this).data('item'),
            itemmobile = jQuery(this).data('itemmobile');
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: true,
          infinite: false,
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow: item || {{$result['commonContent']['settings']['home_categories_records']}},
          slidesToScroll: item || {{$result['commonContent']['settings']['home_categories_records']}},
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
			
            settings: {
              slidesToShow: 5,
              slidesToScroll: 5
            }
          }, {
            breakpoint: 992,
            settings: {
				
              slidesToShow: 4,
              slidesToScroll: 4
            }
          }, {
            breakpoint: 768,
			
            settings: {
              slidesToShow: itemmobile || {{$result['commonContent']['settings']['home_categories_records_mobile']}},
              slidesToScroll: itemmobile || {{$result['commonContent']['settings']['home_categories_records_mobile']}}
			  
            }
          }]
        });
      });
    }

    ;
  })(jQuery);
}); 







jQuery( document ).ready(function() {
    (function(jQuery){
        var tabCarousel = jQuery('.cat1-carousel-js');
            if (tabCarousel.length) {
                
                tabCarousel.each(function(){
                    var thisCarousel = jQuery(this),
                        item =  jQuery(this).data('item'),
                        itemmobile =  jQuery(this).data('itemmobile');
                        
                            
                    
                    thisCarousel.slick({
                        lazyLoad: 'progressive',
                        dots: false,
                        arrows: true,
                        infinite: true,
                        //rtl:true,
                        speed: 300,
                        slidesToShow: item || 8,
                        slidesToScroll: item || 4,
                        adaptiveHeight: true,
                            responsive: [{
                                breakpoint: 1025,
                                settings: {
                                    slidesToShow: 6,
                                    slidesToScroll: 6
                                }
                            },
                            {
                                breakpoint: 791,
                                settings: {
                                    slidesToShow: 4,
                                    slidesToScroll: 4
                                }
                            },
                        {
                            breakpoint: 650,
                            settings: {
                                slidesToShow: itemmobile || 4,
                                slidesToScroll: itemmobile || 4
                            }
                        },
                        {
                            breakpoint: 430,
                            settings: {
                                slidesToShow: itemmobile || 4,
                                slidesToScroll: itemmobile || 4
                            }
                        }
                    ]
                    });
                });
            };
            
        })(jQuery);
});

(function (jQuery) {
    var tabCarousel = jQuery('.cat1-carousel-js-mobile');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this),
            item = jQuery(this).data('item'),
            itemmobile = jQuery(this).data('itemmobile');
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: true,
          infinite: false,
		  rows: 2,
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow: item || {{$result['commonContent']['settings']['home_categories_records']}},
          slidesToScroll: item || {{$result['commonContent']['settings']['home_categories_records']}},
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
			
            settings: {
              slidesToShow: 5,
              slidesToScroll: 5
            }
          }, {
            breakpoint: 992,
            settings: {
				
              slidesToShow: 4,
              slidesToScroll: 4
            }
          }, {
            breakpoint: 768,
			
            settings: {
              slidesToShow: itemmobile || {{$result['commonContent']['settings']['home_categories_records_mobile']}},
              slidesToScroll: itemmobile || {{$result['commonContent']['settings']['home_categories_records_mobile']}}
			  
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


  (function (jQuery) {
    var tabCarousel = jQuery('.cat2-carousel-js');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this),
            item = jQuery(this).data('item'),
            itemmobile = jQuery(this).data('itemmobile');
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: true,
          infinite: false,
		  rows: 2,
         prevArrow: '<div class="slider-arrow slider-prev fa fa-angle-left"></div>',
    	   nextArrow: '<div class="slider-arrow slider-next fa fa-angle-right"></div>',
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow: item || {{$result['commonContent']['settings']['home_categories_records']}},
          slidesToScroll: item || {{$result['commonContent']['settings']['home_categories_records']}},
          adaptiveHeight: false,
          responsive: [{
            breakpoint: 1025,
			
            settings: {
              slidesToShow: item || {{$result['commonContent']['settings']['home_categories_records']}},
              slidesToScroll: item || {{$result['commonContent']['settings']['home_categories_records']}}
            }
          }, {
            breakpoint: 992,
            settings: {
				
              slidesToShow: itemmobile || {{$result['commonContent']['settings']['home_categories_records_mobile']}},
              slidesToScroll: itemmobile || {{$result['commonContent']['settings']['home_categories_records_mobile']}}
            }
          }, {
            breakpoint: 768,
			
            settings: {
              slidesToShow: itemmobile || {{$result['commonContent']['settings']['home_categories_records_mobile']}},
              slidesToScroll: itemmobile || {{$result['commonContent']['settings']['home_categories_records_mobile']}}
			  
            }
          }]
        });
      });
    }

    ;
  })(jQuery);



function getvo_code(code)
{
	var result=code;
	document.getElementById("coupon_code").value= result;
	$('#myModalcoupon').modal('hide');
}

   var path = "{{ URL::to("autocomplete")}}";
   var imagep ="{{asset('')}}";
   var product_url = "{{ URL::to('/product-detail/')}}";
  

  $(document).ready(function(){
  $(".typeheads").keyup(function(){

    var search = $(".typeheads").val();
    var cat = $(".category-value").val();
    $('.btn-close-search-40').show();
    $("#search-width-hide").removeClass("search-field-module-width-show");
    $("#search-width-hide").addClass("search-field-module-width-hide");
	var pro = "{{ URL::to('/shop?category=&search')}}";
  
	
    if(search != "")
    {
		var content ='';
      jQuery.ajax({
    		 url: '{{ URL::to("/autocomplete")}}',
    		 headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
    		 type: "GET",
    		  data: 'search='+search+'&cat='+cat,
			  dataType: 'JSON',
    		  success: function (data) { 
				if(data !="")
					{
				$.each(data, function(index, item) 
				{
					content += '<a href="'+pro+'='+item.name+'"><div class="searchdropdown">';
					content += '<div class="row">';
					content += '<div class="col-3 col-md-3">';
					if(item.image_path_type == 'aws')
          {
            content += '<img style="object-fit:contain" src="'+item.img+'"/ height="45px;" width="45px;">';
          }
          else
          {
            content += '<img style="object-fit:contain" src="'+imagep+item.img+'"/ height="45px;" width="45px;">';
          }
					content += '</div>';
					content += '<div class="col-9 col-md-9">';
					content += '<span style="white-space: normal;">'+item.name+'</span>';
					content += '</div>';
					content += '</div>';
					content += '</div></a>';
				
				});
			  }
			  else
			  {
				content += '<div class="row">';
				content += '<div class="col-12"><p style="text-align: center;padding: 10px;margin: 0;">No Product Available</p>';
				content += '</div>';
				content += '</div>';
			  }

				jQuery('.search_outer_con').addClass('enable_search');
				$('#viewsearchproduct').html(content);
			
    	       
        },
    	});

    }
	else
	{
		jQuery('.search_outer_con').removeClass('enable_search');
    $('.btn-close-search-40').hide();
    $("#search-width-hide").addClass("search-field-module-width-show");
    $("#search-width-hide").removeClass("search-field-module-width-hide");
	}
   
  
  });
});



$(document).ready(function(){
  $(".typeheads_tab").keyup(function(){

    var search = $(".typeheads_tab").val();
    var cat = $(".category-value-tab").val();
	var pro = "{{ URL::to('/shop?category=&search')}}";
  
	
    if(search != "")
    {
		var content ='';
      jQuery.ajax({
    		 url: '{{ URL::to("/autocomplete")}}',
    		 headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
    		 type: "GET",
    		  data: 'search='+search+'&cat='+cat,
			  dataType: 'JSON',
    		  success: function (data) { 
				if(data !="")
					{
				$.each(data, function(index, item) 
				{
					content += '<a href="'+pro+'='+item.name+'"><div class="searchdropdown">';
					content += '<div class="row">';
					content += '<div class="col-3 col-md-3">';
					if(item.image_path_type == 'aws')
          {
            content += '<img style="object-fit:contain" src="'+item.img+'"/ height="45px;" width="45px;">';
          }
          else
          {
            content += '<img style="object-fit:contain" src="'+imagep+item.img+'"/ height="45px;" width="45px;">';
          }
					content += '</div>';
					content += '<div class="col-9 col-md-9">';
					content += '<span style="white-space: normal;">'+item.name+'</span>';
					content += '</div>';
					content += '</div>';
					content += '</div></a>';
				
				});
			  }
			  else
			  {
				content += '<div class="row">';
				content += '<div class="col-12"><p style="text-align: center;padding: 10px;margin: 0;">No Product Available</p>';
				content += '</div>';
				content += '</div>';
			  }

				jQuery('.search_outer_con_tab').addClass('enable_search');
				$('#viewsearchproduct_tab').html(content);
			
    	       
        },
    	});

    }
	else
	{
		jQuery('.search_outer_con_tab').removeClass('enable_search');
	}
   
  
  });
});



$(document).ready(function(){
  $(".typeheads_tab_fixed").keyup(function(){

    var search = $(".typeheads_tab_fixed").val();
    var cat = $(".category-value-tab-fixed").val();
	var pro = "{{ URL::to('/shop?category=&search')}}";
  
	
    if(search != "")
    {
		var content ='';
      jQuery.ajax({
    		 url: '{{ URL::to("/autocomplete")}}',
    		 headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
    		 type: "GET",
    		  data: 'search='+search+'&cat='+cat,
			  dataType: 'JSON',
    		  success: function (data) { 
				if(data !="")
					{
				$.each(data, function(index, item) 
				{
					content += '<a href="'+pro+'='+item.name+'"><div class="searchdropdown">';
					content += '<div class="row">';
					content += '<div class="col-3 col-md-3">';
					if(item.image_path_type == 'aws')
          {
            content += '<img style="object-fit:contain" src="'+item.img+'"/ height="45px;" width="45px;">';
          }
          else
          {
            content += '<img style="object-fit:contain" src="'+imagep+item.img+'"/ height="45px;" width="45px;">';
          }
					content += '</div>';
					content += '<div class="col-9 col-md-9">';
					content += '<span style="white-space: normal;">'+item.name+'</span>';
					content += '</div>';
					content += '</div>';
					content += '</div></a>';
				
				});
			  }
			  else
			  {
				content += '<div class="row">';
				content += '<div class="col-12"><p style="text-align: center;padding: 10px;margin: 0;">No Product Available</p>';
				content += '</div>';
				content += '</div>';
			  }

				jQuery('.search_outer_con_tab_fixed').addClass('enable_search');
				$('#viewsearchproduct_tab_fixed').html(content);
			
    	       
        },
    	});

    }
	else
	{
		jQuery('.search_outer_con_tab_fixed').removeClass('enable_search');
   
	}
   
  
  });
});


function unsubscribehide(id) {
  jQuery.ajax({
      url: '{{ URL::to("/unsubscribehide")}}',
      headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
      type: "POST",
      data: 'user_id='+id,
        success: function (res) { 
        
			window.location.reload();
    },
    });
} 


$(document).ready(function(){
  $(".typeheads_mobile").keyup(function(){

    var search = $(".typeheads_mobile").val();
	var cat = $(".category_mobile_slug").val();
	var pro = "{{ URL::to('/shop?category=&search')}}";
  $('.btn-close-search-mobile').show();

    if(search != "")
    {
		var content ='';
      jQuery.ajax({
    		 url: '{{ URL::to("/autocomplete")}}',
    		 headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
    		 type: "GET",
			 data: 'search='+search+'&cat='+cat,
			  dataType: 'JSON',
    		  success: function (data) { 
				if(data !="")
					{
				$.each(data, function(index, item) 
				{
					content += '<a href="'+pro+'='+item.name+'"><div class="searchdropdown">';
					content += '<div class="row">';
					content += '<div class="col-4 col-md-4">';
          if(item.image_path_type == 'aws')
          {
            content += '<img src="'+item.img+'"/ height="44px;" width="65px;">';
          }
          else
          {
            content += '<img src="'+imagep+item.img+'"/ height="44px;" width="65px;">';
          }
					content += '</div>';
					content += '<div class="col-8 col-md-8">';
					content += '<span style="white-space: normal;">'+item.name+'</span>';
					content += '</div>';
					content += '</div>';
					content += '</div></a>';
				
				});
			  }
			  else
			  {
				content += '<div class="row">';
				content += '<div class="col-12"><p style="text-align: center;padding: 10px;margin: 0;">No Product Available</p>';
				content += '</div>';
				content += '</div>';
			  }

				jQuery('.search_outer_con_mobile').addClass('enable_search');
				$('#viewsearchproduct_mobile').html(content);
       
				
    	       
        },
    	});

    }
	else
	{
		jQuery('.search_outer_con_mobile').removeClass('enable_search');
    $('.btn-close-search-mobile').hide();
	}
   
  
  });
});

$(document).ready(function(){
  $(".typeheads_mobile_fixed_40").keyup(function(){

    var search = $(".typeheads_mobile_fixed_40").val();
	var cat = $(".category_mobile_slug").val();
	var pro = "{{ URL::to('/shop?category=&search')}}";
 

    if(search != "")
    {
		var content ='';
      jQuery.ajax({
    		 url: '{{ URL::to("/autocomplete")}}',
    		 headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
    		 type: "GET",
			 data: 'search='+search+'&cat='+cat,
			  dataType: 'JSON',
    		  success: function (data) { 
				if(data !="")
					{
				$.each(data, function(index, item) 
				{
					content += '<a href="'+pro+'='+item.name+'"><div class="searchdropdown">';
					content += '<div class="row">';
					content += '<div class="col-4 col-md-4">';
          if(item.image_path_type == 'aws')
          {
            content += '<img src="'+item.img+'"/ height="44px;" width="65px;">';
          }
          else
          {
            content += '<img src="'+imagep+item.img+'"/ height="44px;" width="65px;">';
          }
					content += '</div>';
					content += '<div class="col-8 col-md-8">';
					content += '<span style="white-space: normal;">'+item.name+'</span>';
					content += '</div>';
					content += '</div>';
					content += '</div></a>';
				
				});
			  }
			  else
			  {
				content += '<div class="row">';
				content += '<div class="col-12"><p style="text-align: center;padding: 10px;margin: 0;">No Product Available</p>';
				content += '</div>';
				content += '</div>';
			  }

				jQuery('.search_outer_con_mobile_fixed_40').addClass('enable_search');
				$('#viewsearchproduct_mobile_fixed_40').html(content);
       
				
    	       
        },
    	});

    }
	else
	{
		jQuery('.search_outer_con_mobile_fixed_40').removeClass('enable_search');
   
	}
   
  
  });
});



$(document).ready(function(){
  $(".typeheads_fixed").keyup(function(){

    var search = $(".typeheads_fixed").val();
	var cat = '';
	var pro = "{{ URL::to('/shop?category=&search')}}";

    if(search != "")
    {
		var content ='';
      jQuery.ajax({
    		 url: '{{ URL::to("/autocomplete")}}',
    		 headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
    		 type: "GET",
			 data: 'search='+search+'&cat='+cat,
			  dataType: 'JSON',
    		  success: function (data) { 
				if(data !="")
					{
				$.each(data, function(index, item) 
				{
					content += '<a href="'+pro+'='+item.name+'"><div class="searchdropdown">';
					content += '<div class="row">';
					content += '<div class="col-4 col-md-4">';
          if(item.image_path_type == 'aws')
          {
            content += '<img src="'+item.img+'"/ height="44px;" width="65px;">';
          }
          else
          {
            content += '<img src="'+imagep+item.img+'"/ height="44px;" width="65px;">';
          }
					
					content += '</div>';
					content += '<div class="col-8 col-md-8">';
					content += '<span style="white-space: normal;">'+item.name+'</span>';
					content += '</div>';
					content += '</div>';
					content += '</div></a>';
				
				});
			  }
			  else
			  {
				content += '<div class="row">';
				content += '<div class="col-12"><p style="text-align: center;padding: 10px;margin: 0;">No Product Available</p>';
				content += '</div>';
				content += '</div>';
			  }

				jQuery('.search_outer_con_fixed').addClass('enable_search');
				$('#viewsearchproduct_fixed').html(content);
				
    	       
        },
    	});

    }
	else
	{
		jQuery('.search_outer_con_fixed').removeClass('enable_search');
	}
   
  
  });
});
  
/* 
    $('input.typeahead').typeahead({
		
        source:  function (query, process) {
            return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        },
		
        highlighter: function (item, data) {
            var parts = item.split('#'),
                html = '<div class="row">';
                html += '<div class="col-4 col-md-4">';
                html += '<img src="'+imagep+data.img+'"/ height="44px;" width="65px;">';
                html += '</div>';
                html += '<div class="col-8 col-md-8">';
                html += '<a href="'+product_url+'/'+data.slug+'"><span style="white-space: normal;">'+data.name+'</span></a>';
                html += '</div>';
                html += '</div>';

            return html;
        }
		
    }); */

    //add-to-redeem point
	$('.loyality-success-btn').hide();
    jQuery(document).on('click', '.addtoRedeem', function(e){

    	var redeem_id = jQuery('#redeem_id').val();
    	jQuery.ajax({
    		 url: '{{ URL::to("/addRedeempoint")}}',
    		 headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
    		 type: "POST",
    		  data: 'redeem_id='+redeem_id,
    		  success: function (res) { 
    		if(res=='already'){
    			$('#conformModal').modal('hide');
    			$('#alreadyModal').modal('show');
    		}else if(res=='invaild_amount'){
    			$('#conformModal').modal('hide');
    			$('#alreadyModal').modal('hide');
    			$('#pointlowModal').modal('show');
    		}else{
				var user_id = <?php if(auth()->guard('customer')->check()) { echo auth()->guard('customer')->user()->id; } else { echo '16';} ?>;
    			getloyalty_point(user_id);
    			jQuery('.get-redeem-vocher').html(res);
          		$('#conformModal').modal('hide');
          		$('.loyality-success-btn').show();

    		}              
        },
    	});
    });
	
	$(document).on('click', '#loyal-close-modal', function(){
		$('.loyality-success-btn').hide();
   
  });


    $(document).on('click', '#get-reward-value', function(){
    var redeem_id = $(this).attr('redeem_id');
    
        jQuery.ajax({
      url: '{{ URL::to("/viewReward")}}',
      headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
      type: "POST",
        data: 'redeem_id='+redeem_id,
        success: function (res) { 
          jQuery('.get-redeem-detail').html(res);

          $("#viewrewardModal").modal('show');
		  $('.loyality-success-btn').hide();
      
    },
    });
   
  });

    function refreshPage(){
    window.location.reload();
}

function get_redeem_code() {
  /* Get the text field */
  	let inputEl = document.getElementById("myInput");
    inputEl.select();                                    // Select element
    inputEl.setSelectionRange(0, inputEl.value.length); // select from 0 to element length
    const successful = document.execCommand('copy');   // copy input value, and store 
}

function getloyalty_point(id) {
  jQuery.ajax({
      url: '{{ URL::to("/getloyalty_point")}}',
      headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
      type: "POST",
      data: 'user_id='+id,
        success: function (res) { 
        
          jQuery('#add_loyalty_point').html(res);
          jQuery('#subscribe').html('Loyalty Points - '+res);
      
    },
    });
} 


   $(document).ready(function(){
 
        $('.floatingButton').on('click',
            function(e){
             
                e.preventDefault();
                $(this).toggleClass('open');
                if($(this).children('.fa').hasClass('fa-comments'))
                {
                    $(this).children('.fa').removeClass('fa-comments');
                    $(this).children('.fa').addClass('fa-close');
                } 
                else if ($(this).children('.fa').hasClass('fa-close')) 
                {
                    $(this).children('.fa').removeClass('fa-close');
                    $(this).children('.fa').addClass('fa-comments');
                }
                $('.floatingMenu').stop().slideToggle();
            }
        );
        $(this).on('click', function(e) {
         
            var container = $(".floatingButton");
            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && $('.floatingButtonWrap').has(e.target).length === 0) 
            {
                if(container.hasClass('open'))
                {
                    container.removeClass('open');
                }
                if (container.children('.fa').hasClass('fa-close')) 
                {
                    container.children('.fa').removeClass('fa-close');
                    container.children('.fa').addClass('fa-comments');
                }
                $('.floatingMenu').hide();
            }
          
            // if the target of the click isn't the container and a descendant of the menu
            if(!container.is(e.target) && ($('.floatingMenu').has(e.target).length > 0)) 
            {
                $('.floatingButton').removeClass('open');
                $('.floatingMenu').stop().slideToggle();
            } 
        });
    });

    $('.fa_next_page').on('click',
            function(e){
              var container = $(".floatingButton");
              jQuery('.fa-new').removeClass('fa-close');
                jQuery('.fa-new').addClass('fa-comments');
               
            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && $('.floatingButtonWrap').has(e.target).length === 0) 
            {
                if(container.hasClass('open'))
                {
                    container.removeClass('open');
                }
                
               
                $('.floatingMenu').hide();
            }
            })

    

	$(window).click(function(e) {
		jQuery('.search_outer_con').removeClass('enable_search');
		jQuery('.search_outer_con_mobile').removeClass('enable_search');
		jQuery('.search_outer_con_mobile_fixed_40').removeClass('enable_search');
		jQuery('.search_outer_con_fixed').removeClass('enable_search');
		$("#viewsearchproduct_fixed").html('');
		$("#viewsearchproduct_mobile").html('');
		$("#viewsearchproduct").html('');
    
  $('.cart-click-hide').hide();
  $('.cart-click-show').show();
		// $(".typeheads_fixed").val('');
		// $(".typeheads_mobile").val('');
		// $(".typeheads").val('');
});
 

(function (jQuery) {
  var tabCarousel = jQuery('.carousel-carousel-js-6');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: false,
          infinite: true,
          autoplay: false,
          autoplaySpeed: 2000,
		//   prevArrow: '<div class="slider-arrow slider-prev fa fa-angle-left"></div>',
    	//   nextArrow: '<div class="slider-arrow slider-next fa fa-angle-right"></div>',

          // variableWidth: true,
          //rtl:true,
          speed: 2000,
          slidesToShow:  1,
          slidesToScroll:  1,
          adaptiveHeight: false,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


  (function (jQuery) {
  var tabCarousel = jQuery('.carousel-carousel-js-8');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          //arrows: true,
          infinite: true,
          autoplay: false,
          autoplaySpeed: 2000,

		  prevArrow: '<div class="slider-arrow slider-prev fa fa-angle-left"></div>',
    	  nextArrow: '<div class="slider-arrow slider-next fa fa-angle-right"></div>',

          // variableWidth: true,
          //rtl:true,
          speed: 2000,
          slidesToShow:  1,
          slidesToScroll:  1,
          adaptiveHeight: false,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


  (function (jQuery) {
  var tabCarousel = jQuery('.carousel-carousel-js-9');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          //arrows: true,
          infinite: false,
          autoplay: false,
          autoplaySpeed: 2000,

		  prevArrow: '<div class="slider-arrow slider-prev fa fa-angle-left"></div>',
    	  nextArrow: '<div class="slider-arrow slider-next fa fa-angle-right"></div>',

          // variableWidth: true,
          //rtl:true,
          speed: 2000,
          slidesToShow:  1,
          slidesToScroll:  1,
          adaptiveHeight: false,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              dots: true,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              dots: true,
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
              dots: true,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


  (function (jQuery) {
  var tabCarousel = jQuery('.carousel-carousel-js-10');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: true,
          arrows: false,
          infinite: false,
          autoplay: false,
          autoplaySpeed: 2000,

		//   prevArrow: '<div class="slider-arrow slider-prev fa fa-angle-left"></div>',
    	//   nextArrow: '<div class="slider-arrow slider-next fa fa-angle-right"></div>',

          // variableWidth: true,
          //rtl:true,
          speed: 2000,
          slidesToShow:  1,
          slidesToScroll:  1,
          adaptiveHeight: false,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              dots: true,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              dots: true,
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
              dots: true,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


  (function (jQuery) {
  var tabCarousel = jQuery('.carousel-carousel-js-11');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: true,
          //arrows: true,
          infinite: false,
          autoplay: false,
          autoplaySpeed: 2000,

		  prevArrow: '<div class="slider-arrow slider-prev fa fa-angle-left"></div>',
    	  nextArrow: '<div class="slider-arrow slider-next fa fa-angle-right"></div>',

          // variableWidth: true,
          //rtl:true,
          speed: 2000,
          slidesToShow:  1,
          slidesToScroll:  1,
          adaptiveHeight: false,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


  (function (jQuery) {
  var tabCarousel = jQuery('.carousel-carousel-js-16');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: true,
          arrows: true,
          infinite: false,
          autoplay: false,
          autoplaySpeed: 2000,
          prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-left-arrow fill-color-arrow-car common-fill-hover slider-arrow slider-prev" width="16" height="16" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
    	  nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-right-arrow fill-color-arrow-car common-fill-hover slider-arrow slider-next" width="16" height="16" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
          // variableWidth: true,
          //rtl:true,
          speed: 2000,
          slidesToShow:  1,
          slidesToScroll:  1,
          adaptiveHeight: false,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          }, 
		  {
            breakpoint: 992,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }, 
		  {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


  (function (jQuery) {
  var tabCarousel = jQuery('.carousel-carousel-js-26');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: false,
          infinite: false,
          autoplay: false,
          autoplaySpeed: 2000,
          prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-left-arrow fill-color-arrow-car common-fill-hover slider-arrow slider-prev" width="16" height="16" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
    	  nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-right-arrow fill-color-arrow-car common-fill-hover slider-arrow slider-next" width="16" height="16" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',

          // variableWidth: true,
          //rtl:true,
          speed: 2000,
          slidesToShow:  1,
          slidesToScroll:  1,
          adaptiveHeight: false,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              dots: true,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              dots: true,
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
              dots: true,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);

  (function (jQuery) {
  var tabCarousel = jQuery('.carousel-carousel-js-14');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: true,
          centerMode: true,
          centerPadding: '140px',
          //arrows: true,
          infinite: true,
          autoplay: false,
          autoplaySpeed: 2000,
          prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-left-arrow fill-color-arrow-car common-fill-hover slider-arrow slider-prev" width="22" height="22" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
    	  nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-right-arrow fill-color-arrow-car common-fill-hover slider-arrow slider-next" width="22" height="22" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',

          // variableWidth: true,
          //rtl:true,
          speed: 2000,
          slidesToShow:  1,
          slidesToScroll:  1,
          adaptiveHeight: false,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              centerMode: false,
              centerPadding: '20px',
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              centerMode: false,
              centerPadding: '20px',
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
              centerMode: false,
              centerPadding: '20px',
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


  (function (jQuery) {
  var tabCarousel = jQuery('.banner-banner-js-32');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: false,
          infinite: false,
		//   prevArrow: '<div class="slider-arrow slider-prev fa fa-angle-left"></div>',
    	//   nextArrow: '<div class="slider-arrow slider-next fa fa-angle-right"></div>',

          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  3,
          slidesToScroll:  3,
          adaptiveHeight: false,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
            }
          }, 
		  {
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }, 
		  {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);

  (function (jQuery) {
  var tabCarousel = jQuery('.infobox-carousel-js');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: false,
          infinite: false,
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  4,
          slidesToScroll:  4,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


  



jQuery(document).on('click', '#closeNav', function(e){

  jQuery("#mySidenav").css('width','0');
  jQuery("html").css('overflow','auto');
  jQuery("html").css('height','auto');
  jQuery("body").css('overflow','auto');
  jQuery("body").css('height','auto');
  jQuery("#overlay").css('display','none');


});



jQuery(document).on('click', '.modal_show3', function(e){
  var products_id = jQuery(this).attr('products_id');
  jQuery("#productID").val(products_id);
  var productName = jQuery(this).attr('products_name');
  jQuery("#product_name").val(productName);
  jQuery("#productName").html(productName);
  jQuery("#mySidenav").css('width','300px');
  jQuery("html").css('overflow','hidden');
  jQuery("html").css('position','relative');
  jQuery("html").css('height','100%');
  jQuery("html").css('-webkit-overflow-scrolling','touch');
  jQuery("body").css('overflow','hidden');
  jQuery("body").css('position','relative');
  jQuery("body").css('height','100%');
  jQuery("body").css('-webkit-overflow-scrolling','touch');
  jQuery("#overlay").css('display','block');

});




jQuery(document).on('click', '#subsave', function(e){

var login = "{{ auth()->guard('customer')->check() }}";
//alert(login);
if(login == ''){
  jQuery('#resfinal').html('Please Login First');
}else{

  
  var products_id = $('#productID').val();
  var product_name = $('#product_name').val();
  var outlet = $('#outlet').val();
  var name = $('#appiname').val();
  var phone = $('#phone').val();
  var appDate = $('#app_date').val();
  var appTime = $("#app_time").val();
  var message = $('#message').val();
  var address = $('#address').val();
  var products_price=$('#products_price').val();
  var app_services=$('#app_services').val();
  var app_staffs=$('#app_staffs').val();

  //alert(product_name);

  //alert(products_id);
  if(outlet == ''){
      $('.err-req0').html('field is required');
  } else{
    $('.err-req0').html('');
  } 
  if(name == ''){
      $('.err-req1').html('Name is required');
  } else {
    $('.err-req1').html('');
  } 
  if(phone == ''){
      $('.err-req2').html('Phone is required');
  } else {
    $('.err-req2').html('');
  }
  if(appDate == ''){
      $('.err-req3').html('Appointment Date is required');
  } else {
    $('.err-req3').html('');
  }
  if(appTime == ''){
      $('.err-req4').html('Appointment Time is required');
  } else {
    $('.err-req4').html('');
  }
  if(message == ''){
      $('.err-req5').html('Message is required');
  } else{
    $('.err-req5').html('');
  } 
  if(address == ''){
      $('.err-req6').html('Address is required');
  } else{
    $('.err-req6').html('');
  }
  if(outlet == '' || name == '' || phone == '' || appDate == '' || appTime == '' || message == '' || address == ''){
    $('.err-req7').html('option is required');
  }else{

    var btn = document.getElementById('subsave');
btn.disabled = true;

    jQuery.ajax({

      url: '{{ URL::to("/appointment")}}',
      headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

      type: "POST",
      data: '&outlet_id='+outlet+'&products_id='+products_id+'&product_name='+product_name+'&name='+name+'&phone='+phone+'&appDate='+appDate+'&appTime='+appTime+'&message='+message+'&address='+address+'&products_price='+products_price+'&app_services='+app_services+'&app_staffs='+app_staffs,
      success: function (res) {  
          
          jQuery("#mySidenav").css('width','0px');
          jQuery("html").css('overflow','auto');
          jQuery("body").css('overflow','auto');
          jQuery("#overlay").css('display','none');

          
          var x = document.getElementById("toast")
          x.className = "show";
          setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);

          // //jQuery('#resfinal').html('Appointment Successfully');
          var outlet = $('#outlet').val('');
          // var name = $('#name').val('');
          // var phone = $('#phone').val('');
          var appDate = $('#app_date').val('');
          var appTime = $('#app_time').val('');
          var message = $('#message').val('');
          // var address = $('#address').val('');
        },
      });

    }
  }

});



jQuery(".outClass").change(function(){
  var outletID = $(this).val();

  var holiday = [];

  jQuery.ajax({ 
    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
    type: "GET",
    url: "{{url('/appointment_ajaxDate_by_outletID')}}",
    data: 'outletID='+outletID,
    success: function(data)
    {
      jQuery.each(data, function(index, item) {
        var date = item.date;
        var d=new Date(date.split("/").reverse().join("-"));
        var dd=d.getDate();
        var mm=d.getMonth()+1;
        var yy=d.getFullYear();

        var test =  dd+"-"+mm+"-"+yy;

        var holidaydate = test;
        //holiday  +=  holidaydate + ',';
        holiday  +=  holidaydate +','; 

        $('#holidayID').val(holiday);

      })

      $('.datepicker').datepicker({
        startDate:"Today",
        format: 'yyyy-mm-dd',
        beforeShowDay: function(date){
          //console.log(dateArray);
            dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
            if(holiday.indexOf(dmy) != -1){
                return false;
            }
            else{
                return true;
            }
        }
      })

    }
  });

  jQuery.ajax({
      headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
      type: "GET",
      url: "{{url('/appointment_ajax')}}",
      data: 'outletID='+outletID,
      success: function(data)
      {
        //alert(data.startHour);
        //$('#app_date').val('');
        //console.log(data);
        if(data == 0){
          var showData = [];
          showData[0] = "<option value=''>Select Appointment Time</option>";
          jQuery("#app_time").html(showData);
        } else {
          var i;
					var showData = [];
					for (i = 0; i < data.length; ++i) {
						var j = i + 1;
						showData[i] = "<option value='"+data[i].start_end+"'>"+data[i].start_end+"</option>";
					}
					jQuery("#app_time").html(showData);
        }

        //$('#resultData').html(data.content)
      }
    });

    jQuery.ajax({
      headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
      type: "GET",
      url: "{{url('/appointment_services')}}",
      data: 'outletID='+outletID,
      success: function(data)
      {
        console.log(data);
        var showData = [];
        if(data == 0){
          jQuery("#appServices").hide();
          showData[0] = "<option value='0'>Select Appointment Services</option>";
          jQuery("#app_services").html(showData);
        } else {
          jQuery("#appServices").css('display','block');
          var i;
					for (i = 0; i < data.length; ++i) {
						var j = i + 1;
						showData[i] = "<option value='"+data[i].id+"'>"+data[i].title+"</option>";
					}
					jQuery("#app_services").html(showData);
        }
      }
    });


    jQuery.ajax({
      headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
      type: "GET",
      url: "{{url('/appointment_staffs')}}",
      data: 'outletID='+outletID,
      success: function(data)
      {
        console.log(data);
        var showData = [];
        if(data == 0){
          jQuery("#appStaffs").hide();
          showData[0] = "<option value='0'>Select Appointment Staffs</option>";
          jQuery("#app_staffs").html(showData);
        } else {
          jQuery("#appStaffs").css('display','block');
          var i;
					for (i = 0; i < data.length; ++i) {
						var j = i + 1;
						showData[i] = "<option value='"+data[i].id+"'>"+data[i].title+"</option>";
					}
					jQuery("#app_staffs").html(showData);
        }
      }
    });


});


$(document).ready(function () {

  
    $(".datepicker").on("change",function(){
      var date=$(this).val();
      var outletID = $('#outlet').val();
      //alert(outletID);
      $.get("{{url('/appointment_ajax_date')}}", {
        date:date,outletID:outletID
      },
      function(data){
        $('#resultData').html(data.content)
      });
    });
// .on('changeDate', function(selected) {   
//         var minDate = new Date(selected.date.valueOf());
//         var formatDate = minDate.toLocaleDateString();
//         var sDate = new Date(Date.parse(formatDate,"yyyy-MM-dd"));
//         ajaxDate(sDate);
//           //alert(formatDate);
//       });

  

  function ajaxDate(sDate){
    alert(sDate);
    jQuery.ajax({
      headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
      type: "GET",
      url: "{{url('/appointment_ajax_date')}}",
      data: 'outletID='+outletID+'&date='+sDate,
      success: function(data)
      {
        //alert('ok');
        $('#resultData').html(data.content)
      }
    });

  }

});


jQuery(document).on('click', '.awallet', function(e){

  jQuery("body").css('padding','0px');

});

jQuery(document).on('click', '.popupnotscroll', function(e){
  jQuery("html").css('overflow','hidden');
});

jQuery(document).on('click', '.modal-open', function(e){
  jQuery("html").css('overflow','auto');
});




// Get the element with id="defaultOpen" and click on it








    var markers;
    var myLatlng;
    var map;
    var geocoder;
   function setUserLocation(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          myLatlng = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };

          markers.setPosition(myLatlng);
          map.setCenter(myLatlng);

        }, function() {
        });
      } 
   } 
   function saveAddress(){
    
    var latlng = markers.getPosition();
    geocoder.geocode({'location': latlng}, function(results, status) {
        if (status === 'OK') {
          if (results[0]) {
      $('#mapModal').modal('hide');
           var street = "";
           var state = "";
           var country = "";
           var city = "";
           var postal_code = "";

              for (var i = 0; i < results[0].address_components.length; i++) {
                  for (var b = 0; b < results[0].address_components[i].types.length; b++) {
                      switch (results[0].address_components[i].types[b]) {
                          case 'locality':
                              city = results[0].address_components[i].long_name;
                              break;
                          case 'administrative_area_level_1':
                              state = results[0].address_components[i].long_name;
                              break;
                          case 'country':
                              country = results[0].address_components[i].long_name;
                              break;
                          case 'postal_code':
                            postal_code =  results[0].address_components[i].long_name; 
                            break;
                          case 'route':
                            if (street == "") {
                              street = results[0].address_components[i].long_name;
                            }
                          break;

                          case 'street_address':
                            if (street == "") {
                              street += ", " + results[0].address_components[i].long_name;
                            }
                          break;
                      }
                  }
              }
              $("#entry_postcode1").val(postal_code);
              $("#entry1_street_address").val(street);
              $("#entry_city1").val(city);

              $("#latitude").val(markers.getPosition().lat());
              $("#longitude").val(markers.getPosition().lng());

              // $("#entry_country_id").val(country);
             
              $("#location").val(latlng);

              $("#entry_country_id option").filter(function() {
                //may want to use $.trim in here
                return $(this).text() == country;
              }).prop('selected', true);

             
                $("#entry_zone_id option").filter(function() {
                  //may want to use $.trim in here
                  return $(this).text() == state;
                }).prop('selected', true);

                if(getZones("no_loader")){
                $("#entry_zone_id option").filter(function() {
                  //may want to use $.trim in here
                  return $(this).text() == state;
                }).prop('selected', true);
              }
             

              $('#mapModal').modal('hide');

          } else {
            console.log('No results found');
          }
        } else {
          console.log('Geocoder failed due to: ' + status);
        }
      });
   }

   function initialize() {
    defaultPOS = {
            lat: '3.1544586902967247',
            lng: '101.59651500860105'
          };
    map = new google.maps.Map(document.getElementById('map'), {
        center: defaultPOS,
        zoom: 13,
        mapTypeId: 'roadmap'
      });
    geocoder = new google.maps.Geocoder;
    markers = new google.maps.Marker({
        map: map,
        draggable:true,
        position: defaultPOS
      });

      
      
      var infowindow = new google.maps.InfoWindow;
      // Create the search box and link it to the UI element.
      var input = document.getElementById('pac-input');
      var searchBox = new google.maps.places.SearchBox(input);
      map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

      map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
      });

        searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();

        if (places.length == 0) {
          return;
        }

        var bounds = new google.maps.LatLngBounds();

        places.forEach(function(place) {
          if (!place.geometry) {
            console.log("Returned place contains no geometry");
            return;
          }
          var icon = {
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(25, 25)
          };
          console.log(place.geometry.location);
          // Create a marker for each place.
          markers.setPosition(place.geometry.location);
          markers.setTitle(place.name);
          

          if (place.geometry.viewport) {
            // Only geocodes have viewport.
            bounds.union(place.geometry.viewport);
          } else {
            bounds.extend(place.geometry.location);
          }
        });
        map.fitBounds(bounds);
      });
    }

    $('.reservation').daterangepicker();


</script>

