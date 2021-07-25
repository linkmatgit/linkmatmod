<?php

namespace App\Entity\Attachments\Entity;

use App\Entity\Work\Work;
use App\Entity\Work\WorkTopic;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity()]
#[Vich\Uploadable]
class WipAttachment
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[Assert\Image(['image/jpg', 'image/jpeg', 'image/png'])]
    #[Vich\UploadableField(options: ['mapping'=> 'wip_image', 'fileNameProperty' => 'filename'])]
    private File $imageFile;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $fileName;

    #[ORM\ManyToOne(targetEntity: Work::class, inversedBy: 'pictures')]
    private ?Work $tags = null;

  #[ORM\ManyToOne(targetEntity: WorkTopic::class, inversedBy: 'pictures')]
    private ?WorkTopic $topic = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return WipAttachment
     */
    public function setId(?int $id): WipAttachment
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile(): File
    {
        return $this->imageFile;
    }

    /**
     * @param File $imageFile
     * @return WipAttachment
     */
    public function setImageFile(File $imageFile): WipAttachment
    {
        $this->imageFile = $imageFile;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     * @return WipAttachment
     */
    public function setFileName(string $fileName): WipAttachment
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * @return Work|null
     */
    public function getTags(): ?Work
    {
        return $this->tags;
    }

    /**
     * @param Work|null $tags
     * @return WipAttachment
     */
    public function setTags(?Work $tags): WipAttachment
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return WorkTopic|null
     */
    public function getTopic(): ?WorkTopic
    {
        return $this->topic;
    }

    /**
     * @param WorkTopic|null $topic
     * @return WipAttachment
     */
    public function setTopic(?WorkTopic $topic): WipAttachment
    {
        $this->topic = $topic;
        return $this;
    }

}