<?php

namespace PHPUnitKickoff\Template;

class TemplateData
{
    /** @var string */
    public $className;

    /** @var array */
    public $usedClasses;

    /** @var array */
    public $setUp;

    /** @var array */
    public $properties;

    public function __construct(string $className, array $usedClasses, array $setUp, array $properties)
    {
        $this->className = $className;
        $this->usedClasses = $usedClasses;
        $this->setUp = $setUp;
        $this->properties = $properties;
    }
}
