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
            <a style="font-size: 22px; color:#5C8374" href="javascript:;">LMS</a>
        </div>


        <ul class="sidebar-menu">

            <li class="menu-header">Library Management</li>
            <li class=""><a class="nav-link" href="{{ route('home.page') }}"><i class="fa-solid fa-house"></i>
                    <span>Go To Home Page</span>
                </a></li>

            <li class="dropdown {{ setActive(['admin.dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fa-solid fa-tags"></i><span>Dashboard</span></a>

            </li>

            <li class="dropdown {{ setActive(['category.index', 'category.create', 'category.edit']) }}">
                <a href="{{ route('category.index') }}" class="nav-link"><i
                        class="fa-solid fa-tags"></i><span>Categories</span></a>

            </li>

            <li class="dropdown {{ setActive(['author.index', 'author.create', 'author.edit']) }}">
                <a href="{{ route('author.index') }}" class="nav-link"><i
                        class="fa-solid fa-tags"></i><span>Authors</span></a>

            </li>

            <li class="dropdown {{ setActive(['publisher.index', 'publisher.create', 'publisher.edit']) }}">
                <a href="{{ route('publisher.index') }}" class="nav-link"><i
                        class="fa-solid fa-tags"></i><span>Publishers</span></a>

            </li>

            <li class="dropdown {{ setActive(['book.index', 'book.create', 'book.edit', 'admin.book-by-category', 'admin.book-by-author', 'admin.book-by-publisher']) }}">
                <a href="{{ route('book.index') }}" class="nav-link"><i
                        class="fa-solid fa-tags"></i><span>Books</span></a>

            </li>

            <li class="dropdown {{ setActive(['user-manage.index', 'user-manage.create', 'user-manage.edit']) }}">
                <a href="{{ route('user-manage.index') }}" class="nav-link"><i class="fa-solid fa-tags"></i><span>Users</span></a>

            </li>

            <li class="dropdown {{ setActive(['message.index']) }}">
                <a href="{{ route('message.index') }}" class="nav-link"><i class="fa-solid fa-tags"></i><span>Messages</span></a>

            </li>

        </ul>

    </aside>
</div>
