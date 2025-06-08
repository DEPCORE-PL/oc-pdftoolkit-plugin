<?php namespace Depcore\PDFToolkit\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateTemplatesTable Migration
 *
 * @link https://docs.octobercms.com/3.x/extend/database/structure.html
 */
return new class extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
        Schema::create('depcore_pdftoolkit_templates', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class');
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('depcore_pdftoolkit_templates');
    }
};
