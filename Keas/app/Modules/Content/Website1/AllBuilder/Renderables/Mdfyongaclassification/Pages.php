<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Mdfyongaclassification;


use Mediapress\AllBuilder\Foundation\BuilderRenderable;

class Pages extends BuilderRenderable
{
    public function defaultContents()
    {
        extract($this->params);
        return [
            [
                "type" => "form",
                "options" => [
                    "html" => [
                        "attributes" => [
                            "method" => "post",
                            "action" => route("Content.pages.update", ["sitemap_id" => $page->sitemap_id, "id" => $page->id]),
                        ]
                    ],
                    "collectable_as"=>["pagesform", "form"]
                ],
                "contents" =>

                /*EDITOR*/
[
    0 => [
        'type' => 'steptabs',
        'id' => '63871d1bf1c4d',
        'contents' => [
            0 => [
                'type' => 'tab',
                'id' => '63871d1bf1c50',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '63871d1bf1c51',
                        'contents' => [
                            0 => [
                                'type' => 'inputwithlabel',
                                'id' => '63871d1bf1c52',
                                'options' => [
                                    'html' => [
                                        'tag' => 'input',
                                        'attributes' => [
                                            'class' => '',
                                            'name' => 'page-><print>page->id</print>->order',
                                            'type' => 'number',
                                            'value' => '<print>page->order</print>',
                                        ],
                                    ],
                                    'title' => 'Sıralama',
                                    'rules' => '',
                                ],
                            ],
                            1 => [
                                'type' => 'selectwithlabel',
                                'options' => [
                                    'html' => [
                                        'tag' => 'select',
                                        'attributes' => [
                                            'class' => 'nice selectpicker',
                                            'name' => 'page-><print>page->id</print>->cint_1',
                                        ],
                                    ],
                                    'rules' => '',
                                    'title' => 'Choose Category',
                                    'multiple' => '0',
                                    'value' => '<print>page->cint_1</print>',
                                    'show_default_option' => '0',
                                    'additional_content' => 'merge',
                                    'default_value' => '',
                                    'default_text' => '---Choose---',
                                ],
                                'data' => [
                                    'values' => [
                                        'type' => 'ds:Content->MdfYongaClassificationCategories',
                                    ],
                                ],
                            ],
                            2 => [
                                'type' => 'selectwithlabel',
                                'options' => [
                                    'html' => [
                                        'tag' => 'select',
                                        'attributes' => [
                                            'class' => 'nice selectpicker',
                                            'name' => 'page-><print>page->id</print>->cint_2',
                                        ],
                                    ],
                                    'rules' => '',
                                    'title' => 'Choose List Option',
                                    'multiple' => '0',
                                    'value' => '<print>page->cint_2</print>',
                                    'show_default_option' => '0',
                                    'additional_content' => 'merge',
                                    'default_value' => '',
                                    'default_text' => '---Choose---',
                                ],
                                'data' => [
                                    'values' => [
                                        'type' => 'ds:Content->ClassificationList',
                                    ],
                                ],
                            ],
                            3 => [
                                'type' => 'detailtabs',
                                'id' => '63871d1bf1c5f',
                                'contents' => [
                                    0 => [
                                        'type' => 'tab',
                                        'id' => '63871d1bf1c60',
                                        'contents' => [
                                            0 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '63871d1bf1c62',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'input',
                                                        'attributes' => [
                                                            'class' => 'detail-name',
                                                            'name' => 'detail->name',
                                                            'type' => 'text',
                                                            'value' => '<print>detail->name</print>',
                                                        ],
                                                    ],
                                                    'title' => 'Başlık',
                                                    'rules' => '',
                                                ],
                                            ],
                                            1 => [
                                                'type' => 'ckeditor',
                                                'id' => '63871d1bf1c66',
                                                'params' => [
                                                ],
                                                'options' => [
                                                    'rules' => '',
                                                    'title' => 'Detay Yazısı',
                                                    'value' => '<print>detail->detail</print>',
                                                    'html' => [
                                                        'attributes' => [
                                                            'name' => 'detail->detail',
                                                        ],
                                                    ],
                                                    'tags' => [
                                                    ],
                                                ],
                                            ],
                                            2 => [
                                                'type' => 'clearfix',
                                                'id' => '63871d1bf1c6b',
                                            ],
                                        ],
                                    ],
                                ],
                                'options' => [
                                    'html' => [
                                        'tag' => 'div',
                                        'attributes' => [
                                            'class' => 'tab-list',
                                            'name' => '',
                                        ],
                                    ],
                                    'capsulate' => '1',
                                    'meta_variables' => '1',
                                ],
                                'params' => [
                                    'keyname' => 'key',
                                    'itemname' => 'detail',
                                    'details' => '<var>page->details</var>',
                                ],
                            ],
                        ],
                        'options' => [
                            'html' => [
                                'attributes' => [
                                    'class' => 'contents',
                                ],
                            ],
                        ],
                    ],
                ],
                'options' => [
                    'title' => 'Genel',
                    'navigation' => true,
                ],
            ],
            1 => [
                'type' => 'tab',
                'id' => '63871d1bf1c76',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '63871d1bf1c77',
                        'contents' => [
                            0 => [
                                'type' => 'contentprotectioncontrol',
                                'id' => '63871d1bf1c78',
                                'options' => [
                                    'html' => [
                                        'tag' => 'div',
                                        'attributes' => [
                                            'class' => 'col-sm-12 col-md-6',
                                            'name' => '',
                                        ],
                                    ],
                                ],
                                'params' => [
                                    'object' => '<var>page</var>',
                                ],
                            ],
                            1 => [
                                'type' => 'div',
                                'id' => '63871d1bf1c7c',
                                'contents' => [
                                    0 => [
                                        'type' => 'pagestatuscontrol',
                                        'id' => '63871d1bf1c7d',
                                        'params' => [
                                            'page_model' => '<var>page</var>',
                                        ],
                                    ],
                                ],
                                'options' => [
                                    'html' => [
                                        'tag' => 'div',
                                        'attributes' => [
                                            'class' => 'col-sm-12 col-md-6',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'options' => [
                            'html' => [
                                'tag' => 'div',
                                'attributes' => [
                                    'class' => 'row position-relative',
                                    'name' => '',
                                    'style' => 'overflow:hidden;',
                                ],
                            ],
                        ],
                    ],
                ],
                'options' => [
                    'title' => 'Yayınla',
                ],
            ],
        ],
    ],
]

/*EDITOR*/


            ]
        ];

    }
}
