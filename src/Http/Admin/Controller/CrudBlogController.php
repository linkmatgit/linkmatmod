<?php

namespace App\Http\Admin\Controller;

use App\Entity\Auth\User;
use App\Entity\Blog\Post;
use App\Http\Admin\Data\PostCrudData;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/blog', name: "blog_")]
#[IsGranted('ROLE_ADMIN')]
class CrudBlogController extends CrudController
{
    protected string $templatePath = 'blog';
    protected string $menuItem = 'blog';
    protected string $entity = Post::class;
    protected string $routePrefix = 'admin_blog';

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
