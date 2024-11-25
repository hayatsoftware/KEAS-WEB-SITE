<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Events;


use Mediapress\AllBuilder\Foundation\BuilderRenderable;

class Pages extends BuilderRenderable
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
                            "action" => route("Content.pages.update", ["sitemap_id" => $page->sitemap_id, "id" => $page->id]),
                        ]
                    ],
                    "collectable_as"=>["pagesform", "form"]
                ],
                "contents" =>

                /*EDITOR*/
[
    0 => [
        'type' => 'steptabs',
        'id' => '6393347acafa3',
        'contents' => [
            0 => [
                'type' => 'tab',
                'id' => '6393347acafa6',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '6393347acafa8',
                        'contents' => [
                            0 => [
                                'type' => 'inputwithlabel',
                                'id' => '6393347acafa9',
                                'options' => [
                                    'html' => [
                                        'tag' => 'input',
                                        'attributes' => [
                                            'class' => '',
                                            'name' => 'page-><print>page->id</print>->order',
                                            'type' => 'number',
                                            'value' => '<print>page->order</print>',
                                        ],
                                    ],
                                    'title' => 'Sıralama',
                                    'rules' => '',
                                ],
                            ],
                            1 => [
                                'type' => 'inputwithlabel',
                                'id' => '6393347acafb2',
                                'options' => [
                                    'html' => [
                                        'tag' => 'input',
                                        'attributes' => [
                                            'class' => '',
                                            'name' => 'page-><print>page->id</print>->cvar_1',
                                            'type' => 'date',
                                            'value' => '<print>page->cvar_1</print>',
                                        ],
                                    ],
                                    'rules' => '',
                                    'title' => 'Event Date',
                                ],
                            ],
                            2 => [
                                'type' => 'detailtabs',
                                'id' => '6393347acafb7',
                                'contents' => [
                                    0 => [
                                        'type' => 'tab',
                                        'id' => '6393347acafb8',
                                        'contents' => [
                                            0 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '6393347acafb9',
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
                                                'type' => 'detailslugcontrolv2',
                                                'id' => '6393347acafc0',
                                                'options' => [
                                                    'initial_mode' => 'waiting',
                                                ],
                                                'params' => [
                                                    'detail' => '<var>detail</var>',
                                                ],
                                            ],
                                            2 => [
                                                'type' => 'ckeditor',
                                                'id' => '6393347acafc4',
                                                'params' => [
                                                ],
                                                'options' => [
                                                    'rules' => '',
                                                    'title' => 'Detay Yazısı',
                                                    'value' => '<print>detail->detail</print>',
                                                    'html' => [
                                                        'attributes' => [
                                                            'name' => 'detail->detail',
                                                        ],
                                                    ],
                                                    'tags' => [
                                                    ],
                                                ],
                                            ],
                                            3 => [
                                                'type' => 'clearfix',
                                                'id' => '6393347acafc9',
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
                                    'details_parent' => '<var>page</var>',
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
            1 => [
                'type' => 'tab',
                'id' => '6393347acafd5',
                'contents' => [
                    0 => [
                        'type' => 'mpfile',
                        'id' => '6393347acafd6',
                        'options' => [
                            'html' => [
                                'tag' => 'input',
                                'attributes' => [
                                    'class' => 'mfile mpimage',
                                    'name' => 'page-><print>page->id</print>',
                                    'type' => 'hidden',
                                ],
                            ],
                            'rules' => '',
                            'tags' => [
                                'cover' => '{%quot%key%quot%:%quot%cover%quot%,%quot%file_type%quot%:%quot%image%quot%,%quot%required%quot%:%quot%required%quot%,%quot%title%quot%:%quot%Varsayılan Kapak Fotoğrafı%quot%,%quot%allow_actions%quot%:[%quot%select%quot%,%quot%upload%quot%],%quot%allow_diskkeys%quot%:[%quot%azure%quot%,%quot%local%quot%],%quot%extensions%quot%:%quot%JPG,JPEG,PNG,GIF,SVG%quot%,%quot%min_width%quot%:%quot%%quot%,%quot%max_width%quot%:%quot%%quot%,%quot%min_height%quot%:%quot%%quot%,%quot%max_height%quot%:%quot%%quot%,%quot%width%quot%:%quot%%quot%,%quot%height%quot%:%quot%%quot%,%quot%min_filesize%quot%:%quot%%quot%,%quot%max_filesize%quot%:%quot%5120%quot%,%quot%max_file_count%quot%:%quot%1%quot%,%quot%additional_rules%quot%:%quot%%quot%}',
                                'gallery' => '{%quot%key%quot%:%quot%gallery%quot%,%quot%file_type%quot%:%quot%image%quot%,%quot%title%quot%:%quot%Photo Gallery%quot%,%quot%allow_actions%quot%:[%quot%select%quot%,%quot%upload%quot%],%quot%allow_diskkeys%quot%:[%quot%azure%quot%,%quot%local%quot%],%quot%extensions%quot%:%quot%JPG,JPEG,PNG,GIF,SVG%quot%,%quot%min_width%quot%:%quot%%quot%,%quot%max_width%quot%:%quot%%quot%,%quot%min_height%quot%:%quot%%quot%,%quot%max_height%quot%:%quot%%quot%,%quot%min_filesize%quot%:%quot%%quot%,%quot%max_filesize%quot%:%quot%5120%quot%,%quot%max_file_count%quot%:%quot%30%quot%,%quot%additional_rules%quot%:%quot%%quot%}',
                            ],
                        ],
                        'params' => [
                            'files' => '<var>page->mfiles</var>',
                        ],
                    ],
                ],
                'options' => [
                    'title' => 'Fotoğraflar',
                ],
            ],
            2 => [
                'type' => 'tab',
                'id' => '6393347acafdf',
                'contents' => [
                    0 => [
                        'type' => 'detailtabs',
                        'id' => '6393347acafe0',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '6393347acafe1',
                                'contents' => [
                                    0 => [
                                        'type' => 'textareawithlabel',
                                        'id' => '6393347acafe2',
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
                                        'id' => '6393347acafe7',
                                        'options' => [
                                            'html' => [
                                                'tag' => 'div',
                                                'attributes' => [
                                                    'class' => 'col-12',
                                                    'name' => '',
                                                ],
                                            ],
                                        ],
                                        'params' => [
                                            'detail' => '<var>detail</var>',
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
                            'meta_variables' => '0',
                        ],
                        'params' => [
                            'keyname' => 'key',
                            'itemname' => 'detail',
                            'details' => '<var>page->details</var>',
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
                    'title' => 'SEO',
                ],
            ],
            3 => [
                'type' => 'tab',
                'id' => '6393347acaff2',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '6393347acaff3',
                        'contents' => [
                            0 => [
                                'type' => 'contentprotectioncontrol',
                                'id' => '6393347acaff5',
                                'options' => [
                                    'html' => [
                                        'tag' => 'div',
                                        'attributes' => [
                                            'class' => 'col-sm-12 col-md-6',
                                            'name' => '',
                                        ],
                                    ],
                                ],
                                'params' => [
                                    'object' => '<var>page</var>',
                                ],
                            ],
                            1 => [
                                'type' => 'div',
                                'id' => '6393347acaff8',
                                'contents' => [
                                    0 => [
                                        'type' => 'pagestatuscontrol',
                                        'id' => '6393347acaffa',
                                        'params' => [
                                            'page_model' => '<var>page</var>',
                                        ],
                                    ],
                                ],
                                'options' => [
                                    'html' => [
                                        'tag' => 'div',
                                        'attributes' => [
                                            'class' => 'col-sm-12 col-md-6',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'options' => [
                            'html' => [
                                'tag' => 'div',
                                'attributes' => [
                                    'class' => 'row position-relative',
                                    'name' => '',
                                    'style' => 'overflow:hidden;',
                                ],
                            ],
                        ],
                    ],
                ],
                'options' => [
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
