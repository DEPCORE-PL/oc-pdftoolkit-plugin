<?php namespace Depcore\PDFToolkit\Models;

use Model;

/**
 * Template Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Template extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $timestamps = false;

    protected $fillable = ["name", "class"];

    /**
     * @var string table name
     */
    public $table = 'depcore_pdftoolkit_templates';

    function getModel(){
        return new ($this->class)();
    }

    /**
     * @var array rules for validation
     */
    public $rules = [];
}
