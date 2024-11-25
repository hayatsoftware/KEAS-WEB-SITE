<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Keasconceptstudio;


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
        'id' => '63f24a6844518',
        'contents' => [
            0 => [
                'type' => 'tab',
                'id' => '63f24a684451b',
                'contents' => [
                    0 => [
                        'type' => 'inputwithlabel',
                        'id' => '63f24a684451d',
                        'options' => [
                            'html' => [
                                'tag' => 'input',
                                'attributes' => [
                                    'class' => '',
                                    'name' => 'sitemap-><print>sitemap->id</print>->cvar_1',
                                    'type' => 'text',
                                    'value' => '<print>sitemap->cvar_1</print>',
                                ],
                            ],
                            'rules' => '',
                            'title' => 'Video Url <small>Please separate videos with comma</small>',
                        ],
                    ],
                    1 => [
                        'type' => 'detailtabs',
                        'id' => '63f24a6844525',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '63f24a6844527',
                                'contents' => [
                                    0 => [
                                        'type' => 'inputwithlabel',
                                        'id' => '63f24a6844528',
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
                                                    'name' => 'detail->extras->video_url',
                                                    'type' => 'text',
                                                    'value' => '<print>detail->video_url</print>',
                                                ],
                                            ],
                                            'rules' => '',
                                            'title' => 'Video Url',
                                        ],
                                    ],
                                    2 => [
                                        'type' => 'ckeditor',
                                        'id' => '63f24a684452d',
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
                                        'id' => '63f24a6844531',
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
                'id' => '63f24a684453a',
                'contents' => [
                    0 => [
                        'type' => 'mpfile',
                        'id' => '63f24a684453b',
                        'options' => [
                            'html' => [
                                'tag' => 'input',
                                'attributes' => [
                                    'class' => 'mfile mpimage',
                                    'name' => 'sitemap-><print>sitemap->id</print>',
                                    'type' => 'hidden',
                                ],
                            ],
                            'rules' => '',
                            'tags' => [
                                'cover' => '{%quot%key%quot%:%quot%cover%quot%,%quot%file_type%quot%:%quot%image%quot%,%quot%required%quot%:%quot%required%quot%,%quot%title%quot%:%quot%Varsayılan Kapak Görseli%quot%,%quot%allow_actions%quot%:[%quot%select%quot%,%quot%upload%quot%],%quot%allow_diskkeys%quot%:[%quot%azure%quot%,%quot%local%quot%],%quot%extensions%quot%:%quot%JPG,JPEG,PNG,GIF,SVG%quot%,%quot%min_width%quot%:%quot%%quot%,%quot%max_width%quot%:%quot%%quot%,%quot%min_height%quot%:%quot%%quot%,%quot%max_height%quot%:%quot%%quot%,%quot%width%quot%:%quot%%quot%,%quot%height%quot%:%quot%%quot%,%quot%min_filesize%quot%:%quot%%quot%,%quot%max_filesize%quot%:%quot%5120%quot%,%quot%max_file_count%quot%:%quot%1%quot%,%quot%additional_rules%quot%:%quot%%quot%}',
                                'video' => '{%quot%key%quot%:%quot%video%quot%,%quot%file_type%quot%:%quot%image%quot%,%quot%title%quot%:%quot%Video Image%quot%,%quot%allow_actions%quot%:[%quot%select%quot%,%quot%upload%quot%],%quot%allow_diskkeys%quot%:[%quot%azure%quot%,%quot%local%quot%],%quot%extensions%quot%:%quot%JPG,JPEG,PNG,GIF,SVG%quot%,%quot%min_width%quot%:%quot%%quot%,%quot%max_width%quot%:%quot%%quot%,%quot%min_height%quot%:%quot%%quot%,%quot%max_height%quot%:%quot%%quot%,%quot%min_filesize%quot%:%quot%%quot%,%quot%max_filesize%quot%:%quot%5120%quot%,%quot%max_file_count%quot%:%quot%1%quot%,%quot%additional_rules%quot%:%quot%%quot%}',
                            ],
                        ],
                        'params' => [
                            'files' => '<var>sitemap->mfiles</var>',
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
                'id' => '63f24a6844544',
                'contents' => [
                    0 => [
                        'type' => 'detailtabs',
                        'id' => '63f24a6844545',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '63f24a6844546',
                                'contents' => [
                                    0 => [
                                        'type' => 'textareawithlabel',
                                        'id' => '63f24a6844548',
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
                                        'id' => '63f24a684454c',
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
                'id' => '63f24a6844555',
                'contents' => [
                    0 => [
                        'type' => 'contentprotectioncontrol',
                        'id' => '63f24a6844557',
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
                        'id' => '63f24a684455a',
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
