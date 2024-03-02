<div class="sidebar-wrapper d-none d-md-block" id="sidebarSupportedContent">
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="https://ruvicapital.com/wp-content/uploads/2023/12/cropped-Ruvi-Capital-website-logo.png" alt="" class="imf-fluid brand-image">
        </div>
        <div class="sidebar-list pt-3">
            <ul class="nav flex-column">
                <li class="nav-item {{ request()->is('/') == 1 ? 'active' : '' }}">
                    <a class="nav-link" href="/"><i class="fa-solid fa-house"></i><span>Dashboard</span></a>
                </li>
                <li class="nav-item {{ request()->is('earnings') == 1 ? 'active' : '' }}">
                    <a class="nav-link" href="/earnings"><i class="fa-solid fa-comment-dollar"></i><span>Earning</span></a>
                </li>
                <li class="nav-item {{ request()->is('deposits') == 1 ? 'active' : '' }}">
                    <a class="nav-link" href="/deposits"><i class="fa-solid fa-piggy-bank"></i><span>Deposit</span></a>
                </li>
                <li class="nav-item {{ request()->is('user') == 1 ? 'active' : '' }}">
                    <a class="nav-link" href="/user"><i class="fa-solid fa-users"></i></i><span>Referrals</span></a>
                </li>
                <li class="nav-item {{ request()->is('contract') == 1 ? 'active' : '' }}">
                    <a class="nav-link" href="/contract"><i class="fa-solid fa-hand-holding-dollar"></i><span>Contract</span></a>
                </li>
                <li class="nav-item {{ request()->is('withdraw') == 1 ? 'active' : '' }}">
                    <a class="nav-link" href="/withdraw"><i class="fa-solid fa-money-bill-transfer"></i></i><span>Withdraw</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>