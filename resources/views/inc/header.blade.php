<!DOCTYPE html>
<html class="{{ $html_class or '' }}">
    <head>
        <meta charset="utf-8">
        <title>{{ $title or 'InsideTv - Rede social e gerenciamento de séries' }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('images/insidetv-icon.png') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/global.css') }}">

        @yield('styles')


        <!--<script src="https://use.fontawesome.com/da0156cf61.js"></script>-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body class="{{ $body_class or '' }}">
