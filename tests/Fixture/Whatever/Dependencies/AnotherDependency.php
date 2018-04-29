<?php

namespace Whatever\Dependencies;

interface AnotherDependency
{
    public function handle(string $path, bool $isEnabled): void;
}
