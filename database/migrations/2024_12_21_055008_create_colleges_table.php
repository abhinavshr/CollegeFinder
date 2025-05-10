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
        Schema::create('colleges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('college_admin_id');
            $table->string('name');
            $table->string('location');
            $table->string('city');
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->string('website');
            $table->text('description');
            $table->string('logo');
            $table->string('affiliated_university');
            $table->string('level_of_education');
            $table->string('course_offered');
            $table->string('alumni_network');
            $table->string('placement_availability');
            $table->string('entrance_exams_required');
            $table->string('country');
            $table->timestamps();

            $table->foreign('college_admin_id')->references('id')->on('college_admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colleges');
    }
};
