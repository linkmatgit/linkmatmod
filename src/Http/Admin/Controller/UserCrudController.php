<?php

namespace App\Http\Admin\Controller;

use App\Entity\Auth\User;

use App\Http\Admin\Data\UserCrudData;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/user', name: "user_")]
#[IsGranted('ROLE_ADMIN')]
class UserCrudController extends CrudController
{
    protected string $searchField = 'username';

    protected string $templatePath = 'users';
    protected string $menuItem = 'users';
    protected string $entity = User::class;
    protected string $routePrefix = 'admin_user';
    #[Route('/', name: 'index')]
    public function index():Response {
        return $this->crudIndex();
    }

    #[Route('/edit/{id<\d+>}', name: 'edit', methods: ['POST', 'GET'])]
    public function edit(User $rows): Response
    {
        $data = (new UserCrudData($rows))->setEntityManager($this->em);

        return $this->crudEdit($data);
    }

    #[Route('/{id<\d+>}', name: 'delete', methods:['DELETE'])]
    public function delete(User $rows): Response
    {
        return $this->crudDelete($rows);
    }

}