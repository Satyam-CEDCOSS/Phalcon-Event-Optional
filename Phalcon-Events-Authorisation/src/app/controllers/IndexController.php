<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        // Redirect to view
        if ($this->session->get("login")) {
            $this->response->redirect("dashboard");
        }
        else {
            $this->response->redirect("login");
        }
    }
}
