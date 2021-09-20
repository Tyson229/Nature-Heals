<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestsTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('requests');
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_name');
            $table->string('org_name')->nullable();
            $table->string('visitor_email');
            $table->date('date');
            $table->unsignedBigInteger('copy_of')->nullable();
            $table->boolean('internal_request');
            $table->foreignId('tool_ID')->constrained('tools');
            $table->unsignedBigInteger('status_ID');
            $table->foreign('status_ID')->references('status_ID')->on('tools');
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
        Schema::dropIfExists('requests');
    }
}
