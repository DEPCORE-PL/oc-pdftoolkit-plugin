<?php
namespace Depcore\PDFToolkit\Classes;

use Depcore\PDFToolkit\Models\Template;
/**
 * Class TemplateManager
 *
 * Acts as a registrar for PDF templates within the depcore PDF toolkit plugin.
 * Allows registration of templates at plugin startup and provides access to them in the UI.
 *
 * @package depcore\pdftoolkit
 */
class TemplateManager {

    /**
     * Adds a new template to the system.
     *
     * @param mixed $template The template to be added. The type and structure of the template
     *                       should be specified in the implementation details.
     * @return void
     */
    public static function addTemplate($template) {
        Template::updateOrCreate(["class" => $template], ["class"=>$template, "name"=>$template::getName()
        ]);
    }

    /**
     * Retrieves a list of available templates.
     *
     * @return array An array of template data.
     */
    public static function getTemplates() {
        return Template::all();
    }
}
