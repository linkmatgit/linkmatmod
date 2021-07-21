<?php

namespace App\Http\Api\Controller;


use App\Http\Admin\Controller\AdminAbstractController;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AdminAbstractController {


    public function __construct(private UserRepository $r)
    {
    }

    #[Route('/admin/user_autocomplete', name: 'user_autocomplete')]
    public function userSearch(Request $request): Response
    {
        return $this->json($this->r->SearchUser($request->query->get('q')));

    }
}