@php use Illuminate\Support\Facades\Vite; @endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
          content="Сити парк, Сити парк белореченск, ресторан сити парк, гостиница сити парк, ресторан белореченск, citypark, city park, citi park, siti park, cyti park, syti park, sity park, citi parc, citipark, sitipark, ситипарк, цити парк, цитипарк, доставка еды, доставка еды белореченск, пицца белореченск, суши белореченск, роллы белореченск, доставка суши, доставка роллов, заказать пиццу белореченск, заказать суши белореченск, ресторан в белореченске">
    <meta name="description" content="Официальный сайт Сити Парк — Белореченск | cityparkvip.ru | Доставка еды в Белореченске: +7-918-311-97-91.
        City Park. Вкус в его истинном проявлении.">
    <title inertia>{{ config('app.name', 'City Park') }}</title>
    <link rel="shortcut icon" href="{{ Vite::asset('resources/images/favicon.png')  }}">
    <!-- fonts -->
    <link rel="preload" href="{{ Vite::asset('resources/fonts/Roboto.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ Vite::asset('resources/fonts/Merriweather-Regular.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ Vite::asset('resources/fonts/Merriweather-Bold.woff2') }}" as="font" type="font/woff2" crossorigin>
    <!-- scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>
<body class="font-sans antialiased">
@inertia
</body>
</html>
