<?php

namespace core;
use core\middlewares\BaseMiddleware;
use PDO;

class Controller {
    public array $middlewares = [];
    public string $route = '';
    public function registerMiddleware(BaseMiddleware $middleware) {
        $this->middlewares[] = $middleware;
    }
}