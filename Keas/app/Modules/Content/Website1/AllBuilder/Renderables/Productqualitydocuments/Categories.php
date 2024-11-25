<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Productqualitydocuments;


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
        'id' => '639643b0b0963',
        'contents' => [
            0 => [
                'type' => 'tab',
                'id' => '639643b0b0966',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '639643b0b0967',
                        'contents' => [
                            0 => [
                                'type' => 'contentstatuscontrol',
                                'id' => '639643b0b0969',
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
                                'id' => '639643b0b0970',
                                'contents' => [
                                    0 => [
                                        'type' => 'tab',
                                        'id' => '639643b0b0971',
                                        'contents' => [
                                            0 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '639643b0b0973',
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
                                                'id' => '639643b0b0978',
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
                                    'details_parent' => '<var>category</var>',
                                    'details' => '',
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
