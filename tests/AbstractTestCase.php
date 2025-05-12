<?php

declare(strict_types=1);

namespace App\Tests;

// use App\Traits\FakerTools;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Для работы с сущностью.
 */
abstract class AbstractTestCase extends WebTestCase
{
    //    use FakerTools;
    //    /**
    //     * Обновить значение свойства.
    //     *
    //     * @throws \ReflectionException
    //     */
    //    public function setEntityProperty(object $entity, int|string|array $value, string $field): void
    //    {
    //        $class = new \ReflectionClass($entity);
    //        $property = $class->getProperty($field);
    //        $property->setValue($entity, $value);
    //    }
}
