<ul class="nav nav-list">
    <li class="{{ Request::segment(1) === 'dashboard' ? 'active' : null }}">
        <a href="{{route('dashboard')}}">
            <i class="menu-icon fa fa-tachometer"></i>
            <span class="menu-text"> Dashboard </span>
        </a>

        <b class="arrow"></b>
    </li>
    @can('admin')


    <li class="{{ Request::segment(1) === 'administrator' ? 'active open' : null }}">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-cogs"></i>
            <span class="menu-text"> Administartor </span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">
            <li class="{{ Request::segment(2) === 'user' ? 'active' : null }}">
                <a href="{{route('user.index')}}">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Users
                </a>

                <b class="arrow"></b>
            </li>

            <li class="{{ Request::segment(2) === 'permission' ? 'active' : null }}">
                <a href="{{route('permission.index')}}">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Permission
                </a>

                <b class="arrow"></b>
            </li>
            <li class="{{ Request::segment(2) === 'role' ? 'active' : null }}">
                <a href="{{route('role.index')}}">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Role
                </a>

                <b class="arrow"></b>
            </li>
        </ul>
    </li>
    @endcan
    <li class="{{ Request::segment(1) === 'my' ? 'active open' : null }}">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-pencil-square-o"></i>
            <span class="menu-text"> Produk </span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">
            <li class="{{ Request::segment(2) === 'produk' ? 'active' : null }}">
                <a href="{{route('produk.index')}}">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Data Produk
                </a>

                <b class="arrow"></b>
            </li>

            <li class="{{ Request::segment(2) === 'nota' ? 'active' : null }}">
                <a href="{{route('nota.index')}}">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Nota
                </a>

                <b class="arrow"></b>
            </li>

            <li class="">
                <a href="form-wizard.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Wizard &amp; Validation
                </a>

                <b class="arrow"></b>
            </li>

            <li class="">
                <a href="wysiwyg.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Wysiwyg &amp; Markdown
                </a>

                <b class="arrow"></b>
            </li>

            <li class="">
                <a href="dropzone.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Dropzone File Upload
                </a>

                <b class="arrow"></b>
            </li>
        </ul>
    </li>

    <li class="">
        <a href="widgets.html">
            <i class="menu-icon fa fa-list-alt"></i>
            <span class="menu-text"> Widgets </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="">
        <a href="calendar.html">
            <i class="menu-icon fa fa-calendar"></i>

            <span class="menu-text">
                Calendar

                <span class="badge badge-transparent tooltip-error" title="2 Important Events">
                    <i class="ace-icon fa fa-exclamation-triangle red bigger-130"></i>
                </span>
            </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="">
        <a href="gallery.html">
            <i class="menu-icon fa fa-picture-o"></i>
            <span class="menu-text"> Gallery </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-tag"></i>
            <span class="menu-text"> More Pages </span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">
            <li class="">
                <a href="profile.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    User Profile
                </a>

                <b class="arrow"></b>
            </li>

            <li class="">
                <a href="inbox.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Inbox
                </a>

                <b class="arrow"></b>
            </li>

            <li class="">
                <a href="pricing.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Pricing Tables
                </a>

                <b class="arrow"></b>
            </li>

            <li class="">
                <a href="invoice.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Invoice
                </a>

                <b class="arrow"></b>
            </li>

            <li class="">
                <a href="timeline.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Timeline
                </a>

                <b class="arrow"></b>
            </li>

            <li class="">
                <a href="search.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Search Results
                </a>

                <b class="arrow"></b>
            </li>

            <li class="">
                <a href="email.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Email Templates
                </a>

                <b class="arrow"></b>
            </li>

            <li class="">
                <a href="login.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Login &amp; Register
                </a>

                <b class="arrow"></b>
            </li>
        </ul>
    </li>

    <li class="">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-file-o"></i>

            <span class="menu-text">
                Other Pages

                <span class="badge badge-primary">5</span>
            </span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">
            <li class="">
                <a href="faq.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    FAQ
                </a>

                <b class="arrow"></b>
            </li>

            <li class="">
                <a href="error-404.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Error 404
                </a>

                <b class="arrow"></b>
            </li>

            <li class="">
                <a href="error-500.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Error 500
                </a>

                <b class="arrow"></b>
            </li>

            <li class="">
                <a href="grid.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Grid
                </a>

                <b class="arrow"></b>
            </li>

            <li class="">
                <a href="blank.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Blank Page
                </a>

                <b class="arrow"></b>
            </li>
        </ul>
    </li>
</ul><!-- /.nav-list -->
