<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Brands;


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
        'id' => '63b5480eb484b',
        'contents' => [
            0 => [
                'type' => 'tab',
                'id' => '63b5480eb4850',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '63b5480eb4851',
                        'contents' => [
                            0 => [
                                'type' => 'inputwithlabel',
                                'id' => '63b5480eb4853',
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
                                'options' => [
                                    'html' => [
                                        'tag' => 'input',
                                        'attributes' => [
                                            'class' => '',
                                            'name' => 'page-><print>page->id</print>->cint_1',
                                            'type' => 'text',
                                            'value' => '<print>page->cint_1</print>',
                                        ],
                                    ],
                                    'rules' => '',
                                    'title' => 'Brand Id',
                                ],
                            ],
                            2 => [
                                'type' => 'selectwithlabel',
                                'id' => '63b5480eb485c',
                                'options' => [
                                    'html' => [
                                        'tag' => 'select',
                                        'attributes' => [
                                            'class' => '',
                                            'name' => 'page-><print>page->id</print>->cint_2',
                                            'value' => '0',
                                        ],
                                    ],
                                    'rules' => '',
                                    'title' => 'Matte - Gloss',
                                    'multiple' => '0',
                                    'value' => '<print>page->cint_2</print>',
                                    'show_default_option' => '0',
                                    'additional_content' => 'merge',
                                    'default_value' => '',
                                    'default_text' => '---Choose---',
                                ],
                                'data' => [
                                    'values' => [
                                        'type' => 'ds:Content->MatteGloss',
                                    ],
                                ],
                            ],
                            3 => [
                                'type' => 'detailtabs',
                                'id' => '63b5480eb4863',
                                'contents' => [
                                    0 => [
                                        'type' => 'tab',
                                        'id' => '63b5480eb4864',
                                        'contents' => [
                                            0 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '63b5480eb4866',
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
                                                'id' => '63b5480eb486d',
                                                'options' => [
                                                    'initial_mode' => 'waiting',
                                                ],
                                                'params' => [
                                                    'detail' => '<var>detail</var>',
                                                ],
                                            ],
                                            2 => [
                                                'type' => 'ckeditor',
                                                'id' => '63b5480eb4873',
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
                                                'type' => 'ckeditor',
                                                'id' => '63b5480eb4879',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'textarea',
                                                        'attributes' => [
                                                            'class' => 'form-control ckeditor',
                                                            'name' => 'detail->extras->general_info',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                    'title' => 'General Info',
                                                    'value' => ' <print>detail->general_info</print> ',
                                                ],
                                            ],
                                            4 => [
                                                'type' => 'ckeditor',
                                                'id' => '63b5480eb487f',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'textarea',
                                                        'attributes' => [
                                                            'class' => 'form-control ckeditor',
                                                            'name' => 'detail->extras->technical',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                    'title' => 'Technical Properties',
                                                    'value' => ' <print>detail->technical</print> ',
                                                ],
                                            ],
                                            5 => [
                                                'type' => 'ckeditor',
                                                'id' => '63b5480eb4884',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'textarea',
                                                        'attributes' => [
                                                            'class' => 'form-control ckeditor',
                                                            'name' => 'detail->extras->usages',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                    'title' => 'Usages',
                                                    'value' => ' <print>detail->usages</print> ',
                                                ],
                                            ],
                                            6 => [
                                                'type' => 'ckeditor',
                                                'id' => '63b5480eb488a',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'textarea',
                                                        'attributes' => [
                                                            'class' => 'form-control ckeditor',
                                                            'name' => 'detail->extras->advantages',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                    'title' => 'Advantages',
                                                    'value' => ' <print>detail->advantages</print> ',
                                                ],
                                            ],
                                            7 => [
                                                'type' => 'clearfix',
                                                'id' => '63b5480eb488f',
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
                                    'details_parent' => '<var>page|sitemap|category|criteria|property</var>',
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
                'id' => '63b5480eb489e',
                'contents' => [
                    0 => [
                        'type' => 'mpfile',
                        'id' => '63b5480eb48a0',
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
                    1 => [
                        'type' => 'detailtabs',
                        'id' => '63b5480eb48a5',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '63b5480eb48a7',
                                'contents' => [
                                    0 => [
                                        'type' => 'mpfile',
                                        'id' => '63b5480eb48a8',
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
                                                'cover' => '{%quot%key%quot%:%quot%cover%quot%,%quot%file_type%quot%:%quot%image%quot%,%quot%required%quot%:%quot%required%quot%,%quot%title%quot%:%quot%Varsayılan Kapak Görseli%quot%,%quot%allow_actions%quot%:[%quot%select%quot%,%quot%upload%quot%],%quot%allow_diskkeys%quot%:[%quot%azure%quot%,%quot%local%quot%],%quot%extensions%quot%:%quot%JPG,JPEG,PNG,GIF,SVG%quot%,%quot%min_width%quot%:%quot%%quot%,%quot%max_width%quot%:%quot%%quot%,%quot%min_height%quot%:%quot%%quot%,%quot%max_height%quot%:%quot%%quot%,%quot%width%quot%:%quot%%quot%,%quot%height%quot%:%quot%%quot%,%quot%min_filesize%quot%:%quot%%quot%,%quot%max_filesize%quot%:%quot%5120%quot%,%quot%max_file_count%quot%:%quot%1%quot%,%quot%additional_rules%quot%:%quot%%quot%}',
                                                'layer_image' => '{%quot%key%quot%:%quot%layer_image%quot%,%quot%file_type%quot%:%quot%image%quot%,%quot%title%quot%:%quot%Product Layer Image%quot%,%quot%allow_actions%quot%:[%quot%select%quot%,%quot%upload%quot%],%quot%allow_diskkeys%quot%:[%quot%azure%quot%,%quot%local%quot%],%quot%extensions%quot%:%quot%JPG,JPEG,PNG,GIF,SVG%quot%,%quot%min_width%quot%:%quot%%quot%,%quot%max_width%quot%:%quot%%quot%,%quot%min_height%quot%:%quot%%quot%,%quot%max_height%quot%:%quot%%quot%,%quot%min_filesize%quot%:%quot%%quot%,%quot%max_filesize%quot%:%quot%5120%quot%,%quot%max_file_count%quot%:%quot%1%quot%,%quot%additional_rules%quot%:%quot%%quot%}',
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
                    'title' => 'Fotoğraflar',
                ],
            ],
            2 => [
                'type' => 'tab',
                'id' => '63b5480eb48be',
                'contents' => [
                    0 => [
                        'type' => 'detailtabs',
                        'id' => '63b5480eb48bf',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '63b5480eb48c0',
                                'contents' => [
                                    0 => [
                                        'type' => 'textareawithlabel',
                                        'id' => '63b5480eb48c2',
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
                                        'id' => '63b5480eb48c7',
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
                'id' => '63b5480eb48d3',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '63b5480eb48d4',
                        'contents' => [
                            0 => [
                                'type' => 'contentprotectioncontrol',
                                'id' => '63b5480eb48d6',
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
                                'id' => '63b5480eb48da',
                                'contents' => [
                                    0 => [
                                        'type' => 'pagestatuscontrol',
                                        'id' => '63b5480eb48db',
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
