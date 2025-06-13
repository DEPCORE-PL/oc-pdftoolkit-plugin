<?php
namespace Depcore\PdfToolkit\Templates;

use Depcore\PdfToolkit\Classes\ToolkitTemplate;
use Dflydev\DotAccessData\Data;
use Initbiz\Pdfgenerator\Classes\PdfLayout;

class CoffeeCorner extends PdfLayout {
    use ToolkitTemplate;

    public static function getName(): string
    {
        return "Coffee Corner Poster";
    }

    public function prepareData($data): void
    {
        if (count($data) == 0) return;
        parent::prepareData($data);
        $this->data["image_logo"] = $this->assetsPath."/img/export.png";
        $this->data["image_dog"] = $this->assetsPath."/img/dog.png";
        $this->data["image_brands"] = $this->image($this->data["image_brands"]);
    }
}
