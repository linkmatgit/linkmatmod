<?php declare(strict_types=1);

namespace App\Entity\Auth;

use App\Entity\Teams\TeamUserTrait;
use App\Repository\UserRepository;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use JetBrains\PhpStorm\Pure;
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
 * $2y$13$Ka0xj4/BgKrDxhGsulaRiOjINFF7RCuqgq2Fkf/Uh3Wj2K2cfA4V.
 */
#[Uploadable]
#[UniqueEntity(fields: "username", message: 'Un autre persone utilise deja ce pseudonyme')]
#[UniqueEntity(fields: "email", message: 'Un autre persone utilise deja cette Email')]
#[Entity(repositoryClass: UserRepository::class)]
#[Table(name: "`user`")]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use TeamUserTrait;

    #[Id]
    #[GeneratedValue(strategy: "IDENTITY")]
    #[Column(type: Types::INTEGER)]
    #[Groups(['read:comment'])]
    private ?int $id = null;

    #[Column(type: Types::STRING, length: 180, unique: true)]
    #[Groups(['read:comment'])]
    private string $username = '';

    #[Column(type: Types::JSON)]
    private array $roles = ['ROLE_USER'];

    #[Column(type: Types::STRING)]
    private string $password = '';

    #[Column(type: Types::STRING, length: 200, unique: true)]
    private string $email = '';

    #[Column(type: Types::BOOLEAN)]
    private bool $isVerified = false;

    #[Column(type: Types::STRING, nullable: true)]
    private ?string $avatarName =  null;

    #[UploadableField(options: ['mapping' => 'avatar', 'fileNameProperty' => 'avatarName', 'size'=> 'avatarSize'])]
    private ?File $avatarFile = null;

    #[Column(type: Types::INTEGER, nullable: true)]
    private ?int $avatarSize = null;

    #[Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $createdAt = null;

    #[Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[Column(type: Types::STRING, nullable: true)]
    private ?string $headerName =  null;

    #[UploadableField(options: ['mapping' => 'header-profil', 'fileNameProperty' => 'headerName', 'size'=> 'headerSize'])]
    private ?File $headerFile = null;

    #[Column(type: Types::INTEGER, nullable: true)]
    private ?int $headerSize = null;

    #[Column(type: Types::STRING, nullable: true, options: ['default' => null])]
    private ?string $lastLoginIp = null;

    #[Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $lastLoginAt = null;

    #[Column(type: Types::STRING, nullable: true, options: ['default' => null])]
    private ?string $theme = null;

    #[Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $bannedAt = null;

    #[Column(type: Types::STRING, length: 2, nullable: true, options: ['default' => 'CA'])]
    private ?string $country = null;
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
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
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

    /**
     * @return string|null
     */
    public function getLastLoginIp(): ?string
    {
        return $this->lastLoginIp;
    }

    /**
     * @param string|null $lastLoginIp
     * @return User
     */
    public function setLastLoginIp(?string $lastLoginIp): User
    {
        $this->lastLoginIp = $lastLoginIp;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getLastLoginAt(): ?\DateTimeInterface
    {
        return $this->lastLoginAt;
    }

    /**
     * @param \DateTimeInterface|null $lastLoginAt
     * @return User
     */
    public function setLastLoginAt(?\DateTimeInterface $lastLoginAt): User
    {
        $this->lastLoginAt = $lastLoginAt;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTheme(): ?string
    {
        return $this->theme;
    }

    /**
     * @param string|null $theme
     * @return User
     */
    public function setTheme(?string $theme): User
    {
        $this->theme = $theme;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getBannedAt(): ?\DateTimeInterface
    {
        return $this->bannedAt;
    }

    /**
     * @param \DateTimeInterface|null $bannedAt
     * @return User
     */
    public function setBannedAt(?\DateTimeInterface $bannedAt): User
    {
        $this->bannedAt = $bannedAt;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     * @return User
     */
    public function setCountry(?string $country): User
    {
        $this->country = $country;
        return $this;
    }

}
