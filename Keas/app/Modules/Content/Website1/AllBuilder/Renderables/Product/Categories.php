<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Product;


use Mediapress\AllBuilder\Foundation\BuilderRenderable;

class Categories extends BuilderRenderable
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
                        "action" => route("Content.categories.category.store", ["category" => $category->id]),
                    ]
                ],
                "collectable_as"=>["categoriesform", "form"]
            ],
            "contents" =>
            /*EDITOR*/
[
    0 => [
        'type' => 'steptabs',
        'id' => '65bd351512294',
        'contents' => [
            0 => [
                'type' => 'tab',
                'id' => '65bd351512298',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '65bd35151229a',
                        'contents' => [
                            0 => [
                                'type' => 'contentstatuscontrol',
                                'id' => '65bd35151229c',
                                'options' => [
                                    'html' => [
                                        'tag' => 'div',
                                        'attributes' => [
                                            'class' => 'checkbox',
                                            'name' => '',
                                        ],
                                    ],
                                    'title' => '',
                                    'value' => '',
                                    'default' => '2',
                                    'multiline' => '1',
                                ],
                                'params' => [
                                    'values' => '[]',
                                    'content_model' => '<var>category</var>',
                                ],
                            ],
                            1 => [
                                'type' => 'toggleswitch',
                                'id' => '60d8d16f734d0',
                                'options' => [
                                    'html' => [
                                        'tag' => 'input',
                                        'attributes' => [
                                            'class' => 'form-check-input',
                                            'name' => 'category-><print>category->id</print>->cint_2',
                                            'type' => 'checkbox',
                                            'value' => '0',
                                        ],
                                    ],
                                    'rules' => '',
                                    'value' => '<print>category->cint_2</print>',
                                ],
                                'data' => [
                                    'on_value' => '1',
                                    'on_text' => 'New Category',
                                    'off_value' => '0',
                                    'off_text' => '-',
                                ],
                            ],
                            2 => [
                                'type' => 'toggleswitch',
                                'id' => '60d1d96f724d0',
                                'options' => [
                                    'html' => [
                                        'tag' => 'input',
                                        'attributes' => [
                                            'class' => 'form-check-input',
                                            'name' => 'category-><print>category->id</print>->cint_3',
                                            'type' => 'checkbox',
                                            'value' => '0',
                                        ],
                                    ],
                                    'rules' => '',
                                    'value' => '<print>category->cint_3</print>',
                                ],
                                'data' => [
                                    'on_value' => '1',
                                    'on_text' => 'Do not show in parent product list page',
                                    'off_value' => '0',
                                    'off_text' => '-',
                                ],
                            ],
                            3 => [
                                'type' => 'detailtabs',
                                'id' => '65bd3515122a7',
                                'contents' => [
                                    0 => [
                                        'type' => 'tab',
                                        'id' => '65bd3515122a9',
                                        'contents' => [
                                            0 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '65bd3515122ab',
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
                                                'id' => '65bd3515122b2',
                                                'options' => [
                                                    'initial_mode' => 'waiting',
                                                ],
                                                'params' => [
                                                    'detail' => '<var>detail</var>',
                                                ],
                                            ],
                                            2 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '65bd3515122bb',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'input',
                                                        'attributes' => [
                                                            'class' => '',
                                                            'name' => 'detail->extras->videos',
                                                            'type' => 'text',
                                                            'value' => '<print>detail->videos</print>',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                    'title' => 'Youtube Video ID <small>For more videos please seperate with comma </small>',
                                                ],
                                            ],
                                            3 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '65bd3515122c4',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'input',
                                                        'attributes' => [
                                                            'class' => '',
                                                            'name' => 'detail->extras->threed',
                                                            'type' => 'text',
                                                            'value' => '<print>detail->threed</print>',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                    'title' => '3D Button Url',
                                                ],
                                            ],
                                            4 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '65bd3515122c9',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'input',
                                                        'attributes' => [
                                                            'class' => '',
                                                            'name' => 'detail->extras->virtual_room',
                                                            'type' => 'text',
                                                            'value' => '<print>detail->virtual_room</print>',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                    'title' => 'Virtual Room Url',
                                                ],
                                            ],
                                            5 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '65bd3515122d4',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'input',
                                                        'attributes' => [
                                                            'class' => '',
                                                            'name' => 'detail->extras->see_in_room',
                                                            'type' => 'text',
                                                            'value' => '<print>detail->see_in_room</print>',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                    'title' => 'See In Room Url',
                                                ],
                                            ],
                                            6 => [
                                                'type' => 'ckeditor',
                                                'id' => '65bd3515122d9',
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
                                            7 => [
                                                'type' => 'ckeditor',
                                                'id' => '65bd3515122df',
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
                                                    'value' => '   <print>detail->general_info</print> ',
                                                ],
                                            ],
                                            8 => [
                                                'type' => 'ckeditor',
                                                'id' => '65bd3515122e4',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'textarea',
                                                        'attributes' => [
                                                            'class' => 'form-control ckeditor',
                                                            'name' => 'detail->extras->usages',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                    'title' => 'Usage Areas',
                                                    'value' => '<print>detail->usages</print> ',
                                                ],
                                            ],
                                            9 => [
                                                'type' => 'ckeditor',
                                                'id' => '65bd3515122ea',
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
                                                    'value' => '<print>detail->advantages</print> ',
                                                ],
                                            ],
                                            10 => [
                                                'type' => 'mpfile',
                                                'id' => '65bd3515122ef',
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
                                                        'layer_image_zone' => '{"key":"layer_image_zone","file_type":"image","title":"Zone Layer Image","allow_actions":["select","upload"],"allow_diskkeys":["azure","local"],"extensions":"JPG,JPEG,PNG,GIF,SVG","min_width":"","max_width":"","min_height":"","max_height":"","min_filesize":"","max_filesize":"5120","max_file_count":"1","additional_rules":""}',
                                                        'zone_homepage' => '{"key":"zone_homepage","file_type":"image","title":"Zone Cover Image","allow_actions":["select","upload"],"allow_diskkeys":["azure","local"],"extensions":"JPG,JPEG,PNG,GIF,SVG","min_width":"","max_width":"","min_height":"","max_height":"","min_filesize":"","max_filesize":"5120","max_file_count":"1","additional_rules":""}',
                                                        'menu_cover_image' => '{"key":"menu_cover_image","file_type":"image","title":"Menu Cover Image","allow_actions":["select","upload"],"allow_diskkeys":["azure","local"],"extensions":"JPG,JPEG,PNG,GIF,SVG","min_width":"","max_width":"","min_height":"","max_height":"","min_filesize":"","max_filesize":"5120","max_file_count":"1","additional_rules":""}',
                                                        'zone_top_image' => '{"key":"zone_top_image","file_type":"image","title":"Top Image By Zone","allow_actions":["select","upload"],"allow_diskkeys":["azure","local"],"extensions":"JPG,JPEG,PNG,GIF,SVG","min_width":"","max_width":"","min_height":"","max_height":"","min_filesize":"","max_filesize":"5120","max_file_count":"1","additional_rules":""}',
                                                    ],
                                                ],
                                                'params' => [
                                                    'files' => '<var>detail->mfiles</var>',
                                                ],
                                            ],
                                            11 => [
                                                'type' => 'clearfix',
                                                'id' => '65bd3515122f7',
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
                                    'delete_restore_details' => '0',
                                    'meta_variables' => '1',
                                ],
                                'params' => [
                                    'keyname' => 'key',
                                    'itemname' => 'detail',
                                    'array' => '[]',
                                    'details_parent' => '<var>category</var>',
                                    'details' => '<var>category->details</var>',
                                ],
                            ],
                            4 => [
                                'type' => 'mpfile',
                                'id' => '65bd351512304',
                                'options' => [
                                    'html' => [
                                        'tag' => 'input',
                                        'attributes' => [
                                            'class' => 'mfile mpimage',
                                            'name' => 'category-><print>category->id</print>',
                                            'type' => 'hidden',
                                        ],
                                    ],
                                    'rules' => '',
                                    'tags' => [
                                        'cover' => '{%quot%key%quot%:%quot%cover%quot%,%quot%file_type%quot%:%quot%image%quot%,%quot%title%quot%:%quot%Main Image%quot%,%quot%allow_actions%quot%:[%quot%select%quot%,%quot%upload%quot%],%quot%allow_diskkeys%quot%:[%quot%azure%quot%,%quot%local%quot%],%quot%extensions%quot%:%quot%JPG,JPEG,PNG,GIF,SVG%quot%,%quot%min_width%quot%:%quot%%quot%,%quot%max_width%quot%:%quot%%quot%,%quot%min_height%quot%:%quot%%quot%,%quot%max_height%quot%:%quot%%quot%,%quot%min_filesize%quot%:%quot%%quot%,%quot%max_filesize%quot%:%quot%5120%quot%,%quot%max_file_count%quot%:%quot%1%quot%,%quot%additional_rules%quot%:%quot%%quot%}',
                                        'background' => '{%quot%key%quot%:%quot%background%quot%,%quot%file_type%quot%:%quot%image%quot%,%quot%title%quot%:%quot%Background Image%quot%,%quot%allow_actions%quot%:[%quot%select%quot%,%quot%upload%quot%],%quot%allow_diskkeys%quot%:[%quot%azure%quot%,%quot%local%quot%],%quot%extensions%quot%:%quot%JPG,JPEG,PNG,GIF,SVG%quot%,%quot%min_width%quot%:%quot%%quot%,%quot%max_width%quot%:%quot%%quot%,%quot%min_height%quot%:%quot%%quot%,%quot%max_height%quot%:%quot%%quot%,%quot%min_filesize%quot%:%quot%%quot%,%quot%max_filesize%quot%:%quot%5120%quot%,%quot%max_file_count%quot%:%quot%1%quot%,%quot%additional_rules%quot%:%quot%%quot%}',
                                        'layer_image' => '{%quot%key%quot%:%quot%layer_image%quot%,%quot%file_type%quot%:%quot%image%quot%,%quot%title%quot%:%quot%Parke Layer Image%quot%,%quot%allow_actions%quot%:[%quot%select%quot%,%quot%upload%quot%],%quot%allow_diskkeys%quot%:[%quot%azure%quot%,%quot%local%quot%],%quot%extensions%quot%:%quot%JPG,JPEG,PNG,GIF,SVG%quot%,%quot%min_width%quot%:%quot%%quot%,%quot%max_width%quot%:%quot%%quot%,%quot%min_height%quot%:%quot%%quot%,%quot%max_height%quot%:%quot%%quot%,%quot%min_filesize%quot%:%quot%%quot%,%quot%max_filesize%quot%:%quot%5120%quot%,%quot%max_file_count%quot%:%quot%1%quot%,%quot%additional_rules%quot%:%quot%%quot%}',
                                        'homepage' => '{%quot%key%quot%:%quot%homepage%quot%,%quot%file_type%quot%:%quot%image%quot%,%quot%title%quot%:%quot%Homepage Image%quot%,%quot%allow_actions%quot%:[%quot%select%quot%,%quot%upload%quot%],%quot%allow_diskkeys%quot%:[%quot%azure%quot%,%quot%local%quot%],%quot%extensions%quot%:%quot%JPG,JPEG,PNG,GIF,SVG%quot%,%quot%min_width%quot%:%quot%%quot%,%quot%max_width%quot%:%quot%%quot%,%quot%min_height%quot%:%quot%%quot%,%quot%max_height%quot%:%quot%%quot%,%quot%min_filesize%quot%:%quot%%quot%,%quot%max_filesize%quot%:%quot%5120%quot%,%quot%max_file_count%quot%:%quot%1%quot%,%quot%additional_rules%quot%:%quot%%quot%}',
                                        'banner_layer_image' => '{%quot%key%quot%:%quot%banner_layer_image%quot%,%quot%file_type%quot%:%quot%image%quot%,%quot%title%quot%:%quot%Banner Layer Image%quot%,%quot%allow_actions%quot%:[%quot%select%quot%,%quot%upload%quot%],%quot%allow_diskkeys%quot%:[%quot%azure%quot%,%quot%local%quot%],%quot%extensions%quot%:%quot%JPG,JPEG,PNG,GIF,SVG%quot%,%quot%min_width%quot%:%quot%%quot%,%quot%max_width%quot%:%quot%%quot%,%quot%min_height%quot%:%quot%%quot%,%quot%max_height%quot%:%quot%%quot%,%quot%min_filesize%quot%:%quot%%quot%,%quot%max_filesize%quot%:%quot%5120%quot%,%quot%max_file_count%quot%:%quot%1%quot%,%quot%additional_rules%quot%:%quot%%quot%}',
                                    ],
                                ],
                                'params' => [
                                    'files' => '<var>category->mfiles</var>',
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
        ],
    ],
]

/*EDITOR*/





























        ]
    ];

}
}
