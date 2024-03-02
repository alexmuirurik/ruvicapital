<div class="card mb-4 mb-xl-0">
    <div class="card-header">Profile Picture</div>
    <div class="card-body text-center">
        <!-- Profile picture image-->
        <img id="profile_img" class="img-account-profile rounded-circle object-fit-cover mb-2" src="{{request()->user()->profile_img}}" alt="" width="150" height="150">
        <!-- Profile picture help block-->
        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
        <div class="btn btn-primary btn-rounded btn-sm" id="image-selector">
            <label class="form-label text-white m-1" for="customFile2">Upload New Image</label>
            <input type="file" class="form-control d-none" id="customFile2" onchange="displaySelectedImage(event, 'profile_img')" /> 
        </div>
    </div>
</div>