<div class="row">
    <div class="col-xl-4">
        <!-- Profile picture card-->
        @include('forms.profile_img')

        @if ($errors->any())
            @include('forms.password') 
        @endif
        
    </div>
    <div class="col-xl-8">
        <!-- Account details card-->
        <div class="card mb-4">
            <div class="card-header">Account Details</div>
            <div class="card-body">
                <form action="{{route('user.update', request()->user()->username)}}" method="post" id="updateProfile" onsubmit="confirmButtonClick(event)" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row gx-3 mb-3">
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">First name</label>
                                <input class="form-control" name="firstname" type="text" value="{{request()->user()->firstname}}">
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Last name</label>
                                <input class="form-control" name="lastname" type="text" value="{{request()->user()->lastname}}">
                            </div>
                        </div>
                        <!-- Form Row-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputOrgName">Referral Link (the link referrals use to sign up)</label>
                            <input class="form-control" name="referral" type="text" value="{{request()->user()->referral_id}}">
                        </div>
                        <!-- Form Group (organization name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputUsername">Username (how admins see you)</label>
                            <input class="form-control" name="username" disabled type="text" value="{{request()->user()->username}}">
                            <input type="file" id="profile_img_input" name="profile_img" class="d-none">
                        </div>
                        <!-- Form Group (location)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputLocation">User Type</label>
                            <input class="form-control" id="inputLocation" type="text" value="{{request()->user()->user_type}}" disabled>
                        </div>
                    </div>
                    <!-- Form Group (email address)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="inputEmailAddress">Email address</label>
                        <input class="form-control" name="email" type="email" value="{{request()->user()->email}}">
                    </div>
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (phone number)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputBirthday">Full Names</label>
                            <input class="form-control" type="text" name="names" value="{{request()->user()->names}}">
                        </div>
                        <!-- Form Group (birthday)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputPhone">Phone number</label>
                            <input class="form-control" name="mobile" type="tel" value="{{request()->user()->mobile}}">
                        </div>
                    </div>
                    <!-- Save changes button-->
                    <div class="d-flex justify-content-between">
                        <form action="{{route('profile.show')}}" method="post" id="deleteProfile" onsubmit="confirmButtonClick(event)">
                            @csrf
                           <button class="btn btn-danger btn-sm" type="submit">Delete Account</button> 
                        </form>
                        
                        <button class="btn btn-primary btn-sm" type="submit">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>