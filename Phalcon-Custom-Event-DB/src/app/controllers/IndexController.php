<?php

use Phalcon\Mvc\Controller;
use MyApp\Listener\Listener;
use MyApp\Listener\Aware;
use Phalcon\Events\Manager as EventsManager;

class IndexController extends Controller
{
    public function indexAction()
    {
        $eventsManager = new EventsManager();
        $connection = new Aware();
        $connection->setEventsManager($eventsManager);
        $eventsManager->attach(
            'application',
            new Listener()
        );
        $connection->process();
    }
}