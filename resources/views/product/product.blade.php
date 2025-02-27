<x-app-layout>
    <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-black">
        <div class="max-w-[80rem] px-6 py-2 mx-auto">
            <h1 class="text-center pt-12 text-3xl underline underline-offset-8 font-bold mb-1">景點推薦</h1>
                <!-- Card Grid -->
                <div class="py-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                        @foreach ($products as $product)
                        @if (isset($product['id']))
                            <a class="group flex flex-col focus:outline-none" href="{{ route('product.show', $product['id']) }}">
                                <div class="aspect-w-16 aspect-h-12 overflow-hidden rounded-2xl bg-neutral-800">
                                    @if (isset($product['image']) && !empty($product['image']))
                                    <img
                                    class="h-[15rem] w-full group-hover:scale-105 group-focus:scale-105 transition-transform duration-500 ease-in-out object-cover rounded-2xl"
                                    src="{{ asset('images/' . $product['image'][0]) }}"
                                    alt="{{ $product['name'] }}">
                                    @endif
                                </div>

                                <div class="pt-4 group">

                                    <h3 class="relative text-center inline-block font-bold text-xl before:absolute before:bottom-0 before:start-0 before:z-12 before:w-full before:h-3 before:bg-sky-900 before:transition-opacity before:opacity-50 before:origin-left before:scale-x-0 group-hover:before:scale-x-100 text-black">
                                        {{ $product['name'] }}
                                    </h3>
                                    <p class="mt-1 font-medium text-neutral-400">
                                        {{ $product['description'] }}
                                    </p>

                                    <div class="mt-3 flex flex-wrap gap-2">
                                        @if(isset($product['price']))
                                            <span class="py-1.5 px-3  border font-semibold sm:text-sm rounded-xl bg-sky-800  border-neutral-700 text-white">
                                                Price: ${{ $product['price'] }}
                                            </span>
                                        @endif

                                        @if(isset($product['rate']))
                                        <span class="py-1.5 px-3  border  font-semibold sm:text-sm rounded-xl bg-sky-800 border-neutral-700 text-white">
                                                Rate: {{ $product['rate'] }} / 5
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                            @endif
                        @endforeach
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
