@extends('layouts.admin')

@section('titletext')
Users
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
					<table id="users" class="table table-striped">
						<thead>
							<tr>
								<th></th>
								<th>Name</th>
								<th>Date of Birth</th>
								<th>Email</th>
								<th>Total Spendings</th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
								<tr>
									<td><img src="{{ URL::to('/') }}/uploads/{{ $user->image }}" class="img-circle" width="50px"/></td>
									<td>{{ $user->name() }}</td>
									<td>{{ $user->date_of_birth }}</td>
									<td>{{ $user->email }}</td>
									<td>{{ number_format($user->spending(), 2, '.' , ',') }}</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th></th>
								<th>Name</th>
								<th>Date of Birth</th>
								<th>Email</th>
								<th>Total Spendings</th>
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
			$('#users').dataTable({
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