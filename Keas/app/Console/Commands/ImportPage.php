<?php

namespace App\Console\Commands;

use App\Services\Page;
use Illuminate\Console\Command;
use Mediapress\Modules\MPCore\Models\CountryGroupLanguage;
use Mediapress\Modules\MPCore\Models\Language;

class ImportPage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:page';

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
        $files = \File::files(public_path('import/parke'));

        $file_data = [];
        foreach( $files as $file ){
            $file_data[] = $file->getFilename();
        }
        $sitemap_id = $this->ask('Please type sitemap id');
        $pageFile = $this->choice('Please select file',$file_data, 0);
        $pages = collect(json_decode(file_get_contents(public_path('import/parke/'.$pageFile)), TRUE));
        foreach($pages as $page){
            $pageImport = new Page();
            $pageImport->setSitemapId($sitemap_id);
            $pageImport->setCintOne($page['ID']);
            if( $pageFile == 'decorative-panel-surfaces.json' ){
                $pageImport->setCintTwo($page['code']);
            }
            $importedPage = $pageImport->importPageCheckWithCintOne();
            $countryGroupsLanguage = CountryGroupLanguage::all();
            foreach( $countryGroupsLanguage as $groupLanguage ){
                $language = Language::where('id', $groupLanguage->language_id)->first();
                $pageImport->setName($page[$language->code]);
                $pageImport->setLanguageId($groupLanguage->language_id);
                $pageImport->setCountryId($groupLanguage->country_group_id);
                $pageImport->setPageId($importedPage->id);
                $pageImport->importPageDetail();
            }
        }
        $this->info(PHP_EOL . 'Sayfalar başarılı şekilde import edildi.' . PHP_EOL);
    }
}
