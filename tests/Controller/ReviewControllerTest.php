<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReviewControllerTest extends WebTestCase
{
    public function testReviewIndexPageLoadsSuccessfully(): void
    {
        $client = static::createClient();

        $client->request('GET', '/');

        self::assertResponseIsSuccessful();

        self::assertSelectorTextContains(
            'h1',
            'Vélemények'
        );

        self::assertPageTitleContains('Vélemények');
    }

    public function testNewReviewPageLoadsSuccessfully(): void
    {
        $client = static::createClient();

        $client->request('GET', '/review/new');

        self::assertResponseIsSuccessful();

        self::assertSelectorTextContains(
            'h1',
            'Új vélemény'
        );
    }

    public function testCompaniesPageLoadsSuccessfully(): void
    {
        $client = static::createClient();

        $client->request('GET', '/review/companies');

        self::assertResponseIsSuccessful();

        self::assertSelectorTextContains(
            'h1',
            'Cégek statisztikái'
        );
    }
}
