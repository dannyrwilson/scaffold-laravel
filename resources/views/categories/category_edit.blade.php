@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			@if(!isset($category))
				<h1>Add Category</h1>
			@else
				<h1>Edit Category "{{ $category->name }}"</h1>
			@endif
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