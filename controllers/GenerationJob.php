<?php namespace Depcore\PDFToolkit\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Generation Job Backend Controller
 *
 * @link https://docs.octobercms.com/3.x/extend/system/controllers.html
 */
class GenerationJob extends Controller
{
    public $implement = [
        \Backend\Behaviors\ListController::class,
    ];

    /**
     * @var string listConfig file
     */
    public $listConfig = 'config_list.yaml';

    /**
     * @var array required permissions
     */
    public $requiredPermissions = ['depcore.pdftoolkit.generationjob'];

    /**
     * __construct the controller
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Depcore.PDFToolkit', 'pdftoolkit', 'generationjob');
    }
}
