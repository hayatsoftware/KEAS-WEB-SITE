<?php

namespace App\Http\Controllers\Panel;

use App\CrmInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTable\CrmTracker;
use Yajra\DataTables\Html\Builder;

class CrmController extends Controller
{
    public function index(CrmTracker $crmTracker, Builder $builder){

        $dataTable = $crmTracker->columns($builder)->ajax(route('panel.crm.ajax'));
        return view('panel.crmtracker.index', compact('dataTable'));
    }

    public function ajax()
    {
        return app('App\DataTable\\' . class_basename(CrmTracker::class))->ajax();
    }

    public function show(CrmInfo $crmInfo)
    {
        return view('panel.crmtracker.show', compact('crmInfo'));
    }
}
