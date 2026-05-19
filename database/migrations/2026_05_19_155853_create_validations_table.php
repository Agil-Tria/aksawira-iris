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
        Schema::create('validations', function (Blueprint $table) {
            $table->id();
             $table->foreignId('sentence_id')
                 ->constrained('sentences')
                ->cascadeOnDelete();

            $table->foreignId('validator_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('action', [
                'approve',
                'reject',
                'revise'
            ]);

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validations');
    }
};
