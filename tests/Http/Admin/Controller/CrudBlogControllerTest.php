<?php

namespace App\Tests\Http\Admin\Controller;

use App\Tests\FixturesTrait;
use App\Tests\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Yaml;

class CrudBlogControllerTest extends WebTestCase {

    private \Symfony\Bundle\FrameworkBundle\KernelBrowser $createClient;

    use FixturesTrait;

    public function testAccesDenied():void {
      $test =  $this->client->request('GET', '/admin/blog');
        $this->assertResponseRedirects('/login');
    }
    public function testAccessDeniedForUserBlog() {

        $user = $this->loadFixtures(['users']);
        $this->login($user['user1']);
        $this->client->request('GET', '/admin/blog');
        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

}