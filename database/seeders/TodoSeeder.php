<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Todo;
use Carbon\Carbon;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $todos = [
            [
                'title' => 'Laravelプロジェクトのセットアップ',
                'description' => '新しいLaravelプロジェクトを作成し、基本的な設定を行う',
                'completed' => true,
                'due_date' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'データベース設計',
                'description' => 'アプリケーションに必要なテーブル構造を設計し、マイグレーションを作成する',
                'completed' => true,
                'due_date' => Carbon::now()->subDays(1),
            ],
            [
                'title' => 'TODO管理システムの実装',
                'description' => 'CRUD機能を持つタスク管理システムを実装する',
                'completed' => false,
                'due_date' => Carbon::now()->addDays(1),
            ],
            [
                'title' => 'ユニットテストの作成',
                'description' => '各機能に対するユニットテストを作成し、テストカバレッジを向上させる',
                'completed' => false,
                'due_date' => Carbon::now()->addDays(3),
            ],
            [
                'title' => 'フロントエンドの改善',
                'description' => 'ユーザーインターフェースを改善し、レスポンシブデザインを実装する',
                'completed' => false,
                'due_date' => Carbon::now()->addDays(5),
            ],
            [
                'title' => 'APIエンドポイントの作成',
                'description' => 'モバイルアプリやSPAとの連携のためのAPIエンドポイントを作成する',
                'completed' => false,
                'due_date' => null,
            ],
        ];

        foreach ($todos as $todo) {
            Todo::create($todo);
        }
    }
}
