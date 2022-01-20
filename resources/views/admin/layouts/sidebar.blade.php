<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search"></form>
    <ul class="nav menu">
        <li>
            <a href="/admin" class="menu-dashboard">
                <svg class="glyph stroked dashboard-dial">
                    <use xlink:href="#stroked-dashboard-dial"></use>
                </svg>
                Tổng quan
            </a>
        </li>
        <li>
            <a href="/admin/categories" class="menu-categories">
                <svg class="glyph stroked clipboard with paper">
                    <use xlink:href="#stroked-clipboard-with-paper" />
                </svg>
                Danh Mục
            </a>
        </li>
        <li>
            <a href="admin/products" class="menu-products">
                <svg class="glyph stroked bag">
                    <use xlink:href="#stroked-bag"></use>
                </svg>
                Sản phẩm
            </a>
        </li>
        <li>
            <a href="/admin/orders" class="menu-orders">
                <svg class="glyph stroked notepad ">
                    <use xlink:href="#stroked-notepad" />
                </svg>
                Đơn hàng
            </a>
        </li>

        <ul>
            <li><a class='order menu-order' href="/admin/orders">Đơn hàng chưa duyệt</a></li>
            <li><a class='order menu-processed' href="/admin/orders/processed">Đơn hàng đã duyệt</a></li>
            <li><a class='order menu-delivery' href="/admin/orders/delivery">Đơn hàng đang giao</a></li>
            <li><a class='order menu-finished' href="/admin/orders/finished">Đơn hàng hoàn thành</a></li>
        </ul>

        <li>
            <a href="/admin/coupon" class="menu-coupon">
                <svg class="glyph stroked notepad ">
                    <use xlink:href="#stroked-notepad" />
                </svg>
                Quản lý mã giảm giá
            </a>
        </li>
        <li role="presentation" class="divider"></li>
        <li>
            <a href="/admin/users" class="menu-users">
                <svg class="glyph stroked male-user">
                    <use xlink:href="#stroked-male-user"></use>
                </svg>
                Quản lý thành viên
            </a>
        </li>
        <li role="presentation" class="divider"></li>
        <li>
            <a href="/admin/shippers" class="menu-users">
                <svg class="glyph stroked male-user">
                    <use xlink:href="#stroked-male-user"></use>
                </svg>
                Quản lý shippers
            </a>
        </li>
    </ul>
</div>

<input type="hidden" value="{{ $activePage ?? '' }}" id="page-id" />
