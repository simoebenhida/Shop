<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('styles')
    <title>@yield('title')</title>
</head>
<body class="bg-white">
<div class="container mx-auto px-4">
    @yield('content')
</div>
<script src="{{ mix('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
