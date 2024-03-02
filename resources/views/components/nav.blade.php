<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand ms-2" href="#">{{request()->path() == '/' ? 'Dashboard' : ucfirst(request()->path())}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" onclick="collapseSidebar()">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item active px-2">
                    <a class="nav-link" href="https://ruvicapital.com/faq/" target="_blank">FAQs <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link popover-dismiss {{session()->has('notification') ? 'text-danger' : 'text-success' }}" href="#" data-container="body" 
                        data-toggle="popover" data-placement="bottom" 
                        data-bs-content="{{session('notification') ?? 'Nothing to show...'}}">
                        <i class="fa fa-bell"></i>
                    </a>
                </li>
                <li class="nav-item dropdown ps-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{auth()->user()->names}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('user.show', request()->user()->username)}}">Profile</a>
                        <a class="dropdown-item" href="{{route('settings.index')}}">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                    </div>
                </li> 
            </ul>
        </div>
    </div>
</nav>