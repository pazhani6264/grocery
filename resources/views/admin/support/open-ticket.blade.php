@extends('admin.support.layouts.default')
@section('title', 'Open new ticket')
@section('content')
<div class="page__title ticket-common-bg">
	<h1>{{ __('Open New ticket') }}</h1>
</div>
<div class="fowtickets__main__content">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 m-auto">
                @if(session('success'))
				<div class="note note-success">
					<span class="icon"><i class="fa fa-check"></i></span>
					{{session('success')}}
				</div>
				@endif
				@if(auth()->user()->role_id == 1)
				<div class="note note-warning">
					<li><strong>{{ __('Make sure')}} </strong> {{ __('that you explain your request or problem well.')}} </li>
					<li>{{ __('Do not enter any')}}  <strong>{{ __('HTML tags')}} </strong>{{ __(' or unacceptable links.')}} </li>
					<li>{{ __('Attach any file that will help us solve your problem.')}} </li>
				</div>
				@endif
				<div class="card mb-3">
					<div class="card-body">
						@if(auth()->user()->role_id == 1)
						<form action="{{ URL::to('admin/support/insert-ticket')}}" method="POST" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="Subject"> {{ __('Subject :')}} <span class="fsgred">*</span></label>
								<input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" required>
								@error('subject')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="SelectProduct">{{ __('Select Product :')}} <span class="fsgred">*</span></label>
										<select class="form-control custom-select @error('product') is-invalid @enderror" name="product" id="product" required>
											<option selected disabled value="">{{ __('Select Product')}}</option>
											@foreach($products as $product)
										<option value="{{$product->product_name}}">{{$product->product_name}}</option>
											@endforeach
										</select>
										@error('product')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="Selectpriority">{{ __('Select the priority :')}} <span class="fsgred">*</span></label>
										<select class="form-control custom-select @error('priority') is-invalid @enderror" name="priority" id="priority" required>
											<option selected disabled value="">{{ __('Choose the priority')}}</option>
											<option value="1">{{ __('Low')}}</option>
											<option value="2">{{ __('High')}}</option>
											<option value="3">{{ __('Urgent')}}</option>
										</select>
										@error('priority')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="Description">{{ __('Description :')}} <span class="fsgred">*</span></label>
								<textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="6" required></textarea>
								@error('description')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group">
								<label for="attachfile">{{ __('Attach file (optional) :')}}</label>
								<input type="file" class="form-control @error('attachfile') is-invalid @enderror" name="attachfile" id="attachfile">
								<small class="text-muted">{{ __('Only allowed (JPEG, JPG, PNG, PDF)') }}</small>
								@error('attachfile')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group">
								<input type="checkbox" name="terms" class="@error('terms') is-invalid @enderror" required>
								<label class="agree-fs" for="terms">I agree to the <a href="{{url('/page?name=term-services')}}">Terms of use</a> and <a href="{{URL('/page?name=privacy-policy')}}">Privacy Policy</a>.</label>
								@error('terms')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<button type="submit" class="btn btn-secondary">{{__('Submit') }}</button>
						</form>
						@elseif(Auth::user()->permission == 0)
						<div class="note note-primary mb-0">
							{{__('You cannot open any tickets you are the Admin')}}
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

<style>

</style>