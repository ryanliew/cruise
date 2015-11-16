@extends('layouts.users')

@section('titletext')
	My Profile
@endsection

@section('content')
<!--Banner-->
        <section class="sub-banner">
            <!--Background-->
            <div class="bg-parallax bg-1"></div>
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
                <div class="main-cn element-page bg-white clearfix">                    
                    <section class="user-profile">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="user-profile__header">
                                    <h4>{{ $user->first_name }} {{ $user->last_name }}</h4>
                                    <span class="text-capitalize">{{ $user->role() }} Since {{  date('d F Y', strtotime($user->created_at)) }}</span>
                                    <p>
                                        <img src="{{ URL::to('/uploads')}}/{{ $user->image }}" alt="">
                                    </p>
                                </div>
                                <ul class="user-profile__navigation">
                                    <li class="current"><a href="{{ URL::to('/user') }}/{{ Auth::user()->id }}/reservations"><img src="{{ URL::to('/images') }}/icon/icon-cart.png" alt="">My Reservations</a></li>
                                    <li><a href="{{ URL::to('/user') }}/{{ Auth::user()->id }}"><img src="{{ URL::to('/images') }}/icon/icon-user.png" alt="">My profile</a></li>
                                    <li><a href="{{URL::to('/auth/logout')}}"><img src="{{ URL::to('/images') }}/icon/icon-back.png" alt="">Sign out</a></li>
                                </ul>
                            </div>
                            <div class="col-md-9">
                                <h2 class="user-profile__title">My Reservations</h2>
                                <div class="user-profile__my-booking table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Location</th>
                                                <th>Order Date</th>
                                                <th>Execution Date</th>
                                                <th>Cost</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        @foreach($user->reservations as $reservation)
                                        <tr>
                                            <td>
                                                <a href="{{ URL::to('/reservation') }}/{{ $reservation->id }}">{{ $reservation->cruise->name }}</a>
                                            </td>
                                            <td>
                                                {{ $reservation->cruise->location() }}
                                            </td>
                                            <td>
                                                {{ date('d F Y', strtotime($reservation->created_at)) }}
                                            </td>
                                            <td>
                                                {{ $reservation->cruise->date() }}
                                            </td>
                                            <td>
                                                RM{{ number_format($reservation->total(), 2, '.', ',') }}
                                            </td>
                                            <td>
                                                <span class="label bg-{{ $reservation->status()['color'] }}">{{ $reservation->status()['name']}}</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- End Main -->
@endsection