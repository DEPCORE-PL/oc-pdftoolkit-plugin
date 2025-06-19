<?php
namespace Depcore\PDFToolkit\Classes;

use Storage;
use System\Traits\ConfigMaker;

/**
 * Trait ToolkitTemplate
 *
 * Adds form, registrar, and media features to PdfTemplate.
 * Provides reusable methods and properties for PDF toolkit templates.
 * Intended to be used within classes that require PDF template manipulation functionality.
 *
 * @package depcore\pdftoolkit
 */
trait ToolkitTemplate {
    use ConfigMaker;
    private $classPath;

    protected $fields = "fields.yaml";

    abstract public static function getName(): string;

    /**
     * Converts a form image path into a PDF template-compatible path.
     *
     * @param string $path The file path from the form input.
     * @return string The resolved path for PDF template usage.
     */
    public function image(string $path){
        return Storage::path('/media'.$path);
    }

    /**
     * Retrieves the fields associated with the template.
     *
     * The fields are defined in <templateclassname>/fields.yaml.
     *
     * @return array The list of fields for the template.
     */
    public function getFields() {
        $this->classPath = $this->guessConfigPathFrom($this);
        $fieldsPath = $this->classPath."/".$this->fields;
        return $this->makeConfig($fieldsPath);
    }
}
