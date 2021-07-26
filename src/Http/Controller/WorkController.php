<?php

namespace App\Http\Controller;



use App\Entity\Auth\User;
use App\Entity\Work\Work;
use App\Helper\Paginator\PaginatorInterface;
use App\Repository\WorkRepository;
use App\Repository\WorkTopicRepository;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/works', name: 'wip_')]
class WorkController extends AbstractController
{
    public function __construct(
        private WorkRepository $r,
        private PaginatorInterface $paginator
    )
    {
    }

    #[Route('/', name: 'index')]
    public function index(Request $request):Response {
        $title = 'Work In Progress';
        $query = $this->r->queryAllPublic();
       return $this->renderingList($title, $query,$request);
    }

    #[Route('/{id<\d+>}', name: 'show')]
    public function show(Work $work):Response {

        /**
         * @var $user User
         */
        $user = $this->getUser();

        return $this->render('works/show.html.twig', [
            'wips' => $work,
        ]);
    }

    private function renderingList(string $title, Query $query, Request $request, array $params = []): Response
    {
    $page = $request->query->getInt('page', 1);
    $wips = $this->paginator->paginate(
        $query,
        $page,
        15
    );
        if ($page > 1) {
            $title .= ", page $page";
        }
        if (0 === $wips->count()) {
            throw new NotFoundHttpException('Aucun articles ne correspond à cette page');
        }

        return $this->render('works/index.html.twig', array_merge([
            'wips' => $wips,
            'page' => $page,
            'title' => $title,
            'menu' => 'wip',
        ], $params));
    }


}