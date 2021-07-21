<?php

namespace App\Http\Controller\Auth;

use App\Entity\Auth\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{

    #[Route("/profil", name: 'profil_update')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function updateProfil(){
        $user = $this->getUser();

        return $this->render('profil/update.html.twig',[
            'user' => $user
        ]);
    }
}