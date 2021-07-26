<?php

namespace App\Http\Manager\Controller;


use App\Repository\WorkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController {


    public function __construct(
        private WorkRepository $rw
    )
    {
    }


    #[Route('/', name: 'home')]
    public function homePage(): Response{
       return $this->render('manager/index.html.twig',[
           'wip' => $this->rw->getManagerNeedToApprouve()->getResult()
       ]);
    }

}