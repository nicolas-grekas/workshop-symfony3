<?php

namespace Smoovio\Bundle\PortalBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Smoovio\Bundle\PortalBundle\Form\RegistrationType;
use Smoovio\Bundle\CoreBundle\User\Registration\Registration;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContextInterface;

class AuthController extends Controller
{
    /**
     * @Template()
     */
    public function loginAction()
    {
        $error = '';
        $username = '';
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        }

        if ($session) {
            if (!$error && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
                $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
                $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
            }

            // last username entered by the user
            if ($username = $session->get(SecurityContextInterface::LAST_USERNAME)) {
                $session->remove(SecurityContextInterface::LAST_USERNAME);
            }
        }

        return [
            'last_username' => $username,
            'error'         => $error,
        ];
    }

    /**
     * @Template()
     */
    public function signupAction()
    {
        $form = $this->createForm(new RegistrationType(), new Registration());

        if ($this->getRegistrationFormHandler()->handle($form, $this->getRequest())) {
            return $this->redirect($this->generateUrl('portal_home'));
        }

        return ['form' => $form->createView()];
    }

    /**
     * @return \Smoovio\Bundle\CoreBundle\Form\Handler\FormHandlerInterface
     */
    protected function getRegistrationFormHandler()
    {
        return $this->container->get('smoovio_core.registration.handler');
    }
}
