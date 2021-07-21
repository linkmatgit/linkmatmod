<?php

namespace App\Tests\Entity\Blog;

use App\Entity\Auth\User;
use App\Entity\Blog\Category;
use App\Entity\Blog\Post;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BlogTest extends KernelTestCase
{

    public function setUp(): void
    {

    }

    public function testValidEntity() {
        $kernel = self::bootKernel();

        $user = (new User());
        $category = (new Category());
        $post = (new Post())
            ->setSlug('ceci-est-un-slug')
            ->setAuthor($user)
            ->setCategory($category)
            ->setContent("Bonjour a tous mes amis")
            ->setCreatedAt(new \DateTime())
            ->setTitle('test un tite')
            ->setUpdatedAt(new \DateTime());
        $error =  $this->getContainer()->get('validator')->validate($post);


            $this->assertCount(0, $error);


    }
    public function testInValidEntity() {


        $kernel = self::bootKernel();
        $user = (new User());
        $category = (new Category());
        $post = (new Post())
            ->setSlug('ceci-est-un-slug')
            ->setAuthor($user)
            ->setCategory($category)
            ->setContent("Bo")
            ->setCreatedAt(new \DateTime())
            ->setTitle('test un tite')
            ->setUpdatedAt(new \DateTime());
        $error =  $this->getContainer()->get('validator')->validate($post);


        $this->assertCount(1, $error);


    }

    public function testInValidslug() {

        $kernel = self::bootKernel();

        $user = (new User());
        $category = (new Category());
        $post = (new Post())
            ->setSlug('ceci-est-un-slug')
            ->setAuthor($user)
            ->setCategory($category)
            ->setContent("B6494949o")
            ->setCreatedAt(new \DateTime())
            ->setTitle('test un tite')
            ->setUpdatedAt(new \DateTime());
        $error =  $this->getContainer()->get('validator')->validate($post);
        $this->assertCount(0, $error);


    }

}