<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateTrafficScore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'traffic:update-top-items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates traffic score for Top 5 items per province via Google Routes API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Traffic Update for Top 5 Items/Province...');
        
        $provinces = \App\Models\Province::pluck('id');
        $totalUpdated = 0;

        foreach ($provinces as $provId) {
            // Get Top 5 Items by Size (Width*Height)
            $items = \App\Models\Item::whereHas('city', function ($q) use ($provId) {
                    $q->where('province_id', $provId);
                })
                ->whereNull('deleted_at')
                ->where('isShow', true)
                ->orderByRaw('(width * height) DESC')
                ->limit(5)
                ->get();

            $this->info("Processing Province ID {$provId} - Found " . $items->count() . " items.");

            foreach ($items as $item) {
                // Use the centralized method in Item model
                $score = $item->fetchAndUpdateGoogleTraffic();
                
                if ($score !== null) {
                    $totalUpdated++;
                    $this->info("Item {$item->id} updated. Score: {$score}");
                } else {
                    //$this->warn("Item {$item->id} update skipped/failed.");
                }
            }
        }

        $this->info("Traffic Update Completed! Total updated: {$totalUpdated}");
    }
}
