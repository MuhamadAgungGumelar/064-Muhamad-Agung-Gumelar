<!DOCTYPE html>
<html lang="en" class="h-screen bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <title>Document</title>
</head>
<body class="h-full ">
    <x-sidebar-dashboard :shop="$shop" :user="$user"></x-sidebar-dashboard>
    <div class="relative md:p-16 md:bottom-32 md:left-48 ">
        <x-header></x-header>
        <x-transaction-view :user="$user" :transactions="$transactions"></x-transaction-view>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>