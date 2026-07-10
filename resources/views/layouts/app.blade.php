<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SuiviHealth') — Votre santé, suivie avec soin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @view-transition {
            navigation: auto;
        }
        ::view-transition-old(root) {
            animation: slide-out 0.35s ease forwards;
        }
        ::view-transition-new(root) {
            animation: slide-in 0.35s ease forwards;
        }
        @keyframes slide-out {
            to { transform: translateX(-40px); opacity: 0; }
        }
        @keyframes slide-in {
            from { transform: translateX(40px); opacity: 0; }
        }
    </style>
</head>
<body class="font-sans text-navy-900 antialiased">
    @include('partials.nav')
    <main>
        @yield('content')
    </main>
    @include('partials.footer')
</body>
</html>