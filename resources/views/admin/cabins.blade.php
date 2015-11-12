@extends('layouts.admin')

@section('titletext')
	Cabins
@endsection

@section('content')
	<div class="row">
		@include('common.messages')
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Cabin list</h3>
				</div>
				<div class="box-body table-responsive">
					<table id="cabins" class="table table-striped">
						<thead>
							<tr>
								<th>Cabin Name</th>
								<th>Cabin Size</th>
								<th>Cabin Price</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($cabins as $cabin)
								<tr>
									<td><a href="{{ URL::to('/admin/cabin') }}/{{ $cabin->id }}">{{ $cabin->name }}</a></td>
									<td>{{ $cabin->size }}</td>
									<td>{{ round($cabin->price,2) }}</td>
									<td><form action="/admin/cabin/{{ $cabin->id }}" method="POST">
				                			{{ csrf_field() }}
				                			{{ method_field('delete') }}

				                			<button class="btn btn-danger">Delete Cabin</button>
				                		</form>
				                	</td>
								</tr>
							@endforeach
						</tbody>
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
			$('#cabins').dataTable({
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
