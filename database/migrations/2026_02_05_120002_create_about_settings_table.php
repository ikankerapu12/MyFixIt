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
        Schema::create('about_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('intro')->nullable();
            $table->string('logo')->nullable();
            $table->string('section1_title')->nullable();
            $table->text('section1_body')->nullable();
            $table->string('section2_title')->nullable();
            $table->text('section2_body')->nullable();
            $table->string('section3_title')->nullable();
            $table->text('section3_body')->nullable();
            $table->string('section4_title')->nullable();
            $table->text('section4_body')->nullable();
            $table->string('section5_title')->nullable();
            $table->text('section5_body')->nullable();
            $table->string('section6_title')->nullable();
            $table->text('section6_body')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_settings');
    }
};
