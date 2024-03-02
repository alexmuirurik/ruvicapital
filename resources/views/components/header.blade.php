<header class="header navbar py-0 mb-4 border-bottom position-fixed w-100">
    <button class="navbar-toggler" type="button" data-bs-toggle="container" data-bs-target="#containerSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="d-flex flex-wrap justify-content-center py-4 container" id="containerSupportedContent">
        <a href="/" class="header-branding d-flex align-items-center mb-3 mb-md-0 me-md-auto">
            <img class="img-fluid" src="https://ruvicapital.com/wp-content/uploads/2023/12/cropped-Ruvi-Capital-website-logo.png" alt="">
        </a>
    
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="{{route('register')}}" class="nav-link {{request()->is('register') ? 'active' : ''}}" aria-current="page">Get Started</a></li>
            <li class="nav-item"><a href="{{route('login')}}" class="nav-link {{request()->is('login') ? 'active' : ''}}">Login</a></li>
            <li class="nav-item"><a href="https://ruvicapital.com/contact-us/" class="nav-link {{request()->is('contact') ? 'active' : ''}}">Contact Us</a></li>
        </ul>
    </div>
</header>