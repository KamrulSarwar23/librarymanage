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
        color: #43b1cc;
        font-size: 15px;
    }

    ul li a {
        font-size: 14px;
    }
</style>

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a style="font-size: 22px; color:hsl(154, 15%, 91%)" href="javascript:;">LMS</a>
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

            <li
                class="dropdown {{ setActive(['category.index', 'category.create', 'category.edit', 'active.category', 'pending.category']) }}">
                <a href="{{ route('category.index') }}" class="nav-link"><i
                        class="fa-solid fa-tags"></i><span>Categories</span></a>

            </li>

            <li
                class="dropdown {{ setActive(['author.index', 'author.create', 'author.edit', 'active.author', 'pending.author']) }}">
                <a href="{{ route('author.index') }}" class="nav-link"><i
                        class="fa-solid fa-tags"></i><span>Authors</span></a>

            </li>

            <li
                class="dropdown {{ setActive(['publisher.index', 'publisher.create', 'publisher.edit', 'active.publisher', 'pending.publisher']) }}">
                <a href="{{ route('publisher.index') }}" class="nav-link"><i
                        class="fa-solid fa-tags"></i><span>Publishers</span></a>

            </li>

            <li
                class="dropdown {{ setActive([
                    'book.index',
                    'book.create',
                    'book.edit',
                    'book.show',
                    'admin.book-by-category',
                    'admin.book-by-author',
                    'admin.book-by-publisher',
                    'books.filterByStatus',
                    'books.filterByDate',
                    'books.search-by-query',
                    'active.book',
                    'inactive.book',
                    'books.filterByType',
                    'quantity.index',
                    'readers.index',
                ]) }}">
                <a href="{{ route('book.index') }}" class="nav-link"><i
                        class="fa-solid fa-tags"></i><span>Books</span></a>
            </li>

            <li
                class="dropdown {{ request()->routeIs('book.borrowinfo', 'book.borrow-search', 'online-borrow-book-details') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fa-solid fa-shield-halved"></i>
                    <span>Online Book Borrow</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('book.borrowinfo') && !request('status') ? 'active' : '' }}">
                        <a href="{{ route('book.borrowinfo') }}" class="nav-link">
                            <i class="fa-solid fa-tags"></i><span>All Books Request</span>
                        </a>
                    </li>

                    <li
                        class="{{ request()->routeIs('book.borrowinfo') && request('status') == 'pending' ? 'active' : '' }}">
                        <a href="{{ route('book.borrowinfo', ['status' => 'pending']) }}" class="nav-link">
                            <i class="fa-solid fa-tags"></i><span>Pending Books</span>
                        </a>
                    </li>
                    <li
                        class="{{ request()->routeIs('book.borrowinfo') && request('status') == 'receive' ? 'active' : '' }}">
                        <a href="{{ route('book.borrowinfo', ['status' => 'receive']) }}" class="nav-link">
                            <i class="fa-solid fa-tags"></i><span>Receive Books</span>
                        </a>
                    </li>


                    <li
                        class="{{ request()->routeIs('book.borrowinfo') && request('status') == 'reject' ? 'active' : '' }}">
                        <a href="{{ route('book.borrowinfo', ['status' => 'reject']) }}" class="nav-link">
                            <i class="fa-solid fa-tags"></i><span>Reject Books</span>
                        </a>
                    </li>

                    <li
                        class="{{ request()->routeIs('book.borrowinfo') && request('status') == 'return' ? 'active' : '' }}">
                        <a href="{{ route('book.borrowinfo', ['status' => 'return']) }}" class="nav-link">
                            <i class="fa-solid fa-tags"></i><span>Return Books</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li
                class="dropdown {{ setActive(['offline-book-borrow', 'offline-book-borrow-edit', 'offline-book-borrow-search', 'borrow-book-details']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fa-solid fa-shield-halved"></i>
                    <span>Offline Book Borrow</span></a>

                <ul class="dropdown-menu">

                    <li
                        class="dropdown {{ request()->routeIs('offline-book-borrow') && !request('status') ? 'active' : '' }}">
                        <a href="{{ route('offline-book-borrow') }}" class="nav-link"><i
                                class="fa-solid fa-tags"></i><span>Add Borrow</span></a>
                    </li>

                    <li
                        class="{{ request()->routeIs('offline-book-borrow') && request('status') == 'receive' ? 'active' : '' }}">
                        <a href="{{ route('offline-book-borrow', ['status' => 'receive']) }}" class="nav-link">
                            <i class="fa-solid fa-tags"></i><span>Received Books</span>
                        </a>
                    </li>

                    <li
                        class="{{ request()->routeIs('offline-book-borrow') && request('status') == 'reject' ? 'active' : '' }}">
                        <a href="{{ route('offline-book-borrow', ['status' => 'reject']) }}" class="nav-link">
                            <i class="fa-solid fa-tags"></i><span>Reject Books</span>
                        </a>
                    </li>

                    <li
                        class="{{ request()->routeIs('offline-book-borrow') && request('status') == 'return' ? 'active' : '' }}">
                        <a href="{{ route('offline-book-borrow', ['status' => 'return']) }}" class="nav-link">
                            <i class="fa-solid fa-tags"></i><span>Return Books</span>
                        </a>
                    </li>


                </ul>
            </li>




            <li class="dropdown {{ setActive(['report']) }}">
                <a href="{{ route('report') }}" class="nav-link"><i
                        class="fa-solid fa-tags"></i><span>Report</span></a>
            </li>

            <li class="dropdown {{ setActive(['admin.book-review', 'active.review', 'pending.review']) }}">
                <a href="{{ route('admin.book-review') }}" class="nav-link"><i
                        class="fa-solid fa-tags"></i><span>Reviews</span></a>

            </li>


            <li class="dropdown {{ setActive(['message.index']) }}">
                <a href="{{ route('message.index') }}" class="nav-link"><i
                        class="fa-solid fa-tags"></i><span>Messages</span></a>

            </li>


            <li class="dropdown {{ setActive(['user-policy.create', 'user-policy.store']) }}">
                <a href="{{ route('user-policy.create') }}" class="nav-link"><i class="fa-solid fa-tags"></i><span>
                        Policy</span></a>

            </li>

            <li class="dropdown {{ setActive(['user-manage.index', 'user-manage.create', 'user-manage.edit']) }}">
                <a href="{{ route('user-manage.index') }}" class="nav-link"><i
                        class="fa-solid fa-tags"></i><span>Users</span></a>

            </li>

            <li class="dropdown {{ setActive(['admin.profile']) }}">
                <a href="{{ route('admin.profile') }}" class="nav-link"><i
                        class="fa-solid fa-tags"></i><span>Profile</span></a>

            </li>


        </ul>

    </aside>
</div>
