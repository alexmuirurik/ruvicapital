<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header bg-body-tertiary">
        <h5 class="mb-0" id="offcanvasRightLabel">Offcanvas right</h5><button type="button"
            class="btn-close text-reset small" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form method="post" action="{{route('contract.store')}}" id="creatingacontract" onsubmit="confirmButtonClick(event)">
            @csrf
            <div class="form-group mb-3">
                <label for="withdraw" class="form-label">Withdrawal Date</label>
                <select name="withdraw" class="form-control" required>
                    <option value="3">Three Months</option>
                    <option value="4">Four Months</option>
                    <option value="5">Five Months</option>
                    <option value="6">Six Months</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="instructions" class="form-label">Instructions</label>
                <div name="instructions" id="instructions" cols="30" rows="10" class="form-control"
                    readonly="" disabled="">
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
            <div class="form-group">
                <div class="successes w-100 text-center"></div>
                <div class="btn w-100">
                    <button type="submit" class="btn btn-sm btn-primary m-auto">I Agree</button>
                </div>
            </div>
        </form>
    </div>
</div>