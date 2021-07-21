<?php

namespace App\Http\Admin\Controller;


use App\Entity\Auth\User;
use App\Entity\Blog\Category;
use App\Http\Admin\Data\CategoryCrudData;
use App\Http\Admin\Data\PostCrudData;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category', name: "category_")]
#[IsGranted('ROLE_ADMIN')]
class CategoryCrudController extends CrudController
{
    protected string $templatePath = 'category';
    protected string $menuItem = 'category';
    protected string $entity = Category::class;
    protected string $routePrefix = 'admin_category';

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->crudIndex();
    }
    #[Route('/new', name: 'new', methods: ['POST', 'GET'])]
    public function new(): Response
    {
        /**
         * @var $user User
         */
        $user = $this->getUser();
        $entity = (new Category())->setAuthor($user);
        $data = new CategoryCrudData($entity);
        return $this->crudNew($data);
    }

    #[Route('/edit/{id<\d+>}', name: 'edit', methods: ['POST', 'GET'])]
    public function edit(Category $row): Response
    {
        $data = (new CategoryCrudData($row))->setEntityManager($this->em);

        return $this->crudEdit($data);
    }

    #[Route('/{slug<[a-z0-9\-]+>}-{id<\d+>}', methods: ['DELETE'])]
    public function delete(Category $row): Response
    {
        return $this->crudDelete($row);
    }
}