<x-app-layout>
    <form method="POST" action="{{ route('preference.store') }}">
        @csrf
        <h1 class="text-center pt-12 text-3xl underline underline-offset-8 font-bold mb-0">個人喜好設定</h1>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    {{-- <header>
                        <h2 class="text-2xl text-center font-bold text-gray-900">
                           個人喜好設定
                        </h2>
                    </header> --}}

                    <div class="mt-1">
                        <!-- Section 1 -->
                        <div id="section-1" class="section">
                            @include('userPreference.preferenceDetail.attractionPreference')
                            <div class="mt-4 px-4 py-2 flex justify-between">
                                <button type="button" id="goBack" class="bg-gray-500 text-white rounded hover:bg-gray-600 px-4 py-2 h-12">
                                    回首頁
                                </button>
                                <button type="button" onclick="nextSection(2)" class="bg-blue-500 text-white rounded hover:bg-blue-600 px-4 py-2 h-12">
                                    下一步
                                </button>
                            </div>
                        </div>

                        <!-- Section 2 -->
                        <div id="section-2" class="section hidden">
                            @include('userPreference.preferenceDetail.accommodationPreference')
                            <div class="mt-4 px-4 py-2 flex justify-between">
                                <button type="button" onclick="previousSection(1)" class="bg-blue-500 text-white rounded hover:bg-blue-600 px-4 py-2 h-12">
                                    上一步
                                </button>
                                <button type="button" onclick="nextSection(3)" class="bg-blue-500 text-white rounded hover:bg-blue-600 px-4 py-2 h-12">
                                    下一步
                                </button>
                            </div>
                        </div>

                        <!-- Section 3 -->
                        <div id="section-3" class="section hidden">
                            @include('userPreference.preferenceDetail.otherPreference')
                            <div class="mt-4 px-4 py-2 flex justify-between">
                                <button type="button" onclick="previousSection(2)" class="bg-blue-500 text-white rounded hover:bg-blue-600 px-4 py-2 h-12">
                                    上一步
                                </button>
                                <button id="submit" type="submit" class="bg-green-500 text-white rounded hover:bg-green-600 px-4 py-2 h-12">
                                    提交
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script>
        //下一步
        function nextSection(section) {
            document.querySelectorAll('.section').forEach(el => el.classList.add('hidden'));
            document.getElementById(`section-${section}`).classList.remove('hidden');
        }

        //上一步
        function previousSection(section) {
            document.querySelectorAll('.section').forEach(el => el.classList.add('hidden'));
            document.getElementById(`section-${section}`).classList.remove('hidden');
        }

        //回首頁
        document.getElementById('goBack').addEventListener('click', function() {
            window.location.href = '/dashboard';
        });

    </script>
    </form>
</x-app-layout>
