<section class="flex h-screen items-center justify-center dark:bg-gray-800 lg:p-40">
    
    <div class="bg-white border border-gray-200 dark:border-gray-700 p-5 rounded-xl w-10/12 xl:w-1/2 lg:p-7">
        <div class="flex justify-between">
            <h1 class="text-xl mb-5 font-semibold text-gray-900 dark:text-white sm:text-2xl">Shopping Cart</h1>
            <a class="text-xl mb-1 font-semibold text-gray-900 dark:text-white sm:text-2xl" href="{{route('dashboardIndex') }}">X</a>
        </div>
        <hr>
        <div class="flex flex-col mt-8">
            @foreach($cartItems as $cartItem)
            <div class="flex my-5 px-1 justify-between items-center ">
                <div class="flex flex-col sm:items-center sm:flex-row">
                    <img class="w-20" src="{{ asset($cartItem->item->image) }}" alt="{{ $cartItem->item->image }}">
                    <h1 class="text-center">{{ $cartItem->item->name }}</h1>
                </div>
                <div class="flex gap-4 justify-end">
                    <a href="{{ route('minusItem', ['name' => $cartItem->item->name]) }}" class="hover:bg-purple-400 rounded-full">-</a>
                    <h1>{{ $cartItem->quantity }}</h1>
                    <a href="{{ route('plusItem', ['name' => $cartItem->item->name]) }}">+</a>
                </div>
                <div>
                    <h1>Rp.{{ $cartItem->item->price }}</h1>
                </div>
                <div >
                    <a href=""><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </a>
                </div>
            </div>
            <hr>
            @endforeach 
            <div class="flex p-3 my-5 justify-between gap-16 lg:gap-64 md:gap-40 sm:gap-24 ">
                <h1>Jumlah Belanja</h1>
                <h1 class="flex justify-between text-lg font-semibold text-gray-900 dark:text-white sm:text-2xl">{{$totalQuantity}}</h1>
            </div>
            
        </div>
        <div class="mb-5">
            <div class="flex flex-col gap-y-1 border border-gray-200 dark:border-gray-700 p-5 mt-14 rounded-xl">
                <h1 class="text-xl mb-3 font-semibold text-gray-900 dark:text-white sm:text-2xl">Transaksi</h1>
                <div class="flex justify-between">
                    <h2>Total Belanja</h2>
                    <h2>{{$totalPrice}}</h2>
                </div>
                <div class="flex justify-between">
                    <h2>Tunai</h2>
                    <h2>20000</h2>
                </div>
                <div class="flex justify-between">
                    <h2>Kembalian</h2>
                    <h2>2000</h2>
                </div>
                <hr class="my-1">
                <div class="flex justify-between text-xl mb-3 font-semibold text-gray-900 dark:text-white sm:text-2xl">
                    <h1>Total</h1>
                    <h1>{{$totalPrice}}</h1>
                </div>
            </div>
        </div>
        <hr>
        <div class="mt-5 flex flex-row gap-5">
            <a class="border border-gray-200 dark:border-gray-700 p-3 rounded-xl hover:bg-slate-600 hover:text-cyan-200" href="{{route('checkout', ['name' => $user->name]) }}">Checkout</a>
            <a class="border border-gray-200 dark:border-gray-700 p-3 rounded-xl hover:bg-slate-600 hover:text-cyan-200" href="{{route('dashboardIndex') }}">Lanjutkan Belanja</a>
        </div>
    </div>
</section>