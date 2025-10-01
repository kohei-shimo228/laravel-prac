@extends('layouts.app')
<!-- layouts/app.blade.phpを参照 -->

@section('title', 'Hello Laravel')

@section('content')
    <!-- メインコンテンツ -->
    <div class="mb-4">
        <h1>Hello Laravel</h1>
        <p>Laravelのデフォのビューが表示されているよ</p>
        <p>このビューはapp/Http/Controllers/WelcomeController.phpから呼び出されているよ</p>
        <p>このビューはresources/views/hello.blade.phpにあるよ</p>
    </div>

    <!-- ルート統計情報 -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="text-primary mb-1">{{ $routes->count() }}</h4>
                    <small class="text-muted">総ルート数</small>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="text-success mb-1">{{ $routes->where('uri', '!=', '/')->count() }}</h4>
                    <small class="text-muted">アプリルート</small>
                </div>
            </div>
        </div>
    </div>

    <!-- アプリケーションルート一覧 -->
    <div class="card mb-4">
        <div class="card-header">
            <h4 class="card-title mb-0">
                <i class="bi bi-link-45deg me-2"></i>
                アプリケーションルート一覧
            </h4>
            <p class="card-text text-muted small mb-0 mt-2">
                現在登録されているルートを動的に取得して表示しています
            </p>
        </div>
        <div class="card-body">
            @if($routes->count() > 0)
                <div class="row">
                    @foreach($routes as $route)
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-start mb-2">
                                        <i class="bi bi-arrow-right-circle text-primary me-2 mt-1"></i>
                                        <div class="flex-grow-1">
                                            <h6 class="card-title mb-1">
                                                <a href="{{ $route['url'] }}" class="text-decoration-none text-dark">
                                                    {{ $route['display_name'] ?? '不明' }}
                                                </a>
                                            </h6>
                                            <small class="text-muted d-block">{{ $route['uri'] ?? '' }}</small>
                                        </div>
                                    </div>
                                    <p class="card-text small text-info mb-2">
                                        {{ $route['description'] ?? '説明なし' }}
                                    </p>
                                    <a href="{{ $route['url'] }}" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-box-arrow-up-right me-1"></i>
                                        アクセス
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted text-center py-4">表示可能なルートがありません</p>
            @endif
        </div>
    </div>

    <!-- 詳細なルート情報 -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="bi bi-gear me-2"></i>
                ルート詳細情報
            </h5>
        </div>
        <div class="card-body">
            <div class="accordion" id="routeDetailsAccordion">
                @foreach($routes as $index => $route)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button collapsed" type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#collapse{{ $index }}" 
                                    aria-expanded="false" 
                                    aria-controls="collapse{{ $index }}">
                                <small class="me-2">{{ $route['uri'] ?? '' }}</small>
                                <span class="badge bg-secondary ms-auto">{{ $route['display_name'] ?? '不明' }}</span>
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" 
                             class="accordion-collapse collapse" 
                             aria-labelledby="heading{{ $index }}" 
                             data-bs-parent="#routeDetailsAccordion">
                            <div class="accordion-body">
                                <dl class="row mb-0">
                                    <dt class="col-sm-3">URI:</dt>
                                    <dd class="col-sm-9"><code>{{ $route['uri'] ?? '' }}</code></dd>
                                    
                                    <dt class="col-sm-3">URL:</dt>
                                    <dd class="col-sm-9">
                                        <a href="{{ $route['url'] ?? '#' }}" class="text-decoration-none">
                                            {{ $route['url'] ?? '' }}
                                        </a>
                                    </dd>
                                    
                                    @if($route['name'] ?? null)
                                    <dt class="col-sm-3">ルート名:</dt>
                                    <dd class="col-sm-9"><code>{{ $route['name'] }}</code></dd>
                                    @endif
                                    
                                    @if($route['controller'] ?? null)
                                    <dt class="col-sm-3">コントローラー:</dt>
                                    <dd class="col-sm-9"><code>{{ $route['controller'] }}</code></dd>
                                    @endif
                                    
                                    @if($route['action'] ?? null)
                                    <dt class="col-sm-3">アクション:</dt>
                                    <dd class="col-sm-9"><code>{{ $route['action'] }}</code></dd>
                                    @elseif($route['is_closure'] ?? false)
                                    <dt class="col-sm-3">アクション:</dt>
                                    <dd class="col-sm-9"><code>クロージャ関数</code></dd>
                                    @endif
                                    
                                    <dt class="col-sm-3">説明:</dt>
                                    <dd class="col-sm-9">{{ $route['description'] ?? '説明なし' }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection