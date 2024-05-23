<h1>This is user dashboard</h1>


<form method="POST" action="{{ route('logout') }}">
    @csrf
    <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
            this.closest('form').submit()"
        class="dropdown-item has-icon text-danger">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</form>