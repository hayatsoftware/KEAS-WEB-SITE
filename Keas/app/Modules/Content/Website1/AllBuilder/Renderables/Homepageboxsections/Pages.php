<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Homepageboxsections;


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
        'id' => '638f70cf23d58',
        'contents' => [
            0 => [
                'type' => 'tab',
                'id' => '638f70cf23d5c',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '638f70cf23d5e',
                        'contents' => [
                            0 => [
                                'type' => 'inputwithlabel',
                                'id' => '638f70cf23d5f',
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
                                'type' => 'toggleswitch',
                                'id' => '638f70cf23d68',
                                'options' => [
                                    'html' => [
                                        'tag' => 'input',
                                        'attributes' => [
                                            'class' => 'form-check-input',
                                            'name' => 'page-><print>page->id</print>->cint_1',
                                            'type' => 'checkbox',
                                            'value' => '0',
                                        ],
                                    ],
                                    'rules' => '',
                                    'value' => '<print>page->cint_1</print>',
                                ],
                                'data' => [
                                    'on_value' => '1',
                                    'on_text' => 'Big Box',
                                    'off_value' => '0',
                                    'off_text' => 'Small Box',
                                ],
                            ],
                            2 => [
                                'type' => 'detailtabs',
                                'id' => '638f70cf23d6e',
                                'contents' => [
                                    0 => [
                                        'type' => 'tab',
                                        'id' => '638f70cf23d6f',
                                        'contents' => [
                                            0 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '638f70cf23d70',
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
                                                'type' => 'inputwithlabel',
                                                'id' => '638f70cf23d75',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'input',
                                                        'attributes' => [
                                                            'class' => '',
                                                            'name' => 'detail->extras->box_url',
                                                            'type' => 'text',
                                                            'value' => '<print>detail->box_url</print>',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                    'title' => 'Box Url',
                                                ],
                                            ],
                                            2 => [
                                                'type' => 'ckeditor',
                                                'id' => '638f70cf23d79',
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
                                                'id' => '638f70cf23d7d',
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
                'id' => '638f70cf23d89',
                'contents' => [
                    0 => [
                        'type' => 'mpfile',
                        'id' => '638f70cf23d8a',
                        'options' => [
                            'html' => [
                                'tag' => 'input',
                                'attributes' => [
                                    'class' => 'mfile mpimage',
                                    'name' => 'page-><print>page->id</print>',
                                    'type' => 'hidden',
                                ],
                            ],
                            'tags' => [
                                'cover' => '{%quot%key%quot%:%quot%cover%quot%,%quot%file_type%quot%:%quot%image%quot%,%quot%required%quot%:%quot%required%quot%,%quot%title%quot%:%quot%Varsayılan Kapak Fotoğrafı%quot%,%quot%allow_actions%quot%:[%quot%select%quot%,%quot%upload%quot%],%quot%allow_diskkeys%quot%:[%quot%azure%quot%,%quot%local%quot%],%quot%extensions%quot%:%quot%JPG,JPEG,PNG,GIF,SVG%quot%,%quot%min_width%quot%:%quot%%quot%,%quot%max_width%quot%:%quot%%quot%,%quot%min_height%quot%:%quot%%quot%,%quot%max_height%quot%:%quot%%quot%,%quot%width%quot%:%quot%%quot%,%quot%height%quot%:%quot%%quot%,%quot%min_filesize%quot%:%quot%%quot%,%quot%max_filesize%quot%:%quot%5120%quot%,%quot%max_file_count%quot%:%quot%1%quot%,%quot%additional_rules%quot%:%quot%%quot%}',
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
                'id' => '638f70cf23d92',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '638f70cf23d94',
                        'contents' => [
                            0 => [
                                'type' => 'contentprotectioncontrol',
                                'id' => '638f70cf23d95',
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
                                'id' => '638f70cf23d98',
                                'contents' => [
                                    0 => [
                                        'type' => 'pagestatuscontrol',
                                        'id' => '638f70cf23d9a',
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
