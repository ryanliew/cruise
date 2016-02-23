<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>RCruise | @yield('titletext')</title>
		<!-- Font Google -->
	</head>
	<body>
	    <div id="wrap">
	    	<!-- Header -->
	    	<header id="header" class="header">
	            <div class="container">
	                <!-- Logo -->
	                <div class="col-md-12 text-center">
	                    <a href="{{ URL::to('/') }}" title=""><img src="{{ URL::to('/images') }}/logo-header.png" alt=""></a>
	                </div>
	                <!-- End Logo -->
	                <!-- Bars -->
	                <!-- End Bars -->
	            </div>
	        </header>
	        <!-- End Header -->
	        <hr>
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
	</body>
</html>