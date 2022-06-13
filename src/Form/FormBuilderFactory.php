<?php

namespace App\Form;

use App\Builder\FieldBuilderRegistry;
use App\Entity\FormInterface;
use App\Event\Events;
use App\Event\FormBuilderFactoryEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface as SymfonyFormInterface;
use Symfony\Component\Routing\RouterInterface;

class FormBuilderFactory implements FormBuilderFactoryInterface
{
    /** @var FieldBuilderRegistry */
    protected $registry;
    /** @var FormFactoryInterface */
    protected $factory;
    /** @var EventDispatcherInterface */
    protected $dispatcher;
    /** @var RouterInterface */
    protected $router;
    protected $route;

    public function __construct
    (
        FieldBuilderRegistry $registry,
        FormFactoryInterface $factory,
        EventDispatcherInterface $dispatcher,
        RouterInterface $router,
        $route
    ) {
        $this->registry = $registry;
        $this->factory = $factory;
        $this->dispatcher = $dispatcher;
        $this->router = $router;
        $this->route = $route;
    }

    public function build(FormInterface $form, $data = null): SymfonyFormInterface
    {
        $options = [
            'label' => $form->getLegend(),
            'method' => 'POST',
            'action' => $this->router->generate($this->route, [
                'name' => $form->getName()
            ]),
        ];

        // Dispatch event to tie any options
        $event = new FormBuilderFactoryEvent($form, $options);
        $this->dispatcher->dispatch($event, Events::FORM_BUILD);

        $builder = $this->factory->createNamedBuilder($form->getName(), FormType::class,$data, $event->getOptions());

        foreach($form->getFormElements() as $element)
        {
            $fieldConfig = $this->registry->getFormElementConfig($element);

            // Fix options
            $options = $element->getOptions();
            unset($options['extra']);

            // Set Constraints
            $options['constraints'] = $fieldConfig->getConstraints();

            // Add to form
            $builder->add($fieldConfig->getName(), $fieldConfig->getFormFQCN(), $options);
        }

        return $builder->getForm();
    }
}