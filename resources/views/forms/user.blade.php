<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header bg-body-tertiary">
        <h5 class="mb-0" id="offcanvasRightLabel">Offcanvas right</h5>
        <button type="button" class="btn-close text-reset small" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="form-group mb-3">
            <label for="amount" class="form-label">Referral Link</label>
            <input type="text" class="form-control" value="https://app.ruvicapital.com/register?referrer={{request()->user()->referral_id}}"  readonly>
        </div>
        <div class="form-group mb-3">
            <label for="instructions" class="form-label">Instructions</label>
            <div name="instructions" id="instructions" cols="30" rows="10" class="form-control">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores minima qui, reprehenderit
                    pariatur iste</p>
                <p>labore delectus reiciendis molestias in necessitatibus! Porro possimus enim magnam beatae
                    numquam velit </p>
                <p>provident quis neque?</p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>