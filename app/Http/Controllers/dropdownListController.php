<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

use App\Models\UserPreference; 

class dropdownListController extends Controller
{
    //拿下拉式選單選項生成
    public function submitSelectionChat(Request $request)
    {
        $selection1 = $request->input('selection1');
        $selection2 = $request->input('selection2');
        $date = $request->input('date');

        // 假設使用者已經登入
        $user = Auth::user();

        // 取得使用者的偏好設定 (pref1 至 pref8)
        $preferences = UserPreference::where('user_id', $user->id)->first();

        // Get the prompt based on the request type
        // $prompt = $this->getPrompt($request->type, $request->pref, $request->day, $request->people, $request->custom);
        $attraction1 = $preferences->pref1 ?? "未選擇";
        $attraction2 = $preferences->pref2 ?? "未選擇";
        $attraction3 = $preferences->pref3 ?? "未選擇";
        $attractionPref = '旅遊類型: ' . $attraction1 . ', 活動強度: ' . $attraction2 . ', 旅遊主題: ' . $selection2;

        $accommodation1 = $preferences->pref4 ?? "未選擇";
        $accommodation2 = $preferences->pref5 ?? "未選擇";
        $accommodation3 = $preferences->pref6 ?? "未選擇";
        $accommodationPref = '住宿類型: ' . $accommodation1 . ', 住宿設施: ' . $accommodation2 . ', 預算範圍: ' . $accommodation3;

        $diet = $preferences->pref7 ?? "未選擇";
        $transportation = $preferences->pref8 ?? "未選擇";

        $prompt = $this->getPrompt($selection1, $attractionPref, $accommodationPref, $diet, $transportation, $date);

        // Call the OpenAI API with the prompt
        $chatResponse = $this->callOpenAI($prompt);

        // make json to html
        $html = $this->jsontoHTML($chatResponse);

        // return html
        return response()->json(['message' => $html]);

        // 返回給前端
        // return response()->json(['message' => $chatResponse]);
    }

    // I know that copy-paste programming is not ideal in software engineering.
    // but we are running out of time
    public function jsontoHTML(string $chatResponse): string
    {
        $json = json_decode($chatResponse, true);

        $html = '<table border="1" cellspacing="0" cellpadding="8" style="border-collapse: collapse; width: 100%;">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                    <th class="border px-4 py-2">日期</th>
                    <th class="border px-4 py-2">順序</th>
                    <th class="border px-4 py-2">類型</th>
                    <th class="border px-4 py-2">名稱</th>
                    <th class="border px-4 py-2">介紹</th>
                    <th class="border px-4 py-2">時間</th>
                    <th class="border px-4 py-2">價格</th>
            </tr>
            </thead>
            <tbody>';

            // 遍歷 JSON 數據並生成表格行
            foreach ($json as $row) {
                $html .= ' <tr class="hover:bg-gray-50 text-center">';
                $html .= '<td class="border px-4 py-2">' . htmlspecialchars($row['date'] ?? '') . '</td>';
                $html .= '<td class="border px-4 py-2">' . htmlspecialchars($row['sequence'] ?? '') . '</td>';
                $html .= '<td class="border px-4 py-2">' . htmlspecialchars($row['type'] ?? '') . '</td>';
                $html .= '<td class="border px-4 py-2">' . htmlspecialchars($row['name'] ?? '') . '</td>';
                $html .= '<td class="border px-4 py-2">' . htmlspecialchars($row['introduction'] ?? '') . '</td>';
                $html .= '<td class="border px-4 py-2">' . htmlspecialchars($row['time'] ?? '') . '</td>';
                $html .= '<td class="border px-4 py-2">' . htmlspecialchars($row['price'] ?? '') . '</td>';
                $html .= '</tr>';
            }

        // 結束表格和 HTML 文檔
        $html .= "</tbody>
        </table>";


        return $html;
    }

