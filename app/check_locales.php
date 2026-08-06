<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Locales table ===" . PHP_EOL;
$locales = DB::table('locales')->get();
echo "Total: " . $locales->count() . PHP_EOL;
foreach ($locales as $l) {
    echo "ID: " . $l->id . " | section_id: " . $l->section_id . " | var: " . $l->var . " | ar: " . $l->ar . " | en: " . $l->en . PHP_EOL;
}