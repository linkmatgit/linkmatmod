<?php

namespace App\Http\Admin\Controller;

use App\Entity\Auth\User;
use App\Entity\Blog\Post;
use App\Entity\Mods\Entity\ModsCategory;
use App\Http\Admin\Data\ModCategoryCrudData;
use App\Http\Admin\Data\PostCrudData;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mods/category', name: "modcategory_")]
#[IsGranted('ROLE_ADMIN')]
class CrudModCategoryController extends CrudController
{
    protected string $templatePath = 'mods/category';
    protected string $menuItem = 'mods_category';
    protected string $entity = ModsCategory::class;
    protected string $routePrefix = 'admin_modcategory';

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
        $entity = (new ModsCategory())->setAuthor($user);
        $data = new ModCategoryCrudData($entity);
        return $this->crudNew($data);
    }

    #[Route('/edit/{id<\d+>}', name: 'edit', methods: ['POST', 'GET'])]
    public function edit(ModsCategory $post): Response
    {
        $data = (new ModCategoryCrudData($post))->setEntityManager($this->em);

        return $this->crudEdit($data);
    }

    #[Route('/{slug<[a-z0-9\-]+>}-{id<\d+>}', methods: ['DELETE'])]
    public function delete(Post $post): Response
    {
        return $this->crudDelete($post);
    }

}
