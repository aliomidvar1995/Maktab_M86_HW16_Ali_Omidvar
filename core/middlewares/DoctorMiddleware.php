<?php 

namespace core\middlewares;
use core\Application;
use core\exception\ForbiddenException;
use core\Response;

class DoctorMiddleware extends BaseMiddleware{
    public static function execute()
    {
        if(Application::$app->user->rule == 'patient')
        {
            (new Response)->redirect('/patient');
        }
    }
}