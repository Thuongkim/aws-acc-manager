<li class="nav-item">
    <a href="{{ route('users.index') }}"
       class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
        <p>Users</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('accounts.index') }}"
       class="nav-link {{ Request::is('accounts*') ? 'active' : '' }}">
        <p>Accounts</p>
    </a>
</li>


