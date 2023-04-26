<?php

namespace MyApp\Listener;

use Phalcon\Di\Injectable;

class Listener extends Injectable
{
    public function beforeHandleRequest()
    {
        $id = $this->getDI();
        $sql = "SELECT * FROM Users WHERE name = '0' or email = '0' or password = '0'";
        $query = $id->get('modelsManager')->createQuery($sql);
        $exe = $query->execute();
        // print_r($exe[0]);
        foreach ($exe as $key => $value) {
            if ($value->name == '0') {
                $exe[$key]->name = '10';
                $exe[$key]->update();
            }
            if ($value->email == '0') {
                $exe[$key]->email = '10';
                $exe[$key]->update();
            }
            if ($value->password == '0') {
                $exe[$key]->password = '10';
                $exe[$key]->update();
            }
        }
    }
}
