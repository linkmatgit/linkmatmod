<?php declare(strict_types=1);

namespace App\Entity\Auth;

use App\Repository\UserRepository;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

/**
 * @method string getUserIdentifier()
 */

/**
 * $2y$13$Ka0xj4/BgKrDxhGsulaRiOjINFF7RCuqgq2Fkf/Uh3Wj2K2cfA4V.
 */
#[Uploadable]
#[UniqueEntity(fields: "username", message: 'Un autre persone utilise deja ce pseudonyme')]
#[UniqueEntity(fields: "email", message: 'Un autre persone utilise deja cette Email')]
#[Entity(repositoryClass: UserRepository::class)]
#[Table(name: "`user`")]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[Id]
    #[GeneratedValue(strategy: "IDENTITY")]
    #[Column(type: 'integer')]
    #[Groups(['read:comment'])]
    private ?int $id = null;

    #[Column(type: 'string', length: 180, unique: true)]
    #[Groups(['read:comment'])]
    private string $username = '';

    #[Column(type: 'json')]
    private array $roles = ['ROLE_USER'];

    #[Column(type: 'string')]
    private string $password = '';

    #[Column(type: 'string', length: 200, unique: true)]
    private string $email = '';

    #[Column(type: 'boolean')]
    private bool $isVerified = false;

    #[Column(type: 'string', nullable: true)]
    private ?string $avatarName =  null;

    #[UploadableField(options: ['mapping' => 'avatar', 'fileNameProperty' => 'avatarName', 'size'=> 'avatarSize'])]
    private ?File $avatarFile = null;

    #[Column(type: 'integer', nullable: true)]
    private ?int $avatarSize = null;

    #[Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $createdAt = null;

    #[Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[Column(type: 'string', nullable: true)]
    private ?string $headerName =  null;

    #[UploadableField(options: ['mapping' => 'header-profil', 'fileNameProperty' => 'headerName', 'size'=> 'headerSize'])]
    private ?File $headerFile = null;

    #[Column(type: 'integer', nullable: true)]
    private ?int $headerSize = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return User
     */
    public function setId(?int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     * @return User
     */
    public function setRoles(array $roles): User
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }


    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->avatarFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface|null $createdAt
     * @return User
     */
    public function setCreatedAt(?\DateTimeInterface $createdAt): User
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface|null $updatedAt
     * @return User
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): User
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->avatarFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->avatarName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->avatarName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->avatarSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->avatarSize;
    }
}
