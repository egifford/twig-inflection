<?php

use DaveDevelopment\TwigInflection\Twig\Extension\Inflection;
use Twig\Test\IntegrationTestCase;

/**
 *
 */
class TwigInflectionIntegrationTest extends IntegrationTestCase
{
    /**
     * @return array
     */
    public function getExtensions(): array
    {
        return [
            new Inflection(),
        ];
    }

    /**
     * @return string
     */
    public function getFixturesDir(): string
    {
        return __DIR__ . '/Fixtures/';
    }
}
