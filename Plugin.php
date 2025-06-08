<?php namespace Depcore\PDFToolkit;

use Backend;
use Depcore\PdfToolkit\Classes\TemplateManager;
use Depcore\PdfToolkit\Templates\DebugTemplate;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
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
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        TemplateManager::addTemplate(DebugTemplate::class);

    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Depcore\PDFToolkit\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'depcore.pdftoolkit.some_permission' => [
                'tab' => 'PDFToolkit',
                'label' => 'Some permission'
            ],
        ];
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
