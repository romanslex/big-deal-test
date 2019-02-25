<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">

        <title>Star Wars planets</title>

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic&subset=cyrillic,cyrillic-ext,latin,latin-ext' rel='stylesheet' type='text/css'>
        <style>
            body{font-family: 'Open Sans', sans-serif; font-size: 20px; font-weight: 300; line-height: 1.4;}
        </style>
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
    <div id="app"></div>

    <script src="/js/app.js"></script>
    </body>
</html>
