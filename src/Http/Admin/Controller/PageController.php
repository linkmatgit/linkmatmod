<?php

namespace App\Http\Admin\Controller;


use App\Helper\Paginator\PaginatorInterface;
use App\Repository\CommentRepository;
use App\Repository\WipTagRevisionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


final class PageController extends AdminAbstractController {

    public function __construct(
        private CommentRepository $commentRepository,
        private PaginatorInterface $paginator,
        private WipTagRevisionRepository $revisionRepository,
    )
    {
    }

    #[Route('/', name: 'app_dashboard')]
    public function dashBoard(): Response
    {

       return $this->render('admin/index.html.twig', [
           'comments' => $this->paginator->paginate($this->commentRepository->queryLatest()),
           'revisions' => $this->revisionRepository->findLatest(),

           ]);
    }
}