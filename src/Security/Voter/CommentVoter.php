<?php

namespace App\Security\Voter;

use App\Entity\Auth\User;
use App\Entity\Comment\Comment;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CommentVoter extends Voter
{
    const EDIT = 'EDIT_COMMENT';

    protected function supports(string $attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return $attribute === self::EDIT
            && $subject instanceof Comment;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof User || $subject instanceof Comment) {
            return false;
        }
       return $subject->getAuthor()->getId() === $user->getId();

    }
}
