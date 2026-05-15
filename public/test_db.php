<?php
$data = \Illuminate\Support\Facades\DB::table('items')->limit(1)->first();
echo strlen($data->image1 ?? '') . ' ' . strlen($data->image2 ?? '') . ' ' . strlen($data->image3 ?? '') . PHP_EOL;
