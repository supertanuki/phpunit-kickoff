<?php

use PHPUnit\Framework\TestCase;
use PHPUnitKickoff\Parser\ReflectionParser;

final class ReflectionParserTest extends TestCase
{
    public function testReflectionParser()
    {
        require __DIR__ . '/../Fixture/Whatever/Simple/SimpleClass.php';

        $reflectionParser = new ReflectionParser('Whatever\Simple\SimpleClass');

        $this->assertEquals('SimpleClass.php', basename($reflectionParser->getFileName()));
        $this->assertEquals('SimpleClass', $reflectionParser->getClassName());
        $this->assertEquals('Whatever\Simple', $reflectionParser->getNamespaceName());

        $this->assertEquals(
            [
                'whateverDependency' => 'Whatever\Dependencies\WhateverDependency',
                'anotherDependency' => 'Whatever\Dependencies\AnotherDependency',
                'path' => 'string',
                'isEnabled' => 'bool',
                'notTypedVariable' => null,
            ],
            $reflectionParser->getConstructorArguments()
        );
    }
}
