@extends('ContentPanel::inc.module_main')
@section('content')
    @include('MPCorePanel::inc.breadcrumb')
    <div class="page-content p-0">
        @include("MPCorePanel::inc.errors")
        <div class="topPage">
            <div class="float-left">
                <div class="title m-0">Zone Options</div>
            </div>
        </div>
        <div class="p-30">
            <div class="table-field">
                <table class="table dataTable no-footer" id="dataTableBuilder" role="grid" aria-describedby="dataTableBuilder_info" style="width: 1127px;">
                    <thead>
                    <tr role="row">
                        <th>Code</th>
                        <th>Zone Name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($country_groups as $country_group)
                        <tr>
                            <td>{{$country_group->code}}</td>
                            <td>{{$country_group->list_title}}</td>
                            <td>
                                <a href="{{route('panel.city.index', ['country_group_code'=>$country_group->code])}}" title="Open Cities of Country"><span class="fa fa-plus"></span></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
