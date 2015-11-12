@extends('layouts.admin')

@section('titletext')
Promotions
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
					<table id="promotions" class="table table-striped">
						<thead>
							<tr>
								<th>Promotion Name</th>
								<th>Promotion Type</th>
								<th>Discount</th>
								<th>Date</th>
								<th>Applied count</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($promotions as $promotion)
								<tr>
									<td><a href="{{ URL::to('/') }}/admin/promotion/{{ $promotion->id }}">{{ $promotion->name }}</a></td>
									<td>{{ $promotion->type() }}</td>
									<td>{{ round($promotion->discount, 2) }}%</td>
									<td>{{ $promotion->date() }}</td>
									<td>{{ $promotion->appliedCount() }}
									<td><span class="badge bg-{{ $promotion->status()['color'] }}">{{ $promotion->status()['name']}}</span></td>
									<td>
										<form action="/admin/promotion/{{ $promotion->id }}" method="POST">
				                			{{ csrf_field() }}
				                			{{ method_field('delete') }}

				                			<button class="btn btn-danger">Delete Promotion</button>
				                		</form>
				                	</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>Promotion Name</th>
								<th>Promotion Type</th>
								<th>Discount</th>
								<th>Date</th>
								<th>Applied count</th>
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
			$('#promotions').dataTable({
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