
<script type="text/javascript">
window.onload = function() {
	
	


}
jQuery(document).on('click', '#apply_options_btn', function(e){
	if (jQuery('input:checkbox.filters_box:checked').length > 0) {
      	jQuery('#filters_applied').val(1);
		jQuery('#apply_options_btn').removeAttr('disabled');
	} else {
      	jQuery('#filters_applied').val(0);
		jQuery('#apply_options_btn').attr('disabled',true);
    }
	jQuery('#load_products_form').submit();
	jQuery('#side-filter-test').submit();

})


//sortby
document.getElementById('sortbytype').addEventListener('change',function(){
	jQuery("#load_products_form").submit();

});

//sortby
document.getElementById('sortbylimit').addEventListener('change',function(){
	jQuery("#load_products_form").submit();

});

//Display grid/list 3 Column
jQuery(document).ready(function () {

	
    jQuery('#list').on('click', function(){
		var product_column = '{{$result1['commonContent']['settings']['product_column']}}';
		jQuery( '#products_style' ).val( 'list' );
		if(product_column == '1')
		{
			jQuery( '#swap .col-12' ).removeClass( 'griding' );
			jQuery( '#swap .col-12' ).removeClass( 'griding4' );
			jQuery( '#swap .col-12' ).removeClass( 'col-lg-4' );
			jQuery( '#swap .col-12' ).removeClass( 'col-lg-3' );
			jQuery( '#swap .col-12' ).removeClass( 'col-sm-6' );
			jQuery( '#swap .col-12' ).removeClass( 'col-md-4' );
			jQuery( '#swap .col-12' ).addClass( 'listing' );
				
			jQuery( '#swap2 .col-12' ).removeClass( 'griding' );
			jQuery( '#swap2 .col-12' ).removeClass( 'griding4' );
			jQuery( '#swap2 .col-12' ).removeClass( 'col-md-6' );
			jQuery( '#swap2 .col-12' ).removeClass( 'col-md-4' );
			jQuery( '#swap2 .col-12' ).removeClass( 'col-lg-3' );
			jQuery( '#swap2 .col-12' ).removeClass( 'col-lg-4' );
			jQuery( '#swap2 .col-12' ).addClass( 'listing' );
		}
		else
		{
			jQuery( '#swap .col-6' ).removeClass( 'griding' );
			jQuery( '#swap .col-6' ).removeClass( 'griding4' );
			jQuery( '#swap .col-6' ).removeClass( 'col-lg-4' );
			jQuery( '#swap .col-6' ).removeClass( 'col-lg-3' );
			jQuery( '#swap .col-6' ).removeClass( 'col-sm-6' );
			jQuery( '#swap .col-6' ).removeClass( 'col-md-4' );
			jQuery( '#swap .col-6' ).addClass( 'listing');
			jQuery( '#swap .listing' ).removeClass( 'col-6');
			jQuery( '#swap .listing' ).addClass( 'col-12 col-6');
				
			jQuery( '#swap2 .col-6' ).removeClass( 'griding' );
			jQuery( '#swap2 .col-6' ).removeClass( 'griding4' );
			jQuery( '#swap2 .col-6' ).removeClass( 'col-lg-4' );
			jQuery( '#swap2 .col-6' ).removeClass( 'col-md-6' );
			jQuery( '#swap2 .col-6' ).removeClass( 'col-lg-3' );
			jQuery( '#swap2 .col-6' ).removeClass( 'col-md-4' );
			jQuery( '#swap2 .col-6' ).addClass( 'listing' );
			jQuery( '#swap2 .listing' ).removeClass( 'col-6');
			jQuery( '#swap2 .listing' ).addClass( 'col-12 col-6');
		}

        jQuery( this ).addClass( 'active' );
		jQuery( '#grid' ).removeClass( 'active' );
		jQuery( '#grid4' ).removeClass( 'active' );

				<?php foreach($result1['products']['product_data'] as $key=>$products){ ?>

					jQuery( '#cart_button<?php echo $products->products_id; ?>' ).show();
					jQuery( '#view_button<?php echo $products->products_id; ?>' ).show();
					jQuery( '#added_button<?php echo $products->products_id; ?>' ).show();
					jQuery( '#cart_button2<?php echo $products->products_id; ?>' ).show();
					jQuery( '#view_button2<?php echo $products->products_id; ?>' ).show();
					jQuery( '#added_button2<?php echo $products->products_id; ?>' ).show();
					jQuery( '#out_button<?php echo $products->products_id; ?>' ).show();

				<?php }?>
    });
    jQuery('#grid').on('click', function(){

		jQuery( '#products_style' ).val( 'grid' );
		var product_column = '{{$result1['commonContent']['settings']['product_column']}}';
		if(product_column == '1')
		{
			jQuery( '#swap .col-12' ).removeClass( 'listing' );
			jQuery( '#swap .col-12' ).removeClass( 'griding4' );
			jQuery( '#swap .col-12' ).removeClass( 'col-lg-3' );
			jQuery( '#swap .col-12' ).addClass( 'col-lg-3' );
			jQuery( '#swap .col-12' ).addClass( 'col-sm-6' );
			jQuery( '#swap .col-12' ).addClass( 'griding' );
			
			

			jQuery( '#swap2 .col-12' ).addClass( 'griding' );
			jQuery( '#swap2 .col-12' ).addClass( 'col-md-6' );
			jQuery( '#swap2 .col-12' ).addClass( 'col-lg-3' );
			jQuery( '#swap2 .col-12' ).removeClass( 'listing');
			jQuery( '#swap2 .col-12' ).removeClass( 'griding4');
			jQuery( '#swap2 .col-12' ).removeClass( 'col-lg-3' );

		}
		else
		{

			jQuery( '#swap .col-6' ).removeClass( 'listing col-12');
			jQuery( '#swap .col-6' ).removeClass( 'griding4 col-12');
			jQuery( '#swap .col-6' ).removeClass( 'col-lg-3' );
			jQuery( '#swap .col-6' ).addClass( 'col-lg-3' );
			jQuery( '#swap .col-6' ).addClass( 'col-sm-6' );
			jQuery( '#swap .col-6' ).addClass( 'griding' );
			
			
			jQuery( '#swap2 .col-6' ).addClass( 'griding' );
			jQuery( '#swap2 .col-6' ).addClass( 'col-md-6' );
			jQuery( '#swap2 .col-6' ).addClass( 'col-lg-3' );
			jQuery( '#swap2 .col-6' ).removeClass( 'listing col-12');
			jQuery( '#swap2 .col-6' ).removeClass( 'griding4 col-12');
			jQuery( '#swap2 .col-6' ).removeClass( 'col-lg-3' );


		}

		jQuery( this ).addClass( 'active' );
        jQuery( '#list' ).removeClass( 'active' );
		jQuery( '#grid4' ).removeClass( 'active' );

<?php foreach($result1['products']['product_data'] as $key=>$products){ ?>

				jQuery( '#cart_button<?php echo $products->products_id; ?>' ).hide();
				jQuery( '#view_button<?php echo $products->products_id; ?>' ).hide();
				jQuery( '#added_button<?php echo $products->products_id; ?>' ).hide();
				jQuery( '#cart_button2<?php echo $products->products_id; ?>' ).hide();
				jQuery( '#view_button2<?php echo $products->products_id; ?>' ).hide();
				jQuery( '#added_button2<?php echo $products->products_id; ?>' ).hide();
				jQuery( '#out_button<?php echo $products->products_id; ?>' ).hide();

<?php }?>


    });


//grid 4 

	jQuery('#grid4').on('click', function(){

jQuery( '#products_style' ).val( 'grid4' );
var product_column = '{{$result1['commonContent']['settings']['product_column']}}';
if(product_column == '1')
{
	jQuery( '#swap .col-12' ).removeClass( 'listing' );
	jQuery( '#swap .col-12' ).removeClass( 'griding' );
	jQuery( '#swap .col-12' ).removeClass( 'grid' );
	jQuery( '#swap .col-12' ).removeClass( 'col-lg-4' );
	jQuery( '#swap .col-12' ).addClass( 'col-lg-3' );
	jQuery( '#swap .col-12' ).addClass( 'col-sm-6' );
	
	jQuery( '#swap .col-12' ).addClass( 'griding4' );
	
	

	jQuery( '#swap2 .col-12' ).addClass( 'griding4' );
	jQuery( '#swap2 .col-12' ).addClass( 'col-md-4' );
	jQuery( '#swap2 .col-12' ).addClass( 'col-lg-3' );
	jQuery( '#swap2 .col-12' ).removeClass( 'col-lg-4' );
	jQuery( '#swap2 .col-12' ).removeClass( 'listing');
	jQuery( '#swap2 .col-12' ).removeClass( 'griding');

}
else
{

	jQuery( '#swap .col-6' ).removeClass( 'listing col-12');
	jQuery( '#swap .col-6' ).removeClass( 'griding col-12');
	jQuery( '#swap .col-6' ).removeClass( 'col-lg-4' );

	jQuery( '#swap .col-6' ).addClass( 'col-lg-3' );
	jQuery( '#swap .col-6' ).addClass( 'col-sm-6' );
	
	jQuery( '#swap .col-6' ).addClass( 'griding4' );
	
	

	jQuery( '#swap2 .col-6' ).addClass( 'griding4' );
	jQuery( '#swap2 .col-6' ).addClass( 'col-md-4' );
	jQuery( '#swap2 .col-6' ).addClass( 'col-lg-3' );
	jQuery( '#swap2 .col-6' ).removeClass( 'listing col-12');
	jQuery( '#swap2 .col-6' ).removeClass( 'griding col-12');
	jQuery( '#swap2 .col-6' ).removeClass( 'col-lg-4' );

}

jQuery( this ).addClass( 'active' );
jQuery( '#list' ).removeClass( 'active' );
jQuery( '#grid' ).removeClass( 'active' );

<?php foreach($result1['products']['product_data'] as $key=>$products){ ?>

		jQuery( '#cart_button<?php echo $products->products_id; ?>' ).hide();
		jQuery( '#view_button<?php echo $products->products_id; ?>' ).hide();
		jQuery( '#added_button<?php echo $products->products_id; ?>' ).hide();
		jQuery( '#cart_button2<?php echo $products->products_id; ?>' ).hide();
		jQuery( '#view_button2<?php echo $products->products_id; ?>' ).hide();
		jQuery( '#added_button2<?php echo $products->products_id; ?>' ).hide();
		jQuery( '#out_button<?php echo $products->products_id; ?>' ).hide();

<?php }?>


});


});

