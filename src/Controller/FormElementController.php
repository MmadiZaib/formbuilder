<?php

namespace App\Controller;

use FOS\RestBundle\View\View;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FormElementController extends ResourceController
{
    public function chooseAction(Request $request, $formId)
    {
        $types = $this->getTypes();
//        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);
//
//        $view = View::create()
//            ->setTemplate($configuration->getTemplate('FormElement/choose.html.twig'))
//            ->setData([
//                'formId' => $formId,
//                'types' => $types,
//            ])
//        ;

        return $this->render('FormElement/choose.html.twig', [
            'formId' => $formId,
            'types' => $types
        ]);
        //return $this->viewHandler->handle($configuration, $view);
    }

    public function getTypes()
    {
        return$this->container->get('form_builder.builder_registry')->getTypes();
    }
}
