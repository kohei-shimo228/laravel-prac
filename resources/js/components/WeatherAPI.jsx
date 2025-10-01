import React, { useState, useEffect } from 'react';

function WeatherAPI() {
    const [weatherData, setWeatherData] = useState(null);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);
    const [cityId, setCityId] = useState('400040');

    const fetchWeatherData = async () => {
        setLoading(true);
        setError(null);
        
        try {
            const response = await fetch(`/api-out?id=${cityId}`);
            if (!response.ok) {
                throw new Error('APIからのデータ取得に失敗しました');
            }
            
            // HTMLレスポンスを取得して、JSONデータを抽出
            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            // データが含まれているかチェック
            const errorElement = doc.querySelector('.alert-danger');
            if (errorElement) {
                throw new Error(errorElement.textContent);
            }
            
            // 実際のAPIエンドポイントから直接JSONを取得
            const apiResponse = await fetch(`/api-test`);
            if (apiResponse.ok) {
                const data = await apiResponse.json();
                setWeatherData(data);
            }
        } catch (err) {
            setError(err.message);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchWeatherData();
    }, []);

    return (
        <div className="container mt-4">
            <div className="row justify-content-center">
                <div className="col-md-10">
                    <div className="card">
                        <div className="card-header d-flex justify-content-between align-items-center">
                            <h3>天気予報API - React版</h3>
                            <div className="d-flex gap-2">
                                <input
                                    type="text"
                                    className="form-control"
                                    placeholder="地域ID (例: 400040)"
                                    value={cityId}
                                    onChange={(e) => setCityId(e.target.value)}
                                    style={{ width: '200px' }}
                                />
                                <button 
                                    className="btn btn-primary"
                                    onClick={fetchWeatherData}
                                    disabled={loading}
                                >
                                    {loading ? '読み込み中...' : '更新'}
                                </button>
                            </div>
                        </div>
                        <div className="card-body">
                            {error && (
                                <div className="alert alert-danger">
                                    <h4>エラーが発生しました</h4>
                                    <p>{error}</p>
                                </div>
                            )}
                            
                            {loading && (
                                <div className="text-center">
                                    <div className="spinner-border" role="status">
                                        <span className="visually-hidden">読み込み中...</span>
                                    </div>
                                </div>
                            )}
                            
                            {weatherData && (
                                <div>
                                    <h4>生のJSONデータ</h4>
                                    <pre className="bg-light p-3 rounded">
                                        {JSON.stringify(weatherData, null, 2)}
                                    </pre>
                                </div>
                            )}
                            
                            {!loading && !error && !weatherData && (
                                <div className="text-center text-muted">
                                    <p>データを読み込んでください</p>
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default WeatherAPI;

