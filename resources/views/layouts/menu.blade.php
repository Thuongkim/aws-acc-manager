<li class="nav-item">
    <a href="{{ route('accounts.index') }}"
       class="nav-link {{ Request::is('accounts*') ? 'active' : '' }}">
        <p>Accounts</p>
    </a>
    <a href="{{ route('system_settings.index') }}"
       class="nav-link {{ Request::is('system_settings*') ? 'active' : '' }}">
        <p>System Settings</p>
    </a>
</li>


