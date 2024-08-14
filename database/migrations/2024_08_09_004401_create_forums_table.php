<?php

use App\Models\Domaine;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('description');
            $table->integer('nombre_de_message');
            $table->integer('nombre_de_vue');
            $table->date('dateCreation');

             // modification sous domaine
             $table->unsignedBigInteger('domaine_id')->nullable();
             $table->foreign('domaine_id')
             ->references('id')
             ->on('sous_domaines')
             ->onDelete('set null');
             
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('modified_by')->nullable();

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->foreign('modified_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forums');
    }
};
