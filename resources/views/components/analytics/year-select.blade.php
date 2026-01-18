@props(['chartId'])

@php
    // Logic Tanggal
    $currentYear = date('Y'); // Tahun server saat ini
    $startYear = 2025;
    $endYear = 2035;
@endphp

<div>
    <select id="yearSelect_{{ $chartId }}" onchange="loadMonthly_{{ $chartId }}()" class="form-select shadow-sm "
        style="cursor: pointer; width: 100px;" aria-label="Pilih Tahun">
        @for ($year = $startYear; $year <= $endYear; $year++)
            <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>
                {{ $year }}
            </option>
        @endfor
    </select>
</div>
