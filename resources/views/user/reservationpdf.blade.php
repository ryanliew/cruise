@extends('layouts.pdf')

@section('titletext')
	Reservation
@endsection

@section('content')
        <!-- Main -->
        <div class="main">
            <div class="container">
                <div class="main-cn bg-white clearfix">
                    <!-- Payment Room -->
                    <div class="payment-room">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="payment-info">
                                    <h2>Your Reservation</h2>
                                    <ul>
                                        <li>
                                            <span>Cruise</span>
                                            {{ $cruise->name }}
                                        </li>
                                        <li>
                                            <span>Depart:</span>
                                            {{ $cruise->depart_location }}
                                        </li>
                                        <li>
                                            <span>Arrive:</span>
                                            {{ $cruise->arrive_location }}
                                        </li>
                                        <li>
                                            <span>Check-in:</span>
                                            {{ $cruise->depart_date}}
                                        </li>
                                        <li>
                                            <span>Check-out:</span>
                                            {{ $cruise->arrive_date}}
                                        </li>
                                        <li>
                                            <span>Stay:</span>
                                            {{ $cruise->duration() }} Nights, {{ $cabin->name }}, Max {{ $cabin->size }} Adult(s)
                                        </li>
                                        <li>
                                            <span>Cruise Type:</span>
                                            {{ $cruise->type }} Cruise
                                        </li>
                                    </ul>   
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="payment-price">

                                    <figure>
                                        <img src="{{ URL::to('/uploads') }}/{{ $cruise->image }}" alt="">
                                    </figure>
                                    <div class="total-trip">
                                        <span>
                                            1 Room x {{ $cruise->duration() }} Nights<br>
                                            RM{{ $cruise->pricepernight() }}<small>/night</small>
                                        </span>
                                       
                                        <p>
                                            Cruise Total: <ins>RM{{ number_format($cruise->price, 2, '.', ',') }}</ins>

                                            <i>Service charge 10% not included</i>
                                        </p>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                    <div class="payment-room">
	                    <div class="row">
	                    	<div class="col-md-12 table-responsive">
	                    		<h3>Extras</h3>
	                    		<table class="table table-striped text-center">
	                    			<thead>
	                    				<tr>
	                    					<td>Item</td>
	                    					<td></td>
	                    					<td>Quantity</td>
	                    					<td>Price</td>
	                    				</tr>
	                    			</thead>
	                    			<tbody>
	                    				<tr>
	                    					<td style="width:230px"><img src="{{ URL::to('/uploads')}}/{{ $cabin->image }}" width="220px" height="170px"/></td>
	                    					<td>{{ $cabin->name }}</td>
	                    					<td>1</td>
	                    					<td>RM{{ number_format($cabin->price, 2, '.', ',') }}</td>
	                    				</tr>
	                    				@foreach($amenities as $amenity)
	                    				<tr>
	                    					<td style="width:230px"><img src="{{ URL::to('/uploads')}}/{{ $amenity->image }}" width="220px" height="170px"/></td>
	                    					<td>{{ $amenity->name }}</td>
	                    					<td>{{ $cabin->size }}</td>
	                    					<td>RM{{ $amenity->price * $cabin->size }}</td>
	                    				</tr>
	                    				@endforeach
	                    			</tbody>
	                    		</table>
	                    		<div class="col-md-5 col-md-offset-7">
		                    		<table class="total table table-bordered">
		                    			<tr><td>Subtotal:</td><td>RM{{ number_format($reservation->price, 2, '.', ',') }}</td></tr>
		                    			<tr><td>Service Charge:</td><td> RM{{ number_format($reservation->price/10, 2, '.', ',') }}</td></tr>
		                    			<tr><td>Total :</td><td> <span>RM{{ number_format($reservation->total(), 2, '.', ',') }}</td></tr>
		                    		</table>
		                    	</div>
	                    	</div>
	                    </div>
                	</div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Passenger Info</h3>
                        </div>
                        @foreach($reservation->passengers as $key=>$passenger)
                            <div class="col-md-4">
                                <h5>Passenger {{ $key }}</h5>
                                <label>Full name:</label>
                                {{ $passenger->name }}
                                <label>Identification Number:</label>
                                {{ $passenger->identification }}
                                <label>Nationality:</label>
                                {{ $passenger->nationality }}
                                <label>Contact No:</label>
                                {{ $passenger->contact_no }}
                                <label>Gender:</label>
                                {{ $passenger->gender() }}
                            </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- End Main -->
@endsection