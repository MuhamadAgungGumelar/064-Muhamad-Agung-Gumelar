<h1 class=" font-semibold text-2xl px-36 pt-12">Toko:</h1>
<div class="grid gap-8 px-24 sm:px-32 py-8 sm:pt-10 xl:grid-cols-2 lg:justify-items-start">
    @foreach ($shops as $shop)
    <div class="flex flex-col sm:flex-row shadow-xl justify-start gap-5 items-center p-6 border-2 h-fit w-full rounded-md border-gray-200">
        <img class="w-24" src="{{ asset($shop->image) }}" alt="{{ $shop->image }}">
        <h1 class="text-lg font-medium">{{$shop->name}}</h1>
        <a href="{{ route('showByShop', ['shop_name' => $shop->name]) }}">></a>
        <p class="text-md font-medium ">{{$shop->description}}</p>
    </div>
    @endforeach
</div>