<footer class="footer mt-3">
    <div class="container">
        <div class="d-flex flex-column flex-sm-row justify-content-between pt-2 pb-1 border-top">
            <p>© {{ now()->year }} {{ config('app.name') }}, Inc. All rights reserved.</p>
            <ul class="list-unstyled d-flex">
                <li class="ms-3">
                    <a class="link-body-emphasis" href="#">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                </li>
                <li class="ms-3">
                    <a class="link-body-emphasis" href="#">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                </li>
                <li class="ms-3">
                    <a class="link-body-emphasis" href="#">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    @foreach ($errors->all() as $error)
            
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="liveToast" class="toast bg-white" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-danger text-white">
                    <i class="fa-solid fa-warning me-2"></i>
                    <strong class="me-auto">Error</strong>
                    <small>{{now()->diffForHumans()}}</small>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <p class="text-danger">{{ $error }}</p>
                </div>
            </div>
        </div>
        
    @endforeach
</footer>
