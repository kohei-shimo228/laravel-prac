<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Validator;

class TODOController extends Controller
{
    /**
     * タスク一覧を表示
     */
    public function index()
    {
        $todos = Todo::orderBy('created_at', 'desc')->get();
        return view('todos.index', compact('todos'));
    }

    /**
     * タスク作成フォームを表示
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * 新しいタスクを保存
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date|after:now'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Todo::create($request->all());

        return redirect()->route('todos.index')
            ->with('success', 'タスクが正常に作成されました。');
    }

    /**
     * 特定のタスクを表示
     */
    public function show(Todo $todo)
    {
        return view('todos.show', compact('todo'));
    }

    /**
     * タスク編集フォームを表示
     */
    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    /**
     * タスクを更新
     */
    public function update(Request $request, Todo $todo)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
            'due_date' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $todo->update($request->all());

        return redirect()->route('todos.index')
            ->with('success', 'タスクが正常に更新されました。');
    }

    /**
     * タスクを削除
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('todos.index')
            ->with('success', 'タスクが正常に削除されました。');
    }

    /**
     * タスクの完了状態を切り替え
     */
    public function toggle(Todo $todo)
    {
        $todo->update(['completed' => !$todo->completed]);

        return redirect()->back()
            ->with('success', 'タスクの状態が更新されました。');
    }
}
