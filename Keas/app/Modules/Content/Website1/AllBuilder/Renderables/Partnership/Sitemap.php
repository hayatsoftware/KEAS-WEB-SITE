<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Partnership;


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
        'id' => '63a0bf813471d',
        'contents' => [
            0 => [
                'type' => 'tab',
                'id' => '63a0bf8134720',
                'contents' => [
                    0 => [
                        'type' => 'detailtabs',
                        'id' => '63a0bf8134722',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '63a0bf8134723',
                                'contents' => [
                                    0 => [
                                        'type' => 'inputwithlabel',
                                        'id' => '63a0bf8134724',
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
                                        'type' => 'ckeditor',
                                        'id' => '63a0bf813472d',
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
                                    2 => [
                                        'type' => 'clearfix',
                                        'id' => '63a0bf8134731',
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
                            'details_parent' => '<var>sitemap</var>',
                            'details' => '',
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
                'id' => '63a0bf8134752',
                'contents' => [
                    0 => [
                        'type' => 'detailtabs',
                        'id' => '63a0bf8134753',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '63a0bf8134754',
                                'contents' => [
                                    0 => [
                                        'type' => 'textareawithlabel',
                                        'id' => '63a0bf8134755',
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
                                        'id' => '63a0bf813475a',
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
                'id' => '63a0bf8134764',
                'contents' => [
                    0 => [
                        'type' => 'contentprotectioncontrol',
                        'id' => '63a0bf8134765',
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
                        'id' => '63a0bf813476a',
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
