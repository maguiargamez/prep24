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
        Schema::create('prep_candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prep_election_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('prep_party_coalition_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name', 255);
            $table->string('photo', 255)->nullable();
            $table->boolean('is_special')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prep_candidates');
    }
};
