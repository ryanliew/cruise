
<h2 class="user-profile__title">Register</h2>
@include('common.errors')
@include('common.messages')
<div class="user-form">
    <div class="row">
    	<form action="{{ URL::to('/user') }}/{{ $user->id }}" method="post" enctype="multipart/form-data">
        	<div class="col-md-6">
            	{{ csrf_field() }}
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
                <h3>Your Password</h3>
                <div class="field-input">
                    <input type="text" class="input-text" name="password" placeholder="New Password">
                </div>
                <div class="field-input">
                    <input type="text" class="input-text" name="password_confirmation" placeholder="New Password Again">
                </div>
                <h3>Profile Image</h3>
                <div class="field-input">
                	<input type="file" class="input-file" name="image">
                </div>
                <div class="field-input">
                    <input type="submit" class="awe-btn awe-btn-1 awe-btn-medium" value="Submit">
                </div>
        	</div>
        </form>
    </div>
</div>