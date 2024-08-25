<!-- Sidemenu -->
<div class="navbar-content scroll-div ps ps--active-y">
    <ul class="nav pcoded-inner-navbar">

        <li class="nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard.index') }}" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-desktop"></i></span>
                <span class="pcoded-mtext">{{ trans_choice('module_dashboard', 1) }}</span>
            </a>
        </li>

        <!-- banner-start -->
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/banner*') ? 'active' : '' }}">
            <a href="#!" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-university"></i></span>
                <span class="pcoded-mtext">Banners</span>
            </a>
            <ul class="pcoded-submenu">
            <li class="nav-item {{ Request::is('admin/banner*') ? 'active' : '' }}">
                <a href="{{ route('admin.banner.index') }}" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-desktop"></i></span>
                    <span class="pcoded-mtext">Main Banners</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/product-banner*') ? 'active' : '' }}">
                <a href="{{ route('admin.product-banner.index') }}" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-desktop"></i></span>
                    <span class="pcoded-mtext">Product Banners</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/sale-banner*') ? 'active' : '' }}">
                <a href="{{ route('admin.sale-banner.index') }}" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-desktop"></i></span>
                    <span class="pcoded-mtext">Sale Banners</span>
                </a>
            </li>

            </ul>
        </li>
        <!-- banner-end -->

        <!-- about-start -->
        <li class="nav-item pcoded-hasmenu {{ Request::is('admin/about-us*') ? 'active' : '' }}">
            <a href="#!" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-university"></i></span>
                <span class="pcoded-mtext">About Us</span>
            </a>
            <ul class="pcoded-submenu">
            <li class="nav-item {{ Request::is('admin/about-us*') ? 'active' : '' }}">
                <a href="{{ route('admin.about-us.index') }}" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-desktop"></i></span>
                    <span class="pcoded-mtext">About Us</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/team-members*') ? 'active' : '' }}">
                <a href="{{ route('admin.team-members.index') }}" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-desktop"></i></span>
                    <span class="pcoded-mtext">Team Members</span>
                </a>
            </li>

            </ul>
        </li>
        <!-- about-end -->

         <!-- product -->
         <li class="nav-item pcoded-hasmenu {{ Request::is('admin/gallery*') ? 'active' : '' }}">
            <a href="#!" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-university"></i></span>
                <span class="pcoded-mtext">Products</span>
            </a>
            <ul class="pcoded-submenu">
                <li class="{{ Request::is('admin/product-category') ? 'active' : '' }}"><a
                        href="{{ route('admin.product-category.index') }}" class="">Product Category</a></li>
                <li class="{{ Request::is('admin/products') ? 'active' : '' }}"><a
                        href="{{ route('admin.products.index') }}" class="">Product</a></li>
            </ul>
        </li>

        <!-- orders -->
        <li class="nav-item pcoded-hasmenu {{ Request::is('admin/orders*') ? 'active' : '' }}">
            <a href="#!" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-university"></i></span>
                <span class="pcoded-mtext">Orders</span>
            </a>
            <ul class="pcoded-submenu">
                <li class="{{ Request::is('admin/orders') ? 'active' : '' }}"><a
                        href="{{ route('admin.orders.index') }}" class="">Orders</a></li>
                <li class="{{ Request::is('admin/delivered-orders') ? 'active' : '' }}"><a
                        href="{{ route('admin.delivered_orders') }}" class="">Delivered Orders</a></li>
            </ul>
        </li>

            <li class="nav-item {{ Request::is('admin/testimonials*') ? 'active' : '' }}">
            <a href="{{ route('admin.testimonials.index') }}" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-desktop"></i></span>
                <span class="pcoded-mtext">Testimonials</span>
            </a>
        </li>


        <li class="nav-item pcoded-hasmenu {{ Request::is('admin/blogs*') ? 'active' : '' }}">
            <a href="#!" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-university"></i></span>
                <span class="pcoded-mtext">Blogs</span>
            </a>
            <ul class="pcoded-submenu">
            <li class="nav-item {{ Request::is('admin/blog-categories*') ? 'active' : '' }}">
                <a href="{{ route('admin.blog-categories.index') }}" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-desktop"></i></span>
                    <span class="pcoded-mtext">Blog Categories</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/blogs*') ? 'active' : '' }}">
                <a href="{{ route('admin.blogs.index') }}" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-desktop"></i></span>
                    <span class="pcoded-mtext">Blogs</span>
                </a>
            </li>
            </ul>
        </li>

        <li class="nav-item pcoded-hasmenu {{ Request::is('admin/saller*') ? 'active' : '' }}">
            <a href="#!" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-university"></i></span>
                <span class="pcoded-mtext">Seller</span>
            </a>
            <ul class="pcoded-submenu">
            <li class="nav-item {{ Request::is('admin/saller*') ? 'active' : '' }}">
                <a href="{{ route('admin.saller.index') }}" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-desktop"></i></span>
                    <span class="pcoded-mtext">Seller</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/saller-data*') ? 'active' : '' }}">
                <a href="{{ route('admin.saller-data.index') }}" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-desktop"></i></span>
                    <span class="pcoded-mtext">Seller Data</span>
                </a>
            </li>
            </ul>
        </li>

        <li
            class="nav-item {{ Request::is('header-notifications*') ? 'active' : '' }} {{ Request::is('admin/header-notifications*') ? 'active' : '' }}">
            <a href="{{ route('admin.header-notifications.index') }}" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-cog"></i></span>
                <span class="pcoded-mtext">Header Notifications</span>
            </a>
        </li>

        <li
            class="nav-item {{ Request::is('offers*') ? 'active' : '' }} {{ Request::is('admin/offers*') ? 'active' : '' }}">
            <a href="{{ route('admin.offers.index') }}" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-cog"></i></span>
                <span class="pcoded-mtext">Offers</span>
            </a>
        </li>

        <li
            class="nav-item {{ Request::is('product-reviews*') ? 'active' : '' }} {{ Request::is('admin/product-reviews*') ? 'active' : '' }}">
            <a href="{{ route('admin.product-reviews.index') }}" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-cog"></i></span>
                <span class="pcoded-mtext">Product Reviews</span>
            </a>
        </li>

        <li
            class="nav-item {{ Request::is('faq*') ? 'active' : '' }} {{ Request::is('admin/faq*') ? 'active' : '' }}">
            <a href="{{ route('admin.faq.index') }}" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-cog"></i></span>
                <span class="pcoded-mtext">Faq</span>
            </a>
        </li>

        <li
            class="nav-item {{ Request::is('contact-admin*') ? 'active' : '' }} {{ Request::is('admin/translations*') ? 'active' : '' }}">
            <a href="{{ route('admin.contact-admin.index') }}" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-cog"></i></span>
                <span class="pcoded-mtext">{{ trans_choice('module_contact', 2) }}</span>
            </a>
        </li>

        <li
            class="nav-item {{ Request::is('admin/setting*') ? 'active' : '' }} {{ Request::is('admin/translations*') ? 'active' : '' }}">
            <a href="{{ route('admin.setting.index') }}" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-cog"></i></span>
                <span class="pcoded-mtext">{{ trans_choice('module_setting', 2) }}</span>
            </a>
        </li>

        <li
            class="nav-item {{ Request::is('admin/users*') ? 'active' : '' }} {{ Request::is('admin/translations*') ? 'active' : '' }}">
            <a href="{{ route('admin.users-admin.index') }}" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-cog"></i></span>
                <span class="pcoded-mtext">Users</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                <span class="pcoded-micon"><i class="feather icon-log-out"></i></span>
                <span class="pcoded-mtext">Logout</span>
            </a>
        </li>
   
    </ul>
</div>
<!-- End Sidebar -->