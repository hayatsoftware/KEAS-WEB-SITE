<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Register;


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
        'id' => '63a0c9fdbb8b6',
        'contents' => [
            0 => [
                'type' => 'tab',
                'id' => '63a0c9fdbb8b9',
                'contents' => [
                    0 => [
                        'type' => 'detailtabs',
                        'id' => '63a0c9fdbb8ba',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '63a0c9fdbb8bb',
                                'contents' => [
                                    0 => [
                                        'type' => 'inputwithlabel',
                                        'id' => '63a0c9fdbb8bc',
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
                                        'id' => '63a0c9fdbb8c5',
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
                                        'type' => 'ckeditor',
                                        'options' => [
                                            'html' => [
                                                'tag' => 'textarea',
                                                'attributes' => [
                                                    'class' => 'form-control ckeditor',
                                                    'name' => 'detail->extras->contact_text',
                                                ],
                                            ],
                                            'rules' => '',
                                            'title' => 'Contact Permission Text',
                                            'value' => '<print>detail->contact_text</print>',
                                        ],
                                    ],
                                    3 => [
                                        'type' => 'ckeditor',
                                        'options' => [
                                            'html' => [
                                                'tag' => 'textarea',
                                                'attributes' => [
                                                    'class' => 'form-control ckeditor',
                                                    'name' => 'detail->extras->kvkk',
                                                ],
                                            ],
                                            'rules' => '',
                                            'title' => 'Kvkk Text',
                                            'value' => '<print>detail->kvkk</print>',
                                        ],
                                    ],
                                    4 => [
                                        'type' => 'clearfix',
                                        'id' => '63a0c9fdbb8c9',
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
                'id' => '63a0c9fdbb8e5',
                'contents' => [
                    0 => [
                        'type' => 'detailtabs',
                        'id' => '63a0c9fdbb8e6',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '63a0c9fdbb8e7',
                                'contents' => [
                                    0 => [
                                        'type' => 'textareawithlabel',
                                        'id' => '63a0c9fdbb8e8',
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
                                        'id' => '63a0c9fdbb8ed',
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
                'id' => '63a0c9fdbb8f5',
                'contents' => [
                    0 => [
                        'type' => 'contentprotectioncontrol',
                        'id' => '63a0c9fdbb8f6',
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
                        'id' => '63a0c9fdbb8fa',
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
