<?php

use Phalcon\Mvc\Controller;
use Phalcon\Escaper;

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
        $escape = new Escaper();
        $user = new Users();
        foreach ($arr as $key => $value) {
            $arr[$key] = $escape->escapeHtml($value);
        }

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
    }
}
