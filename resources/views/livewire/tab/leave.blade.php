    <ul class="nav nav-tabs">

        <li class="nav-item">
            <a 
            class="nav-link {{ $activeTab == 'leave-info' ? 'active' : '' }}" 
            href="{{ route('leave-info.index', ['tab' => 'leave-info', 'flag' => 'true']) }}" 
            >
            Leave Info
            </a>
        </li>

        <li class="nav-item">
            <a 
            class="nav-link {{ $activeTab == 'leave-status' ? 'active' : '' }}" 
            href="{{ route('leave-status.index', ['tab' => 'leave-status', 'flag' => 'true']) }}"
            >
            Leave Status
            </a>
        </li>
    </ul>

    <br> 