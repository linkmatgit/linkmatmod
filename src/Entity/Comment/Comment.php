<?php

namespace App\Entity\Comment;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Application\Entity\Content;
use App\Entity\Auth\User;
use App\Entity\Blog\Post;
use App\Http\Api\Controller\CommentCreateController;
use App\Repository\CommentRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[Entity(repositoryClass: CommentRepository::class, readOnly: false)]
#[ApiResource(

    collectionOperations: ['get', 'post' => [
        'security' => 'is_granted("ROLE_USER")',
        'controller' => CommentCreateController::class]],
    itemOperations: [
        'get' => ['normalization_context' =>['groups' => ['read:comment']]],
        'put' => ['security' => 'is_granted("ROLE_USER")'],
        'delete' => ['security' => 'is_granted("ROLE_USER")']
        ],
    normalizationContext: ['groups' => ['read:comment']],
    paginationItemsPerPage: 10,
),

ApiFilter(SearchFilter::class, properties: ['target' => 'exact'])
]
#[ApiFilter(OrderFilter::class, properties: ['id' => 'DESC'])]


class Comment
{
    #[Id]
    #[GeneratedValue(strategy: "IDENTITY")]
    #[Column(type: 'integer')]
    #[Groups(['read:comment'])]
    private ?int $id = null;

    #[Column(type: 'text')]
    #[Assert\NotBlank(message: 'comment.blank')]
    #[Assert\Length(min: 5, max: 10000, minMessage: 'comment.too_short', maxMessage: 'comment.too_long')]
    #[Groups(['read:comment'])]
    private string $content;

    #[Column(type: 'datetime')]
    #[Groups(['read:comment'])]
    private DateTimeInterface $publishAt;

    #[ManyToOne(targetEntity: User::class)]
    #[JoinColumn(nullable: false, onDelete: 'CASCADE')]
    #[Groups(['read:comment'])]
    private User $author;


    #[ManyToOne(targetEntity: Content::class)]
    #[JoinColumn(name: "content_id", nullable: true, onDelete: 'CASCADE')]
    private Content $target;


    public function __construct()
    {
        $this->publishAt = new \DateTime();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Comment
     */
    public function setId(?int $id): Comment
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Comment
     */
    public function setContent(string $content): Comment
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return \DateTime|DateTimeInterface
     */
    public function getPublishAt(): \DateTime|DateTimeInterface
    {
        return $this->publishAt;
    }

    /**
     * @param \DateTime|DateTimeInterface $publishAt
     * @return Comment
     */
    public function setPublishAt(\DateTime|DateTimeInterface $publishAt): Comment
    {
        $this->publishAt = $publishAt;
        return $this;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     * @return Comment
     */
    public function setAuthor(User $author): Comment
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return Post
     */
    public function getTarget(): Post
    {
        return $this->target;
    }

    /**
     * @param Post $target
     * @return Comment
     */
    public function setTarget(Post $target): Comment
    {
        $this->target = $target;
        return $this;
    }

}