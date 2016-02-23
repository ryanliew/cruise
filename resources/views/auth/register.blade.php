@extends('layouts.users')

@section('titletext')
    Registration
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
<div class="main main-dt">
            <div class="container">
                <div class="main-cn detail-page bg-white clearfix">
                    <section class="user-profile">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="user-profile__title">Register</h2>
                                @include('common.errors')
                                @include('common.messages')
                                <div class="user-form">
                                    <div class="row">
                                        <form action="{{ URL::to('/') }}/auth/register" method="post" enctype="multipart/form-data">
                                            <div class="col-md-6">
                                                {{ csrf_field() }}
                                                <h3>Personal Information</h3>
                                                <div class="field-input">
                                                    <input type="text" class="input-text" name="first_name" placeholder="First Name">
                                                </div>
                                                <div class="field-input">
                                                    <input type="text" class="input-text" name="last_name" placeholder="Last Name">
                                                </div>
                                                <div class="field-input">
                                                    <input type="text" class="input-text" name="email" placeholder="Email Address">
                                                </div>
                                                <div class="field-input">
                                                    <input type="text" class="input-text" name="phone" placeholder="Phone Number">
                                                </div>
                                                <div class="field-input">
                                                    <input type="password" class="input-text" name="password" placeholder="Password">
                                                </div>
                                                <div class="field-input">
                                                    <input type="password" class="input-text" name="password_confirmation" placeholder="Confirm Password">
                                                </div>
                                                <h3>Profile Image</h3>
                                                <div class="field-input">
                                                    <input type="file" class="input-file" name="image">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h3>Location</h3>
                                                <div class="field-input">
                                                    <input type="text" class="input-text" name="country" placeholder="Country">
                                                </div>
                                                <div class="field-input">
                                                    <input type="text" class="input-text" name="address_1" placeholder="Address Line 1">
                                                </div>
                                                <div class="field-input">
                                                    <input type="text" class="input-text" name="address_2" placeholder="Address Line 2">
                                                </div>
                                                <div class="field-input">
                                                    <input type="text" class="input-text" name="city" placeholder="City">
                                                </div>
                                                <div class="field-input">
                                                    <input type="text" class="input-text" name="postal_code" placeholder="Postal Code">
                                                </div>                                                
                                                <div class="field-input">
                                                    <input type="submit" class="awe-btn awe-btn-1 awe-btn-medium" value="Submit">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection