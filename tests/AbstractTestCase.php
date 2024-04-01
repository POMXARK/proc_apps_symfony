<?php

namespace App\Tests;

use App\Traits\FakerTools;
use PHPUnit\Framework\TestCase;

/**
 * Для работы с сущностью.
 */
abstract class AbstractTestCase extends TestCase
{
    use FakerTools;
    /**
     * Обновить значение защищенного свойства.
     *
     * @throws \ReflectionException
     */
    public function setEntityProperty(object $entity, int|string|array $value, string $field): void
    {
        $class = new \ReflectionClass($entity);
        $property = $class->getProperty($field);
        $property->setValue($entity, $value);
    }
}
