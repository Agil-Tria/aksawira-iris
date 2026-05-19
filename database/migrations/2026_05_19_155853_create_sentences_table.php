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
 Schema::create('sentences', function (Blueprint $table) {

            $table->id();

            $table->text('source_text');

            $table->text('target_text');

            $table->string('source_lang')
                ->default('id');

            $table->string('target_lang')
                ->default('kom');

            $table->foreignId('contributor_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending');

            $table->enum('quality_level', [
                'raw',
                'verified',
                'trusted'
            ])->default('raw');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sentences');
    }
};
