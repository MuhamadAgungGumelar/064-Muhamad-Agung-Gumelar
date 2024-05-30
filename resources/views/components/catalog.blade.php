<div class="grid grid-cols-2 gap-x-8 gap-y-16 px-6 pt-10 sm:pt-16 lg:grid-cols-3">
    @foreach ($items as $item)
    <div class="flex flex-col justify-center px-5 items-start border-2 h-48 rounded-md border-gray-200">
        <img src="" alt="">
        <h1>{{$item->name}}</h1>
        <p>{{$item->price}}</p>
        <p>{{$item->quantity}}</p>
    </div>
    @endforeach
</div>