<?php

namespace App\Entity\Attachment;

use App\Repository\AttachmentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity()]
#[Vich\Uploadable]
class Attachment {

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: Types::INTEGER)]
    protected ?int $id;

    #[Vich\UploadableField(['mapping' => 'attachments',  'fileNameProperty' => 'fileName', 'size' => 'fileSize'])]
    private ?File $file = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $fileName = '';

    #[ORM\Column(type: Types::INTEGER, options: ['unsigned' => true])]
    private int $fileSize = 0;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id ?: 0;
    }

    /**
     * @param int|null $id
     * @return Attachment
     */
    public function setId(?int $id): Attachment
    {
        $this->id = $id;
        return $this;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): self
    {
        $this->fileName = $fileName ?: '';

        return $this;
    }

    /**
     * @return int
     */
    public function getFileSize(): int
    {
        return $this->fileSize;
    }

    /**
     * @param int $fileSize
     * @return Attachment
     */
    public function setFileSize(int $fileSize): Attachment
    {
        $this->fileSize = $fileSize ?: 0;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return Attachment
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): Attachment
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): Attachment
    {
        $this->file = $file;

        return $this;
    }


}