<?php

namespace Depcore\PdfToolkit\Templates;

use Config;
use Depcore\PdfToolkit\Classes\ToolkitTemplate;
use Initbiz\Pdfgenerator\Classes\PdfLayout;
use Media\Classes\MediaLibrary;
use Storage;

/**
 * Class DebugTemplate
 *
 * A PDF layout template used for debugging purposes within the PDF Toolkit plugin.
 * Extends the PdfLayout base class and uses the ToolkitTemplate trait for plugin compatibility.
 *
 * @package depcore\pdftoolkit\templates
 */
class DebugTemplate extends PdfLayout
{
    use ToolkitTemplate;

    /**
     * Retrieves the name associated with this class or template.
     *
     * @return string The name as a string.
     */
    public static function getName(): string
    {
        return "Example Template";
    }

    /**
     * Prepares and transforms the form data or loads additional data for the template.
     *
     * This method is intended to process the provided data array, allowing for
     * transformation or enrichment of the data before it is used within the template.
     *
     * @param mixed $data The data to be prepared or transformed for the template.
     *
     * @return void
     */
    public function prepareData($data): void
    {
        if (count($data) == 0) return;
        parent::prepareData($data);

        //examples
        // $this->data["image_logo"] = $this->assetsPath."/img/export.png";
        // $this->data["image_dog"] = $this->assetsPath."/img/dog.png";
        // $this->data["image_brands"] = $this->image($this->data["image_brands"]);
        //end examples

        // this is data from the form
        $this->data["image"] = $this->image($data["image"]);
    }
}
