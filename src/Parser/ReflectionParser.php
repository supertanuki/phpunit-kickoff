<?php

namespace PHPUnitKickoff\Parser;

class ReflectionParser
{
    /** @var \ReflectionClass */
    private $class;

    public function __construct(string $fqcn)
    {
        $this->class = new \ReflectionClass($fqcn);
    }
    
    public function getNamespaceName(): string
    {
        return $this->class->getNamespaceName();
    }

    public function getClassName(): string
    {
        return $this->class->getShortName();
    }

    public function getFileName(): string
    {
        return $this->class->getFileName();
    }

    public function getConstructorArguments(): array
    {
        $constructor = $this->class->getConstructor();
        $constructorParameters = $constructor->getParameters();

        $results = [];

        foreach ($constructorParameters as $constructorParameter) {
            $results[$constructorParameter->getName()] = $constructorParameter->getType()
                ? $constructorParameter->getType()->getName()
                : null;
        }

        return $results;
    }
}
