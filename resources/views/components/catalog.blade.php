<h1 class=" font-semibold text-2xl px-24">Catalog:</h1>
<div class="grid grid-cols-1 justify-items-center w-full gap-y-16 sm:px-6 pt-5 lg:pt-5 sm:pt-16 sm:grid-cols-2 lg:grid-cols-4">
    @foreach ($items as $item)
    <div class="flex flex-col w-2/3 gap-5 shadow-xl justify-end items-center p-6 my border-2 h-full rounded-md border-gray-200">
        <img class="h-full w-36" src="{{ asset($item->image) }}" alt="{{ $item->image }}">
        <div class="flex flex-col min-w-full items-start gap-y-1">
            <h1 class="text-xl font-bold">{{$item->name}}</h1>
            <p class="text-md font-medium">Rp. {{$item->price}}</p>
            <p class="text-md font-medium">Stock: {{$item->quantity}}</p>
            <a class="flex justify-center w-full border border-gray-200 dark:border-gray-700 p-2 rounded-xl hover:bg-slate-600 hover:text-cyan-200" href="{{ route('addToCart', ['item_name' => $item->name] ) }}">Add to Cart</a>
        </div>
    </div>
    @endforeach
</div>