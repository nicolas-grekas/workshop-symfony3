<?php

namespace Smoovio\Bundle\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController extends Controller
{
    public function indexAction()
    {
        return $this->render('SmoovioPortalBundle:Search:index.html.twig');
    }
}
