<?php

namespace MyApp\Listener;

use Phalcon\Di\Injectable;

class Listener extends Injectable
{
    public function afterlogin()
    {
        $id = $this->getDI();
        $id->get('session')->set('data', $id->get('request')->getPost());
    }
    public function beforelogin()
    {
        $id = $this->getDI();
        $arr = $id->get('session')->get('data');
        if ($id->get('session')->get('data')) {
            $_POST['email'] = $arr['email'];
            $_POST['password'] = $arr['password'];
        }
    }
}
