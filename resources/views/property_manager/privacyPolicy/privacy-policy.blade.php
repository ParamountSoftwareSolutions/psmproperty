<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{  asset('public/panel/assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{  asset('public/panel/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{  asset('public/panel/assets/css/all.min.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('public/panel/assets/img/favicon.ico') }}'/>
    <style>
        .main-content{
            padding: 0px;
        }
    </style>
</head>

<body>
<div class="loader"></div>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="main-content">
            <section class="section">
                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card pt-5">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h1>Pacha Gee</h1>
                                    <img alt="image" src="{{ asset('public/panel/assets/img/logo.png') }}" class="header-logo" style="height:150px !important;margin-top: -20px !important;"/>
                                </div>
                                <div class="card-body">
                                    <div class="text-center"><h3>Privacy Policy</h3></div>
                                        <ul class="pt-5">
                                            @forelse($privacyPolicy as $result)
                                                <li>$result->description</li>
                                            @empty
                                                <li>No more data in this List.</li>
                                            @endforelse
                                        </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script src="{{ asset('public/panel/assets/js/app.min.js') }}"></script>
<script src="{{ asset('public/panel/assets/js/scripts.js') }}"></script>
</body>
</html>
