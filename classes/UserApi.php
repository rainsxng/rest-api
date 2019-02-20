<?php
/**
 * Created by PhpStorm.
 * User: brian
 * Date: 20.02.2019
 * Time: 18:08
 */
require_once "Api.php";

class UserApi extends Api
{
    /**
     * Метод GET
     * Вывод списка всех записей
     * http://ДОМЕН/users
     * @return string
     */
    public function indexAction()
    {
        return $this->response('user', 200);
    }
    /**
     * Метод GET
     * Просмотр отдельной записи (по id)
     * http://ДОМЕН/users/1
     * @return string
     */
    public function viewAction()
    {
        return $this->response('user2', 200);
    }
    /**
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/users + параметры запроса name, email
     * @return string
     */

    public function updateAction()
    {
        $name = $this->requestParams['name'] ?? '';
        $email = $this->requestParams['email'] ?? '';
        return $this->response("$name | $email", 200);
    }
    /**
     * Метод DELETE
     * Удаление отдельной записи (по ее id)
     * http://ДОМЕН/users/1
     * @return string
     */
    public function deleteAction()
    {
        return $this->response('Data deleted.', 200);
    }
    /**
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/users + параметры запроса name, email
     * @return string
     */
    public function createAction()
    {
        return $this->response('Data saved.', 200);
    }
}