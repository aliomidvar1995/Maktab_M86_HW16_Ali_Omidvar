<?php 

namespace core\middlewares;
use core\exception\ForbiddenException;
use core\Application;
use core\Response;

class PatientMiddleware extends BaseMiddleware{
    public static function execute() {
        if(Application::$app->user->rule == 'doctor') {
            (new Response)->redirect('/doctor');
        }
    }
}