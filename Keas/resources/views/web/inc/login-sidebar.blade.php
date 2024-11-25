<div class="login_sidebar">
    <div class="club_logo">
        <img src="{!! asset('assets/img/club.svg') !!}" alt="Üye Girişi">
    </div>
    <div class="side">
        <div class="head">{!! auth()->user()->first_name.' '.auth()->user()->last_name !!}</div>
        <ul>
            <li><a href="{!! getUrlBySitemapId(USER_CATALOGUE_ST_ID) !!}">{!! LangPart('request_catalogue', 'Katalog İste') !!}</a></li>
            <li class="{!! getUrlBySitemapId(ACCOUNT_INFORMATION_ST_ID) == request()->url() ? 'active':'' !!}"><a href="{!! getUrlBySitemapId(ACCOUNT_INFORMATION_ST_ID) !!}">{!! LangPart('member_informations', 'Üyelik Bilgilerim') !!}</a></li>
            <li><a href="{!! route('logoutMe', ['cg'=>$mediapress->activeCountryGroup->code, 'lg'=>$mediapress->activeLanguage->code]) !!}">{!! LangPart('logout', 'Logout') !!}</a></li>
        </ul>
    </div>
</div>
