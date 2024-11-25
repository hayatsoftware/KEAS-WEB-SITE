<?php

namespace App\Modules\Content\Website1\AllBuilder\Renderables\Product;


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
        'id' => '6385c8118a731',
        'contents' => [
            0 => [
                'type' => 'tab',
                'id' => '6385c8118a735',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '6385c8118a736',
                        'contents' => [
                            0 => [
                                'type' => 'inputwithlabel',
                                'id' => '6385c8118a737',
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
                                'id' => '60d8d16f734d0',
                                'options' => [
                                    'html' => [
                                        'tag' => 'input',
                                        'attributes' => [
                                            'class' => 'form-check-input',
                                            'name' => 'page-><print>page->id</print>->cint_4',
                                            'type' => 'checkbox',
                                            'value' => '0',
                                        ],
                                    ],
                                    'rules' => '',
                                    'value' => '<print>page->cint_4</print>',
                                ],
                                'data' => [
                                    'on_value' => '1',
                                    'on_text' => 'New Product',
                                    'off_value' => '0',
                                    'off_text' => '-',
                                ],
                            ],
                            2 => [
                                'type' => 'toggleswitch',
                                'id' => '60d8d16f734d0',
                                'options' => [
                                    'html' => [
                                        'tag' => 'input',
                                        'attributes' => [
                                            'class' => 'form-check-input',
                                            'name' => 'page-><print>page->id</print>->cvar_2',
                                            'type' => 'checkbox',
                                            'value' => '0',
                                        ],
                                    ],
                                    'rules' => '',
                                    'value' => '<print>page->cvar_2</print>',
                                ],
                                'data' => [
                                    'on_value' => '1',
                                    'on_text' => 'Enable Coming Soon',
                                    'off_value' => '0',
                                    'off_text' => '-',
                                ],
                            ],
                            3 => [
                                'type' => 'pagecategoriescontrol',
                                'options' => [
                                    'html' => [
                                        'tag' => 'select',
                                        'attributes' => [
                                            'class' => 'multiple categorySelect',
                                            'name' => 'page-><print>page->id</print>->sync:categories[]',
                                            'multiple' => 'multiple',
                                        ],
                                    ],
                                    'rules' => '',
                                    'title' => 'Select Categories',
                                    'multiple' => '1',
                                    'show_default_option' => '0',
                                    'default_value' => 'Choose a category',
                                    'default_text' => '---Choose---',
                                ],
                                'params' => [
                                    'page_model' => '<var>page</var>',
                                ],
                                'data' => [
                                    'stacks' => [
                                        'scripts' => '<script>
                                                $(".categorySelect").on("change", function(){
                                                  $(".dependsOnCategory").addClass("d-none");
                                                  let val = $(this).val();
                                                  if(val != null){
                                                      $.ajax({
                                                        url:"/mp-admin/CategoryInfo",
                                                        type:"GET",
                                                        data:{
                                                            category_id:val
                                                        },
                                                        dataType:"json",
                                                        success:function(res){
                                                            $(".decorative_panel_accordion select").each(function(){
                                                                $(this).attr("disabled", true);
                                                            });
                                                            $(".door_panel_accordion select").each(function(){
                                                               $(this).attr("disabled", true);
                                                            });
                                                            $(".worktop_accordion select").each(function(){
                                                                $(this).attr("disabled", true);
                                                            });
                                                            $(".parke_accordion select").each(function(){
                                                                $(this).attr("disabled", true);
                                                            });
                                                            if(res.id.includes(5) || res.parents.includes(5) ){
                                                                $(".decorative_panel_accordion").removeClass("d-none");
                                                                $(".decorative_panel_accordion select").each(function(){
                                                                    $(this).attr("disabled", false);
                                                                });
                                                            }
                                                            if(res.id.includes(11) || res.parents.includes(11) ){
                                                              $(".door_panel_accordion").removeClass("d-none");
                                                              $(".door_panel_accordion select").each(function(){
                                                                   $(this).attr("disabled", false);
                                                                });
                                                            }
                                                            if(res.id.includes(14) || res.parents.includes(14) ){
                                                              $(".worktop_accordion").removeClass("d-none");
                                                              $(".worktop_accordion select").each(function(){
                                                                    $(this).attr("disabled", false);
                                                                });
                                                            }
                                                            if(res.id.includes(2) || res.parents.includes(2)){
                                                              $(".mdf_accordion").removeClass("d-none");
                                                            }
                                                            if(res.id.includes(16) || res.parents.includes(16) || res.id.includes(41) || res.parents.includes(41) || res.id.includes(60) || res.parents.includes(60) || res.id.includes(64) || res.parents.includes(64) || res.id.includes(72) || res.parents.includes(72)){
                                                             $(".parke_accordion").removeClass("d-none");
                                                             $(".parke_accordion select").each(function(){
                                                                    $(this).attr("disabled", false);
                                                                });
                                                            }
                                                        }
                                                      });

                                                  }
                                                });

</script>'
                                    ]
                                ]
                            ],
                            4 => [
                                'type' => 'accordion',
                                'id' => '638528118a74b',
                                'contents' => [
                                    0 => [
                                        'type' => 'accordionpane',
                                        'id' => '6385a8118a24c',
                                        'contents' => [
                                            0 => [
                                                'type' => 'selectwithlabel',
                                                'id' => '6325bfc38a74d',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'select',
                                                        'attributes' => [
                                                            'class' => 'nice selectpicker',
                                                            'name' => 'page-><print>page->id</print>->extras->surface[]',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                    'title' => 'Surfaces',
                                                    'multiple' => '1',
                                                    'value' => '<var>page->surface</var>',
                                                    'show_default_option' => '0',
                                                    'additional_content' => 'merge',
                                                    'default_value' => '',
                                                    'default_text' => '---Choose---',
                                                ],
                                                'data' => [
                                                    'values' => [
                                                        'type' => 'ds:Content->ParkeSurfaces',
                                                    ],
                                                ],
                                            ],
                                            1 => [
                                                'type' => 'selectwithlabel',
                                                'id' => '6325bsc38a74d',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'select',
                                                        'attributes' => [
                                                            'class' => 'nice selectpicker',
                                                            'name' => 'page-><print>page->id</print>->extras->bevel[]',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                    'title' => 'Bevels',
                                                    'multiple' => '1',
                                                    'value' => '<var>page->bevel</var>',
                                                    'show_default_option' => '0',
                                                    'additional_content' => 'merge',
                                                    'default_value' => '',
                                                    'default_text' => '---Choose---',
                                                ],
                                                'data' => [
                                                    'values' => [
                                                        'type' => 'ds:Content->ParkeBevels',
                                                    ],
                                                ],
                                            ],
                                            2 => [
                                                'type' => 'selectwithlabel',
                                                'id' => '6a25bsc38s74d',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'select',
                                                        'attributes' => [
                                                            'class' => 'nice selectpicker',
                                                            'name' => 'page-><print>page->id</print>->extras->class[]',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                    'title' => 'Class',
                                                    'multiple' => '1',
                                                    'value' => '<var>page->class</var>',
                                                    'show_default_option' => '0',
                                                    'additional_content' => 'merge',
                                                    'default_value' => '',
                                                    'default_text' => '---Choose---',
                                                ],
                                                'data' => [
                                                    'values' => [
                                                        'type' => 'ds:Content->ParkeClasses',
                                                    ],
                                                ],
                                            ],
                                            3 => [
                                                'type' => 'selectwithlabel',
                                                'id' => '6a25bfc38s74d',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'select',
                                                        'attributes' => [
                                                            'class' => 'nice selectpicker',
                                                            'name' => 'page-><print>page->id</print>->extras->decor[]',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                    'title' => 'Decors',
                                                    'multiple' => '1',
                                                    'value' => '<var>page->decor</var>',
                                                    'show_default_option' => '0',
                                                    'additional_content' => 'merge',
                                                    'default_value' => '',
                                                    'default_text' => '---Choose---',
                                                ],
                                                'data' => [
                                                    'values' => [
                                                        'type' => 'ds:Content->ParkeDecors',
                                                    ],
                                                ],
                                            ],
                                            4 => [
                                                'type' => 'selectwithlabel',
                                                'id' => '6a25wfc38s74a',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'select',
                                                        'attributes' => [
                                                            'class' => 'nice selectpicker',
                                                            'name' => 'page-><print>page->id</print>->extras->lock[]',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                    'title' => 'Locks',
                                                    'multiple' => '1',
                                                    'value' => '<var>page->lock</var>',
                                                    'show_default_option' => '0',
                                                    'additional_content' => 'merge',
                                                    'default_value' => '',
                                                    'default_text' => '---Choose---',
                                                ],
                                                'data' => [
                                                    'values' => [
                                                        'type' => 'ds:Content->ParkeLocks',
                                                    ],
                                                ],
                                            ],
                                            5 => [
                                                'type' => 'selectwithlabel',
                                                'id' => '6a12wgc38s74a',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'select',
                                                        'attributes' => [
                                                            'class' => 'nice selectpicker',
                                                            'name' => 'page-><print>page->id</print>->extras->thickness[]',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                    'title' => 'Thicknesses',
                                                    'multiple' => '1',
                                                    'value' => '<var>page->thickness</var>',
                                                    'show_default_option' => '0',
                                                    'additional_content' => 'merge',
                                                    'default_value' => '',
                                                    'default_text' => '---Choose---',
                                                ],
                                                'data' => [
                                                    'values' => [
                                                        'type' => 'ds:Content->Thicknesses',
                                                    ],
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
                                            'title' => 'Parke Settings',
                                            'initial_status' => 'closed',
                                        ],
                                    ],
                                ],
                                'options' => [
                                    'html' => [
                                        'tag' => 'div',
                                        'attributes' => [
                                            'class' => 'accordion row dependsOnCategory parke_accordion',
                                            'name' => 'Parke Settings',
                                        ],
                                    ],
                                    'rules' => '',
                                ],
                            ],
                            5 => [
                                'type' => 'selectwithlabel',
                                'id' => '6385c811sa757',
                                'options' => [
                                    'html' => [
                                        'tag' => 'select',
                                        'attributes' => [
                                            'class' => 'nice selectpicker dependsOnCategory door_panel_accordion worktop_accordion',
                                            'name' => 'page-><print>page->id</print>->cint_1',
                                        ],
                                    ],
                                    'rules' => '',
                                    'title' => 'Brand',
                                    'multiple' => '0',
                                    'value' => '<print>page->cint_1</print>',
                                    'show_default_option' => '0',
                                    'additional_content' => 'merge',
                                    'default_value' => '',
                                    'default_text' => '---Choose---',
                                ],
                                'data' => [
                                    'values' => [
                                        'type' => 'ds:Content->Brand',
                                    ],
                                ],
                            ],
                            6 => [
                                'type' => 'inputwithlabel',
                                'options' => [
                                    'html' => [
                                        'tag' => 'input',
                                        'attributes' => [
                                            'class' => '',
                                            'name' => 'page-><print>page->id</print>->cint_3',
                                            'type' => 'text',
                                            'value' => '<print>page->cint_3</print>',
                                        ],
                                    ],
                                    'rules' => '',
                                    'title' => 'Decor Code',
                                ],
                            ],
                            7 => [
                                'type' => 'toggleswitch',
                                'id' => '60d8d162134d0',
                                'options' => [
                                    'html' => [
                                        'tag' => 'input',
                                        'attributes' => [
                                            'class' => 'form-check-input',
                                            'name' => 'page-><print>page->id</print>->cint_5',
                                            'type' => 'checkbox',
                                            'value' => '0',
                                        ],
                                    ],
                                    'rules' => '',
                                    'value' => '<print>page->cint_5</print>',
                                ],
                                'data' => [
                                    'on_value' => '1',
                                    'on_text' => 'Hide Buttons',
                                    'off_value' => '0',
                                    'off_text' => '-',
                                ],
                            ],
                            8 => [
                                'type' => 'detailtabs',
                                'id' => '6385c8118a740',
                                'contents' => [
                                    0 => [
                                        'type' => 'tab',
                                        'id' => '6385c8118a742',
                                        'contents' => [
                                            0 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '6385c8118a743',
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
                                                'id' => '6385c8118a747',
                                                'options' => [
                                                    'initial_mode' => 'waiting',
                                                ],
                                                'params' => [
                                                    'detail' => '<var>detail</var>',
                                                ],
                                            ],
                                            2 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '6385c8118a743',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'input',
                                                        'attributes' => [
                                                            'class' => '',
                                                            'name' => 'detail->extras->threedparams',
                                                            'type' => 'text',
                                                            'value' => '<print>detail->threedparams</print>',
                                                        ],
                                                    ],
                                                    'title' => '3D Extra Field',
                                                    'rules' => '',
                                                ],
                                            ],
                                            3 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '6385c8118b743',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'input',
                                                        'attributes' => [
                                                            'class' => '',
                                                            'name' => 'detail->extras->length',
                                                            'type' => 'text',
                                                            'value' => '<print>detail->length</print>',
                                                        ],
                                                    ],
                                                    'title' => 'Length',
                                                    'rules' => '',
                                                ],
                                            ],
                                            4 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '6382c8118b741',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'input',
                                                        'attributes' => [
                                                            'class' => '',
                                                            'name' => 'detail->extras->material',
                                                            'type' => 'text',
                                                            'value' => '<print>detail->material</print>',
                                                        ],
                                                    ],
                                                    'title' => 'Material',
                                                    'rules' => '',
                                                ],
                                            ],
                                            5 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '6292c8118b741',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'input',
                                                        'attributes' => [
                                                            'class' => '',
                                                            'name' => 'detail->extras->edge_band',
                                                            'type' => 'text',
                                                            'value' => '<print>detail->edge_band</print>',
                                                        ],
                                                    ],
                                                    'title' => 'Edge Band',
                                                    'rules' => '',
                                                ],
                                            ],
                                            6 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '6292c8118b741',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'input',
                                                        'attributes' => [
                                                            'class' => '',
                                                            'name' => 'detail->extras->edge_band_url',
                                                            'type' => 'text',
                                                            'value' => '<print>detail->edge_band_url</print>',
                                                        ],
                                                    ],
                                                    'title' => 'Edge Band URL',
                                                    'rules' => '',
                                                ],
                                            ],
                                            7 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '6212c1118b741',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'input',
                                                        'attributes' => [
                                                            'class' => '',
                                                            'name' => 'detail->extras->compatible_panel',
                                                            'type' => 'text',
                                                            'value' => '<print>detail->compatible_panel</print>',
                                                        ],
                                                    ],
                                                    'title' => 'Compatible Panel',
                                                    'rules' => '',
                                                ],
                                            ],
                                            8 => [
                                                'type' => 'inputwithlabel',
                                                'id' => '6212c1118b741',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'input',
                                                        'attributes' => [
                                                            'class' => '',
                                                            'name' => 'detail->extras->compatible_panel_url',
                                                            'type' => 'text',
                                                            'value' => '<print>detail->compatible_panel_url</print>',
                                                        ],
                                                    ],
                                                    'title' => 'Compatible Panel URL',
                                                    'rules' => '',
                                                ],
                                            ],
                                            9 => [
                                                'type' => 'accordion',
                                                'id' => '6385c8118a74b',
                                                'contents' => [
                                                    0 => [
                                                        'type' => 'accordionpane',
                                                        'id' => '6385c8118a74c',
                                                        'contents' => [
                                                            0 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6385c8118a74d',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->decor[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Decors',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->decor</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->DecorativePanelDecors',
                                                                    ],
                                                                ],
                                                            ],
                                                            1 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6385c8118a753',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->surface[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Surfaces',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->surface</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->DecorativePanelSurfaces',
                                                                    ],
                                                                ],
                                                            ],
                                                            2 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6385c8118a757',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->brand[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Brand',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->brand</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->Brand',
                                                                    ],
                                                                ],
                                                            ],
                                                            3 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6385c8118a75c',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->extra_feature[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Extra Features',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->extra_feature</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->DecorativePanelExtraFeatures',
                                                                    ],
                                                                ],
                                                            ],
                                                            4 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6385c8118a761',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->features[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Features',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->features</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->DecorativePanelFeatures',
                                                                    ],
                                                                ],
                                                            ],
                                                            5 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6385c8118a765',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->certificate[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Certificates',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->certificate</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->DecorativePanelCertificate',
                                                                    ],
                                                                ],
                                                            ],
                                                            6 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6a22wgc38s74a',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->dimension[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Dimensions',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->dimension</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->Dimensions',
                                                                    ],
                                                                ],
                                                            ],
                                                            7 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6a22wgc38s74a',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->thickness[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Thicknesses',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->thickness</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->Thicknesses',
                                                                    ],
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
                                                            'title' => 'Decorative Panel Settings',
                                                            'initial_status' => 'closed',
                                                        ],
                                                    ],
                                                ],
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'div',
                                                        'attributes' => [
                                                            'class' => 'accordion row dependsOnCategory decorative_panel_accordion',
                                                            'name' => 'Decorative Panel Settings',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                ],
                                            ],
                                            10 => [
                                                'type' => 'accordion',
                                                'id' => '6385c8118a74b',
                                                'contents' => [
                                                    0 => [
                                                        'type' => 'accordionpane',
                                                        'id' => '6385c8118a24c',
                                                        'contents' => [
                                                            0 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6385c8118a74d',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->surface[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Surfaces',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->surface</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->DoorPanelSurfaces',
                                                                    ],
                                                                ],
                                                            ],
                                                            1 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6312c8118a74d',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->extra_feature[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Extra Features',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->extra_feature</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->DoorPanelExtraFeatures',
                                                                    ],
                                                                ],
                                                            ],
                                                            2 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '63b2c8121a74d',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->feature[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Features',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->feature</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->DoorPanelFeatures',
                                                                    ],
                                                                ],
                                                            ],
                                                            3 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '63b2c8121b24d',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->certificate[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Certificates',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->certificate</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->DoorPanelCertificates',
                                                                    ],
                                                                ],
                                                            ],
                                                            4 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '63b2c8vf1b24d',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->texture[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Textures',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->texture</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->DoorPanelTextures',
                                                                    ],
                                                                ],
                                                            ],
                                                            5 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6a22wgc38s74a',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->dimension[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Dimensions',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->dimension</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->Dimensions',
                                                                    ],
                                                                ],
                                                            ],
                                                            6 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6a22wgc38s74a',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->thickness[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Thicknesses',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->thickness</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->Thicknesses',
                                                                    ],
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
                                                            'title' => 'Door Panel Settings',
                                                            'initial_status' => 'closed',
                                                        ],
                                                    ],
                                                ],
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'div',
                                                        'attributes' => [
                                                            'class' => 'accordion row dependsOnCategory door_panel_accordion',
                                                            'name' => 'Door Panel Settings',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                ],
                                            ],
                                            11 => [
                                                'type' => 'accordion',
                                                'id' => '6385c8118a74b',
                                                'contents' => [
                                                    0 => [
                                                        'type' => 'accordionpane',
                                                        'id' => '6385c8118a24c',
                                                        'contents' => [
                                                            0 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6385bf238a74d',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->surface[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Surfaces',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->surface</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->WorkTopSurfaces',
                                                                    ],
                                                                ],
                                                            ],
                                                            1 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6385bf238a79d',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->decor[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Decors',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->decor</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->WorkTopDecors',
                                                                    ],
                                                                ],
                                                            ],
                                                            2 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6382bf238a79d',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->extra_feature[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Extra Features',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->extra_feature</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->WorkTopExtraFeatures',
                                                                    ],
                                                                ],
                                                            ],
                                                            3 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6312bf278a79d',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->features[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Features',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->features</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->WorkTopFeatures',
                                                                    ],
                                                                ],
                                                            ],
                                                            4 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6312cf278a7ad',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->certificate[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Certificates',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->certificate</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->WorkTopCertificates',
                                                                    ],
                                                                ],
                                                            ],
                                                            5 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6a22wgc38s74a',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->dimension[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Dimensions',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->dimension</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->Dimensions',
                                                                    ],
                                                                ],
                                                            ],
                                                            6 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6a22wgc38s74a',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->thickness[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Thicknesses',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->thickness</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->Thicknesses',
                                                                    ],
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
                                                            'title' => 'Worktop Settings',
                                                            'initial_status' => 'closed',
                                                        ],
                                                    ],
                                                ],
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'div',
                                                        'attributes' => [
                                                            'class' => 'accordion row dependsOnCategory worktop_accordion',
                                                            'name' => 'Worktop Settings',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                ],
                                            ],
                                            12 => [
                                                'type' => 'accordion',
                                                'id' => '6385c8118a74b',
                                                'contents' => [
                                                    0 => [
                                                        'type' => 'accordionpane',
                                                        'id' => '6385c8718a24c',
                                                        'contents' => [
                                                            0 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6385bf238a74d',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->extra_feature[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Surfaces',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->extra_feature</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->MdfExtraFeatures',
                                                                    ],
                                                                ],
                                                            ]
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
                                                            'title' => 'MDF Yonga Settings',
                                                            'initial_status' => 'closed',
                                                        ],
                                                    ],
                                                ],
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'div',
                                                        'attributes' => [
                                                            'class' => 'accordion row dependsOnCategory mdf_accordion',
                                                            'name' => 'MDF Yonga Settings',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                ],
                                            ],
                                            13 => [
                                                'type' => 'accordion',
                                                'id' => '6215c8118a74b',
                                                'contents' => [
                                                    0 => [
                                                        'type' => 'accordionpane',
                                                        'id' => '6385c8718a24c',
                                                        'contents' => [
                                                            0 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6385bf238a74d',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->feature[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Features',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->feature</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->ParkeFeatures',
                                                                    ],
                                                                ],
                                                            ],
                                                            1 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '6382bf228a24d',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->certificate[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Certificates',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->certificate</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->ParkeCertificate',
                                                                    ],
                                                                ],
                                                            ],
                                                            2 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '61e2ba218a24d',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->dimension[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Dimensions',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->dimension</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->Dimensions',
                                                                    ],
                                                                ],
                                                            ],
                                                            3 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '63e2ba228a24d',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->weight[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Weights',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->weight</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->Weights',
                                                                    ],
                                                                ],
                                                            ],
                                                            4 => [
                                                                'type' => 'inputwithlabel',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'input',
                                                                        'attributes' => [
                                                                            'class' => '',
                                                                            'name' => 'detail->extras->quantity',
                                                                            'type' => 'text',
                                                                            'value' => '<print>detail->quantity</print>',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Quantity In Package',
                                                                ],
                                                            ],
                                                            5 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '63s2bb228a24d',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->area[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Areas',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->area</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->Areas',
                                                                    ],
                                                                ],
                                                            ],
                                                            6 => [
                                                                'type' => 'selectwithlabel',
                                                                'id' => '63s2bb228a24d',
                                                                'options' => [
                                                                    'html' => [
                                                                        'tag' => 'select',
                                                                        'attributes' => [
                                                                            'class' => 'nice selectpicker',
                                                                            'name' => 'detail->extras->water[]',
                                                                        ],
                                                                    ],
                                                                    'rules' => '',
                                                                    'title' => 'Water Resistance',
                                                                    'multiple' => '1',
                                                                    'value' => '<var>detail->water</var>',
                                                                    'show_default_option' => '0',
                                                                    'additional_content' => 'merge',
                                                                    'default_value' => '',
                                                                    'default_text' => '---Choose---',
                                                                ],
                                                                'data' => [
                                                                    'values' => [
                                                                        'type' => 'ds:Content->WaterResistance',
                                                                    ],
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
                                                            'title' => 'Parke Settings',
                                                            'initial_status' => 'closed',
                                                        ],
                                                    ],
                                                ],
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'div',
                                                        'attributes' => [
                                                            'class' => 'accordion row dependsOnCategory parke_accordion',
                                                            'name' => 'Parke Settings',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                ],
                                            ],
                                            14 => [
                                                'type' => 'ckeditor',
                                                'id' => '6385c8118a76e',
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
                                            15 => [
                                                'type' => 'ckeditor',
                                                'id' => '63838c105ae99',
                                                'options' => [
                                                    'html' => [
                                                        'tag' => 'textarea',
                                                        'attributes' => [
                                                            'class' => 'form-control ckeditor',
                                                            'name' => 'detail->extras->usage_area',
                                                        ],
                                                    ],
                                                    'rules' => '',
                                                    'title' => 'Usage Area',
                                                    'value' => '   <print>detail->usage_area</print> ',
                                                ],
                                            ],
                                            16 => [
                                                'type' => 'clearfix',
                                                'id' => '6385c8118a772',
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
                'id' => '6385c8118a77e',
                'contents' => [
                    0 => [
                        'type' => 'mpfile',
                        'id' => '6385c8118a77f',
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
                                'cover' => '{%quot%key%quot%:%quot%cover%quot%,%quot%file_type%quot%:%quot%image%quot%,%quot%required%quot%:%quot%required%quot%,%quot%title%quot%:%quot%Decor Image%quot%,%quot%allow_actions%quot%:[%quot%select%quot%,%quot%upload%quot%],%quot%allow_diskkeys%quot%:[%quot%azure%quot%,%quot%local%quot%],%quot%extensions%quot%:%quot%JPG,JPEG,PNG,GIF,SVG%quot%,%quot%min_width%quot%:%quot%%quot%,%quot%max_width%quot%:%quot%%quot%,%quot%min_height%quot%:%quot%%quot%,%quot%max_height%quot%:%quot%%quot%,%quot%width%quot%:%quot%%quot%,%quot%height%quot%:%quot%%quot%,%quot%min_filesize%quot%:%quot%%quot%,%quot%max_filesize%quot%:%quot%5120%quot%,%quot%max_file_count%quot%:%quot%1%quot%,%quot%additional_rules%quot%:%quot%%quot%}',
                                'interior' => '{%quot%key%quot%:%quot%cover%quot%,%quot%file_type%quot%:%quot%image%quot%,%quot%required%quot%:%quot%required%quot%,%quot%title%quot%:%quot%Interior Image%quot%,%quot%allow_actions%quot%:[%quot%select%quot%,%quot%upload%quot%],%quot%allow_diskkeys%quot%:[%quot%azure%quot%,%quot%local%quot%],%quot%extensions%quot%:%quot%JPG,JPEG,PNG,GIF,SVG%quot%,%quot%min_width%quot%:%quot%%quot%,%quot%max_width%quot%:%quot%%quot%,%quot%min_height%quot%:%quot%%quot%,%quot%max_height%quot%:%quot%%quot%,%quot%width%quot%:%quot%%quot%,%quot%height%quot%:%quot%%quot%,%quot%min_filesize%quot%:%quot%%quot%,%quot%max_filesize%quot%:%quot%5120%quot%,%quot%max_file_count%quot%:%quot%1%quot%,%quot%additional_rules%quot%:%quot%%quot%}',
                            ],
                        ],
                        'params' => [
                            'files' => '<var>page->mfiles</var>',
                        ],
                    ],
                    1 => [
                        'type' => 'detailtabs',
                        'id' => '6385c8118a784',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '6385c8118a786',
                                'contents' => [
                                    0 => [
                                        'type' => 'mpfile',
                                        'id' => '6385c8118a787',
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
                                                'gallery' => '{%quot%key%quot%:%quot%cover%quot%,%quot%file_type%quot%:%quot%image%quot%,%quot%required%quot%:%quot%required%quot%,%quot%title%quot%:%quot%Foto Galeri%quot%,%quot%allow_actions%quot%:[%quot%select%quot%,%quot%upload%quot%],%quot%allow_diskkeys%quot%:[%quot%azure%quot%,%quot%local%quot%],%quot%extensions%quot%:%quot%JPG,JPEG,PNG,GIF,SVG%quot%,%quot%min_width%quot%:%quot%%quot%,%quot%max_width%quot%:%quot%%quot%,%quot%min_height%quot%:%quot%%quot%,%quot%max_height%quot%:%quot%%quot%,%quot%width%quot%:%quot%%quot%,%quot%height%quot%:%quot%%quot%,%quot%min_filesize%quot%:%quot%%quot%,%quot%max_filesize%quot%:%quot%5120%quot%,%quot%max_file_count%quot%:%quot%50%quot%,%quot%additional_rules%quot%:%quot%%quot%}',
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
                'id' => '6385c8118a793',
                'contents' => [
                    0 => [
                        'type' => 'detailtabs',
                        'id' => '6385c8118a794',
                        'contents' => [
                            0 => [
                                'type' => 'tab',
                                'id' => '6385c8118a795',
                                'contents' => [
                                    0 => [
                                        'type' => 'textareawithlabel',
                                        'id' => '6385c8118a796',
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
                                        'id' => '6385c8118a79b',
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
                'id' => '6385c8118a7a5',
                'contents' => [
                    0 => [
                        'type' => 'div',
                        'id' => '6385c8118a7a6',
                        'contents' => [
                            0 => [
                                'type' => 'contentprotectioncontrol',
                                'id' => '6385c8118a7a7',
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
                                'id' => '6385c8118a7ab',
                                'contents' => [
                                    0 => [
                                        'type' => 'pagestatuscontrol',
                                        'id' => '6385c8118a7ac',
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
