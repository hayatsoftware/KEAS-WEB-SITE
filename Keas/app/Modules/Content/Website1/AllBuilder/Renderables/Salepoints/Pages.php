<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Salepoints;


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
        'id' => '638e59e4b0785',
        'contents' => [
            0 => [
                'type' => 'tab',
                'id' => '638e59e4b0788',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '638e59e4b078a',
                        'contents' => [
                            0 => [
                                'type' => 'inputwithlabel',
                                'id' => '638e59e4b078c',
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
                                            'name' => 'page-><print>page->id</print>->cvar_1',
                                            'type' => 'text',
                                            'value' => '<print>page->cvar_1</print>',
                                        ],
                                    ],
                                    'rules' => '',
                                    'title' => 'Phone',
                                ],
                            ],
                            2 => [
                                'type' => 'inputwithlabel',
                                'options' => [
                                    'html' => [
                                        'tag' => 'input',
                                        'attributes' => [
                                            'class' => '',
                                            'name' => 'page-><print>page->id</print>->cvar_2',
                                            'type' => 'text',
                                            'value' => '<print>page->cvar_2</print>',
                                        ],
                                    ],
                                    'rules' => '',
                                    'title' => 'Email',
                                ],
                            ],
                            3 => [
                                'type' => 'detailtabs',
                                'id' => '638e59e4b0795',
                                'contents' => [
                                    0 => [
                                        'type' => 'tab',
                                        'id' => '638e59e4b0796',
                                        'contents' => [
                                            0 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '638e59e4b0797',
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
                                                'type' => 'inputwithlabel',
                                                'id' => '638e59e4b07a0',
                                                'params' => [
                                                ],
                                                'options' => [
                                                    'rules' => '',
                                                    'title' => 'Detay Slogan',
                                                    'html' => [
                                                        'attributes' => [
                                                            'name' => 'detail->extras->summary',
                                                            'value' => '<print>detail->summary</print>',
                                                        ],
                                                    ],
                                                    'tags' => [
                                                    ],
                                                ],
                                            ],
                                            2 => [
                                                'type' => 'ckeditor',
                                                'id' => '638e59e4b07a4',
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
                                            3 => [
                                                'type' => 'clearfix',
                                                'id' => '638e59e4b07a8',
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
                                    'rules' => '',
                                    'capsulate' => '1',
                                    'delete_restore_details' => '1',
                                    'meta_variables' => '1',
                                ],
                                'params' => [
                                    'keyname' => 'key',
                                    'itemname' => 'detail',
                                    'array' => '[]',
                                    'details_parent' => '<var>page|sitemap|category|criteria|property</var>',
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
                'id' => '638e59e4b07b4',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '638e59e4b07b6',
                        'contents' => [
                            0 => [
                                'type' => 'contentprotectioncontrol',
                                'id' => '638e59e4b07b7',
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
                                'id' => '638e59e4b07bb',
                                'contents' => [
                                    0 => [
                                        'type' => 'pagestatuscontrol',
                                        'id' => '638e59e4b07bc',
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
