<?php
namespace Depcore\PdfToolkit\Classes;

use Depcore\PDFToolkit\Models\Template;
class TemplateManager {

    public static function addTemplate($template) {
        Template::updateOrCreate(["class" => $template], ["class"=>$template, "name"=>$template::getName()
        ]);
    }
    public static function getTemplates() {
        return Template::all();
    }
}
