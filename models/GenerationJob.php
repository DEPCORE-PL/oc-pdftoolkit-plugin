<?php namespace Depcore\PDFToolkit\Models;

use Model;

/**
 * GenerationJob Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class GenerationJob extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'depcore_pdftoolkit_generation_jobs';

    /**
     * @var array rules for validation
     */
    public $rules = [
        "payload" =>  "required",
        "template" =>  "required"
    ];

    protected $fillable = ["downloadLink", "payload", "title"];

    public $belongsTo = [
        "template" => Template::class
    ];
}
