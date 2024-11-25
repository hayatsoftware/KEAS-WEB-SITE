@extends('ContentPanel::inc.module_main')
@section('content')
    @include('MPCorePanel::inc.breadcrumb')
    <div class="page-content p-0">
        @include("MPCorePanel::inc.errors")
        <div class="topPage">
            <div class="float-left">
                <div class="title m-0">Edit City {{$city->en}}</div>
            </div>
            <div class="float-right">
                <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus"></i> Edit City</a>
            </div>
        </div>
        <div class="p-30">
            <form action="{{Route('panel.city.update')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-lg-12 mt-3">
                        <label>City (Native Name)</label>
                        <input type="text" name="city[native]" class="form-control" value="{{$city->native}}" />
                    </div>
                    <div class="col-lg-12 mt-3">
                        <label>City (English Name)</label>
                        <input type="text" name="city[en]" class="form-control" value="{{$city->en}}"/>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <input type="hidden" name="city_id" class="form-control" value="{{$city->id}}"/>
                        <input type="hidden" name="country_group" class="form-control" value="{{$country_group->code}}"/>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
