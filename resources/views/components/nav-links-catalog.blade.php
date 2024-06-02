<div class="flex flex-col justify-items-center px-4 py-4 lg:px-10">
    <div class="mb-4 px-24 sm:px-20">
        <ul class="flex flex-wrap justify-center text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
            <li class="me-2" role="presentation">
                <a href="{{ route('dashboardIndex') }}" class="inline-block p-4 border-b-2 rounded-t-lg @if(request()->routeIs('dashboardIndex')) text-purple-600 border-purple-600 @else hover:text-gray-600 hover:border-gray-300 @endif">All</a>
            </li>
            @foreach ($categories as $category)
                <li class="me-2" role="presentation">
                    <a href="{{ route('showByCategory', ['category_name' => $category->name]) }}" class="inline-block p-4 border-b-2 rounded-t-lg @if(request()->is('dashboard/category/' . $category->name)) text-purple-600 border-purple-600 @else hover:text-gray-600 hover:border-gray-300 @endif">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div id="default-styled-tab-content">
        <div class="p-4 rounded-lg">
            <x-catalog :items="$items"></x-catalog>
        </div>
    </div>
</div>
