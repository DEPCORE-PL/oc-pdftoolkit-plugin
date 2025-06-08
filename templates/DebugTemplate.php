<?php
namespace Depcore\PdfToolkit\Templates;

use Depcore\PdfToolkit\Classes\ToolkitTemplate;
use Initbiz\Pdfgenerator\Classes\PdfLayout;

class DebugTemplate extends PdfLayout {
    use ToolkitTemplate;

    public static function getName(): string
    {
        return "Example Template";
    }

    public function prepareData($data): void
    {
        parent::prepareData($data);
        $this->data["info"] = "saaaaa";
    }
}
