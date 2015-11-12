@extends('layouts.users')

@section('titletext')
	{{ $cruise->name }}
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
        <div class="main main-dt">
            <div class="container">
                <div class="main-cn detail-page bg-white clearfix">

                    <!-- Header Detail -->
                    <section class="head-detail">
                        <div class="head-dt-cn">
                            <div class="row">
                                <div class="col-sm-7">
                                    <h1>{{ $cruise->duration() }}-night | {{ $cruise->name }}</h1>
                                    <ul>
                                        <li><span>{{ $cruise->depart_location }} - {{ $cruise->arrive_location }}</span></li>
                                        <li>{{ $cruise->type }} Cruise</li>
                                        <li>{{ $cruise->date() }}</li>
                                    </ul>
                                </div>
                                <div class="col-sm-5 text-right">
                                    <p class="price-book">
                                        From<span>RM{{ $cruise->pricepernight() }}</span>/night
                                        <a href="" title="" class="awe-btn awe-btn-1 awe-btn-lager">Book Now</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- End Header Detail -->

                    <!-- Cruise Details -->
                    <section class="cruise-itinerary detail-cn" id="cruise-overview">
                        <div class="row">
                        
                            <div class="col-lg-3 detail-sidebar">
                                <!-- Cruise Itinerary Map -->
                                <h2 class="title-detail">Cruise details</h2>
                                <div id="itinerary-maps"><img src="{{ URL::to('/uploads') }}/{{ $cruise->image }}" alt="" width="305px" height="207px"></div>
                                <!-- End Cruise Itinerary Map -->
                            </div>
                            
                            <div class="col-lg-9 cruise-overview-cn">

                                <!-- Cruise Overview Content -->
                                <div class="cruise-overview-item">
                                    <h2 class="title-detail">Cruise Description</h2>
                                    <div class="text">
                                        <p>
                                            {!! $cruise->description !!}
                                        </p>
                                    </div>
                                </div>
                                <!-- End Cruise Overview Content -->
                            </div>
                        </div>

                    </section>
                    <!-- End Cruise Details -->

                    <!-- Cabin Type-->
                    <section class="cabin-type detail-cn" id="cabin-type">
                        <div class="row">
                            <div class="col-lg-3 detail-sidebar">
                                <div class="scroll-heading">
                                    <h2>Cabin type</h2>
                                    <hr class="hr">
                                    <a href="#cruise-overview" title="">Cruise overview</a>
                                    <a href="#amenities">Amenities</a>
                                </div>
                            </div>
                            <div class="col-lg-9 cabin-type-cn">
                                <h2 class="title-detail">Select a Cabin Type</h2>
                                <div class="responsive-table">
                                    <table class="table cabin-type-tabel table-radio">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Room Types</th>
                                                <th>Rate</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($cruise->cabins as $cabin)
                                            <tr>
                                                <td class="td-radio">
                                                    <div class="radio-checkbox">
                                                        <input type="radio" name="{{ $cabin->id }}" id="radio-01" class="radio">
                                                        <label for="radio-01"></label>
                                                    </div>
                                                </td>
                                                <td class="td-room">
                                                    <figure>
                                                        <img src="{{ URL::to('/uploads') }}/{{ $cabin->image }}" alt="" width="170px" height="180px">
                                                    </figure>
                                                    <h2>{{ $cabin->name }} </h2>
                                                    <p>
                                                        {!! $cabin->description !!}
                                                    </p>
                                                </td>
                                                <td class="t-price">
                                                    <div class="price-box">
                                                        <span class="price">From <ins>{{ number_format($cabin->price(), 2, '.', ',') }}</ins></span>
                                                        <span class="price night">{{ $cabin->pricepernight($cruise->duration()) }}/<small>night</small></span>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- End Cabin Type -->

                    <!-- Amenity Select-->
                    <section class="cabin-number detail-cn" id="amenities">
                        <div class="row">
                            <div class="col-lg-3 detail-sidebar">
                                <div class="scroll-heading">
                                    <h2>Amenities</h2>
                                    <hr class="hr">
                                    <a href="#cabin-type" title="">Cabin type</a>
                                    <a href="#cruise-overview" title="">Cruise overview</a>
                                </div>
                            </div>
                            <div class="col-lg-9 cabin-type-cn">
                            	<h2 class="title-detail">Select any amenities</h2>
                            	<div class="responsive-table">
                                    <table class="table cabin-type-tabel table-checkbox">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Amenity</th>
                                                <th>Rate</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($amenities as $amenity)
                                        		<tr>
                                        			<td class="td-checkbox">
	                                                    <div class="radio-checkbox">
	                                                        <input type="checkbox" name="amenity[{{ $amenity->id }}]" id="amenity-{{ $amenity->id }}" class="checkbox">
	                                                        <label for="amenity-{{ $amenity->id }}"></label>
	                                                    </div>
	                                                </td>
	                                                <td class="td-room">
                                                        <figure>
                                                            <img src="{{ URL::to('/uploads') }}/{{ $amenity->image }}" alt="" width="200px" height="160px">
                                                        </figure>
                                                        <h2>{{ $amenity->name }} </h2>
                                                        <p>
                                                            {!! $amenity->description !!}
                                                        </p>
	                                                </td>
	                                                <td class="t-price">
	                                                    <div class="price-box">
	                                                        <span class="price">Only <ins>RM{{ number_format($amenity->price(), 2, '.', ',') }}</ins></span></span>
	                                                    </div>
	                                                </td>
                                        		</tr>
                                        	@endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </section>

                    <section class="detail-footer cruise-detail-footer detail-cn">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-9 detail-footer-cn text-right">
                                <p class="price-book">
                                    From-<span>RM<span id="price-per-night">{{ $cruise->pricepernight() }}</span></span>/night
                                    <a href="" title="" class="awe-btn awe-btn-1 awe-btn-lager">Book Now</a>
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- End Main -->

@endsection