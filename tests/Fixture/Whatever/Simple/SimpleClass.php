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

    public function __construct(WhateverDependency $whateverDependency, AliasedAnotherDependency $anotherDependency)
    {
        $this->whateverDependency = $whateverDependency;
        $this->anotherDependency = $anotherDependency;
    }

    public function handle(): string
    {
        $this->anotherDependency->handle();

        return $this->whateverDependency->getStuff();
    }
}
