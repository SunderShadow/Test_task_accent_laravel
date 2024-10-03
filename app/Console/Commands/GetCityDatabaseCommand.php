<?php

namespace App\Console\Commands;

use App\Models\City;
use Illuminate\Console\Command;

class GetCityDatabaseCommand extends Command
{
    const ADDRESS = "https://api.hh.ru/areas";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:fill:city';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fills database by data from https://api.hh.ru/areas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $countries = file_get_contents(self::ADDRESS, true);

        if (!$countries) {
            $this->error('Check address validity ' . self::ADDRESS);
            return;
        }

        $countries = json_decode($countries, true);

        if (!$countries) {
            $this->error('Not valid JSON from ' . self::ADDRESS);
            return;
        }

        foreach ($countries as $country) {
            if ($country['name'] === 'Россия') {
                break;
            }
        }

        if ($country['name'] !== 'Россия') {
            $this->error('Russia city does not exists');
        }

        $cities = array_map(
            fn ($v) => [
                'name' => $v['name'],
                'slug' => ciryllicSlug($v['name'])
            ],
            $this->parseCities($country['areas'])
        );

        // Alphabet sort
        usort($cities, function ($a, $b) {
            $a = ucfirst($a['name']);
            $b = $b['name'];

            for ($i = 0; $i < strlen($a) && $i < strlen($b); $i++)
            {
                $res = ord($a[$i]) <=> ord($b[$i]);

                if ($res !== 0) {
                    return $res;
                }
            }
        });

        City::insert($cities);

        $this->info('Cities successfully loaded from ' . self::ADDRESS);
    }

    private function parseCities($areas): array
    {
        $countries = [];
        foreach ($areas as $area) {
            if (!empty($area['areas'])) {
                $countries = array_merge($countries, $this->parseCities($area['areas']));
            } else {
                $countries[] = $area;
            }
        }

        return $countries;
    }
}
