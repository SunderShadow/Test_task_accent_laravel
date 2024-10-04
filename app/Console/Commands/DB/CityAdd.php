<?php

namespace App\Console\Commands\DB;

use App\Models\City;
use Illuminate\Console\Command;

class CityAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:add:city {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add city to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $city = $this->argument('city');
        $slug = ciryllicSlug($city);

        City::insert([
            'name' => $city,
            'slug' => $slug
        ]);

        $this->info("Successfully created \"$city\" with slug \"$slug\"");
    }
}
