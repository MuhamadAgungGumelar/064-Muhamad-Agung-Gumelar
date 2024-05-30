<!DOCTYPE html>
<html lang="en" class="h-screen bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Document</title>
</head>
<body class="h-full ">
    <x-navbar></x-navbar>
    <x-banner :user="$user"></x-banner>
    <x-nav-links-catalog-by-shop-item :shop="$shop" :items="$items" :shops="$shops" :categories="$categories"></x-nav-links-catalog-by-shop-item>
</body>
</html>