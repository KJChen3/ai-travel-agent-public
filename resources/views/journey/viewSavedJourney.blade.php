<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1 class="text-center pt-12 text-3xl underline underline-offset-8 font-bold mb-0">已收藏的行程</h1>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <!--收藏的行程在這裡-->
                <div id="journeyList" class="mt-4 text-gray-900 whitespace-pre-wrap max-h-72 overflow-y-auto border border-gray-300 p-4">
                </div>

           
                <div class="mt-4 px-4 py-2 flex justify-between">
                    <button id="goBack" type="button" onclick="previousSection(2)" class="bg-gray-500 text-white rounded hover:bg-gray-600 px-4 py-2 h-12">
                        回首頁
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        //顯示所有已收藏的行程
        window.addEventListener('load', async function() {
        try {
            // 發送請求從後端獲取行程資料
            const response = await fetch('/user/journeys');
        
            // 檢查回應是否成功
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            const journeyList = document.getElementById('journeyList');

            if (data.length === 0) {
                // 如果沒有收藏的行程，顯示「無收藏的行程」
                journeyList.innerHTML = '<p class="text-left text-gray-500">無收藏的行程</p>';
            }
            else
            {
                //journeyList.innerHTML = JSON.stringify(data);
                journeyList.innerHTML = data.message;
            }

            } catch (error) {
                console.error('Error fetching journeys:', error);
            }
        });

        //回首頁
        document.getElementById('goBack').addEventListener('click', function() {
            window.location.href = '/dashboard';
        });
    </script>

</x-app-layout>

