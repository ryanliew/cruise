@extends('layouts.admin')

@section('titletext')
	Amenities
@endsection

@section('content')
	<div class="row">
		@include('common.messages')
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Amenity list</h3>
				</div>
				<div class="box-body table-responsive">
					<table id="amenities" class="table table-striped">
						<thead>
							<tr>
								<th>Amenity Name</th>
								<th>Amenity Price</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($amenities as $amenity)
								<tr>
									<td><a href="{{ URL::to('/') }}/admin/amenity/{{ $amenity->id }}">{{ $amenity->name }}</a></td>
									<td>{{ round($amenity->price,2) }}</td>
									<td>
										<form action="/admin/amenity/{{ $amenity->id }}" method="POST">
				                			{{ csrf_field() }}
				                			{{ method_field('delete') }}

				                			<button class="btn btn-danger">Delete Amenity</button>
				                		</form>
				                	</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>Amenity Name</th>
								<th>Amenity Price</th>
								<th>Actions</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('pagescript')
	<script src="{{ URL::to('/') }}/js/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="{{ URL::to('/') }}/js/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(function() {
			$('#amenities').dataTable({
				"bPaginate": true,
                "bLengthChange": false,
                "bFilter": false,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": false
			});
		});
	</script>
@endsection

@section('pagecss')
        <!-- DATA TABLES -->
        <link href="{{ URL::to('/') }}/css/admin/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@endsection