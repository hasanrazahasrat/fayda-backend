<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #20409a;">
    <a href="/admin" class="brand-link">
        <img src="{{ asset('assets/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Nadec</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Merchant</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('merchant/dashboard/') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{route('merchant.order.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p> Orders</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p> Items
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{route('merchant.item.create')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('merchant.item.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p> Documents
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>


                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{route('merchant.document.create')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('merchant.document.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--<li class="nav-item has-treeview">-->
                <!--    <a href="#" class="nav-link">-->
                <!--        <i class="nav-icon fa fa-user"></i>-->
                <!--        <p> Settings-->
                <!--            <i class="fas fa-angle-left right"></i>-->
                <!--        </p>-->
                <!--    </a>-->


                <!--    <ul class="nav nav-treeview" style="display: none;">-->
                <!--        <li class="nav-item">-->
                <!--            <a href="http://faida.test/admin/add_user" class="nav-link ">-->
                <!--                <i class="far fa-circle nav-icon"></i>-->
                <!--                <p>Add</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--        <li class="nav-item">-->
                <!--            <a href="http://faida.test/admin/view_users" class="nav-link ">-->
                <!--                <i class="far fa-circle nav-icon"></i>-->
                <!--                <p>List</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</li>-->
            </ul>
        </nav>
    </div>
</aside>
