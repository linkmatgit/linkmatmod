<?php


namespace App\Http\Manager\Controller\Work;


use App\Entity\Auth\User;
use App\Entity\Work\Work;
use App\Http\Manager\Controller\ManagerCrudController;
use App\Http\Manager\Form\DeclineWipType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wip/decline', name: 'wipdecline_')]
class WorkDeclineontroller extends ManagerCrudController
{

    protected string $entity = Work::class;
    protected string $templatePath = 'workdecline';
    protected string $menuItem = 'wip_decline';
    protected string $routePrefix = '';
    protected string $searchField = 'name';
    protected array $events = [
        'update' => null,
        'create' => null,
        'delete' => null
    ];

    #[Route('/', name: 'index')]
    public function index() :Response {
        $request = $this->requestStack->getCurrentRequest();

        $query = $this->getRepository()->createQueryBuilder('rows')
        ->orderBy('rows.createdAt', 'DESC')
        ->where('rows.approved = 2');
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

    #[Route('/{id<\d+>}', name: 'show')]
    public function show(Work $work): Response {

        return $this->renderManager('show.html.twig', [
            'wip' => $work,
            'menu' => $this->menuItem

        ]);
        }

    }