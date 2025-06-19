<?php namespace Depcore\PDFToolkit;

use Backend;
use Depcore\PdfToolkit\Classes\TemplateManager;
use Depcore\PdfToolkit\Templates\CoffeeCorner;
use Depcore\PdfToolkit\Templates\DebugTemplate;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * Specifies the plugin dependencies required for this plugin to function properly.
     *
     * @var array $require List of plugin codes that must be installed and enabled.
     */
    public $require = [
        'Initbiz.Pdfgenerator'
    ];

    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'PDFToolkit',
            'description' => 'Toolset for creating pdfs',
            'author' => 'Depcore',
            'icon' => 'icon-document'
        ];
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        // add template to the TemplateManager
        TemplateManager::addTemplate(DebugTemplate::class);

    }

    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        return [
            'pdftoolkit' => [
                'label' => 'PDFToolkit',
                'url' => Backend::url('depcore/pdftoolkit/generator'),
                'icon' => 'icon-leaf',
                'permissions' => ['depcore.pdftoolkit.*'],
                'order' => 500,
            ],
        ];
    }
}
