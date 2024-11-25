<?php

namespace App\DataTable;

use App\CrmInfo;
use App\Weltew\Models\Campaign;
use Html;
use Mediapress\DataTable\DataTableInterface;
use Mediapress\Modules\MPCore\Models\Country;
use Mediapress\Modules\MPCore\Models\CountryGroup;
use Yajra\DataTables\Facades\DataTables;
use Yajra\Datatables\Html\Builder;


class CrmTracker implements DataTableInterface
{

    const DATA = 'data';
    const NAME = 'name';
    const TITLE = 'title';
    const FOOTER = 'footer';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function columns(Builder $builder)
    {
        $request = request();
        return $builder->parameters([
            "lengthMenu" => [25, 50, 75, 100],
            "pageLength" => session('pageLength.sitemaps.' . $request->segments()[count($request->segments()) - 1], 25)
        ])->columns([
            [
                self::DATA => 'sort',
                self::NAME => 'sort',
                self::TITLE =>  'ID',
                self::FOOTER => 'ID',
            ],
            [
                self::DATA => 'status',
                self::NAME => 'status',
                self::TITLE => 'Durum',
                self::FOOTER => 'Durum',
            ],
            [
                self::DATA => 'type',
                self::NAME => 'type',
                self::TITLE => 'Method',
                self::FOOTER => 'Method',
            ],
            [
                self::DATA => 'ip',
                self::NAME => 'ip',
                self::TITLE => 'IP',
                self::FOOTER => 'IP',
            ],
            [
                self::DATA => 'created_at',
                self::NAME => 'created_at',
                self::TITLE => 'Last Process Time',
                self::FOOTER => 'Last Process Time',
            ],

        ])->addAction([self::TITLE => 'Actions']);
    }

    public function ajax()
    {
        $request = request();
        $array = [];
        $url = parse_url($request->header('referer'));
        if (isset($url['query'])) {
            parse_str('&' . $url['query'], $array);
        }

        $trackers = CrmInfo::select("crm_info.id", "crm_info.type", "crm_info.status", "crm_info.ip", "crm_info.user_agent",
            self::CREATED_AT, self::UPDATED_AT)
            ->orderByDesc('created_at')
            ->distinct('crm_info.id');


        return Datatables::eloquent($trackers)
            ->addColumn('sort', function ($tracker) {
                return $tracker->id;
            })
            ->editColumn('status', function ($tracker) {
                switch ($tracker->status) {
                    case 0:
                        return '<span class="text-danger" title="Devre Dışı">Başarısız</span>';
                    case 1:
                        return '<span class="text-success" title="Aktif">Başarılı</span> ';

                }
            })
            ->addColumn('type', function ($tracker) {
                return $tracker->type;

            })
            ->editColumn('ip', function ($tracker) {
                return $tracker->ip;
            })
            ->editColumn('created_at', function ($tracker) {
                return $tracker->created_at;
            })
            ->addColumn('action', function ($tracker) {
                $showButton = '<a href="' . route('panel.crm.show', ['crm_info' => $tracker->id]) . '"  title="' . trans("ECommercePanel::general.show") . '" ><span class="fa fa-eye"></span></a>';
                return $showButton;
            })->rawColumns([
                "status", "action", "sort", 'type'
            ])
            ->setRowId('tbl-{{$id}}')->make(true);

    }
}
