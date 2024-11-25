@extends('ContentPanel::inc.module_main')
@push("styles")
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
    <link rel="stylesheet" href="{{asset("/vendor/mediapress/css/selector.css")}}"/>
    <link rel="stylesheet" href="{{asset("/vendor/mediapress/css/cropper.min.css")}}"/>
    <style>
        hr {
            display: inline-block;
            width: 100%;
        }
    </style>
@endpush
@section('content')
    <div class="breadcrumb">
        <div class="float-left">
            <ul>
                <li data-key="dashboard">
                    <a href="/mp-admin" title="Dashboard" class="text-truncate"><i class="fa fa-home"></i> Dashboard</a>
                </li>
                <li data-key="sitemap_main_edit">
                    <a href="#" title="Sale Points" class="text-truncate">
                        <i class="fa fa-sitemap"></i>Sale Points
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-content p-0">
        <div class="topPage">
            <div class="float-left">
                <div class="title m-0">Add New Sale Point</div>

            </div>
        </div>
        <div class="p-30">
            <div id="sitemap-ijhmSBnrDu">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{!! route('panel.sale_points.store') !!}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-lg-4 mt-3">
                            <label>Please Select Zone</label>
                            <select class="form-control" name="zone_id">
                                <option value="">Choose</option>
                                @foreach($zones as $zone)
                                <option value="{!! $zone->id !!}">{!! $zone->list_title !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label>Please Select Dealer Category</label>
                            <select class="form-control nice selectpicker" name="categories[]" multiple="multiple">
                                <option value="">Choose</option>
                                @foreach($categories as $category)
                                    <option value="{!! $category->id !!}">{!! $category->detail->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label>Please Select Dealer Type</label>
                            <select class="form-control nice selectpicker" name="types[]" multiple="multiple">
                                <option value="">Choose</option>
                                @foreach($types as $type)
                                    <option value="{!! $type->id !!}">{!! $type->detail->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3 mt-3">
                            <label>Dealer Name (EN)</label>
                            <input type="text" name="native_name" class="form-control" />
                        </div>
                        <div class="col-lg-3 mt-3">
                            <label>Dealer Name (Native)</label>
                            <input type="text" name="localized_name" class="form-control" />
                        </div>
                        <div class="col-lg-3 mt-3">
                            <label>City</label>
                            <select class="form-control" name="city">
                                <option value="">Choose</option>
                            </select>
                        </div>
                        <div class="col-lg-3 mt-3">
                            <label>Coordinates</label>
                            <input type="text" name="cords" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3 mt-3">
                            <label>Address (EN)</label>
                            <input type="text" name="native_address" class="form-control" />
                        </div>
                        <div class="col-lg-3 mt-3">
                            <label>Address (Native)</label>
                            <input type="text" name="localized_address" class="form-control" />
                        </div>
                        <div class="col-lg-3 mt-3">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" />
                        </div>
                        <div class="col-lg-3 mt-3">
                            <label>E-mail</label>
                            <input type="text" name="email" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3 mt-3">
                            <label>Website</label>
                            <input type="text" name="website" class="form-control" />
                        </div>
                        <div class="col-lg-3 mt-3">
                            <label>Country</label>
                            <select class="form-control" name="country">
                                <option value="">Choose</option>
                                @foreach(\DB::table('countries')->orderBy('en')->get() as $country)
                                    <option value="{{$country->id}}">{{$country->en}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="submit">
                        <button class="btn btn-primary" type="submit">{!! trans("MPCorePanel::general.save") !!}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('select[name="zone_id"]').on('change', function(){
            var val = $(this).val();
            if(val != 6){
                $('select[name="city"]').html("");
                $.ajax({
                    url:'{!! route('panel.sale_points.get_zones') !!}',
                    type:'GET',
                    data:{
                        zone_id:val
                    },
                    dataType:'json',
                    success:function(res){
                        for(var i = 0 ; i < res.length; i++){
                            $('select[name="city"]').append('<option value="'+res[i].value+'">'+res[i].name+'</option>');
                        }
                    }
                });
            }
        });
    </script>
@endpush

