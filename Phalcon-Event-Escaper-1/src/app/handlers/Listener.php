<?php

namespace MyApp\Listener;

use Phalcon\Di\Injectable;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\Stream;

class Listener extends Injectable
{
    public function beforeHandleRequest()
    {
        $id = $this->getDI();
        // print_r($id->get('session')->get('array'));
        // print_r($_POST);
        // die;
        $arr = $id->get('session')->get('array');
        foreach ($_POST as $key => $value) {
            if ($value != $arr[$key]) {
                $adapter = new Stream(APP_PATH .'/logs/signup.log');
                $logger  = new Logger(
                    'messages',
                    [
                        'main' => $adapter,
                    ]
                );
            $logger->error("Hacked!! Name: ".$arr["name"]." Email: ".$arr["email"]." Password: ".$arr["password"]);
            }
            break;
        }
    }
}