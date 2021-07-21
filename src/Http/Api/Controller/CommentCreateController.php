<?php

namespace App\Http\Api\Controller;




use App\Entity\Auth\User;
use App\Entity\Comment\Comment;
use Symfony\Component\Security\Core\Security;

class CommentCreateController{

    public function __construct(private Security $security)
    {
    }

    public function __invoke(Comment $data): Comment
    {
        /** * @var User $user */
            $user = $this->security->getUser();
        $data->setAuthor($user);
        return $data;
    }


}