<?php

namespace Smoovio\Bundle\CoreBundle\User\Registration;

use Smoovio\Bundle\CoreBundle\Form\Handler\FormHandlerInterface;
use Smoovio\Bundle\CoreBundle\User\Manager\UserManagerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class RegistrationFormHandler implements FormHandlerInterface
{
    /**
     * @param UserManagerInterface $userManager
     */
    public function __construct(UserManagerInterface $userManager)
    {
        $this->usermanager = $userManager;
    }

    /**
     * @param Form    $form
     * @param Request $request
     * @param array   $options
     *
     * @return bool
     */
    public function handle(Form $form, Request $request, array $options = null)
    {
        if (!$request->isMethod('POST')) {
            return false;
        }

        $form->bind($request->request->get($form->getName()));

        if (!$form->isBound() || !$form->isValid()) {
            return false;
        }

        $this->usermanager->createUser($form->getData()->getUser());

        return true;
    }
} 
