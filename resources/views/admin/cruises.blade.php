@extends('layouts.admin')

@section('titletext')
Cruises
@endsection

@section('content')
	<div class="row">
		@include('common.messages')
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Cruise list</h3>
				</div>
				<div class="box-body table-responsive">
					<table id="cruises" class="table table-striped">
						<thead>
							<tr>
								<th>Cruise Name</th>
								<th>Cruise Type</th>
								<th>Cruise Price</th>
								<th>Date</th>
								<th>Depart Location</th>
								<th>Arrive Location</th>
								<th>Capacity</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($cruises as $cruise)
								<tr>
									<td><a href="{{ URL::to('/') }}/admin/cruise/{{ $cruise->id }}">{{ $cruise->name }}</a></td>
									<td>{{ $cruise->type }}</td>
									<td>{{ round($cruise->price, 2) }}</td>
									<td>{{ $cruise->date() }}</td>
									<td>{{ $cruise->depart_location }}</td>
									<td>{{ $cruise->arrive_location }}</td>
									<td>{{ $cruise->capacity() }}
									<td><span class="badge bg-{{ $cruise->status()['color'] }}">{{ $cruise->status()['name']}}</span></td>
									<td>
										<form action="/admin/cruise/{{ $cruise->id }}" method="POST">
				                			{{ csrf_field() }}
				                			{{ method_field('delete') }}

				                			<button class="btn btn-danger">Delete Cruise</button>
				                		</form>
				                	</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>Cruise Name</th>
								<th>Cruise Type</th>
								<th>Cruise Price</th>
								<th>Date</th>
								<th>Depart Location</th>
								<th>Arrive Location</th>
								<th>Capacity</th>
								<th>Status</th>
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
			$('#cruises').dataTable({
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