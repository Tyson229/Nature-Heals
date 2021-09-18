<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_lists', function (Blueprint $table) {
            $table->id();
            $table->string('study_name')->nullable();
            $table->string('link',250)->nullable();
            $table->timestamps();
            $table->foreignId('tool_ID')->constrained('tools');
        });
        
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link_lists');
    }
}
