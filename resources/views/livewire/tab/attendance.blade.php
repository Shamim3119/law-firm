    <ul class="nav nav-tabs">

        <li class="nav-item">
            <a 
            class="nav-link {{ $activeTab == 'attendance-info' ? 'active' : '' }}" 
            href="{{ route('attendance-info.index', ['tab' => 'attendance-info', 'flag' => 'true']) }}" 
            >
            Attendance Info
            </a>
        </li>

        <li class="nav-item">
            <a 
            class="nav-link {{ $activeTab == 'attendance-status' ? 'active' : '' }}" 
            href="{{ route('attendance-status.index', ['tab' => 'attendance-status', 'flag' => 'true']) }}"
            >
            Attendance Status
            </a>
        </li>
    </ul>

    <br> 