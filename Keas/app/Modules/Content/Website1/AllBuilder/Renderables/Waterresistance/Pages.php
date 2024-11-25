<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Waterresistance;


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
                            'contents' => [
                                0 => [
                                    'type' => 'tab',
                                    'contents' => [
                                        0 => [
                                            'type' => 'div',
                                            'contents' => [
                                                0 => [
                                                    'type' => 'inputwithlabel',
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
                                                    'type' => 'detailtabs',
                                                    'contents' => [
                                                        0 => [
                                                            'type' => 'tab',
                                                            'contents' => [
                                                                0 => [
                                                                    'type' => 'inputwithlabel',
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
                                                                2 => [
                                                                    'type' => 'clearfix',
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
                                    'contents' => [
                                        0 => [
                                            'type' => 'div',
                                            'contents' => [
                                                0 => [
                                                    'type' => 'contentprotectioncontrol',
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
                                                    'contents' => [
                                                        0 => [
                                                            'type' => 'pagestatuscontrol',
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
