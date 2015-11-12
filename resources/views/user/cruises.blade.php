@extends('layouts.users')

@section('titletext')
Cruises
@endsection

@section('content')
	<!--Banner-->
    <section class="sub-banner">
        <!--Background-->
        <div class="bg-parallax bg-2"></div>
        <!--End Background-->
        <!-- Logo -->
        <div class="logo-banner text-center">
            <a href="{{URL::to('/')}}" title="">
                <img src="images/logo-banner.png" alt="">
            </a>
        </div>
        <!-- Logo -->
    </section>
    <!--End Banner-->
    <!-- Main -->
    <div class="main">
        <div class="container">
            <div class="main-cn cruise-page bg-white clearfix">
                <div class="row">

                <!-- Cruise Right -->
                <div class="col-lg-9 col-lg-push-3">

                    <section class="cruise-list">

                        <!-- Cruise Content -->
                        <div class="cruise-list-cn">
                            <!-- Item -->
                            @foreach($cruises as $cruise)
                            	<div class="cruise-item">
	                                <figure class="cruise-img">
	                                    <a href="{{ URL::to('/cruise') }}/{{ $cruise->id }}">
	                                        <img width="222px" height="147px" src="{{ URL::to('/uploads') }}/{{ $cruise->image }}" alt="">
	                                    </a>
	                                </figure>
	                                <div class="cruise-text">
	                                    <div class="cruise-name">
	                                        <a href="{{ URL::to('/cruise') }}/{{ $cruise->id }}">{{ $cruise->duration() }} - Night | {{ $cruise->depart_location }} - {{ $cruise->arrive_location }}</a>
	                                    </div>
	                                    <ul class="ship-port">
	                                        <li>
	                                            <span class="label">Ship:</span>
	                                            {{ $cruise->name }}
	                                        </li>
	                                        <li>
	                                            <span class="label">Cruise type:</span>
	                                            {{ $cruise->type }}
	                                        </li>
	                                        <li>
	                                        	<span class="label">Capacity:</span>
	                                        	{{ $cruise->capacity() }}
	                                        </li>
	                                    </ul>
	                                    <div class="price-box">
	                                        <span class="price">
	                                            From<br>
	                                            <ins>{{ number_format($cruise->price(), 2, ".", ",") }}</ins>
	                                        </span>
	                                        <span class="price night">
	                                            <ins>RM{{ $cruise->pricepernight() }}</ins><small>/night</small>
	                                        </span>
	                                    </div>
	                                </div>
	                            </div>
                            @endforeach
                        </div>
                        <!-- End Cruise Content -->

                        <div class="page-navigation-cn">
                            {!! $cruises->render() !!}
                        </div>

                    </section>
                </div>
                <!-- End Cruise Right -->

                <!-- Sidebar Hotel -->
                <div class="col-lg-3 col-lg-pull-9">
                    <!-- Sidebar Content -->
                    <div class="sidebar-cn">
                        <!-- Search Result -->
                        <div class="search-result">
                            <p>
                                We found <br>
                                <ins>{{ $cruises->total() }}</ins> <span>cruises that matches</span>
                            </p>
                        </div>
                        <!-- End Search Result -->
                        <!-- Search Form Sidebar -->
                        <div class="search-sidebar">
                            <div class="row">
                                <form method="POST" action="{{ URL::to('/cruises') }}">
                                    {{ csrf_field() }}
                                    <div class="form-search clearfix">
                                        <div class="form-field field-select col-md-12">
                                        	<div class="select">
                                        		<span>Departing from</span>
                                        		<select name="depart">
                                                    <option value="">Depart from</option>
    			                                    @foreach($departs as $depart)
    			                                        <option>{{ $depart->depart_location }}</option>
    			                                    @endforeach
    			                                </select>
                                        	</div>
                                        </div>
                                        <div class="form-field field-select col-md-12">
                                        	<div class="select">
                                        		<span>Destination</span>
                                        		<select name="arrive">
                                                    <option value="">Destinations</option>
    			                                    @foreach($locations as $location)
    			                                        <option>{{ $location->arrive_location }}</option>
    			                                    @endforeach
    			                                </select>
                                        	</div>
                                        </div>
                                        <div class="form-field field-select col-md-12">
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
                                        <div class="form-field field-select col-md-12">
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
                                        <div class="form-submit col-md-12">
                                            <button type="submit" class="awe-btn awe-btn-medium awe-search">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End Search Form Sidebar -->
                    </div>
                    <!-- End Sidebar Content -->
                </div>
                <!-- End Sidebar Hotel -->
                
                </div>

            </div>
        </div>
    </div>
@endsection