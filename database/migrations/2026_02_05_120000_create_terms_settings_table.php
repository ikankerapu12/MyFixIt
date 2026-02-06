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
        Schema::create('terms_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->date('last_updated')->nullable();
            $table->text('intro')->nullable();
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
            $table->string('section7_title')->nullable();
            $table->text('section7_body')->nullable();
            $table->string('section8_title')->nullable();
            $table->text('section8_body')->nullable();
            $table->string('section9_title')->nullable();
            $table->text('section9_body')->nullable();
            $table->string('section10_title')->nullable();
            $table->text('section10_body')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terms_settings');
    }
};
