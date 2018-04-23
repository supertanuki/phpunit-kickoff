<?php

namespace PHPUnitKickoff\Template;

class ProcessTemplate
{
    private const TEMPLATE_DIRECTORY = __DIR__ . '/../Resources/Template';
    private const MAIN_TEMPLATE = 'TemplateTest.php.dist';

    public function handle(TemplateData $templateData): string
    {
        $template = file_get_contents(self::TEMPLATE_DIRECTORY . '/' . self::MAIN_TEMPLATE);

        $template = str_replace(
            [
                '%%className%%',
                '%%usedClasses%%',
                '%%setUp%%',
            ],
            [
                $templateData->className,
                implode("\n", $templateData->usedClasses),
                implode("\n" . str_repeat(' ', $this->getTabs($template, '%%setUp%%')), $templateData->setUp),
            ],
            $template
        );

        return $template;
    }

    private function getTabs(string $template, string $placeholder): int
    {
        $lines = explode("\n", $template);

        foreach ($lines as $line) {
            if (empty($line)) {
                continue;
            }

            $position = strpos($line, $placeholder);

            if (false !== $position) {
                return $position;
            }
        }

        throw new \InvalidArgumentException('Placeholder not found');
    }
}
