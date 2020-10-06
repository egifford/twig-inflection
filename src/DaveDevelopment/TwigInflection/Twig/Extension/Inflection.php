<?php

namespace DaveDevelopment\TwigInflection\Twig\Extension;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\InflectorFactory;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 *
 */
class Inflection extends AbstractExtension
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return "TwigInflection";
    }

    /**
     * @return TwigFilter[]
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('pluralize', __CLASS__ . '::pluralize'),
            new TwigFilter('singularize', __CLASS__ . '::singularize'),
        ];
    }

    /**
     * Singularize the $plural word if count == 1. If $singular is passed, it
     * will be used instead of trying to use doctrine\inflector
     *
     * @param string      $plural   - chicken
     * @param int         $count    - e.g. 4
     * @param string|null $singular - (optional) chickens
     *
     * @return string
     */
    public static function singularize(string $plural, int $count = 1, ?string $singular = null): string
    {
        if ($count !== 1) {
            return $plural;
        }

        if (null === $singular) {
            $singular = self::getInflector()->singularize($plural);
        }

        return $singular;
    }

    /**
     * Pluralize the $singular word if count !== 1. If $plural is passed, it
     * will be used instead of trying to use doctrine\inflector
     *
     * @param string      $singular - chicken
     * @param int         $count    - e.g. 4
     * @param string|null $plural   - (optional) chickens
     *
     * @return string
     */
    public static function pluralize(string $singular, int $count = 2, ?string $plural = null): string
    {
        if ($count === 1) {
            return $singular;
        }

        if (null === $plural) {
            $plural = self::getInflector()->pluralize($singular);
        }

        return $plural;
    }

    /**
     * @var Inflector|null
     */
    private static ?Inflector $INFLECTOR = null;

    /**
     * @return Inflector
     */
    private static function getInflector(): Inflector
    {
        if (null === self::$INFLECTOR) {
            self::$INFLECTOR = InflectorFactory::create()->build();
        }

        return self::$INFLECTOR;
    }
}
