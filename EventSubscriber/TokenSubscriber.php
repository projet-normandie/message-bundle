<?php
namespace ProjetNormandie\MessageBundle\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use ProjetNormandie\MessageBundle\Entity\Message;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class TokenSubscriber implements EventSubscriberInterface
{

    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['setUser', EventPriorities::PRE_VALIDATE],
        ];
    }

    /**
     * @param ViewEvent $event
     */
    public function setUser(ViewEvent $event)
    {
        $object = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (($object instanceof Message) && in_array($method, array(Request::METHOD_POST))) {
            $object->setSender($this->tokenStorage->getToken()->getUser());
        }
    }
}
