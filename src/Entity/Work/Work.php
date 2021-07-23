<?php

namespace App\Entity\Work;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Application\Entity\Content;
use App\Entity\Mods\Entity\ModsCategory;
use App\Http\Api\Controller\CommentCreateController;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\AssignOp\Mod;


#[ORM\Entity()]
#[ORM\Table('wip_tag')]
#[ApiResource(

    collectionOperations: [],
    itemOperations: [
        'delete' => ['security' => 'is_granted("ROLE_USER")']
    ],
    normalizationContext: ['groups' => ['read:comment']],
    paginationItemsPerPage: 10,
)
]
class Work extends Content
{
    use TypeChoice;


    #[ORM\OneToMany(mappedBy: 'tags', targetEntity: WorkTopic::class)]
    private Collection $topics;

    #[ORM\ManyToOne(targetEntity: ModsCategory::class )]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ModsCategory $category;

    public function __construct()
    {
        $this->topics = new ArrayCollection();
    }

    public function getTopics(): Collection
    {
        return $this->topics;
    }

    public function addTopic(WorkTopic $topic): self
    {
        if (!$this->topics->contains($topic)) {
            $this->topics[] = $topic;
            $topic->addTag($this);
        }

        return $this;
    }

    public function removeTopic(WorkTopic $topic): self
    {
        if ($this->topics->contains($topic)) {
            $this->topics->removeElement($topic);
            $topic->removeTag($this);
        }

        return $this;
    }
       /**
     * @return ModsCategory
     */
    public function getCategory(): ModsCategory
    {
        return $this->category;
    }

    /**
     * @param ModsCategory $category
     * @return Work
     */
    public function setCategory(ModsCategory $category): self
    {
        $this->category = $category;
        return $this;
    }

}