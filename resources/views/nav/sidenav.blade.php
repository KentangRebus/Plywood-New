<nav class="sidebar sidebar-offcanvas position-fixed" id="sidebar">
    <ul class="nav">
        @if(\Illuminate\Support\Facades\Auth::user()->role == "admin")
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">
                    <span class="menu-title">Dashboard</span>
                    <i class="mdi mdi-home menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('transaction-view')}}">
                    <span class="menu-title">Transaksi</span>
                    <i class="mdi mdi-barcode menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('product-view')}}">
                    <span class="menu-title">Produk</span>
                    <i class="mdi mdi-cube menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('purchase-view')}}">
                    <span class="menu-title">Pembelian</span>
                    <i class="mdi mdi-archive menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('customer-view')}}">
                    <span class="menu-title">Member</span>
                    <i class="mdi mdi-account-multiple menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('category-view')}}">
                    <span class="menu-title">Kategori</span>
                    <i class="mdi mdi-cart menu-icon"></i>
                </a>
            </li>
        @elseif(\Illuminate\Support\Facades\Auth::user()->role == "staff")
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">
                    <span class="menu-title">Dashboard</span>
                    <i class="mdi mdi-home menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('transaction-view')}}">
                    <span class="menu-title">Transaksi</span>
                    <i class="mdi mdi-barcode menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('customer-view')}}">
                    <span class="menu-title">Member</span>
                    <i class="mdi mdi-account-multiple menu-icon"></i>
                </a>
            </li>
        @endif

    </ul>
</nav>
