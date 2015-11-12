@extends('layouts.auth')
@section('titletext')
    Login
@endsection

@section('content')
<div class="form-box" id="login-box">
    <div class="header">Staff Sign In</div>
    <form action="/auth/login" method="post">
        {!! csrf_field() !!}
        <div class="body bg-gray">
            <div class="form-group">
                <input placeholder="Email" type="email" name="email" class="form-control" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password"/>
            </div>          
            <div class="form-group">
                <input type="checkbox" name="remember"/> Remember me
            </div>
        </div>
        <div class="footer">                                                               
            <button type="submit" class="btn bg-olive btn-block">Sign me in</button>  
            
            <p><a href="#">I forgot my password</a></p>
            
        </div>
    </form>
</div>
@endsection