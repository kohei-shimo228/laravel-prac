@extends('layouts.app')

@section('title', $todo->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="h4 mb-0 {{ $todo->completed ? 'text-decoration-line-through text-muted' : '' }}">
                    {{ $todo->title }}
                </h2>
                <div class="d-flex gap-2">
                    <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn {{ $todo->completed ? 'btn-success' : 'btn-warning' }}">
                            <i class="bi {{ $todo->completed ? 'bi-check-circle-fill' : 'bi-circle' }}"></i>
                            {{ $todo->completed ? '完了済み' : '未完了' }}
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                @if($todo->description)
                    <div class="mb-4">
                        <h5 class="h6 text-muted mb-2">説明</h5>
                        <div class="p-3 bg-light rounded">
                            {{ $todo->description }}
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="h6 text-muted mb-2">ステータス</h5>
                        <p>
                            @if($todo->completed)
                                <span class="badge bg-success fs-6">
                                    <i class="bi bi-check-circle"></i> 完了
                                </span>
                            @else
                                <span class="badge bg-warning fs-6">
                                    <i class="bi bi-clock"></i> 未完了
                                </span>
                            @endif
                        </p>
                    </div>
                    
                    @if($todo->due_date)
                        <div class="col-md-6">
                            <h5 class="h6 text-muted mb-2">期限</h5>
                            <p>
                                <i class="bi bi-calendar"></i>
                                {{ $todo->due_date->format('Y年m月d日 H:i') }}
                                @if($todo->due_date->isPast() && !$todo->completed)
                                    <span class="badge bg-danger ms-2">期限切れ</span>
                                @elseif($todo->due_date->isToday() && !$todo->completed)
                                    <span class="badge bg-warning ms-2">今日が期限</span>
                                @endif
                            </p>
                        </div>
                    @endif
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="h6 text-muted mb-2">作成日時</h5>
                        <p>
                            <i class="bi bi-clock"></i>
                            {{ $todo->created_at->format('Y年m月d日 H:i') }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="h6 text-muted mb-2">最終更新</h5>
                        <p>
                            <i class="bi bi-pencil"></i>
                            {{ $todo->updated_at->format('Y年m月d日 H:i') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('todos.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> 一覧に戻る
                    </a>
                    <div class="d-flex gap-2">
                        <a href="{{ route('todos.edit', $todo) }}" class="btn btn-primary">
                            <i class="bi bi-pencil"></i> 編集
                        </a>
                        <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('このタスクを削除してもよろしいですか？')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> 削除
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
