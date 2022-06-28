<?php


use App\Helpers\BaseService;
use App\Constant;
$title          = $title ?? ($company['name'] ?? "");
$name           = $company['name'] ?? "";
$keywords       = empty($company['keywords']) ? "" : BaseService::renderTagifyToString($company['keywords']) ?? "";
$description    = $company['description'] ?? "";
$favicon 	    = isset($company['favicon']) && !empty($company['favicon']) ? asset("/public/uploads/1/Favicon/").'/'.$company['favicon']. '?t=' .Constant::SYSTEM_CACHE : '';
$copyright      = $company['copyright'] ?? "";
$copyright      = str_replace("#YYYY#", date("Y"), $copyright);

?>
<title>{{ $title }}</title>
<meta http-equiv="Content-Type" content="text/html; CHARSET=UTF-8">
<!--[if IE 8]><meta http-equiv="X-UA-Compatible" content="IE=8,chrome=1"><![endif]-->
<!--[if IE 9]><meta http-equiv="X-UA-Compatible" content="IE=9,chrome=1"><![endif]-->
<!--[if IE 10]><meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1"><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="{{$description}}">
<meta name="author" content="{{$name}}">
<meta name="copyright" content="{{$copyright}}">
<meta name="keyword" content="{{$keywords}}">
<meta name="robots" content="noindex,nofollow">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" type="image/png" href="{{$favicon}}"/>
