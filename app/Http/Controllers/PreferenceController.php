<?php

namespace App\Http\Controllers;

use App\Models\UserPreference; // 引入模型
use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 獲取當前用戶
        $userId = auth()->id();

        // 檢查用戶是否已有偏好設定
        $existingPreference = UserPreference::where('user_id', $userId)->first();

        if ($existingPreference) {
            // 如果有舊的偏好設定，刪除舊設定
            $existingPreference->delete();
        }

        // 創建新的偏好設定
        UserPreference::create([
            'user_id' => auth()->id(),
            'pref1' => $request->input('question1-1'),
            'pref2' => $request->input('question1-2'),
            'pref3' => $request->input('question1-3'),
            'pref4' => $request->input('question2-1'),
            'pref5' => $request->input('question2-2'),
            'pref6' => $request->input('question2-3'),
            'pref7' => $request->input('question3-1'),
            'pref8' => $request->input('question3-2'),
        ]);

        // 提交成功後的回應
        return redirect()->route('preference.success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function success()
    {
        return view('userPreference.success'); // 返回成功頁面
    }

    public function showUserPreference(Request $request)
    {
        // 使用者已登入
        $user = auth()->user();
        
        // 查詢用戶喜好設定
        $preference = UserPreference::where('user_id', $user->id)->first();

        // 推薦景點
        $recommendations = [
            ['title' => '九份老街', 'price' => 500, 'rate' => 4.5, 'image' => 'Jiufen-1.jpg'],
            ['title' => '台北 101', 'price' => 800, 'rate' => 4.8, 'image' => '101-1.jpg'],
            ['title' => '北投溫泉', 'price' => 1800, 'rate' => 4.6, 'image' => 'Beitou-1.jpg'],
        ];

        return view('dashboard', compact('user', 'preference', 'recommendations'));
    }

}
