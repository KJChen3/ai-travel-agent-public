<section >
    <h3 class="text-center">#住宿類型設定</h3>
    {{-- Q2-1 --}}
    <div class="bg-gray-100 mt-4 shadow-md rounded-lg p-6">
        <h3 class="text-lg font-medium mb-4">2-1. 您偏好的住宿類型？</h3>
        <div class="flex gap-2">
            <label>
                <input type="radio" name="question2-1" value="豪華酒店" class="hidden peer">
                <div class="peer-checked:bg-yellow-500 peer-checked:text-white border px-4 py-2 rounded cursor-pointer hover:bg-yellow-100">
                    豪華酒店
                </div>
            </label>
            <label>
                <input type="radio" name="question2-1" value="經濟型旅館" class="hidden peer">
                <div class="peer-checked:bg-yellow-500 peer-checked:text-white border px-4 py-2 rounded cursor-pointer hover:bg-yellow-100">
                    經濟型旅館
                </div>
            </label>
            <label>
                <input type="radio" name="question2-1" value="民宿/家庭旅館" class="hidden peer">
                <div class="peer-checked:bg-yellow-500 peer-checked:text-white border px-4 py-2 rounded cursor-pointer hover:bg-yellow-100">
                    民宿/家庭旅館
                </div>
            </label>
            <label>
                <input type="radio" name="question1-1" value="露營/特色住宿" class="hidden peer">
                <div class="peer-checked:bg-yellow-500 peer-checked:text-white border px-4 py-2 rounded cursor-pointer hover:bg-yellow-100">
                    露營/特色住宿（樹屋、膠囊旅館）
                </div>
            </label>
        </div>
    </div>
    {{-- Q2-2 --}}
    <div class="bg-gray-100 mt-4 shadow-md rounded-lg p-6">
         <h3 class="text-lg font-medium mb-4">2-2. 您偏好的住宿設施？</h3>
         <div class="flex gap-4">
             <label>
                 <input type="radio" name="question2-2" value="無線網路與商務設施" class="hidden peer">
                 <div class="peer-checked:bg-yellow-500 peer-checked:text-white border px-4 py-2 rounded cursor-pointer hover:bg-yellow-100">
                    無線網路與商務設施
                 </div>
             </label>
             <label>
                 <input type="radio" name="question2-2" value="休閒設施" class="hidden peer">
                 <div class="peer-checked:bg-yellow-500 peer-checked:text-white border px-4 py-2 rounded cursor-pointer hover:bg-yellow-100">
                    游泳池、健身房等休閒設施
                 </div>
             </label>
             <label>
                 <input type="radio" name="question2-2" value="寵物友善" class="hidden peer">
                 <div class="peer-checked:bg-yellow-500 peer-checked:text-white border px-4 py-2 rounded cursor-pointer hover:bg-yellow-100">
                    寵物友善
                 </div>
             </label>
             <label>
                <input type="radio" name="question2-2" value="便捷位置" class="hidden peer">
                <div class="peer-checked:bg-yellow-500 peer-checked:text-white border px-4 py-2 rounded cursor-pointer hover:bg-yellow-100">
                    靠近景點或市中心的便捷位置
                </div>
            </label>
         </div>
    </div>
    {{-- Q2-3 --}}
    <div class="bg-gray-100 mt-4 shadow-md rounded-lg p-6">
        <h3 class="text-lg font-medium mb-4">2-3. 您的預算範圍？</h3>
        <div class="flex gap-4">
            <label>
                <input type="radio" name="question2-3" value="$2000" class="hidden peer">
                <div class="peer-checked:bg-yellow-500 peer-checked:text-white border px-4 py-2 rounded cursor-pointer hover:bg-yellow-100">
                    每晚低於 $2000
                </div>
            </label>
            <label>
                <input type="radio" name="question2-3" value="$3000" class="hidden peer">
                <div class="peer-checked:bg-yellow-500 peer-checked:text-white border px-4 py-2 rounded cursor-pointer hover:bg-yellow-100">
                    每晚介於 $2000-$3000
                </div>
            </label>
            <label>
                <input type="radio" name="question2-3" value="$4000" class="hidden peer">
                <div class="peer-checked:bg-yellow-500 peer-checked:text-white border px-4 py-2 rounded cursor-pointer hover:bg-yellow-100">
                    每晚介於 $3000-$4000
                </div>
            </label>
            <label>
                <input type="radio" name="question2-3" value="$5000" class="hidden peer">
                <div class="peer-checked:bg-yellow-500 peer-checked:text-white border px-4 py-2 rounded cursor-pointer hover:bg-yellow-100">
                    每晚高於 $4000
                </div>
            </label>
        </div>
    </div>
</section>
