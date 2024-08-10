<?php

use App\Models\Guide;
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
        Schema::create('temoignages', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('description');
                // created_by and modifier_by
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


            $table->foreignIdFor(Guide::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temoignages');
    }
};
