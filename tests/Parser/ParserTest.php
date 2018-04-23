<?php

use PHPUnit\Framework\TestCase;
use PHPUnitKickoff\Parser\Parser;

final class ParserTest extends TestCase
{
    public function testGetNameSpace()
    {
        $parser = new Parser();
        $parser->loadFileAndParse(__DIR__ . '/../Fixture/Whatever/Simple/SimpleClass.php');
        $parser->isolateNameSpace();

        $this->assertEquals('Whatever\Simple', $parser->getNameSpace());
        $this->assertEquals(
            [
                'AliasedAnotherDependency' => [
                    'Whatever',
                    'Dependencies',
                    'AnotherDependency',
                ],
                'WhateverDependency' => [
                    'Whatever',
                    'Dependencies',
                    'WhateverDependency',
                ],
            ],
            $parser->getUsedClasses()
        );
    }
}
