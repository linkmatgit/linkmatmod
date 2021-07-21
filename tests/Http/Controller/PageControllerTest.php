<?php

namespace App\Tests\Http\Controller;

use App\Tests\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PageControllerTest extends WebTestCase {

    use FixturesTrait;
    private \Symfony\Bundle\FrameworkBundle\KernelBrowser $createClient;

    public function setUp(): void
    {
       $this->createClient = self::createClient();
    }


    public function testBlogPage() {
        $this->loadFixtures(['posts']);
        $this->createClient->request('GET', '/blog/');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
    public function testHomePage() {
        $this->createClient->request('GET', '/');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}