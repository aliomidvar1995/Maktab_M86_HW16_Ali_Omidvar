<?php

namespace core\middlewares;
use core\Application;
use core\exception\ForbiddenException;

class AuthMiddleware extends BaseMiddleware{
    public array $routes = [];

    public function __construct(array $routes = []) {
        $this->routes = $routes;
    }
    public static function execute() {
        if(Application::$app->isGuest()) {
            throw new ForbiddenException();
        }
    }
}