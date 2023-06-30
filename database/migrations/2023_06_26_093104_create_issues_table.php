<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

            Schema::create('issues', function (Blueprint $table) {
                $table->id();
                $table->string('title')->index();
                $table->longText('description')->nullable();
                $table->foreignId('workspace_id')->constrained()->cascadeOnDelete();
                $table->foreignId('status_id')->constrained()->cascadeOnDelete();
                $table->unsignedBigInteger('creator_id');
                $table->unsignedBigInteger('assign_id')->nullable();
                $table->foreign('creator_id')->references('id')->on('users')->cascadeOnDelete();
                $table->foreign('assign_id')->references('id')->on('users')->cascadeOnDelete();
                $table->timestamps();
                // $table->index(['title','created_at']);
            });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
};
