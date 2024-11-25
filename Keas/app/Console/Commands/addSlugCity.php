<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class addSlugCity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:slug-city';

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
        foreach( $files as $file ){
            $file_data[] = $file->getFilename();
        }

        $cityFile = $this->choice('Please select file',$file_data, 0);
        $cities = collect(json_decode(file_get_contents(public_path('datasets/cities/'.$cityFile)), TRUE));

        $city_data = [];
        foreach( $cities as $key => $city ){
            $city_data[$key]['slug'] = \Str::slug($city['en'], '-');
            foreach( $city as $k => $c ){
                $city_data[$key][$k] = $c;
            }
        }
        Storage::disk('dataset')->put('/cities/'.$cityFile, json_encode($city_data, JSON_UNESCAPED_UNICODE));

    }
}
