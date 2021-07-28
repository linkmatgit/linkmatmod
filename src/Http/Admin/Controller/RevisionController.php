<?php

namespace App\Http\Admin\Controller;


use App\Entity\Revision\Event\WipRevisionAcceptedEvent;
use App\Entity\Revision\Event\WipRevisionRefusedEvent;
use App\Entity\Revision\WipTagRevision;
use App\Entity\Work\Event\WorkCreatedEvent;
use App\Entity\Work\Event\WorkDeletedEvent;
use App\Entity\Work\Event\WorkUpdatedEvent;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Permet la gestion du blog.
 */
final class RevisionController extends CrudController
{
    protected string $templatePath = 'revision';
    protected string $menuItem = 'revision';
    protected string $entity = WipTagRevision::class;
    protected string $routePrefix = 'admin_wip_revision';
    protected array $events = [
        'update' => WorkUpdatedEvent::class,
        'delete' => WorkDeletedEvent::class,
        'create' => WorkCreatedEvent::class,
    ];

    /**
     * @Route("/revision/{id<\d+>}", methods={"GET", "POST"}, name="revision_show")
     */
    #[Route('/revision/{id<\d+>}', name: 'revision_show', methods: ['GET', 'POST'])]
    public function edit(WipTagRevision $revision, Request $request, EventDispatcherInterface $dispatcher): Response
    {
        if ('POST' === $request->getMethod()) {
            $isDeleteRequest = null !== $request->get('delete');
            if ($isDeleteRequest) {
                $revision->setStatus(WipTagRevision::REJECTED);
                $revision->setContent('');
                $this->em->flush();
                $this->addFlash('success', 'La révision a bien été supprimée');
            } else {
                $revision->setContent($request->get('content'));
                $content = $revision->getTarget();
                $previous = clone $content;
                $content->setContent($revision->getContent());
                $revision->setStatus(WipTagRevision::ACCEPTED);
                $revision->setContent('');
                $content->setApproved(1);
                $content->setReason(null);
                $content->setReasonType(null);
                $this->em->flush();
                $dispatcher->dispatch(new WorkUpdatedEvent($content, $previous));
                $dispatcher->dispatch(new WipRevisionAcceptedEvent($revision));

                $this->addFlash('success', 'La révision a bien été acceptée');
            }

            return $this->redirectToRoute('manager_work_revision_accept', ['id' => $revision->getId()]);
        }

        return $this->render('admin/revision/edit.html.twig', [
            'revision' => $revision,
        ]);
    }

    /**
     * @Route("/revision/{id<\d+>}", methods={"DELETE"})
     */
    #[Route('/revision/{id<\d+>}', methods: ['DELETE'])]
    public function delete(WipTagRevision $revision, EventDispatcherInterface $dispatcher): Response
    {
        $dispatcher->dispatch(new WipRevisionRefusedEvent($revision));
        $this->addFlash('success', 'La révision a bien été supprimée');

        return $this->redirectToRoute('admin_app_dashboard');
    }
}