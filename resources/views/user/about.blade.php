@extends('layouts.users')

@section('titletext')
    About
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
                <div class="main-cn about-page bg-white clearfix">

                    <!-- Breakcrumb -->
                    <section class="breakcrumb-sc">
                        <ul class="breadcrumb arrow">
                            <li><a href="index.html"><i class="fa fa-home"></i></a></li>
                            <li>About us</li>
                        </ul>
                    </section>
                    <!-- End Breakcrumb -->
                    <!-- About -->
                    <section class="about-cn clearfix">
                        <div class="about-searved">
                            <span>Served over</span>
                            <ins>584,000</ins>
                            <span>people in 45 countries</span>
                        </div>
                        <div class="about-text">
                            <h1>Our Gold Anchor Service</h1>
                            <div class="about-description">
                                <p>
                                    For the 12th year running, we have been recognized as the Best Cruise Line Overall and the Best Cruise Line in the Caribbean by Travel Weekly readers. Awarded this year by Cruise Critic for three Editors' Picks: Best for Families, Best Entertainment, and Best Suites. Our unique style of service will enhance every aspect of your cruise. No matter where you are – the pool, the dining room, the spa or your room – get ready to be wowed! And we deliver it 24 hours a day. This is way beyond normal service. This is Gold Anchor Service.
                                </p>
                            </div>
                        </div>
                    </section>
                    <!-- End About -->
                    <!-- Twitter -->
                    <section class="twitter">
                        <div class="bg-parallax bg-1"></div>
                        <div class="twitter-cn text-center" style="padding-top:300px">

                        </div>
                    </section>
                    <!-- End Twitter -->
                    <!-- Team -->
                    <section class="team">
                        <div class="team-head">
                            <h2>Our awards</h2>
                        </div>
                        <div class="team-group row">
                            <!-- Team Item -->
                            <div class="team-item col-xs-6 col-md-3">
                                <figure>
                                    <img src="{{ URL::to('/images') }}/team/img-1.png" alt="">
                                </figure>
                            </div>
                            <!-- End Team Item -->
                            <!-- Team Item -->
                            <div class="team-item col-xs-6 col-md-3">
                                <figure>
                                    <img src="{{ URL::to('/images') }}/team/img-2.png" alt="">
                                </figure>
                            </div>
                            <!-- End Team Item -->
                            <!-- Team Item -->
                            <div class="team-item col-xs-6 col-md-3">
                                <figure>
                                    <img src="{{ URL::to('/images') }}/team/img-3.png" alt="">
                                </figure>
                            </div>
                            <!-- End Team Item -->
                            <!-- Team Item -->
                            <div class="team-item col-xs-6 col-md-3">
                                <figure>
                                    <img src="{{ URL::to('/images') }}/team/img-4.png" alt="">
                                </figure>
                            </div>
                            <!-- End Team Item -->
                        </div>
                    </section>
                    <!-- End Team -->
                    <!-- Follow -->
                    <section class="follow-about">
                        <div class="follow-group">
                            <a href="" title=""><i class="fa fa-facebook"></i></a>
                            <a href="" title=""><i class="fa fa-twitter"></i></a>
                            <a href="" title=""><i class="fa fa-pinterest"></i></a>
                            <a href="" title=""><i class="fa fa-linkedin"></i></a>
                            <a href="" title=""><i class="fa fa-instagram"></i></a>
                        </div>
                    </section>
                    <!-- Follow -->

                </div>
            </div>
        </div>
        @endsection