//load more products
	jQuery(document).on('click', '#load_products', function(e){
	// jQuery('#loader').css('display','flex');
		$('#load_products').html("<img src='{{ asset('web/images/miscellaneous/ajax-loader.gif') }}' /> ");
		setTimeout(() => {
			var page_number = jQuery('#page_number').val();
			var total_record = jQuery('#total_record').val();
			var products_style = jQuery('#products_style').val();
			var pagelayout = jQuery('#pagelayout').val();
			
			var formData = jQuery("#load_products_form").serialize();
			jQuery.ajax({
			headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
				url: '{{ URL::to("/filterProducts")}}',
				type: "POST",
				data: formData,
				success: function (res) {
					if(jQuery.trim().res==0){
						jQuery('#load_products').hide();
						jQuery('#loaded_content').show();
					}else{
						page_number++;
						jQuery('#page_number').val(page_number);
						jQuery('#swap .row').append(res);
						jQuery('#swap2 .row').append(res);
						var record_limit = jQuery('#record_limit').val();
						var showing_record = page_number*record_limit;
						if(total_record<=showing_record){
							jQuery('.showing_record').html(total_record);
							jQuery('#load_products').hide();
							jQuery('#loaded_content').show();
						}else{
							jQuery('.showing_record').html(showing_record);
						}
					}
					var product_column = '{{$result1['commonContent']['settings']['product_column']}}';
					
					if(pagelayout !== undefined){
						if(products_style == 'list'){
							
						
							if(product_column == 1)
							{
								jQuery( '#swap2 .col-12' ).removeClass( 'griding' );
								jQuery( '#swap2 .col-12' ).removeClass( 'col-md-6' );
								jQuery( '#swap2 .col-12' ).removeClass( 'col-lg-3' );
								jQuery( '#swap2 .col-12' ).addClass( 'listing' );
							}
							else
							{
								jQuery( '#swap2 .col-6' ).removeClass( 'griding' );
								jQuery( '#swap2 .col-6' ).removeClass( 'col-md-6' );
								jQuery( '#swap2 .col-6' ).removeClass( 'col-lg-3' );
								jQuery( '#swap2 .col-6' ).addClass( 'listing' );
								jQuery( '#swap2 .listing' ).addClass( 'col-12 col-6');
							}

						}else{
						
						
							if(product_column == 1)
							{
								jQuery( '#swap2 .col-12' ).addClass( 'griding' );
								jQuery( '#swap2 .col-12' ).addClass( 'col-md-4' );
								jQuery( '#swap2 .col-12' ).addClass( 'col-lg-3' );
								jQuery( '#swap2 .col-12' ).removeClass( 'listing' );
							}
							else
							{
								jQuery( '#swap2 .col-6' ).addClass( 'griding' );
								jQuery( '#swap2 .col-6' ).addClass( 'col-md-4' );
								jQuery( '#swap2 .col-6' ).addClass( 'col-lg-3' );
								jQuery( '#swap2 .col-6' ).removeClass( 'listing col-12' );
							}
						}
					}else{
						if(products_style == 'list'){
							
							if(product_column == 1)
							{
								jQuery( '#swap .col-12' ).removeClass( 'griding' );
								jQuery( '#swap .col-12' ).removeClass( 'col-lg-4' );
								jQuery( '#swap .col-12' ).removeClass( 'col-sm-6' );
								jQuery( '#swap .col-12' ).addClass( 'listing' );
							}
							else
							{
								jQuery( '#swap .col-6' ).removeClass( 'griding' );
								jQuery( '#swap .col-6' ).removeClass( 'col-lg-4' );
								jQuery( '#swap .col-6' ).removeClass( 'col-sm-6' );
								jQuery( '#swap .col-6' ).addClass( 'listing' );
								jQuery( '#swap .listing' ).addClass( 'col-12 col-6');
							}

						}else if(products_style == 'grid'){
							
							
							if(product_column == 1)
							{
								jQuery( '#swap .col-12' ).removeClass( 'listing' );
								jQuery( '#swap .col-12' ).addClass( 'col-lg-3' );
								jQuery( '#swap .col-12' ).addClass( 'col-sm-6' );	
								jQuery( '#swap .col-6' ).addClass( 'col-md-4' );											
								jQuery( '#swap .col-12' ).addClass( 'griding' );
							}
							else
							{
								jQuery( '#swap .col-6' ).removeClass( 'listing col-12' );
								jQuery( '#swap .col-6' ).addClass( 'col-lg-3' );
								jQuery( '#swap .col-6' ).addClass( 'col-sm-6' );
								jQuery( '#swap .col-6' ).addClass( 'col-md-4' );											
								jQuery( '#swap .col-6' ).addClass( 'griding' );
							}
						}else{
							if(product_column == 1)
							{
								jQuery( '#swap .col-12' ).removeClass( 'listing' );
								jQuery( '#swap .col-12' ).addClass( 'col-lg-3' );
								jQuery( '#swap .col-12' ).addClass( 'col-sm-6' );	
								jQuery( '#swap .col-12' ).addClass( 'col-md-4' );				
								jQuery( '#swap .col-12' ).addClass( 'griding' );
							}
							else
							{
								jQuery( '#swap .col-6' ).removeClass( 'listing col-12' );
								jQuery( '#swap .col-6' ).addClass( 'col-lg-3' );
								jQuery( '#swap .col-6' ).addClass( 'col-sm-6' );
								jQuery( '#swap .col-6' ).addClass( 'col-md-4' );					
								jQuery( '#swap .col-6' ).addClass( 'griding' );
							}
						}
					}

					

					$('#load_products').html('<a class=" demo-11-recent-btn common-hover common-stroke-hover stroke-color" >MORE PRODUCTS  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" transform="rotate(-45)matrix(1, 0, 0, 1, 0, 0)" ><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.44593 10.5118C6.15159 11.6103 6.1896 12.7714 6.55515 13.8483C6.92071 14.9252 7.59739 15.8695 8.49962 16.5618C9.40186 17.2541 10.4891 17.6633 11.6239 17.7377C12.7587 17.8121 13.8901 17.5483 14.875 16.9796" stroke-linecap="round"></path> <path d="M17.5541 13.4882C17.8484 12.3897 17.8104 11.2286 17.4448 10.1517C17.0793 9.07483 16.4026 8.13053 15.5004 7.43822C14.5981 6.74591 13.5109 6.33669 12.3761 6.26231C11.2413 6.18793 10.1099 6.45173 9.125 7.02035"  stroke-linecap="round"></path> <path d="M3.75 12.5L6.25 10L8.75 12.5"  stroke-linecap="round" stroke-linejoin="round"></path> <path d="M15.25 11.5L17.75 14L20.25 11.5"  stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></a>');
				},
			});
		}, 300);
	});


</script>
