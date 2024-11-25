<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Managements;


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
        'id' => '63904ec2ba893',
        'contents' => [
            0 => [
                'type' => 'tab',
                'id' => '63904ec2ba896',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '63904ec2ba898',
                        'contents' => [
                            0 => [
                                'type' => 'contentstatuscontrol',
                                'id' => '63904ec2ba899',
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
                                'id' => '63904ec2ba8a1',
                                'contents' => [
                                    0 => [
                                        'type' => 'tab',
                                        'id' => '63904ec2ba8a2',
                                        'contents' => [
                                            0 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '63904ec2ba8a4',
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
                                                'id' => '63904ec2ba8ad',
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
