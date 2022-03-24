@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-8">
					@if(!isset($product))
						<h1>Add Product</h1>
					@else
						<h1>Edit Product "{{ $product->name }}"</h1>
					@endif
				</div>
				<div class="col-4 text-right">
					<a href="javascript: history.go(-1)" class="btn btn-danger">Back</a>
				</div>
			</div>
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul class="m-0">
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			<form action="{{ (!isset($product)) ? route('products.store') : route('products.update', $product->id) }}" method="POST" >

				@csrf
				@if( isset($product) )
			    @method('PATCH')
			  @endif


				<div class="form-group">
					<label for="name">Name*</label>
					<input type="text" name="name" required value="{{ @$product->name }}" class="form-control">
				</div>
				<div class="form-group">
					<label for="name">Price*</label>
					<input type="text" name="price" required value="{{ @$product->price }}" class="form-control">
				</div>
				<div class="form-group">
					<label for="name">Description*</label>
					<textarea name="description" required class="form-control">{{ @$product->description }}</textarea>
				</div>
				@if(isset($categoryId))
					<input type="hidden" name="category_id" value="{{ $categoryId }}">
				@endif
				<hr />
				<button class="btn btn-success" type="submit">Save</button>

			</form>

		</div>
	</div>
</div>
@endsection