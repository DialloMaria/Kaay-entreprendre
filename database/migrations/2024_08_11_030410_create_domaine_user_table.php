<?php

use App\Models\User;
use App\Models\Categorie;
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
        Schema::create('domaine_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sous_domaine_id');
            // etat
            $table->enum('etat', [ 'En cours', 'Terminer'])->default('En cours'); // Par défaut, l'état est 'En attente'
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sous_domaine_id')->references('id')->on('sous_domaines')->onDelete('cascade');

            $table->unique(['user_id', 'sous_domaine_id']); // Assure qu'un utilisateur ne peut pas s'inscrire plusieurs fois au même domaine

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domaine_user');
    }
};
