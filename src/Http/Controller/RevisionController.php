<?php

namespace App\Http\Controller;

use App\Entity\Auth\User;
use App\Entity\Revision\Event\WipRevisionSubmittedEvent;
use App\Entity\Revision\WipTagRevision;
use App\Entity\Work\Work;
use App\Helper\Paginator\PaginatorInterface;
use App\Http\Form\RevisionForm;
use App\Repository\WipTagRevisionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @method User getUser()
 */
class RevisionController extends AbstractController
{

    public function __construct(
       private EventDispatcherInterface $eventDispatcher,
       private WipTagRevisionRepository $repository,
       private EntityManagerInterface $em
    )
    {
    }

    /**
     * @Route("/revisions", name="revisions")
     * @IsGranted("ROLE_USER")
     */
    public function index(
        WipTagRevisionRepository $repository,
        PaginatorInterface $paginator

    ): Response {
        $query = $repository->queryAllForUser($this->getUserOrThrow());
        $revisions = $paginator->paginate($query->getQuery());

        return $this->render('account/revisions.html.twig', [
            'revisions' => $revisions,
            'menu' => 'account',
        ]);
    }

    /**
     * Affiche la page qui permet la soumission d'une révision.
     *
     * @Route("/revision/{id<\d+>}", name="revision")
     * @IsGranted(App\Http\Security\RevisionVoter::ADD)
     */
    public function show(Work $content, Request $request): Response
    {
        $revision = $this->revisionFor($this->getUser(), $content);
        $form = $this->createForm(RevisionForm::class, $revision);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if (!$form->isValid()) {
                $this->flashErrors($form);
            } else {
                $this->submitRevision($revision);
                $this->addFlash(
                    'success',
                    "Votre modification a bien été enregistrée, vous pouvez revenir sur vos changements tant qu'ils n'ont pas été validés"
                );
            }
        }

        return $this->render('profil/works/Revision.html.twig', [
            'revision' => $revision,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Propose une modification au contenu.
     */
    public function submitRevision(WipTagRevision $revision): void
    {
        $revision->setCreatedAt(new \DateTime());
        $isNew = null === $revision->getId();
        if ($isNew) {
            $this->em->persist($revision);
        }
        $this->em->flush();
        if ($isNew) {
            $this->eventDispatcher->dispatch(new WipRevisionSubmittedEvent($revision));
        }
    }

    /**
     * Renvoie la révision courante pour le contenu/utilisateur ou génère une nouvelle révision.
     */
    public function revisionFor(User $user, Work $content): WipTagRevision
    {
        $revision = $this->repository->findFor($user, $content);
        if (null !== $revision) {
            return $revision;
        }

        return (new WipTagRevision())
            ->setContent($content->getContent() ?: '')
            ->setTarget($content)
            ->setAuthor($user);
    }
}