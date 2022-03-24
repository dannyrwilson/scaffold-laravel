@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			@if( !isset($category) )
				<div class="row">
					<div class="col-sm-8">
						<h1>All Top Level Categories</h1>
					</div>
					<div class="col-sm-4 text-right">
						<a href="{{ route('categories.create') }}" class="btn btn-success">
							<i class="fa fa-fw fa-plus"></i> New Category
						</a>
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
			@if(session()->has('message'))
				<div class="alert alert-success">
					{{ session('message') }}
				</div>
			@endif
			<table class="table table-bordered table-striped bg-white">
				<thead>
					<tr>
						<th width="10%">ID</th>
						<th>Name</th>
						<th style="width: 50%" class="text-right">Options</th>
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
								<td>{{ $category->name }}</td>
								<td class="text-right">
									
									<form method="post" action="{{ route('categories.destroy', $category->id) }}">
                    @method('delete')
                    @csrf
									
										<a href="{{ route('categories.index') }}/{{ $category->id }}" class="btn btn-success">	<i class="fa fa-fw fa-list"></i>
											Sub-Categories
										</a>
										<a href="{{ route('products.index') }}?categoryId={{ $category->id }}" class="btn btn-warning">
											<i class="fa fa-fw fa-list"></i>
											Products
										</a>
										<a href="{{ route('categories.index') }}/{{ $category->id }}/edit" class="btn btn-info">
											<i class="fa fa-fw fa-pencil"></i>
											Edit
										</a>
											
                    <button type="submit" onclick="return confirm('Are you sure you wish to delete this category? This will also delete all products within this category.')" class="btn btn-danger">
                    	<i class="fa fa-trash fa-fw"></i> Delete
                    </button>
	                </form>

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