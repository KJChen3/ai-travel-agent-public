<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <h1 class="text-center pt-12 text-3xl underline underline-offset-8 font-bold mb-1">一鍵生成行程</h1>
        <form method="POST" action="{{ route('chat') }}">
        @csrf
            <!-- For displaying the itinerary for user modification -->
            <label class="text-center text-xl font-semibold pb-10"
            for="itinerary">您的行程：</label>
            <div id="itinerary" class="text-gray-900 whitespace-pre-wrap max-h-500 overflow-auto border border-gray-300 p-4 scrollbar-hidden">
                <!-- 表格內容 -->
            </div>
        </form>

        <div class="mt-4 px-4 py-2 flex justify-between">
            <button id="savedJourney" type="button" class="bg-gray-500 text-white rounded hover:bg-gray-600 px-4 py-2 h-12">
                查看已收藏的行程
            </button>
            <button id="save" type="submit" class="bg-rose-500 text-white rounded hover:bg-rose-600 px-4 py-2 h-12 flex items-center">
                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.53L12 21.35z" fill="#fff"></path>
                </svg>
                收藏行程
            </button>

        </div>

        <form id="editItineraryForm" method="POST" action="{{ route('updateItinerary') }}">
        @csrf
            <!-- Input for user modifications -->
            <label class="mt-6 text-center text-xl font-semibold"
            for="userModification">修改行程：</label>
            <textarea class="mt-3"
            id="userModification" name="userModification" rows="5" style="width: 100%;" placeholder="請輸入您的修改需求..."></textarea>

            <div class="mt-4 px-4 py-2 flex justify-between">
                <button id="goBack" type="button" class="bg-gray-500 text-white rounded hover:bg-gray-600 px-4 py-2 h-12">
                    回首頁
                </button>
                <button id="modify" type="submit" class="bg-green-500 text-white rounded hover:bg-green-600 px-4 py-2 h-12 flex items-center justify-end">
                    重新生成行程
                </button>


            </div>
        </form>
    </div>
</div>

    <script>
        // 提交表單給後端生成、修改行程
        const submit = document.getElementById('submit');
        const itinerary = document.getElementById('itinerary');
        const itinerary_json = document.getElementsByName('itinerary_json');
        const editForm = document.getElementById('editItineraryForm');
        const userModification = document.getElementById('userModification');

        window.onload = function() {
            itinerary.innerHTML = "<strong>生成中...</strong>";
            fetch('/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        }
                    })
            .then(response => response.json())
            .then(data => {
                itinerary.innerHTML = data.message;
                itinerary_json.innerHTML = data.itinerary_json;
            })
            .catch(error => {
                console.error('Error:', error);
                itinerary.innerHTML = '行程生成失敗，請稍後再試。'+error;
            });
        };

        // submit.addEventListener('click', async function(event) {
        //     event.preventDefault(); // 阻止頁面跳轉
        //     itinerary.innerHTML = "<strong>生成中...</strong>";

        //     try {
        //         const response = await fetch('/chat', {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'X-CSRF-TOKEN': '{{ csrf_token() }}',
        //             }
        //         });

        //         const data = await response.json();
        //         if (response.ok) {
        //             itinerary.innerHTML = data.message;
        //             editForm.style.display = 'block';
        //         } else {
        //             itinerary.innerHTML = `Error: ${data.message || 'Unable to fetch response.'}`;
        //         }
        //     } catch (error) {
        //         itinerary.innerHTML = 'An error occurred while processing your request.';
        //         console.error(error);
        //     }
        // });

        //修改行程
        modify.addEventListener('click', async function(event) {
            event.preventDefault();

            if (userModification.value.trim() === "") {
                alert("請輸入修改內容！");
            } else {
                const original = itinerary_json.innerHTML;
                const modification = userModification.value.trim();
                itinerary.innerHTML = "<strong>修改中...</strong>";
                userModification.value = "";

                try {
                const response = await fetch('/updateItinerary', {
                    method: 'POST',
                    headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ original, modification })
                });

                const data = await response.json();
                if (response.ok) {
                    itinerary.innerHTML = data.message; // Assuming the backend returns the updated itinerary
                    itinerary_json.innerHTML = data.itinerary_json;
                } else {
                    itinerary.innerHTML = `Error: ${data.message || 'Unable to fetch response.'}`;
                }
                } catch (error) {
                itinerary.innerHTML = 'An error occurred while processing your request.';
                console.error(error);
                }
            }
            });

        //收藏行程
        const save = document.getElementById('save');

        save.addEventListener('click', async function(event) {
            event.preventDefault(); // 阻止頁面跳轉

            if(itinerary.innerHTML.trim() === "")
            {
                alert("請先生成行程！");
            }
            else
            {
                const journey = itinerary_json.innerHTML.trim();
                const journeyData = JSON.parse(journey); // 解析 JSON 字符串為物件

                try {
                    const response = await fetch('/saveJourney', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({ journeyData })
                    });

                    const data = await response.json();
                    if (response.ok) {
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                } catch (error) {
                    alert('An error occurred while processing your request.');
                    console.error(error);
                }
            }
        });


        //觀看已收藏的行程
        document.getElementById('savedJourney').addEventListener('click', function() {
            window.location.href = '/viewSavedJourney';  // 跳轉到顯示行程頁面
        });

        //回首頁
        document.getElementById('goBack').addEventListener('click', function() {
            window.location.href = '/dashboard';
        });

    </script>
</x-app-layout>
