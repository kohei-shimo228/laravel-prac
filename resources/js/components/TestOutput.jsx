import React, { useState } from 'react';

function TestOutput() {
    const [num, setNum] = useState('');
    const [result, setResult] = useState('');
    const [loading, setLoading] = useState(false);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        
        try {
            const response = await fetch(`/test_out?num=${num}`);
            const data = await response.text();
            setResult(data);
        } catch (error) {
            setResult('エラーが発生しました: ' + error.message);
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="container mt-4">
            <div className="row justify-content-center">
                <div className="col-md-6">
                    <div className="card">
                        <div className="card-header">
                            <h3>テスト出力 - React版</h3>
                        </div>
                        <div className="card-body">
                            <form onSubmit={handleSubmit}>
                                <div className="mb-3">
                                    <label htmlFor="num" className="form-label">
                                        数値を入力してください
                                    </label>
                                    <input
                                        type="text"
                                        className="form-control"
                                        id="num"
                                        value={num}
                                        onChange={(e) => setNum(e.target.value)}
                                        placeholder="例: 123"
                                    />
                                </div>
                                <button 
                                    type="submit" 
                                    className="btn btn-primary"
                                    disabled={loading}
                                >
                                    {loading ? '送信中...' : '送信'}
                                </button>
                            </form>
                            
                            {result && (
                                <div className="mt-4">
                                    <h5>結果:</h5>
                                    <div className="alert alert-info">
                                        {result}
                                    </div>
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default TestOutput;

