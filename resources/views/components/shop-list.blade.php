<div class="grid grid-cols-1 gap-x-8 gap-y-8 px-14 py-10 sm:pt-16 lg:grid-cols-3">
    @foreach ($shops as $shop)
    <div class="flex flex-col justify-center px-5 items-start border-2 h-24 rounded-md border-gray-200">
        <img src="" alt="">
        <h1>{{$shop->name}}</h1>
        <a href="{{ route('showByShop', ['shop_name' => $shop->name]) }}">></a>
    </div>
    @endforeach
</div>