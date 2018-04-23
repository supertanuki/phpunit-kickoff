<?php

namespace PHPUnitKickoff\Parser;

use PhpParser\Error;
use PhpParser\Node\Stmt;
use PhpParser\ParserFactory;

class Parser
{
    /** @var Stmt[] */
    private $ast = array();

    /** @var null|Stmt\Namespace_ */
    private $currentNameSpace;

    /** @var null|array */
    private $usedClasses;

    public function loadFileAndParse(string $file): void
    {
        $code = file_get_contents($file);

        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);

        try {
            $this->ast = $parser->parse($code);
        } catch (Error $error) {
            echo "Parse error: {$error->getMessage()}\n";
            return;
        }
    }

    public function isolateNameSpace(): void
    {
        foreach ($this->ast as $item) {
            if ($item instanceof Stmt\Namespace_) {
                $this->currentNameSpace = $item;

                return;
            }
        }

        throw new \LogicException('Namespace not found');
    }

    public function getNameSpace(): string
    {
        $this->checkCurrentNameSpace();

        return $this->currentNameSpace->name->toString();
    }

    public function stackUsedClasses(): void
    {
        $this->checkCurrentNameSpace();

        foreach ($this->currentNameSpace->stmts as $stmt) {
            if ($stmt instanceof Stmt\Use_) {
                foreach ($stmt->uses as $use) {
                    $this->usedClasses[$use->getAlias()->toString()] = $use->name->parts;
                }
            }
        }
    }

    public function getUsedClasses()
    {
        if (null === $this->usedClasses) {
            $this->stackUsedClasses();
        }

        return $this->usedClasses;
    }

    private function checkCurrentNameSpace()
    {
        if (!$this->currentNameSpace instanceof Stmt\Namespace_) {
            throw new \LogicException('Namespace is not available');
        }
    }
}
