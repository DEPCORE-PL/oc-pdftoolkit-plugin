<?php namespace Depcore\PDFToolkit\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Depcore\PDFToolkit\Classes\GeneratorController;

/**
 *  Main controller for the PDF Toolkit Generator.
 *
 * @link https://docs.octobercms.com/3.x/extend/system/controllers.html
 */
class Generator extends Controller
{
    public $implement = [
        GeneratorController::class,
        \Backend\Behaviors\ListController::class,
    ];

    /**
     * @var string formConfig file
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string listConfig file
     */
    public $listConfig = 'config_list.yaml';

    /**
     * @var array required permissions
     */
    public $requiredPermissions = ['depcore.pdftoolkit.generator'];

    /**
     * __construct the controller
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Depcore.PDFToolkit', 'pdftoolkit', 'generator');
    }
}
