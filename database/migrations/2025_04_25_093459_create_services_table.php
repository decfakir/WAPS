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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('professional_id');
            $table->string('nom', 255)->index();
            $table->text('description')->nullable();
            $table->decimal('prix_base', 8, 2)->default(0.00);
            $table->unsignedInteger('duree_estimee')->nullable();
            $table->boolean('approuve')->default(false);
            $table->boolean('status')->default(false);
            $table->timestamps();

            // Clés étrangères
            $table->foreign('categorie_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('restrict');
            $table->foreign('professional_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade'); // Supprime les services si le professionnel est supprimé
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
