@extends('ContentPanel::inc.module_main')
@section('content')
    @include('MPCorePanel::inc.breadcrumb')
    <div class="page-content p-0">
        @include("MPCorePanel::inc.errors")
        <div class="topPage">
            <div class="float-left">
                <div class="title m-0">Cities {{$country_group->list_title}}</div>
            </div>
            <div class="float-right">
                <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus"></i> Add New City</a>
            </div>
        </div>
        <div class="p-30">
            <div class="table-field">
                <table class="table dataTable no-footer" id="dataTableBuilder" role="grid" aria-describedby="dataTableBuilder_info" style="width: 1127px;">
                    <thead>
                    <tr role="row">
                        <th>City Name</th>
                        <th>City Name (EN)</th>
                        <th>Country Code</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cities as $city)
                        <tr>
                            <td>{{$city['native']}}</td>
                            <td>{{$city['en']}}</td>
                            <td>{{mb_strtoupper($city['country_group'])}}</td>
                            <td>{{$city['slug']}}</td>
                            <td>
                                <a href="{{route('panel.city.edit', ['country_group_code'=>$city['country_group'], 'slug'=>$city->slug])}}" title="Düzenle"><span class="fa fa-edit"></span></a>
                                <a href="{{route('panel.city.delete', ['id'=>$city['id']])}}" class="needs-confirmation" title="Sil"><span class="fa fa-trash"></span></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New City</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{Route('panel.city.store', ['country_group_code'=>$country_group_code])}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-12 mt-3">
                                <label>City (Native Name)</label>
                                <input type="text" name="city[native]" class="form-control" />
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label>City (English Name)</label>
                                <input type="text" name="city[en]" class="form-control" />
                            </div>
                            <div class="col-lg-12 mt-3">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection
