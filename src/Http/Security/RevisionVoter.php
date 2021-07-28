<?php

namespace App\Http\Security;

use App\Entity\Auth\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class RevisionVoter extends Voter
{
    const ADD = 'add_revision';

    protected function supports(string $attribute, $subject)
    {
        return in_array($attribute, [
                self::ADD,
            ]) && null === $subject;
    }


    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        return true;
    }
}