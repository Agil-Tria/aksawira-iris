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
        Schema::create('dictionary_examples', function (Blueprint $table) {

                    $table->id();

                    $table->foreignId('dictionary_entry_id')
                        ->constrained()
                        ->cascadeOnDelete();

                    $table->text('example_source');

                    $table->text('example_target')
                        ->nullable();

                    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dictionary_examples');
    }
};
