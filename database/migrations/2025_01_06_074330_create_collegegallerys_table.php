<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('collegegallerys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('college_id');
            $table->string('image');
            $table->string('caption');
            $table->timestamps();

            $table->foreign('college_id')->references('id')->on('colleges')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collegegallerys');
    }
};
