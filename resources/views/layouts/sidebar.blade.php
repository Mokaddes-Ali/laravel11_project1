            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="h-100" data-simplebar>

                    <!-- User box -->
                    <div class="user-box text-center">
                        <img src="{{asset('admin')}}/assets/images/users/avatar-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
                        <div class="dropdown">
                            <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown">Nik Patel</a>
                            <div class="dropdown-menu user-pro-dropdown">

                                <a href="pages-profile.html" class="dropdown-item notify-item">
                                    <i data-feather="user" class="icon-dual icon-xs me-1"></i><span>My Account</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i data-feather="settings" class="icon-dual icon-xs me-1"></i><span>Settings</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i data-feather="help-circle" class="icon-dual icon-xs me-1"></i><span>Support</span>
                                </a>
                                <a href="pages-lock-screen.html" class="dropdown-item notify-item">
                                    <i data-feather="lock" class="icon-dual icon-xs me-1"></i><span>Lock Screen</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i data-feather="log-out" class="icon-dual icon-xs me-1"></i><span>Logout</span>
                                </a>

                            </div>
                        </div>
                        <p class="text-muted">Admin Head</p>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <!-- <li class="menu-title">Navigation</li> -->

                            <li>
                                <a href="#sidebarDashboard" data-bs-toggle="collapse">
                                    <i data-feather="home"></i>
                                    <span> {{ __('messages.dashboard') }} </span>
                                    <!-- <span class="menu-arrow"></span> -->
                                </a>
                            </li>

                            <li class="menu-title mt-2">{{ __('messages.apps') }}</li>

                            <li>
                                <a href="apps-calendar.html">
                                    <i data-feather="calendar"></i>
                                    <span>{{ __('messages.calendar') }}   </span>
                                </a>
                            </li>

                            <li>
                                <a href="apps-chat.html">
                                    <i data-feather="message-square"></i>
                                    <span>{{ __('messages.chat') }}</span>
                                </a>
                            </li>

                            <li>
                                <a href="#sidebarUsers" data-bs-toggle="collapse">
                                    <i data-feather="user"></i>
                                    <span> {{ __('messages.users') }} </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarUsers">
                                    <ul class="nav-second-level">
                                        <li><a href="{{ url('/show') }}">All Users</a></li>

                                        <li><a href="{{ url('/user') }}">Add New User</a></li>

                                        <li><a href="{{ url('/role') }}">Add New Roles</a></li>
                                        <li><a href={{ route('roles.index') }}>Roles List</a></li>
                                    </ul>
                                </div>
                            </li>


                            <li>
                                <a href="#sidebarLoan" data-bs-toggle="collapse">
                                    <i data-feather="mail"></i>
                                    <span>Loan Schedule</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarLoan">
                                    <ul class="nav-second-level">
                                        <!-- Link for Create Loan -->
                                        <li><a href="{{ route('loans.create') }}" class="flex items-center space-x-2 hover:text-blue-400">
                                            <span>Create Loan</span>
                                        </a></li>
                                        <!-- Link for Loans List -->
                                        <li><a href="{{ route('loans.index') }}" class="flex items-center space-x-2 hover:text-blue-400">
                                            <span>Loans List</span>
                                        </a></li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarClient" data-bs-toggle="collapse">
                                    <i data-feather="mail"></i>
                                    <span>Register Client</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarClient">
                                    <ul class="nav-second-level">
                                        <!-- Link for Add Client -->
                                        <li><a href="/client">Register Now</a></li>
                                        <!-- Link for Manage Client -->
                                        <li><a href="/show/client">Register Deatils</a></li>
                                        <!-- Link for Manage Client -->
                                        @php
                use App\Models\Client;
                $client = Client::where('user_id', auth()->id())->first();
            @endphp
                                        @if($client)
                                        <li><a href="{{ route('client.shows', $client->id) }}">Register Application</a></li>
                                    @endif
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarProjects" data-bs-toggle="collapse">
                                    <i data-feather="briefcase"></i>
                                 <span> Projects </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarProjects">
                                    <ul class="nav-second-level">
                                        <li><a href="/project">Add Project</a></li>
                                        <li><a href="/show/project">All Projects</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarIncome" data-bs-toggle="collapse">
                                    <i data-feather="clipboard"></i>
                                    <span> Income </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarIncome"> <!-- Changed id here -->
                                    <ul class="nav-second-level">
                                        <li><a href="/income">Add Income</a></li>
                                        <li><a href="/show/income">List Income</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarExpense" data-bs-toggle="collapse">
                                    <i data-feather="clipboard"></i>
                                    <span> Expense </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarExpense"> <!-- Changed id here -->
                                    <ul class="nav-second-level">
                                        <li><a href="/expense">Add expense</a></li>
                                        <li><a href="/show/expense">List expense</a></li>
                                    </ul>
                                </div>
                            </li>


                            <li>
                                <a href="/settings">
                                    <i data-feather="file-plus"></i>
                                    <span> Settings </span>
                                </a>

                                <a href="/backup">
                                    <i data-feather="file-plus"></i>
                                    <span>Data Backup</span>
                                </a>
                                <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                    <i data-feather="log-out" class="icon-dual icon-xs me-1"></i><span>Logout</span>
                                </a>
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>

                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
