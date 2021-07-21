<?php declare(strict_types=1);

namespace App\Entity\Auth\Dto;

use App\Entity\Auth\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
class AvatarDto
{

    #[Assert\NotBlank()]
    #[Assert\Image(mimeTypes: ['image/jpeg', 'image/png'], minWidth: 110, maxWidth: 1400, maxHeight: 1400, minHeight: 110)]
    public UploadedFile $file;


    public User $user;

    public function __construct(UploadedFile $file, User $user)
    {
        $this->file = $file;
        $this->user = $user;
    }
}