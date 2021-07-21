<?php

namespace App\Http\Security;


use App\Entity\Auth\User;
use App\Entity\Forum\Entity\ForumMessage;
use App\Entity\Forum\Entity\ForumTopic;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ForumVoter extends Voter
{
    const CREATE = 'forumCreate';
    const REPORT = 'forumReport';
    const CREATE_MESSAGE = 'CREATE_FORUM_MESSAGE';
    const UPDATE_MESSAGE = 'UPDATE_FORUM_MESSAGE';
    const DELETE_MESSAGE = 'DELETE_FORUM_MESSAGE';
    const UPDATE_TOPIC = 'UPDATE_TOPIC';
    const DELETE_TOPIC = 'DELETE_TOPIC';
    const READ_TOPICS = 'READ_TOPICS';
    const SOLVE_MESSAGE = 'SOLVE_MESSAGE';

    protected function supports(string $attribute, $subject)
    {
        return in_array($attribute, [
            self::CREATE,
            self::REPORT,
            self::CREATE_MESSAGE,
            self::UPDATE_MESSAGE,
            self::DELETE_MESSAGE,
            self::UPDATE_TOPIC,
            self::DELETE_TOPIC,
            self::READ_TOPICS,
            self::SOLVE_MESSAGE,
        ]);
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (!$user instanceof User) {
            return false;
        }

        switch ($attribute) {
            case self::CREATE_MESSAGE:
                return $this->canCreateMessageForTopic($user, $subject);
            case self::UPDATE_TOPIC:
            case self::DELETE_TOPIC:
                return $this->canUpdateTopic($user, $subject);
            case self::UPDATE_MESSAGE:
            case self::DELETE_MESSAGE:
                return $this->ownMessage($user, $subject);
            case self::SOLVE_MESSAGE:
                return $this->canSolve($user, $subject);
            case self::READ_TOPICS:
            case self::CREATE:
            case self::REPORT:
                return true;
        }

        return false;
    }

    protected function canCreateMessageForTopic(User $user, ForumTopic $topic): bool
    {
       return true;
    }

    protected function ownMessage(User $user, ForumMessage $message): bool
    {
        return $message->getAuthor()->getId() === $user->getId();
    }

    private function canUpdateTopic(User $user, ForumTopic $topic): bool
    {
        return $topic->getAuthor()->getId() === $user->getId();
    }

    private function canSolve(User $user, ForumMessage $message): bool
    {
        return $message->getTopic()->getAuthor()->getId() === $user->getId();
    }
}
