<!-- Sidebar -->
<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('/') }}asset/assets/img/sidebar-1.jpg">
    {{--        <div class="logo">--}}
    {{--            <a href="member-dashboard.html" class="simple-text logo-normal">--}}
    {{--                <img src="{{ asset('/') }}asset/images/logo.png">--}}
    {{--            </a>--}}
    {{--        </div>--}}

    <div class="sidebar-wrapper">
        <div class="page-wrapper chiller-theme toggled">

            <nav id="sidebar" class="sidebar-wrapper">
                <div class="logo">
                    <a href="{{ route('admin.home') }}" class="simple-text logo-normal">
                        <img src="{{ asset('/') }}asset/images/logo.png">
                    </a>
                </div>
                <div class="sidebar-content">

                    <div class="sidebar-menu">
                        <ul>

                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="far fa-gem"></i>
                                    <span>Setting</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        <li>
                                            <a href="{{ route('route.index') }}">Category List</a>
                                        </li>
{{--                                        <li>--}}
{{--                                            <a href="{{ route('warehouse.index') }}">Wearhouse </a>--}}
{{--                                        </li>--}}
                                        <li>
                                            <a href="{{ route('unit.index') }}">Country List</a>
                                        </li>

{{--                                        <li>--}}
{{--                                            <a href="{{ route('purchasecompany.index') }}">Purchase Company Name</a>--}}
{{--                                        </li>--}}

                                    </ul>
                                </div>
                            </li>


{{--                            <li class="sidebar-dropdown">--}}
{{--                                <a href="#">--}}
{{--                                    <i class="far fa-gem"></i>--}}
{{--                                    <span>Product</span>--}}
{{--                                </a>--}}
{{--                                <div class="sidebar-submenu">--}}
{{--                                    <ul>--}}
{{--                                        <li>--}}
{{--                                            <a href="{{ route('purchasecompany.create') }}">Add Category</a>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <a href="{{ route('category.index') }}">All Category</a>--}}
{{--                                        </li>--}}

{{--                                        <li>--}}
{{--                                            <a href="{{ route('product.index') }}">All Product</a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="sidebar-dropdown">--}}
{{--                                <a href="#">--}}
{{--                                    <i class="far fa-gem"></i>--}}
{{--                                    <span>Warehouse</span>--}}
{{--                                </a>--}}
{{--                                <div class="sidebar-submenu">--}}
{{--                                    <ul>--}}
{{--                                        @foreach(\App\Models\Warehouse::all() as $warehouse)--}}
{{--                                        <li>--}}
{{--                                            <a href="{{ route('warehouse.show',$warehouse->id) }}">{{ $warehouse->name }}</a>--}}
{{--                                        </li>--}}
{{--                                        @endforeach--}}

{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </li>--}}

{{--                            <li class="sidebar-dropdown">--}}
{{--                                <a href="#">--}}
{{--                                    <i class="far fa-gem"></i>--}}
{{--                                    <span>Company Stock</span>--}}
{{--                                </a>--}}
{{--                                <div class="sidebar-submenu">--}}
{{--                                    <ul>--}}
{{--                                        <li>--}}
{{--                                            <a href="{{ route('companyproduct.create') }}">Add Company Stock</a>--}}
{{--                                        </li>--}}

{{--                                        <li>--}}
{{--                                            <a href="{{ route('companyproduct.index') }}">All Company Stock</a>--}}
{{--                                        </li>--}}
{{--                                    @foreach(\App\Models\Purchasecompany::all() as $purchaseCompany)--}}
{{--                                        <li>--}}
{{--                                            <a href="{{ route('purchasecompany.show',$purchaseCompany->id) }}">{{ $purchaseCompany->name }} Company Stock</a>--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </li>--}}

{{--                            <li>--}}
{{--                                <a href="{{ route('admin.all_order') }}">--}}
{{--                                    <i class="fa fa-globe"></i>--}}
{{--                                    <span>Order List</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                            <li class="sidebar-dropdown">--}}
{{--                                <a href="#">--}}
{{--                                    <i class="far fa-gem"></i>--}}
{{--                                    <span>SR</span>--}}
{{--                                </a>--}}
{{--                                <div class="sidebar-submenu">--}}
{{--                                    <ul>--}}
{{--                                        <li>--}}
{{--                                            <a href="{{ route('sradd.settings') }}">SR Registration</a>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <a href="{{ route('sr.list') }}">All SR List</a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </li>--}}





{{--                            <li class="sidebar-dropdown">--}}
{{--                                <a href="#">--}}
{{--                                    <i class="far fa-gem"></i>--}}
{{--                                    <span>Income & Expense</span>--}}
{{--                                </a>--}}
{{--                                <div class="sidebar-submenu">--}}
{{--                                    <ul>--}}
{{--                                        <li>--}}
{{--                                            <a href="{{ route('income.create') }}">Add Income</a>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <a href="{{ route('expense.create') }}">Add Expense</a>--}}
{{--                                        </li>--}}

{{--                                        <li>--}}
{{--                                            <a href="{{ route('income.index') }}">View Income & Expense</a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </li>--}}

                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="far fa-gem"></i>
                                    <span>Participant</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
{{--                                        <li>--}}
{{--                                            <a href="{{ route('driver.index') }}">All Driver List</a>--}}
{{--                                        </li>--}}


                                        <li>
                                            <a href="{{ route('trip.index') }}">Participant List</a>
                                        </li>

                                    </ul>
                                </div>
                            </li>



                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>

                        </ul>
                    </div>
                    <!-- sidebar-menu  -->
                </div>

            </nav>
        </div>
    </div>
</div>
<!-- Side Bar -->




