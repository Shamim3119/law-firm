    <ul class="nav nav-tabs">

        <li class="nav-item">
            <a 
            class="nav-link {{ $activeTab == 'leave-schedule' ? 'active' : '' }}" 
            href="{{ route('leave-schedule.index', ['tab' => 'leave-schedule', 'isModal' => 'false']) }}" 
            >
            Leave Schedule
            </a>
        </li>

        <li class="nav-item">
            <a 
            class="nav-link {{ $activeTab == 'prorated-leave' ? 'active' : '' }}" 
            href="{{ route('prorated-leave.index', ['tab' => 'prorated-leave', 'isModal' => 'false']) }}"
            >
            Prorated Leave
            </a>
        </li>

        <li class="nav-item">
            <a 
            class="nav-link {{ $activeTab == 'leave-calendar' ? 'active' : '' }}" 
            href="{{ route('leave-calendar.index', ['tab' => 'leave-calendar', 'isModal' => 'false']) }}"
        >
            Leave Calendar
            </a>
        </li>
    </ul>

    <br> 