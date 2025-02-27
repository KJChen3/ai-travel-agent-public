<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journey;
use App\Models\JourneyDetail;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;

class JourneyController extends Controller
{
    // 儲存行程
    public function store(Request $request)
    {
        $title = '台北行程';

        $journeyData = $request->input('journeyData');

        DB::beginTransaction(); // 開始交易

        try {
            // 儲存 Journey (行程基本資訊)
            $journey = Journey::create([
                'title' => $title,
                'status' => 0
            ]);

            // 儲存 Journey Details (行程詳細資訊)
            foreach ($journeyData as $detail) {
                JourneyDetail::create([
                    'journey_id' => $journey->id,
                    'date' => $detail['date'],
                    'sequence' => $detail['sequence'],
                    'type' => $detail['type'],
                    'name' => $detail['name'],
                    'introduction' => $detail['introduction'],
                    'time' => $detail['time'],
                    'price' => $detail['price']
                ]);
            }

            DB::commit(); // 提交交易
            return response()->json(['message' => '已成功收藏！'], 201);
        } catch (\Exception $e) {
            DB::rollBack(); // 回滾交易
            return response()->json(['message' => '儲存失敗'], 500);
        }
    }

    //顯示所有收藏行程
    public function showSavedJourneys(Request $request)
    {
        // 取得所有行程和其相關的詳細資訊
        // $journeys = Journey::with('details')->get();
        $journeys = JourneyDetail::all();

        // make json into html table
        $html = $this->jsontoHTML($journeys);

        // 回傳 HTML 格式的資料
        return response()->json(['message' => $html]);


        // 回傳 JSON 格式的資料
        //return response()->json($journeys);
    }

    public function jsontoHTML($journeys): string
    {
        $html = "<table border='1' cellspacing='0' cellpadding='8' style='border-collapse: collapse; width: 100%;'>
                    <thead>
                        <tr class='bg-gray-100 text-gray-700'>
                            <th class='border px-4 py-2'>日期</th>
                            <th class='border px-4 py-2'>順序</th>
                            <th class='border px-4 py-2'>類型</th>
                            <th class='border px-4 py-2'>名稱</th>
                            <th class='border px-4 py-2'>介紹</th>
                            <th class='border px-4 py-2'>時間</th>
                            <th class='border px-4 py-2'>價格</th>
                        </tr>
                    </thead>
                    <tbody>";

        foreach ($journeys as $journey) {
            $html .= "<tr class='hover:bg-gray-50 text-center'>";
            $html .= '<td class="border px-4 py-2">' . htmlspecialchars($journey['date'] ?? '') . '</td>';
            $html .= '<td class="border px-4 py-2">' . htmlspecialchars($journey['sequence'] ?? '') . '</td>';
            $html .= '<td class="border px-4 py-2">' . htmlspecialchars($journey['type'] ?? '') . '</td>';
            $html .= '<td class="border px-4 py-2">' . htmlspecialchars($journey['name'] ?? '') . '</td>';
            $html .= '<td class="border px-4 py-2">' . htmlspecialchars($journey['introduction'] ?? '') . '</td>';
            $html .= '<td class="border px-4 py-2">' . htmlspecialchars($journey['time'] ?? '') . '</td>';
            $html .= '<td class="border px-4 py-2">' . htmlspecialchars($journey['price'] ?? '') . '</td>';
            $html .= '</tr>';
        }

        $html .= "</tbody></table>";

        return $html;
    }
}
