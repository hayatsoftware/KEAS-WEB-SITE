<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Youdesign;


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
        'id' => '6398f80e81b97',
        'contents' => [
            0 => [
                'type' => 'tab',
                'id' => '6398f80e81b9a',
                'contents' => [
                    0 => [
                        'type' => 'detailtabs',
                        'id' => '6398f80e81b9b',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '6398f80e81b9c',
                                'contents' => [
                                    0 => [
                                        'type' => 'inputwithlabel',
                                        'id' => '6398f80e81b9d',
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
                                        'id' => '6398f80e81baf',
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
                                        'id' => '6398f80e81bb3',
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
                'id' => '6398f80e81bbc',
                'contents' => [
                    0 => [
                        'type' => 'mpfile',
                        'id' => '6398f80e81bbd',
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
                    1 => [
                        'type' => 'detailtabs',
                        'id' => '6398f80e81bc2',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '6398f80e81bc3',
                                'contents' => [
                                    0 => [
                                        'type' => 'mpfile',
                                        'id' => '6398f80e81bc4',
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
            2 => [
                'type' => 'tab',
                'id' => '6398f80e81bcf',
                'contents' => [
                    0 => [
                        'type' => 'detailtabs',
                        'id' => '6398f80e81bd0',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '6398f80e81bd1',
                                'contents' => [
                                    0 => [
                                        'type' => 'textareawithlabel',
                                        'id' => '6398f80e81bd2',
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
                                        'id' => '6398f80e81bd7',
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
            3 => [
                'type' => 'tab',
                'id' => '6398f80e81be0',
                'contents' => [
                    0 => [
                        'type' => 'contentprotectioncontrol',
                        'id' => '6398f80e81be1',
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
                        'id' => '6398f80e81be4',
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
