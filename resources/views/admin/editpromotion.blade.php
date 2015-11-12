@extends('layouts.admin')

@section('titletext')
	Promotion
@endsection

@section('content')
	<div class="row">
		<form action="/admin/promotion/{{ $promotion->id }}" id="promotion "method="POST" fole="form">
			@include('common.messages')
			@include('common.errors')
			<div class="col-md-6">
				<div class="box box-danger">
					<div class="box-header">
						<h3 class="box-title">Promotion Info</h3>
					</div>
					<div class="box-body">
						{{ csrf_field() }}
						{{ method_field('put') }}
						<div class="form-group">
							<label for="name">Name:</label>
							<div class="input-group">
								<input type="text" class="form-control" id="name" name="name" value="{{ $promotion->name }}"/>
							</div>
						</div>
						<div class="form-group">
							<label for="discount">Discount:</label>
							<div class="input-group">
								<input type="number" class="form-control" id="discount" name="discount" value="{{ $promotion->discount }}"/>
								<span class="input-group-addon">%</span>
							</div>
						</div>
						<div class="form-group">
							<label for="type">Promotion type:</label>
							<div class="input-group">
								<select class="form-control" name="type" id="type">
									<option value="0">Please select...</option>
									@for($i = 1; $i<4; $i++)
										<option value="{{ $i }}"
										@if($promotion->type === $i)
											selected
										@endif
										>
											<?php
												switch($i)
												{
													case 1:
														echo 'Cruise ';
														break;
													case 2:
														echo 'Cabin ';
														break;
													case 3:
														echo 'Amenity ';
														break;
												}
											?>
											Discount
										</option>
									@endfor
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="promo_date">Promotion date:</label>
							<div class="input-group">
								<input type="text" class="form-control" id="promo-date" name="promo_date" value="{{ $promotion->date() }}"/>
							</div>
						</div>
						<div class="form-group">
							<label><input type="checkbox" id="manual"> I will like to control it manually</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6" id="promo-type-box">
				<div class="box box-danger">
					<div class="box-header">
						<h3 id="promo-type" class="box-title">Please select promotion type</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<select multiple name="cruises[]" class="form-control" id="cruise-select">
								@foreach($cruises as $cruise)
									<option value="{{ $cruise->id }}" @if($cruise->promotion_id == $promotion->id)selected @endif>{{ $cruise->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<select multiple name="cabins[]" class="form-control" id="cabin-select">
								@foreach($cabins as $cabin)
									<option value="{{ $cabin->id }}" @if($cabin->promotion_id == $promotion->id)selected @endif>{{ $cabin->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<select multiple name="amenities[]" class="form-control" id="amenity-select">
								@foreach($amenities as $amenity)
									<option value="{{ $amenity->id }}" @if($amenity->promotion_id == $promotion->id)selected @endif>{{ $amenity->name }}</option>
								@endforeach
							</select>
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
			$('#promo-date').daterangepicker();
			$(".textarea").wysihtml5();
			hideAll();
			if( "<?php echo $promotion->start_date; ?>" == "0000-00-00")
			{
				$('#manual').iCheck('check');
				$("#promo-date").prop('disabled', true);
			}
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
		}

	</script>
@endsection