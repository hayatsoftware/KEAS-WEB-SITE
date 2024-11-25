<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Worktopextrafeatures;


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
        'id' => '63835465ab223',
        'contents' => [
            0 => [
                'type' => 'tab',
                'id' => '63835465ab226',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '63835465ab227',
                        'contents' => [
                            0 => [
                                'type' => 'inputwithlabel',
                                'id' => '63835465ab228',
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
                                'type' => 'detailtabs',
                                'id' => '63835465ab232',
                                'contents' => [
                                    0 => [
                                        'type' => 'tab',
                                        'id' => '63835465ab234',
                                        'contents' => [
                                            0 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '63835465ab235',
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
                                                'type' => 'clearfix',
                                                'id' => '63835465ab245',
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
                                    'details' => '<var>page->details</var>',
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
                'id' => '63835465ab251',
                'contents' => [
                    0 => [
                        'type' => 'mpfile',
                        'id' => '63835465ab252',
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
                'id' => '63835465ab278',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '63835465ab279',
                        'contents' => [
                            0 => [
                                'type' => 'contentprotectioncontrol',
                                'id' => '63835465ab27a',
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
                                'id' => '63835465ab27d',
                                'contents' => [
                                    0 => [
                                        'type' => 'pagestatuscontrol',
                                        'id' => '63835465ab27e',
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
