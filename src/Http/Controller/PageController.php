<?php

namespace App\Http\Controller;



use App\Repository\PostRepository;
use App\Repository\ModsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController {


    public function __construct(
        private PostRepository $postRepository,
        private ModsRepository $modsRepository
    )
    {

    }

    #[Route('/', name: 'home')]
    public function homePage(): Response{
       return $this->render('index.html.twig', [
           'posts' => $this->postRepository->getFourLastTopicPublic(),
           'mods' => $this->modsRepository->findAll()
       ]);
    }
    #[Route('/layout', name: 'vite')]
    public function getVite():Response{
        return $this->render('layout.html.twig');
    }
}