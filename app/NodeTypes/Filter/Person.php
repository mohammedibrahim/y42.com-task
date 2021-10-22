<?php

namespace App\NodeTypes\Filter;

use App\Abstracts\AbstractTransformObject;

class Person extends AbstractTransformObject
{
    protected string $name;

    protected string $age;

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $age
     */
    public function setAge(string $age): void
    {
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAge(): string
    {
        return $this->age;
    }
}