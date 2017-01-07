<?php

class Router
{
    private $_controller;
    private $_action;
    private $_params;
    static $_instance;

    // Чтобы обращаться к заполненному экземпляру изнутри методов других объектов сохраняем его в классе (Singleton)
    public static function getInstance()
    {
        if ( ! (self::$_instance instanceof self))
            self::$_instance = new Router();
        return self::$_instance;
    }

    // Определение контроллера, метода и параметров из URI
    public function __construct()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/\\');
        $chips = explode('/', $uri);

        // Какой контроллер использовать?
        $this->_controller = empty($chips[0]) ? 'index' : $chips[0];

        // Какой метод использовать?
        $this->_action = empty($chips[1]) ? 'index' : $chips[1];

        //Есть ли параметры и их значения?
        if( ! empty($chips[2])){
            $keys = $values = [];
            for($i = 2; $i < count($chips); $i++){
                if ($i % 2 == 0){
                    //Чётное = ключ
                    $keys[] = $chips[$i];
                }else{
                    //Нечетное = значение
                    $values[] = $chips[$i];
                }
            }
            $this->_params = array_combine($keys, $values);
        }
    }

    // Вызывается index-ом. Выполняет контроллер и метод
    public function start()
    {
        $class = 'controller_' .$this->_controller;
        $controller = new $class();

        $action = $this->_action;
        $controller->$action();
    }

    public function getParams()
    {
        return $this->_params;
    }
}