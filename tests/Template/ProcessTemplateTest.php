<?php

use PHPUnit\Framework\TestCase;
use PHPUnitKickoff\Template\ProcessTemplate;
use PHPUnitKickoff\Template\TemplateData;

class ProcessTemplateTest extends TestCase
{
    public function testHandle()
    {
        $processTemplate = new ProcessTemplate();
        $result = $processTemplate->handle(
            new TemplateData(
                'MyClass',
                [
                    'use Whatever\Dependency\HelloWorld;',
                    'use Whatever\Something as Stuff;',
                ],
                [
                    '$helloWorld = $this->prophesize(HelloWorld::class);',
                    '$stuff = $this->prophesize(Stuff::class);',
                ]
            )
        );

        $this->assertEquals(
            '<?php

use PHPUnit\Framework\TestCase;
use Whatever\Dependency\HelloWorld;
use Whatever\Something as Stuff;

final class MyClassTest extends TestCase
{
    public function setUp()
    {
        $helloWorld = $this->prophesize(HelloWorld::class);
        $stuff = $this->prophesize(Stuff::class);
    }
}
',
            $result
        );
    }
}
