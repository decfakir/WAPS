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
        Schema::create('image_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_id');
            $table->string('image_path');
            $table->string('type');
            $table->softDeletes(); // Enables soft deletes
            $table->timestamps();

            // Foreign key to services table
            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('cascade'); // Deletes images when the associated service is deleted

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_services');
    }
};
