<?php

namespace App\Entity\Work;

use ApiPlatform\Core\Bridge\Doctrine\Common\Util\IdentifierManagerTrait;
use App\Entity\Attachments\Entity\WipAttachment;
use App\Entity\Auth\User;
use App\Entity\Manager\ManageableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity()]
#[ORM\Table(name: 'wip_tag')]
class Work
{
    use TypeChoice;
    use ManageableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 70)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $createdAt = null;


    #[ORM\OneToMany(mappedBy: 'tags', targetEntity: WorkTopic::class)]
    private Collection $topics;


    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private User $author;

    #[ORM\OneToMany(mappedBy: 'tags', targetEntity: WipAttachment::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $pictures;


    public $pictureFiles;

    public function __construct()
    {
        $this->topics = new ArrayCollection();
        $this->pictures = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

         /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return Work
     */
    public function setContent(?string $content): Work
    {
        $this->content = $content;
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
     * @return Work
     */
    public function setAuthor(User $author): Work
    {
        $this->author = $author;
        return $this;
    }

    public function getTopics(): Collection {
        return $this->topics;

    }

    public function addTopics(WorkTopic $topic): self
    {

        if(!$this->topics->contains($topic)){
            $this->topics[] = $topic;
            $topic->setTags($this);
        }
        return $this;
    }
    public function removeTopic(WorkTopic $topic):self {
        if($this->topics->removeElement($topic)){
            if($topic->getTags() === $this) {
                $topic->setTags(null);
            }

        }
        return $this;
    }

    public function getPictures():Collection {
        return $this->pictures;
    }
    public function getPicture(): ?WipAttachment {
        if($this->pictures->isEmpty()){
            return null;
        }
        return $this->pictures->first();
    }
    public function addPicture(WipAttachment $attachment):self{
        if(!$this->pictures->contains($attachment)){
            $this->pictures[] = $attachment;
            $attachment->setTags($this);
        }
        return $this;
    }
    public function removePicture(WipAttachment $attachment): self{
        if ($this->pictures->contains($attachment)) {
            $this->pictures->removeElement($attachment);
            if($attachment->getTags() === $this) {
                $attachment->setTags(null);
            }
        }
        return $this;
    }

    public function getPictureFile()
    {
        return $this->pictureFiles;
    }

    /**
     * @param mixed $pictureFiles
     * @return Work
     */
    public function setPictureFiles(mixed $pictureFiles): self {
        foreach ($pictureFiles as $pictureFile) {
            $attachment = new WipAttachment();
            $attachment->setImageFile($pictureFile);
            $this->addPicture($attachment);
        }
        $this->pictureFiles = $pictureFiles;
        return $this;
    }

}