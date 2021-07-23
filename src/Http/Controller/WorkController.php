<?php

namespace App\Http\Controller;



use App\Entity\Auth\User;
use App\Entity\Work\Work;
use App\Repository\WorkRepository;
use App\Repository\WorkTopicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/works', name: 'wip_')]
class WorkController extends AbstractController
{
    public function __construct(
        private WorkRepository $r,
        private WorkTopicRepository $rm
    )
    {
    }

    #[Route('/', name: 'index')]
    public function index():Response {

        /**
         * @var $user User
         */
        $user = $this->getUser();
        return $this->render('works/index.html.twig', [
          'wips' => $this->r->findAll()
        ]);
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



}