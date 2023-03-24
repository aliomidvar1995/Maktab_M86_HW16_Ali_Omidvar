<?php

namespace core\middlewares;

abstract class BaseMiddleware {
    abstract public static function execute();
}