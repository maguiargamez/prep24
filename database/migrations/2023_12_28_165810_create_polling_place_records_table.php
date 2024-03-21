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
        Schema::create('polling_place_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('election_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('c_casilla_id')->constrained();

            $table->smallInteger('leftover_ballots')->nullable();
            $table->smallInteger('voters')->nullable();  
            $table->smallInteger('party_representative_voters')->nullable();  
            $table->smallInteger('voters_sum')->nullable();  
            $table->smallInteger('votes_taken_urn')->nullable();  
            $table->boolean('votes_matched_urn')->default(0);
            $table->boolean('votes_matched')->default(0);

            $table->string('president', 255)->nullable();
            $table->string('first_secretary', 255)->nullable();
            $table->string('second_secretary', 255)->nullable();
            $table->string('first_scrutineer', 255)->nullable();
            $table->string('second_scrutineer', 255)->nullable();
            $table->string('third_scrutineer', 255)->nullable();

            $table->string('observations', 255)->nullable();
            $table->string('digitized_record', 255)->nullable();

            $table->boolean('is_captured')->default(0);
            $table->boolean('is_validated')->default(0);
            $table->integer('capture_source')->default(1);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polling_place_records');
    }
};
