<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name');
            
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('fname');
            $table->string('lname');
            $table->string('password');
            $table->foreignId('role_ID')->constrained('roles');
            
        });

        Schema::create('todolist', function (Blueprint $table) {
            $table->id();
            $table->string('task_name');
            $table->integer('priority');
            $table->boolean('completed');
        });

        Schema::create('user_creates_tasks', function (Blueprint $table) {
            $table->foreignId('user_ID')->constrained('users');
            $table->foreignId('task_ID')->constrained('todolist');
            $table->primary(['user_ID','task_ID']);
        });

        Schema::create('tool_status', function (Blueprint $table) {
            $table->id();
            $table->string('status',10);
        });

        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('tool_name');
            $table->string('tool_description',400);
            $table->string('health_domain',30);
            $table->string('age_group',30);
            $table->string('notes',250);
            //Link
            /*Additional Details */
            $table->string('outcome',250);
            $table->string('gender',30);
            $table->string('health_condition',30);
            $table->string('modality',30);
            $table->string('specific_NB',30);
            $table->string('settings',30);
            $table->string('reliability',30);
            $table->string('validity',30);

            /*Author details */
            $table->string('author',50);
            $table->string('title',100);
            $table->integer('year');
            $table->string('country',30);
            $table->string('measure',30);
            $table->string('program_content',250);
            $table->string('creadit',250)->nullable();
            $table->foreignId('status_ID')->constrained('tool_status');
        });

        Schema::create('user_creates_tool', function (Blueprint $table) {
            $table->foreignId('user_ID')->constrained('users');
            $table->foreignId('tool_ID')->constrained('tools');
            $table->primary(['user_ID','tool_ID']);
        });

        Schema::create('link_list', function (Blueprint $table) {
            $table->foreignId('tool_ID')->constrained('tools');
            $table->string('link',250);
            $table->primary(['tool_ID','link']);
        });

        Schema::create('request', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_name');
            $table->string('visitor_email');
            $table->date('date');
            
            $table->foreignId('tool_ID')->constrained('tools');
            $table->foreignId('status_ID')->constrained('tools');
        });

        Schema::create('tool_feedback', function (Blueprint $table) {
            $table->id();
            $table->string('name',40);
            $table->string('email');
            $table->string('comment',400);
            $table->foreignId('tool_ID')->constrained('tools');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
        Schema::dropIfExists('todolist');
        Schema::dropIfExists('user_creates_tasks');
        Schema::dropIfExists('tool_status');
        Schema::dropIfExists('tools');
        Schema::dropIfExists('user_creates_tool');
        Schema::dropIfExists('link_list');
        Schema::dropIfExists('request');
        Schema::dropIfExists('tool_feedback');
    }
}
