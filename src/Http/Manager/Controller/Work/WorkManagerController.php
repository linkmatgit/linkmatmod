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

#[Route('/wip', name: 'wipmanager_')]
class WorkManagerController extends ManagerCrudController
{

    protected string $entity = Work::class;
    protected string $templatePath = 'wip/works';
    protected string $menuItem = 'wip_manager';
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
        ->where('rows.approved = 1');
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

}