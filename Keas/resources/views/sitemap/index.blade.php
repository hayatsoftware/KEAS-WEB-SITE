<?xml version="1.0" encoding="utf-8"?><?xml-stylesheet href="/css/sitemap_stylesheet.xsl?v=1.1" type="text/xsl"?>
<sitemapindex xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($data as $sitemap)
    <sitemap>
        <loc>{{$sitemap}}</loc>
    </sitemap>
    @endforeach
</sitemapindex>
