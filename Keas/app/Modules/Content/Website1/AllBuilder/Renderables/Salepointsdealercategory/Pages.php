<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Salepointsdealercategory;


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
        'id' => '638cbdd17ac54',
        'contents' => [
            0 => [
                'type' => 'tab',
                'id' => '638cbdd17ac57',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '638cbdd17ac59',
                        'contents' => [
                            0 => [
                                'type' => 'inputwithlabel',
                                'id' => '638cbdd17ac5a',
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
                                'type' => 'inputwithlabel',
                                'options' => [
                                    'html' => [
                                        'tag' => 'input',
                                        'attributes' => [
                                            'class' => '',
                                            'name' => 'page-><print>page->id</print>->cint_1',
                                            'type' => 'text',
                                            'value' => '<print>page->cint_1</print>',
                                        ],
                                    ],
                                    'rules' => '',
                                    'title' => 'Import ID',
                                ],
                            ],
                            2 => [
                                'type' => 'detailtabs',
                                'id' => '638cbdd17ac63',
                                'contents' => [
                                    0 => [
                                        'type' => 'tab',
                                        'id' => '638cbdd17ac65',
                                        'contents' => [
                                            0 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '638cbdd17ac66',
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
                                                'type' => 'clearfix',
                                                'id' => '638cbdd17ac6a',
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
                'id' => '638cbdd17ac76',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '638cbdd17ac77',
                        'contents' => [
                            0 => [
                                'type' => 'contentprotectioncontrol',
                                'id' => '638cbdd17ac79',
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
                                'id' => '638cbdd17ac7c',
                                'contents' => [
                                    0 => [
                                        'type' => 'pagestatuscontrol',
                                        'id' => '638cbdd17ac7e',
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
