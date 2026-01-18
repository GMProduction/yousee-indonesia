<div style="
    background: white;
    padding: 24px;
    width: 100%; /* Atau fix width misal 280px */
">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">

        <h3 style="margin: 0; color: #6b7280; font-size: 14px; font-weight: 600;">
            {{ $title }}
        </h3>

        <div
            style="
            background-color: #fef2f2;
            color: #ef4444;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        ">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="8.5" cy="7" r="4"></circle>
                <line x1="20" y1="8" x2="20" y2="14"></line>
                <line x1="23" y1="11" x2="17" y2="11"></line>
            </svg>
        </div>
    </div>

    <div
        style="
        font-size: 30px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 8px;
        line-height: 1;
    ">
        {{-- Format Angka Jadi "K" (Ribuan) --}}
        {{ $stats['value'] >= 1000 ? number_format($stats['value'] / 1000, 2) . 'K' : $stats['value'] }}
    </div>

    <div style="display: flex; align-items: center; font-size: 12px; font-weight: 600;">

        <span
            style="
            color: {{ $stats['is_up'] ? '#10b981' : '#ef4444' }};
            display: flex;
            align-items: center;
            margin-right: 8px;
        ">
            @if ($stats['is_up'])
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                    <polyline points="17 6 23 6 23 12"></polyline>
                </svg>
            @else
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="23 18 13.5 8.5 8.5 13.5 1 6"></polyline>
                    <polyline points="17 18 23 18 23 12"></polyline>
                </svg>
            @endif

            <span style="margin-left: 4px;">{{ abs($stats['percent']) }}%</span>
        </span>

        <span style="color: #9ca3af; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px;">
            {{ $label }}
        </span>
    </div>
</div>
