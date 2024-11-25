<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Ourprinciples;


use Mediapress\AllBuilder\Foundation\BuilderRenderable;

class Sitemap extends BuilderRenderable
{
    public
    function defaultContents()
    {
        extract($this->params);
        return [
            [
                "type" => "form",
                "options" => [
                    "html" => [
                        "attributes" => [
                            "method" => "post",
                            "action" => route("Content.sitemaps.mainUpdate", ["sitemap" => $sitemap->id]),
                        ]
                    ],
                    "collectable_as"=>["sitemapform", "form"]
                ],
                "contents" =>
                /*EDITOR*/
[
    0 => [
        'type' => 'steptabs',
        'id' => 6390458174807,
        'contents' => [
            0 => [
                'type' => 'tab',
                'id' => '639045817480a',
                'contents' => [
                    0 => [
                        'type' => 'detailtabs',
                        'id' => '639045817480b',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '639045817480c',
                                'contents' => [
                                    0 => [
                                        'type' => 'inputwithlabel',
                                        'id' => '639045817480d',
                                        'options' => [
                                            'html' => [
                                                'tag' => 'input',
                                                'attributes' => [
                                                    'class' => 'detail-name',
                                                    'name' => 'detail->name',
                                                    'type' => 'text',
                                                    'value' => '<print>detail->name</print>',
                                                    'style' => '',
                                                ],
                                            ],
                                            'title' => 'Sayfa Yapısı Başlığı',
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
                                                    'name' => 'detail->extras->catalogue',
                                                    'type' => 'text',
                                                    'value' => '<print>detail->catalogue</print>',
                                                ],
                                            ],
                                            'rules' => '',
                                            'title' => 'Digital Catalogue Url',
                                        ],
                                    ],
                                    2 => [
                                        'type' => 'ckeditor',
                                        'id' => '639045817481b',
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
                                        'id' => '639045817481f',
                                    ],
                                ],
                            ],
                        ],
                        'params' => [
                            'details' => '<var>sitemap->details</var>',
                        ],
                        'options' => [
                            'html' => [
                                'attributes' => [
                                    'class' => 'tab-list',
                                ],
                            ],
                            'capsulate' => 1,
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
                'id' => '639045817483b',
                'contents' => [
                    0 => [
                        'type' => 'detailtabs',
                        'id' => '639045817483c',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '639045817483d',
                                'contents' => [
                                    0 => [
                                        'type' => 'textareawithlabel',
                                        'id' => '639045817483e',
                                        'options' => [
                                            'html' => [
                                                'tag' => 'textarea',
                                                'attributes' => [
                                                    'class' => 'form-control',
                                                    'name' => 'detail->search_text',
                                                ],
                                            ],
                                            'rules' => '',
                                            'title' => 'Aptal Arama <small>Burada yazacağınız metin sayfada gözükmez, sadece site içi aramalarda dikkate alınır.</small>',
                                            'value' => '<print>detail->search_text</print>',
                                        ],
                                    ],
                                    1 => [
                                        'type' => 'detailmetascontrolv2',
                                        'id' => 6390458174842,
                                        'params' => [
                                            'detail' => '<var>detail</var>',
                                        ],
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
                            'capsulate' => '0',
                            'meta_variables' => '1',
                        ],
                        'params' => [
                            'keyname' => 'key',
                            'itemname' => 'detail',
                            'details' => '<var>sitemap->details</var>',
                        ],
                    ],
                ],
                'options' => [
                    'title' => 'SEO',
                ],
            ],
            2 => [
                'type' => 'tab',
                'id' => '639045817484b',
                'contents' => [
                    0 => [
                        'type' => 'contentprotectioncontrol',
                        'id' => '639045817484c',
                        'options' => [
                            'html' => [
                                'tag' => 'div',
                                'attributes' => [
                                    'class' => 'col-6',
                                    'name' => '',
                                ],
                            ],
                        ],
                        'params' => [
                            'object' => '<var>sitemap</var>',
                        ],
                    ],
                    1 => [
                        'type' => 'clearfix',
                        'id' => 6390458174850,
                        'options' => [
                            'html' => [
                                'tag' => 'div',
                                'attributes' => [
                                    'class' => '',
                                    'name' => '',
                                ],
                            ],
                        ],
                    ],
                ],
                'options' => [
                    'html' => [
                        'tag' => 'div',
                        'attributes' => [
                            'class' => 'tab-pane position-relative',
                            'name' => '',
                            'style' => 'min-height:400px;',
                        ],
                    ],
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
