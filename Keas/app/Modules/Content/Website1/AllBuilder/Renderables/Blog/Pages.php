<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Blog;


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
        'id' => '639c4d86f04bc',
        'contents' => [
            0 => [
                'type' => 'tab',
                'id' => '639c4d86f04c0',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '639c4d86f04c2',
                        'contents' => [
                            0 => [
                                'type' => 'inputwithlabel',
                                'id' => '639c4d86f04c3',
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
                                'id' => '639c4d86f04cb',
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
                                    'on_text' => 'Show On Slider',
                                    'off_value' => '0',
                                    'off_text' => '-',
                                ],
                            ],
                            2 => [
                                'type' => 'toggleswitch',
                                'options' => [
                                    'html' => [
                                        'tag' => 'input',
                                        'attributes' => [
                                            'class' => 'form-check-input',
                                            'name' => 'page-><print>page->id</print>->cint_2',
                                            'type' => 'checkbox',
                                            'value' => '0',
                                        ],
                                    ],
                                    'rules' => '',
                                    'value' => '<print>page->cint_2</print>',
                                ],
                                'data' => [
                                    'on_value' => '1',
                                    'on_text' => 'Active in Homepage Posts',
                                    'off_value' => '0',
                                    'off_text' => '-',
                                ],
                            ],
                            3 => [
                                'type' => 'detailtabs',
                                'id' => '639c4d86f04d0',
                                'contents' => [
                                    0 => [
                                        'type' => 'tab',
                                        'id' => '639c4d86f04d2',
                                        'contents' => [
                                            0 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '639c4d86f04d3',
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
                                                'id' => '639c4d86f04d7',
                                                'options' => [
                                                    'initial_mode' => 'waiting',
                                                ],
                                                'params' => [
                                                    'detail' => '<var>detail</var>',
                                                ],
                                            ],
                                            2 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '639c4d86f04da',
                                                'params' => [
                                                ],
                                                'options' => [
                                                    'rules' => '',
                                                    'title' => 'Detay Slogan',
                                                    'html' => [
                                                        'attributes' => [
                                                            'name' => 'detail->extras->summary',
                                                            'value' => '<print>detail->summary</print>',
                                                        ],
                                                    ],
                                                    'tags' => [
                                                    ],
                                                ],
                                            ],
                                            3 => [
                                                'type' => 'ckeditor',
                                                'id' => '639c4d86f04df',
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
                                            4 => [
                                                'type' => 'clearfix',
                                                'id' => '639c4d86f04e2',
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
                'id' => '639c4d86f04ee',
                'contents' => [
                    0 => [
                        'type' => 'pagecategoriescontrol',
                        'id' => '639c4d86f04ef',
                        'options' => [
                            'html' => [
                                'tag' => 'select',
                                'attributes' => [
                                    'class' => 'multiple',
                                    'name' => 'page-><print>page->id</print>->sync:categories[]',
                                    'multiple' => 'multiple',
                                ],
                            ],
                            'rules' => '',
                            'title' => 'Select Categories',
                            'multiple' => '1',
                            'show_default_option' => '0',
                            'default_value' => '',
                            'default_text' => '---Choose---',
                        ],
                        'params' => [
                            'page_model' => '<var>page</var>',
                        ],
                    ],
                    1 => [
                        'type' => 'mpfile',
                        'id' => '639c4d86f04f4',
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
                                'cover' => '{"key":"cover","file_type":"image","required":"required","title":"Varsayılan Kapak Fotoğrafı","allow_actions":["select","upload"],"allow_diskkeys":["azure","local"],"extensions":"JPG,JPEG,PNG,GIF,SVG","min_width":"","max_width":"","min_height":"","max_height":"","width":"","height":"","min_filesize":"","max_filesize":"5120","max_file_count":"1","additional_rules":""}',
                                'banner' => '{"key":"banner","file_type":"image","title":"Slider Post Image","allow_actions":["select","upload"],"allow_diskkeys":["azure","local"],"extensions":"JPG,JPEG,PNG,GIF,SVG","min_width":"","max_width":"","min_height":"","max_height":"","min_filesize":"","max_filesize":"5120","max_file_count":"1","additional_rules":""}',
                            ],
                        ],
                        'params' => [
                            'files' => '<var>page->mfiles</var>',
                        ],
                    ],
                    2 => [
                        'type' => 'detailtabs',
                        'id' => '639c4d86f04f9',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '639c4d86f04fa',
                                'contents' => [
                                    0 => [
                                        'type' => 'mpfile',
                                        'id' => '639c4d86f04fb',
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
                    'rules' => '',
                    'title' => 'Images & Categories',
                ],
            ],
            2 => [
                'type' => 'tab',
                'id' => '639c4d86f0507',
                'contents' => [
                    0 => [
                        'type' => 'detailtabs',
                        'id' => '639c4d86f0508',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '639c4d86f050a',
                                'contents' => [
                                    0 => [
                                        'type' => 'textareawithlabel',
                                        'id' => '639c4d86f050b',
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
                                        'id' => '639c4d86f050f',
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
                'id' => '639c4d86f051a',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '639c4d86f051b',
                        'contents' => [
                            0 => [
                                'type' => 'contentprotectioncontrol',
                                'id' => '639c4d86f051d',
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
                                'id' => '639c4d86f0520',
                                'contents' => [
                                    0 => [
                                        'type' => 'pagestatuscontrol',
                                        'id' => '639c4d86f0521',
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
