<?php

namespace App\Http\Controller\Auth;



use App\Entity\Auth\User;
use App\Entity\Work\Work;
use App\Http\Form\WorkType;
use App\Repository\WorkRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profil/works', name: 'wipOwn_')]
class WorkProfileController extends AbstractController {

    public function __construct(
        private WorkRepository $repository,
        private EntityManagerInterface $em,
        private RequestStack $requestStack
    )
    {
    }

    #[Route('/', name: 'index')]
    public function index():Response {
        $this->denyAccessUnlessGranted('ROLE_USER');
        /**
         * @var $user User
         */
        $user = $this->getUser();
        return $this->render('profil/works/index.html.twig', [
            'works' => $this->repository->queryWorkByUserApprouve($user)->getResult(),
            'privates' => $this->repository->queryWorkByUserNotApprouve($user)->getResult(),
            'count' => $this->repository->queryCheckIsNotEmpty($user)->getResult()
        ]);
    }


    #[Route('/new', name: 'create')]
    public function create(Request $request): Response{
        $this->denyAccessUnlessGranted('ROLE_USER');
        /**
         * @var $user User
         */
        $user = $this->getUser();
        $work = (new Work());

        $form = $this->createForm(WorkType::class, $work);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $date = new \DateTime();
            $work->setCreatedAt($date);
            $work->setUpdatedAt($date);
            $work->setAuthor($user);
            $work->setApproved(false);
            $this->em->persist($work);
            $this->em->flush();
            $this->addFlash('success', 'Sujet Cree');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('profil/works/new.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    #[Route('/{id<\d+>}', name: 'edit')]
    public function edit(Request $request, Work $data): Response{
        $this->denyAccessUnlessGranted('ROLE_USER');
        $request =  $this->requestStack->getCurrentRequest();
        $form = $this->createForm(WorkType::class, $data);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data->setUpdatedAt(new \DateTime());
            $this->em->persist($data);
            $this->em->flush();
            $this->addFlash('success', 'Le contenu a bien été modifié');

            return $this->redirectToRoute('app_wipOwn_index' ,[], 301);
        }

        return $this->render("profil/works/edit.html.twig", [
            'form' => $form->createView()
        ]);

    }
}