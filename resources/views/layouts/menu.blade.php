<li class="nav-item">
    <a href="{{ route('home') }}"
       class="nav-link {{ Request::is('home') ? 'active' : '' }}">
       <i class="fas fa-home"></i>
       <p>Dashboard</p>
    </a>
    <a href="{{ route('accounts.index') }}"
       class="nav-link {{ Request::is('accounts*') ? 'active' : '' }}">
        <i class="far fa-user"></i> 
        <p>Accounts</p>
    </a>
</li>


