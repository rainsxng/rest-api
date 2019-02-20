<?php
/**
 * Created by PhpStorm.
 * User: brian
 * Date: 20.02.2019
 * Time: 15:30
 */

abstract class Api
{
    public $apiName = '';
    protected $method = '';
    public $requestUri = [];
    public $requestParams = [];
    protected $action = '';

    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");

        $this->requestUri = explode('/', trim($_SERVER['REQUEST_URI'],'/'));
        $this->requestParams = $_REQUEST;

        $this->method = $_SERVER['REQUEST_METHOD'];
        if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD',$_SERVER)){
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE'){
                $this->method = 'DELETE';
            }
            elseif ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT'){
                $this->method = 'PUT';
            }
            else {
                throw new Exception('Unexpected Header');
            }
        }
    }

    public function run()
    {
        if (array_shift($this->requestUri) !== 'api' || array_shift($this->requestUri) !== $this->apiName){
            throw new RuntimeException('Api not found',404);
        }
        $this->action = $this->getAction();
        if (method_exists($this,$this->method)){
            return $this->{$this->action}();
        }
        else {
            throw new RuntimeException('Method not found',500);
        }
    }
}