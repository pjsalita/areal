<div class="mb-2 card">
    <div class="card-header">Profile Information</div>
    <div class="card-body">
        <form class="row g-3" autocomplete="off" method="POST" action="{{ route("profile.update") }}">
            @csrf
            <div class="col-md-4">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') ?? $user->first_name }}">
            </div>
            <div class="col-md-4">
                <label for="middle_name" class="form-label">Middle Name</label>
                <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ old('middle_name') ?? $user->middle_name }}">
            </div>
            <div class="col-md-4">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') ?? $user->last_name }}">
            </div>
            <div class="col-md-12">
                <label for="bio" class="form-label">Bio</label>
                <input type="text" class="form-control" id="bio" name="bio" value="{{ old('bio') ?? $user->bio }}">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" readonly value="{{ old('email') ?? $user->email }}">
            </div>
            <div class="col-md-6">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') ?? $user->phone_number }}">
            </div>
            <div class="col-md-6">
                <label for="birthdate" class="form-label">Birthdate</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate') ?? $user->birthdate }}">
            </div>
            <div class="col-md-6">
                <label for="gender" class="form-label">Gender</label>
                <select id="gender" class="form-select" name="gender">
                    <option value="male" @if($user->gender === "male") selected @endif>Male</option>
                    <option value="female" @if($user->gender === "female") selected @endif>Female</option>
                </select>
            </div>
            @if ($user->account_type === "architect")
                <div class="col-md-12">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control" id="position" name="position" value="{{ old('position') ?? $user->position }}">
                </div>
            @endif
            <div class="col-12">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="" value="{{ old('address') ?? $user->address }}">
            </div>
            <div class="col-md-12">
                <label class="form-label">Change Password (only fill if you want to change your password)</label>
            </div>
            <div class="col-md-6 mt-0">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="col-md-6 mt-0">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
