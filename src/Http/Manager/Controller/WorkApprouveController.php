<?php


namespace App\Http\Manager\Controller;


use App\Entity\Application\Entity\Content;
use App\Entity\Auth\User;
use App\Entity\Work\Work;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WorkApprouveController extends ManagerCrudController
{

    protected string $entity = Work::class;
    protected string $templatePath = 'work';
    protected string $menuItem = 'wip_action';
    protected string $routePrefix = '';
    protected string $searchField = 'name';
    protected array $events = [
        'update' => null,
        'create' => null,
        'delete' => null
    ];

    #[Route('wip/action/require', name: 'wip_require_index')]
    public function index() :Response {
        $request = $this->requestStack->getCurrentRequest();
        $query = $this->getRepository()->createQueryBuilder('rows')
        ->orderBy('rows.createdAt', 'DESC')
        ->where('rows.approved = false');
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
    #[Route('wip/action/require/{id<\d+>}', name: 'wip_show_approuve')]
    public function approuve(Work $work): Response {

        return $this->renderManager('show.html.twig', [
            'wip' => $work,
            'menu' => $this->menuItem

        ]);

    }

    #[Route("/{id<\d+>}/confirm", name: 'confirm', methods: 'POST')]
    public function setPublic(Work $work): RedirectResponse {
        /** @var User $user */
        $user = $this->getUser();
        $work->setApprouveBy($user);
        $work->setApprouvedAt(new \DateTime());
        $work->setApproved(true);
        $this->em->persist($work);
        $this->em->flush();
        $this->addFlash('success', 'Le Wip a bien ete mit en ligne');
       return $this->redirectToRoute('manager_wip_require_index');
    }
}