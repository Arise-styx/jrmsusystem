<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    {{-- <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('admin') }}" target="_blank">
            <img src="{{ asset('backend/assets/img/moelcilogo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">MOELCI UNO</span>
        </a>
        <div>
            <label class="text-center badge bg-success mx-1"> {{ $user->name }} </label>
        </div>
    </div> --}}
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('admin') }}" target="_blank">
            {{-- <img src="{{ asset('backend/assets/img/moelcilogo.png') }}" class="navbar-brand-img h-100" alt="main_logo"> --}}
            <span class="ms-1 font-weight-bold">CCS ACADEMIC</span>
        </a>
        <div class="d-flex justify-content-center my-0">
            <label class="text-center badge bg-primary">{{ auth()->user()->name }}</label>
        </div>
    </div>

    <hr class="horizontal dark mt-5">



    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav navbar-nav-menu">
            @role('super-admin|admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('admin') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endrole

            @role('audit|super-admin|admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('studentdashboard') ? 'active' : '' }}"
                        href="{{ route('studentdashboard') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-bullet-list-67 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Student Profile</span>
                    </a>
                </li>
            @endrole

{{--
            @role('hr|super-admin|admin')
                <li class="nav-item">


                    <a href="{{ route('motorpool') }}"
                        class="nav-link menu-link menu-toggle {{ request()->routeIs('admin/motorpool/*') || request()->is('admin/motorpool') ? 'open active' : '' }}">

                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-bus-front-12 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Motorpool Info System</span>
                    </a>

                    <ul class="nav menu-sub" id="motorpoolSubMenu"
                        style="{{ request()->is('admin/motorpool/*', 'admin/motorpool') ? 'display: block;' : 'display: none;' }}">

                        @can('add driver')
                            <li class="nav-item menu-item">

                                <a href="{{ route('adddriverpage') }}"
                                    class="nav-link menu-link {{ request()->is('admin/motorpool/add_driver') ? 'active' : '' }}">
                                    <div style="margin-left: 25px;">
                                        <i class="fa-solid fa-user-plus text-info text-sm opacity-10"></i>
                                    </div>
                                    <span class="nav-link-text ms-2"> Add Driver</span>
                                </a>
                            </li>
                        @endcan

                        @can('add vehicle')
                            <li class="nav-item menu-item">
                                <a href="{{ route('addvehiclepage') }}"
                                    class="nav-link menu-link {{ request()->is('admin/motorpool/add_vehicle') ? 'active' : '' }}">
                                    <div style="margin-left: 25px;">
                                        <i class="fa-solid fa-car text-info text-sm opacity-10"></i>
                                    </div>
                                    <span class="nav-link-text ms-2"> Add Vehicle</span>
                                </a>
                            </li>
                        @endcan

                        @can('add labor')
                            <li class="nav-item menu-item">
                                <a href="{{ route('addlaborpage') }}"
                                    class="nav-link menu-link {{ request()->is('admin/motorpool/add_labor') ? 'active' : '' }}">
                                    <div style="margin-left: 25px;">
                                        <i class="fa-solid fa-wrench text-info text-sm opacity-10"></i>
                                    </div>
                                    <span class="nav-link-text ms-2"> Add Labor Txn</span>
                                </a>
                            </li>
                        @endcan

                        @can('add replacement')
                            <li class="nav-item menu-item">
                                <a href="{{ route('addreplacementpage') }}"
                                    class="nav-link menu-link {{ request()->is('admin/motorpool/add_replacement') ? 'active' : '' }}">
                                    <div style="margin-left: 25px;">
                                        <i class="fa-solid fa-draw-polygon text-info text-sm opacity-10"></i>
                                    </div>
                                    <span class="nav-link-text ms-2"> Add Replacement Txn</span>
                                </a>
                            </li>
                        @endcan

                        @can('list labors')
                            <li class="nav-item menu-item">
                                <a class="nav-link menu-link {{ request()->is('admin/motorpool/alllabor') ? 'active' : '' }}"
                                    href="{{ route('alllabor') }}">
                                    <div style="margin-left: 25px;">
                                        <i class="fa-regular fa-rectangle-list text-info text-sm opacity-10"></i>
                                    </div>
                                    <span class="nav-link-text ms-2"> Labor Transactions</span>
                                </a>
                            </li>
                        @endcan

                        @can('list replacements')
                            <li class="nav-item menu-item">
                                <a class="nav-link menu-link {{ request()->is('admin/motorpool/allpartsreplacement') ? 'active' : '' }}"
                                    href="{{ route('allpartsreplacement') }}">
                                    <div style="margin-left: 25px;">
                                        <i class="fa-solid fa-table-list text-info text-sm opacity-10"></i>
                                    </div>
                                    <span class="nav-link-text ms-2">Parts Replacement Transactions</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endrole --}}

            {{-- <li class="nav-item">
                @role('super-admin|gm-secretary|reg-user|admin|accounting-officer|audit|finance|for_finance|for_general-manager|for_corplan|for_audit')
                    <a href="{{ route('fuelrequisition') }}"
                        class="nav-link menu-link menu-toggle {{ request()->routeIs('admin/fuelrequisition') || request()->is('admin/fuelrequisition') ? 'open active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-gas-pump text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Fuel Requisitions</span>
                    </a>
                @endrole

                @role('super-admin|hr|general-manager|corplan|admin|finance|audit|for_finance|for_audit|for_general-manager|for_corplan')
                    <ul class="nav menu-sub" id="FuelSubMenu"
                        style="{{ request()->is('admin/fuelrequisition/*', 'admin/fuelrequisition') ? 'display: block;' : 'display: none;' }}">

                        <li class="nav-item menu-item">
                            <a href="{{ route('fuelrequestsdashboard') }}"
                                class="nav-link menu-link {{ request()->is('admin/fuelrequisition/dashboard') ? 'active' : '' }}">
                                <div style="margin-left: 25px;">
                                    <i class="fa-solid fa-thumbs-up text-info text-sm opacity-10"></i>
                                </div>
                                <span class="nav-link-text ms-2"> Fuel Requests Approval</span>
                            </a>
                        </li>

                        <li class="nav-item menu-item">
                            <a href="{{ route('rejectedfuelrequestsdashboard') }}"
                                class="nav-link menu-link {{ request()->is('admin/fuelrequisition/rejected/dashboard') ? 'active' : '' }}">
                                <div style="margin-left: 25px;">
                                    <i class="fa-solid fa-thumbs-down text-danger text-sm opacity-10"></i>
                                </div>
                                <span class="nav-link-text ms-2">Rejected Fuel Requests</span>
                            </a>
                        </li>
                    </ul>
                @endrole
            </li> --}}

            {{-- @role('super-admin|accounting-officer|admin')
                <li class="nav-item">
                    <a href="{{ route('addaccountingcodedashboard') }}"
                        class="nav-link menu-link {{ request()->is('admin/fuelrequisition/add_accountingcode') ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-receipt text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Add Accounting Code</span>
                    </a>
                </li>
            @endrole

            @haspermission('add weekly fuel price')
                <li class="nav-item">
                    <a href="{{ route('addweeklyfuelpricedashboard') }}"
                        class="nav-link menu-link {{ request()->is('admin/fuelrequisition/add_weeklyfuelpricedashboard') ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-peso-sign text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Add Weekly Price</span>
                    </a>
                </li>
            @endhaspermission --}}

            {{-- @role('super-admin|accounting-officer|admin')
            <li class="nav-item">
                <a href="{{ route('addleaverequest') }}"
                    class="nav-link menu-link {{ request()->is('admin/fuelrequisition/leave_request') ? 'active' : '' }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-receipt text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Add leave Code</span>
                </a>
            </li>
            @endrole --}}

            {{-- @role('super-admin|admin|gm-secretary')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/fuelrequisition/download/dashboard') ? 'active' : '' }}"
                        href="{{ route('downloadfuelrequestsdashboard') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-download text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Fuel Requests Download</span>
                    </a>
                </li>
            @endrole


            @role('super-admin|admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/humanresource/employees') ? 'active' : '' }}"
                        href="{{ route('allemployees') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-regular fa-address-card text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">All Employees</span>
                    </a>
                </li>
            @endrole --}}
{{--
            @role('super-admin|admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/humanresource/add_employee') ? 'active' : '' }}"
                        href="{{ route('addemployeepage') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-fat-add text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Add Employee</span>
                    </a>
                </li>
            @endrole


            @role('super-admin|admin|department-heads|reg-user')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/leaveapproval/pendinglist2') ? 'active' : '' }}"
                        href="{{ route('leavepending2') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-regular fa-address-card text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Leave Management</span>
                    </a>
                </li>
            @endrole

            @role('general-manager')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/leaveapproval/gmpendinglist') ? 'active' : '' }}"
                        href="{{ route('finalleaveapproval') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-regular fa-address-card text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Leave Management</span>
                    </a>
                </li>
            @endrole

            <li class="nav-item menu-item">
                <a href="{{ route('approvedemployeeleave') }}"
                    class="nav-link menu-link {{ request()->is('admin/leaveapproval/approved') ? 'active' : '' }}">
                    <div style="margin-left: 25px;">
                        <i class="fa-solid fa-thumbs-up text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-2"> Approved Leave Request </span>
                </a>
            </li>

            <li class="nav-item menu-item">
                <a href="{{ route('rejectedemployeeleave') }}"
                    class="nav-link menu-link {{ request()->is('admin/leaveapproval/disapproved') ? 'active' : '' }}">
                    <div style="margin-left: 25px;">
                        <i class="fa-solid fa-thumbs-down text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-2">Rejected Leave Request</span>
                </a>
            </li>

            <li class="nav-item menu-item">
                <a href="{{ route('employeecreditsbalance') }}"
                    class="nav-link menu-link {{ request()->is('admin/leaveapproval/employeebalance') ? 'active' : '' }}">
                    <div style="margin-left: 25px;">
                        <i class="fa-regular fa-address-card text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-2">Employee Balance</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/leaveapproval/download/dashboard') ? 'active' : '' }}"
                    href="{{ route('downloadleaverequest') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-download text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Leave Requests Download</span>
                </a>
            </li>

            @role('super-admin|admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('reports') ? 'active' : '' }}" href="{{ route('reporting') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Reports</span>
                    </a>
                </li>
            @endrole

            <li class="nav-item">
                <form id="logoutform" action="{{ route('logout') }}" method="post">
                    @csrf
                    <a class="nav-link" href="javascript:void(0)"
                        onclick="document.getElementById('logoutform').submit();">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-right-from-bracket text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Logout</span>
                    </a>
                </form>
            </li> --}}


        </ul>
    </div>

    <script>
        function toggleSubMenu() {
            var motorpoolSubMenu = document.getElementById("motorpoolSubMenu");
            motorpoolSubMenu.style.display = (motorpoolSubMenu.style.display === "block") ? "none" : "block";
        }
    </script>
</aside>
