<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCreatesToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_creates_tools', function (Blueprint $table) {
            $table->foreignId('user_ID')->constrained('users');
            $table->foreignId('tool_ID')->constrained('tools');
            $table->primary(['user_ID','tool_ID']);
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
        Schema::dropIfExists('user_creates_tools');
    }
}
