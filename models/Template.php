<?php namespace Depcore\PDFToolkit\Models;

use Initbiz\Pdfgenerator\Classes\PdfLayout;
use Model;

/**
 *  Template Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Template extends Model
{
    // disaple timestamps, we don't need them
    public $timestamps = false;

    protected $fillable = ["name", "class"];

    /**
     * @var string table name
     */
    public $table = 'depcore_pdftoolkit_templates';

    /**
     * Returns an instance of the generable template class.
     *
     * This method instantiates and returns a new object of the class specified by the `$class` property.
     * The returned object must implement the `ToolkitTemplate` interface and use the `ToolkitTemplate` trait.
     *
     * @return ToolkitTemplate An instance of the generable template class.
     */
    function getModel(): PdfLayout {
        return new ($this->class)();
    }

}
