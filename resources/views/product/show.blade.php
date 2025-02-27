        <x-app-layout>
            {{-- <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"> --}}
            <div class="max-w-[65rem] px-10 py-2 mx-auto">
                <!-- Features -->
                <div class="max-w-[85rem] lg:py-12 mx-auto">
                    <div class="relative p-6 md:p-16">
                    <!-- Grid -->
                    <div
                        class="relative z-10 lg:grid lg:grid-cols-12 lg:gap-8 lg:items-center"
                    >
                        <div class="lg:col-span-7">
                        <div class="relative">
                            <!-- Tab Content -->
                            <div>
                                @foreach ($product['image'] as $image)
                                    <img
                                        class="rounded-xl py-1 "
                                        src="{{ asset('images/' . $image) }}"
                                        alt="{{ $product['name'] }}"
                                    />
                                @endforeach
                            </div>
                            <!-- End Tab Content -->
                        </div>
                        </div>
                        <!-- End Col -->
                        <div
                        class=" lg:col-span-6 lg:col-start-8 lg:order-2"
                        >
                            <h1 class="underline underline-offset-8 text-center text-4xl font-bold sm:text-3xl text-neutral-200">
                                {{ $product['name'] }}
                            </h1>
                            <p class="mx-2 block font-semibold text-lg mt-6  text-neutral-200">
                                {{ $product['description'] }}
                            </p>

                        <!-- Tab Navs -->
                        <div class="grid gap-4 mx-2" aria-orientation="vertical">
                            <p
                            class="text-start focus:outline-none focus:bg-gray-200  md:p-0 rounded-xl"
                            >
                            <span class="flex gap-x-3">

                                <p class="text-white">
                                    ✩₊˚.⋆☾⋆⁺₊✧∞︎︎ ☼ ⋆｡˚⋆ฺ ♡⋆｡ ﾟ☁︎｡ ⋆｡ ﾟ☾ ﾟ｡ ⋆˚
                                </p>
                                <p
                                    class="block text-lg text-center font-semibold pt-2 text-neutral-200">
                                {{ $product['content-title'] }}
                                </p>
                                <div>
                                    @foreach ($product['content'] as $content)
                                        <p class="block text-lg pt-2 text-neutral-200">
                                            {{ $content }}
                                        </p>
                                    @endforeach
                                </div>
                                <div class=" mt-3  ">
                                    <h2 class="text-lg font-semibold text-neutral-200">
                                        產品價格： ${{ $product['price'] }}
                                    </h2>
                                    <h2 class="text-lg font-semibold text-neutral-200">
                                        產品評分：⭐️ {{ $product['rate'] }} / 5
                                    </h2>
                                </div>
                                </span>
                            </span>
                            </p>
                        </div>
                        <!-- End Tab Navs -->
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Grid -->

                    <!-- Background Color -->
                    <div class="absolute inset-0 grid grid-cols-12 size-full">
                        <button
                        onclick="history.back()"
                        type="button"
                        class="absolute top-5 right-5 h-10 w-10 text-2xl font-bold p-2 text-neutral-200"
                        aria-label="返回上一頁"
                        >
                        X
                        </button>
                        <div
                        class="col-span-full lg:col-span-7 lg:col-start-6 w-full h-5/6 rounded-xl sm:h-3/4 lg:h-full bg-sky-900"
                        ></div>
                    </div>
                    <!-- End Background Color -->
                    </div>
                </div>
                <!-- End Features -->
            </div>
        </x-app-layout>
