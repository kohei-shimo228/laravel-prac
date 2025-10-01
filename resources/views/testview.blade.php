@extends('layouts.app')
<!-- layouts/app.blade.phpを参照 -->

@section('title', 'testview.blade.php')

@section('content')
    <div class="container">
        <h1>testview.blade.php</h1>
        <p>このビューはapp/Http/Controllers/test2Controller.phpから呼び出されているよ。</p>
        <p>addedmodel.phpからret_contents()を呼び出しているよ。</p>
        <p>このビューはresources/views/testview.blade.phpにあるよ</p>
        <ul>
            <li>/resources/views/testview.blade.php</li>
            <li>/app/Http/Controllers/test2Controller.php</li>
            <li>/app/Models/addedmodel.php</li>
        </ul>
    </div>
@endsection