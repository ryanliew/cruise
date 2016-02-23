@extends('layouts.users')

@section('titletext')
	RCruise
@endsection

@section('content')
	<section class="banner">
		<!-- Background -->
		<div class="bg-parallax bg-1"></div>
		<div class="container">
			<div class="banner-cn">
    			<div class="logo-banner text-center">
    				<a href="{{URL::to('/')}}" title="">
                        <img src="images/logo-banner.png" alt="">
                    </a>
                </div>
                <!-- Logo -->
                <!-- Category Singer -->
                <div class="category-singer clearfix">
                    <div class="cate-singer-icon float-left">
                        <h2>Cruise</h2>
                        <span class="fa fa-ship"></span>
                    </div>
                    <p>Choose from all our <span>High Class</span> cruises worldwide</p>
                </div>
                <!-- End Category Singer -->
                <!-- Form Search -->
                <form method="POST" action="{{ URL::to('/cruises') }}">
                    {{ csrf_field() }}
        			<div class="form-cn form-cruise">
                        <h2>Where would you like to go?</h2>
                        <div class="form-search clearfix">
                            <div class="form-field field-select field-destination">
                                <div class="select">
                                    <span>Departing from:</span>
                                    <select name="depart">
                                        <option value="">Departing from</option>
                                        @foreach($departs as $depart)
                                            <option>{{ $depart->depart_location }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-field field-select field-destination">
                                <div class="select">
                                    <span>Destination:</span>
                                    <select name="arrive">
                                        <option value="">Destination</option>
                                        @foreach($locations as $location)
                                            <option>{{ $location->arrive_location }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-field field-select field-lenght">
                                <div class="select">
                                    <span>Size of Cruise</span>
                                    <select name="size">
                                        <option value="">Length of Cruise</option>
                                        <option>Normal</option>
                                        <option>Huge</option>
                                        <option>Extraordinary</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-field field-select field-month">
                                <div class="select">
                                    <span>Month</span>
                                    <select name="month">
                                        <option value="">Month</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-submit">
                                <button type="submit" class="awe-btn awe-btn-medium awe-search">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
                    <!-- End Form Search -->
            </div>
                <!-- End Banner Content -->
        </div>
    </section>
    <!-- Cruise Deals -->
    <section class="cruise-deals">
        <!-- Title -->
        <div class="title-wrap">
            <div class="container">
                <div class="travel-title float-left">
                    <h2>Last-Minute Cruise Deals: <br/><small><i>Departing in less than 3 days!</i></small></h2>
                </div>
                <a href="{{ URL::to('/cruises') }}" title="" class="awe-btn awe-btn-5 arrow-right awe-btn-lager text-uppercase float-right">ALL SALES</a>
            </div>
        </div>
        <!-- End Title -->
        <!-- Cruise Deals Content -->
        <div class="container">
            <div class="cruise-deals-cn clearfix">
            	@foreach($lastmincruises as $cruise)
            		<div class="col-xs-6 col-md-4 col-lg-3">
            			<div class="cruise-deal-item @if($cruise->hasDiscount()) sales-item @endif">
            				<figure class="cruise-img">
            					<a href="{{ URL::to('/') }}/cruise/{{ $cruise->id }}" title="">
            						<img src="uploads/{{ $cruise->image }}">
            					</a>
                                @if($cruise->hasDiscount())
                                    <figcaption>
                                        Save <span>{{ $cruise->promotion->discount }}</span>%
                                    </figcaption>
                                @endif
            				</figure>
            				<div class="cruise-text">
            					<div class="cruise-name">
            						<a href="{{ URL::to('/') }}/cruise/{{ $cruise->id }}">{{ $cruise->name }}</a>
            					</div>
            					<div class="cruise-night">
            						<span>{{ $cruise->duration() }} days</span> - {{ $cruise->shortdate() }}<br/>
                                    <span>{{ $cruise->depart_location }} - {{ $cruise->arrive_location }}</span>
            					</div>
            					<hr class="hr">
            					<div class="price-box">
                                    @if($cruise->hasDiscount())
                                        <span class="price old-price">Only <del>RM{{ $cruise->price, 2 }}</del></span>
                                    @endif
            						<span class="price special-price">RM{{ number_format($cruise->price(),2 ,'.', ',') }}
            					</div>
                            </div>
                        </div>
                    </div>
            	@endforeach
            </div>
        </div>
        <!-- End Cruise Deals Content -->
    </section>
    <!-- End Cruise Deals -->

    <!-- Confidence and Subscribe  -->
    <section class="confidence-subscribe no-bg">
        <div class="container">
            <div class="row cs-sb-cn">

                <!-- Confidence -->
                <div class="col-md-6">
                    <div class="confidence">
                        <h3>Cruise with confidence</h3>
                        <ul>
                            <li>
                                <span class="label-nb">01</span>
                                <h5>No booking charges</h5>
                                <p>We don't charge you an extra fee for booking a cruise cabin with us</p>
                            </li>
                            <li>
                                <span class="label-nb">02</span>
                                <h5>Top notch services</h5>
                                <p>We provide highest quality of services to everyone who cruise with us</p>
                            </li>
                            <li>
                                <span class="label-nb">03</span>
                                <h5>Instant confirmation</h5>
                                <p>Instant booking confirmation whether booking online or via the telephone</p>
                            </li>
                            <li>
                                <span class="label-nb">04</span>
                                <h5>Flexible booking</h5>
                                <p>You can book up to a whole year in advance until the moment of your stay</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End Confidence -->
                <!-- Subscribe -->
                <div class="col-md-6">
                    <div class="subscribe">
                        <h3>Subscribe to our newsletter</h3>
                        <p>Enter your email address and we’ll send you our regular promotional emails, packed with special offers, great deals, and huge discounts</p>
                        <!-- Subscribe Form -->
                        <div class="subscribe-form">
                            <form action="#" method="get">
                                <input type="text" name="" value="" placeholder="Your email" class="subscribe-input">
                                <button type="submit" class="awe-btn awe-btn-5 arrow-right text-uppercase awe-btn-lager">subcrible</button>
                            </form>
                        </div>
                        <!-- End Subscribe Form -->
                        <!-- Follow us -->
                        <div class="follow-us">
                            <h4>Follow us</h4>
                            <div class="follow-group">
                                <a href="http://facebook.com" title=""><i class="fa fa-facebook"></i></a>
                                <a href="http://twitter.com" title=""><i class="fa fa-twitter"></i></a>
                                <a href="http://pinterest.com" title=""><i class="fa fa-pinterest"></i></a>
                                <a href="http://linkedin.com" title=""><i class="fa fa-linkedin"></i></a>
                                <a href="http://instagram.com" title=""><i class="fa fa-instagram"></i></a>
                                <a href="http://plus.google.com" title=""><i class="fa fa-google-plus"></i></a>
                                <a href="http://digg.com/" title=""><i class="fa fa-digg"></i></a>
                            </div>
                        </div>
                        <!-- Follow us -->
                    </div>
                </div>
                <!-- End Subscribe -->

            </div>
        </div>
    </section>
    <!-- End Confidence and Subscribe  -->
@endsection