<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class WelcomeController extends Controller
{
    public function index()
    {
        // ルート情報を取得
        $routes = $this->getApplicationRoutes();
        
        return view('hello', compact('routes'));
    }
    
    /**
     * アプリケーションのルート情報を取得
     */
    private function getApplicationRoutes()
    {
        return collect(Route::getRoutes())->filter(function ($route) {
            // GETルートのみを対象とし、システムルートは除外
            return $route->methods()[0] === 'GET' && 
                   !str_starts_with($route->uri(), 'api/') &&
                   !str_starts_with($route->uri(), 'auth/') &&
                   !str_starts_with($route->uri(), 'sanctum/') &&
                   !str_starts_with($route->uri(), 'telescope/') &&
                   !str_starts_with($route->uri(), 'horizon/') &&
                   $route->uri() !== '_ignition/{uuid}';
        })->map(function ($route) {
            $uri = $route->uri();
            $name = $route->getName();
            $action = $route->getAction();
            
            // 表示名を決定
            if ($name) {
                $displayName = $name;
            } elseif (isset($action['controller'])) {
                $controller = class_basename($action['controller']);
                $displayName = $controller;
            } elseif (isset($action['uses']) && is_string($action['uses'])) {
                $displayName = $action['uses'];
            } elseif (isset($action['uses']) && is_callable($action['uses'])) {
                $displayName = 'クロージャ関数';
            } else {
                $displayName = $uri;
            }
            
            // 説明文を生成
            $description = $this->generateRouteDescription($action, $uri);
            
            return [
                'uri' => $uri,
                'name' => $name,
                'display_name' => $displayName,
                'description' => $description,
                'url' => url($uri),
                'controller' => $action['controller'] ?? null,
                'action' => is_string($action['uses'] ?? null) ? $action['uses'] : null,
                'is_closure' => isset($action['uses']) && is_callable($action['uses']),
            ];
        })->sortBy('uri')->values();
    }
    
    /**
     * ルートの説明文を生成
     */
    private function generateRouteDescription($action, $uri)
    {
        if (isset($action['controller'])) {
            $controller = class_basename($action['controller']);
            return "{$controller} コントローラー";
        } elseif (isset($action['uses']) && is_callable($action['uses'])) {
            return "クロージャ関数";
        } elseif (isset($action['uses']) && is_string($action['uses'])) {
            return "文字列アクション";
        } else {
            return "カスタムルート";
        }
    }
}
