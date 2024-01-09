<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="editManufacturerLabel">{{ trans('labels.EditOptions') }}</h4>
</div>
  {!! Form::open(array('url' =>'admin/editdefaultattributefrom', 'name'=>'editDefaultAttributeFrom', 'id'=>'editDefaultAttributeFrom', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}
		  {!! Form::hidden('products_attributes_id',  $result['data']['products_attributes_id'], array('class'=>'form-control', 'id'=>'products_attributes_id')) !!}
		  {!! Form::hidden('products_id',  $result['data']['products_id'], array('class'=>'form-control', 'id'=>'products_id')) !!}
<div class="modal-body">

  <div class="form-group">
	  <label for="name" class="col-sm-2 col-md-4 control-label">{{ trans('labels.OptionName') }}</label>
	  <div class="col-sm-10 col-md-8">
		  <select class="form-control edit-default-option-id field-validate" name="products_options_id">										 
			 @foreach($result['options'] as $options)
			  <option
              @if($result['products_attributes'][0]->options_id == $options->products_options_id)
              	selected
              @endif
               option = "{{ $result['products_attributes'][0]->options_id }}" value="{{ $options->products_options_id }}">{{ $options->products_options_name }}</option>
			 @endforeach										 
		  </select>
          
      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
      {{ trans('labels.AddOptionNameText') }}
     </span>
      
	  </div>
	</div>

   <div class="form-group">
	  <label for="name" class="col-sm-2 col-md-4 control-label">{{ trans('labels.OptionValues') }}</label>
	  <div class="col-sm-10 col-md-8">
		  <select class="form-control  edit-products_options_values_id field-validate" name="products_options_values_id">										 
			 @foreach($result['options_value'] as $options_value)
			  <option
              @if($result['products_attributes'][0]->options_values_id == $options_value->products_options_values_id)
              	selected
              @endif
               option = "{{ $result['products_attributes'][0]->options_values_id }}" value="{{ $options_value->products_options_values_id }}">{{ $options_value->products_options_values_name }}</option>
			 @endforeach										 
		  </select>
          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Choose value for product option.</span>
	  </div>
	</div>

	<div class="form-group">
		<label for="name" class="col-sm-2 col-md-4 control-label">{{ trans('labels.ProductsWeight') }}</label>
		<div class="col-sm-10 col-md-4">
			{!! Form::text('products_weight', $result['products_attributes'][0]->weight, array('class'=>'form-control number-validate', 'id'=>'products_weight')) !!}
		</div>
		<div class="col-sm-10 col-md-4" style="padding-left: 0;">
			<select class="form-control" name="products_weight_unit">
				
				<option value="gm" @if($result['products_attributes'][0]->weight_unit=='gm') selected @endif>Gm</option>
				
				
			</select>
		</div>
	</div>

	 <div class="form-group">
      <label for="name" class="col-sm-2 col-md-4 control-label">Product Quantity</label>
        <div class="col-sm-10 col-md-4">
            <select class="form-control" name="dequt_type">
                <option value="0" @if($result['products_attributes'][0]->quantity_type=='0') selected @endif>Single</option>
                <option value="1" @if($result['products_attributes'][0]->quantity_type=='1') selected @endif>Multiple</option>   
            </select>
        </div>
      <div class="col-sm-10 col-md-4">
         {!! Form::text('dequnt_count', $result['products_attributes'][0]->quantity_count, array('class'=>'form-control number-validate', 'id'=>'dequnt_count')) !!}
      </div>
  </div>

	<div class="alert alert-danger addError" style="display: none; margin-bottom: 0;" role="alert">{{ trans('labels.AddOptionValueText') }}. </div>

</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
	<button type="button" class="btn btn-primary" id="updateDefaultAttribute">{{ trans('labels.Submit') }} Option</button>
</div>
  {!! Form::close() !!}