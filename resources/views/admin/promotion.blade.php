@extends('layouts.admin')

@section('titletext')
	Promotion
@endsection

@section('content')
	<div class="row">
		<form action="/admin/promotion/new" id="promotion "method="POST" fole="form">
			@include('common.messages')
			@include('common.errors')
			<div class="col-md-6">
				<div class="box box-danger">
					<div class="box-header">
						<h3 class="box-title">Promotion Info</h3>
					</div>
					<div class="box-body">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="name">Name:</label>
							<div class="input-group">
								<input type="text" class="form-control" id="name" name="name"/>
							</div>
						</div>
						<div class="form-group">
							<label for="discount">Discount:</label>
							<div class="input-group">
								<input type="number" class="form-control" id="discount" name="discount"/>
								<span class="input-group-addon">%</span>
							</div>
						</div>
						<div class="form-group">
							<label for="type">Promotion type:</label>
							<div class="input-group">
								<select class="form-control" name="type" id="type">
									<option value="0">Please select...</option>
									<option value="1">Cruise Discount</option>
									<option value="2">Cabin Discount</option>
									<option value="3">Amenity Discount</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="promo_date">Promotion date:</label>
							<div class="input-group">
								<input type="text" class="form-control" id="promo-date" name="promo_date" />
							</div>
						</div>
						<div class="form-group">
							<label><input type="checkbox" id="manual"> I will like to control it manually</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12" id="promo-type-box">
						<div class="box box-danger">
							<div class="box-header">
								<h3 id="promo-type" class="box-title">Please select promotion type</h3>
							</div>
							<div class="box-body">
								<div id="cruise-select">
									<div class="form-group" >
										<select multiple name="cruises[]" class="form-control" >
											@foreach($cruises as $cruise)
												@if(empty($cruise->promotion))
												<option value="{{ $cruise->id }}">{{ $cruise->name }}</option>
												@endif
											@endforeach
										</select>
									</div>
								</div>
								<div id="cabin-select">
									<div class="form-group" id="cabin-select">
										<select multiple name="cabins[]" class="form-control">
											@foreach($cabins as $cabin)
												@if(empty($cabin->promotion))
												<option value="{{ $cabin->id }}">{{ $cabin->name }}</option>
												@endif
											@endforeach
										</select>
									</div>
								</div>
								<div id="amenity-select">
									<div class="form-group">
										<select multiple name="amenities[]" class="form-control" >
											@foreach($amenities as $amenity)
												@if(empty($amenity->promotion))
												<option value="{{ $amenity->id }}">{{ $amenity->name }}</option>
												@endif
											@endforeach
										</select>
									</div>
								</div>	
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="box box-danger">
							<div class="box-header">
								<h3 class="box-title">Promotion Image</h3>
							</div>
							<div class="box-body">
								<div class="form-group">
									<div class="input-group">
										<input type="file" id="image" name="image" />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="box box-danger">
					<div class="box-header">
						<h3 class="box-title">Promotion description</h3>
	                </div><!-- /.box-header -->
                	<div class='box-body pad'>
                		<textarea class="textarea textarea-form" name="description"></textarea>
                	</div>
                	<div class="box-footer">
                		<button type="submit" class="btn btn-primary">Submit</button>
                	</div>
				</div>
			</div>
		</form>
	</div>
@endsection

@section('pagescript')
	<script type="text/javascript">
		$(function() {
			$('#promo-date').daterangepicker();
			$(".textarea").wysihtml5();
			hideAll();
			$("#type").change(function(){
				hideAll();
				if($("#type").val() != '0')
				{
					switch($("#type").val())
					{
						case '1':
							$("#cruise-select").show();
							break;
						case '2':
							$("#cabin-select").show();
							break;
						case '3':
							$("#amenity-select").show();
					}

					document.getElementById("promo-type").innerHTML = "Please select " + $("#type option:selected").text().split(" ")[0];
				}
			});

			$('#manual').on('ifChecked', function(event){
				$("#promo-date").prop('disabled', true);
			});
			$('#manual').on('ifUnchecked', function(event){
				$("#promo-date").prop('disabled', false);
			});
		});

		function hideAll(){
			$("#cruise-select").hide();
			$("#cabin-select").hide();
			$("#amenity-select").hide();
		}

	</script>
@endsection