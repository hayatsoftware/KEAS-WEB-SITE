<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index(): \Illuminate\Http\Response
    {
        $country_groups = \DB::table('country_groups')->get();
        $data = [];
        foreach ($country_groups as $country_group) {
            $country_group_languages = \DB::table('country_group_language')->where('country_group_id', $country_group->id)->get();
            foreach($country_group_languages as $country_group_language){
                $language = \DB::table('languages')->where('id', $country_group_language->language_id)->first();
                $data[] = route('sitemap.sitemaps', ['country_group' => $country_group->code, 'language' => $language->code]);
            }
        }
        return response()->view('sitemap.index', ['data' => $data])->header('Content-Type', 'text/xml');
    }

    public function sitemaps($country_group, $language): \Illuminate\Http\Response
    {
        $sitemaps = collect([]);
        $sitemaps = $sitemaps->merge($this->getSitemapUrls($country_group, $language));
        $sitemaps = $sitemaps->merge($this->getPagesSitemaps($country_group, $language));
        $sitemaps = $sitemaps->merge($this->getCategoryUrls($country_group, $language));

        return response()->view('sitemap.sitemap', ['sitemaps' => $sitemaps])->header('Content-Type', 'application/xml');
    }

    private function getCategoryUrls($country_group, $language): array
    {
        $country_group = \DB::table('country_groups')->where('code', $country_group)->first();
        $language = \DB::table('languages')->where('code', $language)->first();
        $urls = \DB::table('urls')
            ->select(
                'urls.url',
                'categories.updated_at as last_updated'
            )
            ->where('urls.model_type', 'Mediapress\Modules\Content\Models\CategoryDetail')
            ->where('urls.type', 'original')
            ->join('category_details', function($join) use ($country_group, $language) {
                $join->on('category_details.id', '=', 'urls.model_id')
                    ->where('category_details.country_group_id', $country_group->id)
                    ->where('category_details.language_id', $language->id)
                    ->where('category_details.name', '<>', '')
                    ->where('category_details.name', '!=', '-');
            })
            ->join('categories', function($join) {
                $join->on('categories.id', '=', 'category_details.category_id')->where('categories.status', 1);
            })
            ->whereIn('categories.sitemap_id', [PRODUCT_ST_ID, BLOG_ST_ID])
            ->orderBy('categories.created_at', 'desc')
            ->get();
        $sitemaps = [];
        foreach($urls as $url){
            $sitemaps[] = [
                'url' => url($url->url),
                'last_updated' => \Carbon\Carbon::parse($url->last_updated)->format('Y-m-d\TH:i:sP')
            ];
        }

        return $sitemaps;
    }
    private function getSitemapUrls($country_group, $language): array
    {
        $country_group = \DB::table('country_groups')->where('code', $country_group)->first();
        $language = \DB::table('languages')->where('code', $language)->first();
        $urls = \DB::table('urls')
            ->select(
                'urls.url',
                'sitemaps.id',
                'sitemaps.updated_at as last_updated'
            )
            ->where('urls.model_type', 'Mediapress\Modules\Content\Models\SitemapDetail')
            ->where('urls.type', 'original')
            ->join('sitemap_details', function($join) use ($country_group, $language) {
                $join->on('sitemap_details.id', '=', 'urls.model_id')
                    ->where('sitemap_details.country_group_id', $country_group->id)
                    ->where('sitemap_details.language_id', $language->id)
                    ->where('sitemap_details.name', '<>', '')
                    ->where('sitemap_details.name', '!=', '-');
            })
            ->join('sitemaps', function($join) {
                $join->on('sitemaps.id', '=', 'sitemap_details.sitemap_id')->where('sitemaps.status', 1);
            })
            ->join('sitemap_types', function($join) {
                $join->on('sitemap_types.id', '=', 'sitemaps.sitemap_type_id');
            })
            ->where('sitemaps.detailPage', 1)
            ->where('sitemap_types.sitemap_type_type', 'static')
            ->get();

        $sitemaps = [];
        foreach($urls as $url){
            $sitemaps[] = [
                'url' => url($url->url),
                'last_updated' => \Carbon\Carbon::parse($url->last_updated)->format('Y-m-d\TH:i:sP')
            ];
        }

        return $sitemaps;
    }
    private function getPagesSitemaps($country_group, $language): array
    {
        $country_group = \DB::table('country_groups')->where('code', $country_group)->first();
        $language = \DB::table('languages')->where('code', $language)->first();
        $sitemaps = \DB::table('sitemaps')
            ->select(
                'sitemaps.id',
                'sitemaps.urlStatus',
                'sitemaps.updated_at as last_updated',
                'sitemap_details.slug as slug',
                'sitemap_details.name as name'
            )
            ->join('sitemap_details', function($join) use ($country_group, $language) {
                $join->on('sitemap_details.sitemap_id', '=', 'sitemaps.id')
                    ->where('sitemap_details.country_group_id', $country_group->id)
                    ->where('sitemap_details.language_id', $language->id)
                    ->where('sitemap_details.name', '<>', '')
                    ->whereNotNull('sitemap_details.name')
                    ->where('sitemap_details.name', '!=', '-');
            })
            ->join('sitemap_types', function($join) {
                $join->on('sitemap_types.id', '=', 'sitemaps.sitemap_type_id')->where('sitemap_types.sitemap_type_type', 'dynamic');
            })
            ->where('sitemaps.urlStatus', 1)
            ->whereNotIn('sitemaps.id', [44,47, 72])
            ->get();

        $data = [];
        foreach($sitemaps as $sitemap){
            $urls = \DB::table('urls')
                ->select(
                    'urls.url',
                    'pages.updated_at as last_updated'
                )
                ->where('urls.model_type', 'Mediapress\Modules\Content\Models\PageDetail')
                ->where('urls.type', 'original')
                ->join('page_details', function($join) use ($country_group, $language) {
                    $join->on('page_details.id', '=', 'urls.model_id')
                        ->where('page_details.country_group_id', $country_group->id)
                        ->where('page_details.language_id', $language->id)
                        ->where('page_details.name', '<>', '')
                        ->where('page_details.name', '!=', '-');
                })
                ->join('pages', function($join)use($sitemap) {
                    $join->on('pages.id', '=', 'page_details.page_id')->where('pages.status', 1)->where('pages.sitemap_id', $sitemap->id);
                })
                ->get();
            foreach($urls as $url){
                $data[] = [
                    'url' => url($url->url),
                    'last_updated' => \Carbon\Carbon::parse($url->last_updated)->format('Y-m-d\TH:i:sP')
                ];
            }

        }

        return $data;
    }
}
