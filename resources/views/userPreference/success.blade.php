<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="mt-8 text-center">
                    <p class="text-lg text-gray-600">
                        您的旅遊個人喜好已成功儲存！
                    </p>
                </div>    
                <div class="mt-4 px-4 py-3 flex justify-between">

                    <button id="goBack" type="button" class="bg-gray-500 text-white rounded hover:bg-gray-600 px-4 py-2 h-12">
                        回首頁
                    </button>

                    <button id="generate" type="button" class="bg-green-500 text-white rounded hover:bg-gray-600 px-4 py-2 h-12">
                        一鍵生成行程
                    </button>

                    <button id="preference" type="button" class="bg-blue-500 text-white rounded hover:bg-gray-600 px-4 py-2 h-12">
                        修改個人喜好
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    //回首頁
    document.getElementById('goBack').addEventListener('click', function() {
        window.location.href = '/dashboard';
    });

    //一建生成行程
    document.getElementById('generate').addEventListener('click', function() {
        window.location.href = '/generate';
    });

    //修改個人喜好
        document.getElementById('preference').addEventListener('click', function() {
            window.location.href = '/preference';
        });

    </script>

</x-app-layout>
