@extends('layouts.admin')

@section('titletext')
	Cruise
@endsection

@section('content')

	<form action="/admin/cruise/new" id="cruise" method="POST" role="form" enctype="multipart/form-data">
		<div class="row">
			@include('common.errors')
			@include('common.messages')
			<p class="alert alert-warning">You can assign promotion after creating the cruise</p>
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
								<input type="text" class="form-control" id="cruise-name" name="name"/>
							</div>
						</div>
						<div class="form-group">
							<label for="type">Cruise type:</label>
							<div class="input-group">
								<input type="text" class="form-control" id="cruise-type" name="type"/>
							</div>
						</div>
						<div class="form-group">
							<label for="price">Price:</label>
							<div class="input-group">
								<span class="input-group-addon">RM</span>
								<input type="number" class="form-control" id="price" name="price" step="any"/>
							</div>
						</div>
						<div class="form-group">
							<label for="image">Cruise image:</label>
							<div class="input-group">
								<input type="file" id="image" name="image" />
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
								<input type="text" class="form-control" id="depart-location" name="depart_location"/>
							</div>
						</div>
						<div class="form-group">
							<label for="arrive_location">Arrive at:</label>
							<div class="input-group">
								<input type="text" class="form-control" id="arrive-location" name="arrive_location"/>
							</div>
						</div>
						<div class="form-group">
							<label for="route_date">Route date:</label>
							<div class="input-group">
								<input type="text" class="form-control" id="routedate" name="route_date" />
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
									<input type="number" class="form-control" id="{{ $cabin->id }}-number" name="cabins[{{ $cabin->id }}]" />
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
			</div>
			<div class="col-md-12">
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">Cruise description</h3>
	                </div><!-- /.box-header -->
                	<div class='box-body pad'>
                		<textarea class="textarea textarea-form" name="description"></textarea>
                	</div>
                	<div class="box-footer">
                		<button type="submit" class="btn btn-primary">Submit</button>
                	</div>
				</div>
			</div>
		</div>
	</form>
@endsection

@section('pagescript')
	<script type="text/javascript">
		$(function() {
			$('#routedate').daterangepicker();
			$(".textarea").wysihtml5();
		});
	</script>
@endsection