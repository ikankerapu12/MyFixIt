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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('stype_id');
            $table->string('service_name');
            $table->string('service_slug');
            $table->string('service_code');
            $table->string('lowest_fee')->nullable();
            $table->string('max_fee')->nullable();
            $table->string('service_thumbnail');
            $table->text('short_descp')->nullable();
            $table->text('long_descp')->nullable();
            $table->string('service_video')->nullable();
            $table->string('seksyen')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('featured')->nullable();
            $table->string('hot')->nullable();
            $table->integer('technician_id')->nullable();
            $table->string('status')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
