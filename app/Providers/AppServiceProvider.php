<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\RunReportRequest;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Metric;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public', function () {
            return base_path('public_html');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrap();
        app()->useLangPath(base_path('lang'));


        View::composer('*', function ($view) {

            // Cache 30 menit
            $stats = Cache::remember('public_visitor_stats', 1800, function () {

                // Pastikan file credentials ada
                $credPath = storage_path('app/analytics/service-account-credentials.json');
                if (!file_exists($credPath)) {
                    return ['today' => 0, 'month' => 0, 'total' => 0];
                }

                $client = new BetaAnalyticsDataClient(['credentials' => $credPath]);
                $propertyId = '465288730'; // GANTI INI

                // Helper function kecil biar kodingan rapi
                $fetchMetric = function ($startDate, $endDate, $metricName) use ($client, $propertyId) {
                    try {
                        $response = $client->runReport(new RunReportRequest([
                            'property' => 'properties/' . $propertyId,
                            'date_ranges' => [new DateRange(['start_date' => $startDate, 'end_date' => $endDate])],
                            'metrics' => [new Metric(['name' => $metricName])],
                        ]));
                        return $response->getRows()->count() > 0
                            ? (int) $response->getRows()[0]->getMetricValues()[0]->getValue()
                            : 0;
                    } catch (\Throwable $e) {
                        return 0;
                    }
                };

                return [
                    'today' => $fetchMetric('today', 'today', 'activeUsers'),
                    'month' => $fetchMetric('30daysAgo', 'today', 'activeUsers'),
                    'total' => $fetchMetric('2024-01-01', 'today', 'totalUsers'),
                ];
            });

            $view->with('visitorStats', $stats);
        });
    }
}
