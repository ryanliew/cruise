@extends('layouts.admin')

@section('titletext')
	Amenity
@endsection

@section('content')
		<div class="row">
		<form action="/admin/amenity/{{ $amenity->id }}" id="amenity" method="POST" role="form" enctype="multipart/form-data">
			@include('common.errors')
			@include('common.messages')
			<div class="col-md-6">
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">General Info</h3>
					</div>
					<div class="box-body">
						{{ csrf_field() }}
						{{ method_field('put') }}
						<div class="form-group">
							<label for="name">Name:</label>
							<div class="input-group">
								<input type="text" class="form-control" id="cruise-name" name="name" value="{{ $amenity->name }}"/>
							</div>
						</div>
						<div class="form-group">
							<label for="image">Amenity image:</label>
							<input type="file" id="image" name="image"/>
							@if(!empty($amenity->image))
								<img src="{{ URL::to('/uploads')}}/{{ $amenity->image }}" width="300px" height="190px"/>
							@endif
						</div>
						<div class="form-group">
							<label for="price">Price:</label>
							<div class="input-group">
								<span class="input-group-addon">RM</span>
								<input type="number" class="form-control" id="price" name="price" step="any" value="{{ $amenity->price }}"/>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">Promotions</h3>
					</div>
					<div class="box-body">
						
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">Amenity description</h3>
	                </div><!-- /.box-header -->
                	<div class='box-body pad'>
                		<textarea class="textarea textarea-form" name="description">{{ $amenity->description}}</textarea>
                	</div>
                	<div class="box-footer">
                		<button type="submit" class="btn btn-primary">Update</button>
                	</div>
				</div>
			</div>
		</form>
	</div>
@endsection

@section('pagescript')
	<script type="text/javascript">
		$(function() {
			$(".textarea").wysihtml5();
		});
	</script>
@endsection