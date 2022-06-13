<?php

namespace App\Controller;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;

class FormBuilderController extends ResourceController
{
    public function previewAction(Request $request)
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);
        $resource = $this->findOr404($configuration);


        $form =  $this->getFactory()->build($resource);

        return $this->render('FormBuilder/preview.html.twig', [
            'form_builder' => $resource,
            'form' => $this->getFactory()->build($resource)->createView(),
        ]);
    }

    public function processAction(Request $request)
    {
        dd($request);
    }

    public function getFactory()
    {
        return $this->container->get('form_builder.form.factory');
    }
}
