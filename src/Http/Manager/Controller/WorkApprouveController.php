<?php


namespace App\Http\Manager\Controller;


use App\Entity\Auth\User;
use App\Entity\Work\Work;
use App\Http\Manager\Form\DeclineWipType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wip/action', name: 'wipaction_')]
class WorkApprouveController extends ManagerCrudController
{

    protected string $entity = Work::class;
    protected string $templatePath = 'workaction';
    protected string $menuItem = 'wip_action';
    protected string $routePrefix = '';
    protected string $searchField = 'name';
    protected array $events = [
        'update' => null,
        'create' => null,
        'delete' => null
    ];

    #[Route('/require', name: 'require_index')]
    public function index() :Response {
        $request = $this->requestStack->getCurrentRequest();
        $query = $this->getRepository()->createQueryBuilder('rows')
        ->orderBy('rows.createdAt', 'DESC')
        ->where('rows.approved = 0');
        if ($request->get('q')) {
            $query = $this->applySearch(trim($request->get('q')), $query);
        }
        $this->paginator->allowSort('row.id', 'row.name');
        $rows = $this->paginator->paginate($query->getQuery());

        return $this->renderManager("index.html.twig", [
            'rows' => $rows,
            'searchable' => true,
            'menu' => $this->menuItem,
        ]);
    }
    #[Route('/require/{id<\d+>}', name: 'show')]
    public function approuve(Work $work): Response {

        return $this->renderManager('show.html.twig', [
            'wip' => $work,
            'menu' => $this->menuItem

        ]);

    }

    #[Route("/require/{id<\d+>}/confirm", name: 'confirm', methods: 'POST')]
    public function setPublic(Work $work): RedirectResponse {
        /** @var User $user */
        $user = $this->getUser();
        $work->setApprouveBy($user);
        $work->setApprouvedAt(new \DateTime());
        $work->setApproved(1);
        $this->em->persist($work);
        $this->em->flush();
        $this->addFlash('success', 'Le Wip a bien ete mit en ligne');
       return $this->redirectToRoute('manager_wipaction_require_index');
    }
    #[Route("/require/{id<\d+>}/decline", name: 'decline', methods: 'POST')]
    public function setDecline(Work $work, Request $request): Response {

        $form = $this->createForm(DeclineWipType::class, $work);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash("Success", 'Le WIP a bien ete Refusée');
            return $this->redirectToRoute('manager_wipaction_require_index');
        }
        return $this->render('manager/works/decline/decline.html.twig', [
            'work' => $work,
            'form'     => $form->createView()
        ]);
    }
}