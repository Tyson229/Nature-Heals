<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('tool_name');
            $table->string('tool_description',400);
            $table->string('health_domain',30);
            $table->string('age_group',30)->nullable();
            $table->string('notes',250)->nullable();
            //Link

            /*Additional Details */
            $table->string('outcome',250)->nullable();
            $table->string('gender',30);
            $table->string('health_condition',30)->nullable();
            $table->string('modality',30)->nullable();
            $table->string('specific_NB',30)->nullable();
            $table->string('settings',30)->nullable();
            $table->string('reliability',30)->nullable();
            $table->string('validity',30)->nullable();

            /*Author details */
            $table->string('author',50)->nullable();
            $table->string('title',100)->nullable();
            $table->integer('year')->nullable();
            $table->string('country',30)->nullable();
            $table->string('measure',30)->nullable();
            $table->string('program_content',250)->nullable();
            $table->string('creadit',250)->nullable();
            $table->foreignId('status_ID')->constrained('tool_statuses');
            //files
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tools');
    }
}
