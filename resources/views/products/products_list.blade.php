@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
				<div class="row">
					<div class="col-sm-8">
						<h1>Products</h1>
					</div>
					<div class="col-sm-4 text-right">
						<a href="{{ route('products.create') }}" class="btn btn-success">New Product</a>
					</div>
				</div>
			
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-striped bg-white">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th style="width: 40%" class="text-right">Options</th>
					</tr>
				</thead>
				<tbody>
					@if(count($products) === 0)
						<tr>
							<td colspan="3" class="text-center">No products available.</td>
						</tr>
					@else
						@foreach($products as $product)
							<tr>
								<td>{{ $product->id }}</td>
								<td>
									<a href="/products/{{ $product->id }}">
										{{ $product->name }}
									</a>
								</td>
								<td class="text-right">
									<a href="{{ route('products.index') }}/{{ $product->id }}/edit" class="btn btn-info">Edit</a>
								</td>
							</tr>
						@endforeach
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection