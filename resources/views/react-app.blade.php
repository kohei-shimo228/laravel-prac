@extends('layouts.app')

@section('title', 'React App')

@push('styles')
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
@endpush

@section('content')
    <div id="app">
        <!-- React アプリケーションがここにレンダリングされます -->
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">読み込み中...</span>
            </div>
            <p class="mt-3 text-muted">React アプリケーションを読み込み中...</p>
        </div>
    </div>
@endsection

