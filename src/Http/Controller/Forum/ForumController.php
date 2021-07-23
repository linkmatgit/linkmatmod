<?php

namespace App\Http\Controller\Forum;


use App\Entity\Auth\User;
use App\Entity\Forum\Entity\ForumTag;
use App\Entity\Forum\Entity\ForumTopic;
use App\Helper\Paginator\PaginatorInterface;
use App\Http\Form\ForumTopicForm;
use App\Http\Security\ForumVoter;
use App\Repository\Forum\ForumMessageRepository;
use App\Repository\Forum\ForumTagRepository;
use App\Repository\Forum\ForumTopicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ForumController extends AbstractController {


    public function __construct(
        private ForumTagRepository $tagRepository,
        private ForumTopicRepository $topicRepository,
        private PaginatorInterface $paginator
    )
    {
    }

    #[Route('/forum', name: 'forum')]
    public function index(Request $request): Response
    {
        return $this->tag(null, $request);
    }
    #[Route('/forum/{slug<[a-z0-9\-]+>}-{id<\d+>}', name: 'forum_tag')]
    public function tag(?ForumTag $tag, Request $request): Response {

        $topics =  $this->paginator->paginate($this->topicRepository->queryAllForTag($tag));
        return $this->render('forum/index.html.twig',[
            'tags' => $this->tagRepository->findTree(),
            'page'=>  $request->query->getInt('page', 1),
            'topics' => $topics,
            'current_tag'=> $tag,
            'menu' => 'forum',

        ]);
    }


    #[Route('/forum/{id<\d+>}', name: 'forum_show')]
    public function show(ForumTopic $topic, ForumMessageRepository $messageRepository): Response
    {
        $user = $this->getUser();

        $messageRepository->hydrateMessages($topic);


        return $this->render('forum/show.html.twig', [
            'topic' => $topic,
            'menu' => 'forum',

        ]);
    }

    #[Route('/forum/topics/{id<\d+>}', name: 'forum_show_legacy')]
    public function showLegacy(int $id): Response
    {
        return $this->redirectToRoute('forum_show', ['id' => $id], 301);
    }

  #[Route('/forum/new', name: 'forum_new')]
    public function create(Request $request): Response
    {
        $this->denyAccessUnlessGranted(ForumVoter::CREATE);
        /** @var User $user */
        $user = $this->getUser();
        $topic = (new ForumTopic())->setContent($this->renderView('forum/template/placeholder.text.twig'));
        $topic->setAuthor($user);
        $form = $this->createForm(ForumTopicForm::class, $topic);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->topicService->createTopic($topic);
            $this->addFlash('success', 'Le sujet a bien été créé');

            return $this->redirectToRoute('forum_show', ['id' => $topic->getId()]);
        }

        return $this->render('forum/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}