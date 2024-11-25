<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Homepage;


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
        'id' => '63a294522f5fe',
        'contents' => [
            0 => [
                'type' => 'tab',
                'id' => '63a294522f602',
                'contents' => [
                    0 => [
                        'type' => 'detailtabs',
                        'id' => '63a294522f603',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '63a294522f605',
                                'contents' => [
                                    0 => [
                                        'type' => 'inputwithlabel',
                                        'id' => '63a294522f606',
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
                                        'id' => '63a294522f60f',
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
                                        'type' => 'inputwithlabel',
                                        'id' => '63a294522f619',
                                        'options' => [
                                            'html' => [
                                                'tag' => 'input',
                                                'attributes' => [
                                                    'class' => '',
                                                    'name' => 'detail->extras->footer_app_store',
                                                    'type' => 'text',
                                                    'value' => '<print>detail->footer_app_store</print>',
                                                ],
                                            ],
                                            'rules' => '',
                                            'title' => 'Footer App Store Url',
                                        ],
                                    ],
                                    3 => [
                                        'type' => 'inputwithlabel',
                                        'id' => '63a294522f61e',
                                        'options' => [
                                            'html' => [
                                                'tag' => 'input',
                                                'attributes' => [
                                                    'class' => '',
                                                    'name' => 'detail->extras->footer_google_store_url',
                                                    'type' => 'text',
                                                    'value' => '<print>detail->footer_google_store_url</print>',
                                                ],
                                            ],
                                            'rules' => '',
                                            'title' => 'Footer Google Store Url',
                                        ],
                                    ],
                                    4 => [
                                        'type' => 'accordion',
                                        'id' => '63a294522f622',
                                        'contents' => [
                                            0 => [
                                                'type' => 'accordionpane',
                                                'id' => '63a294522f624',
                                                'contents' => [
                                                    0 => [
                                                        'type' => 'inputwithlabel',
                                                        'id' => '63a294522f625',
                                                        'options' => [
                                                            'html' => [
                                                                'tag' => 'input',
                                                                'attributes' => [
                                                                    'class' => '',
                                                                    'name' => 'detail->extras->section_title',
                                                                    'type' => 'text',
                                                                    'value' => '<print>detail->section_title</print>',
                                                                ],
                                                            ],
                                                            'rules' => '',
                                                            'title' => 'Section Title',
                                                        ],
                                                    ],
                                                    1 => [
                                                        'type' => 'inputwithlabel',
                                                        'id' => '63a294522f629',
                                                        'options' => [
                                                            'html' => [
                                                                'tag' => 'input',
                                                                'attributes' => [
                                                                    'class' => '',
                                                                    'name' => 'detail->extras->section_slogan',
                                                                    'type' => 'text',
                                                                    'value' => '<print>detail->section_slogan</print>',
                                                                ],
                                                            ],
                                                            'rules' => '',
                                                            'title' => 'Section Slogan',
                                                        ],
                                                    ],
                                                    2 => [
                                                        'type' => 'inputwithlabel',
                                                        'id' => '63a294522f62d',
                                                        'options' => [
                                                            'html' => [
                                                                'tag' => 'input',
                                                                'attributes' => [
                                                                    'class' => '',
                                                                    'name' => 'detail->extras->section_url',
                                                                    'type' => 'text',
                                                                    'value' => '<print>detail->section_url</print>',
                                                                ],
                                                            ],
                                                            'rules' => '',
                                                            'title' => 'Section Url',
                                                        ],
                                                    ],
                                                ],
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'div',
                                                        'attributes' => [
                                                            'class' => 'card accordion-pane',
                                                            'name' => '',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                    'title' => 'Section Settings',
                                                    'initial_status' => 'closed',
                                                ],
                                            ],
                                        ],
                                        'options' => [
                                            'html' => [
                                                'tag' => 'div',
                                                'attributes' => [
                                                    'class' => 'accordion row',
                                                    'name' => '',
                                                ],
                                            ],
                                            'rules' => '',
                                        ],
                                    ],
                                    5 => [
                                        'type' => 'clearfix',
                                        'id' => '63a294522f636',
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
                'id' => '63a294522f63f',
                'contents' => [
                    0 => [
                        'type' => 'mpfile',
                        'id' => '63a294522f641',
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
                                'section_image' => '{"key":"section_image","file_type":"image","title":"Section Image","allow_actions":["select","upload"],"allow_diskkeys":["azure","local"],"extensions":"JPG,JPEG,PNG,GIF,SVG","min_width":"","max_width":"","min_height":"","max_height":"","min_filesize":"","max_filesize":"5120","max_file_count":"1","additional_rules":""}',
                                'default_decor' => '{"key":"default_decor","file_type":"image","title":"Default Decor Image","allow_actions":["select","upload"],"allow_diskkeys":["azure","local"],"extensions":"JPG,JPEG,PNG,GIF,SVG","min_width":"","max_width":"","min_height":"","max_height":"","min_filesize":"","max_filesize":"5120","max_file_count":"1","additional_rules":""}',
                                'default_feature' => '{"key":"default_feature","file_type":"image","title":"Default Feature Image","allow_actions":["select","upload"],"allow_diskkeys":["azure","local"],"extensions":"JPG,JPEG,PNG,GIF,SVG","min_width":"","max_width":"","min_height":"","max_height":"","min_filesize":"","max_filesize":"5120","max_file_count":"1","additional_rules":""}',
                                'default_certificate' => '{"key":"default_certificate","file_type":"image","title":"Default Certificate Image","allow_actions":["select","upload"],"allow_diskkeys":["azure","local"],"extensions":"JPG,JPEG,PNG,GIF,SVG","min_width":"","max_width":"","min_height":"","max_height":"","min_filesize":"","max_filesize":"5120","max_file_count":"1","additional_rules":""}',
                            ],
                        ],
                        'params' => [
                            'files' => '<var>sitemap->mfiles</var>',
                        ],
                    ],
                    1 => [
                        'type' => 'detailtabs',
                        'id' => '63a294522f646',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '63a294522f647',
                                'contents' => [
                                    0 => [
                                        'type' => 'mpfile',
                                        'id' => '63a294522f649',
                                        'options' => [
                                            'html' => [
                                                'tag' => 'input',
                                                'attributes' => [
                                                    'class' => 'mfile mpimage',
                                                    'name' => 'detail',
                                                    'type' => 'hidden',
                                                ],
                                            ],
                                            'rules' => '',
                                            'tags' => [
                                                'section_image' => '{%quot%key%quot%:%quot%section_image%quot%,%quot%file_type%quot%:%quot%image%quot%,%quot%title%quot%:%quot%Section Image%quot%,%quot%allow_actions%quot%:[%quot%select%quot%,%quot%upload%quot%],%quot%allow_diskkeys%quot%:[%quot%azure%quot%,%quot%local%quot%],%quot%extensions%quot%:%quot%JPG,JPEG,PNG,GIF,SVG%quot%,%quot%min_width%quot%:%quot%%quot%,%quot%max_width%quot%:%quot%%quot%,%quot%min_height%quot%:%quot%%quot%,%quot%max_height%quot%:%quot%%quot%,%quot%min_filesize%quot%:%quot%%quot%,%quot%max_filesize%quot%:%quot%5120%quot%,%quot%max_file_count%quot%:%quot%1%quot%,%quot%additional_rules%quot%:%quot%%quot%}',
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
                'id' => '63a294522f654',
                'contents' => [
                    0 => [
                        'type' => 'detailtabs',
                        'id' => '63a294522f655',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '63a294522f657',
                                'contents' => [
                                    0 => [
                                        'type' => 'textareawithlabel',
                                        'id' => '63a294522f658',
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
                                        'id' => '63a294522f65c',
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
                'id' => '63a294522f666',
                'contents' => [
                    0 => [
                        'type' => 'contentprotectioncontrol',
                        'id' => '63a294522f667',
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
                        'id' => '63a294522f66b',
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
