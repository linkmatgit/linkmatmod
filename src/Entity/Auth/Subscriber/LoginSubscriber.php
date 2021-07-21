<?php declare(strict_types=1);


namespace App\Entity\Auth\Subscriber;


use App\Entity\Auth\User;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginSubscriber implements EventSubscriberInterface
{

    public function __construct(
        private EntityManagerInterface $em
    )
    {
    }
    /**
     * @return array<string, string>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            AuthenticationSuccessEvent::class => 'onLogin'
        ];
    }

    public function onLogin(InteractiveLoginEvent $event):void{

        $user =  $event->getAuthenticationToken()->getUser();
        $event->getRequest()->getClientIp();
        if($user instanceof User) {
            $ip =  $user->getLastLoginIp();
            if($ip !== $user->getLastLoginIp()) {
                $user->setLastLoginAt($ip);
            }
            $user->setLastLoginAt(new \DateTimeImmutable());
            $this->em->flush();

        }
    }

}