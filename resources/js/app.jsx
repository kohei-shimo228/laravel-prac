import React from 'react';
import { createRoot } from 'react-dom/client';
import '../css/app.css';

function App() {
    return (
        <div className="container mt-4">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">
                            <h4 className="card-title mb-0">
                                <i className="bi bi-react me-2"></i>
                                React アプリケーション
                            </h4>
                        </div>
                        <div className="card-body">
                            <div className="alert alert-success">
                                <h5 className="alert-heading">
                                    <i className="bi bi-check-circle me-2"></i>
                                    React アプリケーションが正常に動作しています！
                                </h5>
                                <p className="mb-0">
                                    Viteのホットリロード機能により、ファイルを変更すると自動的にページが更新されます。
                                </p>
                            </div>
                            
                            <div className="row">
                                <div className="col-md-6">
                                    <div className="card border-primary">
                                        <div className="card-body">
                                            <h6 className="card-title text-primary">
                                                <i className="bi bi-lightning me-2"></i>
                                                Vite の機能
                                            </h6>
                                            <ul className="card-text small">
                                                <li>高速なホットリロード</li>
                                                <li>ES6+ モジュール対応</li>
                                                <li>TypeScript サポート</li>
                                                <li>CSS プリプロセッサ対応</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-md-6">
                                    <div className="card border-success">
                                        <div className="card-body">
                                            <h6 className="card-title text-success">
                                                <i className="bi bi-react me-2"></i>
                                                React の機能
                                            </h6>
                                            <ul className="card-text small">
                                                <li>コンポーネントベース開発</li>
                                                <li>仮想DOM</li>
                                                <li>JSX 記法</li>
                                                <li>Hooks API</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div className="mt-4">
                                <h5>現在の時刻</h5>
                                <p className="text-muted">
                                    この時刻は React の state で管理されています: <strong>{new Date().toLocaleString('ja-JP')}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

// React 18 の新しい createRoot API を使用
const container = document.getElementById('app');
if (container) {
    const root = createRoot(container);
    root.render(<App />);
}
