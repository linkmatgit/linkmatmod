<?php


namespace App\Http\Manager\Controller;


use App\Entity\Application\Entity\Content;
use App\Helper\Paginator\PaginatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class ManagerCrudController extends ManagerAbstractController
{
    protected string $entity = Content::class;

    protected string $templatePath = 'blog';
    protected string $menuItem = '';
    protected string $routePrefix = '';
    protected string $searchField = 'title';
    protected array $events = [
        'update' => null,
        'create' => null,
        'delete' => null
    ];

    public function __construct(
        protected EntityManagerInterface $em,
        protected PaginatorInterface $paginator,
        private EventDispatcherInterface $dispatcher,
        protected RequestStack $requestStack)
    {
    }


    public function managerIndex(QueryBuilder $query = null): Response
    {
        /** @var Request $request */
        $request = $this->requestStack->getCurrentRequest();
        $query = $query ?: $this->getRepository()->createQueryBuilder('row')
            ->orderBy('row.createdAt', 'DESC');
        if ($request->get('q')) {
            $query = $this->applySearch(trim($request->get('q')), $query);
        }
        $this->paginator->allowSort('row.id', 'row.title');
        $rows = $this->paginator->paginate($query->getQuery());
        return $this->render("manager/{$this->templatePath}/index.html.twig", [
            'rows' => $rows,
            'searchable' => true,
            'menu' => $this->menuItem,
            'prefix' => $this->routePrefix
        ]);

    }
    public function renderManager(string $path, array $params){

        return $this->render("manager/{$this->templatePath}/{$path}", $params);
    }

    public function getRepository(): EntityRepository
    {
        /** @var EntityRepository $repository */
        $repository = $this->em->getRepository($this->entity);

        return $repository;
    }

    protected function applySearch(string $search, QueryBuilder $query): QueryBuilder
    {
        return $query
            ->where("LOWER(row.{$this->searchField}) LIKE :search")
            ->setParameter('search', '%'.strtolower($search).'%');
    }
}