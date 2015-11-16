@extends('layouts.users')

@section('titletext')
	Reservation
@endsection

@section('content')
	<!--Banner-->
        <section class="sub-banner">
            <!--Background-->
            <div class="bg-parallax bg-2"></div>
            <!--End Background-->
            <!-- Logo -->
            <div class="logo-banner text-center">
                <a href="" title="">
                    <img src="images/logo-banner.png" alt="">
                </a>
            </div>
            <!-- Logo -->
        </section>
        <!--End Banner-->

        <!-- Main -->
        <div class="main">
            <div class="container">
                <div class="main-cn bg-white clearfix">
                    @include('common.errors')
                    @include('common.messages')
                    <div class="step">
                        <!-- Step -->
                        <ul class="payment-step text-center clearfix">
                            <li class="step-select">
                                <span>1</span>
                                <p>Pick Cabins &amp; Amenities</p>
                            </li>
                            <li @if($reservation->status == 0) class="step-part" @elseif($reservation->status == 1) class="step-select" @endif>
                                <span>2</span>
                                <p>Review Booking &amp; Payment Details</p>
                            </li>
                            <li @if($reservation->status == 1) class="step-select" @endif>
                                <span>3</span>
                                <p>Booking Completed!</p>
                            </li>
                        </ul>
                        <!-- ENd Step -->
                    </div>
                    <!-- Payment Room -->
                    <div class="payment-room">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="payment-info">
                                    <h2>{{ $cruise->name }}</h2>
                                    <ul>
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
                    <!-- Payment Room -->

                    <div class="payment-form">
                        <div class="row form">
                            <div class="col-md-6">
                                <h2>Your Information</h2>
                                <div class="form-field">
                                    <input type="text" placeholder="First Name" class="field-input" value="{{ Auth::user()->first_name }}">
                                </div>
                                <div class="form-field">
                                    <input type="text" placeholder="Last Name" class="field-input" value="{{ Auth::user()->last_name }}">
                                </div>
                                <div class="form-field">
                                    <input type="text" placeholder="Email" class="field-input" value="{{ Auth::user()->email }}">
                                </div>
                                <div class="form-field">
                                    <input type="text" placeholder="Phone number" class="field-input" value="{{ Auth::user()->contact_no }}">
                                </div>
                                <div class="form-field">
                                    <input type="text" placeholder="Country" class="field-input" value="{{ Auth::user()->country }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h2>Your payment details</h2>
                                <span>Select Payment Method <img src="images/icon-payment.png" alt=""></span>
                                <ul>
                                    <li>
                                        <div class="radio-checkbox">
                                            <input type="radio" name="radio-1" id="radio-1" class="radio">
                                            <label for="radio-1">Visa</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio-checkbox">
                                            <input type="radio" name="radio-1" id="radio-2" class="radio">
                                            <label for="radio-2">MasterCard</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio-checkbox">
                                            <input type="radio" name="radio-1" id="radio-3" class="radio">
                                            <label for="radio-3">JCB</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio-checkbox">
                                            <input type="radio" name="radio-1" id="radio-4" class="radio">
                                            <label for="radio-4">American Express</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio-checkbox">
                                            <input type="radio" name="radio-1" id="radio-5" class="radio">
                                            <label for="radio-5">PayPal</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio-checkbox">
                                            <input type="radio" name="radio-1" id="radio-6" class="radio">
                                            <label for="radio-6">Carte Bleue</label>
                                        </div>
                                    </li>

                                </ul>
                                <div class="row">
                                    <div class="col-sm-6 col-md-12 col-lg-6 cart-number">

                                        <label>Card Number</label>

                                        <div class="row">

                                            <div class="col-xs-3">
                                                <div class="form-field">
                                                    <input type="text" class="field-input">
                                                </div>
                                            </div>

                                            <div class="col-xs-3">
                                                <div class="form-field">
                                                    <input type="text" class="field-input">
                                                </div>
                                            </div>

                                            <div class="col-xs-3">
                                                <div class="form-field">
                                                    <input type="text" class="field-input">
                                                </div>
                                            </div>

                                            <div class="col-xs-3">
                                                <div class="form-field">
                                                    <input type="text" class="field-input">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-6 col-md-12 col-lg-6 card-holder">
                                        <label>Card Holder Name</label>
                                        <div class="form-field">
                                            <input type="text" class="field-input">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-12 col-lg-6 expiry-date">
                                        <label>Expiry Date</label>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="form-field">
                                                    <input type="text" class="field-input calendar-input">
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-field">
                                                    <input type="text" class="field-input calendar-input">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-12 col-lg-6 cvc-code">
                                        <label>CVC-code</label>
                                        <div class="form-field">
                                            <input type="text" class="field-input">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                        </div>

                        <div class="submit text-center">
                            <p>
                                By selecting to complete this booking I acknowledge that I have read and accept the <span>rules &amp; restrictions terms &amp; conditions</span> , and <span>privacy policy</span>.
                            </p>
                            @if($reservation->status == 0)
                            <form action="makepayment" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="cruise_name" value="{{ $cruise->name }} Cruise"/>
                                <input type="hidden" name="total" value="{{ $reservation->total() }}" />
                                <input type="hidden" name="description" value="{{ $cruise->duration() . ' nights | ' . $cruise->shortdate() . ' | ' . $cruise->depart_location . '-' . $cruise->arrive_location }} " />
                                <input type="hidden" name="reservation_id" value="{{ $reservation->id }}" />
                                <input type="submit" class="awe-btn awe-btn-1 awe-btn-lager" value="Pay &amp; Book now" />
                            </form>
                            @elseif($reservation->status == 1)
                            <form action="printreservation" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="reservation" value="{{ $reservation->id }}"/>
                                <input type="submit" class="awe-btn awe-btn-1 awe-btn-lager" value="Print My Reservation" />
                            </form>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Main -->
@endsection