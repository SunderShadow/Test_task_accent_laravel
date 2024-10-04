<?php

namespace App\Console\Commands\DB;

use App\Models\City;
use Illuminate\Console\Command;

class CityRemove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:remove:city {cityName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove city from database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cityName = $this->argument('cityName');
        $query = City::query()->where('name', $cityName);

        if (!$query->exists()) {
            $this->error("City \"$cityName\" does not exists");
        } else {
            $query->delete();
            $this->info("Successfully removed \"$cityName\"");
        }
    }
}
