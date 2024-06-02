<section class="flex h-screen items-center justify-center dark:bg-gray-800 lg:p-40">
    <div class="bg-white border border-gray-200 dark:border-gray-700 p-5 rounded-xl lg:p-7 xl:w-1/3">
        <div class="flex justify-between">
            <h1 class="text-xl mb-5 font-semibold text-gray-900 dark:text-white sm:text-2xl">Detail Transaksi</h1>
            <a class="text-xl mb-1 font-semibold text-gray-900 dark:text-white sm:text-2xl" href="{{route('dashboardIndex') }}">X</a>
        </div>
        <hr>
        <div class="flex flex-col mt-8">
            @foreach($transactionDetails as $transactionDetail)
            <div class="flex my-5 px-1 justify-center items-center gap-16">
                <div class="flex gap-x-7 w-8">
                    <h1>{{ $transactionDetail->name }}</h1>
                </div>
                <div class="flex gap-2 justify-end">
                    <h1>{{ $transactionDetail->quantity }}</h1>
                </div>
                <h1 class="w-20">Rp.{{ $transactionDetail->price }}</h1>
            </div>
            <hr>
            @endforeach 
            <div class="flex p-3 my-5 justify-between gap-16 lg:gap-64 md:gap-40 sm:gap-24 ">
                <h1>Jumlah Belanja</h1>
                <h1 class="flex justify-between text-lg font-semibold text-gray-900 dark:text-white sm:text-2xl">{{$transaction->total_quantity}}</h1>
            </div>
            
        </div>
        <div class="mb-5">
            <div class="flex flex-col gap-y-1 border border-gray-200 dark:border-gray-700 p-5 mt-14 rounded-xl">
                <div class="flex justify-between">
                    <h1 class="text-xl mb-3 font-semibold text-gray-900 dark:text-white sm:text-2xl">Transaksi</h1>
                    <h1 class="font-bold text-xl mb-3 text-gray-900 dark:text-white sm:text-2xl">#{{$transaction->id}}</h1>
                </div>
                <div class="flex justify-between">
                    <h2>Total Belanja</h2>
                    <h2>{{$transaction->total_price}}</h2>
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
                    <h1>{{$transaction->total_price}}</h1>
                </div>
            </div>
        </div>
        <hr>
        @if($user->role_id==2)
            @if($transaction->status_id==3 || $transaction->status_id==4)
                <div class="hidden">
                    <div class="mt-5 flex gap-x-5">
                        <a class="border border-gray-200 dark:border-gray-700 p-3 rounded-xl hover:bg-slate-600 hover:text-cyan-200" href="{{route('shopTransactionAccept', ['name' => $shop->name, 'transaction_id' => $transaction->id]) }}">Terima</a>
                    </div>
                    <div class="mt-5 flex gap-x-5">
                        <a class="border border-gray-200 dark:border-gray-700 p-3 rounded-xl hover:bg-slate-600 hover:text-cyan-200" href="{{route('shopTransactionReject', ['name' => $shop->name, 'transaction_id' => $transaction->id]) }}">Tolak</a>
                    </div>
                </div>
                <div class="flex gap-2">
                    <div class="mt-5 flex gap-x-5">
                        <a class="border border-gray-200 dark:border-gray-700 p-3 rounded-xl hover:bg-slate-600 hover:text-cyan-200" href="{{route('shopTransactionPage', ['name' => $shop->name]) }}">Kembali</a>
                    </div>
                </div>
            @else
                <div class="flex gap-2">
                    <div class="mt-5 flex gap-x-5">
                        <a class="border border-gray-200 dark:border-gray-700 p-3 rounded-xl hover:bg-slate-600 hover:text-cyan-200" href="{{route('shopTransactionAccept', ['name' => $shop->name, 'transaction_id' => $transaction->id]) }}">Terima</a>
                    </div>
                    <div class="mt-5 flex gap-x-5">
                        <a class="border border-gray-200 dark:border-gray-700 p-3 rounded-xl hover:bg-slate-600 hover:text-cyan-200" href="{{route('shopTransactionReject', ['name' => $shop->name, 'transaction_id' => $transaction->id]) }}">Tolak</a>
                    </div>
                </div>
            @endif
        @else
        <div class="flex gap-2">
            <div class="mt-5 flex gap-x-5">
                <a class="border border-gray-200 dark:border-gray-700 p-3 rounded-xl hover:bg-slate-600 hover:text-cyan-200" href="{{route('dashboardIndex') }}">Lanjutkan Belanja</a>
            </div>
            <div class="mt-5 flex gap-x-5">
                <a class="border border-gray-200 dark:border-gray-700 p-3 rounded-xl hover:bg-slate-600 hover:text-cyan-200" href="{{route('viewTransaction', ['name' => $user->name]) }}">Kembali</a>
            </div>
        </div>
        @endif
    </div>
</section>