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
                                    <li><a href="{{ URL::to('/user') }}/{{ Auth::user()->id }}/reservations"><img src="{{ URL::to('/images') }}/icon/icon-cart.png" alt="">My Reservations</a></li>
                                    <li class="current"><a href="{{ URL::to('/user') }}/{{ Auth::user()->id }}"><img src="{{ URL::to('/images') }}/icon/icon-user.png" alt="">My profile</a></li>
                                    <li><a href="{{URL::to('/auth/logout')}}"><img src="{{ URL::to('/images') }}/icon/icon-back.png" alt="">Sign out</a></li>
                                </ul>
                            </div>
                            <div class="col-md-9">
                                <h2 class="user-profile__title">My Profile</h2>
                                @include('common.errors')
                                @include('common.messages')
                        		<div class="user-form">
                                    <div class="row">
                                    	<form action="{{ URL::to('/user') }}/{{ $user->id }}" method="post" enctype="multipart/form-data">
                                        	<div class="col-md-6">
			                                	{{ csrf_field() }}
			                                	{{ method_field('put') }}
	                                            <h3>Personal Information</h3>
	                                            <div class="field-input">
	                                                <input type="text" class="input-text" name="first_name" value="{{ $user->first_name }}" placeholder="First Name">
	                                            </div>
	                                            <div class="field-input">
	                                                <input type="text" class="input-text" name="last_name" value="{{ $user->last_name }}" placeholder="Last Name">
	                                            </div>
	                                            <div class="field-input">
	                                                <input type="text" class="input-text" name="email" value="{{ $user->email }}" placeholder="Email Address">
	                                            </div>
	                                            <div class="field-input">
	                                                <input type="text" class="input-text" name="phone" value="{{ $user->contact_no }}" placeholder="Phone Number">
	                                            </div>
	                                            <h3>Location</h3>
	                                            <div class="field-input">
	                                                <input type="text" class="input-text" name="country" value="{{ $user->country }}" placeholder="Country">
	                                            </div>
	                                            <div class="field-input">
	                                                <input type="text" class="input-text" name="address_1" value="{{ $user->address_1 }}" placeholder="Address Line 1">
	                                            </div>
	                                            <div class="field-input">
	                                                <input type="text" class="input-text" name="address_2" value="{{ $user->address_2 }}" placeholder="Address Line 2">
	                                            </div>
	                                            <div class="field-input">
	                                                <input type="text" class="input-text" name="city" value="{{ $user->city }}" placeholder="City">
	                                            </div>
	                                            <div class="field-input">
	                                                <input type="text" class="input-text" name="postal_code" value="{{ $user->postal_code }}" placeholder="Postal Code">
	                                            </div>
                                        	</div>
                                        	<div class="col-md-6">
	                                            <h3>Change Password</h3>
	                                            <div class="field-input">
	                                                <input type="text" class="input-text" name="current_password" placeholder="Current Password">
	                                                <i>Please leave empty if you want to leave your password unchanged</i>
	                                            </div>
	                                            <div class="field-input">
	                                                <input type="text" class="input-text" name="new_password" placeholder="New Password">
	                                            </div>
	                                            <div class="field-input">
	                                                <input type="text" class="input-text" name="new_password_again" placeholder="New Password Again">
	                                            </div>
	                                            <h3>Profile Image</h3>
	                                            <div class="field-input">
	                                            	<input type="file" class="input-file" name="image">
	                                            	@if(!empty($user->image))
														<img src="{{ URL::to('/uploads')}}/{{ $user->image }}" style="max-width:300px;"/>
													@endif
	                                            </div>
	                                            <div class="field-input">
	                                                <input type="submit" class="awe-btn awe-btn-1 awe-btn-medium" value="Update Profile">
	                                            </div>
                                        	</div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- End Main -->
@endsection