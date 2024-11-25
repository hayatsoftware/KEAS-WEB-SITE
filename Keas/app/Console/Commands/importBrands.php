<?php

namespace App\Console\Commands;

use App\Services\Page;
use Illuminate\Console\Command;
use Mediapress\Modules\MPCore\Models\CountryGroupLanguage;
use Mediapress\Modules\MPCore\Models\Language;

class importBrands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:brands';

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
        $brands = collect(json_decode(file_get_contents(public_path('import/brands.json')), TRUE));
        foreach( $brands as $brand ){
            $pageImport = new Page();
            $pageImport->setCintOne($brand['ID']);
            $pageImport->setSitemapId(BRANDS_ST_ID);
            $brandPage = $pageImport->importPageCheckWithCintOne();
            if( $brandPage ){
                $countryGroupsLanguage = CountryGroupLanguage::all();
                $pageImport->setPageId($brandPage->id);
                foreach( $countryGroupsLanguage as $groupLanguage ){
                    $language = Language::where('id', $groupLanguage->language_id)->first();
                    $pageImport->setLanguageId($groupLanguage->language_id);
                    $pageImport->setCountryId($groupLanguage->country_group_id);
                    $pageImport->setName($brand[$language->code]);
                    $pageImport->setDetail("");
                    $pageImport->setSlug($brand[$language->code]);
                    $pageImport->importPageDetail();
                }
            }
        }

        $this->info(PHP_EOL . 'Markalar başarılı şekilde import edildi.' . PHP_EOL);
    }
}
