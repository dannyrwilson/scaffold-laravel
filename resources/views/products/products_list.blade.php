@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
				<div class="row">
					<div class="col-sm-8">
						<h1>{{ $category->name }} Products</h1>
						@if( is_null($category->parent_id) )
							<p>
								{{ $category->sub_categories_formatted }}
							</p>
						@endif
					</div>
					<div class="col-sm-4 text-right">
						<a href="{{ route('products.create') }}?categoryId={{ $category->id }}" class="btn btn-success"><i class="fa fa-fw fa-plus"></i> New Product</a>
						<a href="{{ route('categories.index') }}" class="btn btn-danger">Back To Categories</a>
						<hr />
						<form method="get" action="/products">
							<div class="input-group">
							  <input type="text" class="form-control" value="{{ $filters['keyword'] }}" name="keyword" placeholder="Keywords...">
							  <input type="hidden" name="categoryId" value="{{ $category->id }}">
							  <div class="input-group-append" id="button-addon4">
									<button type="submit" class="btn btn-primary">Search</button>
							  </div>
							</div>
						</form>
					</div>
				</div>
			
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			@if(session()->has('message'))
				<div class="alert alert-success">
					{{ session('message') }}
				</div>
			@endif
			<table class="table table-bordered table-striped bg-white">
				<thead>
					<tr>
						<th width="10%">
							<a href="/products?categoryId={{$category->id}}&sort=id&order={{ $filters['order'] }}">
								<i class="fa fa-sort-numeric-{{($filters['order'] == 'asc' && $filters['sort'] == 'id') ? 'asc' : 'desc'}}"></i> ID
							</a>
						</th>
						<th>
							<a href="/products?categoryId={{$category->id}}&sort=name&order={{ $filters['order'] }}">
								<i class="fa fa-sort-alpha-{{($filters['order'] == 'asc' && $filters['sort'] == 'name') ? 'asc' : 'desc'}}"></i> Name
							</a>
						</th>
						<th>
							<a href="/products?categoryId={{$category->id}}&sort=price&order={{ $filters['order'] }}">
								<i class="fa fa-sort-numeric-{{($filters['order'] == 'asc' && $filters['sort'] == 'price') ? 'asc' : 'desc'}}"></i> Price
							</a>
						</th>
						<th>
							<a href="/products?categoryId={{$category->id}}&sort=created_at&order={{ $filters['order'] }}">
								<i class="fa fa-sort-numeric-{{($filters['order'] == 'asc' && $filters['sort'] == 'created_at') ? 'asc' : 'desc'}}"></i> Created
							</a>
						</th>
						<th style="width: 30%" class="text-right">Options</th>
					</tr>
				</thead>
				<tbody>
					@if(count($products) === 0)
						<tr>
							<td colspan="5" class="text-center">No products available.</td>
						</tr>
					@else
						@foreach($products as $product)
							<tr>
								<td>{{ $product->id }}</td>
								<td>{{ $product->name }}</a>
								<td>&pound;{{ number_format($product->price, 2) }}</td>
								<td>{{ $product->created_at_formatted }}</td>
								<td class="text-right">
									<form method="post" action="{{ route('products.destroy', $product->id) }}">
										<a href="{{ route('products.show', $product->id) }}" class="btn btn-info">
											<i class="fa fa-eye fa-fw"></i> View
										</a>
										<a href="{{ route('products.index') }}/{{ $product->id }}/edit" class="btn btn-success">
											<i class="fa fa-pencil fa-fw"></i> Edit
										</a>
                    @method('delete')
                    @csrf
                    <button type="submit" onclick="return confirm('Are you sure you wish to delete this product?')" class="btn btn-danger">
                    	<i class="fa fa-trash fa-fw"></i> Delete
                    </button>
	                </form>
								</td>
							</tr>
						@endforeach
					@endif
				</tbody>
			</table>

			{{ $products->appends(request()->query())->links() }}
		</div>
	</div>
</div>
@endsection