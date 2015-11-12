@extends('layouts.admin')

@section('titletext')
	Cabin
@endsection

@section('content')
	<div class="row">
		<form action="/admin/cabin/{{ $cabin->id }}" method="POST" role="form" enctype="multipart/form-data">
			@include('common.messages')
			@include('common.errors')
			<div class="col-md-4">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">General Info</h3>
					</div>
					<div class="box-body">
						{{ csrf_field() }}
						{{ method_field('put') }}
						<div class="form-group">
							<label for="name">Cabin name:</label>
							<div class="input-group">
								<input type="text" class="form-control"id="name" name="name" value="{{ $cabin->name }}"/>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<input type="file" id="cabin_image" name="cabin_image" />
								@if(!empty($cabin->image))
									<img src="{{ URL::to('/uploads')}}/{{ $cabin->image }}" width="300px" height="190px"/>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Cabin Info</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="size">Cabin capacity:</label>
							<div class="input-group">
								<input type="number" class="form-control" id="size" name="size" value="{{ $cabin->size }}"/>
							</div>
						</div>
						<div class="form-group">
							<label for="price">Cabin price:</label>
							<div class="input-group">
								<span class="input-group-addon">RM</span>
								<input type="number" class="form-control" id="price" name="price" step="any" value="{{ $cabin->price }}"/>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Cabin Promotion</h3>
					</div>
					<div class="box-body">
						
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Cabin description</h3>
	                </div><!-- /.box-header -->
                	<div class='box-body pad'>
                		<textarea class="textarea textarea-form" name="description">{{ $cabin->description }}</textarea>
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