@extends('layouts.app')
<!-- layoutsapp.blade.phpを参照 -->

@section('title', '天気予報API - 整形表示')

@section('content')
    <div class="container">
        <h1>天気予報API - 整形表示</h1>
        <p class="text-muted">地域ID: {{ $cityId ?? '400040' }}</p>
        
        @if(isset($error))
            <div class="alert alert-danger">
                <h4>エラーが発生しました</h4>
                <p>{{ $error }}</p>
            </div>
        @else
            <!-- 基本情報 -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3>基本情報</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>タイトル:</strong> {{ $weatherData['title'] }}</p>
                            <p><strong>公開時間:</strong> {{ $weatherData['publicTimeFormatted'] }}</p>
                            <p><strong>発表機関:</strong> {{ $weatherData['publishingOffice'] }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>地域:</strong> {{ $weatherData['location']['area'] }} > {{ $weatherData['location']['prefecture'] }} > {{ $weatherData['location']['district'] }} > {{ $weatherData['location']['city'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 天気概況 -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3>天気概況</h3>
                </div>
                <div class="card-body">
                    <p>{{ $weatherData['description']['text'] }}</p>
                </div>
            </div>

            <!-- 天気予報 -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3>3日間の天気予報</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($weatherData['forecasts'] as $forecast)
                            <div class="col-md-4 mb-3">
                                <div class="card h-100">
                                    <div class="card-header text-center">
                                        <h5>{{ $forecast['dateLabel'] }}</h5>
                                        <small>{{ $forecast['date'] }}</small>
                                    </div>
                                    <div class="card-body text-center">
                                        <!-- 天気アイコン -->
                                        <img src="{{ $forecast['image']['url'] }}" 
                                             alt="{{ $forecast['image']['title'] }}" 
                                             class="mb-2">
                                        
                                        <!-- 天気 -->
                                        <h6 class="card-title">{{ $forecast['telop'] }}</h6>
                                        
                                        <!-- 気温 -->
                                        <div class="mb-2">
                                            @if($forecast['temperature']['max']['celsius'])
                                                <span class="badge bg-danger">最高 {{ $forecast['temperature']['max']['celsius'] }}°C</span>
                                            @endif
                                            @if($forecast['temperature']['min']['celsius'])
                                                <span class="badge bg-primary">最低 {{ $forecast['temperature']['min']['celsius'] }}°C</span>
                                            @endif
                                        </div>
                                        
                                        <!-- 降水確率 -->
                                        <div class="mb-2">
                                            <small class="text-muted">降水確率</small><br>
                                            @foreach($forecast['chanceOfRain'] as $time => $chance)
                                                @if($chance !== '--%')
                                                    <span class="badge bg-info me-1">{{ $time }}: {{ $chance }}</span>
                                                @endif
                                            @endforeach
                                        </div>
                                        
                                        <!-- 詳細 -->
                                        <div class="text-start">
                                            <small class="text-muted">
                                                <strong>天気:</strong> {{ $forecast['detail']['weather'] }}<br>
                                                <strong>風:</strong> {{ $forecast['detail']['wind'] }}<br>
                                                <strong>波:</strong> {{ $forecast['detail']['wave'] }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- 生のJSONデータ -->
            <div class="card">
                <div class="card-header">
                    <h3>生のJSONデータ</h3>
                </div>
                <div class="card-body">
                    <pre class="bg-light p-3" style="max-height: 400px; overflow-y: auto;"><code>{{ $rawJson }}</code></pre>
                </div>
            </div>

            <!-- リンク -->
            <div class="mt-4">
                <a href="{{ $weatherData['link'] }}" target="_blank" class="btn btn-outline-primary">
                    気象庁公式サイトで確認
                </a>
                <a href="/api-test" class="btn btn-outline-secondary">
                    生のJSONデータを表示
                </a>
            </div>

            <!-- 地域選択フォーム -->
            <div class="card mt-4">
                <div class="card-header">
                    <h4>他の地域の天気を確認</h4>
                </div>
                <div class="card-body">
                    <form method="GET" action="/api-out">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="cityId" class="form-label">地域ID</label>
                                <input type="text" class="form-control" id="cityId" name="id" 
                                       value="{{ $cityId ?? '400040' }}" 
                                       placeholder="例: 130010 (東京), 270000 (大阪)">
                                <div class="form-text">
                                    主要都市のID例: 130010(東京), 270000(大阪), 400040(福岡久留米), 016010(札幌)
                                </div>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">天気を取得</button>
                            </div>
                        </div>
                    </form>
                    
                    <!-- 主要都市ボタン -->
                    <div class="mt-3">
                        <label class="form-label">主要都市を選択:</label>
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setCityId('130010')">東京</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setCityId('270000')">大阪</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setCityId('400040')">福岡久留米</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setCityId('016010')">札幌</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setCityId('230010')">名古屋</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setCityId('380010')">高松</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setCityId('460010')">鹿児島</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <style>
        .card {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .badge {
            font-size: 0.8em;
        }
        pre {
            font-size: 0.9em;
            border-radius: 0.375rem;
        }
        .gap-2 {
            gap: 0.5rem;
        }
    </style>

    <script>
        function setCityId(cityId) {
            document.getElementById('cityId').value = cityId;
        }
    </script>
@endsection
