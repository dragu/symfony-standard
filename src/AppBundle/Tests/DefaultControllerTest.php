<?php

namespace AppBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testCsrfRequired()
    {
        $client = static::createClient();

        $client->request('GET', '/csrf');
        $response = $client->getResponse();

        $this->assertSame('The CSRF token is invalid. Please try to resubmit the form.', $response->getContent());
    }

    public function testCsrfIsDisabledByExtension()
    {
        $client = static::createClient();

        $client->request('GET', '/no-csrf');
        $response = $client->getResponse();

        $this->assertSame('OK', $response->getContent());
    }
}
