@extends('layouts.app')
<!-- layoutsapp.blade.phpを参照 -->

@section('title', 'CueL プルリクエスト一覧')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/cuel.css') }}">
@endpush

@section('content')

    <div class="container">
    @if(isset($error))
            <div class="alert alert-danger">
                <h4>エラーが発生しました</h4>
                <p>{{ $error }}</p>
            </div>
    @else
    <div class="container">
        <!--
        <h1>CueL プルリクエスト一覧</h1>
        <p>プルリクエスト一覧が表示されているよ</p>
        <p>このビューはapp/Http/Controllers/CueLController.phpから呼び出されているよ</p>
        <p>このビューはresources/views/cuel.blade.phpにあるよ</p>
        -->
        <h1>{{ $data[0]['base']['repo']['name'] }}</h1>
        @if($data[0]['base']['repo']['name'] == 'cuel_frontend')
            <p>Backendは<a href="./cuel-back" class="text-decoration-none">こちら</a>から</p>
        @elseif($data[0]['base']['repo']['name'] == 'cuel_api')
            <p>Frontendは<a href="./cuel-front" class="text-decoration-none">こちら</a>から</p>

        @endif
        <p>現在のプルリクエスト件数:{{ count($data) }}</p>
        @foreach($data as $item)
            <a href="{{ $item['html_url'] }}" class="card mb-3 pull-request-card text-decoration-none">
                <div class="card-body pull-request-card">
                    <div class="d-flex align-items-center">
                        <img src="{{ $item['user']['avatar_url'] }}" alt="avatar" class="rounded-circle me-3" style="width: 40px; height: 40px;">
                        <div class="flex-grow-1 ">
                            <h5 class="card-title mb-1">{{ $item['title'] }}</h5>
                            <p class="card-text text-muted mb-0">by {{ $item['user']['login'] }}</p>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach

    </div>
    @endif





@endsection