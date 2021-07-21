<?php

namespace App\Http\Admin\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/user', name: "user_")]
#[IsGranted('ROLE_ADMIN')]
class UserCrudController
{

    #[Route('/', name: 'index')]
    public function index():Response {
        return new Response('hello');
    }

}