@extends('layouts.app')

@section('content')
<div class="container">
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
								<td>{{ $category->name }}</td>
								<td class="text-right">
									<a href="/categories?categoryId={{ $category->id }}" class="btn btn-success">Sub-Categories</a>
									<a href="/products/{{ $category->id }}" class="btn btn-warning">Products</a>
									<a href="" class="btn btn-info">Edit</a>
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