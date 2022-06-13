<?php

namespace App\EventSubscriber;

use App\Event\Events;
use App\Event\FormBuilderFactoryEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class FormBuilderFactorySubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            Events::FORM_BUILD => 'onFormBuild',
        ];
    }

    public function onFormBuild(FormBuilderFactoryEvent $event)
    {
    }
}