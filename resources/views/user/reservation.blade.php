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
        <form action="makepayment" method="post">
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
                            <!-- End Step -->
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
                        <!-- Passengers details -->
                        <div class="review-detail-cn">
                            <div class="review-tabs">
                                <ul class="tabs-head nav-tabs-one">
                                    @for($i = 1; $i <= $cabin->size;$i++)
                                    <li @if($i==1) class="active" @endif><a data-toggle="tab" href="#passenger{{ $i }}">Passenger {{ $i }}</a></li>
                                    @endfor
                                </ul>

                                <div class="tab-content">
                                    @if($reservation->status == 0)
                                        @for($i = 1; $i <= $cabin->size;$i++)
                                        <div id="passenger{{ $i }}" class="tab-pane fade in @if($i==1)active @endif">
                                            <div class="review-tabs-cn user-form">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="field-input">
                                                            <label>Full name: <span class="required">*</span></label>
                                                            <input type="text" class="input-text" name="passengername[]" required>
                                                        </div>
                                                        <div class="field-input">
                                                            <label>Identification Number: <span class="required">*</span></label>
                                                            <input type="text" class="input-text" placeholder="Identification Card Number/Passport Number" name="passengeridentification[]" required>
                                                        </div> 
                                                        <div class="field-input">
                                                            <label>Nationality: <span class="required">*</span></label>
                                                            <input type="text" class="input-text" name="passengernationality[]" required>
                                                        </div> 
                                                        <div class="field-input">
                                                            <label>Contact No: <span class="required">*</span></label>
                                                            <input type="text" class="input-text" name="passengercontact[]" required>
                                                        </div> 
                                                        <div class="field-input">
                                                            <label>Gender: <span class="required">*</span></label>
                                                            <select name="passengergender[]">
                                                                <option value="0">Male</option>
                                                                <option value="1">Female</option>
                                                            </select>
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endfor
                                    @else
                                        @foreach($reservation->passengers as $key=>$passenger)
                                        <div id="passenger{{ $key+1 }}" class="tab-pane fade in @if($key==0)active @endif">
                                            <div class="review-tabs-cn user-form">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="field-input">
                                                            <label>Full name:</label>
                                                            {{ $passenger->name }}
                                                        </div>
                                                        <div class="field-input">
                                                            <label>Identification Number:</label>
                                                            {{ $passenger->identification }}
                                                        </div> 
                                                        <div class="field-input">
                                                            <label>Nationality:</label>
                                                            {{ $passenger->nationality }}
                                                        </div> 
                                                        <div class="field-input">
                                                            <label>Contact No:</label>
                                                            {{ $passenger->contact_no }}
                                                        </div> 
                                                        <div class="field-input select">
                                                            <label>Gender:</label>
                                                            {{ $passenger->gender() }}
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div> 
                        <div class="submit text-center">
                            @if($reservation->status == 0)
                            <p>
                                By selecting to complete this booking I acknowledge that I have read and accept the <span>rules &amp; restrictions terms &amp; conditions</span> , and <span>privacy policy</span>.
                            </p>
                            
                            {{ csrf_field() }}
                            <input type="hidden" name="cruise_id" value="{{ $cruise->id }}" />
                            <input type="hidden" name="cruise_name" value="{{ $cruise->name }} Cruise"/>
                            <input type="hidden" name="total" value="{{ $reservation->total() }}" />
                            <input type="hidden" name="description" value="{{ $cruise->duration() . ' nights | ' . $cruise->shortdate() . ' | ' . $cruise->depart_location . '-' . $cruise->arrive_location }} " />
                            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}" />
                            <input type="submit" class="awe-btn awe-btn-1 awe-btn-lager" value="Pay &amp; Book now" />
                            @elseif($reservation->status == 1)
                                <a href="{{ URL::to('/reservation/download') }}/{{ $reservation->id }}" class="awe-btn awe-btn-1 awe-btn-lager">Print My Reservation</a>

                        </div>

                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </form>
        <!-- End Main -->
@endsection