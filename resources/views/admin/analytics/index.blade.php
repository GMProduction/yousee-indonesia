@extends('admin.base')

@section('content')
    <div class="dashboard">
        <div class="menu-container">
            <div class="menu d-flex justify-content-between ">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="me-5">
                    <ol class="breadcrumb mb-0 ">
                        <li class="breadcrumb-item "><a href="#">Dashboard Analitycs</a></li>
                    </ol>
                </nav>

                <div class="d-flex align-items-center " style="color: gray">
                    <span class="material-symbols-outlined me-2 ">
                        error
                    </span><span>Jika ada pertanyaan, silahkan hubungi admin</span>
                </div>
            </div>
        </div>

        <div class="menu-container">
            <div class="menu d-flex justify-content-between ">
                <x-analytics.visitors-chart title="Trafik Pengunjung Website" />
            </div>
        </div>

        <div class="row g-4 ">

            <div class="col-lg-6">
                <x-analytics.top-content title="Top 5 Artikel Populer"
                    apiUrl="{{ route('analytics.content', ['filter' => '/artikel/']) }}" />
            </div>

            <div class="col-lg-6">
                <x-analytics.top-content title="Top 5 Listing Properti"
                    apiUrl="{{ route('analytics.content', ['filter' => '/listing/']) }}" />
            </div>

            <div class="col-lg-12">
                <x-analytics.top-sources />
            </div>
        </div>
        <x-analytics.detail-modal />

    </div>
@endsection

@section('morejs')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
