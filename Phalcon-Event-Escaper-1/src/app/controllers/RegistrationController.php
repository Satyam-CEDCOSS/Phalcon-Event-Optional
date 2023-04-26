<?php

use MyApp\Listener\Listener;
use MyApp\Listener\Aware;
use Phalcon\Mvc\Controller;
use Phalcon\Escaper;
use Phalcon\Events\Manager as EventsManager;

class RegistrationController extends Controller
{

    public function IndexAction()
    {
        // Redirected to View
    }

    public function registrationAction()
    {
        // Redirected to View
    }

    public function processAction()
    {
        $arr = $this->request->getPost();
        if ($arr["name"] && $arr["email"] && $arr["password"]) {
            $escape = new Escaper();
            $user = new Users();
            foreach ($arr as $key => $value) {
                $arr[$key] = $escape->escapeHtml($value);
            }
            $this->session->set('post', $this->request->getPost());
            $this->session->set('array', $arr);

            $eventsManager = new EventsManager();
            $connection = new Aware();
            $connection->setEventsManager($eventsManager);
            $eventsManager->attach(
                'application',
                new Listener()
            );

            $connection->process();

            $user->assign(
                $arr,
                [
                    'name',
                    'email',
                    'password'
                ]
            );

            $success = $user->save();

            $this->view->success = $success;

            if ($success) {
                $this->view->message = "Register succesfully";
            } else {
                $this->view->message = "Authentication Failure";
            }
        } else {
            $this->view->message = "Please fill all inputs";
        }
    }
}
