@extends('layouts.admin')

@section('titletext')
	Reservation
@endsection

@section('content')
	<div class="row">
		<div class="col-md-4">
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">Reservation Info</h3>
				</div>
				<div class="box-body">
					<p>Reservation ID: #{{ $reservation->id }}</p>
					<p>Cruise: {{ $reservation->cruise->name }}</p>
					<p>Cabin: {{ $reservation->cabin->name }}</p>
					<p>Total: {{ number_format($reservation->price, 2, '.', ',') }}</p>
					<p>Status: <span class="label bg-{{ $reservation->status()['color'] }}">{{ $reservation->status()['name']}}</span></p>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">Cruise &amp; Cabin</h3>
				</div>
				<div class="box-body">
					<p>Depart : {{ $reservation->cruise->depart_location }}, {{ $reservation->cruise->depart_date }}</p>
					<p>Arrive : {{ $reservation->cruise->arrive_location }}, {{ $reservation->cruise->arrive_date }}</p>
					<p>Capacity: {{ $reservation->cruise->capacity() }}</p>
					<p>Type: {{ $reservation->cruise->type }}</p>
					<p>Cabin Size : {{ $reservation->cabin->size }}</p>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">Reserved Amenities</h3>
				</div>
				<div class="box-body">
					<ul>
					@foreach($reservation->amenities as $amenity)
						<li>{{ $amenity->name }}</li>
					@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<h3>Passengers Info</h3>
		@foreach($reservation->passengers as $key=>$passenger)
			<div class="col-md-4">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Passenger {{ $key+1 }}</h3>
					</div>
					<div class="box-body">
						<p>Full name: {{ $passenger->name }}</p>
	                    <p>Identification Number: {{ $passenger->identification }}</p>
	                    <p>Nationality: {{ $passenger->nationality }}</p>
						<p>Contact No: {{ $passenger->contact_no }}</p>
	                    <p>Gender: {{ $passenger->gender() }}</p>
					</div>
				</div>
			</div>
		@endforeach
	</div>
@endsection