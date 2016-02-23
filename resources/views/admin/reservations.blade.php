@extends('layouts.admin')

@section('titletext')
Reservations
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
					<table id="reservations" class="table table-striped">
						<thead>
							<tr>
								<th>Order</th>
								<th>Cruise</th>
								<th>Cabin</th>
								<th>Order Date</th>
								<th>Price</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							@foreach($reservations as $reservation)
								<tr>
									<td><a href="{{ URL::to('/') }}/admin/reservation/{{ $reservation->id }}">Reservation #{{ $reservation->id }}</a></td>
									<td>{{ $reservation->cruise->name }}</td>
									<td>{{ $reservation->cabin->name }}</td>
									<td>{{ $reservation->created_at }}</td>
									<td>{{ number_format($reservation->price, 2, '.' , ',') }}</td>
									<td><span class="label bg-{{ $reservation->status()['color'] }}">{{ $reservation->status()['name']}}</span></td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>Order</th>
								<th>Cruise</th>
								<th>Cabin</th>
								<th>Order Date</th>
								<th>Price</th>
								<th>Status</th>
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
			$('#reservations').dataTable({
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