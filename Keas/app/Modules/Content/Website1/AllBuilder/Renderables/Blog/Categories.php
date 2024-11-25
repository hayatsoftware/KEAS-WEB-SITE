<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Blog;


use Mediapress\AllBuilder\Foundation\BuilderRenderable;

class Categories extends BuilderRenderable
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
                        "action" => route("Content.categories.category.store", ["category" => $category->id]),
                    ]
                ],
                "collectable_as"=>["categoriesform", "form"]
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
                                                'type' => 'contentstatuscontrol',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'div',
                                                        'attributes' => [
                                                            'class' => 'checkbox',
                                                            'name' => '',
                                                        ],
                                                    ],
                                                    'title' => '',
                                                    'value' => '',
                                                    'default' => '2',
                                                    'multiline' => '1',
                                                ],
                                                'params' => [
                                                    'values' => '[]',
                                                    'content_model' => '<var>category</var>',
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
                                                            1 => [
                                                                'type' => 'detailslugcontrolv2',
                                                                'options' => [
                                                                    'initial_mode' => 'waiting',
                                                                ],
                                                                'params' => [
                                                                    'detail' => '<var>detail</var>',
                                                                ],
                                                            ],
                                                            2 => [
                                                                'type' => 'ckeditor',
                                                                'options' => [
                                                                    'rules' => '',
                                                                    'title' => 'Detay Metni',
                                                                    'value' => '<print>detail->detail</print>',
                                                                    'html' => [
                                                                        'attributes' => [
                                                                            'name' => 'detail->detail',
                                                                        ],
                                                                    ],
                                                                ],
                                                            ],
                                                            3 => [
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
                                                    'details' => '<var>category->details</var>',
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
                        ],
                    ],
                ]

            /*EDITOR*/



        ]
    ];

}
}
