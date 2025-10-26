<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\NailCatalog;

class CleanWhiteImages extends Command
{
    protected $signature = 'catalogs:clean-white-images';
    protected $description = 'Remove all "white:1" entries from nail_catalogs images field';

    public function handle()
    {
        $count = 0;
        foreach (NailCatalog::all() as $catalog) {
            $images = $catalog->images;
            if (!is_array($images)) {
                $images = is_string($images) ? json_decode($images, true) ?? [] : [];
            }
            $filtered = array_values(array_filter($images, function($img) {
                return $img !== 'white:1';
            }));
            if (count($filtered) !== count($images)) {
                $catalog->images = $filtered;
                $catalog->save();
                $count++;
            }
        }
        $this->info("Cleaned $count catalogs.");
    }
}
