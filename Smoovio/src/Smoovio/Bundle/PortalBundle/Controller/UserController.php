<?php

namespace Smoovio\Bundle\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        if (!$this->get('security.context')->isGranted('ROLE_USER')) {
            throw $this->createAccessDeniedException('User must be fully authenticated.');
        }

        return $this->render('SmoovioPortalBundle:User:profile.html.twig', array(
            'profile' => $this->getUser(),
        ));
    }
}
