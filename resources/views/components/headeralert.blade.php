<div class="header-alert alert alert-danger mb-0 py-2 rounded-0">
    <div class="d-inline-flex w-100">
        <div class="iconbox">
            <span class="fa fa-warning text-danger"></span>
        </div>
        <div class="messagebox ms-4">
           <p class="mb-0">{{session()->get('contract')}}</p> 
        </div>
        <div class="closebox ms-auto">
            <span class="fa fa-times" onclick="removeAlertBox(event)"></span>
        </div>
    </div>
</div>

