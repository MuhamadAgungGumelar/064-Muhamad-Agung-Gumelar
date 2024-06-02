<section class="flex flex-col gap-8 h-screen items-center justify-center dark:bg-gray-800 lg:p-40">
    <a class=" text-xl mb-1 text-center font-semibold text-gray-900 dark:text-white sm:text-2xl w-10 hover:rounded-full hover:bg-purple-700" href="{{route('dashboardIndex') }}">X</a>
    @foreach ($transactions as $transaction)
    <div class=" bg-white flex flex-row justify-between items-center gap-3 sm:gap-20 border border-gray-200 dark:border-gray-700 p-5 rounded-xl w-2/3 xl:w-1/2 lg:p-7">
        <div>
            <h1 class="font-semibold text-md">Transaksi ke: <span class="font-bold text-lg">#{{$transaction->id}}</span></h1>
        </div>
        <div>
            <h1 class="font-semibold text-md">Total Barang: {{$transaction->total_quantity}}</h1>
            <h1 class="font-semibold text-md">Total Harga: Rp.{{$transaction->total_price}}</h1>
            <h1 class="font-semibold text-md">Status: <span class="@if($transaction->status_id == 2) bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300 @elseif($transaction->status_id == 3) bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400 @elseif($transaction->status_id == 4) bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400 @else bg-indigo-100 text-indigo-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-indigo-400 border border-indigo-400 @endif">{{$transaction->status->name}}</span></h1>
            <h1 class="font-semibold text-md">Pembeli: {{$transaction->user->name}}</h1>
        </div>
        <div>
            <a  href="{{route('viewTransactionDetail', ['name' => $user->name, 'transaction_id' => $transaction->id]) }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                </svg>
            </a>
        </div>
    </div>
    @endforeach
    <div class="mt-4 ">
        {{ $transactions->links() }}
    </div>
</section>
