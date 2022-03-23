@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			@if(!isset($category))
				<h1>Add Category</h1>
			@else
				<h1>Edit {{ $category->name }}</h1>
			@endif
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">

			<form action="{{ (!isset($category)) ? route('categories.store') : route('categories.update', $category->id) }}" method="POST" >

				@csrf
				@if( isset($category) )
			    @method('PATCH')
			  @endif


				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" required value="{{ @$category->name }}" class="form-control">
				</div>
				@if(!isset($category))
					<input type="hidden" name="parent_id" value="{{ $categoryId }}">
				@endif
				<hr />
				<button class="btn btn-success" type="submit">Save</button>

			</form>

		</div>
	</div>
</div>
@endsection