import React, { useState, useEffect } from 'react';
import WeatherAPI from './WeatherAPI';
import TestOutput from './TestOutput';

function App() {
    const [currentPage, setCurrentPage] = useState('home');

    const renderPage = () => {
        switch (currentPage) {
            case 'weather':
                return <WeatherAPI />;
            case 'test':
                return <TestOutput />;
            default:
                return (
                    <div className="container mt-5">
                        <div className="row justify-content-center">
                            <div className="col-md-8">
                                <div className="card">
                                    <div className="card-header">
                                        <h1 className="text-center">Laravel + React アプリケーション</h1>
                                    </div>
                                    <div className="card-body text-center">
                                        <p className="lead">TailwindCSSからReactに移行しました！</p>
                                        <div className="mt-4">
                                            <button 
                                                className="btn btn-primary me-3"
                                                onClick={() => setCurrentPage('weather')}
                                            >
                                                天気予報API
                                            </button>
                                            <button 
                                                className="btn btn-secondary"
                                                onClick={() => setCurrentPage('test')}
                                            >
                                                テスト出力
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                );
        }
    };

    return (
        <div>
            <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
                <div className="container">
                    <a className="navbar-brand" href="#" onClick={() => setCurrentPage('home')}>
                        Laravel React App
                    </a>
                    <div className="navbar-nav">
                        <button 
                            className="nav-link btn btn-link text-white"
                            onClick={() => setCurrentPage('home')}
                        >
                            ホーム
                        </button>
                        <button 
                            className="nav-link btn btn-link text-white"
                            onClick={() => setCurrentPage('weather')}
                        >
                            天気予報
                        </button>
                        <button 
                            className="nav-link btn btn-link text-white"
                            onClick={() => setCurrentPage('test')}
                        >
                            テスト
                        </button>
                    </div>
                </div>
            </nav>
            {renderPage()}
        </div>
    );
}

export default App;

