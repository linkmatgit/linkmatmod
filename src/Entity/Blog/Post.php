<?php

namespace App\Entity\Blog;

use App\Entity\Application\Entity\Content;


use App\Repository\PostRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;


#[Entity(repositoryClass: PostRepository::class, readOnly: false)]

class Post extends Content
{

    #[ManyToOne(targetEntity: 'App\Entity\Blog\Category', inversedBy: "post")]
    #[JoinColumn(onDelete: 'SET NULL')]
    private ?Category $category = null;

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category|null $category
     * @return Post
     */
    public function setCategory(?Category $category): Post
    {
        $this->category = $category;
        return $this;
    }



}
