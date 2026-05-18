<div>
    <ul class="nav nav-tabs">

        <li class="nav-item">
            <a 
            class="nav-link {{ $activeTab == 'accounts' ? 'active' : '' }}" 
            href="{{ route('accounts.index', ['tab' => 'accounts', 'flag' => 'true']) }}" 
            >
            Accounts
            </a>
        </li>

        <li class="nav-item">
            <a 
            class="nav-link {{ $activeTab == 'journals' ? 'active' : '' }}" 
            href="{{ route('journals.index', ['tab' => 'journals', 'flag' => 'true']) }}"
            >
            Journals
            </a>
        </li>

        <li class="nav-item">
            <a 
            class="nav-link {{ $activeTab == 'ledger' ? 'active' : '' }}" 
            href="{{ route('ledger.index', ['tab' => 'ledger', 'flag' => 'true']) }}"
        >
            Ledger
            </a>
        </li>

    </ul>
    <br>

Ladger
</div>
