@extends('layouts.app')

@section('title', 'タスク一覧')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">タスク管理</h1>
            <a href="{{ route('todos.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> 新しいタスク
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($todos->count() > 0)
            <div class="row">
                @foreach($todos as $todo)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 {{ $todo->completed ? 'border-success' : 'border-primary' }}">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0 {{ $todo->completed ? 'text-decoration-line-through text-muted' : '' }}">
                                    {{ $todo->title }}
                                </h5>
                                <div class="d-flex gap-2">
                                    <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm {{ $todo->completed ? 'btn-outline-success' : 'btn-outline-warning' }}" 
                                                title="{{ $todo->completed ? '未完了に戻す' : '完了にする' }}">
                                            <i class="bi {{ $todo->completed ? 'bi-check-circle-fill' : 'bi-circle' }}"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                @if($todo->description)
                                    <p class="card-text">{{ Str::limit($todo->description, 100) }}</p>
                                @endif
                                
                                @if($todo->due_date)
                                    <p class="card-text">
                                        <small class="text-muted">
                                            <i class="bi bi-calendar"></i>
                                            期限: {{ $todo->due_date->format('Y/m/d H:i') }}
                                            @if($todo->due_date->isPast() && !$todo->completed)
                                                <span class="badge bg-danger ms-1">期限切れ</span>
                                            @endif
                                        </small>
                                    </p>
                                @endif
                                
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="bi bi-clock"></i>
                                        作成: {{ $todo->created_at->format('Y/m/d H:i') }}
                                    </small>
                                </p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('todos.show', $todo) }}" class="btn btn-outline-info btn-sm">
                                        <i class="bi bi-eye"></i> 詳細
                                    </a>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('todos.edit', $todo) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-pencil"></i> 編集
                                        </a>
                                        <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('このタスクを削除してもよろしいですか？')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash"></i> 削除
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-clipboard-x display-1 text-muted"></i>
                <h3 class="mt-3 text-muted">タスクがありません</h3>
                <p class="text-muted">新しいタスクを作成して始めましょう！</p>
                <a href="{{ route('todos.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> 最初のタスクを作成
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
