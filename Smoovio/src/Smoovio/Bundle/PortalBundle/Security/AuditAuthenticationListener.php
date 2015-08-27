<?php

namespace Smoovio\Bundle\PortalBundle\Security;

use Doctrine\Common\Persistence\ObjectManager;
use Smoovio\Bundle\CoreBundle\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;

class AuditAuthenticationListener implements EventSubscriberInterface
{
    private $entityManager;
    private $request;

    public function __construct(ObjectManager $entityManager, Request $request)
    {
        $this->entityManager = $entityManager;
        $this->request = $request;
    }

    public function onAuthenticationSuccess(AuthenticationEvent $event)
    {
        $token = $event->getAuthenticationToken();
        if (!$token) {
            return;
        }

        $user = $token->getUser();
        if (!$user instanceof User) {
            return;
        }

        $user->recordUserAgent($this->request->headers->get('User-Agent'));
        $user->recordLastLogin($this->request->getClientIp());

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public static function getSubscribedEvents()
    {
        return array(AuthenticationEvents::AUTHENTICATION_SUCCESS => 'onAuthenticationSuccess');
    }
}
