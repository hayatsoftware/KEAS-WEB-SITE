<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="/css/sitemap_stylesheet.xsl?v=1.1"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
@foreach($sitemaps as $sitemap)
<url>
    <loc>{{$sitemap['url']}}</loc>
    @isset($sitemap['last_updated'])
    <lastmod>{{$sitemap['last_updated']}}</lastmod>
    @endisset
</url>
@endforeach
</urlset>
