<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>RCruise | @yield('titletext')</title>
		<!-- Font Google -->
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400%7COpen+Sans:300,400,600' rel='stylesheet' type='text/css'>
		<!-- End Font Google -->
	    <!-- Library CSS -->
	    <!-- font Awesome -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-k2/8zcNbxVIh5mnQ52A0r3a6jAgMGxFJFE2707UxGCk= sha512-ZV9KawG2Legkwp3nAlxLIVFudTauWuBpC10uEafMHYL0Sarrz5A7G79kXh5+5+woxQ5HM559XX2UZjMJ36Wplg==" crossorigin="anonymous">
	    <!-- bootstrap 3.0.2 -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	    <link rel="stylesheet" href="{{URL::to('/')}}/css/user/library/jquery-ui.min.css">
	        <link rel="stylesheet" href="{{URL::to('/')}}/css/user/library/owl.carousel.css">
	    <link rel="stylesheet" href="{{URL::to('/')}}/css/user/library/jquery.mb.YTPlayer.min.css">
	    <!-- End Library CSS -->
	    <link rel="stylesheet" href="{{URL::to('/')}}/css/user/style.css">
	    @yield('pagecss')
	</head>
	<body>
		<!-- Preloader -->
	    <div id="preloader">
	        <div class="tb-cell">
	            <div id="page-loading">
	                <div></div>
	                <p>Cruising</p>
	            </div>
	        </div>
	    </div>
	    <div id="wrap">
	    	<!-- Header -->
	    	<header id="header" class="header">
	            <div class="container">
	                <!-- Logo -->
	                <div class="logo float-left">
	                    <a href="{{ URL::to('/') }}" title=""><img src="{{ URL::to('/images') }}/logo-header.png" alt=""></a>
	                </div>
	                <!-- End Logo -->
	                <!-- Bars -->
	                <div class="bars" id="bars"></div>
	                <!-- End Bars -->

	                <!--Navigation-->
	                <nav class="navigation nav-c" id="navigation" data-menu-type="1200">
	                    <div class="nav-inner">
	                        <a href="#" class="bars-close" id="bars-close">Close</a>
	                        <div class="tb">
	                            <div class="tb-cell">
	                                <ul class="menu-list text-uppercase">
	                                    <li>
	                                        <a href="{{ URL::to('/') }}" title="">Home</a>
	                                    </li>
	                                    <li>
	                                    	<a href="{{ URL::to('/') }}/about" title="">About</a>
	                                        <ul class="sub-menu">	                                            
	                                            <li>
	                                                <a href="#" title="">User</a>
	                                                <ul class="sub-menu">
	                                                    <li>
	                                                        <a href="user-booking.html" title="">User Booking</a>
	                                                    </li>
	                                                    <li>
	                                                        <a href="user-profile.html" title="">User Profile</a>
	                                                    </li>
	                                                    <li>
	                                                        <a href="user-setting.html" title="">User Setting</a>
	                                                    </li>
	                                                    <li>
	                                                        <a href="user-review.html" title="">User Review</a>
	                                                    </li>
	                                                    <li>
	                                                        <a href="user-signup.html" title="">User Signup</a>
	                                                    </li>
	                                                </ul>
	                                            </li>
	                                            <li><a href="payment.html" title="">Payment</a></li>
	                                        </ul>
	                                    </li>
	                                    <li class="current-menu-parent">
	                                        <a href="#" title="">Cruises</a>
	                                        <ul class="sub-menu">
	                                            <li class="current-menu-item">
	                                                <a href="home-cruise.html" title="">Cruises</a>
	                                            </li>
	                                            <li>
	                                                <a href="cruise-list.html">Cruise List</a>
	                                            </li>
	                                            <li>
	                                                <a href="cruise-detail.html">Cruise Detail</a>
	                                            </li>
	                                        </ul>
	                                    </li>
	                                    <li><a href="contact.html" title="">Contact</a></li>
	                                </ul>
	                            </div>
	                        </div>
	                    </div>
	                </nav>
	                <!--End Navigation-->
	            </div>
	        </header>
	        <!-- End Header -->

	        @yield('content')

	        <footer>
	            <div class="container">
	                <div class="row">
	                    <!-- Logo -->
	                    <div class="col-md-12 text-center">
	                        <div class="logo-foter">
	                            <a href="{{ URL::to('/') }}" title=""><img src="{{ URL::to('/images') }}/logo-footer.png" alt=""></a>
	                        </div>
	                        <span style="color:white;padding-top: 5px;display:block;">© 2015 RCruise™ All rights reserved.</span>
	                    </div>
	                    <!-- End Logo -->

	                    </div>
	                    <!-- End Footer Currency, Language -->
	                </div>
	            </div>
	        </footer>
	        <!-- End Footer -->
	    </div>

	    <!-- Library JS -->
	    <script type="text/javascript" src="{{URL::to('/')}}/js/user/library/jquery-1.11.0.min.js"></script>
	    <script type="text/javascript" src="{{URL::to('/')}}/js/user/library/jquery-ui.min.js"></script>
	    <script type="text/javascript" src="{{URL::to('/')}}/js/user/library/jquery-ui.min.js"></script>
	    <!-- Bootstrap -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha256-Sk3nkD6mLTMOF0EOpNtsIry+s1CsaqQC1rVLTAy+0yc= sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
	    <script type="text/javascript" src="{{URL::to('/')}}/js/user/library/owl.carousel.min.js"></script>
	    <script type="text/javascript" src="{{URL::to('/')}}/js/user/library/parallax.min.js"></script>
	    <script type="text/javascript" src="{{URL::to('/')}}/js/user/library/jquery.nicescroll.js"></script>
	    <script type="text/javascript" src="{{URL::to('/')}}/js/user/library/jquery.ui.touch-punch.min.js"></script>
	    <script type="text/javascript" src="{{URL::to('/')}}/js/user/library/jquery.mb.YTPlayer.min.js"></script>
	    <script type="text/javascript" src="{{URL::to('/')}}/js/user/library/SmoothScroll.js"></script>
	    <!-- End Library JS -->
	    <!-- Main Js -->
	    <script type="text/javascript" src="{{URL::to('/')}}/js/user/script.js"></script>
	    <!-- End Main Js -->
	    @yield('pagejs')
	</body>
</html>