    /*prompt及生成行程*/
    private function getPrompt($selection1, $attractionPref, $accommodationPref, $diet, $transportation, $date)
    {
        $prompt = "你現在是旅行社員工，請協助規劃來台北的一日遊行程。根據以下要求，生成包含三餐、交通、景點和旅館的合理行程，並且時間順序要符合邏輯：
        1. 行程中必須包括指定的 $selection1 (景點)，並且這個景點應該只在開放時間內安排
        2. 行程需要根據指定的 $accommodationPref 、 $diet 、 $transportation 、 $date (住宿、飲食、交通方式、日期）進行調整，以確保符合要求
        3. 每個行程項目應該包括 `journey_id`,`date`(YYYY-MM-DD),`sequence`,`type`（景點、餐廳、交通、旅館）,`name`,`introduction`,`time`,`price`
        4. 請用JSON格式生成，行程內容請用中文

        行程格式範例(內容可以自行調整，不需依照範例)：
        [
            {\"journey_id\": 1, \"date\": \"2024-12-01\", \"sequence\": 1, \"type\": \"餐廳\", \"name\": \"阜杭豆漿\", \"introduction\": \"早上享用當地特色早餐，提供美味的豆漿與小籠包。\", \"time\": \"08:00:00\", \"price\": 50},
            {\"journey_id\": 1, \"date\": \"2024-12-01\", \"sequence\": 2, \"type\": \"景點\", \"name\": \"$selection1\", \"introduction\": \"這是客人指定的景點，推薦參觀。\", \"time\": \"09:00:00\", \"price\": 600},
            {\"journey_id\": 1, \"date\": \"2024-12-01\", \"sequence\": 3, \"type\": \"餐廳\", \"name\": \"鼎泰豐\", \"introduction\": \"著名的小籠包餐廳，提供美味的中式料理。\", \"time\": \"12:00:00\", \"price\": 400},
            {\"journey_id\": 1, \"date\": \"2024-12-01\", \"sequence\": 4, \"type\": \"交通\", \"name\": \"台北捷運\", \"introduction\": \"搭乘捷運前往下一個景點。\", \"time\": \"13:30:00\", \"price\": 30},
            {\"journey_id\": 1, \"date\": \"2024-12-01\", \"sequence\": 5, \"type\": \"景點\", \"name\": \"故宮博物院\", \"introduction\": \"故宮博物院擁有豐富的中國文物收藏。\", \"time\": \"14:00:00\", \"price\": 350},
            {\"journey_id\": 1, \"date\": \"2024-12-01\", \"sequence\": 6, \"type\": \"餐廳\", \"name\": \"富錦樹餐廳\", \"introduction\": \"提供台灣特色料理的餐廳，特別以海鮮聞名。\", \"time\": \"18:00:00\", \"price\": 500},
            {\"journey_id\": 1, \"date\": \"2024-12-01\", \"sequence\": 7, \"type\": \"旅館\", \"name\": \"台北喜來登大飯店\", \"introduction\": \"提供舒適住宿的高檔酒店，適合休息放鬆。\", \"time\": \"21:00:00\", \"price\": 3000}
        ]";

    
        
        return $prompt;
    }



    /*Call the OpenAI API with a given prompt.*/
    private function callOpenAI(string $prompt): string
{
    $apiKey = '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'; // 確保 .env 文件已正確配置並加載

    // 準備數據，並轉為 JSON 格式
    $data = json_encode([
        "model" => "gpt-3.5-turbo",
        "messages" => [
            [
                "role" => "user",
                "content" => $prompt,
            ]
        ],
        "max_tokens" => 1000,
        "temperature" => 0.7
    ]);

    // 使用 Http 類進行 API 請求
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . $apiKey,
    ])->withBody($data, 'application/json')
      ->post('https://api.openai.com/v1/chat/completions');

    // 檢查回應並返回處理結果
    if ($response->successful()) {
        return $response->json()['choices'][0]['message']['content'] ?? 'Sorry, no response generated.';
    } else {
        // 處理錯誤
        $error = $response->json();
        return "Error: {$error['error']['message']}";
    }
}

}
