<?php

namespace App\Tests\Http\Controller;

use App\Tests\FixturesTrait;
use App\Tests\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ForumControllerTest extends WebTestCase
{
    use FixturesTrait;


    public function testIndexForum(){

        $title = 'FORUM';
        $crawler = $this->client->request('GET', '/forum/');
        $this->assertEquals($title, $crawler->filter('h1')->text());
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}