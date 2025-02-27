<x-app-layout>
    <form method="POST" action="{{ route('submitSelection') }}">
        @csrf
        <h1 class="text-center pt-12 text-3xl underline underline-offset-8 font-bold mb-0">自訂行程</h1>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                    <div class="mt-6">
                        <div id="section-3">
                            @include('dropdownList.dropdownListDetail.dropdownListContent')

                            <div id="responseMessage" class="mt-4 text-gray-900 whitespace-pre-wrap max-h-72 overflow-y-auto border border-gray-300 p-4 hidden">
                                <!--測試生成行程在這裡-->
                            </div>

                            <div class="mt-4 px-4 py-2 flex justify-end">
                                <button type="button" id="submitBtn" class="bg-green-500 text-white rounded hover:bg-green-600 px-4 py-2 h-12">
                                提交
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        const submitBtn = document.getElementById('submitBtn');
        const responseMessage = document.getElementById('responseMessage');

        submitBtn.addEventListener('click', async function(event) {
        event.preventDefault(); // 防止表單預設行為
        try {
            const selection1 = document.getElementById('selection1').value;
            const selection2 = document.getElementById('selection2').value;
            const date = document.getElementById('date').value;

            const response = await fetch('/submitSelection', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ selection1, selection2, date })
            });

            const data = await response.json();
            if (response.ok) {
                responseMessage.innerHTML = data.message;
            } else {
                responseMessage.innerHTML = `Error: ${data.message || 'Unable to fetch response.'}`;
            }
        } catch (error) {
            responseMessage.innerHTML = 'An error occurred while processing your request.';
            console.error(error);
        }
        responseMessage.classList.remove('hidden');
        });

    </script>
</x-app-layout>