<?php


ob_start();
$url = strtolower(rtrim($_SERVER['REQUEST_URI'], '/'));
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, strpos($_SERVER["SERVER_PROTOCOL"], '/'))).'://';
$domain = 'https://'.$_SERVER['HTTP_HOST'];

$list = [
    '/tr_tr/urunler/floorpan' => '/tr_tr/urunler/floorpan-laminat-parke',
];


$check = parse_url($url);
if(isset($check['path'])){
    $url = $check['path'];
}

if (isset($list[$url])) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ".$domain.$list[$url].(isset($check['query']) ? (strpos($list[$url],'?') !== false ? '&' : '?') .$check['query'] : ''));
    exit;
}

$url = $url.'/';
if (isset($list[$url])) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ".$domain.$list[$url].(isset($check['query']) ? (strpos($list[$url],'?') !== false ? '&' : '?') .$check['query'] : ''));
    exit;
}
