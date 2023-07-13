<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/scss/index.scss'])
    <title>@yield('seo_title', $site->seo_title)</title>
    <meta name="description" content="@yield('seo_description', $site->seo_description)">
</head>

<body>
