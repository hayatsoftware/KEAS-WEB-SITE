<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Product;


use Mediapress\AllBuilder\Foundation\BuilderRenderable;

class Criterias extends BuilderRenderable
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
                        "action" => route("Content.categories.criteria.store", ["criteria" => $criteria->id]),
                    ]
                ],
                "collectable_as"=>["criteriasform", "form"]
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
                                                    'multiline' => '0',
                                                ],
                                                'params' => [
                                                    'values' => '[]',
                                                    'content_model' => '<var>criteria</var>',
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
                                                                    'title' => 'Kriter Adı',
                                                                    'rules' => 'required',
                                                                ],
                                                            ],
                                                            1 => [
                                                                'type' => 'inputwithlabel',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'input',
                                                                        'attributes' => [
                                                                            'class' => 'detail->slug',
                                                                            'name' => 'detail->slug',
                                                                            'type' => 'text',
                                                                            'value' => '<print>detail->slug</print>',
                                                                        ],
                                                                    ],
                                                                    'title' => 'Slug',
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
                                                    'details' => '<var>criteria->details</var>',
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
