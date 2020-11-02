<nav class="colorlib-nav" role="navigation">
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-2">
                    <div id="colorlib-logo"><a href="/"><img src="/assets/client/images/logo.png" alt="" style="width: 125px;height: 61px;"></a></div>
                </div>
                <div class="col-xs-10 text-right menu-1">
                    <ul>
                        <li><a href="/" class="menu-home">Trang chủ</a></li>
                        {{-- <li class="has-dropdown">
                            <a href="/shop">Cửa hàng</a>
                            <ul class="dropdown">
                                <li><a href="/cart">Giỏ hàng</a></li>
                                <li><a href="/checkout">Thanh toán</a></li>

                            </ul>
                        </li> --}}
                        <li><a href="/product" class="menu-product">Sản phẩm</a></li>
                        <li><a href="/about" class="menu-about">Giới thiệu</a></li>
                        <li><a href="/contact" class="menu-contact">Liên hệ</a></li>
                        <li><a href="/cart" class="menu-cart"><i class="icon-shopping-cart"></i> Giỏ hàng [<span class="cart-total-quantity">{{ \Cart::getTotalQuantity() }}</span>]</a></li>
                        {{--  @if (!auth()->guard('client')->check())
                        <li><a href="/login" class="menu-login"> Login</a></li>
                        @endif  --}}
                        @guest('client')
                        <li><a href="/login" class="menu-login"> Login</a></li>
                        @endguest
                        @auth('client')
                        <li class="has-dropdown">
                            <a href="#"> {{ auth()->guard('client')->user()->name }}</a>
                            <ul class="dropdown">
                                <li>
                                    <a href="#">Thông tin</a>
                                </li>
                                <li>
                                    <a href="login.html" onclick="event.preventDefault();document.getElementById('logout-form').submit()">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<form action="/logout" method="POST" id="logout-form">
    @csrf
</form>
<input type="hidden" value="{{ $activePage ?? '' }}" id="page-id">
