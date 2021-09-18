<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateToolsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tools', function (Blueprint $table) {
            $table->string('tool_description',1000)->change();
            $table->string('health_domain',100)->change();
            $table->string('age_group',100)->nullable()->change();
            $table->string('notes',1000)->nullable()->change();
            //Link

            /*Additional Details */
            $table->string('outcome',1000)->nullable()->change();
            $table->string('gender',10)->change();
            $table->string('health_condition',100)->nullable()->change();
            $table->string('modality',100)->nullable()->change();
            $table->string('specific_NB',10)->nullable()->change();
            $table->string('settings',100)->nullable()->change();
            $table->string('reliability',10)->nullable()->change();

            /*Author details */
            $table->string('author',100)->nullable()->change();
            $table->string('title',250)->nullable()->change();
            $table->integer('year')->nullable()->change();
            $table->string('program_content',1000)->nullable()->change();
            $table->string('article',250)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
