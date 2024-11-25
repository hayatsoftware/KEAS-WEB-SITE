@extends('ContentPanel::inc.module_main')
@section('content')
    <div class="breadcrumb">
        <div class="float-left">
            <ul>
                <li data-key="dashboard">
                    <a href="/mp-admin" title="Dashboard" class="text-truncate"><i class="fa fa-home"></i> Dashboard</a>
                </li>
                <li data-key="sitemap_main_edit">
                    <a href="javascript:void(0);" title="Crm Tracker" class="text-truncate">
                        <i class="fa fa-sitemap"></i>Crm Tracker
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-content">
        @include('MPCorePanel::inc.errors')
        <div class="row">
            <div class=" col-sm-6 float-left">
                <div class="title"> Tracker Listesi</div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="table-field mt-5 all-results">
            {!! $dataTable->table() !!}
        </div>
    </div>
@endsection
