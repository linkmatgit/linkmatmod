<?php

namespace App\Http\Admin\Controller;

use App\Entity\Auth\User;
use App\Entity\Blog\Post;
use App\Entity\Config\Configuration;
use App\Http\Admin\Data\PostCrudData;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/config', name: "config_")]
#[IsGranted('ROLE_ADMIN')]
class CrudconfigurationController extends CrudController
{
    protected string $templatePath = 'configurations';
    protected string $menuItem = 'config';
    protected string $entity = Configuration::class;
    protected string $routePrefix = 'admin_config';

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render("admin/{$this->templatePath}/index.html.twig", [

        ]);
    }

    #[Route('/new', name: 'new', methods: ['POST', 'GET'])]
    public function new(): Response
    {
        /**
         * @var $user User
         */
        $user = $this->getUser();
        $entity = (new Post())->setAuthor($user);
        $data = new PostCrudData($entity);
        return $this->crudNew($data);
    }

    #[Route('/edit/{id<\d+>}', name: 'edit', methods: ['POST', 'GET'])]
    public function edit(Post $post): Response
    {
        $data = (new PostCrudData($post))->setEntityManager($this->em);

        return $this->crudEdit($data);
    }

    #[Route('/{slug<[a-z0-9\-]+>}-{id<\d+>}', methods: ['DELETE'])]
    public function delete(Post $post): Response
    {
        return $this->crudDelete($post);
    }

}
