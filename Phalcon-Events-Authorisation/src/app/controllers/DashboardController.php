<?php

use Phalcon\Mvc\Controller;

class DashboardController extends Controller
{

    public function IndexAction()
    {
        // Redirected to View
    }
    public function LogoutAction()
    {
        $this->session->destroy();
        $this->response->redirect("login");
    }
}