<?php

namespace Whatever\Simple;

use Whatever\Dependencies\AnotherDependency as AliasedAnotherDependency;
use Whatever\Dependencies\WhateverDependency;

class SimpleClass
{
    /** @var WhateverDependency */
    private $whateverDependency;

    /** @var AliasedAnotherDependency */
    private $anotherDependency;

    /** @var string */
    private $path;

    /** @var bool */
    private $isEnabled;

    private $notTypedVariable;

    public function __construct(
        WhateverDependency $whateverDependency,
        AliasedAnotherDependency $anotherDependency,
        string $path,
        bool $isEnabled,
        $notTypedVariable
    ) {
        $this->whateverDependency = $whateverDependency;
        $this->anotherDependency = $anotherDependency;
        $this->path = $path;
        $this->isEnabled = $isEnabled;
        $this->notTypedVariable = $notTypedVariable;
    }

    public function handle(): string
    {
        if ($this->notTypedVariable) {
            $this->anotherDependency->handle($this->path, $this->isEnabled);
        }

        return $this->whateverDependency->getStuff();
    }
}
