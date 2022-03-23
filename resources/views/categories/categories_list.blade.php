@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			@if( !isset($category) )
				<div class="row">
					<div class="col-sm-8">
						<h1>All Categories</h1>
					</div>
					<div class="col-sm-4 text-right">
						<a href="{{ route('categories.create') }}" class="btn btn-success">New Category</a>
					</div>
				</div>
			@else
				<div class="row">
					<div class="col-sm-8">
						<h1>{{ $category->name }}</h1>
					</div>
					<div class="col-sm-4 text-right">
						<a href="{{ route('categories.index') }}" class="btn btn-danger">Back</a>
						<a href="{{ route('categories.create', ['categoryId' => $category->id]) }}" class="btn btn-success">New Category</a>
					</div>
				</div>
			@endif
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
					@if(count($categories) === 0)
						<tr>
							<td colspan="3" class="text-center">No categories available.</td>
						</tr>
					@else
						@foreach($categories as $category)
							<tr>
								<td>{{ $category->id }}</td>
								<td>
									<a href="/categories/{{ $category->id }}">
										{{ $category->name }}
									</a>
								</td>
								<td class="text-right">
									<a href="{{ route('categories.index') }}/{{ $category->id }}" class="btn btn-success">Sub-Categories</a>
									<a href="{{ route('products.index') }}?categoryId={{ $category->id }}" class="btn btn-warning">Products</a>
									<a href="{{ route('categories.index') }}/{{ $category->id }}/edit" class="btn btn-info">Edit</a>
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