<?php
namespace Depcore\PdfToolkit\Classes;

use File;
use System\Traits\ConfigMaker;
use Yaml;

trait ToolkitTemplate {
    use ConfigMaker;
    private $classPath;

    protected $fields = "fields.yaml";

    abstract public static function getName(): string;

    public function getFields() {
        $this->classPath = $this->guessConfigPathFrom($this);
        $fieldsPath = $this->classPath."/".$this->fields;
        return $this->makeConfig($fieldsPath);
    }
}
