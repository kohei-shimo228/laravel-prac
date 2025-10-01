<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- 追加のCSSファイル -->
    @stack('styles')
</head>
<body>
    <header class="bg-primary text-white py-3 mb-4">
        <div class="container">
            <a href="/" class="text-white text-decoration-none">
                <h1 class="h3 mb-0">Laravel Practice</h1>
            </a>
        </div>
    </header>
    
    <main class="container">
        @yield('content')
    </main>
    
    <!-- カラーモード切り替えボタン（テンプレート化済み） -->
    @if(config('app.color_mode_toggle', true))
        <button id="color-mode-toggle" class="btn btn-outline-secondary dark-mode-toggle" type="button" aria-label="カラーモード切り替え" title="ダークモードに切り替え">
            <i class="bi bi-moon"></i>
        </button>
    @endif
    
    <footer class="py-3 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 Laravel Practice</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- 
    カラーモード切り替え機能（テンプレート化済み）
    
    使用方法:
    1. 自動で有効化されます（config/app.php の color_mode_toggle で制御可能）
    2. 他のスクリプトでカラーモード変更を監視:
       window.addEventListener('colorModeChanged', (event) => {
           console.log('Color mode changed to:', event.detail.mode);
       });
    3. 無効化する場合: .env に COLOR_MODE_TOGGLE=false を設定
    -->
    <script>
        (function() {
            'use strict';
            
            // カラーモード管理クラス
            class ColorModeManager {
                constructor() {
                    this.init();
                }

                init() {
                    this.setInitialMode();
                    this.setupToggleButton();
                    this.watchSystemPreference();
                }

                setInitialMode() {
                    const savedMode = localStorage.getItem('colorMode');
                    const systemPrefersDark = window.matchMedia && 
                        window.matchMedia('(prefers-color-scheme: dark)').matches;
                    
                    const mode = savedMode || (systemPrefersDark ? 'dark' : 'light');
                    this.setMode(mode);
                }

                setupToggleButton() {
                    const toggleButton = document.getElementById('color-mode-toggle');
                    if (toggleButton) {
                        toggleButton.addEventListener('click', () => this.toggleMode());
                    }
                }

                watchSystemPreference() {
                    if (window.matchMedia) {
                        const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
                        mediaQuery.addListener((e) => {
                            // ユーザーが手動で設定していない場合のみシステム設定に従う
                            if (!localStorage.getItem('colorMode')) {
                                this.setMode(e.matches ? 'dark' : 'light');
                            }
                        });
                    }
                }

                toggleMode() {
                    const currentMode = document.documentElement.getAttribute('data-bs-theme') || 'light';
                    const newMode = currentMode === 'dark' ? 'light' : 'dark';
                    this.setMode(newMode);
                }

                setMode(mode) {
                    document.documentElement.setAttribute('data-bs-theme', mode);
                    localStorage.setItem('colorMode', mode);
                    this.updateToggleButton(mode);
                    this.dispatchChangeEvent(mode);
                }

                updateToggleButton(mode) {
                    const toggleButton = document.getElementById('color-mode-toggle');
                    if (toggleButton) {
                        const icon = toggleButton.querySelector('i');
                        if (icon) {
                            icon.className = mode === 'dark' ? 'bi bi-sun' : 'bi bi-moon';
                        }
                        
                        // ボタンのツールチップも更新
                        toggleButton.setAttribute('title', 
                            mode === 'dark' ? 'ライトモードに切り替え' : 'ダークモードに切り替え'
                        );
                    }
                }

                dispatchChangeEvent(mode) {
                    // カスタムイベントを発火（他のスクリプトで監視可能）
                    window.dispatchEvent(new CustomEvent('colorModeChanged', { 
                        detail: { mode: mode } 
                    }));
                }
            }

            // DOMが読み込まれた後に実行
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', () => new ColorModeManager());
            } else {
                new ColorModeManager();
            }
        })();
    </script>
    
    @stack('scripts')
</body>
</html>