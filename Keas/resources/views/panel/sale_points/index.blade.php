@extends('ContentPanel::inc.module_main')
@section('content')
    @include('MPCorePanel::inc.breadcrumb')
    <div class="page-content p-0">
        @include("MPCorePanel::inc.errors")
        <div class="topPage">
            <div class="float-left">
                <div class="title m-0">{{$sitemap->detail->name}}</div>
            </div>
            <div class="float-right">
                <a href="{!! route('panel.sale_points.create') !!}" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> {!! trans("ContentPanel::sitemap.add_page") !!}</a>
                <a href="{!! route('panel.sale_points.export') !!}" class="btn btn-danger btn-sm ml-3"> <i class="fa fa-file-export"></i> Export</a>
                <a href="{!! route('panel.sale_points.import') !!}" class="btn btn-success btn-sm ml-3"> <i class="fa fa-file-import"></i> Import</a>
            </div>
        </div>
        <div class="p-30">
            <div class="table-field">
                {!! $dataTable->table() !!}
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function () {
            var query = parseQuery(window.location.search);
            if (query['category']) {
                $('#category option:selected').prop('selected', false);
                $('#category option[value=' + query['category'] + ']').prop('selected', true);
            }
        });

        $('#category').change(function () {
            let e = $(this);
            let url = window.location.protocol + '//' + window.location.hostname + window.location.pathname;

            if (e.val() !== 'all')
                url = `${url}?category=${e.val()}`;

            location.href = url;
        });

        function parseQuery(search) {
            var args = search.substring(1).split('&');
            var argsParsed = {};
            var i, arg, kvp, key, value;
            for (i = 0; i < args.length; i++) {
                arg = args[i];
                if (-1 === arg.indexOf('=')) {
                    argsParsed[decodeURIComponent(arg).trim()] = true;
                } else {
                    kvp = arg.split('=');
                    key = decodeURIComponent(kvp[0]).trim();
                    value = decodeURIComponent(kvp[1]).trim();
                    argsParsed[key] = value;
                }
            }

            return argsParsed;
        }
    </script>
@endpush
