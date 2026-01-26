<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Google\Analytics\Data\V1beta\OrderBy\MetricOrderBy;
use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\RunReportRequest;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\OrderBy;
use Google\Analytics\Data\V1beta\FilterExpression;
use Google\Analytics\Data\V1beta\Filter;
use Google\Analytics\Data\V1beta\Filter\StringFilter;
use Google\Analytics\Data\V1beta\Filter\StringFilter\MatchType;

class AnalyticsController extends Controller
{

    private $property_id = '465288730';
    private $credentials_path;

    public function __construct()
    {
        $this->credentials_path = storage_path('app/analytics/service-account-credentials.json');
    }

    public function index()
    {

        return view('admin.analytics.index');
    }
    // --- API 1: DATA BULANAN (Untuk Grafik Utama) ---
    public function getMonthlyData(Request $request)
    {
        $year = $request->input('year', date('Y')); // Default tahun ini

        // Cache unik per tahun
        return Cache::remember("ga4_monthly_{$year}", 3600, function () use ($year) {

            $client = new BetaAnalyticsDataClient(['credentials' => $this->credentials_path]);

            $request = new RunReportRequest([
                'property' => 'properties/' . $this->property_id,
                'date_ranges' => [
                    new DateRange(['start_date' => "{$year}-01-01", 'end_date' => "{$year}-12-31"]),
                ],
                'dimensions' => [new Dimension(['name' => 'month'])], // Keluarannya: 01, 02, ... 12
                'metrics' => [new Metric(['name' => 'activeUsers'])],
                'order_bys' => [
                    new OrderBy([
                        'dimension' => new OrderBy\DimensionOrderBy(['dimension_name' => 'month'])
                    ])
                ]
            ]);

            $response = $client->runReport($request);

            // Siapkan array kosong 12 bulan (agar grafik tetap rapi meski data bulan tertentu 0)
            $data = array_fill(1, 12, 0);

            foreach ($response->getRows() as $row) {
                $monthIndex = (int) $row->getDimensionValues()[0]->getValue();
                $users = (int) $row->getMetricValues()[0]->getValue();
                $data[$monthIndex] = $users;
            }

            return response()->json([
                'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                'values' => array_values($data) // Reset index array
            ]);
        });
    }

    // --- API 2: DATA HARIAN (Untuk Detail Drilldown) ---
    public function getDailyData(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $month = str_pad($request->input('month'), 2, '0', STR_PAD_LEFT); // Pastikan format 01, 02

        // Tentukan tanggal akhir bulan (28/30/31)
        $endDate = date('t', strtotime("$year-$month-01"));

        return Cache::remember("ga4_daily_{$year}_{$month}", 3600, function () use ($year, $month, $endDate) {

            $client = new BetaAnalyticsDataClient(['credentials' => $this->credentials_path]);

            $request = new RunReportRequest([
                'property' => 'properties/' . $this->property_id,
                'date_ranges' => [
                    new DateRange([
                        'start_date' => "{$year}-{$month}-01",
                        'end_date' => "{$year}-{$month}-{$endDate}"
                    ]),
                ],
                'dimensions' => [new Dimension(['name' => 'day'])], // Keluarannya: 01, 02... 31
                'metrics' => [new Metric(['name' => 'activeUsers'])],
                'order_bys' => [
                    new OrderBy([
                        'dimension' => new OrderBy\DimensionOrderBy(['dimension_name' => 'day'])
                    ])
                ]
            ]);

            $response = $client->runReport($request);

            // Siapkan array tanggal 1 s/d akhir bulan
            $data = [];
            for ($d = 1; $d <= $endDate; $d++) {
                $data[$d] = 0;
            }

            foreach ($response->getRows() as $row) {
                $dayIndex = (int) $row->getDimensionValues()[0]->getValue();
                $data[$dayIndex] = (int) $row->getMetricValues()[0]->getValue();
            }

            return response()->json([
                'labels' => array_keys($data), // [1, 2, 3, ... 31]
                'values' => array_values($data)
            ]);
        });
    }

