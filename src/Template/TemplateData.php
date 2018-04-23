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

    public function __construct(string $className, array $usedClasses, array $setUp)
    {
        $this->className = $className;
        $this->usedClasses = $usedClasses;
        $this->setUp = $setUp;
    }
}
