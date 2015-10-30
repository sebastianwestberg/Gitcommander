<?php

require __DIR__.'/../vendor/autoload.php';

use Sebastianwestberg\Bts\Console\GithubApplication;
use Sebastianwestberg\Bts\Command\LoginCommand;
use Sebastianwestberg\Bts\Command\RepositoryAddCommand;
use Sebastianwestberg\Bts\Command\Listener\TerminateListener;
use Symfony\Component\Console\Event\ConsoleTerminateEvent;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\EventDispatcher\EventDispatcher;

$dispatcher = new EventDispatcher();
$dispatcher->addListener(ConsoleEvents::TERMINATE, function (ConsoleTerminateEvent $event) {
    TerminateListener::whenCommandEnds($event); 
});

$application = new GithubApplication();
$application->setDispatcher($dispatcher);
$application->add(new LoginCommand());
$application->add(new RepositoryAddCommand());
$application->run();
