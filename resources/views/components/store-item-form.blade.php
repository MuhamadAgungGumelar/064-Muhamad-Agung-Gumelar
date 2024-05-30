<div class="flex flex-col justify-center px-14 py-12 lg:px-20 rounded-2xl shadow-2xl">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            @if(session()->get("error"))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex">
                    <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                    <div>
                    <p class="font-bold">{{ session()->get("error")}}</p>
                    <p class="text-sm">Make sure you password is correct.</p>
                    </div>
                </div>
            </div>
            @endif
            <form class="space-y-6" action="{{ route('storeItemPage', ['name' => $shop->name]) }}" method="POST">
                @csrf
                <!-- <div>
                    <label for="user_id" class="block text-sm font-medium leading-6 text-gray-900">User Id</label>
                    <div class="mt-2">
                    <input id="user_id" name="user_id" type="number" value="{{ old('user_id') }}" autocomplete="user_id" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div> -->

                <div>
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Item Name</label>
                    <div class="mt-2">
                    <input id="name" name="name" type="text" autocomplete="name" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="quantity" class="block text-sm font-medium leading-6 text-gray-900">Quantity Item</label>
                    <div class="mt-2">
                    <input id="quantity" name="quantity" type="number" autocomplete="quantity" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                
                <div>
                    <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Price Item</label>
                    <div class="mt-2">
                    <input id="price" name="price" type="number" autocomplete="price" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                    <div class="mt-2">
                        <select id="category_id" name="category_id" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <p class="mt-10 text-center text-sm text-gray-500">
                Ingin Menambahkan Category Baru?
                <a href="{{ route('storeCategoryPage') }}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Category</a>
                </p>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
            Not a member?
            <a href="registration" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Registration</a>
            </p>
        </div>
    </div>