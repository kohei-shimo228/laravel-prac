@extends('layouts.app')

@section('title', '新しいタスクを作成')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2 class="h4 mb-0">
                    <i class="bi bi-plus-circle"></i> 新しいタスクを作成
                </h2>
            </div>
            <div class="card-body">
                <form action="{{ route('todos.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">
                            タイトル <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}" 
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
                                  placeholder="タスクの詳細を入力してください（任意）">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
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
                               value="{{ old('due_date') }}">
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
                        <a href="{{ route('todos.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> キャンセル
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> タスクを作成
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
