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
        Schema::create('prep_party_coalitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prep_election_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('short', 100);
            $table->string('name', 255);
            $table->string('logo', 255);
            $table->json('parties')->nullable();
            $table->boolean('is_coalition');
            $table->boolean('is_independent');            
            $table->boolean('is_active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prep_party_coalitions');
    }
};
