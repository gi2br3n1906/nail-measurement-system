<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\NailCatalog;

function sanitize($img) {
    if (!is_string($img)) return $img;
    $img = trim($img);
    $img = trim($img, "\"'[] ");
    $img = str_replace('\\', '', $img);
    // normalize scheme slashes
    if (preg_match('#^https?:#i', $img)) {
        $img = preg_replace('#^(https?:)/*#i', '\\1//', $img);
        $parts = parse_url($img);
        if ($parts !== false && isset($parts['path'])) {
            $path = preg_replace('#/{2,}#', '/', $parts['path']);
            $host = $parts['host'] ?? '';
            $port = isset($parts['port']) && $parts['port'] !== '' ? ':' . $parts['port'] : '';
            $img = $parts['scheme'] . '://' . $host . $port . $path;
            if (isset($parts['query'])) $img .= '?' . $parts['query'];
        }
    }
    return $img;
}

$updated = 0;
foreach (NailCatalog::all() as $cat) {
    $images = $cat->getAttributes()['images'] ?? null; // raw stored value
    // ensure we get array
    $arr = $cat->images; // uses accessor
    $new = array_map('sanitize', $arr);
    if ($new !== $arr) {
        $cat->images = $new;
        $cat->save();
        $updated++;
        echo "Updated catalog {$cat->id}\n";
    }
}

echo "Done. Updated: $updated\n";
