<?php

namespace App\Http\Controllers;

use App\Models\UserPreference;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        // 假設使用者已經登入
        $user = Auth::user();

        // 取得使用者的偏好設定 (pref1 至 pref8)
        $preferences = UserPreference::where('user_id', $user->id)->first();

        // Get the prompt based on the request type
        // $prompt = $this->getPrompt($request->type, $request->pref, $request->day, $request->people, $request->custom);
        $attraction1 = $preferences->pref1 ?? "未選擇";
        $attraction2 = $preferences->pref2 ?? "未選擇";
        $attraction3 = $preferences->pref3 ?? "未選擇";
        $attractionPref = '旅遊類型: ' . $attraction1 . ', 活動強度: ' . $attraction2 . ', 旅遊主題: ' . $attraction3;

        $accommodation1 = $preferences->pref4 ?? "未選擇";
        $accommodation2 = $preferences->pref5 ?? "未選擇";
        $accommodation3 = $preferences->pref6 ?? "未選擇";
        $accommodationPref = '住宿類型: ' . $accommodation1 . ', 住宿設施: ' . $accommodation2 . ', 預算範圍: ' . $accommodation3;

        $diet = $preferences->pref7 ?? "未選擇";
        $transportation = $preferences->pref8 ?? "未選擇";
        $date = now()->toDateString();

        $prompt = $this->getPrompt($attractionPref, $accommodationPref, $diet, $transportation, $date); // Hardcoded for now

        /*
        if($prompt == "error") {
            // Return an error message if the type is invalid
            return response()->json(['message' => 'System error.']);
        }
        */

        // Call the OpenAI API with the prompt
        $chatResponse = $this->callOpenAI($prompt);

        // Return the response as JSON
        // return response()->json(['message' => $chatResponse]);

        // make json to html
        $html = $this->jsontoHTML($chatResponse);

        // return html
        return response()->json(['message' => $html, 'itinerary_json' => $chatResponse]);
    }

    /**
     * Generate the prompt based on the request type.
     *
     * @param string $type
     * @return string
     */
    private function getPrompt(string $attractionPref, string $accommodationPref, string $diet, string $tranportation, string $date): string
    {
        /*柚子原prompt
        $prompt = "你現在是旅行社員工，要協助規劃外國人來台北的旅遊行程
                    請依據下列內容規劃
                    1. 這個客人的偏好是 $pref
                    2. 行程為期 $day 天
                    3. 根據日期為平日 or 假日推薦合適的行程
                    4. 人數有 $people 人
                    5. 請列出時間、地點、介紹
                    6. 景點與景點間的交通也要安排 公車或客運請明確說明路線名稱
                    7. 晚上住宿也要安排，以住在同間旅館為優先
                    8. 以 json 格式輸出";
        */
        $prompt = "你現在是旅行社員工，要協助規劃外國人來台北的旅遊行程。根據以下要求，生成包含三餐、交通、景點和旅館的合理行程，並且時間順序要符合邏輯：
                    1. 客人的景點偏好是 $attractionPref
                    2. 客人的住宿偏好是 $accommodationPref
                    3. 客人的飲食偏好是 $diet
                    4. 客人偏好的交通方式是 $tranportation
                    5. 每個行程項目應該包括 `journey_id`,`date`(YYYY-MM-DD),`sequence`,`type`（景點、餐廳、交通、旅館）,`name`,`introduction`,`time`,`price`
                    6. 重要規定：請用JSON格式生成，內容可以自行調整不需依照範例，行程天數2日1日3日隨機，行程內容請用中文，今天日期是 $date ，時間安排要在地點的開放時間，餐廳、景點必須真實存在不可憑空杜撰，價格要是明確的數字，景點名稱用 zh_tw 輸出

                    行程格式範例：
                    [
                        {\"journey_id\": 1, \"date\": \"今天日期\", \"sequence\": 1, \"type\": \"餐廳\", \"name\": \"\", \"introduction\": \"\", \"time\": \"08:00:00\", \"price\": },
                        {\"journey_id\": 1, \"date\": \"今天日期\", \"sequence\": 2, \"type\": \"景點\", \"name\": \"\", \"introduction\": \"\", \"time\": \"09:00:00\", \"price\": },
                        {\"journey_id\": 1, \"date\": \"今天日期\", \"sequence\": 3, \"type\": \"餐廳\", \"name\": \"\", \"introduction\": \"\", \"time\": \"12:00:00\", \"price\": },
                        {\"journey_id\": 1, \"date\": \"今天日期\", \"sequence\": 4, \"type\": \"交通\", \"name\": \"\", \"introduction\": \"\", \"time\": \"13:30:00\", \"price\": },
                        {\"journey_id\": 1, \"date\": \"今天日期\", \"sequence\": 5, \"type\": \"景點\", \"name\": \"\", \"introduction\": \"\", \"time\": \"14:00:00\", \"price\": },
                        {\"journey_id\": 1, \"date\": \"今天日期\", \"sequence\": 6, \"type\": \"餐廳\", \"name\": \"\", \"introduction\": \"\", \"time\": \"18:00:00\", \"price\": },
                        {\"journey_id\": 1, \"date\": \"今天日期\", \"sequence\": 7, \"type\": \"旅館\", \"name\": \"\", \"introduction\": \"\", \"time\": \"21:00:00\", \"price\": },
                        {\"journey_id\": 1, \"date\": \"隔天日期\", \"sequence\": 8, \"type\": \"餐廳\", \"name\": \"\", \"introduction\": \"\", \"time\": \"08:00:00\", \"price\": },
                        {\"journey_id\": 1, \"date\": \"隔天日期\", \"sequence\": 9, \"type\": \"景點\", \"name\": \"\", \"introduction\": \"\", \"time\": \"09:00:00\", \"price\": },
                        {\"journey_id\": 1, \"date\": \"隔天日期\", \"sequence\": 10, \"type\": \"餐廳\", \"name\": \"\", \"introduction\": \"\", \"time\": \"12:00:00\", \"price\": },
                        {\"journey_id\": 1, \"date\": \"隔天日期\", \"sequence\": 11, \"type\": \"交通\", \"name\": \"\", \"introduction\": \"\", \"time\": \"13:30:00\", \"price\": },
                        {\"journey_id\": 1, \"date\": \"隔天日期\", \"sequence\": 12, \"type\": \"景點\", \"name\": \"\", \"introduction\": \"\", \"time\": \"14:00:00\", \"price\": },
                        {\"journey_id\": 1, \"date\": \"隔天日期\", \"sequence\": 13, \"type\": \"餐廳\", \"name\": \"\", \"introduction\": \"\", \"time\": \"18:00:00\", \"price\": },
                        {\"journey_id\": 1, \"date\": \"隔天日期\", \"sequence\": 14, \"type\": \"旅館\", \"name\": \"\", \"introduction\": \"\", \"time\": \"21:00:00\", \"price\": }
                    ]";

        /*$prompt = "你現在是旅行社員工，要協助規劃外國人來台北的旅遊行程。根據以下要求，生成包含三餐、交通、景點和旅館的合理行程，並且時間順序要符合邏輯：
                    1. 客人的景點偏好是 $attractionPref
                    2. 客人的住宿偏好是 $accommodationPref
                    3. 客人的飲食偏好是 $diet
                    4. 客人偏好的交通方式是 $tranportation
                    5. 每個行程項目應該包括 `journey_id`,`date`(YYYY-MM-DD),`sequence`,`type`（景點、餐廳、交通、旅館）,`name`,`introduction`,`time`,`price`
                    6. 重要規定：請用 HTML Table 生成，內容可以自行調整不需依照範例，行程天數2日1日3日隨機，行程內容請用中文，今天日期是 $date ，時間安排要在地點的開放時間，餐廳、景點必須真實存在不可憑空杜撰
                    7. 格式請直接輸出 HTML table 即可，範例: <table><tr><td></td></tr></table> 即可";*/


        Log::info('Prompt value: ' . $prompt);
        return $prompt;


        /*柚子原code
        if ($type == "oneClick") {
            return $prompt;
        }
        else if ($type == "DIY") {
            $prompt = $prompt . "9. 這個客人的特殊需求是 $custom";
            return $prompt;
        }
        else {
            return "error";
        }
        */
    }

    //修改行程
    public function updateItinerary(Request $request)
    {
        // 結合原始行程和使用者的修改內容生成新 prompt
        $original = $request->input('original');
        $modification = $request->input('modification');

        $combinedPrompt = "以下是原本的行程：". $original . " 請一定要根據以下使用者的修改需求:「" . $modification . "」修改原本的行程內容。景點名稱中文優先 非必要不要輸出英文。並以JSON格式生成！";
        Log::info('combinedPrompt value: ' . $combinedPrompt);

        // 呼叫 ChatGPT API
        $chatResponse = $this->callOpenAI($combinedPrompt);

        // make json to html
        $html = $this->jsontoHTML($chatResponse);

        // 取得生成結果
        return response()->json(['message' => $html, 'itinerary_json' => $chatResponse]);
    }

    // public function jsontoHTML(string $chatResponse): string
    // {
    //     $json = json_decode($chatResponse, true);

    //     $html = "<table class='table table-bordered'>
    //         <thead>
    //             <tr>
    //                 <th>日期</th>
    //                 <th>順序</th>
    //                 <th>類型</th>
    //                 <th>名稱</th>
    //                 <th>介紹</th>
    //                 <th>時間</th>
    //                 <th>價格</th>
    //             </tr>
    //         </thead>
    //         <tbody>";

    //         // 遍歷 JSON 數據並生成表格行
    //         foreach ($json as $row) {
    //             $html .= '<tr align="center">';
    //             $html .= '<td>' . htmlspecialchars($row['date'] ?? '') . '</td>';
    //             $html .= '<td>' . htmlspecialchars($row['sequence'] ?? '') . '</td>';
    //             $html .= '<td>' . htmlspecialchars($row['type'] ?? '') . '</td>';
    //             $html .= '<td>' . htmlspecialchars($row['name'] ?? '') . '</td>';
    //             $html .= '<td>' . htmlspecialchars($row['introduction'] ?? '') . '</td>';
    //             $html .= '<td>' . htmlspecialchars($row['time'] ?? '') . '</td>';
    //             $html .= '<td>' . htmlspecialchars($row['price'] ?? '') . '</td>';
    //             $html .= '</tr>';
    //         }

    //         // 結束表格和 HTML 文檔
    //         $html .= "</tbody>
    //         </table>";


    //     return $html;
    // }
    public function jsontoHTML(string $chatResponse): string
{
    $json = json_decode($chatResponse, true);

    $style = "
    <style>
        table.custom-table {
            width: 100%;
            border-collapse: collapse;
        }
        table.custom-table th, table.custom-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        table.custom-table th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
        }
        table.custom-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table.custom-table tr:hover {
            background-color: #f1f1f1;
        }
        table.custom-table td {
            text-align: center;
        }
    </style>
    ";

    $html = $style . "<table class='custom-table'>
        <thead>
            <tr>
                <th>日期</th>
                <th>順序</th>
                <th>類型</th>
                <th>名稱</th>
                <th>介紹</th>
                <th>時間</th>
                <th>價格</th>
            </tr>
        </thead>
        <tbody>";

    foreach ($json as $row) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['date'] ?? '') . '</td>';
        $html .= '<td>' . htmlspecialchars($row['sequence'] ?? '') . '</td>';
        $html .= '<td>' . htmlspecialchars($row['type'] ?? '') . '</td>';
        $html .= '<td>' . htmlspecialchars($row['name'] ?? '') . '</td>';
        $html .= '<td>' . htmlspecialchars($row['introduction'] ?? '') . '</td>';
        $html .= '<td>' . htmlspecialchars($row['time'] ?? '') . '</td>';
        $html .= '<td>' . htmlspecialchars($row['price'] ?? '') . '</td>';
        $html .= '</tr>';
    }

            // 結束表格和 HTML 文檔
            $html .= "</tbody>
            </table>";


    return $html;
}



    /**
     * Call the OpenAI API with a given prompt.
     *
     * @param string $prompt
     * @return string
     */

     /*柚子原function
    private function callOpenAI(string $prompt): string
    {
        $apiKey = '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'; // 確保 .env 文件已正確配置並加載; // Fetch the API key from .env

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $apiKey,
        ])->post('https://api.openai.com/v1/embeddings', [
            'model' => 'text-embedding-3-small',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'Say this is a test!',
                ],
            ],
            'temperature' => 0.7,
        ]);

        $data = $response->json();


        dd($response);

        return $response->json()['choices'][0]['text'] ?? 'Sorry, I could not understand that.';
    }
        */
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
            "max_tokens" => 4096,
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
