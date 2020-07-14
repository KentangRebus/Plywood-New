<nav class="sidebar sidebar-offcanvas position-fixed" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#transaction-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Transaction</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-barcode menu-icon"></i>
            </a>
            <div class="collapse" id="transaction-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html">Add Transaction</a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html">Delete Transaction</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('product-view')}}">
                <span class="menu-title">Products</span>
                <i class="mdi mdi-cube menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('purchase-view')}}">
                <span class="menu-title">Purchase</span>
                <i class="mdi mdi-archive menu-icon"></i>
            </a>
        </li>

    </ul>
</nav>
