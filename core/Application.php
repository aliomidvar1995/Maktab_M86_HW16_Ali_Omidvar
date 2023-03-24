<?php

namespace core;
use model\Dbmodel;
use model\Register;

class Application {
    public static $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public DB $db;
    public ?Controller $controller;
    public ?Register $user;
    public static Application $app;

    public function __construct($rootPath, $config) {
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->user = new Register();
        $this->db = new DB($config['db']);
        if(isset($_SESSION[Register::PRIMARY_KEY])){
            $user = $this->user->findOne([Register::PRIMARY_KEY => $_SESSION[Register::PRIMARY_KEY]]);
        }
        if(isset($user)) {
            $this->user = $user;
        }else {
            $this->user = null;
        }
        $this->router = new Router($this->request, $this->response);
        $this->controller = new Controller();
    }
    public function run() {
       try {
            return $this->router->render();
       } catch (\Exception $e) {
           $this->response->getStatusCode($e->getCode());
           return $this->response->renderView('main', 'NotFound', [
               'exception' => $e
           ]);
       }
    }

    public function isGuest() {
        return !self::$app->user;
    }
}