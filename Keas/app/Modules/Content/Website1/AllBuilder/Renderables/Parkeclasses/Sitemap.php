<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Parkeclasses;


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
                        [
                            'type' => 'steptabs',
                            'contents' => [
                                [
                                    'type' => 'tab',
                                    'contents' => [
                                        [
                                            'type' => 'detailtabs',
                                            'contents' => [
                                                [
                                                    'type' => 'tab',
                                                    'contents' => [
                                                        [
                                                            'type' => 'inputwithlabel',
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
                                                        [
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
                                                        [
                                                            'type' => 'clearfix',
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
                                [
                                    'type' => 'tab',
                                    'contents' => [
                                        [
                                            'type' => 'mpfile',
                                            'options' => [
                                                'html' => [
                                                    'tag' => 'input',
                                                    'attributes' => [
                                                        'class' => 'mfile mpimage',
                                                        'name' => 'sitemap-><print>sitemap->id</print>',
                                                        'type' => 'hidden',
                                                    ],
                                                ],
                                                'tags' => [
                                                    'cover' => '{%quot%key%quot%:%quot%cover%quot%,%quot%file_type%quot%:%quot%image%quot%,%quot%required%quot%:%quot%required%quot%,%quot%title%quot%:%quot%Varsayılan Kapak Görseli%quot%,%quot%allow_actions%quot%:[%quot%select%quot%,%quot%upload%quot%],%quot%allow_diskkeys%quot%:[%quot%azure%quot%,%quot%local%quot%],%quot%extensions%quot%:%quot%JPG,JPEG,PNG,GIF,SVG%quot%,%quot%min_width%quot%:%quot%%quot%,%quot%max_width%quot%:%quot%%quot%,%quot%min_height%quot%:%quot%%quot%,%quot%max_height%quot%:%quot%%quot%,%quot%width%quot%:%quot%%quot%,%quot%height%quot%:%quot%%quot%,%quot%min_filesize%quot%:%quot%%quot%,%quot%max_filesize%quot%:%quot%5120%quot%,%quot%max_file_count%quot%:%quot%1%quot%,%quot%additional_rules%quot%:%quot%%quot%}',
                                                ],
                                            ],
                                            'params' => [
                                                'files' => '<var>sitemap->mfiles</var>',
                                            ],
                                        ],
                                        [
                                            'type' => 'detailtabs',
                                            'contents' => [
                                                [
                                                    'type' => 'tab',
                                                    'contents' => [
                                                        [
                                                            'type' => 'mpfile',
                                                            'options' => [
                                                                'html' => [
                                                                    'tag' => 'input',
                                                                    'attributes' => [
                                                                        'class' => 'mfile mpimage',
                                                                        'name' => 'detail',
                                                                        'type' => 'hidden',
                                                                    ],
                                                                ],
                                                                'tags' => [
                                                                    'cover' => '{%quot%key%quot%:%quot%cover%quot%,%quot%file_type%quot%:%quot%image%quot%,%quot%required%quot%:%quot%required%quot%,%quot%title%quot%:%quot%Varsayılan Kapak Görseli%quot%,%quot%allow_actions%quot%:[%quot%select%quot%,%quot%upload%quot%],%quot%allow_diskkeys%quot%:[%quot%azure%quot%,%quot%local%quot%],%quot%extensions%quot%:%quot%JPG,JPEG,PNG,GIF,SVG%quot%,%quot%min_width%quot%:%quot%%quot%,%quot%max_width%quot%:%quot%%quot%,%quot%min_height%quot%:%quot%%quot%,%quot%max_height%quot%:%quot%%quot%,%quot%width%quot%:%quot%%quot%,%quot%height%quot%:%quot%%quot%,%quot%min_filesize%quot%:%quot%%quot%,%quot%max_filesize%quot%:%quot%5120%quot%,%quot%max_file_count%quot%:%quot%1%quot%,%quot%additional_rules%quot%:%quot%%quot%}',
                                                                ],
                                                            ],
                                                            'params' => [
                                                                'files' => '<var>detail->mfiles</var>',
                                                            ],
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
                                                'capsulate' => 0,
                                            ],
                                        ],
                                    ],
                                    'options' => [
                                        'html' => [
                                            'tag' => 'div',
                                            'attributes' => [
                                                'class' => 'tab-pane',
                                                'name' => '',
                                            ],
                                        ],
                                        'title' => 'Görseller',
                                    ],
                                ],
                                [
                                    'type' => 'tab',
                                    'contents' => [
                                        [
                                            'type' => 'detailtabs',
                                            'contents' => [
                                                [
                                                    'type' => 'tab',
                                                    'contents' => [
                                                        0 => [
                                                            'type' => 'textareawithlabel',
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
                                [
                                    'type' => 'tab',
                                    'contents' => [
                                        [
                                            'type' => 'contentprotectioncontrol',
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
                                        [
                                            'type' => 'clearfix',
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
