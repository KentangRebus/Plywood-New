<nav class="sidebar sidebar-offcanvas" id="sidebar">
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
            <a class="nav-link" data-toggle="collapse" href="#purchase-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Purchase</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
            </a>
            <div class="collapse" id="purchase-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html">Add Purchase</a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html">Delete Purchase</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
