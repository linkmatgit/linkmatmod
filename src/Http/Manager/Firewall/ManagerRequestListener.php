<?php

namespace App\Http\Manager\Firewall;



use App\Http\Admin\Controller\AdminAbstractController;
use App\Http\Manager\Controller\ManagerAbstractController;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Limite l'accès à l'administration en vérifiant le rôle de l'utilisateur.
 */
class ManagerRequestListener implements EventSubscriberInterface
{
    private AuthorizationCheckerInterface $auth;
    private string $managerPrefix;

    public static function getSubscribedEvents()
    {
        return [
            ControllerEvent::class => 'onController',
            RequestEvent::class => 'onRequest',
        ];
    }

    public function __construct(string $managerPrefix, AuthorizationCheckerInterface $auth)
    {
        $this->auth = $auth;
        $this->managerPrefix = $managerPrefix;
    }

    public function onRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest() ) {
            return;
        }
        $uri = '/'.trim($event->getRequest()->getRequestUri(), '/').'/';
        $prefix = '/'.trim($this->managerPrefix, '/').'/';
        if (substr($uri, 0, mb_strlen($prefix)) === $prefix &&
            !$this->auth->isGranted('ROLE_MANAGER')
        ) {
            $exception = new AccessDeniedException();
            $exception->setSubject($event->getRequest());
            throw $exception;
        }
    }

    /**
     * Vérifie que l'utilisateur peux accéder aux controller de l'administration.
     *
     * Cette sécurité fait doublon avec l'évènement RequestEvent, mais permet une sécurité supplémentaire dans le cas
     * ou une action d'un controller se retrouve dans une URL qui n'est pas préfixé par le chemin de l'administration
     * @param ControllerEvent $event
     */
    public function onController(ControllerEvent $event): void
    {
        if (false === $event->isMainRequest() ) {
            return;
        }
        $controller = $event->getController();
        if (is_array($controller) && $controller[0] instanceof ManagerAbstractController && !$this->auth->isGranted('ROLE_MANAGER')) {
            $exception = new AccessDeniedException();
            $exception->setSubject($event->getRequest());
            throw $exception;
        }
    }
}