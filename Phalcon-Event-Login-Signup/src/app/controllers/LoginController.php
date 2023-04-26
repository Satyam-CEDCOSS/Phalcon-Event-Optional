<?php

use Phalcon\Mvc\Controller;
use MyApp\Listener\Listener;
use MyApp\Listener\Aware;
use Phalcon\Events\Manager as EventsManager;

class LoginController extends Controller
{
    public function indexAction()
    {
        $eventsManager = new EventsManager();
        $connection = new Aware();
        $connection->setEventsManager($eventsManager);
        $eventsManager->attach(
            'login',
            new Listener()
        );
        $connection->process();
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
            $eventsManager = new EventsManager();
            $connection = new Aware();
            $connection->setEventsManager($eventsManager);
            $eventsManager->attach(
                'check',
                new Listener()
            );
            $connection->process();
        } else {
            $this->view->message = "error";
        }
    }
}
