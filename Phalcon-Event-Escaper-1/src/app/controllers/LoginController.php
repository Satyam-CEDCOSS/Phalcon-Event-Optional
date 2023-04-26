<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model\Query;

class LoginController extends Controller
{
    public function indexAction()
    {
        // Redirected to View
    }



    public function loginAction()
    {
        $sql = 'SELECT * FROM Users WHERE email = :email: AND password = :password:';
        $query = $this->modelsManager->createQuery($sql);
        $cars = $query->execute(
            [
                'email' => $_POST["email"],
                'password' => $_POST["password"]
            ]
        );
        if (isset($cars[0])) {
            $this->view->message = "success";
        } else {
            $this->view->message = "error";
        }
    }
}
