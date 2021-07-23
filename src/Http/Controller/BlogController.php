<?php

namespace App\Http\Controller;

use App\Entity\Blog\Category;
use App\Entity\Blog\Post;
use App\Helper\Paginator\PaginatorInterface;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;

use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/blog', name: 'blog_')]
class BlogController extends AbstractController
{

    public function __construct(
        private PostRepository $postRepository,
        private PaginatorInterface $paginator,
        private CategoryRepository $categoryRepository
    )
    {
    }

    #[Route('/', name: 'index')]
    public function index(Request $request): Response {
        $title = 'Blog';
        $query = $this->postRepository->queryAll();

        return $this->renderListing($title, $query, $request);
    }
    #[Route('/category/{slug}', name: 'category')]
    public function category(Category $category, Request $request): Response
    {
        $title = $category->getName();
        $query = $this->postRepository->queryAll($category);

        return $this->renderListing($title, $query, $request, ['category' => $category]);
    }

    #[Route('/{slug<[a-z0-9\-]+>}-{id<\d+>}', name: 'show', priority: 10)]
      public function show(Post $post): Response {

        return $this->render('blog/show.html.twig',
            [
                'post' => $post
            ]);
    }

    private function renderListing(string $title, Query $query, Request $request, array $params = []): Response
    {
        $page = $request->query->getInt('page', 1);
        $posts = $this->paginator->paginate(
            $query,
            $page,
            10
        );
        if ($page > 1) {
            $title .= ", page $page";
        }
        if (0 === $posts->count()) {
            throw new NotFoundHttpException('Aucun articles ne correspond à cette page');
        }
        $categories = $this->categoryRepository->findWithCount();

        return $this->render('blog/index.html.twig', array_merge([
            'posts' => $posts,
            'categories' => $categories,
            'page' => $page,
            'title' => $title,
            'menu' => 'blog',
        ], $params));
    }
}