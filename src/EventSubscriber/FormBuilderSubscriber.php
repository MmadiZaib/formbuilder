<?php

namespace App\EventSubscriber;

use App\Event\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class FormBuilderSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            Events::FORM_SUCCESS => 'onFormSuccess'
        ];
    }

    public function onFormSuccess(): void
    {

    }
}
