<style>
    .fa-circle-chevron-down,
    .fa-gear,
    .fa-house,
    .fa-people-roof,
    .fa-sliders,
    .fa-list,
    .fa-product-hunt,
    .fa-list-check,
    .fa-money-check-dollar,
    .fa-windows,
    .fa-bolt,
    .fa-tags,
    .fa-pen,
    .fa-user-tie,
    .fa-shield-halved,
    .fa-sack-dollar,
    .fa-window-maximize,
    .fa-comment,
    .fa-tachometer-alt,
    .fa-paperclip {
        color: #5C8374;
        font-size: 15px;
    }

    ul li a {
        font-size: 14px;
    }
</style>

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a style="font-size: 22px; color:#5C8374" href="javascript:;"></a>
        </div>


        <ul class="sidebar-menu">

            <li class="menu-header">Ecommerce</li>
            <li><a class="nav-link" href=""><i class="fa-solid fa-house"></i>
                    <span>Go To Home Page</span>
                </a></li>

            <li class="dropdown">
                <a href="" class="nav-link"><i
                        class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>

            </li>

    <li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
        
            <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-responsive-nav-link>
        </form>
    </li>

 
        </ul>

    </aside>
</div>
