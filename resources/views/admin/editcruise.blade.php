@extends('layouts.admin')

@section('titletext')
	Cruise
@endsection

@section('content')

	<div class="row">
		<form action="/admin/cruise/{{ $cruise->id }}" method="POST" role="form" enctype="multipart/form-data">
			@include('common.messages')
			@include('common.errors')
			{{ method_field('put') }}
			<div class="col-md-4">
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">General Info</h3>
					</div>
					<div class="box-body">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="name">Name:</label>
							<div class="input-group">
								<input type="text" class="form-control" id="cruise-name" name="name" value="{{ $cruise->name }}"/>
							</div>
						</div>
						<div class="form-group">
							<label for="type">Cruise type:</label>
							<div class="input-group">
								<input type="text" class="form-control" id="cruise-type" name="type" value="{{ $cruise->type }}"/>
							</div>
						</div>
						<div class="form-group">
							<label for="price">Price:</label>
							<div class="input-group">
								<span class="input-group-addon">RM</span>
								<input type="number" class="form-control" id="price" name="price" step="any" value="{{ $cruise->price }}"/>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<input type="file" id="image" name="image" />
								@if(!empty($cruise->image))
									<img src="{{ URL::to('/uploads')}}/{{ $cruise->image }}" width="300px" height="190px"/>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">Cruise route</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="depart_location">Depart from:</label>
							<div class="input-group">
								<input type="text" class="form-control" id="depart-location" name="depart_location" value="{{ $cruise->depart_location }}"/>
							</div>
						</div>
						<div class="form-group">
							<label for="arrive_location">Arrive at:</label>
							<div class="input-group">
								<input type="text" class="form-control" id="arrive-location" name="arrive_location" value="{{ $cruise->arrive_location }}"/>
							</div>
						</div>
						<div class="form-group">
							<label for="route_date">Route date:</label>
							<div class="input-group">
								<input type="text" class="form-control" id="routedate" name="route_date" value="{{ $cruise->date() }}"/>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">Cruise cabins</h3>
					</div>
					<div class="box-body">
						@foreach($cabins as $cabin)
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">{{ $cabin->name }}</div>
									<input type="number" class="form-control" id="{{ $cabin->id }}-number" name="cabins[{{ $cabin->id }}]" @if(isset($withcabin[$cabin->id]))value="{{ $withcabin[$cabin->id]}}" @endif
									 />
								</div>
							</div>
						@endforeach
					</div>
					<div class="box-footer">
						<h3 class="box-title">Cruise Promotion</h3>
						Promotion:<br/>
						Discount:
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">Cruise description</h3>
	                </div><!-- /.box-header -->
                	<div class='box-body pad'>
                		<textarea class="textarea textarea-form" name="description">{{ $cruise->description }}</textarea>
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
			$('#routedate').daterangepicker();
			$(".textarea").wysihtml5();
		});
	</script>
@endsection