<?php

namespace Sebastianwestberg\Bts\Command\Listener;

use Symfony\Component\Console\Event\ConsoleTerminateEvent;
use Symfony\Component\Console\ConsoleEvents;

class TerminateListener
{
    public static function whenCommandEnds(ConsoleTerminateEvent $event)
    {
       //$event->getCommand()->getName();
    }
}
