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
        Schema::create('prep_candidate_party_coalitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prep_candidate_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('prep_party_coalition_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prep_candidate_party_coalitions');
    }
};
