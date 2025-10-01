<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function test_out(Request $request)
    {
        $num =$request->query('num');
        
        // numパラメータが指定されていない場合の処理
        if ($num === null) {
            return 'numパラメータが指定されていません。例: /test_out?num=123';
        }else{
            return $num;
        }
    }

    public function apiTest()
    {
        try {
            // 外部APIにアクセス（Laravel HTTPクライアント使用）
            $url = 'https://weather.tsukumijima.net/api/forecast/city/400040';
            
            $response = Http::timeout(10)->get($url);
            
            if ($response->failed()) {
                return 'APIからのデータ取得に失敗しました。ステータス: ' . $response->status();
            }
            
            // 生のJSONデータをそのまま返す
            return response($response->body())
                ->header('Content-Type', 'application/json; charset=utf-8');
                
        } catch (Exception $e) {
            return 'エラーが発生しました: ' . $e->getMessage();
        }
    }

    public function apiOut(Request $request)
    {
        try {
            // パラメータからidを取得（デフォルトは400040：福岡県久留米）
            $cityId = $request->query('id', '400040');
            
            // 外部APIにアクセス
            $url = 'https://weather.tsukumijima.net/api/forecast/city/' . $cityId;
            
            $response = Http::timeout(10)->get($url);
            
            if ($response->failed()) {
                return view('api-out', [
                    'error' => 'APIからのデータ取得に失敗しました。ステータス: ' . $response->status(),
                    'cityId' => $cityId
                ]);
            }
            
            // JSONデータをデコードしてビューに渡す
            $weatherData = $response->json();
            
            return view('api-out', [
                'weatherData' => $weatherData,
                'rawJson' => $response->body(),
                'cityId' => $cityId
            ]);
                
        } catch (Exception $e) {
            return view('api-out', [
                'error' => 'エラーが発生しました: ' . $e->getMessage(),
                'cityId' => $request->query('id', '400040')
            ]);
        }
    }
}
