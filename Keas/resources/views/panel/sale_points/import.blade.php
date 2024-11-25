@extends('ContentPanel::inc.module_main')
@section('content')
    @include('MPCorePanel::inc.breadcrumb')
    <div class="page-content p-0">
        @if(session('status'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        @include("MPCorePanel::inc.errors")
        <div class="topPage">
            <div class="float-left">
                <div class="title m-0">{{$sitemap->detail->name}}</div>
            </div>
            <div class="float-right">

                <a href="{!! route('panel.sale_points.create') !!}" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> {!! trans("ContentPanel::sitemap.add_page") !!}</a>
                <a href="{!! route('panel.sale_points.export') !!}" class="btn btn-danger btn-sm ml-3"> <i class="fa fa-file-export"></i> Export</a>
                <a href="{!! route('panel.sale_points.index') !!}" class="btn btn-success btn-sm ml-3"> <i class="fa fa-map-pin"></i> Sale Points</a>
            </div>
        </div>
        <div class="p-30">
            <div class="table-field">
                <form action="{{route('panel.sale_points.import.post')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Select File</label>
                            <input type="file" name="sale_points" class="form-conrol" />
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-success">Import File</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
