@extends('ContentPanel::inc.module_main')
@section('content')
    <div class="breadcrumb">
        <div class="float-left">
            <ul>
                <li data-key="dashboard">
                    <a href="/mp-admin" title="Dashboard" class="text-truncate"><i class="fa fa-home"></i> Dashboard</a>
                </li>
                <li data-key="sitemap_main_edit">
                    <a href="{!! Route('panel.crm.index') !!}" title="Crm Tracker" class="text-truncate">
                        <i class="fa fa-sitemap"></i>Tracker
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <h4 style="font-size:15px;">Crm Method:</h4>
                <p>{!! $crmInfo->type !!}</p>
            </div>
            <div class="col-lg-12">
                <h4 style="font-size:15px;">Status:</h4>
                <p>{!! $crmInfo->status == 1 ? 'Başarılı':'Başarısız' !!}</p>
            </div>
            <div class="col-lg-12">
                <h4 style="font-size:15px;">IP:</h4>
                <p>{!! $crmInfo->ip !!}</p>
            </div>
            <div class="col-lg-12">
                <h4 style="font-size:15px;">User Agent:</h4>
                <p>{!! $crmInfo->user_agent !!}</p>
            </div>
            <div class="col-lg-12">
                <h4 style="font-size:15px;">Request:</h4>
                <p>{!! json_encode($crmInfo->request, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</p>
            </div>
            <div class="col-lg-12">
                <h4 style="font-size:15px;">Response:</h4>
                <p>{!! json_encode($crmInfo->response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</p>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection

