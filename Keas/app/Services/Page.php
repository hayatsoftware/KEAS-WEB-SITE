<?php

namespace App\Services;
use Mediapress\Modules\Content\Models\Page as PageImportModel;
use Mediapress\Modules\Content\Models\PageDetail;
use Mediapress\Modules\Content\Models\PageDetailExtra;
use Mediapress\Modules\Content\Models\PageExtra;


class Page {

    private string $name;
    private string $detail = "";
    private ?string $slug = NULL;
    private int $page_id = 0;
    private int $language_id;
    private int $country_id;
    private ?int $cint_1 = NULL;
    private ?string $cint_2 = NULL;
    private ?string $cint_3 = NULL;
    private ?int $cint_4 = NULL;
    private int $sitemap_id;
    private ?int $category_id = NULL;

    public function importPageCheckWithCintOne()
    {
        $page = PageImportModel::updateOrCreate(
            [
                'cint_1' => $this->cint_1,
                'sitemap_id' => $this->sitemap_id
            ],
            [
                'page_id' => $this->page_id,
                'admin_id' => 1,
                'status' => 1,
                'cint_2' => $this->cint_2
            ]
        );
        if( !is_null($this->category_id) ){
            $page->categories()->sync([$this->category_id]);
        }
        return $page;
    }

    public function importPageCheckWithCintTwo()
    {
        $page = PageImportModel::updateOrCreate(
            [
                'cint_2' => $this->cint_2,
                'sitemap_id' => $this->sitemap_id
            ],
            [
                'page_id' => $this->page_id,
                'admin_id' => 1,
                'status' => 1,
                'cint_1' => $this->cint_1,
                'cint_3' => $this->cint_3
            ]
        );
        if( !is_null($this->category_id) ){
            $page->categories()->sync([$this->category_id]);
        }
        return $page;
    }

    public function importPageDetail()
    {
        $pageDetail = PageDetail::updateOrCreate(
            [
                'page_id' => $this->page_id,
                'country_group_id' => $this->country_id,
                'language_id' => $this->language_id
            ],
            [
                'name' => $this->name,
                'detail' => $this->detail,
                'slug' => $this->slug
            ]
        );

        return $pageDetail;
    }

    public function importPageDetailExtras($page_id, $detail_id, $key, $value)
    {

        return PageDetailExtra::create(
            [
                'page_id' => $page_id,
                'page_detail_id' => $detail_id,
                'key' => $key,
                'value' => $value
            ]
        );
    }

    public function importPageExtras($page_id, $key, $value)
    {
        return PageExtra::create(
            [
                'page_id' => $page_id,
                'key' => $key,
                'value' => $value
            ]
        );
    }

    public function setName($name): string
    {
        return $this->name = $name;
    }

    public function setDetail($detail): string
    {
        return $this->detail = $detail;
    }

    public function setSlug($name):? string
    {
        return $this->slug = \Str::slug($name);
    }

    public function setPageId($id): int
    {
        return $this->page_id = $id;
    }

    public function setSitemapId($id): int
    {
        return $this->sitemap_id = $id;
    }

    public function setLanguageId($id): int
    {
        return $this->language_id = $id;
    }

    public function setCountryId($id): int
    {
        return $this->country_id = $id;
    }

    public function setCintOne($cint_1):? int
    {
        return $this->cint_1 = $cint_1;
    }

    public function setCintTwo($cint_2):? string
    {
        return $this->cint_2 = $cint_2;
    }

    public function setCintThree($cint_3):? string
    {
        return $this->cint_3 = $cint_3;
    }

    public function setCintFour($cint_4):? int
    {
        return $this->cint_4 = $cint_4;
    }

    public function setCategory($id):? int
    {
        return $this->category_id = $id;
    }
}
