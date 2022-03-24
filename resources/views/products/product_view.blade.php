@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-8">
					<h1>{{ $product->name }}</h1>
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
			<div class="form-group">
				<label>Name</label>
				<div>{{ $product->name }}</div>
			</div>
			<hr>
			<div class="form-group">
				<label>Price</label>
				<div>&pound;{{ number_format($product->price, 2)}}</div>
			</div>
			<hr>
			<div class="form-group">
				<label for="name">Description</label>
				@if(empty($product->description))
					<div class="alert alert-warning"><i>No description has been set.</i></div>
				@else
					<div>{{ $product->description }}</div>
				@endif
			</div>
			<hr>
			<div class="form-group">
				<label for="name">Category</label>
				<div>
					@if(isset($product->category->parent))
						{{ $product->category->parent->name}} &raquo;
					@endif
					{{ $product->category->name }} 
				</div>
			</div>
			<hr>
			<div class="form-group">
				<label>Created On</label>
				<div>
					{{ $product->created_at_formatted }}
				</div>
			</div>


		</div>
	</div>
</div>
@endsection