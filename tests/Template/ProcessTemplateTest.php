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
                    '$this->helloWorld = $this->prophesize(HelloWorld::class);',
                    '$this->stuff = $this->prophesize(Stuff::class);',
                ],
                [
                    'private $this->helloWorld;',
                    'private $this->stuff;',
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
    private $this->helloWorld;
    private $this->stuff;

    public function setUp()
    {
        $this->helloWorld = $this->prophesize(HelloWorld::class);
        $this->stuff = $this->prophesize(Stuff::class);
    }
}
',
            $result
        );
    }
}
