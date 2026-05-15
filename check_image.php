<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$item = \Illuminate\Support\Facades\DB::table('items')->whereNotNull('image1')->first();
if($item) {
    echo "ID: " . $item->id . "\n";
    echo "Image1 Length: " . strlen($item->image1) . "\n";
    echo "Image1 Prefix: " . substr($item->image1, 0, 100) . "\n";
} else {
    echo "No item with image1 found\n";
}
