<?php

namespace Smoovio\Bundle\CoreBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

interface FormHandlerInterface
{
    /**
     * handles the form
     *
     * @param Form $form
     * @param Request $request
     * @param array $options
     */
    public function handle(Form $form, Request $request, array $options = null);
} 
