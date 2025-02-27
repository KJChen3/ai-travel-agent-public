<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" align="center">
            {!! __('歡迎回到&nbsp;&nbsp;' . $user->name . '&nbsp;&nbsp;的首頁') !!}
        </h2>
    </x-slot>

    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    </head>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <?php if (session('success')) { ?>
                    <div id="success-message" class="bg-green-200 text-green-700 p-2 rounded">
                        {{ session('success') }}
                    </div>
                    <script>
                        setTimeout(() => {
                        document.getElementById('success-message').style.display = 'none';
                        }, 3000); // 3 秒後隱藏
                    </script>
                <?php } ?>
                </div>
                @if (!$preference)
                    {{-- 偏好未設定時顯示填寫偏好的按鈕 --}}
                    <div class="flex flex-col items-center justify-center border-gray-200 py-4">
                        <p class="text-lg font-medium text-gray-700 mb-4">您尚未設定您的個人喜好！</p>
                        <a href="{{ route('preference') }}" 
                            style="margin-bottom: 50px;"
                            class="inline-block px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700">
                            個人喜好設定
                        </a>
                    </div>
                @else
                    {{-- 偏好已設定時顯示功能按鈕 --}}

                    {{-- 景點推薦卡片預覽區塊 --}}
                    <div class="p-6">
                        <h3 class="text-2xl text-center font-bold mb-6">
                            <i class="fas fa-star text-yellow-500"></i> 本月精選 <i class="fas fa-star text-yellow-500"></i>
                        </h3>
                        <div class="grid grid-cols-3 gap-4">
                            @foreach ($recommendations as $spot)
                                <div class="border rounded-lg shadow-lg overflow-hidden">
                                    <img src="{{ asset('images/' . $spot['image']) }}" alt="{{ $spot['title'] }}" class="w-full h-40 object-cover">
                                    <div class="p-4">
                                        <h4 class="text-lg font-bold">{{ $spot['title'] }}</h4>
                                        <p class="text-gray-700">Price: ${{ $spot['price'] }}</p>
                                        <p class="text-gray-700">Rate: {{ $spot['rate'] }} / 5</p>
                                    </div>
                                </div>  
                            @endforeach
                        </div>
                        <div class="mt-4 px-4 py-2 flex">
                            <button type="button" id="recommendation" class="bg-gray-500 text-white rounded hover:bg-gray-600 px-4 py-2 h-12 ml-auto">
                                <i class="fas fa-arrow-right"></i> &nbsp;查看更多景點推薦
                            </button>
                        </div>
                    </div>  

                    <h3 class="text-2xl text-center font-bold mb-6">
                        <i class="fas text-red-500 fa-map-marker-alt"></i> &nbsp;即刻出遊&nbsp; <i class="fas text-red-500 fa-map-marker-alt"></i>
                    </h3>
                    <div class="grid grid-cols-2 gap-0 text-center justify-items-center mb-20">
                        {{-- 左邊按鈕：一鍵生成行程 --}}
                        <div style="margin-right: -80px;">
                            <button type="button" id="generate" class="inline-block bg-gray-200 text-black shadow-lg rounded-lg w-80 h-20 flex items-center justify-center p-5 hover:bg-green-200">
                                <i class="fas fa-robot text-5xl"></i>
                                <span class="text-2xl font-bold">&nbsp;&nbsp;&nbsp;一鍵生成</span>
                            </button>
                        </div>
                        {{-- 右邊按鈕：自訂行程 --}}
                        <div style="margin-left: -80px;">
                            <button type="button" id="dropdownList" class="inline-block bg-gray-200 text-black shadow-lg rounded-lg w-80 h-20 flex items-center justify-center p-5 hover:bg-green-200">
                                <i class="fas fa-pen text-5xl"></i>
                                <span class="text-2xl font-bold">&nbsp;&nbsp;&nbsp;自訂行程</span>
                            </button>
                        </div>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>

    <script>
            document.getElementById('recommendation').addEventListener('click', function() {
                window.location.href = '/product';
            });
            document.getElementById('generate').addEventListener('click', function() {
                window.location.href = '/generate';
            });
            document.getElementById('dropdownList').addEventListener('click', function() {
                window.location.href = '/dropdownList';
            });      
    </script>
</x-app-layout>
