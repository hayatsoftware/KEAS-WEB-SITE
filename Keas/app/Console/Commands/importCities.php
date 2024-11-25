<?php

namespace App\Console\Commands;

use App\City;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class importCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $files = \File::files(public_path('datasets/cities'));
        $file_data = [];
        foreach($files as $file){
            $file_data[] = str_replace('.json', '', $file->getFilename());
        }
        foreach($file_data as $data){
            $city_file = json_decode(file_get_contents(asset('datasets/cities/'.$data.'.json')), TRUE);
            foreach($city_file as $c){
                City::updateOrCreate(
                    [
                        'slug' => $c['slug']
                    ],
                    [
                        'native' => $c[$data],
                        'en' => $c['en'],
                        'country_group' => $data
                    ]
                );
            }
        }
        $this->info('Şehirler başarılı şekilde import edildi.');
    }
}
