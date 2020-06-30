<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search"></form>
    <ul class="nav menu">
        <li class="active">
            <a href="/admin" class="menu-dashboard">
                <svg class="glyph stroked dashboard-dial">
                    <use xlink:href="#stroked-dashboard-dial"></use>
                </svg>
                Tổng quan
            </a>
        </li>
        <li>
            <a href="/admin/categories" class="menu-dashboard">
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
            <a href="/admin/orders" class="menu-orders"></a>
                ><svg class="glyph stroked notepad ">
                    <use xlink:href="#stroked-notepad" />
                </svg>
                Đơn hàng
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
    </ul>
</div>

<input type="hidden" value="{{$activePage ?? ''}}" id="page-id" />
