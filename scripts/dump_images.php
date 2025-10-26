<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\NailCatalog;

$cols = NailCatalog::where('nailist_id', 5)->get()->map(function($c){
    return [
        'id' => $c->id,
        'images' => $c->images,
    ];
});

echo json_encode($cols, JSON_PRETTY_PRINT);
