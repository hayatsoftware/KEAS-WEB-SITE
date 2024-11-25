@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
    $categories =  $mediapress->data['categories'] ?? [];
    $dealer_types =  $mediapress->data['dealer_types'] ?? [];
    $countries = $mediapress->data['countries'] ?? [];
    $points = $mediapress->data['points'] ?? [];
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/sales-points.css') !!}">

    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('contact', 'Contact') !!}</a></li>
                    <li><a href="{!! $sitemap->detail->url !!}">{!! $sitemap->detail->name !!}</a></li>
                </ul>
            </div>
        </div>
        <article class="article">
            <div class="container-fluid">
                <div class="content">
                    <h1>{!! $sitemap->detail->name !!}</h1>
                    <div class="flex">
                        <div class="selects">
                            <select class="nice-select" name="category">
                                <option value="">{!! LangPart('choose_product_group', 'Please select product group') !!}</option>
                                @foreach($categories as $category)
                                    <option value="{!! $category->id !!}">{!! $category->detail->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="selects country_select">
                            <select data-placeholder="{!! strip_tags(LangPart('choose_country', 'Choose Country')) !!}" name="country" class="chosen-select" tabindex="2">
                                <option value=""></option>
                                @foreach( $countries as $country )
                                    @php
                                        if($mediapress->activeLanguage->code == 'tr'){
                                            $country_name = $country->tr;
                                        }else{
                                            if( $mediapress->activeLanguage->code == 'en' ){
                                                $country_name = $country->en;
                                            }else{
                                                $country_name = LangPart(\Str::slug($country->en), $country->en);
                                            }
                                        }
                                    @endphp
                                    <option value="{!! $country->id !!}">{!! $country_name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="selects country_select">
                            <select data-placeholder="{!! strip_tags(LangPart('choose_city', 'Choose City')) !!}" name="city" class="chosen-select" tabindex="2">
                                <option value=""></option>

                            </select>
                        </div>
                        <div class="selects">
                            <select class="nice-select" name="type">
                                <option value="">{!! LangPart('sale_point', 'Sale Point') !!}</option>
                                @foreach($dealer_types as $type)
                                    <option value="{!! $type->id !!}">{!! $type->detail->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="javascript:void(0)" class="clear">{!! LangPart('reset_filter', 'Filtre Temizle') !!}</a>
                        <div class="bayi_ara">
                            <label><input type="text" name="query" placeholder="{!! strip_tags(LangPart('search_supplier', 'Bayi Ara')) !!}"></label>
                            <button></button>
                        </div>

                        <a href="javascript:void(0)" class="clear_mobil">{!! LangPart('reset_filter', 'Filtre Temizle') !!}</a>
                    </div>
                    <div id="bayi-liste" class="bayi-liste" style="">
                        <ul class="select-content">

                        </ul>
                    </div>
                    <div id="satis-maps">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </article>
    </section>

@endsection
@push('scripts')
    <script src="{!! asset('frontend/assets/js/page.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/sales-points.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/mobileMap.js') !!}"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyAFbUB27CEbehFt6KmEMsXBULgjrpJLc_Q&language={!! $mediapress->activeLanguage->code !!}"></script>


    <script type="text/javascript">

        $('.clear').click(function() {
            location.reload();
        });
        $('input[name="query"]').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });
        var firstLoad = 1;
        $(document).ready(function(){
            getSalePoints();
            $('select[name="city"], select[name="category"], select[name="type"], select[name="country"]').on('change',function(){
                firstLoad = 0;
                $('input[name="query"]').val("");
                getSalePoints();
            });
            $('input[name="query"]').on('change', function(){
                firstLoad = 0;
                $('select[name="category"]').val("");
                $('select[name="type"]').val("");
                $('select[name="city"]').val("");
                $('input[name="query"]').keyup(function() {
                    $(this).val($(this).val().toUpperCase());
                });
                $('select').trigger("chosen:updated");
                getSalePoints();
            });
            $(document).on('click','#bayi-liste ul li b', function(){
                if ($(this).parent().hasClass('open')) {
                    $(this).next().slideUp();
                    $(this).parent().removeClass('open');
                    $(this).prev().removeClass('open');
                } else {
                    $('#bayi-liste ul li b').next().slideUp();
                    $('#bayi-liste ul li b').parent().removeClass('open');
                    $('#bayi-liste ul li b').prev().removeClass('open');
                    $(this).parent().addClass('open');
                    $(this).prev().addClass('open');
                    $(this).next().slideDown();
                }
            });
        });
        var map = new google.maps.Map(document.getElementById('map'), {
            center : {lat : 39.166, lng : 35.666},
            scrollwheel : true,
            zoom : 6,
            icon : '{!! asset('assets/img/path.svg') !!}',
            mapTypeId : google.maps.MapTypeId.ROADMAP,
            styles : [
                {
                    "featureType" : "water",
                    "elementType" : "geometry.fill",
                    "stylers" : [{"color" : "#d3d3d3"}]
                }, {
                    "featureType" : "transit",
                    "stylers" : [{"color" : "#808080"}, {"visibility" : "off"}]
                }, {
                    "featureType" : "road.highway",
                    "elementType" : "geometry.stroke",
                    "stylers" : [{"visibility" : "on"}, {"color" : "#b3b3b3"}]
                }, {
                    "featureType" : "road.highway",
                    "elementType" : "geometry.fill",
                    "stylers" : [{"color" : "#ffffff"}]
                }, {
                    "featureType" : "road.local",
                    "elementType" : "geometry.fill",
                    "stylers" : [{"visibility" : "on"}, {"color" : "#ffffff"}, {"weight" : 1.8}]
                }, {
                    "featureType" : "road.local",
                    "elementType" : "geometry.stroke",
                    "stylers" : [{"color" : "#d7d7d7"}]
                }, {
                    "featureType" : "poi",
                    "elementType" : "geometry.fill",
                    "stylers" : [{"visibility" : "on"}, {"color" : "#ebebeb"}]
                }, {
                    "featureType" : "administrative",
                    "elementType" : "geometry",
                    "stylers" : [{"color" : "#a7a7a7"}]
                }, {
                    "featureType" : "road.arterial",
                    "elementType" : "geometry.fill",
                    "stylers" : [{"color" : "#ffffff"}]
                }, {
                    "featureType" : "road.arterial",
                    "elementType" : "geometry.fill",
                    "stylers" : [{"color" : "#ffffff"}]
                }, {
                    "featureType" : "landscape",
                    "elementType" : "geometry.fill",
                    "stylers" : [{"visibility" : "on"}, {"color" : "#efefef"}]
                }, {
                    "featureType" : "road",
                    "elementType" : "labels.text.fill",
                    "stylers" : [{"color" : "#696969"}]
                }, {
                    "featureType" : "administrative",
                    "elementType" : "labels.text.fill",
                    "stylers" : [{"visibility" : "on"}, {"color" : "#737373"}]
                }, {
                    "featureType" : "poi",
                    "elementType" : "labels.icon",
                    "stylers" : [{"visibility" : "off"}]
                }, {
                    "featureType" : "poi",
                    "elementType" : "labels",
                    "stylers" : [{"visibility" : "off"}]
                }, {
                    "featureType" : "road.arterial",
                    "elementType" : "geometry.stroke",
                    "stylers" : [{"color" : "#d6d6d6"}]
                }, {
                    "featureType" : "road",
                    "elementType" : "labels.icon",
                    "stylers" : [{"visibility" : "off"}]
                }, {}, {"featureType" : "poi", "elementType" : "geometry.fill", "stylers" : [{"color" : "#dadada"}]}
            ]
        });
        var infowindow = new google.maps.InfoWindow();
        var bounds = new google.maps.LatLngBounds();
        var marker, i;
        var markers = [];


        function findMyLocation() {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent({});
                infoWindow.open(map);
                map.setCenter(pos);
                map.setZoom(7);
                showOnMap(pos.lat,pos.lng);

            });
        }

        function showOnMap(lat, long, index = null) {
            map.setCenter({lat: lat, lng: long});
            map.setZoom(15);

            if( index != null ) {
                google.maps.event.trigger(markers[index], 'click');

            }

            $("html, body").animate({scrollTop: 0}, "slow");

        }


        function getSalePoints(){
            var category = $('select[name="category"]').val();
            var type = $('select[name="type"]').val();
            var country = $('select[name="country"]').val();
            var city = $('select[name="city"]').val();
            var q = $('input[name="query"]').val();
            $.ajax({
                url:'{!! route('getSalePoints') !!}',
                method:'POST',
                data:{
                    country:country,
                    city:city,
                    category:category,
                    type:type,
                    q:q,
                    lg:'{!! $mediapress->activeLanguage->code !!}',
                    cg:'{!! $mediapress->activeCountryGroup->id !!}'
                },
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(res){
                    $('#bayi-liste > ul').html("");
                    $('#bayi-liste > span').remove();
                    for (let i = 0; i < markers.length; i++) {
                        if (markers[i]) {
                            markers[i].setMap(null);
                        }

                    }
                    if(res.status == 1){
                        markers = [];
                        $.each(res.points, function (key, value) {
                            if (value.lat && value.lng) {
                                marker = new google.maps.Marker({
                                    position: new google.maps.LatLng(value.lat, value.lng),
                                    map: map,
                                    visible: true, // or false. Whatever you need.
                                    icon: '{!! asset('assets/img/path.svg') !!}',
                                    zIndex: 10
                                });
                                bounds.extend(marker.position);
                                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                    return function() {
                                        if (map.getZoom() < 10)
                                        {
                                            map.setZoom(10);
                                            map.setCenter(marker.getPosition());
                                        }
                                        else if(map.getZoom() < 5)
                                        {
                                            map.setZoom(5);
                                            map.setCenter(marker.getPosition());

                                        }else{
                                            infowindow.setContent('<b>'+value.name+'</b> <br>'+value.address+' <br>'+value.phone);
                                            infowindow.open(map, marker);
                                        }

                                    }
                                })(marker, i));
                                markers[key] = marker;
                            }
                            map.fitBounds(bounds);
                        })
                        $('#bayi-liste > ul').html(res.render);
                        if(firstLoad != 1){
                            $('#satis-maps').addClass('right-width')
                            $('#bayi-liste').show();
                        }
                    }else{
                        $('#satis-maps').addClass('right-width')
                        $('#bayi-liste').append('<span>'+res.msg+'</span>');
                        $('#bayi-liste').show();
                    }

                }
            });

        }

        $('select[name="country"]').on('change', function(){
            let id = $(this).val();
            $('select[name="city"]').html("");
            $.ajax({
                url:"{{route('getCities')}}",
                type:'GET',
                data:{
                    country:id,
                    zone:'{{$mediapress->activeCountryGroup->id}}',
                    language:'{{$mediapress->activeLanguage->code}}'
                },
                dataType:'json',
                success:function(res){
                    $('select[name="city"]').append('<option value=""></option>');
                    for(var i = 0; i < res.length; i++){
                        $('select[name="city"]').append('<option value="'+res[i].slug+'">'+res[i].name+'</option>');
                    }
                    $('select').trigger("chosen:updated");
                }
            });
        });

    </script>
@endpush
