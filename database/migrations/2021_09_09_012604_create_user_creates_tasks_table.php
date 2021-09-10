<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCreatesTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_creates_tasks', function (Blueprint $table) {
            $table->foreignId('user_ID')->constrained('users');
            $table->foreignId('task_ID')->constrained('todolists');
            $table->primary(['user_ID','task_ID']);
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
        Schema::dropIfExists('user_creates_tasks');
    }
}
