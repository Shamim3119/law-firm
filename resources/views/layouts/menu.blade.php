        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="navigation"
              aria-label="Main navigation"
              data-accordion="false"
              id="navigation"
            >
              <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>Dashboard</p>
                </a>
              </li>


              <li class="nav-item {{ request()->routeIs('parameter.*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link active">
                  <i class="nav-icon bi bi-bricks"></i>
                  <p>
                    Parameters
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('parameter.index', ['tab' => 'religion']) }}" class="nav-link {{ request('tab') == 'religion' ? 'active' : '' }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Religion</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('parameter.index', ['tab' => 'department']) }}" class="nav-link {{ request('tab') == 'department' ? 'active' : '' }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Department</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('parameter.index', ['tab' => 'designation']) }}" class="nav-link {{ request('tab') == 'designation' ? 'active' : '' }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Designation</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('parameter.index', ['tab' => 'appointment-type']) }}" class="nav-link {{ request('tab') == 'appointment-type' ? 'active' : '' }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Appointment Type</p>
                    </a>
                </li>

                </ul>
              </li>


              <li class="nav-item {{ request()->routeIs('client.*') || request()->routeIs('appointment.*') || request()->routeIs('cases.*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link active">
                  <i class="nav-icon bi bi-boxes"></i>
                  <p>
                    Cases & Appointments
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('client.index', ['tab' => 'clients']) }}" class="nav-link {{ request('tab') == 'clients' ? 'active' : '' }}">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Clients</p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ route('appointment.index', ['tab' => 'appointments']) }}" class="nav-link {{ request('tab') == 'appointments' ? 'active' : '' }}">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Appointments</p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ route('cases.index', ['tab' => 'cases']) }}" class="nav-link {{ request('tab') == 'cases' ? 'active' : '' }}">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Cases</p>
                      </a>
                  </li>

                </ul>
              </li>


              <li class="nav-item">
                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                  <i class="nav-icon bi bi-arrow-left-square"></i>
                  <p>Logout</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form>
              </li>

  
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>