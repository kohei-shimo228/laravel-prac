# Laravelあれこれ
## 導入時のエラー対策
これを見ながらやってみる\
https://e-penguiner.com/installation-of-laravel-and-its-test/ 

- Illuminate\Database\QueryException
  →`php -r "echo phpinfo();" | grep "php.ini"`でphp.iniを探し「;extension=pdo_mysql」などDB関連のコメントアウトを外し再起動 \
  →`php artisan migrate`でテーブルを適用する\
  →`php artisan serve`で再実行

- To enable extensions, verify that they are enabled in your .ini files:...\
 →`apt install php-xml`

## Laravelについて
- phpで書かれたフレームワーク
- DB連携やAPI操作など処理を行うModel,ユーザーに見せるレイアウトやデザインンを定義するView,２つの仲介をするControllerから構成されている「MVCアーキテクチャ」が採用されてる
- `/routes/web.php`にルーティングを記述する
## model
モデルの作成:`php artisan make:models モデル名`
### マイグレーションの作成
1. `php artisan make:migration create_テーブル名_table`でテーブルを宣言
2. `/database/migrations`にマイグレーションファイルができるから`Schema::create()`にデータ項目や制限を設定(非null、連番など)
3. `php artisan migrate`でマイグレーションを実行するとDBに反映
- Modelで扱う場合Model名がテーブル名の単数形なら自動で結びつく
- そうじゃない場合`protected $table = 'テーブル名';`で使用を明示的に宣言

#### マイグレーションファイルの設定
- `$table->型('項目名')->条件`のように記述
- `id()`→連番、`string()`→文字列、`text()`→長めの文字列、`timestamps()`→いつ作られたか(`created_at`,`updated_at`)
- `nullable()`→非null制約、`default(値)`→設定されてない場合の初期値

#### シーダーファイル

## view
ビューの作成:`/resources/views`に`ビュー名.blade.php`を作成
### bladeテンプレートについて
- HTMLタグが使える
- `{{処理...}}`とやるとphpを扱える
- ファイル参照は`{{asset('参照したいファイルのパス')}}`
- if,forなども使えるがendif,endforなどが必要
- `@extends('ファイル名')`として枠組みの使用が可能


## controller
コントローラーの作成:`php artisan make:controller コントローラー名`\
※コントローラー名は"名前"+Controllerが望ましい
- 定義するメソッド名をルーティングで使用する
- モデルと連携する場合は`use モデルのパス`で読み出す
- `view('表示するビュー',引数となる連想配列)`でビューを読み出す
- 
- 



