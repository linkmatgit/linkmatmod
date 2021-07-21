<?php

namespace App\Http\Admin\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PageController extends AdminAbstractController {


    #[Route('/', name: 'app_dashboard')]
    public function dashBoard(): Response
    {
       return $this->render('admin/index.html.twig');
    }
}