<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <title>Document</title>
</head>
<body class="flex justify-center h-screen max-w-screen">
    <x-sidebar-dashboard :user="$user" :shop="$shop"></x-sidebar-dashboard>
    <div class="relative bottom-12 left-28 lg:p-16 md:left-48 top-4 lg:-top-10">
        <x-header></x-header>
        <x-nav-links-catalog-by-shop :shop="$shop" :items="$items" :shops="$shops" :categories="$categories"></x-nav-links-catalog-by-shop>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>