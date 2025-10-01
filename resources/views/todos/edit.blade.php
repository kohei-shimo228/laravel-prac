@extends('layouts.app')

@section('title', 'タスクを編集')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2 class="h4 mb-0">
                    <i class="bi bi-pencil"></i> タスクを編集
                </h2>
            </div>
            <div class="card-body">
                <form action="{{ route('todos.update', $todo) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">
                            タイトル <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $todo->title) }}" 
                               placeholder="タスクのタイトルを入力してください"
                               required>
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">説明</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="4" 
                                  placeholder="タスクの詳細を入力してください（任意）">{{ old('description', $todo->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="completed" class="form-label">ステータス</label>
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="completed" 
                                   name="completed" 
                                   value="1"
                                   {{ old('completed', $todo->completed) ? 'checked' : '' }}>
                            <label class="form-check-label" for="completed">
                                完了済み
                            </label>
                        </div>
                        @error('completed')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="due_date" class="form-label">期限</label>
                        <input type="datetime-local" 
                               class="form-control @error('due_date') is-invalid @enderror" 
                               id="due_date" 
                               name="due_date" 
                               value="{{ old('due_date', $todo->due_date ? $todo->due_date->format('Y-m-d\TH:i') : '') }}">
                        @error('due_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-text">
                            期限を設定しない場合は空欄のままにしてください
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('todos.show', $todo) }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> キャンセル
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> 更新
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