    private function getTopContent($keywordFilter, $limit = 5)
    {
        $client = new BetaAnalyticsDataClient(['credentials' => $this->credentials_path]);

        $request = new RunReportRequest([
            'property' => 'properties/' . $this->property_id,
            'date_ranges' => [
                new DateRange(['start_date' => '30daysAgo', 'end_date' => 'today']),
            ],
            'dimensions' => [
                new Dimension(['name' => 'pagePath']),
                new Dimension(['name' => 'pageTitle']),
            ],
            'metrics' => [
                new Metric(['name' => 'screenPageViews']),
            ],
            'dimension_filter' => new FilterExpression([
                'filter' => new Filter([
                    'field_name' => 'pagePath',
                    'string_filter' => new StringFilter([
                        'match_type' => MatchType::CONTAINS,
                        'value' => $keywordFilter,
                        'case_sensitive' => false
                    ])
                ])
            ]),
            'order_bys' => [
                new OrderBy([
                    'desc' => true,
                    // PERBAIKAN DI SINI: Langsung panggil MetricOrderBy (pastikan sudah di-use di atas)
                    'metric' => new MetricOrderBy(['metric_name' => 'screenPageViews'])
                ])
            ],
            'limit' => (int) $limit,
        ]);

        try {
            $response = $client->runReport($request);

            $data = [];
            foreach ($response->getRows() as $row) {
                $data[] = [
                    'url'   => $row->getDimensionValues()[0]->getValue(),
                    'title' => $row->getDimensionValues()[1]->getValue(),
                    'views' => (int) $row->getMetricValues()[0]->getValue(),
                ];
            }
            return $data;
        } catch (\Throwable $e) {
            dd($e->getMessage());

            return [];
        }
    }

    public function getTopContentData(Request $request)
    {
        $keyword = $request->input('filter', '/artikel/'); // Default cari artikel

        $limit = $request->input('limit', 5);

        $cacheKey = 'ga4_content_' . md5($keyword) . '_' . $limit;

        // Cache 1 jam biar gak berat
        $data = Cache::remember($cacheKey, 3600, function () use ($keyword, $limit) {

            // 4. PANGGIL FUNGSI HELPER DENGAN LIMIT
            return $this->getTopContent($keyword, $limit);
        });

        return response()->json($data);
    }

    public function getCityDataByDate(Request $request)
    {
        $date = $request->input('date');
        if (!$date) return response()->json([]);

        $cacheKey = 'ga4_city_' . $date;

        return Cache::remember($cacheKey, 86400, function () use ($date) {

            $client = new BetaAnalyticsDataClient(['credentials' => $this->credentials_path]);

            $request = new RunReportRequest([
                'property' => 'properties/' . $this->property_id,
                'date_ranges' => [
                    new DateRange(['start_date' => $date, 'end_date' => $date]),
                ],
                'dimensions' => [
                    new Dimension(['name' => 'city']),
                    new Dimension(['name' => 'country']), // <--- TAMBAH INI
                ],
                'metrics' => [
                    new Metric(['name' => 'activeUsers']),
                ],
                'order_bys' => [
                    new OrderBy([
                        'desc' => true,
                        'metric' => new OrderBy\MetricOrderBy(['metric_name' => 'activeUsers'])
                    ])
                ],
                'limit' => 100,
            ]);

            try {
                $response = $client->runReport($request);
                $data = [];

                foreach ($response->getRows() as $row) {
                    $city = $row->getDimensionValues()[0]->getValue();
                    $country = $row->getDimensionValues()[1]->getValue();

                    // Cek apakah Luar Negeri? (Case insensitive biar aman)
                    $isForeign = strtolower($country) !== 'indonesia';

                    $data[] = [
                        // Format Judul: "Surakarta (Indonesia)"
                        'title' => "{$city} ({$country})",
                        'url'   => '',
                        'views' => (int) $row->getMetricValues()[0]->getValue(),

                        // Kirim sinyal ke frontend
                        'is_foreign' => $isForeign
                    ];
                }
                return $data;
            } catch (\Throwable $e) {
                return [];
            }
        });
    }

    // --- API: City By Month (Untuk Drill-down Bulanan) ---
    public function getCityDataByMonth(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');

        if (!$year || !$month) return response()->json([]);

        // Tentukan Tanggal Awal & Akhir Bulan
        // str_pad untuk memastikan bulan jadi '01', '02', dst
        $month = str_pad($month, 2, '0', STR_PAD_LEFT);
        $startDate = "{$year}-{$month}-01";
        $endDate   = date('Y-m-t', strtotime($startDate)); // 't' mengambil tanggal terakhir (28/30/31)

        $cacheKey = "ga4_city_month_{$year}_{$month}";

        return Cache::remember($cacheKey, 86400, function () use ($startDate, $endDate) {

            $client = new BetaAnalyticsDataClient(['credentials' => $this->credentials_path]);

            $request = new RunReportRequest([
                'property' => 'properties/' . $this->property_id,
                'date_ranges' => [
                    // Range 1 Bulan Full
                    new DateRange(['start_date' => $startDate, 'end_date' => $endDate]),
                ],
                'dimensions' => [
                    new Dimension(['name' => 'city']),
                    new Dimension(['name' => 'country']),
                ],
                'metrics' => [
                    new Metric(['name' => 'activeUsers']),
                ],
                'order_bys' => [
                    new OrderBy([
                        'desc' => true,
                        'metric' => new OrderBy\MetricOrderBy(['metric_name' => 'activeUsers'])
                    ])
                ],
                'limit' => 100,
            ]);

            try {
                $response = $client->runReport($request);
                $data = [];

                foreach ($response->getRows() as $row) {
                    $city = $row->getDimensionValues()[0]->getValue();
                    $country = $row->getDimensionValues()[1]->getValue();
                    $isForeign = strtolower($country) !== 'indonesia';

                    $data[] = [
                        'title' => "{$city} ({$country})",
                        'url'   => '',
                        'views' => (int) $row->getMetricValues()[0]->getValue(),
                        'is_foreign' => $isForeign
                    ];
                }
                return $data;
            } catch (\Throwable $e) {
                return [];
            }
        });
    }

    public function getTrafficSources()
    {
        try {
            $client = new BetaAnalyticsDataClient(['credentials' => $this->credentials_path]);

            // Request: sessionSourceMedium (Untuk membedakan Organic vs CPC/Ads)
            $response = $client->runReport(new RunReportRequest([
                'property' => 'properties/' . $this->property_id,
                'date_ranges' => [new DateRange(['start_date' => '30daysAgo', 'end_date' => 'today'])],
                'dimensions' => [new Dimension(['name' => 'sessionSourceMedium'])],
                'metrics' => [new Metric(['name' => 'activeUsers'])],
                'limit' => 15,
                'order_bys' => [new OrderBy(['desc' => true, 'metric' => new OrderBy\MetricOrderBy(['metric_name' => 'activeUsers'])])]
            ]));

            $data = [];
            $totalAll = 0;

            // 1. Parsing Data Mentah
            foreach ($response->getRows() as $row) {
                $fullString = $row->getDimensionValues()[0]->getValue(); // Ex: "google / cpc"
                $users = (int) $row->getMetricValues()[0]->getValue();

                // Pecah Source dan Medium
                // "google / organic" -> parts[0]="google", parts[1]="organic"
                $parts = explode('/', $fullString);
                $sourceName = trim($parts[0] ?? 'Direct');
                $medium = isset($parts[1]) ? trim($parts[1]) : '';

                // Deteksi Icon & Warna (Logic Backend)
                $icon = 'bi-globe';
                $color = 'text-muted';
                if (str_contains($sourceName, 'google')) {
                    $icon = 'bi-google';
                    $color = 'text-danger';
                } elseif (str_contains($sourceName, 'facebook') || str_contains($sourceName, 'fb')) {
                    $icon = 'bi-facebook';
                    $color = 'text-primary';
                } elseif (str_contains($sourceName, 'instagram') || str_contains($sourceName, 'ig')) {
                    $icon = 'bi-instagram';
                    $color = 'text-danger';
                } elseif (str_contains($sourceName, 'tiktok')) {
                    $icon = 'bi-tiktok';
                    $color = 'text-dark';
                } elseif (str_contains($sourceName, 'direct')) {
                    $icon = 'bi-link-45deg';
                    $color = 'text-secondary';
                }

                // Deteksi Iklan
                $isAd = in_array(strtolower($medium), ['cpc', 'ppc', 'paid']);

                $data[] = [
                    'name' => ucfirst($sourceName),
                    'medium' => $medium, // organic, cpc, referral
                    'users' => $users,
                    'is_ad' => $isAd,
                    'icon' => $icon,
                    'color' => $color
                ];

                $totalAll += $users;
            }

            // 2. Hitung Persentase & Finalisasi
            $finalResult = array_map(function ($item) use ($totalAll) {
                $item['percent'] = $totalAll > 0 ? round(($item['users'] / $totalAll) * 100) : 0;
                return $item;
            }, $data);

            return response()->json([
                'status' => 'success',
                'data' => $finalResult
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
